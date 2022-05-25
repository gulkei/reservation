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

        @if (count($paginator))
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">名前</th>
              <th scope="col">メールアドレス</th>
              <th scope="col">変更</th>
              <th scope="col">削除</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($paginator as $user)
            <tr>
              <th scope="row">{{ $user->id }}</th>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td><a href="" class="btn btn-primary">変更</a></td>
              <td><a href="" class="btn btn-danger">削除</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>

        {{ $paginator->links('components.admin.components.pagination') }}

        @else
        <p>まだ登録されていません。</p>
        @endif

        <footer class="pt-5 d-flex justify-content-between">
          <span>Copyright ©demo</span>
        </footer>
      </main>
    </div>
  </div>
  @endsection
</x-admin.base>
