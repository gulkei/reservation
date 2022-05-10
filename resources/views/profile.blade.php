<x-public.base>
  @section('title', '予約システム - 登録情報の編集')
  @section('content')
  <x-public.layouts.header />

  <main class="main">
    <div class="register">
      <div class="container">
        <h3 class="heading-tertiary">登録情報の編集</h3>
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form action="{{route('profile.update', ['user' => $user])}}" class="form" method="POST">
          @csrf
          @method('PUT')
          <div class="form__area">
            <h4 class="heading-quaternary">会員情報</h4>
            <div class="form__row">
              <label for="" class="form__label">
                <span class="form__select">必須</span>
                <span class="form__title">お名前</span>
              </label>
              <input type="text" class="form__basic" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form__row">
              <label for="" class="form__label">
                <span class="form__select">必須</span>
                <span class="form__title">メールアドレス</span>
              </label>
              <input type="email" class="form__basic" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form__row">
              <label for="" class="form__label">
                <span class="form__select">任意</span>
                <span class="form__title">パスワード</span>
              </label>
              <input type="password" class="form__basic" name="password">
            </div>

            <div class="form__row">
              <label for="" class="form__label">
                <span class="form__select">任意</span>
                <span class="form__title">パスワード再確認</span>
              </label>
              <input type="password" class="form__basic" name="password_confirmation">
            </div>
          </div>

          <div class="flex margin-top-helper">
            <div class="button-wrap">
              <a href="{{url()->previous()}}" class="button">前の画面に戻る</a>
            </div>

            <div class="button-wrap">
              <input type="submit" class="button" value="更新する">
            </div>
          </div>

        </form>
      </div>
    </div>
  </main>

  <x-public.layouts.footer />
  @endsection
</x-public.base>
