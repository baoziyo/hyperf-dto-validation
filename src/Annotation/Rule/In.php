<?php
/*
 * Copyright (c) 2023. ogg. Inc. All Rights Reserved.
 * ogg sit down and start building bugs in sunny weather.
 * Author: Ogg <baoziyoo@gmail.com>.
 * LastChangeTime: 2023-01-16 03:59:00
 * ChangeTime: 2023-04-26 10:21:32
 */

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Annotation\Rule;

use Attribute;
use Hyperf\Validation\Rule;

#[Attribute(Attribute::TARGET_PROPERTY)]
class In extends BaseValidation
{
    public function __construct(private readonly array $value, public string $messages = '')
    {
        $this->rule = Rule::in($this->value);
    }

    public function getValue(): array
    {
        return $this->value;
    }
}
