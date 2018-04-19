<?php namespace Foostart\Comment\Validators;

use Foostart\Category\Library\Validators\FooValidator;
use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Foostart\Comment\Models\Comment;

use Illuminate\Support\MessageBag as MessageBag;

class CommentValidator extends FooValidator
{

    protected $obj_comment;

    public function __construct()
    {
        // add rules
        self::$rules = [
            'comment_name' => ["required"],
            'comment_overview' => ["required"],
            'comment_description' => ["required"],
        ];

        // set configs
        self::$configs = $this->loadConfigs();

        // model
        $this->obj_comment = new Comment();

        // language
        $this->lang_front = 'comment-front';
        $this->lang_admin = 'comment-admin';

        // event listening
        Event::listen('validating', function($input)
        {
            self::$messages = [
                'comment_name.required'          => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.name')]),
                'comment_overview.required'      => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.overview')]),
                'comment_description.required'   => trans($this->lang_admin.'.errors.required', ['attribute' => trans($this->lang_admin.'.fields.description')]),
            ];
        });


    }

    /**
     *
     * @param ARRAY $input is form data
     * @return type
     */
    public function validate($input) {

        $flag = parent::validate($input);
        $this->errors = $this->errors ? $this->errors : new MessageBag();

        //Check length
        $_ln = self::$configs['length'];

        $params = [
            'name' => [
                'key' => 'comment_name',
                'label' => trans($this->lang_admin.'.fields.name'),
                'min' => $_ln['comment_name']['min'],
                'max' => $_ln['comment_name']['max'],
            ],
            'overview' => [
                'key' => 'comment_overview',
                'label' => trans($this->lang_admin.'.fields.overview'),
                'min' => $_ln['comment_overview']['min'],
                'max' => $_ln['comment_overview']['max'],
            ],
            'description' => [
                'key' => 'comment_description',
                'label' => trans($this->lang_admin.'.fields.description'),
                'min' => $_ln['comment_description']['min'],
                'max' => $_ln['comment_description']['max'],
            ],
        ];

        $flag = $this->isValidLength($input['comment_name'], $params['name']) ? $flag : FALSE;
        $flag = $this->isValidLength($input['comment_overview'], $params['overview']) ? $flag : FALSE;
        $flag = $this->isValidLength($input['comment_description'], $params['description']) ? $flag : FALSE;

        return $flag;
    }


    /**
     * Load configuration
     * @return ARRAY $configs list of configurations
     */
    public function loadConfigs(){

        $configs = config('package-comment');
        return $configs;
    }

}