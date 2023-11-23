<?php

declare(strict_types=1);

namespace App\Http\Payloads;

final readonly class AutoloadJson
{
    public function __construct(
        public array $psr4,
        public array $psr0,
        public array $classmap,
        public array $files,
        public array $exclude,
    ) {
    }

    /**
     * @param array<string,array<string,string>> $data
     * @return AutoloadJson
     */
    public static function fromArray(array $data): AutoloadJson
    {
        return new AutoloadJson(
            psr4: $data['psr-4'] ?? [],
            psr0: $data['psr-0'] ?? [],
            classmap: $data['classmap'] ?? [],
            files: $data['files'] ?? [],
            exclude: $data['exclude-from-classmap'] ?? [],
        );
    }

    public function toArray(): array
    {
        return [
            'psr-4' => $this->psr4,
            'psr-0' => $this->psr0,
            'classmap' => $this->classmap,
            'files' => $this->files,
            'exclude-from-classmap' => $this->exclude,
        ];
    }
}
