@extends('layouts.admin')



@section('content')

    @if(count($comments) > 0)

        <h1>Post Comments</h1>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>AUTHOR</th>
                <th>EMAIL</th>
                <th>CONTENT</th>
                <th>REPLIES</th>
                <th>CREATED</th>
                <th>Confirmation</th>
            </tr>
            </thead>
            <tbody>

            @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->author}}</td>
                    <td>{{str_limit($comment->email, 15)}}</td>
                    <td>{{str_limit($comment->body, 15)}}</td>
                    <td><a href="{{route('admin.comment.replies.show', $comment->id)}}">View Replies</a></td>
                    <td>{{$comment->created_at->diffForHumans()}}</td>
                    <td>

                        @if($comment->is_active == 1)

                            {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}

                            <input type="hidden" name="is_active" value="0">

                            <div class="form-group">
                                {!! Form::submit('Disapprove', ['class'=>'btn btn-info']) !!}
                            </div>

                            {!! Form::close() !!}


                        @else

                            {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}

                            <input type="hidden" name="is_active" value="1">

                            <div class="form-group">
                                {!! Form::submit('Approve', ['class'=>'btn btn-success']) !!}
                            </div>

                            {!! Form::close() !!}



                        @endif


                    </td>

                    <td>

                        {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id]]) !!}

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

                {{$comments->render()}}

            </div>
        </div>

    @else

        <h1 class="text-center">No Comments</h1>

    @endif



@stop