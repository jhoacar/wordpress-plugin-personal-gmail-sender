<?php

use NumbersAnalyzerPlugin\WordPress\Helpers\ErrorHandler;
use NumbersAnalyzerPlugin\WordPress\Kernel;

if (!function_exists('numbers_analyzer_config')) {
    /**
     * Get / set the specified configuration value.
     *
     * @param  string|null  $key
     * @return mixed|Array
     */
    function numbers_analyzer_config($key = null)
    {
        $configFile = is_null($key) ? "default.php" : $key;
        return require_once numbers_analyzer_plugin()->path('CONFIG_DIR', $configFile);
    }
}

if (!function_exists('numbers_analyzer_plugin')) {
    /**
     * Get the available Kernel instance.
     *
     * @return Kernel
     */
    function numbers_analyzer_plugin()
    {
        return Kernel::getInstance();
    }
}


if (!function_exists('numbers_analyzer_view')) {
    /**
     * Returns the result for a Blade Compilation
     * 
     * @param string $view
     * @param array $data
     */
    function numbers_analyzer_view($view, $data = [])
    {
        return numbers_analyzer_plugin()->view($view, $data);
    }
}

if (!function_exists('numbers_analyzer_assets')) {
    /**
     * Returns the result for a Blade Compilation
     * 
     * @param string $view
     * @param array $data
     */
    function numbers_analyzer_assets($file)
    {
        return numbers_analyzer_plugin()->path('ASSETS_WEB', $file);
    }
}

if (!function_exists('numbers_analyzer_debugger')) {
    /**
     * @return never
     */
    function numbers_analyzer_debugger(...$vars)
    {
        define('HTML_BREAK_LINE', '<br>');
        $debug = HTML_BREAK_LINE;
        foreach ($vars as $var) {
            $debug .= var_export($var, true) . HTML_BREAK_LINE;
        }
        throw new Error('Debug: ' . $debug);
    }
}

if (!function_exists('numbers_analyzer_error')) {
    /**
     * @param \Throwable $error
     */
    function numbers_analyzer_error($error)
    {
        ErrorHandler::handle($error);
    }
}


if (!function_exists('numbers_analyzer_warning')) {
    /**
     * @param string $message
     */
    function numbers_analyzer_warning($message)
    {
        ErrorHandler::handle($message, true);
    }
}
