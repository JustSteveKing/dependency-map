<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Ingress;

use App\Enums\Funding;
use App\Enums\License;
use App\Enums\Type;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class ComposerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['require','string','min:2','max:200'],
            'description' => ['required','string'],
            'version' => ['nullable','string'],
            'type' => ['nullable','string',Rule::enum(Type::class)],
            'keywords' => ['nullable','array'],
            'homepage' => ['nullable','string','url'],
            'readme' => ['nullable','string'],
            'time' => ['nullable','date_format:YYYY-MM-DD'],
            'license' => ['required','string',Rule::enum(License::class)],
            'authors' => ['nullable','array'],
            'authors.*.name' => ['nullable','string','min:2','max:255'],
            'authors.*.email' => ['nullable','string','email','min:2','max:255'],
            'authors.*.homepage' => ['nullable','string','url','min:2','max:255'],
            'authors.*.role' => ['nullable','string'],
            'support' => ['nullable','array'],
            'support.email' => ['nullable','string','email','min:2','max:255'],
            'support.issues' => ['nullable','string','url','min:2','max:255'],
            'support.forum' => ['nullable','string','url','min:2','max:255'],
            'support.wiki' => ['nullable','string','url','min:2','max:255'],
            'support.irc' => ['nullable','string','min:2','max:255'],
            'support.source' => ['nullable','string','url','min:2','max:255'],
            'support.docs' => ['nullable','string','url','min:2','max:255'],
            'support.rss' => ['nullable','string','url','min:2','max:255'],
            'support.chat' => ['nullable','string','url','min:2','max:255'],
            'support.security' => ['nullable','string','url','min:2','max:255'],
            'funding' => ['nullable','array'],
            'funding.type' => ['nullable','string',Rule::enum(Funding::class)],
            'funding.url' => ['nullable','string','url','min:2','max:255'],
            'require' => ['required','array'],
            'require-dev' => ['nullable','array'],
            'conflict' => ['nullable','array'],
            'replace' => ['nullable','array'],
            'provide' => ['nullable','array'],
            'suggest' => ['nullable','array'],
            'autoload' => ['required','array'],
            'autoload.psr-4' => ['nullable','array'],
            'autoload.psr-0' => ['nullable','array'],
            'autoload.classmap' => ['nullable','array'],
            'autoload.files' => ['nullable','array'],
            'autoload.exclude-from-classmap' => ['nullable','array'],
            'autoload-dev' => ['nullable','array'],
            'autoload-dev.psr-4' => ['nullable','array'],
            'autoload-dev.psr-0' => ['nullable','array'],
            'autoload-dev.classmap' => ['nullable','array'],
            'autoload-dev.files' => ['nullable','array'],
            'autoload-dev.exclude-from-classmap' => ['nullable','array'],
        ];
    }
}
