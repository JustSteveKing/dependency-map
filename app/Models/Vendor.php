<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property string $key
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property Collection<Package> $packages
 */
final class Vendor extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
        'key',
    ];

    public function packages(): HasMany
    {
        return $this->hasMany(
            related: Package::class,
            foreignKey: 'vendor_id',
        );
    }
}
