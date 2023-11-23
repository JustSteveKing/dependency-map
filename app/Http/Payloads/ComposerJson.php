<?php

declare(strict_types=1);

namespace App\Http\Payloads;

use App\Enums\License;
use App\Enums\Stability;
use App\Enums\Type;

final readonly class ComposerJson
{
    public function __construct(
        public string         $name,
        public string         $description,
        public null|string    $version,
        public null|Type      $type,
        public null|array     $keywords,
        public null|string    $homepage,
        public null|string    $readme,
        public null|string    $time,
        public License        $license,
        public null|array     $authors,
        public null|object    $support,
        public null|object    $funding,
        public array          $require,
        public null|array     $requireDev,
        public null|array     $conflict,
        public null|array     $replace,
        public null|array     $provide,
        public null|array     $suggest,
        public AutoloadJson    $autoload,
        public AutoloadJson    $autoloadDev,
        public null|Stability $stability,
        public null|bool      $preferStable,
    ) {
    }

    /**
     * @param array<string,mixed> $data
     * @return ComposerJson
     */
    public static function fromArray(array $data): ComposerJson
    {

        $require = [];
        foreach ($data['require'] as $package => $version) {
            $require[] = RequireJson::fromArray([
                'package' => $package,
                'version' => $version,
            ]);
        }
        $requireDev = [];
        foreach ($data['require-dev'] as $package => $version) {
            $requireDev[] = RequireJson::fromArray([
                'package' => $package,
                'version' => $version,
            ]);
        }

        return new ComposerJson(
            name: $data['name'],
            description: $data['description'],
            version: $data['version'] ?? null,
            type: Type::from(
                value: $data['type'],
            ),
            keywords: $data['keywords'] ?? null,
            homepage: $data['homepage'] ?? null,
            readme: $data['readme'] ?? null,
            time: $data['time'] ?? null,
            license: License::from(
                value: $data['license'],
            ),
            authors: \array_map(
                callback: static fn (array $author): AuthorJson => AuthorJson::fromArray(
                    data: $author,
                ),
                array: $data['authors'] ?? [],
            ),
            support: $data['support'] ?? null,
            funding: $data['funding'] ?? null,
            require: $require,
            requireDev: $requireDev,
            conflict: $data['conflict'] ?? null,
            replace: $data['replace'] ?? null,
            provide: $data['provide'] ?? null,
            suggest: $data['suggest'] ?? null,
            autoload: AutoloadJson::fromArray(
                data: $data['autoload'] ?? [],
            ),
            autoloadDev: AutoloadJson::fromArray(
                data: $data['autoload'] ?? [],
            ),
            stability: Stability::from(
                value: $data['minimum-stability'],
            ),
            preferStable: $data['prefer-stable'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'version' => $this->version,
            'type' => $this->type,
            'keywords' => $this->keywords,
            'homepage' => $this->homepage,
            'readme' => $this->readme,
            'time' => $this->time,
            'license' => $this->license,
            'authors' => array_map(
                callback: static fn (AuthorJson $author): array => $author->toArray(),
                array: $this->authors,
            ),
            'support' => $this->support,
            'funding' => $this->funding,
            'require' => $this->require,
            'require-dev' => $this->requireDev,
            'conflict' => $this->conflict,
            'replace' => $this->replace,
            'provider' => $this->provide,
            'suggest' => $this->suggest,
            'autoload' => $this->autoload->toArray(),
            'autoload-dev' => $this->autoloadDev->toArray(),
            'stability' => $this->stability,
            'prefer-stable' => $this->preferStable,
        ];
    }
}
