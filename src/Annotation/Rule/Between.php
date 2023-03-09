<?php

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Annotation\Rule;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Between extends BaseValidation
{
    protected mixed $rule = 'between';

    public function __construct(int $min, int $max, string $messages = '')
    {
        $this->rule .= ':' . $min . ',' . $max;
        $this->messages = $messages;
    }
}
