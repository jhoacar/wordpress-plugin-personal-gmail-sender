<?php

namespace NumbersAnalyzerPlugin\WordPress\Helpers;

class LaravelChecker
{

    public static function check()
    {
        $token = numbers_analyzer_plugin()->get('token');
        $domain = "http://" . numbers_analyzer_plugin()->get('domain');
        $checkUrl = "$domain/api/wordpress/check/?token=$token";

        $remote = wp_remote_get(
            $checkUrl,
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
            $message = "Error on response to check this plugin with url=$checkUrl";
            numbers_analyzer_warning($message);
            return false;
        }

        return true;
    }
}
