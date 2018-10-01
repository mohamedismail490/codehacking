@extends('layouts.admin')



@section('content')

    @if(count($replies) > 0)

        <h1>Comment Replies</h1>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>AUTHOR</th>
                <th>EMAIL</th>
                <th>CONTENT</th>
                <th>CREATED</th>
                <th>Confirmation</th>
            </tr>
            </thead>
            <tbody>

            @foreach($replies as $reply)
                <tr>
                    <td>{{$reply->id}}</td>
                    <td>{{$reply->author}}</td>
                    <td>{{$reply->email}}</td>
                    <td>{{$reply->body}}</td>
                    <td>{{$reply->created_at->diffForHumans()}}</td>
                    <td>

                        @if($reply->is_active == 1)

                            {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}

                            <input type="hidden" name="is_active" value="0">

                            <div class="form-group">
                                {!! Form::submit('Disapprove', ['class'=>'btn btn-info']) !!}
                            </div>

                            {!! Form::close() !!}


                        @else

                            {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}

                            <input type="hidden" name="is_active" value="1">

                            <div class="form-group">
                                {!! Form::submit('Approve', ['class'=>'btn btn-success']) !!}
                            </div>

                            {!! Form::close() !!}



                        @endif


                    </td>

                    <td>

                        {!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy', $reply->id]]) !!}

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

                {{$replies->render()}}

            </div>
        </div>

    @else

        <h1 class="text-center">No Replies</h1>

    @endif



@stop