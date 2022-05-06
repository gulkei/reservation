<x-public.base>
  @section('title', '予約システム - パスワード再設定')
  @section('content')
  <x-public.layouts.header />

  <main class="main">
    <div class="recive-password">
      <div class="container">
        <h3 class="heading-tertiary">パスワード再設定</h3>
        <form action="{{route('password.update')}}" method="post" class="form">
          @csrf
          <input type="hidden" name="token" value="{{$token}}">

          @error('email')
          <p class="form__error">{{$message}}</p>
          <input type="email" name="email" value="{{$email ?? old('email')}}">
          @else
          <input type="hidden" name="email" value="{{$email}}">
          @enderror


          <div class="form__group">
            @error('password')
            <p class="form__error">{{$message}}</p>
            @enderror
            <label for="">パスワード</label>
            <input type="password" name="password" required>
          </div>

          <div class="form__group">
            <label for="">パスワード再確認</label>
            <input type="password" name="password_confirmation" required>
          </div>

          <div class="button-wrap margin-top-helper">
            <input type="submit" class="button" value="パスワード再設定する">
          </div>
        </form>
      </div>
    </div>
  </main>

  <x-public.layouts.footer />
  @endsection
</x-public.base>
