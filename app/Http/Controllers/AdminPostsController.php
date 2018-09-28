<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostsCreateRequest;
use App\Photo;
use App\Post;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $categories = Category::lists('name', 'id')->all();

        return view('admin.posts.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //

        $input = $request->all();

        $user = Auth::user();

        if ($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();

            $file -> move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo -> id ;

        }

        $user->posts()->create($input);

        Session::flash('created_post', 'The Post has been Created');

        return redirect('/admin/posts');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $post = Post::findOrFail($id);

        $categories = Category::lists('name', 'id')->all();

        return view('admin.posts.edit', compact('post', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $post = Post::findOrFail($id);

//        $user = User::findOrFail($post->user_id);

        $input = $request->all();

        if ($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();

            $file -> move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo -> id ;

        }

//        Auth::user()->posts()->whereId($id)->first()->update($input);

//        $user->posts()->whereId($id)->first()->update($input);

        $post->whereId($id)->first()->update($input);

        Session::flash('updated_post', 'The Post has been Updated');

        return redirect('/admin/posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $post = Post::findOrFail($id);

        $photo = $post->photo_id ;


        if ($photo) {

            // to delete post's photo from directory
            unlink(public_path() . $post->photo->file);

            $photo1 = Photo::findOrFail($photo);

            $photo1->delete();

        }

        $post->delete();

        Session::flash('deleted_post', 'The Post has been Deleted');

        return redirect('/admin/posts');

    }


    public function post($id) {


        $post = Post::findOrFail($id);



        return view('post', compact('post'));
    }
}
