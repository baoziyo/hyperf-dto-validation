<?php

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Annotation\Rule;

use Attribute;

/**
 * 验证字段必须有和给定值 value 相匹配的尺寸/大小，对字符串而言，value 是相应的字符数目；对数值而言，value 是给定整型值；对数组而言，value 是数组长度；对文件而言，value 是相应的文件千字节数（KB）.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Size extends BaseValidation
{
    protected mixed $rule = 'size';

    public function __construct(int $value, string $messages = '')
    {
        $this->messages = $messages;
        $this->rule .= ':' . $value;
    }
}
