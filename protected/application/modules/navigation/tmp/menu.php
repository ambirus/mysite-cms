<?php

use application\helpers\IconHelper;

$pics = IconHelper::get();

return [
    '/admin/index' => [
        'alias' => 'dashboard',
        'title' => 'Common information',
        'state' => 1,
        'icon' => $pics['dial']
    ],
    '/admin/back' => [
        'alias' => 'admin',
        'title' => 'Admin area',
        'state' => 1,
        'icon' => $pics['gear']
    ],
    '/mailing/back/spam' => [
        'alias' => 'mailing',
        'title' => 'Mailing',
        'state' => 1,
        'icon' => $pics['email']
    ],
    '/site/back' => [
        'alias' => 'site',
        'title' => 'Site',
        'state' => 1,
        'icon' => $pics['window']
    ],
    '/navigation/back' => [
        'alias' => 'navigation',
        'title' => 'Navigation',
        'state' => 1,
        'icon' => $pics['folder']
    ],
    '/page/back' => [
        'alias' => 'page',
        'title' => 'Pages',
        'state' => 1,
        'icon' =>  $pics['document']
    ]
];