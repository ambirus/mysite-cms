<?php

namespace application\modules\navigation\models;

use application\helpers\TranslitHelper;
use src\Form;
use src\Validation;

class NavigationItemForm extends Form
{
    protected $name = 'NavigationItem';
    protected $labels = [
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

    /**
     * NavigationItemForm constructor.
     * @param null $id
     * @throws \Exception
     */
    public function __construct($id = null)
    {
        if ($id !== null) {
            $item = NavigationItemManager::model()->read($id);
            $this->values = $item;
            $this->initvalues = $this->values;
        }
    }


    public function save()
    {
        if ($this->validate()) {
            $this->values['alias'] = TranslitHelper::str2url($this->values['title']);

            if (isset($this->values['id']))
                return NavigationItemManager::model()->update($this->values['id'], $this->values);

            return NavigationItemManager::model()->create($this->values);
        }

        return false;
    }
}