<?php
namespace application\modules\navigation\models;

use application\helpers\TranslitHelper;
use src\Form;
use src\Validation;

class NavigationItemForm extends Form
{
    protected $_name = 'NavigationItem';
    protected $_labels = [
        'url' => '{{%Url%}}',
        'title' => '{{%Title%}}',
        'order_num' => '{{%Order%}}',
        'state' => '{{%Activity%}}'
    ];

    protected function rules()
    {
        return [
            [['url', 'title'], Validation::REQUIRED],
            ['url', Validation::UNIQUE, 'module_navigation_items', 'url']
        ];
    }

    public function __construct($id = null)
    {
        if ($id !== null) {
            $item = NavigationItemManager::model()->read($id);
            $this->_values = $item;
            $this->_initvalues = $this->_values;
        }
    }


    public function save()
    {
        if ($this->validate()) {
            $this->_values['alias'] = TranslitHelper::str2url($this->_values['title']);

            if (isset($this->_values['id']))
                return NavigationItemManager::model()->update($this->_values['id'], $this->_values);

            return NavigationItemManager::model()->create($this->_values);
        }

        return false;
    }
}