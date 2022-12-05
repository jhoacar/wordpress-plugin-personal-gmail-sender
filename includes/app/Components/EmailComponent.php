<?php

namespace PersonalGmailSender\Components;

use PersonalGmailSender\Helpers\Gmailer;

class EmailComponent
{

    /**
     * @var Gmailer
     */
    private $gmailer = null;

    /**
     * @var bool
     */
    private $checked;

    public function __construct()
    {
        $this->gmailer = new Gmailer(false);
        $this->checked = false;
    }

    public function setup()
    {
        $email = personal_gmail_sender_plugin()->get('email');
        $password = personal_gmail_sender_plugin()->get('password');
        $message = "";
        if (strlen($email) == 0) {
            $message .= "<br>You are using an empty <b>email</b><br>";
        }
        if (strlen($password) == 0) {
            $message .= "You are using an empty <b>password</b><br>";
        }
        $this->checked = $this->gmailer->check($email, $password);
        if ($this->checked) {
            add_filter('wp_mail', [$this, 'send'], 10, 1);
        } else {
            if (strlen($email) && strlen($password)) {
                $message .= "Bad credentials using <b>$email</b> and <b>$password</b>";
            }
            personal_gmail_sender_warning($message);
            personal_gmail_sender_plugin()->update('checked', $this->checked);
        }
    }

    public function send($args)
    {

        $to = $args['to'];
        $subject = $args['subject'];
        $message = $args['message'];
        $headers = $args['headers'];
        $attachments = $args['attachments'];
        $this->gmailer->sendGmail($to, $subject, $message, $headers, $attachments);

        return $args;
    }
}
