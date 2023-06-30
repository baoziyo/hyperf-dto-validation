<?php
/*
 * Copyright (c) 2023. ogg. Inc. All Rights Reserved.
 * ogg sit down and start building bugs in sunny weather.
 * Author: Ogg <baoziyoo@gmail.com>.
 * LastChangeTime: 2023-02-24 11:01:30
 * ChangeTime: 2023-04-26 10:21:32
 */

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Annotation\Rule;

use Attribute;
use Hyperf\Validation\Rule;

#[Attribute(Attribute::TARGET_PROPERTY)]
class EnumIn extends BaseValidation
{
    public function __construct(public string $class, public string $type = 'value', public string $messages = '')
    {
        if ($type === 'value') {
            $this->rule = Rule::in($class::values());
        }

        if ($type === 'key') {
            $this->rule = Rule::in($class::keys());
        }
    }
}
