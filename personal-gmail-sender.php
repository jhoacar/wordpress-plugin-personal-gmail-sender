<?php
/*
    Plugin Name: Personal Gmail Sender
    Plugin URI: https://github.com/jhoacar/personal-gmail-sender
    Description: This plugin send mails using your gmail account
    Version: 1.0.0
    Author: Jhoan Carrero
    Author URI: https://github.com/jhoacar
    License: GPL
    Text domain: personal-gmail-sender
*/

if (!defined('ABSPATH')) {
    die('-1');
}

$version = "1.0.0";
$text_domain = "personal-gmail-sender";
$slug = $text_domain;
$pluginName = "Personal Gmail Sender";

define('PERSONAL_GMAIL_SENDER_PLUGIN_VERSION', $version);
define('PERSONAL_GMAIL_SENDER_PLUGIN_SLUG', $slug);
define('PERSONAL_GMAIL_SENDER_PLUGIN_START', microtime(true));
define('PERSONAL_GMAIL_SENDER_PLUGIN_NAME', $pluginName);
define('PERSONAL_GMAIL_SENDER_PLUGIN_DIR', __DIR__);
define('PERSONAL_GMAIL_SENDER_PLUGIN_FILE', __FILE__);

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require_once __DIR__ . '/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can load all Wordpress components
|
*/

use PersonalGmailSender\Helpers\ErrorHandler;
use PersonalGmailSender\Kernel;

try {
    $kernel = Kernel::getInstance();
    $kernel->loadComponents();
} catch (\Throwable $error) {
    ErrorHandler::handle($error);
}
