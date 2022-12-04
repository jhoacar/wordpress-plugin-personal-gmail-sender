<?php

namespace NumbersAnalyzerPlugin\WordPress\Components;

class ProfileComponent
{

    public function setup()
    {
        add_action('profile_update', [$this, 'change'], 10, 2);
    }

    public function change($user_id, $old_user_data)
    {
        $old_user_email = $old_user_data->data->user_email;

        $user = get_userdata($user_id);
        $new_user_email = $user->user_email;

        // If the user change the email, change in Numbers Analyzer
        if ($new_user_email !== $old_user_email) {

            $domain = "http://" . numbers_analyzer_plugin()->get('domain');

            $token = numbers_analyzer_plugin()->get('token');

            wp_remote_post("$domain/api/wordpress/update/email", array(
                'method'      => 'POST',
                'headers' => array('Accept' => 'application/json'),
                'timeout'     => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking'    => true,
                'body'        => array(
                    'email' => [
                        'old' => $old_user_email,
                        'new' => $new_user_email,
                    ],
                    'token' => $token,
                )
            ));
        }
    }
}
