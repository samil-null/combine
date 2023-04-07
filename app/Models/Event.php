<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 * @property string $code
 * @property string $name
 * @property Collection<Property> $properties
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Event extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'code',
    ];

    /**
     * @return HasMany<Property>
     */
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
}
