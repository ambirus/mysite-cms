<?php

namespace application\modules\navigation\models;

use src\Form;
use src\Validation;

class PrettyUrlForm extends Form
{
    protected $name = 'PrettyUrl';

    protected $labels = [
        'model' => '{{%Model%}}',
        'fullUrl' => '{{%Full url%}}',
        'shortUrl' => '{{%Short url%}}',
        'modelItem' => '{{%Model element%}}'
    ];

    protected function rules()
    {
        return [
            [['model', 'fullUrl', 'shortUrl'], Validation::REQUIRED],
            ['shortUrl', Validation::UNIQUE, (new PrettyUrl())->tableName(), 'shortUrl']
        ];
    }

    /**
     * PrettyUrlForm constructor.
     * @param null $id
     * @throws \Exception
     */
    public function __construct($id = null)
    {
        $this->model = new PrettyUrl();
        parent::__construct();

        if ($id !== null) {
            $item = $this->model->read($id);
            $this->values = $item;
        }

        $this->initvalues = $this->values;
    }

    /**
     * @return bool|string
     */
    public function save()
    {
        if ($this->validate()) {
            unset($this->values['modelItem']);

            if (isset($this->values['id']))
                return (new PrettyUrl())->update($this->values['id'], $this->values);

            return (new PrettyUrl())->create($this->values);
        }

        return false;
    }
}