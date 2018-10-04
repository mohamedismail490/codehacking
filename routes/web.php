<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', function () {
    return view('welcome');
});


Route::get('/post/{id}', ['as'=>'home.post', 'uses'=>'AdminPostsController@post']);

Route::resource('admin/comments', 'PostCommentsController',['names'=>[

    'index'=>'admin.comments.index',
    'create'=>'admin.comments.create',
    'store'=>'admin.comments.store',
    'edit'=>'admin.comments.edit',
    'show'=>'admin.comments.show',
    'update'=>'admin.comments.update',
    'destroy'=>'admin.comments.destroy'



]]);
Route::resource('admin/comment/replies', 'CommentRepliesController',['names'=>[

    'index'=>'admin.comments.replies.index',
    'create'=>'admin.comments.replies.create',
    'store'=>'admin.comments.replies.store',
    'createReply'=>'admin.comments.replies.createReply',
    'edit'=>'admin.comments.replies.edit',
    'show'=>'admin.comment.replies.show',
    'update'=>'admin.comments.replies.update',
    'destroy'=>'admin.comments.replies.destroy'



]]);

Route::group(['middleware'=>'admin'], function () {

    Route::get('/admin', function () {

        return view('admin.index');

    });


    Route::resource('admin/users', 'AdminUsersController',['names'=>[

        'index'=>'admin.users.index',
        'create'=>'admin.users.create',
        'store'=>'admin.users.store',
        'edit'=>'admin.users.edit',
        'show'=>'admin.users.show',
        'update'=>'admin.users.update',
        'destroy'=>'admin.users.destroy'



    ]]);
    Route::resource('admin/posts', 'AdminPostsController',['names'=>[

        'index'=>'admin.posts.index',
        'create'=>'admin.posts.create',
        'store'=>'admin.posts.store',
        'edit'=>'admin.posts.edit',
        'show'=>'admin.posts.show',
        'update'=>'admin.posts.update',
        'destroy'=>'admin.posts.destroy'



    ]]);
    Route::resource('admin/categories', 'AdminCategoriesController',['names'=>[

        'index'=>'admin.categories.index',
        'create'=>'admin.categories.create',
        'store'=>'admin.categories.store',
        'edit'=>'admin.categories.edit',
        'show'=>'admin.categories.show',
        'update'=>'admin.categories.update',
        'destroy'=>'admin.categories.destroy'



    ]]);

    Route::resource('admin/media', 'AdminMediasController',['names'=>[

        'index'=>'admin.media.index',
        'create'=>'admin.media.create',
        'store'=>'admin.media.store',
        'edit'=>'admin.media.edit',
        'show'=>'admin.media.show',
        'update'=>'admin.media.update',
        'destroy'=>'admin.media.destroy'



    ]]);

    Route::delete('admin/delete/media', 'AdminMediasController@deleteMedia');


});