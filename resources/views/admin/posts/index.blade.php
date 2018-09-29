@extends('layouts.admin')



@section('content')

    @if(Session::has('deleted_post'))

        <p class="alert alert-danger">{{session('deleted_post')}}</p>

    @elseif(Session::has('updated_post'))

        <p class="alert alert-success">{{session('updated_post')}}</p>

    @elseif(Session::has('created_post'))

        <p class="alert alert-success">{{session('created_post')}}</p>


    @endif

    <h1>Users Posts</h1>

    <table class="table">
      <thead>
        <tr>
            <th>ID</th>
            <th>PHOTO</th>
            <th>OWNER</th>
            <th>CATEGORY</th>
            <th>TITLE</th>
            <th>BODY</th>
            <th>POST</th>
            <th>COMMENTS</th>
            <th>CREATED</th>
            <th>UPDATED</th>
        </tr>
      </thead>
      <tbody>

      @if($posts)

        @foreach($posts as $post)

            <tr>
                <td>{{$post->id}}</td>
                <td><a href="{{route('admin.posts.edit', $post->id)}}"><img height="70" src="{{$post->photo ? $post->photo->file : '/images/no_image_placeholder.jpg'}}" class="img-rounded" alt=""></a></td>
                <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->user->name}}</a></td>
                <td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td>
                <td>{{$post->title}}</td>
                <td>{{str_limit($post->body, 15)}}</td>
                <td><a href="{{route('home.post', $post->id)}}">View Post</a></td>
                <td><a href="{{route('admin.comments.show', $post->id)}}">View Comments</a></td>
                <td>{{$post->created_at->diffForHumans()}}</td>
                <td>{{$post->updated_at->diffForHumans()}}</td>

            </tr>

        @endforeach

      @endif

      </tbody>
    </table>


@stop