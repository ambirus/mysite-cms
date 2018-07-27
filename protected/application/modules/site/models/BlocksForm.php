<?php
namespace application\modules\site\models;

use src\managers\ModuleManager;
use src\Form;

class BlocksForm extends Form
{
    protected $_name = 'Blocks';
    protected $_module;
    protected $_labels = [
        'header' => '{{%Site header%}}',
        'logo' => '{{%Site logo%}}',
        'google' => '{{%Google block%}}',
        'links' => '{{%Site links%}}',
        'yandex' => '{{%Yandex block%}}',
        'footer' => '{{%Site footer%}}'
    ];

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