<?php
namespace App\Calendars\General;

use Carbon\Carbon;
use Auth;

class CalendarView{

  private $carbon;
  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    //曜日のヘッダー
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
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
        $isPast = Carbon::parse($day->everyDay())->lt($today);
        // 過去日をpast-dayにする
        $tdClass = 'calendar-td' . ($isPast ? ' past-day' : ' '.$day->getClassName());
        $html[] = '<td class="' . $tdClass . '">';

        $html[] = $day->render();

        //予約済みチェック
        if(in_array($day->everyDay(), $day->authReserveDay())){
          //予約あり
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          if($reservePart == 1){
            $reservePart = "1部参加";
          }else if($reservePart == 2){
            $reservePart = "2部参加";
          }else if($reservePart == 3){
            $reservePart = "3部参加";
          }
          if($isPast){
            //過去日の予約は表示のみ
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px; color:gray;">'. $reservePart .'</p>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }else{
            //未来日の予約は削除ボタン表示
            $html[] = '<button type="submit" class="btn btn-danger p-0 w-75" name="delete_date" style="font-size:12px" value="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'">'. $reservePart .'</button>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }
        }else{
          //予約なし
          $dayDate = Carbon::parse($day->everyDay())->startOfDay();
          $isPast = $dayDate->lt(Carbon::today());
          $isCurrentMonth = $this->carbon->format('Y-m') === $dayDate->format('Y-m');

          if ($isCurrentMonth && $isPast) {
            // 過去日：受付終了
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px; color:gray;">受付終了</p>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          } elseif ($isCurrentMonth && !$isPast) {
            // 未来日：プルダウン表示
            $html[] = $day->selectPart($day->everyDay());
            }
          }
          $html[] = $day->getDate();
          $html[] = '</td>';
        }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    //予約
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';
    //削除
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">'.csrf_field().'</form>';

    return implode('', $html);
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
