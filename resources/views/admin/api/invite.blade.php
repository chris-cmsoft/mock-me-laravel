@extends('layouts.master')

@section('content')

    <h3>Invite Members to : {{ $api->name }}</h3>

    <form method="POST">

        <table class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Email</th>
                    @foreach($accesses as $access)
                        <th>{{$access}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td style="text-align: center">
                            <input type="hidden" name="invite[{{$user->id}}][selected]" value="0" />
                            <input type="checkbox" name="invite[{{$user->id}}][selected]" value="1" />
                        </td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        @foreach($accesses as $access)
                            <td style="text-align: center">
                                <input type="hidden" name="invite[{{$user->id}}][access][{{$access}}]" value="0" />
                                <input type="checkbox" name="invite[{{$user->id}}][access][{{$access}}]" value="1" />
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button class="btn btn-default btn-block" type="submit">Submit</button>

    </form>

@endsection