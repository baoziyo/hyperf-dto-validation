<?php

declare(strict_types=1);

namespace Baoziyoo\Hyperf\DTO\Validation\Annotation\Contracts;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

#[Attribute(Attribute::TARGET_PARAMETER)]
class Valid extends AbstractAnnotation
{
}
