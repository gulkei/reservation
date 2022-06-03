<section class="section-tertiary">
  <h3 class="heading-tertiary">予約日時を選択</h3>

  <p>{{ $calendar['year'] }}</p>

  <table class="table">
    <thead>
      <tr>
        <th></th>
        @foreach ($calendar['weeks'] as $week)
        <th>
          <div class="table__box">
            <span>{{ $week['dayMonth'] }}</span>
            @if (Str::contains($week['dayOfWeek'], '土'))
            <span class="table__week--blue">({{ $week['dayOfWeek'] }})</span>
            @elseif (Str::contains($week['dayOfWeek'], '日'))
            <span class="table__week--red">({{ $week['dayOfWeek'] }})</span>
            @else
            <span>({{ $week['dayOfWeek'] }})</span>
            @endif
          </div>
        </th>
        @endforeach
      </tr>
    </thead>

    <tbody>
      @foreach ($calendar['times'] as $time)
      <tr>
        <th>
          <span>{{ $time }}〜</span>
        </th>
        @foreach ($calendar['weeks'] as $week)
        <td>
          <a href="{{ route('reservation',
          [
          'year' => $calendar['year'],
          'time' => $time,
          'date' => $week['dayMonth'],
          'dayOfWeek' => $week['dayOfWeek'],
          ] ) }}">◯</a>
        </td>
        @endforeach
      </tr>
      @endforeach
    </tbody>
  </table>
</section>
