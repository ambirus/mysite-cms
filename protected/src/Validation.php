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

    private $_errors;
    private $_rules;
    private $_values;
    private $_initvalues;

    public function __construct($rules = [], $values = [], $initvalues = [])
    {
        $this->_rules = $rules;
        $this->_values = $values;
        $this->_initvalues = $initvalues;
    }

    public function getErrors()
    {
        return $this->_errors;
    }

    public function setError($item, $error)
    {
        $this->_errors[$item] = $error;
    }

    public function run()
    {
        foreach ($this->_rules as $rule) {

            if ($rule[1] == self::REQUIRED) {
                foreach ($rule[0] as $item) {
                    $tmp = isset($this->_values[$item]) ? trim($this->_values[$item]) : '';
                    if (!isset($this->_values[$item]) || empty($tmp))
                        $this->setError($item, $this->validationTypes[self::REQUIRED]);
                }
            }

            if ($rule[1] == self::EMAIL) {
                foreach ($rule[0] as $item) {
                    if (!empty($this->_values[$item]) && preg_match('/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/', $this->_values[$item]) !== 1)
                        $this->setError($item, $this->validationTypes[self::EMAIL]);
                }
            }

            if ($rule[1] == self::PHONE) {
                foreach ($rule[0] as $item) {
                    if (!empty($this->_values[$item]) && preg_match('/^\+[0-9]{1}\ [0-9]{3}\ [0-9]{3}\ [0-9]{4}$/', $this->_values[$item]) !== 1)
                        $this->setError($item, $this->validationTypes[self::PHONE]);
                }
            }

            if ($rule[1] == self::REPEAT) {
                $tmp = null;
                foreach ($rule[0] as $item) {
                    if ($tmp !== null && $tmp != $this->_values[$item])
                        $this->setError($item, $this->validationTypes[self::REPEAT]);
                    $tmp = $this->_values[$item];
                }
            }

            if ($rule[1] == self::UNIQUE) {

                if (sizeof($this->_initvalues) > 0) {
                    if ($this->_initvalues[$rule[0]] == $this->_values[$rule[0]])
                        continue;
                }

                $db = Database::getInstance();
                $query = $db->prepare("SELECT * FROM " . $rule[2] . " WHERE " . $rule[3] . " = :param");
                $query->execute([':param' => $this->_values[$rule[0]]]);
                $answer = $query->fetch();

                if ($answer !== false)
                    $this->setError($rule[0], $this->validationTypes[self::UNIQUE]);
            }

            if ($rule[1] == self::CAPTCHA) {

                if (!isset($_SESSION))
                    @session_start();

                if (sizeof($_SESSION) == 0 || isset($_SESSION) && isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] !== $this->_values[$rule[0]])
                    $this->setError($rule[0], $this->validationTypes[self::CAPTCHA]);
            }

            if ($rule[1] == self::NUMERIC) {
                foreach ($rule[0] as $item) {
                    if (!empty($this->_values[$item]) && is_numeric($this->_values[$item]) === false)
                        $this->setError($item, $this->validationTypes[self::NUMERIC]);
                }
            }
        }

        if (sizeof($this->_errors) == 0)
            return true;

        return false;
    }
}