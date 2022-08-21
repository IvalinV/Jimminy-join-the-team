<?php
require __DIR__."/vendor/autoload.php";
require __DIR__."/helpers.php";

use App\Router;

require __DIR__."/src/routes/web.php";

Router::getInstance()->execute();