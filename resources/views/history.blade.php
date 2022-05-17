<x-public.base>
  @section('title', '予約システム - 予約履歴')
  @section('content')
  <x-public.layouts.header />

  <main class="main">
    <div class="history">
      <div class="container">
        @if (count($reservations))
        <ul class="history__list">
          @foreach ($reservations as $reservation)
          <li class="flex history__item">
            <dl class="flex">
              <div class="history__box">
                <dt>予約番号</dt>
                <dd>{{ $reservation->id }}</dd>
              </div>

              <div class="history__box">
                <dt>予約日時</dt>
                <dd>{{ $reservation->reservation_year }}{{ $reservation->reservation_date }}<br>{{ $reservation->reservation_time }}</dd>
              </div>

              <div class="history__box">
                <dt>予約項目</dt>
                <dd>
                  @foreach ($reservation->records as $record)
                  {{ $record->item }}
                  @endforeach
                </dd>
              </div>
            </dl>

            <div class="flex history__buttons">
              <a href="#" class="history__button history__button--green">変更</a>
              <a href="#" class="history__button history__button--red">キャンセル</a>
            </div>
          </li>
          @endforeach
        </ul>

        @else
        <p>まだ予約されていません。</p>
        @endif
        <div class="button-wrap">
          <a href="{{ route('mypage') }}" class="button">マイページへ戻る</a>
        </div>
      </div>
    </div>
  </main>
  <x-public.layouts.footer />
  @endsection
</x-public.base>
