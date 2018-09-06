<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 19.08.2018
 * Time: 11:31
 */

return [
    'news/([a-zA-Z]+)/([a-zA-Z]+)' => 'news/detail/$2',
    'news/([a-zA-Z]+)' => 'news/index/$1',
    'news' => 'news/index',
    'comment' => 'comments/index',
    '[a-zA-Z]+' => 'index/index',
    '' => 'index/index',
];

?>