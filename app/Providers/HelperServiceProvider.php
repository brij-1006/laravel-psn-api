<?php

namespace App\Helpers;

use Mandrill;

class PsnMandrill {

    private $mandrill;
    private $MANDRILL_API_KEY;

    public function __construct()
    {
        $MANDRILL_API_KEY = env('MANDRILL_API_KEY', '');
        $this->mandrill = new Mandrill($MANDRILL_API_KEY);
    }

    public function sendMail($template_name, $template_content, $message, $async, $ip_pool, $send_at) {
        $this->mandrill->messages->sendTemplate($template_name, $template_content, $message, $async, $ip_pool, $send_at);
    }
}
