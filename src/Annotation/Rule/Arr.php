<?php

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Annotation\Rule;

use Attribute;

/**
 * 验证字段必须是 PHP 数组.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Arr extends BaseValidation
{
    public mixed $rule = 'array';
}
