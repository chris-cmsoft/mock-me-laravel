@extends('layouts.master')

@section('content')

    <h3>View Response</h3>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <td>Request Method</td>
                <td>{{ strtoupper($response->request_method) }}</td>
            </tr>
            <tr>
                <td>Response Time</td>
                <td>{{ $response->response_time }} Seconds</td>
            </tr>
            <tr>
                <td>Response Code</td>
                <td>{{ $response->response_code }}</td>
            </tr>
            <tr>
                <td>Payload</td>
                <td>{{ $response->payload }}</td>
            </tr>
            <tr>
                <td>Is Active</td>
                <td>{{ $response->is_active ? 'Yes' : 'No' }}</td>
            </tr>
        </tbody>
    </table>

@endsection