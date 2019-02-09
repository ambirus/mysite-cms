<?php

namespace application\modules\mailing\models;

use src\managers\ModuleManager;
use src\Form;
use src\Validation;

class SettingsForm extends Form
{
    protected $name = 'Settings';
    protected $module;
    protected $labels = [
        'mailType' => '{{%Mailing type%}}'
    ];

    protected function rules()
    {
        return [
            [['mailType'], Validation::REQUIRED]
        ];
    }

    /**
     * SettingsForm constructor.
     */
    public function __construct()
    {
        $this->module = ModuleManager::get('mailing');
        $config = $this->module->config();

        foreach ($config as $k => $v) {
            $this->values[$k] = $v;
        }
    }

    public function save()
    {
        if ($this->validate()) {

            if ($this->module->save($this->values) !== false)
                return true;

            $this->errors['success'] = '{{%Errors appeared while saving!%}}';
        }

        return false;
    }
}