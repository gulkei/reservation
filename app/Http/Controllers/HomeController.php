<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class HomeController extends Controller
{

  public function index()
  {
    // カレンダーの作成
    $isoFormatDayMonth = 'MM/DD';
    $isoFormatDayOfWeek = '(ddd)';

    // 年取得
    $year = $this->getYear() . '年';
    // 週間日付取得
    $weeks = $this->getWeek($isoFormatDayMonth);
    // 週間曜日取得
    $dayOfWeek = $this->getWeek($isoFormatDayOfWeek);

    $times = [
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

    return view('home', [
      'year' => $year,
      'weeks' => $weeks,
      'dayOfWeek' => $dayOfWeek,
      'times' => $times
    ]);
  }

  /**
   * 指定したformatに基づく、1週間分の情報を取得
   *
   * @param string $isoFormat
   * @return array
   *
   * 例:
   * $isoFormat = 'MM/DD';
   * $weeks = getWeek($isoFormat);
   * $weeksの中身
   * [
   * '04/01',
   * '04/02',
   * '04/03',
   * '04/04',
   * '04/05',
   * '04/06',
   * '04/07'
   * ]
   *
   */
  public function getWeek($isoFormat)
  {
    $Carbon = new Carbon();
    // 週間日付の数。
    $numDay = 7;
    $weeks = [];

    for ($i = 0; $i < $numDay; $i++) {
      $weeks[$i] = $Carbon->copy()->addDay($i)->isoFormat($isoFormat);
    }

    return $weeks;
  }

  /**
   * 年を取得
   *
   * @return integer
   *
   */
  public function getYear()
  {
    $Carbon = new Carbon();

    return $Carbon->year;
  }
}
