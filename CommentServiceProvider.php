<?php

namespace Foostart\Comment;

use Illuminate\Support\ServiceProvider;
use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;

use URL, Route;
use Illuminate\Http\Request;


class CommentServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Request $request) {
        /**
         * Publish
         */
         $this->publishes([
            __DIR__.'/config/comment_admin.php' => config_path('comment_admin.php'),
        ],'config');

        $this->loadViewsFrom(__DIR__ . '/views', 'comment');


        /**
         * Translations
         */
         $this->loadTranslationsFrom(__DIR__.'/lang', 'comment');


        /**
         * Load view composer
         */
        $this->commentViewComposer($request);

         $this->publishes([
                __DIR__.'/../database/migrations/' => database_path('migrations')
            ], 'migrations');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        include __DIR__ . '/routes.php';

        /**
         * Load controllers
         */
        $this->app->make('Foostart\Comment\Controllers\Admin\CommentAdminController');

         /**
         * Load Views
         */
        $this->loadViewsFrom(__DIR__ . '/views', 'comment');
    }

    /**
     *
     */
    public function commentViewComposer(Request $request) {

        view()->composer('comment::comment*', function ($view) {
            global $request;
            $comment_id = $request->get('id');
            $is_action = empty($comment_id)?'page_add':'page_edit';

            $view->with('sidebar_items', [

                /**
                 * Comments
                 */
                //list
                trans('comment::comment_admin.page_list') => [
                    'url' => URL::route('admin_comment'),
                    "icon" => '<i class="fa fa-list-ul" aria-hidden="true"></i>'
                ],
                //add
                trans('comment::comment_admin.'.$is_action) => [
                    'url' => URL::route('admin_comment.edit'),
                    "icon" => '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
                ],
                /**
                 * Categories
                 */
                //list
                trans('comment::comment_admin.page_category_list') => [
                    'url' => URL::route('admin_comment_category'),
                    "icon" => '<i class="fa fa-sitemap" aria-hidden="true"></i>'
                ],
            ]);
            //
        });
    }

}
