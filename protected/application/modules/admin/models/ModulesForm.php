<?php

namespace application\modules\admin\models;

use src\Form;
use src\managers\ModuleManager;

class ModulesForm extends Form
{
    protected $name = 'Modules';
    protected $labels = [
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

                if (isset($this->values['state']) && in_array($alias, $this->values['state'])) {
                    $values['state'] = 1;
                }

                if (isset($this->values['installed']) && in_array($alias, $this->values['installed'])) {
                    $values['installed'] = 1;
                }

                if ($module->save($values) === false) {
                    return false;
                }
            }
        }

        return true;
    }
}