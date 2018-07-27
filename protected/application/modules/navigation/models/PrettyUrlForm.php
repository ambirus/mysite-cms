<?php
namespace application\modules\navigation\models;

use src\Form;
use src\Validation;

class PrettyUrlForm extends Form
{
    protected $_name = 'PrettyUrl';

    protected $_labels = [
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

    public function __construct($id = null)
    {
        $this->_model = new PrettyUrl();
        parent::__construct();

        if ($id !== null) {
            $item = $this->_model->read($id);
            $this->_values = $item;
        }

        $this->_initvalues = $this->_values;
    }

    public function save()
    {
        if ($this->validate()) {
            unset($this->_values['modelItem']);

            if (isset($this->_values['id']))
                return (new PrettyUrl())->update($this->_values['id'], $this->_values);

            return (new PrettyUrl())->create($this->_values);
        }

        return false;
    }
}