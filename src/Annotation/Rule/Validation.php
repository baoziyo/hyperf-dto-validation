<?php

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Annotation\Rule;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Validation extends BaseValidation
{
    public function __construct(mixed $rule, string $messages = '')
    {
        $this->rule = $rule;
        $this->messages = $messages;
    }
}
