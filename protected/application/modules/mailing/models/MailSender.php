<?php
namespace application\modules\mailing\models;

class MailSender extends Sender
{
    public function send()
    {
        if (sizeof($this->params) > 0 && sizeof($this->emails) > 0) {
            foreach ($this->emails as $email) {
                if (!mail($email, $this->params['subject'], $this->params['message'], implode('', $this->params['headers'])))
                    return false;
            }
        }

        return true;
    }
}