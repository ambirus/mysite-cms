<?php

namespace application\modules\navigation\models;

use src\Form;
use src\Validation;

class NavigationItemsForm extends Form
{
    protected $name = 'NavigationItems';

    public function __construct($id = null)
    {
        if ($id !== null) {
            $menu = NavigationManager::model()->readItems($id);
            $this->values = $menu;
        }
    }


    public function save()
    {
        foreach ($this->values['items'] as $k => $item) {

            $data['state'] = $item['state'];
            $data['url'] = $item['url'];
            $data['alias'] = $item['alias'];
            $data['title'] = $item['title'];
            $data['order_num'] = $item['order_num'];

            if (isset($this->values['state']) && in_array($k, $this->values['state'])) {
                $data['state'] = 1;
            } else $data['state'] = 0;

            if (isset($this->values['order_num']) && isset($this->values['order_num'][$k])) {
                $data['order_num'] = $this->values['order_num'][$k];
            }

            if (NavigationItemManager::model()->update($k, $data) === false)
                return false;
        }

        return true;
    }
}