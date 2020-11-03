<?php
//Load Config
require_once 'config/config.php';

//Load des helpers
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';

require_once '../stripe/init.php';

//Autoload des librairies
spl_autoload_register(function ($className) {
    require_once 'libraries/' . $className . '.php';
});
