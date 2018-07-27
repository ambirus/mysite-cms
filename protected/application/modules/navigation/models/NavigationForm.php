<?php
namespace application\modules\navigation\models;

use src\Form;
use src\Validation;

class NavigationForm extends Form
{
    protected $_name = 'Navigation';
    protected $_labels = [
        'alias' => 'Псевдоним',
        'name' => 'Название',
        'state' => 'Активность'
    ];

    protected function rules()
    {
        return [
            [['alias', 'name'], Validation::REQUIRED]
        ];
    }

    public function __construct($id = null)
    {
        if ($id !== null) {
            $menu = NavigationManager::model()->read($id);

            $this->_values = [
                'id' => $menu['menu']['id'],
                'alias' => $menu['menu']['alias'],
                'name' => $menu['menu']['name'],
                'state' => $menu['menu']['state']
            ];
        }
    }


    public function save()
    {
        return true;
    }
}