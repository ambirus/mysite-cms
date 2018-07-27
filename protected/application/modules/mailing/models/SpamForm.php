<?php
namespace application\modules\mailing\models;

use src\managers\ModuleManager;
use src\Form;

class SpamForm extends Form
{
    protected $_name = 'Spam';
    protected $_module;
    protected $_labels = [
        'ips' => '{{%Spam IPs%}}'
    ];

    public function __construct()
    {
        $ips = SpamManager::model()->read();
        $this->_values['ips'] = $ips;
    }

    public function save()
    {
        if (SpamManager::model()->create($this->_values) !== false)
            return true;

        $this->_errors['success'] = '{{%Errors appeared while saving!%}}';

        return false;
    }
}