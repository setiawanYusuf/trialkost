<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Kost;

class Order extends Model
{
    public const READY = 'ready';

    public const BOOKED = 'booked';

    public const PAID = 'paid';

    public const ALLOWED_STATUS = [
        self::READY,
        self::BOOKED,
        self::PAID,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'kost_id',
        'description',
        'room_count',
        'total_price',
        'status',
    ];

    public function user(): Relation
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kost(): Relation
    {
        return $this->belongsTo(Kost::class, 'kost_id');
    }

    public function scopeOwner(Builder $query, $id = null): Builder
    {
        if ($id) {
            return $query->where('user_id', $id);
        }

        $query;
    }
}
