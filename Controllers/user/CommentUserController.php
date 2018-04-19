<?php

namespace Foostart\Comment\Controlers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use URL,
    Route,
    Redirect;
use Foostart\Comment\Models\Comments;

class CommentUserController extends Controller
{
    public $data = array();
    public function __construct() {

    }

    public function index(Request $request)
    {

        $obj_comment = new Comments();
        $comments = $obj_comment->get_comments();
        $this->data = array(
            'request' => $request,
            'comments' => $comments
        );
        return view('comment::comment.index', $this->data);
    }

}