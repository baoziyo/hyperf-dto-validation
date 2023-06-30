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
 * 第一个验证规则验证失败则停止运行其它验证规则.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Bail extends BaseValidation
{
    public mixed $rule = 'bail';
}
