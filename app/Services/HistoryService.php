<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class HistoryService
{

  /**
   * 予約取得
   * @param \App\Models\Reservation $reservation
   */
  public function getReservationPaginate($reservation)
  {
    // user取得
    $user = Auth::user();

    // 予約取得
    $paginator = $reservation->getReservationPaginate($user->id);

    return $paginator;
  }
}
