<?php

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation;

use App\Exception\InvalidArgumentException;
use Baoziyoo\Hyperf\DTO\Scan\PropertyManager;
use Baoziyoo\Hyperf\DTO\Validation\Exception\DtoValidationException;
use Baoziyoo\Hyperf\DTO\Validation\Scan\ValidationManager;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;

class ValidationDto
{
    private ?ValidatorFactoryInterface $validationFactory = null;

    public function __construct()
    {
        $container = ApplicationContext::getContainer();
        if ($container->has(ValidatorFactoryInterface::class)) {
            $this->validationFactory = $container->get(ValidatorFactoryInterface::class);
        }
    }

    public function validate(string $className, $data): void
    {
        if ($this->validationFactory === null) {
            return;
        }

        $this->validateResolved($className, $data);
    }

    private function validateResolved(string $className, $data): void
    {
        if (!is_array($data)) {
            throw new DtoValidationException('Class:' . $className . ' data must be object or array');
        }

        $validArr = ValidationManager::getData($className);
        if (empty($validArr)) {
            return;
        }
        $validator = $this->validationFactory->make(
            $data,
            $validArr['rule'],
            $validArr['messages'] ?? [],
            $validArr['attributes'] ?? []
        );
        if ($validator->fails()) {
            throw new InvalidArgumentException(500, $validator->errors()->first());
        }
        // 递归校验判断
        $notSimplePropertyArr = PropertyManager::getPropertyAndNotSimpleType($className);
        foreach ($notSimplePropertyArr as $fieldName => $property) {
            if (!empty($data[$fieldName])) {
                if ($property->isClassArray()) {
                    foreach ($data[$fieldName] as $item) {
                        $this->validateResolved($property->arrClassName, $item);
                    }
                } elseif ($property->className != null) {
                    $this->validateResolved($property->className, $data[$fieldName]);
                }
            }
        }
    }
}
