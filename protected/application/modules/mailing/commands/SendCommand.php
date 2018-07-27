<?php

namespace application\modules\mailing\commands;

use application\modules\mailing\models\MailList;
use application\modules\mailing\models\Status;

class SendCommand
{
    public function actionIndex()
    {
        $status = \src\jobs\Status::STATUS_DONE;

        $list = (new MailList())
                ->setOrderBy('id ASC')
                ->readBy(['status' => Status::STATUS_NEW]);

        if ($list['total'] > 0) {
            foreach ($list['items'] as $item) {
                $sender = unserialize($item['data']);

                if ($sender->send()) {
                    (new MailList())->update($item['id'], [
                        'status' => Status::STATUS_DONE
                    ]);
                } else $status = \src\jobs\Status::STATUS_INQUEUE;
            }
        }

        echo $status;
    }
}