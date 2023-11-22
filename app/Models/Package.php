<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Package extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
        'key',
        'description',
        'homepage',
        'license',
        'source',
        'type',
        'keywords',
        'required',
        'total_downloads',
        'monthly_downloads',
        'daily_downloads',
        'vendor_id',
    ];

    protected $casts = [
        'keywords' => AsCollection::class,
        'required' => AsArrayObject::class,
        'total_downloads' => 'integer',
        'monthly_downloads' => 'integer',
        'daily_downloads' => 'integer',
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(
            related: Vendor::class,
            foreignKey: 'vendor_id',
        );
    }

    public function versions(): HasMany
    {
        return $this->hasMany(
            related: Version::class,
            foreignKey: 'package_id',
        );
    }
}
