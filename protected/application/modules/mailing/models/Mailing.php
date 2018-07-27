<?php

namespace application\modules\mailing\models;

use application\modules\core\models\jobs\Job;
use src\managers\ModuleManager;
use application\helpers\IpHelper;

class Mailing
{
    private $_emails = [];
    private $_topic;
    private $_content;
    private $_mailer;
    private $_headers;
    private $_module;

    public function __construct()
    {
        $this->_module = ModuleManager::get('mailing');
        $config = $this->_module->config();
        $this->_mailer = 'application\modules\mailing\models\\' . ucfirst($config['mailType']) . 'Sender';
    }

    public function addHeaders($headers)
    {
        $this->_headers = $headers;
    }

    public function addTopic($topic)
    {
        $this->_topic = $topic;
    }

    public function addContentBody($content)
    {
        $this->_content = $content;
    }

    public function addReceiver($email)
    {
        $this->_emails[] = $email;
    }

    public function getTopic()
    {
        return $this->_topic;
    }

    public function getHeaders()
    {
        return $this->_headers;
    }

    public function getContentBody()
    {
        return $this->_content;
    }

    public function getReceivers()
    {
        return $this->_emails;
    }

    public function checkIsSpamIP()
    {
        $spamIps = SpamManager::model()->read();

        if (strpos($spamIps, IpHelper::getClientIp()) === false)
            return false;

        return true;
    }

    public function send()
    {
        if ($this->checkIsSpamIP() === true)
            return true;

        if (sizeof($this->_emails) > 0) {

            $sender = new $this->_mailer([
                'headers' => $this->getHeaders(),
                'subject' => $this->getTopic(),
                'message' => $this->getContentBody()
            ]);

            $success = true;

            foreach ($this->_emails as $email) {
                $sender->addEmail($email);
            }

            $res = (new MailList())->create([
                'data' => serialize($sender)
            ]);

            if (intval($res) == 0 || intval((new Job())->create([
                    'module' => $this->_module->getAlias(),
                    'command' => 'send'
                ])) == 0)
                $success = false;

            return $success;
        }
    }
}