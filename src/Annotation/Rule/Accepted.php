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
 * 验证字段的值必须是 yes、on、1 或 true，这在「同意服务协议」时很有用.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Accepted extends BaseValidation
{
    protected mixed $rule = 'accepted';
}
