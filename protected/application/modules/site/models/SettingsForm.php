<?php

namespace application\modules\site\models;

use src\managers\ModuleManager;
use src\Form;
use src\Validation;

class SettingsForm extends Form
{
    protected $name = 'Settings';
    protected $module;
    protected $labels = [
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

    /**
     * SettingsForm constructor.
     */
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

            if ($this->module->save($this->values) !== false)
                return true;

            $this->errors['success'] = '{{%Errors appeared while saving!%}}';
        }

        return false;
    }
}