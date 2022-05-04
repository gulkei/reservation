<x-public.base>
  @section('title', '予約システム - 予約者情報')
  @section('content')
  <x-public.layouts.header />

  <main class="main">
    <div class="login-register">
      <div class="container">
        <h3 class="heading-tertiary">予約者情報</h3>
        <div class="flex">
          <div class="flex__half">
            <form action="{{route('login')}}" method="post" class="form">
              @csrf
              <div class="form__group">
                <label for="">メールアドレス</label>
                <input type="email" name="email" required>
              </div>
              <div class="form__group">
                <label for="">パスワード</label>
                <input type="password" name="password" required>
              </div>
              <div class="button-wrap">
                <input type="submit" class="button" value="ログイン">
              </div>
            </form>
          </div>

          <div class="flex__half">
            <div class="button-wrap">
              <a href="{{ route('register') }}" class="button">新規登録して次へ</a>
            </div>
            <div class="button-wrap margin-top-helper">
              <a href="#" class="button">新規登録せずに次へ</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>


  <x-public.layouts.footer />

  @endsection
</x-public.base>
