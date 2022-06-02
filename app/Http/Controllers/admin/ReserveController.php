<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;

class ReserveController extends Controller
{

  public function index()
  {
    // カレンダー
    // 7日が6回の配列で取得
    // 空のところは、曜日と日付から差で判別して入れ込む
    $dayOfWeeks = ['日', '月', '火', '水', '木', '金', '土'];

    $carbon = new Carbon();

    // dd($carbon->today()->dayOfWeek);

    // $carbon->addDay(3);
    $today = $carbon->today()->format('j日');

    // 月の初めの曜日取得
    $dayOfWeekNum = $carbon->startOfMonth()->dayOfWeek;

    $calendar = collect();
    // loopで使用
    $weeks = collect();
    // weeksの最終日代入
    $lastDay = 0;
    // loop回数(月の初めから最後までカバーできる 週7日 * 5 = 35)
    $loopNum = 5;

    $format = 'j日';
    $formatMonthDay = 'n月j日';

    for ($j = 0; $j < $loopNum; $j++) {

      // 初回のみ
      if (count($calendar) == 0) {

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
         */
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
      } else {

        for ($i = 0; $i < count($dayOfWeeks); $i++) {
          $addDayNum = $lastDay + $i;
          $weeks->push($carbon->copy()->addDays($addDayNum)->format($format));
        }
      }

      $calendar->push($weeks);

      $date = rtrim((string)$weeks[6], '日');

      $lastDay = $date;

      $weeks = collect();
    }

    // dd($calendar);

    return view('admin.reserve', [
      'calendar' => $calendar,
      'today' => $today,
    ]);
  }
}
