<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'users_id',
        'name',
        'email',
        'reservation_year',
        'reservation_date',
        'reservation_week',
        'reservation_time',
        'request',
    ];

    /**
     * 予約レコード取得
     */
    public function records()
    {
        return $this->hasMany(ReservationRecord::class, 'reservations_id');
    }

    /**
     * 予約取得
     */
    public function getReservationPaginate($user_id)
    {
        return $this
            ->where('users_id', $user_id)
            ->orderBy('id', 'desc')
            ->paginate(5);
    }
}
