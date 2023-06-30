<?php
/*
 * Copyright (c) 2023. ogg. Inc. All Rights Reserved.
 * ogg sit down and start building bugs in sunny weather.
 * Author: Ogg <baoziyoo@gmail.com>.
 * LastChangeTime: 2023-01-16 03:58:05
 * ChangeTime: 2023-04-26 10:21:32
 */

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Annotation\Rule;

use Attribute;

/**
 * 验证字段必须是给定日期之后的一个值，日期将会通过 PHP 函数 strtotime 传递.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class After extends BaseValidation
{
    protected mixed $rule = 'after';

    public function __construct(string $date, string $messages = '')
    {
        $this->messages = $messages;
        $this->rule .= ':' . $date;
    }
}
