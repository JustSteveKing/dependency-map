<?php

declare(strict_types=1);

\Laravel\Folio\middleware(['auth']);

\Laravel\Folio\name('pages:index'); ?>

<x-page title="Homepage">
    <div>
        Dashboard
    </div>
</x-page>
