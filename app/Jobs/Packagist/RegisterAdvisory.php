<?php

declare(strict_types=1);

namespace App\Jobs\Packagist;

use App\DTOs\AdvisoryObject;
use App\Services\IngressService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class RegisterAdvisory implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly AdvisoryObject $advisory,
        public readonly string $package,
    ) {
    }

    public function handle(IngressService $service): void
    {
        $service->ensureAdvisory(
            package: $this->package,
            advisory: $this->advisory,
        );
    }
}
