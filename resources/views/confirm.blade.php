<x-public.base>
  @section('title', '予約システム - 内容確認')
  @section('content')
  <x-public.layouts.header />

  <main class="main">

    <div class="confirm">
      <div class="container">
        <div class="confirm__head">
          <h3 class="heading-tertiary">内容確認</h3>
          <p class="confirm__text">内容に間違いがなければ予約するボタンを押してください。</p>
        </div>

        <div class="confirm__content">

          <div class="section-quaternary">
            <h4 class="heading-quaternary">予約内容</h4>
            <dl class="confirm__definition-list">
              <div class="confirm__definition-box">
                <dt>メニュー</dt>
                <dd>{{ $reservationInfo['menu'] }}</dd>
              </div>
              <div class="confirm__definition-box">
                <dt>日時</dt>
                <dd>{{ $reservationInfo['year'] }} {{ $reservationInfo['date'] }}({{ $reservationInfo['dayOfWeek'] }}) {{ $reservationInfo['time'] }}〜</dd>
              </div>
            </dl>
          </div>

          <div class="section-quaternary">
            <h4 class="heading-quaternary">予約者情報</h4>
            @if (empty(session()->get('route')))

            <dl class="confirm__definition-list">
              <div class="confirm__definition-box">
                <dt>お名前</dt>
                <dd>{{ $reservationInfo['user']->name }}</dd>
              </div>
              <div class="confirm__definition-box">
                <dt>メールアドレス</dt>
                <dd>{{ $reservationInfo['user']->email }}</dd>
              </div>
            </dl>
            @else

            <dl class="confirm__definition-list">
              <div class="confirm__definition-box">
                <dt>お名前</dt>
                <dd>{{ $reservationInfo['user']['name'] }}</dd>
              </div>
              <div class="confirm__definition-box">
                <dt>メールアドレス</dt>
                <dd>{{ $reservationInfo['user']['email'] }}</dd>
              </div>
            </dl>
            @endif
          </div>

          <form action="{{ route('reservation.store') }}" method="post" class="form">
            @csrf

            @if (session()->get('route'))
              <input type="hidden" name="name" value="{{ $reservationInfo['user']['name'] }}">
              <input type="hidden" name="email" value="{{ $reservationInfo['user']['email'] }}">
            @endif


            <div class="form__group">
              <h4 class="heading-quaternary">何かご要望がございましたらご記入ください</h4>
              <textarea name="request" id=""></textarea>
            </div>

            <div class="flex margin-top-helper">
              <div class="button-wrap">
                <a href="{{ url()->previous() }}" class="button">前の画面に戻る</a>
              </div>

              <div class="button-wrap">
                <input type="submit" class="button" value="予約する">
              </div>
            </div>
          </form>

        </div>

      </div>
    </div>
  </main>

  <x-public.layouts.footer />
  @endsection
</x-public.base>
