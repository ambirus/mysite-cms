<?php

namespace application\modules\admin\models;

use src\Form;
use application\modules\admin\models\users\AuthManager;
use src\managers\ModuleManager;
use src\Validation;

class LoginForm extends Form
{
    protected $name = 'Login';
    protected $labels = [
        'login' => '{{%Admin login%}}',
        'password' => '{{%Admin password%}}',
        'captcha' => '{{%Verification code%}}',
    ];

    protected function rules()
    {
        $rules = [
            [['login', 'password'], Validation::REQUIRED]
        ];

        if (ModuleManager::get('site')->config()['captcha'] == 1) {
            array_push($rules, ['captcha', Validation::CAPTCHA]);
        }

        return $rules;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function save()
    {
        if ($this->validate()) {
            if (AuthManager::getInstance()->login($this->values['login'], $this->values['password']) !== false) {
                return true;
            }

            $this->errors['success'] = '{{%The user is not exists!%}}';
        }

        return false;
    }
}