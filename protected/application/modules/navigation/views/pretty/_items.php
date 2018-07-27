<?php

$str = '<option value="">{{%choose an option%}}</option>';

if ($items['total'] > 0) {
    foreach ($items['items'] as $k => $item) {
        $str  .= '<option value="/' . $link . '/front/index/id=' . $item['id'] . '">'.$item['title'].'</option>';
    }
}

echo $str;