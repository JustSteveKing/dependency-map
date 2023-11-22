<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
