<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int user_id
 * @property string permission
 * @property Timestamp created_at
 * @property Timestamp updated_at
 *
 * Class User
 * @package App\Models
 */
class UserPermission extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'permission'
    ];
}
