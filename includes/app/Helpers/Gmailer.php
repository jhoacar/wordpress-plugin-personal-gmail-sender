<?php

namespace PersonalGmailSender\Helpers;

if (!class_exists(\PHPMailer\PHPMailer\PHPMailer::class)) {
    require_once ABSPATH . '/wp-includes/PHPMailer/Exception.php';
    require_once ABSPATH . '/wp-includes/PHPMailer/SMTP.php';
    require_once ABSPATH . '/wp-includes/PHPMailer/PHPMailer.php';
}

class Gmailer extends \PHPMailer\PHPMailer\PHPMailer
{

    /**
     * Constructor.
     *
     * @param bool $exceptions Should we throw external exceptions?
     */
    public function __construct($exceptions = null)
    {
        parent::__construct($exceptions);

        $this->IsSMTP();
        $this->Mailer = "smtp";
        $this->SMTPAuth = true;
        $this->SMTPDebug  = false;
        $this->SMTPAuth   = true;
        $this->SMTPSecure = "tls";
        $this->Host       = "smtp.gmail.com";
        $this->Port       = 587;
    }

    /**
     * 
     */
    public function check($email, $password)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !is_string($password) || !strlen($password)) {
            return false;
        }

        $this->Username   = $email;
        $this->Password   = $password;
        return $this->SmtpConnect();
    }

    /**
     * 
     */
    public function sendGmail($to, $subject, $message, $headers = [], $attachments = [])
    {
        $this->IsHTML(true);
        $this->AddAddress($to);
        $this->Subject = $subject;
        $this->MsgHTML($message);
        if (is_array($headers)) {
            foreach ($headers as $name => $value) {
                if (is_string($name) && is_string($value))
                    $this->addCustomHeader($name, $value);
            }
        }
        if (is_array($attachments)) {
            foreach ($attachments as $attachment) {
                $this->addAttachment($attachment);
            }
        }

        return $this->Send();
    }
}
