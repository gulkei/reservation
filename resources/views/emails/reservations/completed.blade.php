{{ $reservation->name }} 様

<p>予約いただきましてありがとうございます。<br>
以下の通り、受け付けましたのでご確認ください。</p>

<div>
  予約番号: {{ $reservation->id }}
  <br>
  予約日: {{ $reservation->reservation_year }}{{ $reservation->reservation_date }} {{ $reservation->reservation_time }}
  <br>
  予約内容: @foreach ($reservation->records as $record)
  {{ $record->item }}
  @endforeach
</div>

<p>※予約のキャンセルは前日までとなっています。</p>

<p>ご不明な点があればお問い合わせください。<br>
当日のご来店をお待ちしています。</p>
