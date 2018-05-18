<?php
namespace Foostart\Comment\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use URL,
    Route,
    Redirect;
use Foostart\Category\Library\Controllers\FooController;
use Foostart\Comment\Models\Comment;
use Foostart\Category\Models\Category;
use Foostart\Comment\Validators\CommentValidator;
    
class HomeController extends Controller
{
    public $obj_item = NULL;
    public $obj_category = NULL;
    public $obj_member = NULL;
    public $statuses = NULL;
    public $leader_position = NULL;
    public function __construct() {
        // models
        $this->obj_item = new Comment(array('perPage' => 10));
        $this->obj_category = new Category();
        // validators
        $this->obj_validator = new CommentValidator();
        // set language files
        $this->plang_admin = 'comment-admin';
        $this->plang_front = 'comment-front';
        // package name
        $this->package_name = 'package-comment';
        $this->package_base_name = 'comment';
        // root routers
        $this->root_router = 'comments';
        $this->data_view['status'] = $this->obj_item->getPluckStatus();
        // page views
        $this->page_views = [
            'front' => [
                'home' => $this->package_name.'::front.'.$this->package_base_name.'-pagehome',
            ]
            
        ];
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $items = $this->obj_item->selectItems($params);
        // display view
        $this->data_view = array_merge($this->data_view,array(
            'items' => $items,
            'request' => $request,
            'statuses' => $this->statuses,
            'params' => $params,
        ));
       return view($this->page_views['front']['home'],$this->data_view);
    }
}