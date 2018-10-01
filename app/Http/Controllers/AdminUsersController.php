<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

//if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
//    // Ignores notices and reports all other kinds... and warnings
//    // error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
//    error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
//}

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $users = User::paginate(4);

        return view('admin.users.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $roles = Role::pluck('name', 'id')->all();

        return view('admin.users.create', compact('roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //

//        User::create($request->all());

        $input = $request->all();

        $input['password'] = bcrypt($request->password);


        if ($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();

            $file -> move('images', $name);

            $photo = Photo::create(['file' => $name]);

            $input['photo_id'] = $photo->id ;


        }

        User::create($input);

        Session::flash('created_user', 'The User has been Created');


        return redirect('admin/users');

//        return $request->all();

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

        $user = User::findOrFail($id);

        $roles = Role::pluck('name', 'id')->all();

        return view('admin.users.edit', compact('user', 'roles'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        //

        $user = User::findOrFail($id);

        if (trim($request->password) == '') {

            $input = $request->except('password');

        }else {

            $input = $request->all();

            $input['password'] = bcrypt($request->password);
        }


        if ($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo -> id ;

        }

        $user->update($input);

        Session::flash('updated_user', 'The User has been Updated Successfully.');

        return redirect('admin/users');

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

       $user = User::findOrFail($id);
       $photo = $user->photo_id ;



        if ($photo) {

                // to delete user's photo from directory
            unlink(public_path() . $user->photo->file);

            $photo1 = Photo::findOrFail($photo);

            $photo1->delete();

        }

       $user->delete();





        Session::flash('deleted_user', 'The User has been Deleted');

       return redirect('/admin/users');

    }
}
