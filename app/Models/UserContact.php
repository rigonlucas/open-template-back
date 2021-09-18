<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property int user_id
 * @property string type
 * @property string contact
 * @property string description
 * @property string hash
 */
class UserContact extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'users_contacts';
    protected $fillable =[
        'user_id',
        'type',
        'contact',
        'hash',
        'description',
    ];
}
