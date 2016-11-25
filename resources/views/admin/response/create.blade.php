@extends('layouts.master')

@section('content')

    <h3>Create New Response</h3>

    <form method="POST">
        
        @include('_form', ['response' => $response])

    </form>

@endsection