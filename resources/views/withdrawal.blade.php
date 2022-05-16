<x-public.base>
  @section('title', '予約システム - 退会')
  @section('content')
  <x-public.layouts.header />

  <main class="main">
    <div class="withdrawal">
      <div class="container">
        <p>以下のボタンをクリックすると退会します。</p>
        <div class="button-wrap">
          <a href="{{route('withdrawal.delete')}}" class="button">退会する</a>
        </div>
      </div>
    </div>
  </main>

  <x-public.layouts.footer />
  @endsection
</x-public.base>
