<?php

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Annotation\Rule;

use Attribute;

/**
 * 验证字段必须以某个给定值开头.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class StartsWith extends BaseValidation
{
    protected mixed $rule = 'starts_with';

    public function __construct(string $value, string $messages = '')
    {
        $this->messages = $messages;
        $this->rule .= ':' . $value;
    }
}
