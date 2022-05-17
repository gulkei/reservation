<x-public.base>
  @section('title', '予約システム - 予約完了')
  @section('content')
  <x-public.layouts.header />

  <main class="main">
    <div class="common-area">
      <div class="container">
        <p class="complete__text">完了しました。</p>
        <p class="complete__text">予約番号 {{ session('reservationId') }}</p>

        <div class="flex margin-top-helper">
          <div class="button-wrap">
            <a href="{{ route('history') }}" class="button">予約履歴へ</a>
          </div>

          <div class="button-wrap">
            <a href="{{route('home')}}" class="button">TOPへ戻る</a>
          </div>
        </div>

      </div>
    </div>
  </main>
  <x-public.layouts.footer />
  @endsection
</x-public.base>
