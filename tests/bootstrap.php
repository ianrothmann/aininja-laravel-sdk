<?php

require __DIR__.'/../vendor/autoload.php';

set_error_handler(function ($severity, $message, $file, $line) {
    if ($severity === E_DEPRECATED || $severity === E_USER_DEPRECATED) {
        return true;
    }
    return false;
}, E_DEPRECATED | E_USER_DEPRECATED);
