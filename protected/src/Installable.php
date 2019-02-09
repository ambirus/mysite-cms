<?php

namespace src;

interface Installable
{
    public function install();

    public function uninstall();
}