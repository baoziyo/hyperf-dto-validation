<?php

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
