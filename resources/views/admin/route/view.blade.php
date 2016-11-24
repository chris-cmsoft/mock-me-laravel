@extends('layouts.master')

@section('content')

    <h3>View Route : {{ $route->name }}</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="2">{{$route->name}}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Name</td>
                <td>{{ $route->name }}</td>
            </tr>
            <tr>
                <td>Url</td>
                <td>{{ $route->url }}</td>
            </tr>
        </tbody>
    </table>

@endsection