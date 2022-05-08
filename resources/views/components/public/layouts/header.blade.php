<header class="header">
  <div class="container header__container">
    <h1 class="header__heading">
      <a href="{{route('home')}}"><img src="{{asset('img/logo.jpg')}}" alt="ロゴ"></a>
    </h1>
    {{-- <nav class="nav">
      <ul class="nav__list">
        <li class="nav__item">
          <a href="" class="nav__link">メニュー一覧</a>
        </li>
        <li class="nav__item">
          <a href="" class="nav__link">店舗一覧</a>
        </li>
        <li class="nav__item">
          <a href="" class="nav__link">コース一覧</a>
        </li>
      </ul>
    </nav> --}}

    @auth
    <div class="main-buttons">
      <div class="button-wrap--small">
        <a href="" class="button">ログアウト</a>
      </div>
      <div class="button-wrap--small">
        <a href="{{route('mypage')}}" class="button">マイページ</a>
      </div>
    </div>
    @endauth

    @guest
    <div class="main-buttons">
      <div class="button-wrap--small">
        <a href="{{route('mypage.login')}}" class="button">ログイン</a>
      </div>
      <div class="button-wrap--small">
        <a href="{{route('register')}}" class="button">会員登録</a>
      </div>
    </div>
    @endguest
  </div>
</header>
