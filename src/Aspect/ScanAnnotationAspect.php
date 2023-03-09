<?php

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Aspect;

use Baoziyoo\Hyperf\DTO\Annotation\JSONField;
use Baoziyoo\Hyperf\DTO\ApiAnnotation;
use Baoziyoo\Hyperf\DTO\Scan\PropertyAliasMappingManager;
use Baoziyoo\Hyperf\DTO\Validation\Annotation\Rule\BaseValidation;
use Baoziyoo\Hyperf\DTO\Validation\Scan\ValidationManager;
use Hyperf\ApiDocs\Annotation\ApiModelProperty;
use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Psr\Container\ContainerInterface;

class ScanAnnotationAspect extends AbstractAspect
{
    /** @var array|string[] */
    public array $classes = [
        'Baoziyoo\Hyperf\DTO\Scan\ScanAnnotation::registerValidation',
    ];

    public function __construct(protected ContainerInterface $container)
    {
    }

    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        $arguments = $proceedingJoinPoint->arguments['keys'];

        $result = $proceedingJoinPoint->process();

        $this->generateValidation($arguments['className'], $arguments['fieldName']);
        $this->propertyAliasMappingManager($arguments['className'], $arguments['fieldName']);

        return $result;
    }

    /**
     * 生成验证数据.
     */
    protected function propertyAliasMappingManager(string $className, string $fieldName): void
    {
        $annotationArray = ApiAnnotation::getClassProperty($className, $fieldName);

        foreach ($annotationArray as $annotation) {
            if (($annotation instanceof JSONField) && !empty($annotation->name)) {
                PropertyAliasMappingManager::setAliasMapping($className, $annotation->name, $fieldName);
            }
        }
    }

    /**
     * 生成验证数据.
     */
    protected function generateValidation(string $className, string $fieldName): void
    {
        $validationArr = [];
        $annotationArray = ApiAnnotation::getClassProperty($className, $fieldName);

        foreach ($annotationArray as $annotation) {
            if ($annotation instanceof BaseValidation) {
                $validationArr[] = $annotation;
            }
        }

        $ruleArray = [];
        foreach ($validationArr as $validation) {
            if (!$validation instanceof BaseValidation || empty($validation->getRule())) {
                continue;
            }

            $ruleArray[] = $validation->getRule();
            if (empty($validation->messages)) {
                continue;
            }
            [$messagesRule] = explode(':', $validation->getRule());
            $key = $fieldName . '.' . $messagesRule;
            ValidationManager::setMessages($className, $key, $validation->messages);
        }

        if (!empty($ruleArray)) {
            ValidationManager::setRule($className, $fieldName, $ruleArray);
            foreach ($annotationArray as $annotation) {
                if (class_exists(ApiModelProperty::class) && $annotation instanceof ApiModelProperty && !empty($annotation->value)) {
                    ValidationManager::setAttributes($className, $fieldName, $annotation->value);
                }
            }
        }
    }
}
