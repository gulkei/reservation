<x-public.base>
  @section('title', '予約システム - ログイン')
  @section('content')
  <x-public.layouts.header />

  <main class="main">
    <div class="login">
      <div class="container">
        <h3 class="heading-tertiary">ログイン</h3>
        <form action="" method="post" class="form">
          <div class="form__group">
            <label for="">ログインID</label>
            <input type="text">
          </div>
          <div class="form__group">
            <label for="">パスワード</label>
            <input type="text">
          </div>
          <p class="form__attention">※パスワードを忘れた方は<a href="#">こちら</a></p>
          <div class="button-wrap margin-top-helper">
            <a href="#" class="button">ログイン</a>
          </div>
        </form>
      </div>
    </div>
  </main>

  <x-public.layouts.footer />
  @endsection
</x-public.base>
