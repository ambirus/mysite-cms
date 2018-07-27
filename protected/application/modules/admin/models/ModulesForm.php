<?php
namespace application\modules\admin\models;

use src\Form;
use src\managers\ModuleManager;

class ModulesForm extends Form
{
    protected $_name = 'Modules';
    protected $_labels = [
        'installed' => '{{%Installed%}}',
        'state' => '{{%Active%}}'
    ];

    public function save()
    {
        $modules = ModuleManager::get();

        foreach ($modules as $alias => $module) {
            if (!isset($module->config()['disabled'])) {

                $values['state'] = 0;
                $values['installed'] = 0;

                if (isset($this->_values['state']) && in_array($alias, $this->_values['state']))
                    $values['state'] = 1;

                if (isset($this->_values['installed']) && in_array($alias, $this->_values['installed']))
                    $values['installed'] = 1;

                if ($module->save($values) === false)
                    return false;
            }
        }

        return true;
    }
}