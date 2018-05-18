<?php

use Illuminate\Session\TokenMismatchException;

/**
 * FRONT
 */
Route::get('comment', [
    'as' => 'comment',
    'uses' => 'Foostart\Comment\Controllers\Front\CommentFrontController@index'
]);

 Route::get('home', [
            'as' => 'comments.home',
            'uses' => 'Foostart\Comment\Controllers\Front\HomeController@index'
        ]);
/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => ['admin_logged', 'can_see'],
                  'namespace' => 'Foostart\Comment\Controllers\Admin',
        ], function () {

        /*
          |-----------------------------------------------------------------------
          | Manage comment
          |-----------------------------------------------------------------------
          | 1. List of comments
          | 2. Edit comment
          | 3. Delete comment
          | 4. Add new comment
          | 5. Manage configurations
          | 6. Manage languages
          |
        */

        /**
         * list
         */
        Route::get('admin/comments/list', [
            'as' => 'comments.list',
            'uses' => 'CommentAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/comments/edit', [
            'as' => 'comments.edit',
            'uses' => 'CommentAdminController@edit'
        ]);

        /**
         * copy
         */
        Route::get('admin/comments/copy', [
            'as' => 'comments.copy',
            'uses' => 'CommentAdminController@copy'
        ]);

        /**
         * post
         */
        Route::post('admin/comments/edit', [
            'as' => 'comments.post',
            'uses' => 'CommentAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/comments/delete', [
            'as' => 'comments.delete',
            'uses' => 'CommentAdminController@delete'
        ]);

        /**
         * trash
         */
         Route::get('admin/comments/trash', [
            'as' => 'comments.trash',
            'uses' => 'CommentAdminController@trash'
        ]);

        /**
         * configs
        */
        Route::get('admin/comments/config', [
            'as' => 'comments.config',
            'uses' => 'CommentAdminController@config'
        ]);

        Route::post('admin/comments/config', [
            'as' => 'comments.config',
            'uses' => 'CommentAdminController@config'
        ]);

        /**
         * language
        */
        Route::get('admin/comments/lang', [
            'as' => 'comments.lang',
            'uses' => 'CommentAdminController@lang'
        ]);

        Route::post('admin/comments/lang', [
            'as' => 'comments.lang',
            'uses' => 'CommentAdminController@lang'
        ]);
        
        /**
         * add
         */
        Route::get('admin/comments/add', [
            'as' => 'comments.add',
            'uses' => 'CommentAdminController@add'
        ]);
        
        /**
         * postadd
         */
        Route::post('admin/comments/add', [
            'as' => 'comments.postadd',
            'uses' => 'CommentAdminController@postadd'
        ]);
        
         /**
         * delete comment
         */
        Route::get('admin/comments/deletecomment', [
            'as' => 'comments.deletecomment',
            'uses' => 'CommentAdminController@deletecomment'
        ]);
        
       
    });
    
});
