<?php
/*
 * Copyright (c) 2023. ogg. Inc. All Rights Reserved.
 * ogg sit down and start building bugs in sunny weather.
 * Author: Ogg <baoziyoo@gmail.com>.
 * LastChangeTime: 2023-02-07 04:16:20
 * ChangeTime: 2023-04-26 10:21:34
 */

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
