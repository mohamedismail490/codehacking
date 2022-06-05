@extends('layouts.admin')



@section('content')

    @if(Session::has('deleted_photo'))

        <p class="alert alert-danger">{{session('deleted_photo')}}</p>

    @endif

    <h1>Media</h1>

    @if($photos)

        <form action="delete/media" method="post" class="form-inline">

            {{--if you have error with the form use these--}}
            {{csrf_field()}}

            {{method_field('delete')}}
            
            <div class="form-group">
                <select name="checkBoxArray" id="" class="form-control">

                    <option value="">Delete</option>

                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="delete_all" class="btn btn-primary" value="Submit">
            </div>
            


        <table class="table">
            <thead>
            <tr>
                <th><input type="checkbox" id="options" class="checkbox-inline"></th>
                <th>ID</th>
                <th>PHOTO</th>
                <th>CREATED</th>
                <th>UPDATED</th>
            </tr>
            </thead>
            <tbody>

            @foreach($photos as $photo)

                <tr>
                    <td><input class="checkBoxes checkbox-inline" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}"></td>
                    <td>{{$photo -> id}}</td>
                    <td><img height="75" src="{{$photo -> file}}" class="img-rounded" alt=""></td>
                    <td>{{$photo -> created_at -> diffForHumans()}}</td>
                    <td>{{$photo -> updated_at -> diffForHumans()}}</td>
                    <td>


                        <input type="hidden" name="photo" value="{{$photo->id}}">

                            <div class="form-group">

                                <input type="submit" name="delete_single" value="Delete" class="btn btn-danger">

                            </div>




                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>

        </form>

        <div class="row">
            <div class="col-sm-6 col-sm-offset-5">

                {{$photos->render()}}

            </div>
        </div>

    @endif

@stop

@section('scripts')

    <script>


        $(document).ready(function () {

            $('#options').click(function () {

                if (this.checked){

                    $('.checkBoxes').each(function () {


                        this.checked = true ;

                    });

                }else if (!(this.checked)){

                    $('.checkBoxes').each(function () {


                        this.checked = false ;

                    });

                }



                // console.log('works');

            });
            
        });

        // function confirm(text) {
        //     alert(text);
        //
        // }

    </script>

@stop