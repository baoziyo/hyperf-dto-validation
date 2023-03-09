<?php

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Annotation\Rule;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Regex extends BaseValidation
{
    protected mixed $rule = 'regex';

    public function __construct(string $value, string $messages = '')
    {
        $this->messages = $messages;
        $this->rule .= ':' . $value;
    }
}
