#!/usr/bin/env php
<?php

use function TarsyClub\Framework\app_get_front_controller;
use function TarsyClub\YamlCsFix\app_get_parameters;
use function TarsyClub\YamlCsFix\get_safe_dir;

require_once 'files/functions.php';

$__dir__ = get_safe_dir(__DIR__ . '/../');

require_once $__dir__ . 'vendor/autoload.php';

try {
    exit(app_get_front_controller(
        basename(__FILE__),
        app_get_parameters(),
        $__dir__ . '.env'
    ));
} catch (Exception $e) {
    // empty
}
