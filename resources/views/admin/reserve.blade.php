<x-admin.base>
  @section('title', '管理画面 - ユーザー')
  @section('content')
  <x-admin.layouts.nav />

  <div class="container-fluid">
    <div class="row">
      <x-admin.layouts.sidebar />

      <main class="col-md-9 ms-auto col-lg-10 px-md-4 py-4">
        <h1 class="h2">予約</h1>
        <p>予約</p>

        {{-- カレンダーを作成する --}}
        {{-- 月日のノーマルカレンダー --}}
        {{-- 日付に予約何件という形で表示 --}}
        {{-- その日付をクリックすれば、予約詳細が確認できる --}}

        <table class="calendar">
          <thead>
            <tr>
              <th>日</th>
              <th>月</th>
              <th>火</th>
              <th>水</th>
              <th>木</th>
              <th>金</th>
              <th>土</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($calendar as $weeks)
              <tr>
                @foreach ($weeks as $day)

                  <td>
                    @if ($today == $day)
                    <span class="calendar__day active">{{ $day }}</span>
                    @php
                      $today = false;
                    @endphp
                    @else
                    <span class="calendar__day">{{ $day }}</span>
                    @endif
                  </td>
                @endforeach
              </tr>
            @endforeach
            {{-- <td>
              <span class="calendar__day">{{ $week[6] }}</span>
              <div class="calendar__user">
                <span>田中太郎</span>
                <span>11:00</span>
              </div>
            </td> --}}

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
