@extends('layouts.admin')







@section('content')


    @if(Session::has('deleted_user'))

        <p class="alert alert-danger">{{session('deleted_user')}}</p>

    @elseif(Session::has('updated_user'))

        <p class="alert alert-success">{{session('updated_user')}}</p>

    @elseif(Session::has('created_user'))

        <p class="alert alert-success">{{session('created_user')}}</p>


    @endif

    <h1>USERS</h1>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>PHOTO</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>ROLE</th>
            <th>STATUS</th>
            <th>CREATED</th>
            <th>UPDATED</th>
        </tr>
        </thead>
        <tbody>

        @if($users)

            @foreach($users as $user)

                <tr>
                    <td>{{$user -> id}}</td>
                    {{--<td>{{$user -> photo ['file']}}</td>--}}
                    <td><a href="{{route('admin.users.edit', $user -> id)}}"><img height="70" src="{{$user -> photo ? $user -> photo -> file : '/images/avatar_default.jpg'}}" class="img-rounded" alt=""></a></td>
                    <td><a href="{{route('admin.users.edit', $user -> id)}}">{{$user -> name}}</a></td>
                    <td>{{$user -> email}}</td>
                    {{--<td>{{$user -> role [ 'name']}}</td>--}}
                    <td>{{$user -> role ? $user -> role -> name : 'No Role for this User'}}</td>
                    <td>{{$user -> is_active == 1 ? 'Active' : 'Not Active'}}</td>
                    <td>{{$user -> created_at -> diffForHumans()}}</td>
                    <td>{{$user -> updated_at -> diffForHumans()}}</td>
                </tr>

            @endforeach

        @endif

        </tbody>
    </table>


    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">

            {{$users->render()}}

        </div>
    </div>


@stop