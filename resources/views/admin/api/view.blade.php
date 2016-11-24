@extends('layouts.master')

@section('content')

    <h3>View API : {{ $api->name }}</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="2">Api : {{ $api->name }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Name</td>
                <td>{{ $api->name }}</td>
            </tr>
            <tr>
                <td>Key</td>
                <td>{{ $api->key }}</td>
            </tr>
        </tbody>
    </table>

@endsection