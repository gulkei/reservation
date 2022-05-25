<x-admin.base>
  @section('title', '管理画面 - ユーザー')
  @section('content')
  <x-admin.layouts.nav />

  <div class="container-fluid">
    <div class="row">
      <x-admin.layouts.sidebar />

      <main class="col-md-9 ms-auto col-lg-10 px-md-4 py-4">
        <h1 class="h2">ユーザー</h1>
        <p>ユーザー</p>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">名前</th>
              <th scope="col">メールアドレス</th>
              <th scope="col">メモ</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Jacob</td>
              <td>Thornton</td>
              <td>@fat</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td colspan="2">Larry the Bird</td>
              <td>@twitter</td>
            </tr>
          </tbody>
        </table>

        <footer class="pt-5 d-flex justify-content-between">
          <span>Copyright ©demo</span>
        </footer>
      </main>
    </div>
  </div>
  @endsection
</x-admin.base>
