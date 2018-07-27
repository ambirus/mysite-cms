<?php
namespace application\modules\navigation\models;

use src\Form;
use src\Validation;

class NavigationItemsForm extends Form
{
    protected $_name = 'NavigationItems';

    public function __construct($id = null)
    {
        if ($id !== null) {
            $menu = NavigationManager::model()->readItems($id);
            $this->_values = $menu;
        }
    }


    public function save()
    {
        foreach ($this->_values['items'] as $k => $item) {

            $data['state'] = $item['state'];
            $data['url'] = $item['url'];
            $data['alias'] = $item['alias'];
            $data['title'] = $item['title'];
            $data['order_num'] = $item['order_num'];

            if (isset($this->_values['state']) && in_array($k, $this->_values['state'])) {
                $data['state'] = 1;
            } else $data['state'] = 0;

            if (isset($this->_values['order_num']) && isset($this->_values['order_num'][$k])) {
                $data['order_num'] = $this->_values['order_num'][$k];
            }

            if (NavigationItemManager::model()->update($k, $data) === false)
                return false;
        }

        return true;
    }
}