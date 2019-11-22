<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Role extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label',
    ];

    public function users(): Relation
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
