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

        <form action="{{route('profile.update')}}" class="form" method="POST">
          @csrf
          @method('PUT')
          <div class="form__area">
            <h4 class="heading-quaternary">会員情報</h4>
            <div class="form__row">
              <x-public.components.form.label option="必須" label="お名前" />
              <x-public.components.form.input type="text" name="name" option="required" value="{{ old('name', $user->name) }}" />
            </div>

            <div class="form__row">
              <x-public.components.form.label option="必須" label="メールアドレス" />
              <x-public.components.form.input type="email" name="email" option="required" value="{{ old('email', $user->email) }}" />
            </div>

            <div class="form__row">
              <x-public.components.form.label option="任意" label="パスワード" />
              <x-public.components.form.input type="password" name="password" />
            </div>

            <div class="form__row">
              <x-public.components.form.label option="任意" label="パスワード再確認" />
              <x-public.components.form.input type="password" name="password_confirmation" />
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
