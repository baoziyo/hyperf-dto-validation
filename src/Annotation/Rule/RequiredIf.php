<?php
/*
 * Copyright (c) 2023. ogg. Inc. All Rights Reserved.
 * ogg sit down and start building bugs in sunny weather.
 * Author: Ogg <baoziyoo@gmail.com>.
 * LastChangeTime: 2023-01-16 03:58:14
 * ChangeTime: 2023-04-26 10:21:32
 */

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Annotation\Rule;

use Attribute;

/**
 * 验证字段在 anotherfield 等于指定值 value 时必须存在且不能为空。 如果你想要为 required_if 规则构造更复杂的条件，可以使用 Rule::requiredIf 方法，该方法接收一个布尔值或闭包。当传递一个闭包时，会返回 true 或 false 以表明验证字段是否是必须的：
 * eq: 验证当source字段等于original时，当前字段必填
 * eq: #[RequiredIf(['source' => 'original'])]
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class RequiredIf extends BaseValidation
{
    protected mixed $rule = 'required_if';

    public function __construct(array $value, string $messages = '')
    {
        $this->messages = $messages;
        $data = [];
        foreach ($value as $key => $item) {
            $data[] = $key;
            $data[] = $item;
        }
        $this->rule .= ':' . implode(',', $data);
    }
}
