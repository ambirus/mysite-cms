<?php

namespace application\modules\core\commands;

use application\modules\core\models\jobs\Job;
use src\jobs\Status;
use src\managers\JobManager;

class JobCommand
{
    public function actionIndex()
    {
        $newJobs = (new JobManager())->getNewJobs();

        if ($newJobs != 0) {
            foreach ($newJobs as $job) {
                var_dump($job) . "\n";
            }

        } else echo "No jobs found!";

        /*
        $items = (new Job())->setOrderBy('priority ASC')
                    ->readBy([
                        'status' => Status::STATUS_INQUEUE
                    ]);

        if ($items['total'] > 0) {

            $bash = '';

            if (PHP_OS == 'Linux') {
                $bash = './';
            }

            foreach ($items['items'] as $item) {

                (new Job())->update($item['id'], [
                    'status' => Status::STATUS_ACTIVE
                ]);

                $jobName = $item['module'] . '/' . $item['command'];

                echo "Preparing for a job start (" . $jobName . ")..." . "\n";
                $output = shell_exec($bash . 'mysite ' . $jobName . ' 2>&1 &');

                if (sizeof($output) > 1 || intval($output[0]) != Status::STATUS_DONE) {
                    (new Job())->update($item['id'], [
                        'status' => Status::STATUS_INQUEUE
                    ]);
                } else {
                    (new Job())->update($item['id'], [
                        'status' => Status::STATUS_DONE,
                        'finished_at' => date('Y-m-d H:i:s')
                    ]);
                }

                unset($output);

                echo "Job (" . $jobName . ") has finished!" . "\n";
            }


        } else echo "No jobs found!"; */
    }
}