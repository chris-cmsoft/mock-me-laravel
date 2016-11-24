@extends('layouts.master')

@section('content')

    <h3>Create New Route</h3>

    <form method="POST">
        
        @include($viewPath . '_form', ['route' => $route])

    </form>

@endsection