<?php

declare(strict_types=1);

namespace App\DTOs;

use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;

final readonly class AdvisoryObject
{
    public function __construct(
        public string $identifier,
        public string $affects,
        public string $remote,
        public string $title,
        public string $link,
        public null|string $cve,
        public string $versions,
        public string $source,
        public null|string $severity,
        public CarbonInterface $reportedAt,
    ) {
    }

    /**
     * @param array<string,mixed> $data
     * @return AdvisoryObject
     */
    public static function fromArray(array $data): AdvisoryObject
    {
        return new AdvisoryObject(
            identifier: $data['advisoryId'],
            affects: $data['packageName'],
            remote: $data['remoteId'],
            title: $data['title'],
            link: $data['link'],
            cve: $data['cve'] ?? null,
            versions: $data['affectedVersions'],
            source: $data['source'],
            severity: $data['severity'] ?? null,
            reportedAt: Carbon::parse(
                time: $data['reportedAt'],
            ),
        );
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return [
            'identifier' => $this->identifier,
            'affects' => $this->affects,
            'remote' => $this->remote,
            'title' => $this->title,
            'link' => $this->link,
            'cve' => $this->cve,
            'versions' => $this->versions,
            'source' => $this->source,
            'severity' => $this->severity,
            'reported_at' => $this->reportedAt,
        ];
    }
}
