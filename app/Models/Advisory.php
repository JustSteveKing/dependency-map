<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $identifier
 * @property string $affects
 * @property string $remote
 * @property string $title
 * @property string $link
 * @property string $cve
 * @property string $versions
 * @property string $source
 * @property string $severity
 * @property string $package_id
 * @property null|CarbonInterface $reported_at
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property Package $package
 */
final class Advisory extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'identifier',
        'affects',
        'remote',
        'title',
        'link',
        'cve',
        'versions',
        'source',
        'severity',
        'package_id',
        'reported_at',
    ];

    protected $casts = [
        'reported_at' => 'datetime',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(
            related: Package::class,
            foreignKey: 'package_id',
        );
    }
}
