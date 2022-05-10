<x-public.base>
  @section('title', '予約システム - 予約者情報')
  @section('content')
  <x-public.layouts.header />

  <main class="main">
    <div class="register">
      <div class="container">
        <h3 class="heading-tertiary">予約者情報</h3>
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form action="{{route('temporary.confirm')}}" class="form" method="post">
          @csrf
          <div class="form__area">
            <h4 class="heading-quaternary">基本情報</h4>
            <div class="form__row">
              <x-public.components.form.label option="必須" label="お名前" />
              <x-public.components.form.input type="text" name="name" option="required" value="{{ old('name') }}" />
            </div>

            <div class="form__row">
              <x-public.components.form.label option="必須" label="メールアドレス" />
              <x-public.components.form.input type="email" name="email" option="required" value="{{ old('email') }}" />
            </div>

          </div>

          <div class="form__area">
            <h4 class="heading-quaternary">何かご要望がございましたらご記入ください</h4>

            <textarea name="request" class="form__textarea"></textarea>
          </div>

          <div class="flex margin-top-helper">
            <div class="button-wrap">
              <a href="{{url()->previous()}}" class="button">前の画面に戻る</a>
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
