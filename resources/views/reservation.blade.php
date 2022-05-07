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
            <x-public.components.form.login :route="$route" :errors="$errors" />
          </div>

          <div class="flex__half">
            <div class="button-wrap">
              <a href="{{ route('register') }}" class="button">新規登録して次へ</a>
            </div>
            <div class="button-wrap margin-top-helper">
              <a href="{{ route('temporary') }}" class="button">新規登録せずに次へ</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>


  <x-public.layouts.footer />

  @endsection
</x-public.base>
