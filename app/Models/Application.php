<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $id
 * @property string $name
 * @property AsArrayObject $composer
 * @property string $project_id
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property Project $project
 * @property Collection<Package> $packages
 */
final class Application extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
        'composer',
        'project_id',
    ];

    protected $casts = [
        'composer' => AsArrayObject::class,
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(
            related: Project::class,
            foreignKey: 'project_id',
        );
    }

    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Package::class,
            table: 'application_package',
        );
    }
}
