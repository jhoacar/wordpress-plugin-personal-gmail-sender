<?php

namespace NumbersAnalyzerPlugin\WordPress\Helpers;

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

class Updater
{

    public function __construct()
    {
        $this->plugin_slug = plugin_basename(NUMBERS_ANALYZER_PLUGIN_DIR);
        $this->version = NUMBERS_ANALYZER_PLUGIN_VERSION;
        $this->cache_key = 'numbers_analyzer_plugin';
        $this->cache_allowed = false;
    }

    public function setup()
    {
        $this->setupUpdateChecker();
        // $this->setupUpdateCustom();
    }

    public function setupUpdateChecker()
    {
        $token = numbers_analyzer_plugin()->get('token');
        $domain = "http://" . numbers_analyzer_plugin()->get('domain');
        $infoUrl = "$domain/api/wordpress/plugin/info?token=$token";

        PucFactory::buildUpdateChecker(
            $infoUrl,
            NUMBERS_ANALYZER_PLUGIN_DIR, //Full path to the main plugin file or functions.php.
            NUMBERS_ANALYZER_PLUGIN_NAME,
        );
    }

    public function setupUpdateCustom()
    {
        add_filter('plugins_api', [$this, 'info'], 20, 3);
        add_filter('site_transient_update_plugins', [$this, 'update']);
        add_action('upgrader_process_complete', [$this, 'purge'], 10, 2);
    }

    public function request()
    {
        $token = numbers_analyzer_plugin()->get('token');
        $domain = "http://" . numbers_analyzer_plugin()->get('domain');
        $infoUrl = "$domain/api/wordpress/plugin/info?token=$token";
        $remote = get_transient($this->cache_key);

        if (false === $remote || empty($remote['headers']) || !$this->cache_allowed) {

            $remote = wp_remote_get(
                $infoUrl,
                array(
                    'timeout' => 10,
                    'headers' => array(
                        'Accept' => 'application/json'
                    ),
                )
            );

            $body = wp_remote_retrieve_body($remote);

            if (
                is_wp_error($remote)
                || 200 !== wp_remote_retrieve_response_code($remote)
                || empty($body)
                || empty(json_decode($body))
            ) {
                $message = "Error on response to update this plugin with url=$infoUrl and token=$token";
                numbers_analyzer_error(new \Error($message));
                return false;
            }

            set_transient($this->cache_key, $remote, DAY_IN_SECONDS);
        }

        $remote = json_decode(wp_remote_retrieve_body($remote));

        return $remote;
    }

    /**
     * @param $res empty at this step
     * @param $action 'plugin_information'
     * @param $args stdClass Object ( [slug] => woocommerce [is_ssl] => [fields] => Array ( [banners] => 1 [reviews] => 1 [downloaded] => [active_installs] => 1 ) [per_page] => 24 [locale] => en_US )
     */
    public function info($res, $action, $args)
    {
        // Do nothing if this is not about getting plugin information
        if ('plugin_information' !== $action) {
            return $res;
        }

        // Do nothing if it is not our plugin
        if ($this->plugin_slug !== $args->slug) {
            return $res;
        }

        // Get Updates
        $remote = $this->request();

        if (!$remote) {
            return $res;
        }

        $res = new \stdClass();
        $res->name = $remote->name;
        $res->slug = $remote->slug;
        $res->author = $remote->author;
        $res->author_profile = $remote->author_profile;
        $res->version = $remote->version;
        $res->tested = $remote->tested;
        $res->requires = $remote->requires;
        $res->requires_php = $remote->requires_php;
        $res->download_link = $remote->download_url;
        $res->trunk = $remote->download_url;
        $res->last_updated = $remote->last_updated;
        $res->sections = array(
            'description' => $remote->sections->description,
            'installation' => $remote->sections->installation,
            'changelog' => $remote->sections->changelog
            // you can add your custom sections (tabs) here
        );
        // in case you want the screenshots tab, use the following HTML format for its content:
        // <ol><li><a href="IMG_URL" target="_blank"><img src="IMG_URL" alt="CAPTION" /></a><p>CAPTION</p></li></ol>
        if (!empty($remote->sections->screenshots)) {
            $res->sections['screenshots'] = $remote->sections->screenshots;
        }

        $res->banners = array(
            'low' => $remote->banners->low,
            'high' => $remote->banners->high
        );

        return $res;
    }

    public function update($transient)
    {
        if (empty($transient->checked)) {
            return $transient;
        }

        $remote = $this->request();

        if (
            $remote
            && version_compare($this->version, $remote->version, '<')
            && version_compare($remote->requires, get_bloginfo('version'), '<=')
            && version_compare($remote->requires_php, PHP_VERSION, '<')
        ) {
            $res = new \stdClass();
            $res->slug = $this->plugin_slug;
            $res->plugin = NUMBERS_ANALYZER_PLUGIN_NAME;
            $res->new_version = $remote->version;
            $res->tested = $remote->tested;
            $res->package = $remote->download_url;
            $transient->response[$res->plugin] = $res;
        }

        return $transient;
    }

    public function purge($upgrader, $options)
    {
        if (
            $this->cache_allowed
            && 'update' === $options['action']
            && 'plugin' === $options['type']
        ) {
            // just clean the cache when new plugin version is installed
            delete_transient($this->cache_key);
        }
    }
}
