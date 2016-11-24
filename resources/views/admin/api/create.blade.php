@extends('layouts.master')

@section('content')

    <h3>Create New API</h3>

    <form method="POST">

        @include('_form', ['api' => $api])

    </form>


@endsection