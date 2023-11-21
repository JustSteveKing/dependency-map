<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('users', static function (Blueprint $table): void {
            $table->ulid('id');

            $table->string('name');
            $table->string('nickname');
            $table->string('email')->unique();
            $table->string('avatar');
            $table->string('provider_id')->unique();

            $table->text('access_token');
            $table->text('refresh_token')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
