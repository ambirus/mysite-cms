<?php
namespace application\modules\site;

use src\Module;

class SiteModule extends Module
{
    protected $assets = [
        'css' => ['fancy.css'],
        'js' => ['jquery.min.js', 'fancy.js']
    ];
}