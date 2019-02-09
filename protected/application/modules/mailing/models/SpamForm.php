<?php

namespace application\modules\mailing\models;

use src\managers\ModuleManager;
use src\Form;

class SpamForm extends Form
{
    protected $name = 'Spam';
    protected $module;
    protected $labels = [
        'ips' => '{{%Spam IPs%}}'
    ];

    /**
     * SpamForm constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $ips = SpamManager::model()->read();
        $this->values['ips'] = $ips;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function save()
    {
        if (SpamManager::model()->create($this->values) !== false)
            return true;

        $this->errors['success'] = '{{%Errors appeared while saving!%}}';

        return false;
    }
}