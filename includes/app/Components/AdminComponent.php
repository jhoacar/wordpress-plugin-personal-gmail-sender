<?php

namespace PersonalGmailSender\Components;

use PersonalGmailSender\Helpers\Gmailer;

class AdminComponent
{

    public function setup()
    {
        add_action('admin_menu', [$this, 'menu']);
    }

    public function menu()
    {
        $page_title = PERSONAL_GMAIL_SENDER_PLUGIN_NAME;
        $menu_title = PERSONAL_GMAIL_SENDER_PLUGIN_NAME;
        $capability = "manage_options";
        $menu_slug = PERSONAL_GMAIL_SENDER_PLUGIN_SLUG;
        $callback = [$this, 'page'];
        $icon_url =  personal_gmail_sender_assets('images/gmail.svg');
        $icon_content = $icon_url;
        add_menu_page($page_title, $menu_title, $capability, $menu_slug, $callback, $icon_content);
    }

    public function check()
    {
        $email = personal_gmail_sender_plugin()->get('email');
        $password = personal_gmail_sender_plugin()->get('password');
        $gmailer = new Gmailer(false);
        $checked = $gmailer->check($email, $password);
        personal_gmail_sender_plugin()->update('checked', $checked);
    }

    public function test()
    {
        $email = personal_gmail_sender_plugin()->get('email');
        $password = personal_gmail_sender_plugin()->get('password');
        $gmailer = new Gmailer(false);
        $checked = $gmailer->check($email, $password);
        personal_gmail_sender_plugin()->update('checked', $checked);
        if ($checked) {
            $gmailer->sendGmail($email, 'Test', 'This is a test message');
        }
    }

    public function page()
    {
        $this->evaluate_form();
        $this->check();
        echo personal_gmail_sender_view('admin.index');
    }

    private function evaluate_form()
    {
        foreach ($_POST as $field => $value) {
            if ($field === 'test') {
                $this->test();
            } else {
                personal_gmail_sender_plugin()->update($field, $value);
            }
        }
    }
}
