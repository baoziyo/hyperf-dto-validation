<?php

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Annotation\Rule;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Integer extends BaseValidation
{
    protected mixed $rule = 'integer';
}
