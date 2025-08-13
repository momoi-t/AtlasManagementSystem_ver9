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
        $dayDate = Carbon::parse($day->everyDay())->startOfDay();
        $isPast = $dayDate->lt($today);
        $dayClass = $day->getClassName();
        // 過去日をpast-dayにする
        $tdClass = 'calendar-td';
        if ($isPast) {
            $tdClass .= ' past-day ' . $dayClass;
        } else {
            $tdClass .= ' ' . $dayClass;
        }
        $html[] = '<td class="' . $tdClass . '">';
        $html[] = $day->render();

        //予約済みチェック
        if(in_array($day->everyDay(), $day->authReserveDay())){
          //予約あり
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          //表示
          if($isPast){
            // 過去日用文言で表示
            if($reservePart == 1){
              $reserveLabel = "1部参加";
            }else if($reservePart == 2){
              $reserveLabel = "2部参加";
            }else if($reservePart == 3){
              $reserveLabel = "3部参加";
            }
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px; color:gray;">'. $reserveLabel .'</p>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }else{
            //未来日の予約は削除ボタン表示
            if($reservePart == 1){
              $reserveLabel = "リモ1部";
            }else if($reservePart == 2){
              $reserveLabel = "リモ2部";
            }else if($reservePart == 3){
              $reserveLabel = "リモ3部";
            }
            $reserveDate = $day->authReserveDate($day->everyDay())->first();
            $reserveValue = $reserveDate->id;
            $reserveDateStr = $day->everyDay();
            $reserveTimeStr = $reserveLabel;

            $html[] = '<a href="#" class="btn btn-danger p-0 w-75 open-cancel-modal"'
              . ' data-date="' . $reserveDateStr . '"'
              . ' data-time="' . $reserveTimeStr . '"'
              . ' data-value="' . $reserveValue . '"'
              . ' style="font-size:12px">'
              . $reserveTimeStr
              . '</a>';
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

    $formToken = csrf_token();
    // モーダルHTML
    $html[] = <<<HTML
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="/delete/calendar" method="post">
            <input type="hidden" name="_token" value="{$formToken}">
            <input type="hidden" name="delete_date" id="deleteDateInput">
            <div class="modal-body">
              <p class="mb-2" id="modalDateText" style="font-size:16px;"></p>
              <p class="mb-2" id="modalTimeText" style="font-size:16px;"></p>
              <p class="mt-3" style="font-size:16px;">上記の予約をキャンセルしてもよろしいですか？</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary me-2" data-bs-dismiss="modal">閉じる</button>
              <button type="submit" class="btn btn-danger">キャンセル</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    HTML;

// JavaScript　モーダル用
$html[] = <<<SCRIPT
<script>
document.addEventListener('click', function (e) {
  if (e.target && e.target.classList.contains('open-cancel-modal')) {
    e.preventDefault();
    const button = e.target;
    const date = button.getAttribute('data-date');
    const time = button.getAttribute('data-time');
    const value = button.getAttribute('data-value');

    document.getElementById('modalDateText').textContent = '予約日：' + date;
    document.getElementById('modalTimeText').textContent = '時間：' + time;
    document.getElementById('deleteDateInput').value = value;

    const modal = new bootstrap.Modal(document.getElementById('cancelModal'));
    modal.show();
  }
});
</script>
SCRIPT;

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
