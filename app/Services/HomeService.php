<?php

namespace App\Services;

use Carbon\Carbon;

class HomeService
{

  /**
   * 年を取得
   *
   * @return string
   *
   */
  public function getYear()
  {
    $Carbon = new Carbon();

    return $Carbon->year . '年';
  }

  /**
   * 指定したformatに基づく、1週間分の情報を取得
   * @return Illuminate\Support\Collection
   *
   * 例:
   * $weeksの中身
   * [
   *  [ 'dayMonth' => '4/01', 'dayOfWeek' => '月'],
   *  [ 'dayMonth' => '4/02', 'dayOfWeek' => '火'],
   *  [ 'dayMonth' => '4/03', 'dayOfWeek' => '水'],
   *  [ 'dayMonth' => '4/04', 'dayOfWeek' => '木'],
   *  [ 'dayMonth' => '4/05', 'dayOfWeek' => '金'],
   *  [ 'dayMonth' => '4/06', 'dayOfWeek' => '土'],
   *  [ 'dayMonth' => '4/07', 'dayOfWeek' => '日'],
   * ]
   */
  public function getWeeks()
  {
    $Carbon = new Carbon();

    $isoFormatDayMonth = 'MM/DD';
    $isoFormatDayOfWeek = '(ddd)';

    // 週間日付の数。
    $numDay = 7;
    $weeks = collect();

    for ($i = 0; $i < $numDay; $i++) {
      $weeks->push([
        'dayMonth' => $Carbon->copy()->addDay($i)->isoFormat($isoFormatDayMonth),
        'dayOfWeek' => $Carbon->copy()->addDay($i)->isoFormat($isoFormatDayOfWeek),
      ]);
    }

    return $weeks;
  }

  /**
   * TODO: modelから取得して動的に変わるようにする
   * 時間を取得
   *
   * @return array
   */
  public function getTime()
  {
    return [
      '10:00',
      '11:00',
      '12:00',
      '13:00',
      '14:00',
      '15:00',
      '16:00',
      '17:00',
      '18:00'
    ];
  }

  /**
   * @return Illuminate\Support\Collection
   */
  public function getCalendar()
  {
    $calendar = collect([
      'year' => $this->getYear(),
      'weeks' => $this->getWeeks(),
      'times' => $this->getTIme(),
    ]);

    return $calendar;
  }
}
