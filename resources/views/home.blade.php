<x-public.base>
  @section('title', '予約システム')
  @section('content')
  <x-public.layouts.header />

  <main class="main">
    <x-public.components.hero />

    <div class="choice">
      <div class="container">
        <form action="" method="GET" class="choice-form">
          @csrf
          <x-public.components.reserve-menu />

          <x-public.components.calendar :weeks="$weeks" :day-of-week="$dayOfWeek" :times="$times" />
        </form>
      </div>
    </div>
  </main>

  <x-public.layouts.footer />

  @endsection
</x-public.base>
