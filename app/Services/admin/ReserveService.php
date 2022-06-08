<?php

namespace App\Services\admin;

use Carbon\Carbon;

class ReserveService
{

  /**
   * カレンダー生成
   * @param  App\Models\Reservation $reservation
   * @return Illuminate\Support\Collection
   */
  public function createCalendar($reservation)
  {

    $dayOfWeeks = ['日', '月', '火', '水', '木', '金', '土'];

    $carbon = new Carbon();

    // 月の初め
    $carbon->startOfMonth();

    $reserveAndWeeks = collect();
    $calendar = collect();

    // loop回数(月の初めから最後までカバーできる 週7日 * 5 = 35)
    $loopNum = 5;

    for ($j = 0; $j < $loopNum; $j++) {

      // 初回のみ
      if (count($calendar) == 0) {
        $weeks = $this->dayOfWeeksFirst($carbon, $dayOfWeeks);
      } else {
        $weeks = $this->dayOfWeeks($carbon, $dayOfWeeks, $lastDay);
      }

      $dateAndReserve = $this->dateAndReservation($weeks, $reservation);

      $calendar->push($dateAndReserve);

      $days = explode('月', $weeks[6]);

      $lastDay = rtrim($days[1], '日');

      $weeks = collect();
    }

    return $calendar;
  }


  /**
   * ['date' => $dates, 'reserve' => $reserve]
   * 上の形式の配列を作成
   * @param Illuminate\Support\Collection $weeks
   * @param App\Models\Reservation $reservation
   * @return array
   */
  public function dateAndReservation($weeks, $reservation)
  {
    $reserve = collect();
    $dates = collect();

    // 予約取得
    $reservations = $this->getReservationMonth($reservation);

    foreach ($weeks as $week) {
      $reserves = collect();

      // 日付にあうものだけ予約を取り出す
      foreach ($reservations as $key => $reservation) {
        if ($week == $reservation['reservation_date']) {
          $reserves->push($reservations->pull($key));
        }
      }

      $reserve->push($reserves);
      $dates->push($week);
    }

    return [
      'date' => $dates,
      'reserve' => $reserve,
    ];
  }

  /**
   * [
   * 0 => '5月29日',
   * 1 => '5月30日',
   * 2 => '5月31日',
   * 3 => '6月1日',
   * 4 => '6月2日',
   * 5 => '6月3日',
   * 6 => '6月4日',
   * ]
   *
   * 上の配列の形式を作成
   * 月初の曜日を基準、そこからマイナスしたりプラスしたり
   * @return Illuminate\Support\Collection
   */
  public function dayOfWeeksFirst($carbon, $dayOfWeeks)
  {

    $weeks = collect();

    for ($i = 0; $i < count($dayOfWeeks); $i++) {

      // 日付取得
      $date = $this->date($carbon, $i);

      $weeks->push($date);
    }

    return $weeks;
  }

  /**
   * @return string
   */
  public function date($carbon, $loopIndex)
  {
    $formatMonthDay = 'n月j日';

    // 月の初めの曜日取得
    $dayOfWeekNum = $carbon->dayOfWeek;

    // マイナス
    if ($loopIndex < $dayOfWeekNum) {
      $subDayNum = $dayOfWeekNum - $loopIndex;
      $date = $carbon->copy()->subDays($subDayNum)->format($formatMonthDay);
    } elseif ($loopIndex == $dayOfWeekNum) {
      // 曜日が同じ == 月初
      $date = $carbon->copy()->format($formatMonthDay);
    } else {
      // プラス
      $addDayNum = $loopIndex - $dayOfWeekNum;
      $date = $carbon->copy()->addDays($addDayNum)->format($formatMonthDay);
    }

    return $date;
  }

  /**
   * @return Illuminate\Support\Collection
   */
  public function dayOfWeeks($carbon, $dayOfWeeks, $lastDay)
  {
    $weeks = collect();

    $format = 'n月j日';

    for ($i = 0; $i < count($dayOfWeeks); $i++) {
      $addDayNum = $lastDay + $i;
      $weeks->push($carbon->copy()->addDays($addDayNum)->format($format));
    }

    return $weeks;
  }

  /**
   * @return string
   */
  public function dayOfToday()
  {
    $carbon = new Carbon();

    return $carbon->today()->format('n月j日');
  }

  /**
   * 先月、今月、来月取得
   * @return Illuminate\Support\Collection
   */
  public function lastThisNextMonth()
  {
    $carbon = new Carbon();

    $format = 'n月';

    $thisMonth = $carbon->today()->format($format);
    $lastMonth = $carbon->copy()->startOfMonth()->subDay()->format($format);
    $nextMonth = $carbon->copy()->lastOfMonth()->addDay()->format($format);

    $month = collect([
      'this' => $thisMonth,
      'last' => $lastMonth,
      'next' => $nextMonth,
    ]);

    return $month;
  }

  /**
   * @return string
   */
  public function yearMonth()
  {
    $carbon = new Carbon();

    return $carbon->today()->format('Y年n月');
  }


  /**
   * @param  App\Models\Reservation $reservation
   * @return App\Models\Reservation $reservation
   */
  public function getReservationMonth($reservation)
  {
    $carbon = new Carbon();

    $month = $carbon->format('n月');
    $reservation = $reservation->getReservationMonth($month);

    return $reservation;
  }
}
