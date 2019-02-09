<?php

namespace application\modules\site\models;

use src\managers\ModuleManager;
use src\Form;

class BlocksForm extends Form
{
    protected $name = 'Blocks';
    protected $module;
    protected $labels = [
        'header' => '{{%Site header%}}',
        'logo' => '{{%Site logo%}}',
        'google' => '{{%Google block%}}',
        'links' => '{{%Site links%}}',
        'yandex' => '{{%Yandex block%}}',
        'footer' => '{{%Site footer%}}'
    ];

    public function __construct()
    {
        $this->module = ModuleManager::get('site');
        $config = $this->module->config();

        foreach ($config as $k => $v) {
            $this->values[$k] = $v;
        }
    }

    public function save()
    {
        if ($this->validate()) {

            if ($this->module->save($this->values) !== false) {
                return true;
            }

            $this->errors['success'] = '{{%Errors appeared while saving!%}}';
        }

        return false;
    }
}