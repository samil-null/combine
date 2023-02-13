<?php

namespace App\Models;

use App\Enums\Common\DataType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 * @property string $name
 * @property string $code
 * @property Event $event
 * @property Carbon $create_at
 * @property Carbon $updated_at
 */
class Property extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $casts = [
        'type' => DataType::class
    ];

    /**
     * @return BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
