<?php
namespace application\modules\site\models;

use src\managers\ModuleManager;
use src\Form;
use src\Validation;

class SettingsForm extends Form
{
    protected $_name = 'Settings';
    protected $_module;
    protected $_labels = [
        'appName' => '{{%Site name%}}',
        'theme' => '{{%Site theme%}}',
        'mail' => '{{%Contact email%}}',
        'mainPage' => '{{%Main page%}}',
        'captcha' => '{{%Use captcha while log in%}}'
    ];

    protected function rules()
    {
        return [
            [['appName', 'mail', 'mainPage'], Validation::REQUIRED]
        ];
    }

    public function __construct()
    {
        $this->_module = ModuleManager::get('site');
        $config = $this->_module->config();

        foreach ($config as $k => $v) {
            $this->_values[$k] = $v;
        }
    }

    public function save()
    {
        if ($this->validate()) {

            if ($this->_module->save($this->_values) !== false)
                return true;

            $this->_errors['success'] = '{{%Errors appeared while saving!%}}';
        }

        return false;
    }
}