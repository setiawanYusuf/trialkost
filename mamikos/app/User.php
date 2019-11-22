<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public const REGULAR_POINT = 20;

    public const PREMIUM_POINT = 40;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'credit_point',
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

    /**
     * {@inheritDoc}
     */
    protected $attributes = [
        'role_id' => 2,
        'credit_point' => 20
    ];

    public function role(): Relation
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
