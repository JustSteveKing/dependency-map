<?php

declare(strict_types=1);

namespace App\Enums;

enum Type: string
{
    case Library = 'library';
    case Project = 'project';
    case MetaPackage = 'metapackage';
    case ComposerPlugin = 'composer-plugin';
}
