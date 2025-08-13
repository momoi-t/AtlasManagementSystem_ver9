<x-sidebar>
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="calendar-container w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
    <div class="w-75 m-auto inner-calendar">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="calendar">
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto reserve_btn">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
    </div>
  </div>
</div>
</x-sidebar>
