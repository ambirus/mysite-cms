<?php
namespace src;

use Exception;

abstract class Form
{
    protected $_model;
    protected $_name;
    protected $_labels;
    protected $_names;
    protected $_values;
    protected $_initvalues;
    protected $_errors;

    protected function rules()
    {
        return [];
    }

    public function __construct()
    {
        if ($this->_name === null)
            throw new Exception("Name of model should be defined");

        $this->_labels = $this->labels();
        $this->_names = $this->names();
    }

    public function validate()
    {
        if (sizeof($this->rules()) == 0)
            return true;

        foreach ($this->_labels as $k => $v) {
            $this->_errors[$k] = '';
        }

        $validation = new Validation($this->rules(), $this->_values, $this->_initvalues);

        if (!$validation->run()) {
            $errors = $validation->getErrors();

            foreach ($errors as $k => $v) {
                if (isset($this->_errors[$k]))
                    $this->_errors[$k] = $v;
            }

        } else return true;

        return false;
    }

    public function load($data)
    {
        if (sizeof($data) > 0 && isset($data[$this->_name])) {
            foreach ($data[$this->_name] as $k => $v) {
                $this->_values[$k] = $v;
            }
            return true;
        }
        return false;
    }

    public function save() {

        if ($this->validate()) {

            if ($this->_model === null)
                throw new Exception("Model should be defined");

            if (isset($this->_values['id']))
                return $this->_model->update($this->_values['id'], $this->_values);

            return $this->_model->create($this->_values);
        }

        return false;
    }

    public function labels($attribute = null)
    {
        return $attribute !== null ? $this->_labels[$attribute] : $this->_labels;
    }

    public function names($attribute = null)
    {
        if ($attribute !== null) {
            $this->_names[$attribute] = $this->_name . '[' . $attribute . ']';
            return $this->_names[$attribute];
        }

        foreach ($this->_labels as $k => $v) {
            $this->_names[$k] = $this->_name . '[' . $k . ']';
        }

        return $this->_names;
    }

    public function values($attribute = null)
    {
        return $attribute !== null ? $this->_values[$attribute] : $this->_values;
    }

    public function errors($attribute = null)
    {
        if ($attribute !== null) {
            if (isset($this->_errors[$attribute]))
                return $this->_errors[$attribute];
            return null;
        }

        return $this->_errors;
    }

    public function setError($attribute, $message) {
        $this->_errors[$attribute] = $message;
    }
}