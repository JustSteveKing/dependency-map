<?php

declare(strict_types=1);

namespace App\Jobs\Ingress;

use App\Http\Payloads\ComposerJson;
use App\Jobs\Packagist\FetchPackageInsights;
use App\Services\IngressService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class ProcessComposerUpload implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly string $project,
        public readonly ComposerJson $composer,
    ) {
    }

    public function handle(IngressService $service, Dispatcher $bus): void
    {
        $application = $service->ensureApplication(
            project: $this->project,
            payload: $this->composer,
        );

        foreach (array_merge($this->composer->require, $this->composer->requireDev) as $package) {
            $bus->dispatch(
                command: new FetchPackageInsights(
                    name: $package->package,
                    application: $application->getKey(),
                ),
            );
        }
    }
}
