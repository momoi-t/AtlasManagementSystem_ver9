<x-sidebar>
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p class="post_username"><span class>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <p><a class="post_title" href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
      <div class="post_bottom_area d-flex">
        <!-- カテゴリ表示 -->
        @if ($post->subCategories->isNotEmpty())
          <div class="d-flex align-items-center mb-1">
            @foreach ($post->subCategories as $subCategory)
              <span class="badge bg-secondary me-1">{{ $subCategory->sub_category }}</span>
            @endforeach
          </div>
        @endif

        <div class="d-flex post_status">
          <div class="mr-5 post_icon">
            <i class="fa fa-comment"></i><span class="">{{ $post->postComments->count() }}</span>
          </div>
          <div class="post_icon">
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ $post->likes->count() }}</span></p>
            @else
            <p class="m-0"><i class="far fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ $post->likes->count() }}</span></p>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area border w-25">
    <div class="other_content border m-4 text-center">
      <div class="mb-3">
      <a href="{{ route('post.input') }}" class="btn btn-primary w-100">投稿</a>
      </div>
      <div class="">
        <form action="{{ route('post.show') }}" method="get" id="postSearchRequest" class="keyword-search-form mb-3">
          <input type="text" placeholder="キーワードを検索" name="keyword" class="form-control">
          <button type="submit" class="btn">検索</button>
        </form>
      </div>
      <div class="double-btn-group mb-3">
        <button type="submit" name="like_posts" class="btn btn-pink" form="postSearchRequest">いいねした投稿</button>
        <button type="submit" name="my_posts" class="btn btn-orange" form="postSearchRequest">自分の投稿</button>
      </div>
      <h6 class="text-start">カテゴリー検索</h6>
      <ul class="category-list">
        @foreach($categories as $category)
        <li class="category-item">
          <div class="main-category-header">
          {{ $category->main_category }}
          <span class="arrow-icon"></span>
        </div>
        @if ($category->subCategories->isNotEmpty())
          <ul class="sub_category_list" style="display: none;">
            @foreach($category->subCategories as $subCategory)
              <li>
                <a href="{{ route('post.show', ['category_word' => $subCategory->id]) }}" class="sub-category-link">
                  {{ $subCategory->sub_category }}
                </a>
              </li>
            @endforeach
            </ul>
          @endif
        </li>
        @endforeach
      </ul>
    </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
</x-sidebar>
