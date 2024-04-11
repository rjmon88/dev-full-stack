<?php

use DevFullStack\Helper\ConfigHelper;
use DevFullStack\Route\Route;

// Require Composer's autoload
require_once __DIR__ . '/vendor/autoload.php';

// Require configuration file
require_once __DIR__ . '/config/config.php';

ConfigHelper::setTimeZone();

Route::routes();