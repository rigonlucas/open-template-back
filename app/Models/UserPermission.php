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
 * @method static create(string[] $array)
 * @method static update(string[] $array)
 */
class UserPermission extends Model
{
    use HasFactory;
    protected $table = 'users_permissions';
    protected $fillable = [
        'user_id',
        'permission',
        'guard',
    ];

    protected $casts =[
      'guard' => 'json'
    ];
}
