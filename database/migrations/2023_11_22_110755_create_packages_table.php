<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('packages', static function (Blueprint $table): void {
            $table->ulid('id')->primary();

            $table->string('name');
            $table->string('key');
            $table->string('description')->nullable();
            $table->string('homepage')->nullable();
            $table->string('license');
            $table->string('source');
            $table->string('type');

            $table->json('keywords')->nullable();
            $table->json('required')->nullable();

            $table->unsignedBigInteger('total_downloads')->default(0);
            $table->unsignedBigInteger('monthly_downloads')->default(0);
            $table->unsignedBigInteger('daily_downloads')->default(0);

            $table
                ->foreignUlid('vendor_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
