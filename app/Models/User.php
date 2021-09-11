<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int id
 * @property string name
 * @property string email
 * @property Timestamp email_verified_at
 * @property string password
 * @property string remember_token
 * @property Timestamp created_at
 * @property Timestamp updated_at
 *
 * Class User
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function redacaoOpen() : hasOne {
        return $this->hasOne(Redacao::class)->where('finished_at', null);
    }

    public function redacao() : hasOne {
        return $this->hasOne(Redacao::class);
    }

    public function redacoes() : HasMany {
        return $this->hasMany(Redacao::class);
    }

    public function rates() : HasMany {
        return $this->hasMany(Rate::class);
    }

    public function permissions() : HasMany {
        return $this->hasMany(UserPermission::class);
    }

    public function processoUser() {
        return $this->hasMany(ProcessoUser::class);
    }
}
