<x-sidebar>
<div class="vh-100 d-flex">
  <div class="w-50 mt-5">
    <div class="m-3 detail_container">
    <div>
      @if($errors->has('post_title'))
        <span class="error_message">{{ $errors->first('post_title') }}</span>
      @endif
    </div>
    <div>
      @if($errors->has('post_body'))
        <span class="error_message">{{ $errors->first('post_body') }}</span>
      @endif
      </div>
      <div class="p-3">
      @if (Auth::id() === $post->user_id)
        <div class="detail_inner_head">
          @if ($post->subCategories->isNotEmpty())
            <div class="d-flex align-items-center mb-1">
              @foreach ($post->subCategories as $subCategory)
              <span class="badge bg-secondary me-1">{{ $subCategory->sub_category }}</span>
              @endforeach
            </div>
          @endif
          <div>
            <button type="button" class="edit-modal-open btn btn-primary post-detail-btn"
              post_title="{{ $post->post_title }}"
              post_body="{{ $post->post }}"
              post_id="{{ $post->id }}">
              編集
            </button>
            <form method="POST" action="{{ route('post.delete', ['id' => $post->id]) }}" onsubmit="return confirm('本当に削除してもよろしいですか？');" style="display: inline;">
              @csrf
              <button type="submit" class="btn btn-danger">
              削除
              </button>
            </form>
          </div>
        </div>
      @endif

        <div class="contributor d-flex">
          <p>
            <span>{{ $post->user->over_name }}</span>
            <span>{{ $post->user->under_name }}</span>
            さん
          </p>
          <span class="ml-5 post_created_at">{{ $post->created_at }}</span>
        </div>
        <div class="detsail_post_title">{{ $post->post_title }}</div>
        <div class="mt-3 detsail_post">{{ $post->post }}</div>
      </div>
      <div class="p-3">
        <div class="comment_container">
          <span class="">コメント</span>
          @foreach($post->postComments as $comment)
          <div class="comment_area border-top">
            <p>
              <span>{{ $comment->commentUser($comment->user_id)->over_name }}</span>
              <span>{{ $comment->commentUser($comment->user_id)->under_name }}</span>さん
            </p>
            <p>{{ $comment->comment }}</p>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="w-50 p-3">
    <div class="comment_container border m-5">
      <div class="comment_area p-3">
      @if($errors->first('comment'))
      <span class="error_message">{{ $errors->first('comment') }}</span>
      @endif
        <p class="m-0">コメントする</p>
        <textarea class="w-100 form-control-custom" name="comment" form="commentRequest"></textarea>
        <input type="hidden" name="post_id" form="commentRequest" value="{{ $post->id }}">
        <div class="mt-3 post_create_btn">
          <input type="submit" class="btn btn-primary post-submit-btn" form="commentRequest" value="投稿">
          <form action="{{ route('comment.create') }}" method="post" id="commentRequest">{{ csrf_field() }}</form>
        </div>
      </div>
    </div>
  </div>
</div>
<!--編集モーダル-->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close post-edit-modal"></div>
  <div class="post-edit-modal-content">
    <form action="/bulletin_board/edit" method="post">
      <div class="w-100">
        <div class="modal-inner-title w-50 m-auto">
          <input type="text" name="post_title" placeholder="タイトル" class="w-200 form-control-custom">
        </div>
        <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
          <textarea placeholder="投稿内容" name="post_body" class="w-200 form-control-custom"></textarea>
        </div>
        <div class="w-50 m-auto edit-modal-btn d-flex">
          <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
          <input type="hidden" class="edit-modal-hidden" name="post_id" value="">
          <input type="submit" class="btn btn-primary post-detail-btn" value="編集">
        </div>
      </div>
      {{ csrf_field() }}
    </form>
  </div>
</div>
</x-sidebar>
