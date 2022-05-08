<x-public.base>
  @section('title', '予約システム - マイページ')
  @section('content')
  <x-public.layouts.header />

  <main class="main">
    <div class="register">
      <div class="container">
        <h3 class="heading-tertiary">マイページ</h3>

        <div class="flex margin-top-helper">
          <div class="button-wrap">
            <a href="" class="button">予約履歴</a>
          </div>

          <div class="button-wrap">
            <a href="" class="button">登録情報の編集</a>
          </div>

          <div class="button-wrap">
            <a href="" class="button">退会</a>
          </div>
        </div>
      </div>
    </div>
  </main>

  <x-public.layouts.footer />

  @endsection
</x-public.base>
