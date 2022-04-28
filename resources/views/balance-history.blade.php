@extends('layouts.app')
@section('title',$title)
@section('content')
    <div class="text-center container">
        <h2>{{$title}}</h2>
        <user-balance-table-full></user-balance-table-full>
    </div>

@endsection
