<?php

namespace src\managers;

use application\modules\core\models\jobs\Job;
use src\jobs\Status;

class JobManager
{
    public function getNewJobs()
    {
        $jobs = (new Job())->setOrderBy('priority ASC')->readBy(['status' => Status::STATUS_INQUEUE]);

        if ($jobs['total'] > 0)
            return $jobs['items'];

        return 0;
    }
}