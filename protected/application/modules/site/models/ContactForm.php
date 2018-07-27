<?php
namespace application\modules\site\models;

use application\components\geo\IpManager;
use application\helpers\IpHelper;
use src\App;
use application\modules\mailing\models\Mailing;
use src\I18n;
use src\managers\ModuleManager;
use src\Form;
use src\Validation;

class ContactForm extends Form
{
    protected $_name = 'Contacts';
    protected $_labels = [
        'name' => '{{%Your name%}}',
        'email' => '{{%Your e-mail%}}',
        'captcha' => '{{%Verification code%}}',
        'message' => '{{%Message%}}',
        'agreed' => '{{%I agree that my email box will be used solely for feedback and will not be passed on to third parties%}}'
    ];

    protected function rules()
    {
        return [
            [['name', 'email', 'message', 'agreed'], Validation::REQUIRED],
            [['email'], Validation::EMAIL],
            ['captcha', Validation::CAPTCHA]
        ];
    }

    public function save()
    {
        if ($this->validate()) {

            $ip = IpHelper::getClientIp();
            $ipManager = new IpManager($ip);

            $str = '<p><b>Откуда:</b> ' . $ipManager->getCountry() . ', ' . $ipManager->getCity() .' (IP: ' . $ip . ')</p>' . "\n";

            foreach ($this->_labels as $k => $v) {
                if ($k != 'captcha' && $k != 'agreed') {
                    $str .= '<p><b>' . I18n::translate($v) . ':</b> ' . $this->_values[$k] . '</p>' . "\n";
                }
            }

            $config = ModuleManager::get('site')->config();

            $mailing = new Mailing();
            $mailing->addHeaders([
                "From: " . $config['mail'] . "\r\n",
                "Reply-To: ". $this->values()['email'] . "\r\n",
                "MIME-Version: 1.0\r\n",
                "Content-Type: text/html; charset=UTF-8\r\n"
            ]);
            $mailing->addTopic(I18n::translate('{{%You have a new message from "Contacts" site%}}'));
            $mailing->addContentBody($str);
            $mailing->addReceiver($config['mail']);

            if ($mailing->send()) {
                $this->_values = null;
                return true;
            } else $this->_errors['success'] = '{{%Cannot send your message! Try it again later!%}}';
        }

        return false;
    }
}