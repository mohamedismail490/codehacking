@extends('layouts.admin')



@section('content')

    <h1>Categories</h1>

    @if(Session::has('deleted_category'))

        <p class="alert alert-danger">{{session('deleted_category')}}</p>

    @elseif(Session::has('updated_category'))

        <p class="alert alert-success">{{session('updated_category')}}</p>

    @elseif(Session::has('created_category'))

        <p class="alert alert-success">{{session('created_category')}}</p>


    @endif

    <div class="col-sm-6">

        {!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name',null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}

      @include('includes.form_error')

    </div>
    <div class="col-sm-6">

    @if($categories)

    <table class="table">
      <thead>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>Created</th>
            <th>UPDATED</th>
        </tr>
      </thead>
      <tbody>

      @foreach($categories as $category)

        <tr>
            <td>{{$category->id}}</td>
            <td><a href="{{route('admin.categories.edit', $category->id)}}">{{$category->name}}</a></td>
            <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'No date'}}</td>
            <td>{{$category->updated_at ? $category->updated_at->diffForHumans() : 'No date'}}</td>
        </tr>

      @endforeach

      </tbody>
    </table>

    @endif

    </div>


@stop