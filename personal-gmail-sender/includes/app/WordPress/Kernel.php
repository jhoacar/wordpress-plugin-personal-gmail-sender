<?php

namespace NumbersAnalyzerPlugin\WordPress;

use eftec\bladeone\BladeOne;
use NumbersAnalyzerPlugin\WordPress\Helpers\ClassFinder;
use NumbersAnalyzerPlugin\WordPress\Helpers\Updater;

/**
 * Numbers Analyzer Plugin starts here. 
 * Manager sets mode, adds required wp hooks and loads required object of structure
 *
 * Manager controls and access to all modules and classes of Numbers Analyzer Plugin.
 *
 */
class Kernel
{
    const NUMBERS_ANALYZER_OPTION_PREFIX = "numbers_analyzer";

    /**
     * @var array
     */
    private $paths = array();

    /**
     * @var self
     */
    private static $instance;

    /**
     * @var Updater
     */
    private $updater;

    /**
     * @var BladeOne
     */
    private $engine;


    /**
     * Constructor loads API functions, defines paths and adds required wp actions
     *
     */
    private function __construct()
    {

        if (!defined('ABSPATH')) {
            define('ABSPATH', NUMBERS_ANALYZER_PLUGIN_DIR);
        }

        $dir = NUMBERS_ANALYZER_PLUGIN_DIR;
        $appDir = basename(plugin_basename($dir));
        $dirWeb = plugins_url($appDir, $dir);
        $mainDir = "/includes";
        $publicDir = $mainDir . "/public";
        $webRoot = $dirWeb . $publicDir;

        $this->setPaths(array(
            'WP_ROOT' => preg_replace('/$\//', '', ABSPATH),
            'APP_ROOT' => $dir,
            'WEB_ROOT' => $webRoot,
            'APP_DIR' => $dir . $mainDir . '/app',
            'CONFIG_DIR' => $dir . $mainDir . '/config',
            'ASSETS_DIR' => $dir . $publicDir . '/assets',
            'ASSETS_WEB' => $webRoot . '/assets',
            'RESOURCES_DIR' => $dir . $mainDir . '/resources',
            'VIEWS_DIR' => $dir . $mainDir . '/resources/views',
            'CACHE_DIR' => $dir . $mainDir . '/resources/cache',
        ));

        require_once $this->path('APP_DIR', 'WordPress/Helpers/LaravelFunctions.php');

        $this->setDefaultValues();
        $this->setEngine();
        $this->setUpdater();
    }

    /**
     * Set Updater Handler
     */
    private function setUpdater()
    {
        $this->updater = new Updater();
    }

    /**
     * Set Default Values from config default file
     * 
     */
    private function setDefaultValues()
    {
        $configFile = "default.php";
        $defaultValues = require_once $this->path('CONFIG_DIR', $configFile);
        foreach ($defaultValues as $name => $value) {
            $this->$name = get_option(self::NUMBERS_ANALYZER_OPTION_PREFIX . '_' . $name, $value);
        }
    }

    private function setEngine()
    {
        $viewsDir = $this->path('VIEWS_DIR');
        $cacheDir = $this->path('CACHE_DIR');
        $mode = \eftec\bladeone\BladeOne::MODE_DEBUG;
        $this->engine = new BladeOne($viewsDir, $cacheDir, $mode);
    }

    /**
     * Returns the result for a Blade Compilation
     * 
     * @param string $view
     * @param array $data
     */
    public function view($view, $data = [])
    {
        return $this->engine->run($view, $data);
    }

    /**
     * Get the instane of Kernel
     *
     * @return self
     */
    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Load required components to enable useful functionality.
     *
     * @access public
     */
    public function loadComponents()
    {
        $namespaceComponents = __NAMESPACE__ . '\\Components';
        $classes = ClassFinder::getClassesInNamespace(NUMBERS_ANALYZER_PLUGIN_DIR, $namespaceComponents);
        foreach ($classes as $class) {
            $component = new $class();
            if (method_exists($component, 'setup'))
                $component->setup();
        }
    }

    /**
     * Gets absolute path for file/directory in filesystem.
     *
     * @param $name - name of path dir
     * @param string $file - file name or directory inside path
     *
     * @return string
     * @access public
     */
    public function path($name, $file = '')
    {
        $path = $this->paths[$name] . (strlen($file) > 0 ? '/' . preg_replace('/^\//', '', $file) : '');

        return $path;
    }

    /**
     * Setter for paths
     *
     * @param $paths
     * @access private
     *
     */
    private function setPaths($paths)
    {
        $this->paths = $paths;
    }

    /**
     * Update using WordPress database
     * 
     * @param string $field
     * @param string $value
     */
    public function update($field, $value)
    {
        if (!is_string($field) || !is_string($value) || !isset($this->$field) || strlen($value) == 0) {
            return;
        }
        $this->$field = $value;
        update_option(self::NUMBERS_ANALYZER_OPTION_PREFIX . '_' . $field, $value);
    }
    /**
     * Get from this class a specific field
     * 
     * @param string $field
     * @return mixed
     */
    public function get($field)
    {
        return $this->$field;
    }

    /**
     * Handler for plugin update
     */
    public function setupUpdate()
    {
        $this->updater->setup();
    }
}
