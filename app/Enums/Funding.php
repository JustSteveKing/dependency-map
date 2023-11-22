<?php

declare(strict_types=1);

namespace App\Enums;

enum Funding: string
{
    case Patreon = 'patreon';
    case OpenCollective = 'opencollective';
    case Tidelift = 'tidelift';
    case GitHub = 'github';
}
