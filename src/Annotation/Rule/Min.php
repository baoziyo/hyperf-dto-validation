<?php

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Annotation\Rule;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Min extends BaseValidation
{
    protected mixed $rule = 'min';

    public function __construct(int $value, string $messages = '')
    {
        $this->messages = $messages;
        $this->rule .= ':' . $value;
    }
}
