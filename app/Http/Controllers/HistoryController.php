<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ReservationRecord;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{

  protected Reservation $reservation;

  public function __construct(Reservation $reservation)
  {
    $this->reservation = $reservation;
  }

  public function index(Reservation $reservation)
  {
    // user取得
    $user = Auth::user();

    // 予約取得
    $reservations = $reservation->getReservation($user->id);

    return view('history', [
      'reservations' => $reservations,
    ]);
  }
}
