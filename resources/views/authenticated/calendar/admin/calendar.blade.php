<x-sidebar>
<div class="w-75 m-auto admin-page">
  <div class="w-100">
    <p>{{ $calendar->getTitle() }}</p>
    <p>{!! $calendar->render() !!}</p>
  </div>
</div>
</x-sidebar>
