<x-public.base>
  @section('title', '予約システム - パスワード再設定')
  @section('content')
  <x-public.layouts.header />

  <main class="main">

    <div class="send-password">
      <div class="container">
        <h3 class="heading-tertiary">パスワード再設定</h3>
        <form action="" method="post" class="form">
          <div class="form__group">
            <label for="">メールアドレス</label>
            <input type="email">
          </div>
          <div class="button-wrap margin-top-helper">
            <a href="#" class="button">送信する</a>
          </div>
        </form>
      </div>
    </div>
  </main>

  <x-public.layouts.footer />
  @endsection
</x-public.base>
