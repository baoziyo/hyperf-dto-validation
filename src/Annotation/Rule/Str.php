<?php
/*
 * Copyright (c) 2023. ogg. Inc. All Rights Reserved.
 * ogg sit down and start building bugs in sunny weather.
 * Author: Ogg <baoziyoo@gmail.com>.
 * LastChangeTime: 2023-01-16 03:58:14
 * ChangeTime: 2023-04-26 10:21:32
 */

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Annotation\Rule;

use Attribute;

/**
 * 验证字段必须是字符串，如果允许字段为空，需要分配 nullable 规则到该字段。
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Str extends BaseValidation
{
    protected mixed $rule = 'string';
}
