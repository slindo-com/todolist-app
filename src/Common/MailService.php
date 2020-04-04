<?php

namespace App\Common;

class MailService {
  public function __construct() {

  }

  public function send($attributes) {
    $headers = 'From: '. config()['emailSender'] . "\r\n" .
      'Reply-To:'. config()['emailSender'] . "\r\n" .
      'X-Mailer: PHP/' . phpversion();

      mail($attributes['to'], $attributes['subject'], $attributes['message'], $headers);
  }
}






?>