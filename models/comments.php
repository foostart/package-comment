<?php

namespace Foostart\Comment\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model {

    protected $table = 'comments';
    public $timestamps = false;
    protected $fillable = [
        'comment_name',
        'category_id'
    ];
    protected $primaryKey = 'comment_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_comments($params = array()) {
        $eloquent = self::orderBy('comment_id');

        //comment_name
        if (!empty($params['comment_name'])) {
            $eloquent->where('comment_name', 'like', '%'. $params['comment_name'].'%');
        }

        $comments = $eloquent->paginate(10);//TODO: change number of item per page to configs

        return $comments;
    }



    /**
     *
     * @param type $input
     * @param type $comment_id
     * @return type
     */
    public function update_comment($input, $comment_id = NULL) {

        if (empty($comment_id)) {
            $comment_id = $input['comment_id'];
        }

        $comment = self::find($comment_id);

        if (!empty($comment)) {

            $comment->comment_name = $input['comment_name'];
            $comment->category_id = $input['category_id'];

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
    public function add_comment($input) {

        $comment = self::create([
                    'comment_name' => $input['comment_name'],
                    'category_id' => $input['category_id'],
        ]);
        return $comment;
    }
}
