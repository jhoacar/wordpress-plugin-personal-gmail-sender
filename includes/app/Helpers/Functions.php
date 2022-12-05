<?php

use PersonalGmailSender\Helpers\ErrorHandler;
use PersonalGmailSender\Kernel;

if (!function_exists('personal_gmail_sender_config')) {
    /**
     * Get / set the specified configuration value.
     *
     * @param  string|null  $key
     * @return mixed|Array
     */
    function personal_gmail_sender_config($key = null)
    {
        $configFile = is_null($key) ? "default.php" : $key;
        return require_once personal_gmail_sender_plugin()->path('CONFIG_DIR', $configFile);
    }
}

if (!function_exists('personal_gmail_sender_plugin')) {
    /**
     * Get the available Kernel instance.
     *
     * @return Kernel
     */
    function personal_gmail_sender_plugin()
    {
        return Kernel::getInstance();
    }
}


if (!function_exists('personal_gmail_sender_view')) {
    /**
     * Returns the result for a Blade Compilation
     * 
     * @param string $view
     * @param array $data
     */
    function personal_gmail_sender_view($view, $data = [])
    {
        return personal_gmail_sender_plugin()->view($view, $data);
    }
}

if (!function_exists('personal_gmail_sender_assets')) {
    /**
     * Returns the result for a Blade Compilation
     * 
     * @param string $view
     * @param array $data
     */
    function personal_gmail_sender_assets($file)
    {
        return personal_gmail_sender_plugin()->path('ASSETS_WEB', $file);
    }
}

if (!function_exists('personal_gmail_sender_debugger')) {
    /**
     * @return never
     */
    function personal_gmail_sender_debugger(...$vars)
    {
        define('HTML_BREAK_LINE', '<br>');
        $debug = HTML_BREAK_LINE;
        foreach ($vars as $var) {
            $debug .= var_export($var, true) . HTML_BREAK_LINE;
        }
        throw new Error('Debug: ' . $debug);
    }
}

if (!function_exists('personal_gmail_sender_error')) {
    /**
     * @param \Throwable $error
     */
    function personal_gmail_sender_error($error)
    {
        ErrorHandler::handle($error);
    }
}


if (!function_exists('personal_gmail_sender_warning')) {
    /**
     * @param string $message
     */
    function personal_gmail_sender_warning($message)
    {
        ErrorHandler::handle($message, true);
    }
}
