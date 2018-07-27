<?php
namespace application\modules\admin\models;

use src\Form;
use application\modules\admin\models\users\AuthManager;
use src\managers\ModuleManager;
use src\Validation;

class LoginForm extends Form
{
    protected $_name = 'Login';
    protected $_labels = [
        'login' => '{{%Admin login%}}',
        'password' => '{{%Admin password%}}',
        'captcha' => '{{%Verification code%}}',
    ];

    protected function rules()
    {
        $rules = [
            [['login', 'password'], Validation::REQUIRED]
        ];

        if (ModuleManager::get('site')->config()['captcha'] == 1)
            array_push($rules, ['captcha', Validation::CAPTCHA]);

        return $rules;
    }

    public function save()
    {
        if ($this->validate()) {
            if (AuthManager::getInstance()->login($this->_values['login'], $this->_values['password']) !== false)
                return true;

            $this->_errors['success'] = '{{%The user is not exists!%}}';
        }

        return false;
    }
}