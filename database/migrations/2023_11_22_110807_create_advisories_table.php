<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('advisories', static function (Blueprint $table): void {
            $table->ulid('id')->primary();

            $table->string('identifier'); // advisory identifier
            $table->string('affects'); // package name
            $table->string('remote'); // remote identifier
            $table->string('title');
            $table->string('link');
            $table->string('cve')->nullable();
            $table->string('versions');
            $table->string('source');
            $table->string('severity')->nullable();

            $table
                ->foreignUlid('package_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamp('reported_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('advisories');
    }
};
