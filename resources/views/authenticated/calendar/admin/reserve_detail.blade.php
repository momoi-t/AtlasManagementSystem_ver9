<x-sidebar>
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="w-75 m-auto h-75">
    <p><span>{{ \Carbon\Carbon::parse($date)->format('Y年m月d日') }}</span><span class="ml-3">　{{ $part }}部</span></p>
    <div class="reserve_table_container">
      <table class="reserve_table text-center">
        <thead>
        <tr>
          <th>ID</th>
          <th>名前</th>
          <th>場所</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($reservePersons as $reserve)
            @foreach ($reserve->users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->over_name }} {{ $user->under_name }}</td>
                <td>リモート</td>
              </tr>
            @endforeach
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</x-sidebar>
