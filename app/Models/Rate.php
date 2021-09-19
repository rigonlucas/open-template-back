<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int user_id
 * @property string text
 * @property int rate_points
 *
 * @property-read user $user
 * class Rate
 * @package App\Rate
 * @method static create(string[] $array)
 * @method static update(string[] $array)
 */
class Rate extends Model
{
    use HasFactory;
    protected $fillable = [
        "id",
        "user_id",
        "text",
        "rate_points",
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
