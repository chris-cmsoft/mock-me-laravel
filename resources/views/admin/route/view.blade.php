@extends('layouts.master')

@section('content')

    <h3>View Route : {{ $route->name }}</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="2">Route : {{ $route->name }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Url</td>
                <td>{{ $route->name }}</td>
            </tr>
            <tr>
                <td>Request Method</td>
                <td>{{ $route->request_method }}</td>
            </tr>
            <tr>
                <td>Response Time</td>
                <td>{{ $route->response_time }}</td>
            </tr>
            <tr>
                <td>Response Code</td>
                <td>{{ $route->response_code }}</td>
            </tr>
            <tr>
                <td>Payload</td>
                <td>{{ $route->payload }}</td>
            </tr>
        </tbody>
    </table>

@endsection