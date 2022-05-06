<x-public.base>
  @section('title', '予約システム - ログイン')
  @section('content')
  <x-public.layouts.header />

  <main class="main">
    <div class="login">
      <div class="container">
        @if (session('status'))
        <p>{{session('status')}}</p>
        @endif
        <h3 class="heading-tertiary">ログイン</h3>
        <x-public.components.form.login :route="$route" :errors="$errors" />
      </div>
    </div>
  </main>

  <x-public.layouts.footer />
  @endsection
</x-public.base>
