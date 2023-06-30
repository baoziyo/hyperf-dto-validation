<?php
/*
 * Copyright (c) 2023. ogg. Inc. All Rights Reserved.
 * ogg sit down and start building bugs in sunny weather.
 * Author: Ogg <baoziyoo@gmail.com>.
 * LastChangeTime: 2023-01-16 04:00:26
 * ChangeTime: 2023-04-26 10:21:34
 */

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Annotation\Rule;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Validation extends BaseValidation
{
    public function __construct(mixed $rule, string $messages = '')
    {
        $this->rule = $rule;
        $this->messages = $messages;
    }
}
