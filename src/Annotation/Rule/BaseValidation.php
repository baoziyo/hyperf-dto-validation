<?php
/*
 * Copyright (c) 2023. ogg. Inc. All Rights Reserved.
 * ogg sit down and start building bugs in sunny weather.
 * Author: Ogg <baoziyoo@gmail.com>.
 * LastChangeTime: 2023-01-16 03:58:05
 * ChangeTime: 2023-04-26 10:21:34
 */

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Annotation\Rule;

use Hyperf\Di\Annotation\AbstractAnnotation;

abstract class BaseValidation extends AbstractAnnotation
{
    public string $messages = '';

    protected mixed $rule;

    /**
     * BaseValidation constructor.
     */
    public function __construct(string $messages = '')
    {
        $this->messages = $messages;
    }

    public function getRule(): mixed
    {
        return $this->rule;
    }
}
