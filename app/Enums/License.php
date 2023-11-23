<?php

declare(strict_types=1);

namespace App\Enums;

enum License: string
{
    case Apache = 'Apache-2.0';
    case Bsd_2 = 'BSD-2-Clause';
    case Bsd_3 = 'BSD-3-Clause';
    case Bsd_4 = 'BSD-4-Clause';
    case Gpl_2 = 'GPL-2.0-only';
    case Gpl_3 = 'GPL-3.0-only';
    case Lgpl_2 = 'LGPL-2.1-only';
    case Lgpl_3 = 'LGPL-3.0-only';
    case Mit = 'MIT';
    case Proprietary = 'Proprietary';

    case Unknown = 'unknown';
}
