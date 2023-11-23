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
 * @property string $name
 * @property string $package_id
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property Package $package
 */
final class Version extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
        'package_id',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(
            related: Package::class,
            foreignKey: 'package_id',
        );
    }
}
