<?php namespace Foostart\Comment\Validators;

use Foostart\Category\Library\Validators\FooValidator;
use Event;
use \LaravelAcl\Library\Validators\AbstractValidator;
use Foostart\Comment\Models\Comment;

use Illuminate\Support\MessageBag as MessageBag;

class CommentaddValidator extends FooValidator
{

    protected $obj_comment;

    public function __construct()
    {
        // add rules
        self::$rules = [
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
        $_ln = self::$configs['lengthadd'];

        $params = [
            'description' => [
                'key' => 'comment_description',
                'label' => trans($this->lang_admin.'.fields.description'),
                'min' => $_ln['comment_description']['min'],
                'max' => $_ln['comment_description']['max'],
            ],
        ];
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