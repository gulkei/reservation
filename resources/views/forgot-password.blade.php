<x-public.base>
  @section('title', '予約システム - パスワード再設定')
  @section('content')
  <x-public.layouts.header />

  <main class="main">

    <div class="forgot-password">
      <div class="container">
        <h3 class="heading-tertiary">パスワード再設定</h3>
        @if (session('status'))
        <p>{{session('status')}}</p>
        @endif
        @error('email')
        <p class="form__error">{{$message}}</p>
        @enderror
        <form action="{{route('password.email')}}" method="post" class="form">
          @csrf
          <div class="form__group">
            <label for="">メールアドレス</label>
            <input type="email" name="email" required>
          </div>

          <div class="flex margin-top-helper">
            <div class="button-wrap">
              <a href="{{url()->previous()}}" class="button">前の画面に戻る</a>
            </div>

            <div class="button-wrap">
              <input type="submit" class="button" value="送信する">
            </div>
          </div>

        </form>
      </div>
    </div>
  </main>

  <x-public.layouts.footer />
  @endsection
</x-public.base>
