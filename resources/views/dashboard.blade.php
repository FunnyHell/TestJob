@extends('layouts.main')
@section('content')
    <div class="h-full flex">
        <aside class="h-full bg-gray-700 w-1/6">
            <div class="grid grid-cols-3">
                <img src="{{asset('img/logo.png')}}" alt="logo" class="py-5 px-4 bg-white rounded-br-3xl">
                <h1 class=" leading-4 font-roboto pl-2 pt-1.5 text-white">
                    Enterprise Resource Planning
                </h1>
            </div>
            <div>
                <ul class="py-2 px-7 font-roboto text-white opacity-70">
                    <li><a href="#">
                            Продукты
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <div class="w-full p-6">
            <nav>
                <div class="flex space-x-4 justify-between">
                    <ul class="flex space-x-4">
                        <li class="text-xl font-roboto text-red-600">
                            <a href="#">ПРОДУКТЫ</a>
                            <div class="w-full h-1 bg-red-600 mt-5"></div>
                        </li>
                    </ul>
                    <ul>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{route('home')}}" >
                                    {{ Auth::user()->name }}
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>

            <div class="font-roboto text-left font-light w-1/2 text-gray-500">
                <div class="grid grid-cols-4 border-y py-2 text-left">
                    <h1>АРТИКУЛ</h1>
                    <h1>НАЗВАНИЕ</h1>
                    <h1>СТАТУС</h1>
                    <h1>АТРИБУТЫ</h1>
                </div>
                @foreach($products as $product)
                    <product-modal-component :product='@json($product)' :user='@json(Auth::user() ?: [])' :csrf='@json(csrf_token())'></product-modal-component>
                @endforeach
                <product-button-component :csrf='@json(csrf_token())'></product-button-component>


            </div>
        </div>
    </div>
@endsection
