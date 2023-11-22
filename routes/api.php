<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Ingress;
use Illuminate\Support\Facades\Route;

Route::post('ingress/composer', Ingress\ComposerController::class)->name('ingress:composer');
