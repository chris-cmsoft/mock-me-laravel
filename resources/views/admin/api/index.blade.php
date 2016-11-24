@extends('layouts.master')

@section('content')

    <h3>Api's</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Key</th>
                <th>
                    <a href="{{ route('api-create') }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-plus"></i></a>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($apis as $api)
                <tr>
                    <td>{{ $api->name }}</td>
                    <td>{{ $api->key }}</td>
                    <td>
                        <form class="pull-right" action="{{ route('api-delete', ['api' => $api]) }}" method="POST">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <a href="{{ route('api-view', ['api' => $api]) }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="{{ route('api-update', ['api' => $api]) }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-pencil"></i></a>
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