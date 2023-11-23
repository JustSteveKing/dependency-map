<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Ingress;

use App\Enums\Funding;
use App\Enums\License;
use App\Enums\Stability;
use App\Enums\Type;
use App\Http\Payloads\ComposerJson;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class ComposerRequest extends FormRequest
{
    /**
     * @return array<string,array<int,mixed>>
     */
    public function rules(): array
    {
        return [
            'project' => ['required','string','exists:projects,id'],
            'composer.name' => ['required','string','min:2','max:200'],
            'composer.description' => ['required','string'],
            'composer.version' => ['nullable','string'],
            'composer.type' => ['nullable','string',Rule::enum(Type::class)],
            'composer.keywords' => ['nullable','array'],
            'composer.homepage' => ['nullable','string','url'],
            'composer.readme' => ['nullable','string'],
            'composer.time' => ['nullable','date_format:YYYY-MM-DD'],
            'composer.license' => ['required','string',Rule::enum(License::class)],
            'composer.authors' => ['nullable','array'],
            'composer.authors.*.name' => ['nullable','string','min:2','max:255'],
            'composer.authors.*.email' => ['nullable','string','email','min:2','max:255'],
            'composer.authors.*.homepage' => ['nullable','string','url','min:2','max:255'],
            'composer.authors.*.role' => ['nullable','string'],
            'composer.support' => ['nullable','array'],
            'composer.support.email' => ['nullable','string','email','min:2','max:255'],
            'composer.support.issues' => ['nullable','string','url','min:2','max:255'],
            'composer.support.forum' => ['nullable','string','url','min:2','max:255'],
            'composer.support.wiki' => ['nullable','string','url','min:2','max:255'],
            'composer.support.irc' => ['nullable','string','min:2','max:255'],
            'composer.support.source' => ['nullable','string','url','min:2','max:255'],
            'composer.support.docs' => ['nullable','string','url','min:2','max:255'],
            'composer.support.rss' => ['nullable','string','url','min:2','max:255'],
            'composer.support.chat' => ['nullable','string','url','min:2','max:255'],
            'composer.support.security' => ['nullable','string','url','min:2','max:255'],
            'composer.funding' => ['nullable','array'],
            'composer.funding.type' => ['nullable','string',Rule::enum(Funding::class)],
            'composer.funding.url' => ['nullable','string','url','min:2','max:255'],
            'composer.require' => ['required','array'],
            'composer.require-dev' => ['nullable','array'],
            'composer.conflict' => ['nullable','array'],
            'composer.replace' => ['nullable','array'],
            'composer.provide' => ['nullable','array'],
            'composer.suggest' => ['nullable','array'],
            'composer.autoload' => ['required','array'],
            'composer.autoload.psr-4' => ['nullable','array'],
            'composer.autoload.psr-0' => ['nullable','array'],
            'composer.autoload.classmap' => ['nullable','array'],
            'composer.autoload.files' => ['nullable','array'],
            'composer.autoload.exclude-from-classmap' => ['nullable','array'],
            'composer.autoload-dev' => ['nullable','array'],
            'composer.autoload-dev.psr-4' => ['nullable','array'],
            'composer.autoload-dev.psr-0' => ['nullable','array'],
            'composer.autoload-dev.classmap' => ['nullable','array'],
            'composer.autoload-dev.files' => ['nullable','array'],
            'composer.autoload-dev.exclude-from-classmap' => ['nullable','array'],
            'composer.minimum-stability' => ['nullable',Rule::enum(Stability::class)],
            'composer.prefer-stable' => ['nullable','boolean'],
        ];
    }

    public function payload(): ComposerJson
    {
        return ComposerJson::fromArray(
            data: $this->validated(key: 'composer'),
        );
    }
}
