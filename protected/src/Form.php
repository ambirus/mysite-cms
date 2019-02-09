<?php

namespace src;

use Exception;

abstract class Form
{
    protected $model;
    protected $name;
    protected $labels;
    protected $names;
    protected $values;
    protected $initvalues;
    protected $errors;

    protected function rules()
    {
        return [];
    }

    /**
     * Form constructor.
     * @throws Exception
     */
    public function __construct()
    {
        if ($this->name === null) {
            throw new Exception("Name of model should be defined");
        }

        $this->labels = $this->labels();
        $this->names = $this->names();
    }

    /**
     * @return bool
     */
    public function validate()
    {
        if (sizeof($this->rules()) == 0) {
            return true;
        }

        foreach ($this->labels as $k => $v) {
            $this->errors[$k] = '';
        }

        $validation = new Validation($this->rules(), $this->values, $this->initvalues);

        if (!$validation->run()) {

            $errors = $validation->getErrors();

            foreach ($errors as $k => $v) {
                if (isset($this->_errors[$k])) {
                    $this->errors[$k] = $v;
                }
            }

            return false;
        }

        return true;
    }

    /**
     * @param $data
     * @return bool
     */
    public function load($data)
    {
        if (sizeof($data) > 0 && isset($data[$this->name])) {
            foreach ($data[$this->name] as $k => $v) {
                $this->values[$k] = $v;
            }
            return true;
        }
        return false;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function save()
    {
        if ($this->validate()) {
            if ($this->model === null) {
                throw new Exception("Model should be defined");
            }

            if (isset($this->_values['id'])) {
                return $this->model->update($this->values['id'], $this->values);
            }

            return $this->model->create($this->values);
        }

        return false;
    }

    /**
     * @param null $attribute
     * @return mixed
     */
    public function labels($attribute = null)
    {
        return $attribute !== null ? $this->labels[$attribute] : $this->labels;
    }

    /**
     * @param null $attribute
     * @return mixed
     */
    public function names($attribute = null)
    {
        if ($attribute !== null) {
            $this->names[$attribute] = $this->name . '[' . $attribute . ']';
            return $this->names[$attribute];
        }

        foreach ($this->labels as $k => $v) {
            $this->names[$k] = $this->name . '[' . $k . ']';
        }

        return $this->names;
    }

    /**
     * @param null $attribute
     * @return mixed
     */
    public function values($attribute = null)
    {
        return $attribute !== null ? $this->values[$attribute] : $this->values;
    }

    /**
     * @param null $attribute
     * @return null
     */
    public function errors($attribute = null)
    {
        if ($attribute !== null) {
            if (isset($this->errors[$attribute])) {
                return $this->errors[$attribute];
            }
            return null;
        }

        return $this->errors;
    }

    /**
     * @param $attribute
     * @param $message
     */
    public function setError($attribute, $message)
    {
        $this->errors[$attribute] = $message;
    }
}