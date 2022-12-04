<?php

namespace NumbersAnalyzerPlugin\WordPress\Components;

use NumbersAnalyzerPlugin\WordPress\Helpers\LaravelChecker;

class AdminComponent
{
    /**
     * @var string $cookie
     */
    private $cookie;

    public function __construct()
    {
        if (!defined('LOGGED_IN_COOKIE')) {
            define('LOGGED_IN_COOKIE', 'auth');
        }
        $this->cookie = base64_encode($_COOKIE[LOGGED_IN_COOKIE] ?? '');
    }

    public function setup()
    {
        add_action('wp_footer', [$this, 'link']);
        add_action('admin_menu', [$this, 'menu']);
        LaravelChecker::check();
    }

    public function link()
    {
        echo numbers_analyzer_view('admin.link', [
            'cookie' => $this->cookie,
        ]);
    }

    public function menu()
    {
        $page_title = "Numbers Analyzer (integration)";
        $menu_title = "Numbers Analyzer";
        $capability = "manage_options";
        $menu_slug = "numbers_analyzer";
        $callback = [$this, 'page'];
        $icon_url =  numbers_analyzer_plugin()->path('ASSETS_DIR', 'images/laravel.svg');
        $icon_content = 'data:image/svg+xml;base64,' . base64_encode(file_get_contents($icon_url));

        add_menu_page($page_title, $menu_title, $capability, $menu_slug, $callback, $icon_content);
    }

    public function page()
    {
        $this->evaluate_form();
        echo numbers_analyzer_view('admin.index');
        echo numbers_analyzer_view('admin.link', [
            'cookie' => $this->cookie,
        ]);
    }

    private function evaluate_form()
    {
        foreach ($_POST as $field => $value) {
            numbers_analyzer_plugin()->update($field, $value);
        }
        LaravelChecker::check();
    }
}
