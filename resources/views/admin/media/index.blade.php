@extends('layouts.admin')



@section('content')

    @if(Session::has('deleted_photo'))

        <p class="alert alert-danger">{{session('deleted_photo')}}</p>

    @endif

    <h1>Media</h1>

    @if($photos)

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>PHOTO</th>
                <th>CREATED</th>
                <th>UPDATED</th>
            </tr>
            </thead>
            <tbody>

            @foreach($photos as $photo)

                <tr>
                    <td>{{$photo -> id}}</td>
                    <td><img height="75" src="{{$photo -> file}}" class="img-rounded" alt=""></td>
                    <td>{{$photo -> created_at -> diffForHumans()}}</td>
                    <td>{{$photo -> updated_at -> diffForHumans()}}</td>
                    <td>

                        {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediasController@destroy', $photo->id]]) !!}

                            <div class="form-group">
                                {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                            </div>

                        {!! Form::close() !!}


                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>

        <div class="row">
            <div class="col-sm-6 col-sm-offset-5">

                {{$photos->render()}}

            </div>
        </div>

    @endif

@stop