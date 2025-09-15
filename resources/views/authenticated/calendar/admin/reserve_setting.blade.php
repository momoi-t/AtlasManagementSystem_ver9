<x-sidebar>
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="calendar-container w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
    <div class="w-75 m-auto inner-calendar">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="calendar">
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="adjust-table-btn w-75 m-auto text-right">
      <input type="submit" class="btn btn-primary" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
    </div>
  </div>
</div>
</x-sidebar>
