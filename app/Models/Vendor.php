<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
