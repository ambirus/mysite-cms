<?php

namespace src;

class Validation
{
    const REQUIRED = 'required';
    const EMAIL = 'email';
    const PHONE = 'phone';
    const REPEAT = 'repeat';
    const UNIQUE = 'unique';
    const CAPTCHA = 'captcha';
    const NUMERIC = 'numeric';

    private $validationTypes = [
        self::REQUIRED => '{{%Required field%}}',
        self::EMAIL => '{{%Incorrect email%}}',
        self::PHONE => '{{%Incorrect phone%}} (+9 999 999 9999)',
        self::REPEAT => '{{%Input values must be equal%}}',
        self::UNIQUE => '{{%Input value must be unique%}}',
        self::CAPTCHA => '{{%Input correct verification code%}}',
        self::NUMERIC => '{{%Numeric value is expected%}}'
    ];

    private $errors;
    private $rules;
    private $values;
    private $initvalues;

    public function __construct($rules = [], $values = [], $initvalues = [])
    {
        $this->rules = $rules;
        $this->values = $values;
        $this->initvalues = $initvalues;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function setError($item, $error)
    {
        $this->errors[$item] = $error;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function run()
    {
        foreach ($this->rules as $rule) {

            if ($rule[1] == self::REQUIRED) {
                foreach ($rule[0] as $item) {
                    $tmp = isset($this->values[$item]) ? trim($this->values[$item]) : '';
                    if (!isset($this->values[$item]) || empty($tmp))
                        $this->setError($item, $this->validationTypes[self::REQUIRED]);
                }
            }

            if ($rule[1] == self::EMAIL) {
                foreach ($rule[0] as $item) {
                    if (!empty($this->values[$item]) &&
                        preg_match('/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/',
                            $this->values[$item]) !== 1) {
                        $this->setError($item, $this->validationTypes[self::EMAIL]);
                    }
                }
            }

            if ($rule[1] == self::PHONE) {
                foreach ($rule[0] as $item) {
                    if (!empty($this->values[$item]) &&
                        preg_match('/^\+[0-9]{1}\ [0-9]{3}\ [0-9]{3}\ [0-9]{4}$/',
                            $this->values[$item]) !== 1) {
                        $this->setError($item, $this->validationTypes[self::PHONE]);
                    }
                }
            }

            if ($rule[1] == self::REPEAT) {
                $tmp = null;
                foreach ($rule[0] as $item) {
                    if ($tmp !== null && $tmp != $this->values[$item]) {
                        $this->setError($item, $this->validationTypes[self::REPEAT]);
                    }
                    $tmp = $this->values[$item];
                }
            }

            if ($rule[1] == self::UNIQUE) {

                if (sizeof($this->initvalues) > 0) {
                    if ($this->initvalues[$rule[0]] == $this->values[$rule[0]]) {
                        continue;
                    }
                }

                $db = Database::getInstance();
                $query = $db->prepare("SELECT * FROM " . $rule[2] . " WHERE " . $rule[3] . " = :param");
                $query->execute([':param' => $this->values[$rule[0]]]);
                $answer = $query->fetch();

                if ($answer !== false) {
                    $this->setError($rule[0], $this->validationTypes[self::UNIQUE]);
                }
            }

            if ($rule[1] == self::CAPTCHA) {

                if (!isset($_SESSION)) {
                    @session_start();
                }

                if (sizeof($_SESSION) == 0 || isset($_SESSION) && isset($_SESSION['captcha_keystring']) &&
                    $_SESSION['captcha_keystring'] !== $this->values[$rule[0]]) {
                    $this->setError($rule[0], $this->validationTypes[self::CAPTCHA]);
                }
            }

            if ($rule[1] == self::NUMERIC) {
                foreach ($rule[0] as $item) {
                    if (!empty($this->values[$item]) && is_numeric($this->values[$item]) === false) {
                        $this->setError($item, $this->validationTypes[self::NUMERIC]);
                    }
                }
            }
        }

        if (sizeof($this->errors) == 0) {
            return true;
        }

        return false;
    }
}