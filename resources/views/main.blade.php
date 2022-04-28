@extends('layouts.app')

@section('title',$title)


@section('content')
    <body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check" viewBox="0 0 16 16">
            <title>Check</title>
            <path
                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
        </symbol>
    </svg>
    <div class="container py-3">
        <main>
            <div class="mb-3 text-center">
                @auth
                    <h2>Login: <b>{{Auth::user()->email}}</b></h2>
                    <h2>Balance: <b>{{Auth::user()->account?->balance}}</b></h2>
                    <user-balance-table></user-balance-table>
                @endauth

                @guest
                    <p>Неавторизованный пользователь, сделайте вход чтобы увидеть данные.</p>
                @endguest
            </div>
        </main>

    </div>
    </body>

@endsection

