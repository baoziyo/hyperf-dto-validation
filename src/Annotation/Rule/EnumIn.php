<?php

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Annotation\Rule;

use Attribute;
use Hyperf\Validation\Rule;

#[Attribute(Attribute::TARGET_PROPERTY)]
class EnumIn extends BaseValidation
{
    public function __construct(public string $class, public string $type = 'value', public string $messages = '')
    {
        if ($type === 'value') {
            $this->rule = Rule::in($class::values());
        }

        if ($type === 'key') {
            $this->rule = Rule::in($class::keys());
        }
    }
}
