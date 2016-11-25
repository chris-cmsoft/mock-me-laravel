@extends('layouts.master')

@section('content')

    <h3>Update Response</h3>

    <form method="POST">

        {{ method_field('PUT') }}
        
        @include('_form', ['response' => $response])

    </form>

@endsection