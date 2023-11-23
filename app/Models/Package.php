<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\License;
use App\Enums\Type;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property string $key
 * @property null|string $description
 * @property null|string $homepage
 * @property License $license
 * @property string $source
 * @property Type $type
 * @property AsCollection $keywords
 * @property AsArrayObject $required
 * @property int $total_downloads
 * @property int $monthly_downloads
 * @property int $daily_downloads
 * @property string $vendor_id
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property Vendor $vendor
 * @property Collection<Version> $versions
 * @property Collection<Advisory> $advisories
 * @property Collection<Application> $applications
 * @property Collection<Maintainer> $maintainers
 */
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
        'license' => License::class,
        'type' => Type::class,
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

    public function advisories(): HasMany
    {
        return $this->hasMany(
            related: Advisory::class,
            foreignKey: 'package_id',
        );
    }

    public function applications(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Application::class,
            table: 'application_package',
        );
    }

    public function maintainers(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Maintainer::class,
            table: 'maintainer_package',
        );
    }
}
