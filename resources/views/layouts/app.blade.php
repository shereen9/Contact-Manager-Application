@include('layouts.partials.header')

    <div id="app">
    @include('layouts.partials.navbar')

        <main class="py-4">
            @yield('content')
        </main>
        @include('layouts.partials.footer')
