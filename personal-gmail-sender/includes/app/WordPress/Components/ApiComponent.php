<?php

namespace NumbersAnalyzerPlugin\WordPress\Components;

class ApiComponent
{

    private $namespace = "numbers_analyzer";

    public function setup()
    {
        add_action("rest_api_init", [$this, 'api']);
    }

    public function api()
    {
        register_rest_route(
            $this->namespace,
            "validate/credentials",
            array(
                "methods" => "POST",
                "callback" => function ($request) {
                    return $this->validate_credentials($request);
                }
            )
        );

        register_rest_route(
            $this->namespace,
            "validate/cookie",
            array(
                "methods" => "POST",
                "callback" => function ($request) {
                    return $this->validate_cookie($request);
                }
            )
        );
    }

    public function validate_credentials($request)
    {
        /** This function check the credentials of the users */
        $username = $request["email"];
        $password = $request["password"];

        if (empty($username) || empty($password)) {
            return array("password_valid" => false);
        }

        $user = get_user_by('email', $username);

        if ($user == false)
            return array("password_valid" => false);

        $hash = $user->data->user_pass;

        if (wp_check_password($password, $hash, $user->data->ID)) {
            return array("password_valid" => true);
        } else {
            return array("password_valid" => false);
        }
    }

    public function validate_cookie($request)
    {
        /** This function check the session cookie sent of the request */
        if (!isset($request['cookie'])) {
            return [
                'error' => [
                    'message' => 'the field cookie is required'
                ],
            ];
        }

        $cookie = $request['cookie'];

        $user_id = wp_validate_auth_cookie($cookie, 'logged_in');

        if (!$user_id) {
            return [
                'error' => [
                    'message' => 'the cookie is incorrect'
                ]
            ];
        }

        $user = new \WP_User($user_id);

        return [
            'data' => [
                'cookie' => $cookie,
                'user' => $user,
                'user_id' => $user_id
            ]
        ];
    }
}
