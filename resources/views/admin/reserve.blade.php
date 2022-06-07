<x-admin.base>
  @section('title', '管理画面 - ユーザー')
  @section('content')
  <x-admin.layouts.nav />

  <div class="container-fluid">
    <div class="row">
      <x-admin.layouts.sidebar />

      <main class="col-md-9 ms-auto col-lg-10 px-md-4 py-4">
        <h1 class="h2">予約</h1>
        <p>予約状況の確認</p>

        {{-- カレンダーを作成する --}}
        {{-- その日付をクリックすれば、予約詳細が確認できる --}}

        <div class="calendar">
          <p class="calendar__month">{{ $yearMonth }}</p>

          <table>
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
                  @foreach ($weeks['date'] as $day)

                    <td>
                      @if ($today == $day)
                      <span class="calendar__day active">{{ $day }}</span>
                      @php
                        $today = false;
                      @endphp
                      @else
                      <span class="calendar__day">{{ $day }}</span>
                      @endif

                      @if(count($weeks['reserve'][$loop->index]))
                      {{-- 2件以上は他何件という形で表示 --}}
                        @foreach ($weeks['reserve'][$loop->index] as $reserve)
                          @if ($loop->iteration >= 3)
                            <div>他{{ $loop->remaining + 1 }}件 </div>
                          @else
                          <div class="calendar__user">
                            <span>{{ $reserve->name }}</span>
                            <span>{{ $reserve->reservation_time }}</span>
                          </div>
                          @endif
                        @endforeach

                      @endif
                    </td>
                  @endforeach
                </tr>
              @endforeach

            </tbody>
          </table>
        </div>


        <footer class="pt-5 d-flex justify-content-between">
          <span>Copyright ©demo</span>
        </footer>
      </main>
    </div>
  </div>
  @endsection
</x-admin.base>
