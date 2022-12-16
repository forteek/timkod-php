<?php

require_once('vendor/autoload.php');

ini_set('memory_limit', -1);
$app = new App\App();
$app->run();
