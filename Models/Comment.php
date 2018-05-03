<?php namespace Foostart\Comment\Models;

use Foostart\Category\Library\Models\FooModel;
use Illuminate\Database\Eloquent\Model;

class Comment extends FooModel {

    /**
     * @table categories
     * @param array $attributes
     */
    public function __construct(array $attributes = array()) {
        //set configurations
        $this->setConfigs();

        parent::__construct($attributes);

    }

    public function setConfigs() {

        //table name
        $this->table = 'comments';

        //list of field in table
        $this->fillable = [
            'comment_id',
            'comment_name',
            'category_id',
            'user_id',
            'user_full_name',
            'user_email',
            'comment_overview',
            'comment_description',
            'comment_image',
            'comment_files',
            'comment_status',
        ];

        //list of fields for inserting
        $this->fields = [
            'comment_name' => [
                'name' => 'comment_name',
                'type' => 'Int',
            ],
            'comment_name' => [
                'name' => 'comment_name',
                'type' => 'Text',
            ],
            'category_id' => [
                'name' => 'category_id',
                'type' => 'Int',
            ],
            'user_id' => [
                'name' => 'user_id',
                'type' => 'Int',
            ],
            'user_full_name' => [
                'name' => 'user_full_name',
                'type' => 'Text',
            ],
            'user_email' => [
                'name' => 'email',
                'type' => 'Text',
            ],
            'comment_overview' => [
                'name' => 'comment_overview',
                'type' => 'Text',
            ],
            'comment_description' => [
                'name' => 'comment_description',
                'type' => 'Text',
            ],
            'comment_image' => [
                'name' => 'comment_image',
                'type' => 'Text',
            ],
            'comment_files' => [
                'name' => 'files',
                'type' => 'Json',
            ],
             'comment_status' => [
                'name' => 'comment_status',
                'type' => 'Int',
            ],
        ];

        //check valid fields for inserting
        $this->valid_insert_fields = [
            'comment_id',
            'comment_name',
            'user_id',
            'category_id',
            'user_full_name',
            'updated_at',
            'comment_overview',
            'comment_description',
            'comment_image',
            'comment_files',
            'comment_status',
        ];

        //check valid fields for ordering
        $this->valid_ordering_fields = [
            'comment_id',
            'comment_name',
            'updated_at',
            $this->field_status,
        ];
        //check valid fields for filter
        $this->valid_filter_fields = [
            'keyword',
            'comment_status',
        ];

        //primary key
        $this->primaryKey = 'comment_id';

        //the number of items on page
        $this->perPage = 10;

        //item status
        $this->field_status = 'comment_status';

    }

    /**
     * Gest list of items
     * @param type $params
     * @return object list of categories
     */
    public function selectItems($params = array()) {

        //join to another tables
        $elo = $this->joinTable();

        //search filters
        $elo = $this->searchFilters($params, $elo);

        //select fields
        $elo = $this->createSelect($elo);

        //order filters
        $elo = $this->orderingFilters($params, $elo);

        //paginate items
        $items = $this->paginateItems($params, $elo);

        return $items;
    }

    /**
     * Get a comment by {id}
     * @param ARRAY $params list of parameters
     * @return OBJECT comment
     */
    public function selectItem($params = array(), $key = NULL) {


        if (empty($key)) {
            $key = $this->primaryKey;
        }
       //join to another tables
        $elo = $this->joinTable();

        //search filters
        $elo = $this->searchFilters($params, $elo, FALSE);

        //select fields
        $elo = $this->createSelect($elo);

        //id
        $elo = $elo->where($this->primaryKey, $params['id']);

        //first item
        $item = $elo->first();

        return $item;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return ELOQUENT OBJECT
     */
    protected function joinTable(array $params = []){
        return $this;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return ELOQUENT OBJECT
     */
    protected function searchFilters(array $params = [], $elo, $by_status = TRUE){

        //filter
        if ($this->isValidFilters($params) && (!empty($params)))
        {
            foreach($params as $column => $value)
            {
                if($this->isValidValue($value))
                {
                    switch($column)
                    {
                        case 'comment_name':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.comment_name', '=', $value);
                            }
                            break;
                        case 'status':
                            if (!empty($value)) {
                                $elo = $elo->where($this->table . '.'.$this->field_status, '=', $value);
                            }
                            break;
                        case 'keyword':
                            if (!empty($value)) {
                                $elo = $elo->where(function($elo) use ($value) {
                                    $elo->where($this->table . '.comment_name', 'LIKE', "%{$value}%")
                                    ->orWhere($this->table . '.comment_description','LIKE', "%{$value}%")
                                    ->orWhere($this->table . '.comment_overview','LIKE', "%{$value}%");
                                });
                            }
                            break;
                        default:
                            break;
                    }
                }
            }
        } 
        return $elo;
    }

    /**
     * Select list of columns in table
     * @param ELOQUENT OBJECT
     * @return ELOQUENT OBJECT
     */
    public function createSelect($elo) {

        $elo = $elo->select($this->table . '.*',
                            $this->table . '.comment_id as id'
                );

        return $elo;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @return ELOQUENT OBJECT
     */
    public function paginateItems(array $params = [], $elo) {
        $items = $elo->paginate($this->perPage);

        return $items;
    }

    /**
     *
     * @param ARRAY $params list of parameters
     * @param INT $id is primary key
     * @return type
     */
    public function updateItem($params = [], $id = NULL) {

        if (empty($id)) {
            $id = $params['id'];
        }
        $field_status = $this->field_status;

        $comment = $this->selectItem($params);

        if (!empty($comment)) {
            $dataFields = $this->getDataFields($params, $this->fields);

            foreach ($dataFields as $key => $value) {
                $comment->$key = $value;
            }

            $comment->save();

            return $comment;
        } else {
            return NULL;
        }
    }


    /**
     *
     * @param ARRAY $params list of parameters
     * @return OBJECT comment
     */
    public function insertItem($params = []) {

        $dataFields = $this->getDataFields($params, $this->fields);



        $item = self::create($dataFields);

        $key = $this->primaryKey;
        $item->id = $item->$key;

        return $item;
    }


    /**
     *
     * @param ARRAY $input list of parameters
     * @return boolean TRUE incase delete successfully otherwise return FALSE
     */
    public function deleteItem($input = [], $delete_type) {

        $item = $this->find($input['id']);

        if ($item) {
            switch ($delete_type) {
                case 'delete-trash':
                    return $item->delete($item);
                    break;
                case 'delete-forever':
                    return $item->delete();
                    break;
            }

        }

        return FALSE;
    }
    
    
    /**
     * Get list of statuses to push to select
     * @return ARRAY list of statuses
     */
    public function getPluckStatus() {
        $pluck_status = config('package-comment.status.list');
        return $pluck_status;
     }

}