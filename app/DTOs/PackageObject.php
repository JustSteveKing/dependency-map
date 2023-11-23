<?php

declare(strict_types=1);

namespace App\DTOs;

final readonly class PackageObject
{
    public function __construct(
        public string $name,
        private null|string $description,
        private null|string $homepage,
        private string $license,
        public array $authors,
        private string $source,
        private string $type,
        private array $keywords,
        private array $required,
    ) {
    }

    public static function fromArray(array $data): PackageObject
    {
        return new PackageObject(
            name: $data['name'],
            description: $data['description'],
            homepage: $data['homepage'],
            license: $data['license'][0],
            authors: $data['authors'] ?? [],
            source: $data['source']['url'],
            type: $data['type'],
            keywords: $data['keywords'],
            required: $data['require']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'homepage' => $this->homepage,
            'license' => $this->license,
            'source' => $this->source,
            'type' => $this->type,
            'keywords' => $this->keywords,
            'required' => $this->required,
        ];
    }
}
