<?php

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Annotation\Rule;

use Attribute;
use Hyperf\Validation\Rule;

/**
 * 验证字段值不能在给定列表中，和 in 规则类似
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class NotIn extends BaseValidation
{
    public function __construct(array $value, string $messages = '')
    {
        $this->messages = $messages;
        $this->rule = Rule::notIn($value);
    }
}
