<?php

namespace PersonalGmailSender\Helpers;

class ErrorHandler
{
    private static $viewsDir = PERSONAL_GMAIL_SENDER_PLUGIN_DIR . '/includes/resources/views';
    private static $cacheDir = PERSONAL_GMAIL_SENDER_PLUGIN_DIR . '/includes/resources/cache';
    /**
     * @var \Throwable
     */
    private static $error;
    /**
     * @var \eftec\bladeone\BladeOne
     */
    private static $engine = null;
    /**
     * @var bool
     */
    private static $isWarning;

    /**
     * Show in wordpress admin section the error
     * @param mixed|Error $error
     */
    public static function handle($error, $warning = false)
    {
        self::$error = $error;
        self::$isWarning = $warning;
        if (is_null(self::$engine)) {
            self::setEngine();
        }

        add_action('admin_notices', [self::class, 'show'], 1);
    }

    /**
     * Set Blade Engine
     */
    private static function setEngine()
    {
        // MODE_DEBUG allows to pinpoint troubles.
        $mode = \eftec\bladeone\BladeOne::MODE_DEBUG;
        $class = "\\eftec\\bladeone\\BladeOne";
        self::$engine = new $class(self::$viewsDir, self::$cacheDir, $mode);
    }

    public function show()
    {
        // It calls /views/errors/index.blade.php
        $view = self::$isWarning ? 'warning' : 'index';
        echo self::$engine->run('errors.' . $view, ['error' => self::$error]);
    }
}
