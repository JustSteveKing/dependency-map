<?php

declare(strict_types=1);

namespace App\Http\Payloads;

final readonly class AuthorJson
{
    public function __construct(
        public null|string $name,
        public null|string $email,
        public null|string $homepage,
        public null|string $role,
    ) {
    }

    public static function fromArray(array $data): AuthorJson
    {
        return new AuthorJson(
            name: $data['name'] ?? null,
            email: $data['email'] ?? null,
            homepage: $data['homepage'] ?? null,
            role: $data['role'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'homepage' => $this->homepage,
            'role' => $this->role,
        ];
    }
}
