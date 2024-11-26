<?php
/*
 * Copyright (c) 2023. ogg. Inc. All Rights Reserved.
 * ogg sit down and start building bugs in sunny weather.
 * Author: Ogg <baoziyoo@gmail.com>.
 * LastChangeTime: 2023-02-07 05:09:23
 * ChangeTime: 2023-04-26 10:21:32
 */

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Aspect;

use Baoziyoo\Hyperf\DTO\Mapper;
use Baoziyoo\Hyperf\DTO\Scan\MethodParametersManager;
use Baoziyoo\Hyperf\DTO\Scan\PropertyAliasMappingManager;
use Baoziyoo\Hyperf\DTO\Validation\ValidationDto;
use Hyperf\Context\Context;
use Hyperf\Contract\NormalizerInterface;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\HttpServer\CoreMiddleware;
use InvalidArgumentException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ServerRequestInterface;

class CoreMiddlewareAspect extends AbstractAspect
{
    /** @var array|string[] */
    public array $classes = [
        'Hyperf\HttpServer\CoreMiddleware::parseMethodParameters',
    ];

    public function __construct(protected ContainerInterface $container)
    {
    }

    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        $arguments = $proceedingJoinPoint->arguments['keys'];

        /** @var CoreMiddleware $instance */
        $instance = $proceedingJoinPoint->getInstance();

        $definitions = $instance->getMethodDefinitionCollector()->getParameters($arguments['controller'], $arguments['action']);

        return $this->getInjections($definitions, "{$arguments['controller']}::{$arguments['action']}", $arguments['arguments']);
    }

    private function getInjections(array $definitions, string $callableName, array $arguments): array
    {
        $injections = [];
        foreach ($definitions ?? [] as $pos => $definition) {
            $value = $arguments[$pos] ?? $arguments[$definition->getMeta('name')] ?? null;
            if ($value === null) {
                if ($definition->getMeta('defaultValueAvailable')) {
                    $injections[] = $definition->getMeta('defaultValue');
                } elseif ($definition->allowsNull()) {
                    $injections[] = null;
                } elseif ($this->container->has($definition->getName())) {
                    $obj = $this->container->get($definition->getName());
                    $injections[] = $this->validateAndMap($callableName, $definition->getMeta('name'), $definition->getName(), $obj);
                } else {
                    throw new InvalidArgumentException("Parameter '{$definition->getMeta('name')}' "
                        . "of {$callableName} should not be null");
                }
            } else {
                $injections[] = $this->container->get(NormalizerInterface::class)->denormalize($value, $definition->getName());
            }
        }

        return $injections;
    }

    /**
     * @param string $callableName
     * @param string $paramName
     * @param string $className
     * @param mixed $obj
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function validateAndMap(string $callableName, string $paramName, string $className, mixed $obj): mixed
    {
        [$controllerName, $methodName] = explode('::', $callableName);
        $methodParameter = MethodParametersManager::getMethodParameter($controllerName, $methodName, $paramName);
        if ($methodParameter === null) {
            return $obj;
        }
        $validationDTO = $this->container->get(ValidationDto::class);
        /** @var ServerRequestInterface $request */
        $request = Context::get(ServerRequestInterface::class);
        $param = [];
        if ($methodParameter->isRequestBody()) {
            $param = $request->getParsedBody();
        } elseif ($methodParameter->isRequestQuery()) {
            $param = $request->getQueryParams();
        } elseif ($methodParameter->isRequestFormData()) {
            $param = $request->getParsedBody();
            // 兼容file
            if (is_array($param) && count($request->getUploadedFiles()) > 0) {
                $param = array_merge($param, $request->getUploadedFiles());
            }
        } elseif ($methodParameter->isRequestHeader()) {
            $param = array_map(static function ($value) {
                return $value[0];
            }, $request->getHeaders());
        }
        // validate
        if ($methodParameter->isValid()) {
            $validationDTO->validate($className, $param);
        }
        if (PropertyAliasMappingManager::isAliasMapping()) {
            return Mapper::mapDto($param, make($className));
        }
        return Mapper::map($param, make($className));
    }
}
