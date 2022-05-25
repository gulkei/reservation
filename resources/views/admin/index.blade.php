<x-admin.base>
  @section('title', '管理画面')
  @section('content')
  <x-admin.layouts.nav />

  <div class="container-fluid">
    <div class="row">
      <x-admin.layouts.sidebar />

      <main class="col-md-9 ms-auto col-lg-10 px-md-4 py-4">
        <h1 class="h2">ダッシュボード</h1>
        <p>ダッシュボード</p>

        <p>本日の予約 10件</p>
        <p>ユーザー数 10人</p>
        <footer class="pt-5 d-flex justify-content-between">
          <span>Copyright ©demo</span>
        </footer>
      </main>
    </div>
  </div>
  @endsection
</x-admin.base>
