<?php
namespace application\modules\mailing\models;

use src\managers\ModuleManager;
use src\Form;
use src\Validation;

class SettingsForm extends Form
{
    protected $_name = 'Settings';
    protected $_module;
    protected $_labels = [
        'mailType' => '{{%Mailing type%}}'
    ];

    protected function rules()
    {
        return [
            [['mailType'], Validation::REQUIRED]
        ];
    }

    public function __construct()
    {
        $this->_module = ModuleManager::get('mailing');
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