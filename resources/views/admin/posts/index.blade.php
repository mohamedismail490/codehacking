@extends('layouts.admin')



@section('content')

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
            <th>CREATED_AT</th>
            <th>UPDATED_AT</th>
        </tr>
      </thead>
      <tbody>

      @if($posts)

        @foreach($posts as $post)

            <tr>
                <td>{{$post->id}}</td>
                <td><img height="70" src="{{$post->photo ? $post->photo->file : '/images/no_image_placeholder.jpg'}}" alt=""></td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->body}}</td>
                <td>{{$post->created_at->diffForHumans()}}</td>
                <td>{{$post->updated_at->diffForHumans()}}</td>

            </tr>

        @endforeach

      @endif

      </tbody>
    </table>


@stop