@extends('layouts.master')

@section('content')

    <h3>Update API : {{ $api->name }}</h3>

    <form method="POST">

        {{ method_field('PUT') }}

        @include('_form', ['api' => $api])

    </form>


@endsection