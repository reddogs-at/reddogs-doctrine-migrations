<?php

if (file_exists(dirname(dirname(__DIR__)) . '/autoload.php')) {
    chdir(dirname(dirname(dirname(__DIR__))));
    echo 'using autoloader';
    require_once dirname(dirname(__DIR__)) . '/autoload.php';
}
else require 'vendor/autoload.php';