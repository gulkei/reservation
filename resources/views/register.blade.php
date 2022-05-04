<x-public.base>
  @section('title', '予約システム - 予約者情報')
  @section('content')
  <x-public.layouts.header />

  <main class="main">
    <div class="register">
      <div class="container">
        <h3 class="heading-tertiary">会員登録</h3>
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form action="{{route('register.create')}}" class="form" method="post">
          @csrf
          <div class="form__area">
            <h4 class="heading-quaternary">会員情報</h4>
            <div class="form__row">
              <label for="" class="form__label">
                <span class="form__select">必須</span>
                <span class="form__title">お名前</span>
              </label>
              <input type="text" class="form__basic" name="name" required>
            </div>

            <div class="form__row">
              <label for="" class="form__label">
                <span class="form__select">必須</span>
                <span class="form__title">メールアドレス</span>
              </label>
              <input type="email" class="form__basic" name="email" required>
            </div>

            <div class="form__row">
              <label for="" class="form__label">
                <span class="form__select">必須</span>
                <span class="form__title">パスワード</span>
              </label>
              <input type="password" class="form__basic" name="password" required>
            </div>

            <div class="form__row">
              <label for="" class="form__label">
                <span class="form__select">必須</span>
                <span class="form__title">パスワード再確認</span>
              </label>
              <input type="password" class="form__basic" name="password_confirmation" required>
            </div>
          </div>

          <div class="form__area">
            <h4 class="heading-quaternary">何かご要望がございましたらご記入ください</h4>

            <textarea name="request" class="form__textarea"></textarea>
          </div>

          <div class="flex margin-top-helper">
            <div class="button-wrap">
              <input type="button" class="button" value="前の画面に戻る">
            </div>

            <div class="button-wrap">
              <input type="submit" class="button" value="確認画面へ">
            </div>
          </div>

        </form>
      </div>
    </div>
  </main>

  <x-public.layouts.footer />
  @endsection
</x-public.base>
