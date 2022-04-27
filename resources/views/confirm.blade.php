<x-public.base>
  @section('title', '予約システム')
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
                <dd>オイル交換</dd>
              </div>
              <div class="confirm__definition-box">
                <dt>日時</dt>
                <dd>2022/04/01 (金)</dd>
              </div>
            </dl>
          </div>

          <div class="section-quaternary">
            <h4 class="heading-quaternary">予約者情報</h4>
            <dl class="confirm__definition-list">
              <div class="confirm__definition-box">
                <dt>お名前</dt>
                <dd>田中たろう</dd>
              </div>
              <div class="confirm__definition-box">
                <dt>メールアドレス</dt>
                <dd>aaa@aaa.com</dd>
              </div>
              <div class="confirm__definition-box">
                <dt>電話番号</dt>
                <dd>09012345678</dd>
              </div>
            </dl>
          </div>

          <form action="" method="post" class="form">
            <div class="form__group">
              <h4 class="heading-quaternary">何かご要望がございましたらご記入ください</h4>
              <textarea name="" id=""></textarea>
            </div>

            <div class="flex margin-top-helper">
              <div class="button-wrap">
                <input type="button" class="button" value="前の画面に戻る">
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
