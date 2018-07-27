<?php
namespace application\modules\page\models;

use src\Form;
use src\Validation;

class PageForm extends Form
{
    protected $_name = 'Page';
    protected $_labels = [
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

    public function __construct($id = null)
    {
        $this->_model = PageManager::model();
        parent::__construct();

        if ($id !== null) {
            $item = $this->_model->read($id);
            $this->_values = $item;
        }
    }


    public function save()
    {
        if ($this->validate()) {

            if (isset($this->_values['id'])) {
                $this->_values['updated_at'] = time();
                return PageManager::model()->update($this->_values['id'], $this->_values);
            }

            $this->_values['created_at'] = time();

            return PageManager::model()->create($this->_values);
        }

        return false;
    }
}