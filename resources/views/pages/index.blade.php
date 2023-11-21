<?php

declare(strict_types=1);

\Laravel\Folio\name('pages:index'); ?>


<x-page title="Homepage">
    @guest
        <a href="{{ route('oauth:redirect') }}">
            Login with GitHub
        </a>
    @else
        <p>{{ auth()->user()?->nickname }}</p>
    @endguest
</x-page>
