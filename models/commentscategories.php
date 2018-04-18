<?php

namespace Foostart\Comment\Models;

use Illuminate\Database\Eloquent\Model;

class CommentsCategories extends Model {

    protected $table = 'comments_categories';
    public $timestamps = false;
    protected $fillable = [
        'comment_category_name'
    ];
    protected $primaryKey = 'comment_category_id';

    public function get_comments_categories($params = array()) {
        $eloquent = self::orderBy('comment_category_id');

        if (!empty($params['comment_category_name'])) {
            $eloquent->where('comment_category_name', 'like', '%'. $params['comment_category_name'].'%');
        }
        $comments_category = $eloquent->paginate(10);
        return $comments_category;
    }

    /**
     *
     * @param type $input
     * @param type $comment_id
     * @return type
     */
    public function update_comment_category($input, $comment_id = NULL) {

        if (empty($comment_id)) {
            $comment_id = $input['comment_category_id'];
        }

        $comment = self::find($comment_id);

        if (!empty($comment)) {

            $comment->comment_category_name = $input['comment_category_name'];

            $comment->save();

            return $comment;
        } else {
            return NULL;
        }
    }

    /**
     *
     * @param type $input
     * @return type
     */
    public function add_comment_category($input) {

        $comment = self::create([
                    'comment_category_name' => $input['comment_category_name'],
        ]);
        return $comment;
    }

    /**
     * Get list of comments categories
     * @param type $category_id
     * @return type
     */
     public function pluckSelect($category_id = NULL) {
        if ($category_id) {
            $categories = self::where('comment_category_id', '!=', $category_id)
                    ->orderBy('comment_category_name', 'ASC')
                ->pluck('comment_category_name', 'comment_category_id');
        } else {
            $categories = self::orderBy('comment_category_name', 'ASC')
                ->pluck('comment_category_name', 'comment_category_id');
        }
        return $categories;
    }

}
