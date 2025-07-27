<x-sidebar>
<div class="search_content w-100 border d-flex">
  <div class="reserve_users_area">
    @foreach($users as $user)
    <div class="border one_person">
      <div class="info-block">
        <span class="label">ID : </span><span>{{ $user->id }}</span>
      </div>
      <div class="info-block">
        <span class="label">名前 : </span>
        <a href="{{ route('user.profile', ['id' => $user->id]) }}" class="name-link">
          <span>{{ $user->over_name }}</span>
          <span>{{ $user->under_name }}</span>
        </a>
      </div>
      <div class="compact-block">
        <span class="label">カナ : </span>
        <span>({{ $user->over_name_kana }}</span>
        <span>{{ $user->under_name_kana }})</span>
      </div>
      <div>
        @if($user->sex == 1)
        <span class="label">性別 : </span><span>男</span>
        @elseif($user->sex == 2)
        <span class="label">性別 : </span><span>女</span>
        @else
        <span class="label">性別 : </span><span>その他</span>
        @endif
      </div>
      <div>
        <span class="label">生年月日 : </span><span>{{ $user->birth_day }}</span>
      </div>
      <div class="info-block">
        @if($user->role == 1)
        <span class="label">役職 : </span><span>教師(国語)</span>
        @elseif($user->role == 2)
        <span class="label">役職 : </span><span>教師(数学)</span>
        @elseif($user->role == 3)
        <span class="label">役職 : </span><span>講師(英語)</span>
        @else
        <span class="label">役職 : </span><span>生徒</span>
        @endif
      </div>
      <div class="compact-block">
        @if($user->role == 4)
        <span class="label">選択科目 :</span>
          @if($user->subjects->isNotEmpty())
            @foreach($user->subjects as $subject)
            <span>{{ $subject->subject }}</span>
            @endforeach
          @else
          <span>未選択</span>
          @endif
        @endif
      </div>
    </div>
    @endforeach
  </div>
  <div class="search_area w-25 border">
    <div class="other_content border m-4">
      <h3 class="mb-3" style="font-size: 18px;">検索</h3>
      <div class="mb-3">
        <input type="text" class="input_custom" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
      </div>
      <div class="mb-3">
        <label>カテゴリ</label>
        <div style="display: flex; flex-wrap: wrap;">
        <select class="input_custom_compact"  form="userSearchRequest" name="category">
          <option value="name">名前</option>
          <option value="id">社員ID</option>
        </select>
        </div>
      </div>
      <div class="mb-3">
        <label>並び替え</label>
        <div style="display: flex; flex-wrap: wrap;">
        <select name="updown" class="input_custom_compact" form="userSearchRequest">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
        </div>
      </div>

      <div class="">
        <p class="main-category-header search-toggle" style="cursor: pointer;">検索条件の追加<span class="arrow-icon"></span></p>

        <div class="sub_category_list search-conditions" style="display: none;">
          <div class="mb-3">
            <label>性別</label>
            <div style="display: flex; flex-wrap: wrap;" class="select_control">
            <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
            <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
            <span>その他</span><input type="radio" name="sex" value="3" form="userSearchRequest">
            </div>
          </div>
          <div class="mb-3">
            <label>権限</label>
            <div style="display: flex; flex-wrap: wrap;">
            <select name="role" form="userSearchRequest" class="engineer input_custom_compact ">
              <option selected disabled>----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4" class="">生徒</option>
            </select>
            </div>
          </div>
          <div class="selected_engineer mb-3">
            <label>選択科目</label>
            <div style="display: flex; flex-wrap: wrap;" class="select_control">
              @foreach($subjects as $subject)
              <label style="margin-right: 10px;">
                <input type="checkbox" name="subject_ids[]" value="{{ $subject->id }}"
               form="userSearchRequest">
                {{ $subject->subject }}
              </label>
              @endforeach
            </div>
        </div>
      </div>
      <div>
        <input type="submit"  class="btn btn-primary w-100 me-2" name="search_btn" value="検索" form="userSearchRequest">
      </div>
      <div>
        <input type="reset" value="リセット" class="w-100 reset_btn" form="userSearchRequest" style="border: none;">
    </div>
      </div>
    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
</div>
</x-sidebar>
