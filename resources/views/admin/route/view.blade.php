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

    <h3>Responses</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Req. Method</th>
                <th>Resp. Time</th>
                <th>Resp. Code</th>
                <th>Is Active</th>
                <th>
                    <a class="btn btn-xs btn-default" href="{{ route('response-create', ['api' => $route->api, 'route' => $route]) }}"><i class="glyphicon glyphicon-plus"></i></a>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($route->responses as $response)
                <tr>
                    <td>{{ strtoupper($response->request_method) }}</td>
                    <td>{{ $response->response_time }}</td>
                    <td>{{ $response->response_code }}</td>
                    <td>{{ $response->is_active }}</td>
                    <td>
                        <form method="POST" action="{{ route('response-delete', ['api' => $route->api, 'route' => $route, 'response' => $response]) }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <a href="{{ route('response-view', ['api' => $route->api, 'route' => $route, 'response' => $response]) }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="{{ route('response-update', ['api' => $route->api, 'route' => $route, 'response' => $response]) }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a data-purpose="delete" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-trash"></i></a>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No Results Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection