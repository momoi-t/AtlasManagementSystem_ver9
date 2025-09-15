<x-sidebar>
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="calendar-container w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
    <div class="w-75 m-auto inner-calendar">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="calendar">
        {!! $calendar->render() !!}
      </div>
    </div>
  </div>
</div>
</x-sidebar>
