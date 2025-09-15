<?php
namespace App\Calendars\Admin;
use Carbon\Carbon;
use App\Models\Users\User;

class CalendarView{
  private $carbon;

  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  public function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table m-auto border">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    //曜日のヘッダー
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th class="day-sat">土</th>';
    $html[] = '<th class="day-sun">日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';
    //週を取得
    $weeks = $this->getWeeks();
    //週ごとに<tr>を作成
    foreach($weeks as $week){
      $html[] = '<tr class="'.$week->getClassName().'">';
      //1週間をループ
      $days = $week->getDays();
      foreach($days as $day){
        //過去日か判定
        $today = Carbon::today();
        $dayDate = $day->everyDay() ? Carbon::parse($day->everyDay())->startOfDay() : null;
        $isPast = $dayDate ? $dayDate->lt($today) : false;
        $dayClass = $day->getClassName();

        // tdクラス付与（Generalと同じロジック）
        $tdClass = 'calendar-td';
        if (!$day->everyDay()) {
          $tdClass .= ' day-blank';
        } elseif ($isPast) {
          $tdClass .= ' past-day ' . $dayClass;
        } else {
          $tdClass .= ' ' . $dayClass;
        }

        $html[] = '<td class="' . $tdClass . '">';

        if ($day->everyDay()) {
          // 日付を表示
          $html[] = $day->render();
          // Admin専用: 予約人数表示
          $html[] = $day->dayPartCounts($day->everyDay());
        }

        $html[] = '</td>';
      }
  $html[] = '</tr>';
}
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';

    return implode("", $html);
  }

  protected function getWeeks(){
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();
    $lastDay = $this->carbon->copy()->lastOfMonth();
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    while($tmpDay->lte($lastDay)){
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}
