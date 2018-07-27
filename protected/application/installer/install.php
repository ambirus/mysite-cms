<?php

class Installator
{
    private $_initValues = [
        'dbname' => 'mysitecms',
        'dbuser' => 'root',
        'dbpass' => 'root',
        'dbhost' => 'localhost',
        'siteName' => 'MySite CMS',
        'adminLogin' => 'admin',
        'adminPassword' => 'admin',
        'siteTheme' => 'blue',
        'email' => 'admin@example.com',
        'siteLanguage' => 'en',
    ];

    public function run()
    {
        if (isset($_GET['lang']))
            \src\I18n::changeLang($_GET['lang']);

        $values = $this->_initValues;

        if (isset($_POST['Install'])) {

            foreach ($_POST['Install'] as $key => $value) {
                $values[$key] = $value;
            }

            foreach ($_POST['Install'] as $key => $value) {
                if (trim($value) == '' && $key != 'dbpass') {
                    $error = "{{%Fill up all fields!%}}";
                    break;
                }
                $replaces[$key] = trim($value);
            }

            if (!isset($error)) {

                $createdb = isset($replaces['dbcurrent']) ? '' : 'CREATE DATABASE IF NOT EXISTS `' . $replaces['dbname'] . '` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;';

                $sql = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'mysitecms.sql');
                $sql = str_replace([
                    '{{%CREATEDB%}}',
                    '{{%DBNAME%}}',
                    '{{%LOGINADMIN%}}',
                    '{{%PASSADMIN%}}',
                    '{{%NAMESITE%}}',
                    '{{%THEMESITE%}}',
                    '{{%LANGSITE%}}',
                    '{{%CONTACTMAIL%}}'
                    ],
                    [
                        $createdb,
                        $replaces['dbname'],
                        $replaces['adminLogin'],
                        md5($replaces['adminPassword']),
                        $replaces['siteName'],
                        $replaces['siteTheme'],
                        $replaces['siteLanguage'],
                        $replaces['email']
                    ], $sql);

                try {
                    $db = new PDO('mysql:host=' . $replaces['dbhost'], $replaces['dbuser'], $replaces['dbpass']);
                    $query = $db->prepare("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . $replaces['dbname'] . "' ");
                    $query->execute();
                    if ($createdb != '' && $query->fetch() !== false) {
                        $error = "{{%Database of previous installation was found. You need to drop it or select another name for the new one!%}}";
                    } else {
                        $query = $db->prepare($sql);
                        $res = $query->execute();

                        if ($res === true) {
                            $success = "<p>{{%Database was successfully created!%}}</p>";
                            $success .= "<p>{{%Create a file db.php in &laquo;protected&raquo; directory and put in it the next code then save it: %}}</p>";
                            $text = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'db-sample.php');
                            $text = str_replace([
                                "'host' => ''",
                                "'database' => ''",
                                "'login' => ''",
                                "'password' => ''"
                            ], [
                                "'host' => '" . $replaces['dbhost'] . "'",
                                "'database' => '" . $replaces['dbname'] . "'",
                                "'login' => '" . $replaces['dbuser'] . "'",
                                "'password' => '" . $replaces['dbpass'] . "'"
                            ], $text);
                        }
                    }
                } catch (PDOException $exception) {
                    $error = '{{%Error while connecting to database!%}} ' . $exception->getMessage();
                }
            }

        }

        $currLang = \src\I18n::getCurrLang();
        $langs = \src\I18n::get();

        ob_start();
        include 'template.php';
        $content = ob_get_clean();

        echo \src\I18n::translate($content);

        exit;
    }
}