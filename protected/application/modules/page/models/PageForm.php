<?php

namespace application\modules\page\models;

use src\Form;
use src\Validation;

class PageForm extends Form
{
    protected $name = 'Page';
    protected $labels = [
        'title' => '{{%Page title%}}',
        'body' => '{{%Page body%}}',
        'keywords' => '{{%Keywords%}}',
        'description' => '{{%Description%}}',
        'state' => '{{%Activity%}}'
    ];

    protected function rules()
    {
        return [
            [['title'], Validation::REQUIRED]
        ];
    }

    /**
     * PageForm constructor.
     * @param null $id
     * @throws \Exception
     */
    public function __construct($id = null)
    {
        $this->model = PageManager::model();
        parent::__construct();

        if ($id !== null) {
            $item = $this->model->read($id);
            $this->values = $item;
        }
    }


    public function save()
    {
        if ($this->validate()) {

            if (isset($this->values['id'])) {
                $this->values['updated_at'] = time();
                return PageManager::model()->update($this->values['id'], $this->values);
            }

            $this->values['created_at'] = time();

            return PageManager::model()->create($this->values);
        }

        return false;
    }
}