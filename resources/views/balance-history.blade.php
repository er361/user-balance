@extends('layouts.app')
@section('title',$title)
@section('content')
    <div class="text-center container">
        <h2>{{$title}}</h2>
        @auth
            <user-balance-table-full></user-balance-table-full>
        @endauth
        @guest
            <p>Неавторизованный пользователь, сделайте вход чтобы увидеть данные.</p>
        @endguest
    </div>

@endsection
