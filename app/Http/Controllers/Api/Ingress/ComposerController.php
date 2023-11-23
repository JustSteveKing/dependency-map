<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Ingress;

use App\Http\Requests\Api\Ingress\ComposerRequest;
use App\Jobs\Ingress\ProcessComposerUpload;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final readonly class ComposerController
{
    public function __construct(
        private Dispatcher $bus,
    ) {
    }

    public function __invoke(ComposerRequest $request): JsonResponse
    {
        $this->bus->dispatch(
            command: new ProcessComposerUpload(
                project: $request->string('project')->toString(),
                composer: $request->payload(),
            ),
        );

        return new JsonResponse(
            data: [
                'message' => 'Required is being processed',
            ],
            status: Response::HTTP_ACCEPTED,
        );
    }
}
