<x-public.base>
  @section('title', '予約システム')
  @section('content')
  <x-public.layouts.header></x-public.layouts.header>

  <main class="main">
    <x-public.components.hero></x-public.components.hero>

    <div class="choice">
      <div class="container">
        <div class="choice-form">
          <x-public.components.reserve-menu></x-public.components.reserve-menu>

          <x-public.components.calendar></x-public.components.calendar>
        </div>
      </div>
    </div>
  </main>

  <x-public.layouts.footer></x-public.layouts.footer>

  @endsection
</x-public.base>
