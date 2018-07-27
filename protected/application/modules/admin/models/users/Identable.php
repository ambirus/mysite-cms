<?php
namespace application\modules\admin\models\users;

interface Identable
{
    public function login($email, $password);
    public function logout();
    public function isLogged();
}