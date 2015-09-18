<?php
session_start();
// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'prod');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

$_l = stripslashes($_REQUEST['_lang']);
if($_l){
    $_SESSION['_lang'] = $_l;
}
$_lang = $_SESSION['_lang'];
if($_lang){
    $config['language'] = $_lang;
}else{
    $config['language'] = 'th_TH';
}

(new yii\web\Application($config))->run();
