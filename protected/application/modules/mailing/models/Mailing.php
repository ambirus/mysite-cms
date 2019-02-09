<?php

namespace application\modules\mailing\models;

use application\modules\core\models\jobs\Job;
use src\managers\ModuleManager;
use application\helpers\IpHelper;

class Mailing
{
    private $emails = [];
    private $topic;
    private $content;
    private $mailer;
    private $headers;
    private $module;

    public function __construct()
    {
        $this->module = ModuleManager::get('mailing');
        $config = $this->module->config();
        $this->mailer = 'application\modules\mailing\models\\' . ucfirst($config['mailType']) . 'Sender';
    }

    public function addHeaders($headers)
    {
        $this->headers = $headers;
    }

    public function addTopic($topic)
    {
        $this->topic = $topic;
    }

    public function addContentBody($content)
    {
        $this->content = $content;
    }

    public function addReceiver($email)
    {
        $this->emails[] = $email;
    }

    public function getTopic()
    {
        return $this->topic;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getContentBody()
    {
        return $this->content;
    }

    public function getReceivers()
    {
        return $this->emails;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function checkIsSpamIP()
    {
        $spamIps = SpamManager::model()->read();

        if (strpos($spamIps, IpHelper::getClientIp()) === false) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function send()
    {
        if ($this->checkIsSpamIP() === true) {
            return true;
        }

        if (sizeof($this->emails) > 0) {

            $sender = new $this->mailer([
                'headers' => $this->getHeaders(),
                'subject' => $this->getTopic(),
                'message' => $this->getContentBody()
            ]);

            $success = true;

            foreach ($this->emails as $email) {
                $sender->addEmail($email);
            }

            $res = (new MailList())->create([
                'data' => serialize($sender)
            ]);

            if (intval($res) == 0 || intval((new Job())->create([
                    'module' => $this->module->getAlias(),
                    'command' => 'send'
                ])) == 0)
                $success = false;

            return $success;
        }
    }
}