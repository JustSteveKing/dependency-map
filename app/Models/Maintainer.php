<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $url
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property Collection<Package> $packages
 */
final class Maintainer extends Model
{
    use HasFactory;
    use HasUlids;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'url',
    ];

    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Package::class,
            table: 'maintainer_package'
        );
    }
}
