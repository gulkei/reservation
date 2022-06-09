<x-admin.base>
  @section('title', '管理画面 - ユーザー')
  @section('content')
  <x-admin.layouts.nav />

  <div class="container-fluid">
    <div class="row">
      <x-admin.layouts.sidebar />

      <main class="col-md-9 ms-auto col-lg-10 px-md-4 py-4">
        <h1 class="h2">予約</h1>
        <p>予約詳細</p>

        <div class="reserve">
          {{-- 日付(年月日) --}}
          <p class="reserve__year">2022年6月20日</p>

          {{-- 予約(予約者、メールアドレス, 予約内容, 変更, 削除) --}}
          {{-- ページネーション不要(最大10件程のため) --}}
          <table class="table">
            <thead>
              <tr>
                <th scope="col">予約ID</th>
                <th scope="col">名前</th>
                <th scope="col">メールアドレス</th>
                <th scope="col">予約内容</th>
                <th scope="col">変更</th>
                <th scope="col">削除</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>田中たろう</td>
                <td>aaa@gmail.com</td>
                <td>オイル交換</td>
                <td><a href="" class="btn btn-primary">変更</a></td>
                <td><a href="" class="btn btn-danger">削除</a></td>
              </tr>
            </tbody>
          </table>

          <div class="reserve__btn">
            <a href="{{ route('admin.reserve') }}" class="btn btn-dark">予約一覧へ戻る</a>
          </div>
        </div>


        <footer class="pt-5 d-flex justify-content-between">
          <span>Copyright ©demo</span>
        </footer>
      </main>
    </div>
  </div>
  @endsection
</x-admin.base>
