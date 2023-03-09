<?php

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Annotation\Rule;

use Attribute;
use Hyperf\Validation\Rule;

#[Attribute(Attribute::TARGET_PROPERTY)]
class In extends BaseValidation
{
    public function __construct(private readonly array $value, public string $messages = '')
    {
        $this->rule = Rule::in($this->value);
    }

    public function getValue(): array
    {
        return $this->value;
    }
}
