@extends('layouts.base', ['background' => $background ?? ''])

@section('content')
    <header class="relative z-50 text-gray-600">
        @component('partials/main-menu')
            <a
                class="block px-3 hover:text-red-500 focus:text-red-500 outline-none {{ Request::is('*archive') ? ' text-red-500' : '' }}"
                href="{{ route('archive') }}"
            >
                @include('partials/icon', ['name' => 'archive', 'class' => 'inline-block w-6 h-6 align-text-bottom'])
                Message Archive
            </a>
            @foreach(config('voteict.locales') as $name => $locale)
                @php
                    $current = App::getLocale();
                    $segments = Request::segments();
                    if ($current === 'en') {
                        array_unshift($segments, $locale);
                    } else {
                        $segments[0] = $locale !== 'en' ? $locale : '' ;
                    }
                    if ($current === $locale) {
                        continue;
                    }
                @endphp
                <a
                    class="block px-2 hover:text-red-500 focus:text-red-500 focus:outline-0"
                    href="{{ url(implode('/', $segments)) }}"
                >
                    @include('partials/icon', ['name' => $locale, 'class' => 'inline-block w-6 h-6'])
                </a>
            @endforeach
        @endcomponent
    </header>
    <main>
        @if (session('status'))
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="alert alert-info">
                            <p class="my-0">{{ session('status') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @yield('content')
    </main>
@overwrite
