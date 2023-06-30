<?php
/*
 * Copyright (c) 2023. ogg. Inc. All Rights Reserved.
 * ogg sit down and start building bugs in sunny weather.
 * Author: Ogg <baoziyoo@gmail.com>.
 * LastChangeTime: 2023-01-16 04:00:26
 * ChangeTime: 2023-04-26 10:21:32
 */

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Annotation\Rule;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Regex extends BaseValidation
{
    protected mixed $rule = 'regex';

    public function __construct(string $value, string $messages = '')
    {
        $this->messages = $messages;
        $this->rule .= ':' . $value;
    }
}
