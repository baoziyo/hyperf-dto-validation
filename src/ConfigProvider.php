<?php

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation;

use Baoziyoo\Hyperf\DTO\Validation\Aspect\CoreMiddlewareAspect;
use Baoziyoo\Hyperf\DTO\Validation\Aspect\ScanAnnotationAspect;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
            ],
            'listeners' => [
            ],
            'aspects' => [
                CoreMiddlewareAspect::class,
                ScanAnnotationAspect::class,
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'publish' => [
            ],
        ];
    }
}
