<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Kost extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'room',
        'booked_room',
        'city'
    ];

    /**
     * {@inheritDoc}
     */
    protected $attributes = [
        'booked_room' => 0,
        'image_url' => 'http://lorempixel.com/640/480/',
    ];

    public function user(): Relation
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
