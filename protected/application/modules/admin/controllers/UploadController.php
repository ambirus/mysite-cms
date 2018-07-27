<?php
namespace application\modules\admin\controllers;

use src\App;

class UploadController extends AdminController
{
    public function actionIndex()
    {
        if (isset($_FILES['upload']) && $_FILES['upload']['error'] == 0) {

            $uploadsPath = App::config()['uploadsPath'] . DIRECTORY_SEPARATOR;
            $callback = $_GET['CKEditorFuncNum'];
            $file_name = $_FILES['upload']['name'];
            $file_name_tmp = $_FILES['upload']['tmp_name'];
            $full_path = $uploadsPath.$file_name;
            $http_path = '/' . App::config()['uploadsWebPath'] . '/'.$file_name;
            $error = '';

            if (@getimagesize($file_name_tmp)) {
                if (move_uploaded_file($file_name_tmp, $full_path) === false) {
                    $error = 'Some error occured, please try again later';
                    $http_path = '';
                }
            } else {
                $error = 'Only images are allowed!';
                $http_path = '';
            }



            echo "<script type=\"text/javascript\">window.parent.CKEDITOR.tools.callFunction(".$callback.",  \"".$http_path."\", \"".$error."\" );</script>";

        }
    }

    public function actionBrowse()
    {
        $arr = [];
        $uploadsPath = App::config()['uploadsPath'] . DIRECTORY_SEPARATOR;
        $files = scandir($uploadsPath);

        foreach ($files as $file) {
            if (@getimagesize(App::config()['uploadsPath'] . DIRECTORY_SEPARATOR . $file)) {
                $arr[] = [
                  "image" => '/' . App::config()['uploadsWebPath'] . '/' .$file
                ];
            }
        }

        echo json_encode($arr);
    }
}