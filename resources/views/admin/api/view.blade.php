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

    <h3>Routes</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Url</th>
                <th>
                    <a href="{{ route('route-create', ['api' => $api]) }}" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-plus"></i></a>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($api->routes as $route)
                <tr>
                    <td>{{ $route->name }}</td>
                    <td>{{ $route->url }}</td>
                    <td>
                        <form method="POST" action="{{ route('route-delete', ['api' => $api, 'route' => $route]) }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <a href="{{ route('route-view', ['api' => $api, 'route' => $route]) }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="{{ route('route-update', ['api' => $api, 'route' => $route]) }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a data-purpose="delete" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-trash"></i></a>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No Results Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection