<?php

declare(strict_types=1);

namespace App\Enums;

enum Stability: string
{
    case Dev = 'dev';
    case Alpha = 'alpha';
    case Beta = 'beta';
    case Rc = 'rc';
    case Stable = 'stable';
}
