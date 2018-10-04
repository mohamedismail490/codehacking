@extends('layouts.blog-post')


@section('styles')

    <style type="text/css">

        .comment-reply{

            display: none;

        }

    </style>


@stop


@section('content')

    <!-- Blog Post Content Column -->
    <div class="col-lg-8">

            <!-- Blog Post -->

            <!-- Title -->
            <h1>{{$post->title}}</h1>

            <!-- Author -->
            <p class="lead">
                by <a href="#">{{$post->user->name}}</a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

            <hr>

            <!-- Preview Image -->
            <img class="img-responsive" src="{{$post->photo ? $post->photo->file : '/images/no_image_placeholder.jpg'}}" alt="">

            <hr>

            <!-- Post Content -->
            <p class="lead">{!! $post->body !!}</p>

            <hr>

    {{--</div>--}}

    <!-- Blog Comments -->

  @if(Auth::check())

      @if(Session::has('comment_message'))

          <p class="alert alert-primary">{{session('comment_message')}}</p>

      @endif
    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>

        {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}

            <input type="hidden" name="post_id" value="{{$post->id}}">

            <div class="form-group">
                {!! Form::textarea('body',null, ['class'=>'form-control', 'rows'=>3]) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Comment', ['class'=>'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}

    </div>

  @endif

    <hr>


  @if(count($comments) > 0)

    <!-- Posted Comments -->

   @foreach($comments as $comment)

    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img height="64" width="64" class="media-object img-rounded" src="{{$comment->photo}}" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$comment->author}}
                <small>{{$comment->created_at->diffForHumans()}}</small>
            </h4>
            {{$comment->body}}



            @if(count($comment->replies) > 0)

                @foreach($comment->replies as $reply)

                    @if($reply->is_active == 1)

                        <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img height="64" width="64" class="media-object img-rounded" src="{{$reply->photo}}" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{$reply->author}}
                                    <small>{{$reply->created_at->diffForHumans()}}</small>
                                </h4>
                                {{$reply->body}}
                            </div>




                        </div>
                            <!-- End Nested Comment -->

                    @endif

                @endforeach

            @endif
            <div class="media comment-reply-container">


                <button class="toggle-reply btn btn-primary pull-right fa fa-arrow-left col-sm-1"></button>

                <div class="comment-reply col-sm-10">

                {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@store']) !!}

                <input type="hidden" name="comment_id" value="{{$comment->id}}">

                <div class="form-group">

                    {!! Form::textarea('body',null, ['class'=>'form-control', 'rows'=> 1]) !!}

                </div>

                <div class="form-group">
                    {!! Form::submit('Reply', ['class'=>'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}


                </div>

            </div>


        </div>
    </div>

   @endforeach

  @endif

   </div>

    <!-- Blog Sidebar Widgets Column -->
    <div class="col-md-4">

        <!-- Blog Search Well -->
        <div class="well">
            <h4>Blog Search</h4>
            <div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
            </div>
            <!-- /.input-group -->
        </div>
    @if(count($categories) > 0)
        <!-- Blog Categories Well -->
            <div class="well">
                <h4>Blog Categories</h4>
                <div class="row">
                    <div>
                        <ul class="list-unstyled">

                            @foreach($categories as $category)

                            <li class="col-lg-6"><a href="#">{{$category->name}}</a>
                            </li>

                            @endforeach

                        </ul>
                    </div>

                </div>
                <!-- /.row -->
            </div>

    @endif

    <!-- Side Widget Well -->
        <div class="well">
            <h4>Side Widget Well</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
        </div>

    </div>






        <div id="disqus_thread"></div>
        <script>

            /**
             *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
             *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
            /*
            var disqus_config = function () {
            this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
            };
            */
            (function() { // DON'T EDIT BELOW THIS LINE
                var d = document, s = d.createElement('script');
                s.src = 'https://codehacking-d0mohorrxu.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

    <script id="dsq-count-scr" src="//codehacking-d0mohorrxu.disqus.com/count.js" async></script>




@stop

@section('scripts')

<script>

$(".comment-reply-container .toggle-reply").click(function () {


$(this).next().slideToggle("slow");
$(this).toggleClass("fa-arrow-down");


});


</script>

@stop