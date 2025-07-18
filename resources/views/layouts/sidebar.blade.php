<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>AtlasBulletinBoard</title>

        <!-- Fonts -->
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap JS (bundle) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Oswald:wght@200&display=swap" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </head>
    <body class="all_content">
        <div class="d-flex">
            <div class="sidebar">
                <p><a href="{{ route('top.show') }}">
                <img src="{{ asset('image/house.png') }}" alt="マイページ" class="sidebar-icon">
                マイページ</a></p>
                <p><a href="/logout">
                <img src="{{ asset('image/logout-line.png') }}" alt="ログアウト" class="sidebar-icon">
                ログアウト</a></p>
                <p><a href="{{ route('calendar.general.show',['user_id' => Auth::id()]) }}">
                <img src="{{ asset('image/calendar-text.png') }}" alt="スクール予約" class="sidebar-icon">
                スクール予約</a></p>
                <!--講師のみに表示-->
                @if(Auth::check() && Auth::user()->isInstructor())
                    <p><a href="{{ route('calendar.admin.show',['user_id' => Auth::id()]) }}">
                    <img src="{{ asset('image/calendar-check.png') }}" alt="スクール予約確認" class="sidebar-icon">
                    スクール予約確認</a></p>
                    <p><a href="{{ route('calendar.admin.setting',['user_id' => Auth::id()]) }}">
                    <img src="{{ asset('image/edit-calendar.png') }}" alt="スクール枠登録" class="sidebar-icon">
                    スクール枠登録</a></p>
                @endif
                <!-- -->
                <p><a href="{{ route('post.show') }}">
                <img src="{{ asset('image/chat.png') }}" alt="掲示板" class="sidebar-icon">
                掲示板</a></p>
                <p><a href="{{ route('user.show') }}">
                <img src="{{ asset('image/group.png') }}" alt="ユーザー検索" class="sidebar-icon">ユーザー検索</a></p>
            </div>
            <div class="main-container">
                {{ $slot }}
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="{{ asset('js/bulletin.js') }}" rel="stylesheet"></script>
        <script src="{{ asset('js/user_search.js') }}" rel="stylesheet"></script>
        <script src="{{ asset('js/calendar.js') }}" rel="stylesheet"></script>
    </body>
</html>
