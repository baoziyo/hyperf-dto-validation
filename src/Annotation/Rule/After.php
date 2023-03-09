<?php

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Annotation\Rule;

use Attribute;

/**
 * 验证字段必须是给定日期之后的一个值，日期将会通过 PHP 函数 strtotime 传递.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class After extends BaseValidation
{
    protected mixed $rule = 'after';

    public function __construct(string $date, string $messages = '')
    {
        $this->messages = $messages;
        $this->rule .= ':' . $date;
    }
}
