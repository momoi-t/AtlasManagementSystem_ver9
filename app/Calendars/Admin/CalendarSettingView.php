<?php
namespace App\Calendars\Admin;
use Carbon\Carbon;
use App\Models\Calendars\ReserveSettings;

class CalendarSettingView{
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
    $html[] = '<table class="table">';
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
        $yesterday = $today->copy()->subDay();
        $tdClass = 'calendar-td ' . $day->getClassName();

        if ($day->everyDay() === '') {
          $tdClass .= ' day-blank';
        } elseif ($day->everyDay() <= $yesterday->format("Y-m-d")) {
          $tdClass .= ' past-day';
        }

        $html[] = '<td class="'.$tdClass.'">';
        $html[] = $day->render();

        $html[] = '<div class="adjust-area">';
        if($day->everyDay()){
          if ($day->everyDay() <= $yesterday->format("Y-m-d")) {
            $html[] = '<p class="d-flex m-0 p-0">1部<input class="w-25" style="height:20px;" name="reserve_day['.$day->everyDay().'][1]" type="text" form="reserveSetting" value="'.$day->onePartFrame($day->everyDay()).'" disabled></p>';
            $html[] = '<p class="d-flex m-0 p-0">2部<input class="w-25" style="height:20px;" name="reserve_day['.$day->everyDay().'][2]" type="text" form="reserveSetting" value="'.$day->twoPartFrame($day->everyDay()).'" disabled></p>';
            $html[] = '<p class="d-flex m-0 p-0">3部<input class="w-25" style="height:20px;" name="reserve_day['.$day->everyDay().'][3]" type="text" form="reserveSetting" value="'.$day->threePartFrame($day->everyDay()).'" disabled></p>';
          }else{
            $html[] = '<p class="d-flex m-0 p-0">1部<input class="w-25" style="height:20px;" name="reserve_day['.$day->everyDay().'][1]" type="text" form="reserveSetting" value="'.$day->onePartFrame($day->everyDay()).'"></p>';
            $html[] = '<p class="d-flex m-0 p-0">2部<input class="w-25" style="height:20px;" name="reserve_day['.$day->everyDay().'][2]" type="text" form="reserveSetting" value="'.$day->twoPartFrame($day->everyDay()).'"></p>';
            $html[] = '<p class="d-flex m-0 p-0">3部<input class="w-25" style="height:20px;" name="reserve_day['.$day->everyDay().'][3]" type="text" form="reserveSetting" value="'.$day->threePartFrame($day->everyDay()).'"></p>';
          }
        }
        $html[] = '</div>';
        $html[] = '</td>';
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    $html[] = '<form action="'.route('calendar.admin.update').'" method="post" id="reserveSetting">'.csrf_field().'</form>';
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
