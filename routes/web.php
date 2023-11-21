<?php

declare(strict_types=1);

use App\Http\Controllers\OAuth\GitHub;
use Illuminate\Support\Facades\Route;

Route::get('oauth/redirect', GitHub\RedirectController::class)->name('oauth:redirect');
Route::get('oauth/callback', GitHub\CallbackController::class)->name('oauth:callback');
