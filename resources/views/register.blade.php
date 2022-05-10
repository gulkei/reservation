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

        <form action="{{route('register.create', ['keyword' => $keyword])}}" class="form" method="post">
          @csrf
          <div class="form__area">
            <h4 class="heading-quaternary">会員情報</h4>
            <div class="form__row">
              <x-public.components.form.label option="必須" label="お名前" />
              <x-public.components.form.input type="text" name="name" option="required" value="{{ old('name') }}" />
            </div>

            <div class="form__row">
              <x-public.components.form.label option="必須" label="メールアドレス" />
              <x-public.components.form.input type="email" name="email" option="required" value="{{ old('email') }}" />
            </div>

            <div class="form__row">
              <x-public.components.form.label option="必須" label="パスワード" />
              <x-public.components.form.input type="password" name="password" option="required" />
            </div>

            <div class="form__row">
              <x-public.components.form.label option="必須" label="パスワード再確認" />
              <x-public.components.form.input type="password" name="password_confirmation" option="required" />
            </div>
          </div>

          @if (Str::contains($keyword, 'reservation'))
          <div class="form__area">
            <h4 class="heading-quaternary">何かご要望がございましたらご記入ください</h4>

            <textarea name="request" class="form__textarea"></textarea>
          </div>
          @else
          <input type="hidden" name="request" class="form__textarea" />
          @endif

          <div class="flex margin-top-helper">
            <div class="button-wrap">
              <a href="{{url()->previous()}}" class="button">前の画面に戻る</a>
            </div>

            <div class="button-wrap">
              @if (Str::contains($keyword, 'reservation'))
              <input type="submit" class="button" value="確認画面へ">
              @else
              <input type="submit" class="button" value="登録する">
              @endif
            </div>
          </div>

        </form>
      </div>
    </div>
  </main>

  <x-public.layouts.footer />
  @endsection
</x-public.base>
