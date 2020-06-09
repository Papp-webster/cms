<?php

require_once 'vendor/Facebook/autoload.php';

if (!session_id())
{
    session_start();
}

// Call Facebook API

$facebook = new Facebook\Facebook([
  'app_id'      => '249506306353410',
  'app_secret'     => 'e7b5cdbf42732f33d084a999a0040795',
  'default_graph_version'  => 'v2.10'
]);

?>
