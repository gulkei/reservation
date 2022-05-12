<x-public.base>
  @section('title', '予約システム - 予約履歴')
  @section('content')
  <x-public.layouts.header />

  <main class="main">
    <div class="history">
      <div class="container">
        <ul class="history__list">
          <li class="flex history__item">
            <dl class="flex">
              <div class="history__box">
                <dt>予約番号</dt>
                <dd>5</dd>
              </div>

              <div class="history__box">
                <dt>予約日時</dt>
                <dd>2022年5月10日(火)<br>11:00</dd>
              </div>

              <div class="history__box">
                <dt>予約項目</dt>
                <dd>オイル交換</dd>
              </div>
            </dl>

            <div class="flex history__buttons">
              <a href="#" class="history__button history__button--green">変更</a>
              <a href="#" class="history__button history__button--red">キャンセル</a>
            </div>
          </li>

          <li class="flex history__item">
            <dl class="flex">
              <div class="history__box">
                <dt>予約番号</dt>
                <dd>4</dd>
              </div>

              <div class="history__box">
                <dt>予約日時</dt>
                <dd>2022年5月10日(火)<br>11:00</dd>
              </div>

              <div class="history__box">
                <dt>予約項目</dt>
                <dd>オイル交換</dd>
              </div>
            </dl>

            <div class="flex history__buttons">
              <a href="#" class="history__button history__button--green">変更</a>
              <a href="#" class="history__button history__button--red">キャンセル</a>
            </div>
          </li>

          <li class="flex history__item">
            <dl class="flex">
              <div class="history__box">
                <dt>予約番号</dt>
                <dd>3</dd>
              </div>

              <div class="history__box">
                <dt>予約日時</dt>
                <dd>2022年5月10日(火)<br>11:00</dd>
              </div>

              <div class="history__box">
                <dt>予約項目</dt>
                <dd>オイル交換</dd>
              </div>
            </dl>

            <div class="flex history__buttons">
              <a href="#" class="history__button history__button--green">変更</a>
              <a href="#" class="history__button history__button--red">キャンセル</a>
            </div>
          </li>
        </ul>

        <div class="button-wrap">
          <a href="{{route('mypage')}}" class="button">マイページへ戻る</a>
        </div>
      </div>
    </div>
  </main>
  <x-public.layouts.footer />
  @endsection
</x-public.base>
