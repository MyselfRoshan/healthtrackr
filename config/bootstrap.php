<?php

/** 
 * Include psr-4 autoload feature
 */

require_once BASE_PATH . "vendor/autoload.php";

/**
 * included helper functions here
 */

require_once BASE_PATH . "app/Helper/functions.php";

/**
 * include env file here
 */
require_once base_path("config/env.php");

/**
 * include base controller file here
 */
// require_once SERVER_URL . "/Controller/BaseController.php";


/**
 * include route files here
 */
// require_once base_path("routes/routes.php");
// require_once base_path("routes/api.php");
