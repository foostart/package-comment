<?php

use Illuminate\Session\TokenMismatchException;

/**
 * FRONT
 */
Route::get('comment', [
    'as' => 'comment',
    'uses' => 'Foostart\Comment\Controllers\Front\CommentFrontController@index'
]);


/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => ['admin_logged', 'can_see']], function () {

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////COMMENT ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        /**
         * list
         */
        Route::get('/admin/comment', [
            'as' => 'admin_comment',
            'uses' => 'Foostart\Comment\Controllers\Admin\CommentAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/comment/edit', [
            'as' => 'admin_comment.edit',
            'uses' => 'Foostart\Comment\Controllers\Admin\CommentAdminController@edit'
        ]);

        /**
         * post
         */
        Route::post('admin/comment/edit', [
            'as' => 'admin_comment.post',
            'uses' => 'Foostart\Comment\Controllers\Admin\CommentAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/comment/delete', [
            'as' => 'admin_comment.delete',
            'uses' => 'Foostart\Comment\Controllers\Admin\CommentAdminController@delete'
        ]);
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////COMMENT ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////




        
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
         Route::get('admin/comment_category', [
            'as' => 'admin_comment_category',
            'uses' => 'Foostart\Comment\Controllers\Admin\CommentCategoryAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/comment_category/edit', [
            'as' => 'admin_comment_category.edit',
            'uses' => 'Foostart\Comment\Controllers\Admin\CommentCategoryAdminController@edit'
        ]);

        /**
         * post
         */
        Route::post('admin/comment_category/edit', [
            'as' => 'admin_comment_category.post',
            'uses' => 'Foostart\Comment\Controllers\Admin\CommentCategoryAdminController@post'
        ]);
         /**
         * delete
         */
        Route::get('admin/comment_category/delete', [
            'as' => 'admin_comment_category.delete',
            'uses' => 'Foostart\Comment\Controllers\Admin\CommentCategoryAdminController@delete'
        ]);
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
    });
});
