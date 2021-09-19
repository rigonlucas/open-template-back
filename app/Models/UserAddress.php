<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property int user_id
 * @property string postal_code
 * @property string address
 * @property int number
 * @property string complement
 * @property string reference
 * @property string hash
 *
 * Class UserAddress
 * @package App\Models
 * @method static create(string[] $array)
 * @method static update(string[] $array)
 */
class UserAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'users_addresses';

    protected $fillable =[
        'postal_code',
        'address',
        'number',
        'complement',
        'reference',
        'user_id',
        'hash',
    ];


}
