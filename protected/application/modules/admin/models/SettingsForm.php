<?php
namespace application\modules\admin\models;

use src\Form;
use src\Validation;
use src\managers\ModuleManager;

class SettingsForm extends Form
{
    private $_module;
    protected $_name = 'Settings';
    protected $_labels = [
        'login' => '{{%Admin login%}}',
        'password' => '{{%Admin password%}}',
        'password_repeat' => '{{%Repeat password%}}',
        'last_login' => '{{%Last login%}}'
    ];

    public function __construct()
    {
        $this->_module = ModuleManager::get('admin');
        $config = $this->_module->config();

        foreach ($config as $k => $v) {
            $this->_values[$k] = $v;
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

            $this->_values['password'] = md5($this->_values['password']);

            if ($this->_module->save($this->_values) !== false)
                return true;

            $this->_errors['success'] = '{{%Errors appeared while saving!%}}';
        }

        return false;
    }
}