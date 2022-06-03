<?php

namespace App\Services\admin;

use Carbon\Carbon;

class ReserveService
{

  /**
   * カレンダー生成
   * @return Illuminate\Support\Collection
   */
  public function createCalendar()
  {

    $dayOfWeeks = ['日', '月', '火', '水', '木', '金', '土'];

    $carbon = new Carbon();

    // 月の初め
    $carbon->startOfMonth();

    $calendar = collect();

    // weeksの最終日代入
    $lastDay = 0;
    // loop回数(月の初めから最後までカバーできる 週7日 * 5 = 35)
    $loopNum = 5;

    for ($j = 0; $j < $loopNum; $j++) {

      // 初回のみ
      if (count($calendar) == 0) {
        $weeks = $this->dayOfWeeksFirst($carbon, $dayOfWeeks);
      } else {
        $weeks = $this->dayOfWeeks($carbon, $dayOfWeeks, $lastDay);
      }

      $calendar->push($weeks);

      $date = rtrim((string)$weeks[6], '日');

      $lastDay = $date;

      $weeks = collect();
    }

    return $calendar;
  }

  /**
   * [
   * 0 => '29',
   * 1 => '30',
   * 2 => '31',
   * 3 => '1',
   * 4 => '2',
   * 5 => '3',
   * 6 => '4',
   * ]
   *
   * 上の配列の形式を作成
   * 月初の曜日を基準、そこからマイナスしたりプラスしたり
   * @return Illuminate\Support\Collection
   */
  public function dayOfWeeksFirst($carbon, $dayOfWeeks)
  {

    $weeks = collect();

    $format = 'j日';
    $formatMonthDay = 'n月j日';

    // 月の初めの曜日取得
    $dayOfWeekNum = $carbon->dayOfWeek;

    for ($i = 0; $i < count($dayOfWeeks); $i++) {

      // マイナス
      if ($i < $dayOfWeekNum) {
        $subDayNum = $dayOfWeekNum - $i;
        $weeks->push($carbon->copy()->subDays($subDayNum)->format($format));
      } elseif ($i == $dayOfWeekNum) {
        // 曜日が同じ == 月初
        $weeks->push($carbon->copy()->format($formatMonthDay));
      } else {
        // プラス
        $addDayNum = $i - $dayOfWeekNum;
        $weeks->push($carbon->copy()->addDays($addDayNum)->format($format));
      }
    }

    return $weeks;
  }

  /**
   * @return Illuminate\Support\Collection
   */
  public function dayOfWeeks($carbon, $dayOfWeeks, $lastDay)
  {
    $weeks = collect();

    $format = 'j日';

    for ($i = 0; $i < count($dayOfWeeks); $i++) {
      $addDayNum = $lastDay + $i;
      $weeks->push($carbon->copy()->addDays($addDayNum)->format($format));
    }

    return $weeks;
  }

  /**
   * @return string
   */
  public function getDayOfToday()
  {
    $carbon = new Carbon();

    return $carbon->today()->format('j日');
  }

  /**
   * @return string
   */
  public function getYearMonth()
  {
    $carbon = new Carbon();

    return $carbon->today()->format('Y年n月');
  }
}
