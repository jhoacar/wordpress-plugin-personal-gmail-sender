<?php

define('MINUTE_IN_SECONDS', 60);
define('HOUR_IN_SECONDS', 60 * MINUTE_IN_SECONDS);
define('DAY_IN_SECONDS', 24 * HOUR_IN_SECONDS);
define('WEEK_IN_SECONDS', 7 * DAY_IN_SECONDS);
define('MONTH_IN_SECONDS', 30 * DAY_IN_SECONDS);
define('YEAR_IN_SECONDS', 365 * DAY_IN_SECONDS);

if (!class_exists(\WP_User::class)) {
    /**
     * User API: WP_User class
     *
     * @package WordPress
     * @subpackage Users
     * @since 4.4.0
     */

    /**
     * Core class used to implement the WP_User object.
     *
     * @since 2.0.0
     *
     * @property string $nickname
     * @property string $description
     * @property string $user_description
     * @property string $first_name
     * @property string $user_firstname
     * @property string $last_name
     * @property string $user_lastname
     * @property string $user_login
     * @property string $user_pass
     * @property string $user_nicename
     * @property string $user_email
     * @property string $user_url
     * @property string $user_registered
     * @property string $user_activation_key
     * @property string $user_status
     * @property int    $user_level
     * @property string $display_name
     * @property string $spam
     * @property string $deleted
     * @property string $locale
     * @property string $rich_editing
     * @property string $syntax_highlighting
     * @property string $use_ssl
     */
    class WP_User
    {
    }
}

if (!function_exists('plugins_url')) {
    /**
     * Retrieves a URL within the plugins or mu-plugins directory.
     *
     * Defaults to the plugins directory URL if no arguments are supplied.
     *
     * @since 2.6.0
     *
     * @param string $path   Optional. Extra path appended to the end of the URL, including
     *                       the relative directory if $plugin is supplied. Default empty.
     * @param string $plugin Optional. A full path to a file inside a plugin or mu-plugin.
     *                       The URL will be relative to its directory. Default empty.
     *                       Typically this is done by passing `__FILE__` as the argument.
     * @return string Plugins URL link with optional paths appended.
     */
    function plugins_url($path = '', $plugin = '')
    {
        return "";
    }
}

if (!function_exists('plugin_basename')) {
    /**
     * Gets the basename of a plugin.
     *
     * This method extracts the name of a plugin from its filename.
     *
     * @since 1.5.0
     *
     * @global array $wp_plugin_paths
     *
     * @param string $file The filename of plugin.
     * @return string The name of a plugin.
     */
    function plugin_basename($file)
    {
        return "";
    }
}

if (!function_exists('get_option')) {
    /**
     * Retrieves an option value based on an option name.
     *
     * If the option does not exist, and a default value is not provided,
     * boolean false is returned. This could be used to check whether you need
     * to initialize an option during installation of a plugin, however that
     * can be done better by using add_option() which will not overwrite
     * existing options.
     *
     * Not initializing an option and using boolean `false` as a return value
     * is a bad practice as it triggers an additional database query.
     *
     * The type of the returned value can be different from the type that was passed
     * when saving or updating the option. If the option value was serialized,
     * then it will be unserialized when it is returned. In this case the type will
     * be the same. For example, storing a non-scalar value like an array will
     * return the same array.
     *
     * In most cases non-string scalar and null values will be converted and returned
     * as string equivalents.
     *
     * Exceptions:
     *
     * 1. When the option has not been saved in the database, the `$default` value
     *    is returned if provided. If not, boolean `false` is returned.
     * 2. When one of the Options API filters is used: {@see 'pre_option_$option'},
     *    {@see 'default_option_$option'}, or {@see 'option_$option'}, the returned
     *    value may not match the expected type.
     * 3. When the option has just been saved in the database, and get_option()
     *    is used right after, non-string scalar and null values are not converted to
     *    string equivalents and the original type is returned.
     *
     * Examples:
     *
     * When adding options like this: `add_option( 'my_option_name', 'value' )`
     * and then retrieving them with `get_option( 'my_option_name' )`, the returned
     * values will be:
     *
     *   - `false` returns `string(0) ""`
     *   - `true`  returns `string(1) "1"`
     *   - `0`     returns `string(1) "0"`
     *   - `1`     returns `string(1) "1"`
     *   - `'0'`   returns `string(1) "0"`
     *   - `'1'`   returns `string(1) "1"`
     *   - `null`  returns `string(0) ""`
     *
     * When adding options with non-scalar values like
     * `add_option( 'my_array', array( false, 'str', null ) )`, the returned value
     * will be identical to the original as it is serialized before saving
     * it in the database:
     *
     *     array(3) {
     *         [0] => bool(false)
     *         [1] => string(3) "str"
     *         [2] => NULL
     *     }
     *
     * @since 1.5.0
     *
     * @global wpdb $wpdb WordPress database abstraction object.
     *
     * @param string $option  Name of the option to retrieve. Expected to not be SQL-escaped.
     * @param mixed  $default Optional. Default value to return if the option does not exist.
     * @return mixed Value of the option. A value of any type may be returned, including
     *               scalar (string, boolean, float, integer), null, array, object.
     *               Scalar and null values will be returned as strings as long as they originate
     *               from a database stored option value. If there is no option in the database,
     *               boolean `false` is returned.
     */
    function get_option($option, $default = false)
    {
        return "";
    }
}

if (!function_exists('update_option')) {
    /**
     * Updates the value of an option that was already added.
     *
     * You do not need to serialize values. If the value needs to be serialized,
     * then it will be serialized before it is inserted into the database.
     * Remember, resources cannot be serialized or added as an option.
     *
     * If the option does not exist, it will be created.

     * This function is designed to work with or without a logged-in user. In terms of security,
     * plugin developers should check the current user's capabilities before updating any options.
     *
     * @since 1.0.0
     * @since 4.2.0 The `$autoload` parameter was added.
     *
     * @global wpdb $wpdb WordPress database abstraction object.
     *
     * @param string      $option   Name of the option to update. Expected to not be SQL-escaped.
     * @param mixed       $value    Option value. Must be serializable if non-scalar. Expected to not be SQL-escaped.
     * @param string|bool $autoload Optional. Whether to load the option when WordPress starts up. For existing options,
     *                              `$autoload` can only be updated using `update_option()` if `$value` is also changed.
     *                              Accepts 'yes'|true to enable or 'no'|false to disable. For non-existent options,
     *                              the default value is 'yes'. Default null.
     * @return bool True if the value was updated, false otherwise.
     */
    function update_option($option, $value, $autoload = null)
    {
        return true;
    }
}

if (!function_exists('add_action')) {
    /**
     * Adds a callback function to an action hook.
     *
     * Actions are the hooks that the WordPress core launches at specific points
     * during execution, or when specific events occur. Plugins can specify that
     * one or more of its PHP functions are executed at these points, using the
     * Action API.
     *
     * @since 1.2.0
     *
     * @param string   $hook_name       The name of the action to add the callback to.
     * @param callable $callback        The callback to be run when the action is called.
     * @param int      $priority        Optional. Used to specify the order in which the functions
     *                                  associated with a particular action are executed.
     *                                  Lower numbers correspond with earlier execution,
     *                                  and functions with the same priority are executed
     *                                  in the order in which they were added to the action. Default 10.
     * @param int      $accepted_args   Optional. The number of arguments the function accepts. Default 1.
     * @return true Always returns true.
     */
    function add_action($hook_name, $callback, $priority = 10, $accepted_args = 1)
    {
        return true;
    }
}

if (!function_exists('add_menu_page')) {
    /**
     * Adds a top-level menu page.
     *
     * This function takes a capability which will be used to determine whether
     * or not a page is included in the menu.
     *
     * The function which is hooked in to handle the output of the page must check
     * that the user has the required capability as well.
     *
     * @since 1.5.0
     *
     * @global array $menu
     * @global array $admin_page_hooks
     * @global array $_registered_pages
     * @global array $_parent_pages
     *
     * @param string    $page_title The text to be displayed in the title tags of the page when the menu is selected.
     * @param string    $menu_title The text to be used for the menu.
     * @param string    $capability The capability required for this menu to be displayed to the user.
     * @param string    $menu_slug  The slug name to refer to this menu by. Should be unique for this menu page and only
     *                              include lowercase alphanumeric, dashes, and underscores characters to be compatible
     *                              with sanitize_key().
     * @param callable  $callback   Optional. The function to be called to output the content for this page.
     * @param string    $icon_url   Optional. The URL to the icon to be used for this menu.
     *                              * Pass a base64-encoded SVG using a data URI, which will be colored to match
     *                                the color scheme. This should begin with 'data:image/svg+xml;base64,'.
     *                              * Pass the name of a Dashicons helper class to use a font icon,
     *                                e.g. 'dashicons-chart-pie'.
     *                              * Pass 'none' to leave div.wp-menu-image empty so an icon can be added via CSS.
     * @param int|float $position   Optional. The position in the menu order this item should appear.
     * @return string The resulting page's hook_suffix.
     */
    function add_menu_page($page_title, $menu_title, $capability, $menu_slug, $callback = '', $icon_url = '', $position = null)
    {
        return "";
    }
}

if (!function_exists('register_rest_route')) {
    /**
     * Registers a REST API route.
     *
     * Note: Do not use before the {@see 'rest_api_init'} hook.
     *
     * @since 4.4.0
     * @since 5.1.0 Added a `_doing_it_wrong()` notice when not called on or after the `rest_api_init` hook.
     * @since 5.5.0 Added a `_doing_it_wrong()` notice when the required `permission_callback` argument is not set.
     *
     * @param string $namespace The first URL segment after core prefix. Should be unique to your package/plugin.
     * @param string $route     The base URL for route you are adding.
     * @param array  $args      Optional. Either an array of options for the endpoint, or an array of arrays for
     *                          multiple methods. Default empty array.
     * @param bool   $override  Optional. If the route already exists, should we override it? True overrides,
     *                          false merges (with newer overriding if duplicate keys exist). Default false.
     * @return bool True on success, false on error.
     */
    function register_rest_route($namespace, $route, $args = array(), $override = false)
    {
        return true;
    }
}

if (!function_exists('get_user_by')) {
    /**
     * Retrieves user info by a given field.
     *
     * @since 2.8.0
     * @since 4.4.0 Added 'ID' as an alias of 'id' for the `$field` parameter.
     *
     * @global WP_User $current_user The current user object which holds the user data.
     *
     * @param string     $field The field to retrieve the user with. id | ID | slug | email | login.
     * @param int|string $value A value for $field. A user ID, slug, email address, or login name.
     * @return WP_User|false WP_User object on success, false on failure.
     */
    function get_user_by($field, $value)
    {
        return false;
    }
}

if (!function_exists('wp_check_password')) {
    /**
     * Checks the plaintext password against the encrypted Password.
     *
     * Maintains compatibility between old version and the new cookie authentication
     * protocol using PHPass library. The $hash parameter is the encrypted password
     * and the function compares the plain text password when encrypted similarly
     * against the already encrypted password to see if they match.
     *
     * For integration with other applications, this function can be overwritten to
     * instead use the other package password checking algorithm.
     *
     * @since 2.5.0
     *
     * @global PasswordHash $wp_hasher PHPass object used for checking the password
     *                                 against the $hash + $password.
     * @uses PasswordHash::CheckPassword
     *
     * @param string     $password Plaintext user's password.
     * @param string     $hash     Hash of the user's password to check against.
     * @param string|int $user_id  Optional. User ID.
     * @return bool False, if the $password does not match the hashed password.
     */
    function wp_check_password($password, $hash, $user_id = '')
    {
        return false;
    }
}

if (!function_exists('wp_validate_auth_cookie')) {
    /**
     * Validates authentication cookie.
     *
     * The checks include making sure that the authentication cookie is set and
     * pulling in the contents (if $cookie is not used).
     *
     * Makes sure the cookie is not expired. Verifies the hash in cookie is what is
     * should be and compares the two.
     *
     * @since 2.5.0
     *
     * @global int $login_grace_period
     *
     * @param string $cookie Optional. If used, will validate contents instead of cookie's.
     * @param string $scheme Optional. The cookie scheme to use: 'auth', 'secure_auth', or 'logged_in'.
     * @return int|false User ID if valid cookie, false if invalid.
     */
    function wp_validate_auth_cookie($cookie = '', $scheme = '')
    {
        return false;
    }
}

if (!function_exists('get_userdata')) {
    /**
     * Retrieves user info by user ID.
     *
     * @since 0.71
     *
     * @param int $user_id User ID
     * @return WP_User|false WP_User object on success, false on failure.
     */
    function get_userdata($user_id)
    {
        return get_user_by('id', $user_id);
    }
};

if (!function_exists('wp_remote_post')) {
    /**
     * Performs an HTTP request using the POST method and returns its response.
     *
     * @since 2.7.0
     *
     * @see wp_remote_request() For more information on the response array format.
     * @see WP_Http::request() For default arguments information.
     *
     * @param string $url  URL to retrieve.
     * @param array  $args Optional. Request arguments. Default empty array.
     * @return array|WP_Error The response or WP_Error on failure.
     */
    function wp_remote_post($url, $args = array())
    {
        return [];
    }
}

if (!function_exists('wp_remote_get')) {
    /**
     * Performs an HTTP request using the GET method and returns its response.
     *
     * @since 2.7.0
     *
     * @see wp_remote_request() For more information on the response array format.
     * @see WP_Http::request() For default arguments information.
     *
     * @param string $url  URL to retrieve.
     * @param array  $args Optional. Request arguments. Default empty array.
     * @return array|WP_Error The response or WP_Error on failure.
     */
    function wp_remote_get($url, $args = array())
    {
        return [];
    }
}


if (!function_exists('add_filter')) {
    /**
     * Adds a callback function to a filter hook.
     *
     * WordPress offers filter hooks to allow plugins to modify
     * various types of internal data at runtime.
     *
     * A plugin can modify data by binding a callback to a filter hook. When the filter
     * is later applied, each bound callback is run in order of priority, and given
     * the opportunity to modify a value by returning a new value.
     *
     * The following example shows how a callback function is bound to a filter hook.
     *
     * Note that `$example` is passed to the callback, (maybe) modified, then returned:
     *
     *     function example_callback( $example ) {
     *         // Maybe modify $example in some way.
     *         return $example;
     *     }
     *     add_filter( 'example_filter', 'example_callback' );
     *
     * Bound callbacks can accept from none to the total number of arguments passed as parameters
     * in the corresponding apply_filters() call.
     *
     * In other words, if an apply_filters() call passes four total arguments, callbacks bound to
     * it can accept none (the same as 1) of the arguments or up to four. The important part is that
     * the `$accepted_args` value must reflect the number of arguments the bound callback *actually*
     * opted to accept. If no arguments were accepted by the callback that is considered to be the
     * same as accepting 1 argument. For example:
     *
     *     // Filter call.
     *     $value = apply_filters( 'hook', $value, $arg2, $arg3 );
     *
     *     // Accepting zero/one arguments.
     *     function example_callback() {
     *         ...
     *         return 'some value';
     *     }
     *     add_filter( 'hook', 'example_callback' ); // Where $priority is default 10, $accepted_args is default 1.
     *
     *     // Accepting two arguments (three possible).
     *     function example_callback( $value, $arg2 ) {
     *         ...
     *         return $maybe_modified_value;
     *     }
     *     add_filter( 'hook', 'example_callback', 10, 2 ); // Where $priority is 10, $accepted_args is 2.
     *
     * *Note:* The function will return true whether or not the callback is valid.
     * It is up to you to take care. This is done for optimization purposes, so
     * everything is as quick as possible.
     *
     * @since 0.71
     *
     * @global WP_Hook[] $wp_filter A multidimensional array of all hooks and the callbacks hooked to them.
     *
     * @param string   $hook_name     The name of the filter to add the callback to.
     * @param callable $callback      The callback to be run when the filter is applied.
     * @param int      $priority      Optional. Used to specify the order in which the functions
     *                                associated with a particular filter are executed.
     *                                Lower numbers correspond with earlier execution,
     *                                and functions with the same priority are executed
     *                                in the order in which they were added to the filter. Default 10.
     * @param int      $accepted_args Optional. The number of arguments the function accepts. Default 1.
     * @return true Always returns true.
     */
    function add_filter($hook_name, $callback, $priority = 10, $accepted_args = 1)
    {
        return true;
    }
}

if (!function_exists('is_wp_error')) {
    /**
     * Checks whether the given variable is a WordPress Error.
     *
     * Returns whether `$thing` is an instance of the `WP_Error` class.
     *
     * @since 2.1.0
     *
     * @param mixed $thing The variable to check.
     * @return bool Whether the variable is an instance of WP_Error.
     */
    function is_wp_error($thing)
    {
        return true;
    }
}

if (!function_exists('wp_remote_retrieve_response_code')) {
    /**
     * Retrieve only the response code from the raw response.
     *
     * Will return an empty string if incorrect parameter value is given.
     *
     * @since 2.7.0
     *
     * @param array|WP_Error $response HTTP response.
     * @return int|string The response code as an integer. Empty string if incorrect parameter given.
     */
    function wp_remote_retrieve_response_code($response)
    {
        return 200;
    }
}

if (!function_exists('wp_remote_retrieve_body')) {
    /**
     * Retrieve only the body from the raw response.
     *
     * @since 2.7.0
     *
     * @param array|WP_Error $response HTTP response.
     * @return string The body of the response. Empty string if no body or incorrect parameter given.
     */
    function wp_remote_retrieve_body($response)
    {
        return '';
    }
}

if (!function_exists('get_transient')) {
    /**
     * Retrieves the value of a transient.
     *
     * If the transient does not exist, does not have a value, or has expired,
     * then the return value will be false.
     *
     * @since 2.8.0
     *
     * @param string $transient Transient name. Expected to not be SQL-escaped.
     * @return mixed Value of transient.
     */
    function get_transient($transient)
    {
        return [];
    }
}

if (!function_exists('set_transient')) {
    /**
     * Sets/updates the value of a transient.
     *
     * You do not need to serialize values. If the value needs to be serialized,
     * then it will be serialized before it is set.
     *
     * @since 2.8.0
     *
     * @param string $transient  Transient name. Expected to not be SQL-escaped.
     *                           Must be 172 characters or fewer in length.
     * @param mixed  $value      Transient value. Must be serializable if non-scalar.
     *                           Expected to not be SQL-escaped.
     * @param int    $expiration Optional. Time until expiration in seconds. Default 0 (no expiration).
     * @return bool True if the value was set, false otherwise.
     */
    function set_transient($transient, $value, $expiration = 0)
    {
        return false;
    }
}

if (!function_exists('get_bloginfo')) {
    /**
     * Retrieves information about the current site.
     *
     * Possible values for `$show` include:
     *
     * - 'name' - Site title (set in Settings > General)
     * - 'description' - Site tagline (set in Settings > General)
     * - 'wpurl' - The WordPress address (URL) (set in Settings > General)
     * - 'url' - The Site address (URL) (set in Settings > General)
     * - 'admin_email' - Admin email (set in Settings > General)
     * - 'charset' - The "Encoding for pages and feeds"  (set in Settings > Reading)
     * - 'version' - The current WordPress version
     * - 'html_type' - The content-type (default: "text/html"). Themes and plugins
     *   can override the default value using the {@see 'pre_option_html_type'} filter
     * - 'text_direction' - The text direction determined by the site's language. is_rtl()
     *   should be used instead
     * - 'language' - Language code for the current site
     * - 'stylesheet_url' - URL to the stylesheet for the active theme. An active child theme
     *   will take precedence over this value
     * - 'stylesheet_directory' - Directory path for the active theme.  An active child theme
     *   will take precedence over this value
     * - 'template_url' / 'template_directory' - URL of the active theme's directory. An active
     *   child theme will NOT take precedence over this value
     * - 'pingback_url' - The pingback XML-RPC file URL (xmlrpc.php)
     * - 'atom_url' - The Atom feed URL (/feed/atom)
     * - 'rdf_url' - The RDF/RSS 1.0 feed URL (/feed/rdf)
     * - 'rss_url' - The RSS 0.92 feed URL (/feed/rss)
     * - 'rss2_url' - The RSS 2.0 feed URL (/feed)
     * - 'comments_atom_url' - The comments Atom feed URL (/comments/feed)
     * - 'comments_rss2_url' - The comments RSS 2.0 feed URL (/comments/feed)
     *
     * Some `$show` values are deprecated and will be removed in future versions.
     * These options will trigger the _deprecated_argument() function.
     *
     * Deprecated arguments include:
     *
     * - 'siteurl' - Use 'url' instead
     * - 'home' - Use 'url' instead
     *
     * @since 0.71
     *
     * @global string $wp_version The WordPress version string.
     *
     * @param string $show   Optional. Site info to retrieve. Default empty (site name).
     * @param string $filter Optional. How to filter what is retrieved. Default 'raw'.
     * @return string Mostly string values, might be empty.
     */
    function get_bloginfo($show = '', $filter = 'raw')
    {
        return "";
    }
}

if (!function_exists('delete_transient')) {
    /**
     * Deletes a transient.
     *
     * @since 2.8.0
     *
     * @param string $transient Transient name. Expected to not be SQL-escaped.
     * @return bool True if the transient was deleted, false otherwise.
     */
    function delete_transient($transient)
    {
        return true;
    }
}

if (!function_exists('')) {
}

if (!function_exists('')) {
}
