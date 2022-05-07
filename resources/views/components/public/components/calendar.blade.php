<section class="section-tertiary">
  <h3 class="heading-tertiary">予約日時を選択</h3>
  <table class="table">
    <thead>
      <tr>
        <th></th>
        @foreach ($weeks as $week)
        <th>
          <div class="table__box">
            <span>{{$week}}</span>
            @if (Str::contains($dayOfWeek[$loop->index], '土'))
            <span class="table__week--blue">{{$dayOfWeek[$loop->index]}}</span>
            @elseif (Str::contains($dayOfWeek[$loop->index], '日'))
            <span class="table__week--red">{{$dayOfWeek[$loop->index]}}</span>
            @else
            <span>{{$dayOfWeek[$loop->index]}}</span>
            @endif
          </div>
        </th>
        @endforeach
      </tr>
    </thead>

    <tbody>
      @foreach ($times as $time)
      <tr>
        <th>
          <span>{{$time}}〜</span>
        </th>
        @foreach ($weeks as $week)
        <td>
          <a href="{{ route('reservation', ['time' => $time, 'date' => $week.$dayOfWeek[$loop->index]]) }}">◯</a>
        </td>
        @endforeach
      </tr>
      @endforeach
    </tbody>
  </table>
</section>
