<?php

namespace application\modules\admin\models;

use src\Form;
use src\Validation;
use src\managers\ModuleManager;

class SettingsForm extends Form
{
    private $module;
    protected $name = 'Settings';
    protected $labels = [
        'login' => '{{%Admin login%}}',
        'password' => '{{%Admin password%}}',
        'password_repeat' => '{{%Repeat password%}}',
        'last_login' => '{{%Last login%}}'
    ];

    /**
     * SettingsForm constructor.
     */
    public function __construct()
    {
        $this->module = ModuleManager::get('admin');
        $config = $this->module->config();

        foreach ($config as $k => $v) {
            $this->values[$k] = $v;
        }
    }

    protected function rules()
    {
        return [
            [['login', 'password'], Validation::REQUIRED],
            [['password', 'password_repeat'], Validation::REPEAT]
        ];
    }

    public function save()
    {
        if ($this->validate()) {

            $this->values['password'] = md5($this->values['password']);

            if ($this->module->save($this->values) !== false) {
                return true;
            }

            $this->errors['success'] = '{{%Errors appeared while saving!%}}';
        }

        return false;
    }
}