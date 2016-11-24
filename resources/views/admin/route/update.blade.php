@extends('layouts.master')

@section('content')

    <h3>Update Route : {{ $route->name }}</h3>

    <form method="POST">

        {{ method_field('PUT') }}
        
        @include($viewPath . '_form', ['route' => $route])

    </form>

@endsection
