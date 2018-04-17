<?php namespace Foostart\Sample\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use URL;
use Route,
    Redirect;
/**
 * Validators
 */

class Controller extends BaseController {

    public $data_view = array();

    private $obj_validator = NULL;

    public function __construct() {
    }

    public function addFlashMessage($message_key, $message_value) {
        \Session::flash('message', trans('sample::sample_admin.message_add_successfully'));
    }

}