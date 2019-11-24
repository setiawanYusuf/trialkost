<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
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

    public function scopeOwner(Builder $query, $id = null): Builder
    {
        if ($id) {
            return $query->where('user_id', $id);
        }

        $query;
    }

    public function scopeName(Builder $query, string $name = null): Builder
    {
        if ($name) {
            return $query->where('name', $name);
        }

        return $query;
    }

    public function scopeCity(Builder $query, string $city = null): Builder
    {
        if ($city) {
            return $query->where('city', $city);
        }

        return $query;
    }

    public function scopePrice(Builder $query, $priceFrom = null, $priceTo = null, $sortPrice = 'asc'): Builder
    {
        if ($priceFrom && $priceTo) {
            return $query->whereBetween('price', [$priceFrom, $priceTo])
                ->orderBy('price', $sortPrice);
        }

        return $query;
    }
}
