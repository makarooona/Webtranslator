<?php
require_once dirname(__FILE__).'/../config.php';
require_once dirname(__FILE__).'/../../vendor/autoload.php';

class SMTPClient {

  private $mailer;

  public function __construct(){
    $transport = (new Swift_SmtpTransport(Config::SMTP_HOST(), Config::SMTP_PORT(), 'tls'))
      ->setUsername(Config::SMTP_USER())
      ->setPassword(Config::SMTP_PASSWORD());

    $this->mailer = new Swift_Mailer($transport);
  }

  public function send_register_user_token($user){
    $message = (new Swift_Message('Confirm your account'))
      ->setFrom(['ibrahim@sandbox7e0e204ca2014bd5b8a10ec749addf42.mailgun.org' => 'webtranslator'])
      ->setTo([$user['email']])
      ->setBody('Here is the confirmation link: http://localhost/webtranslator/api/users/confirm/'.$user['token']);

    $this->mailer->send($message);
  }

  public function send_user_recovery_token($user){
    $message = (new Swift_Message('Reset Your Password'))
      ->setFrom(['817c4c2d82cb0eda80c88d3c44faa062-aff8aa95-2b51ff32' => 'Autoresponder'])
      ->setTo([$user['email']])
      ->setBody('Here is the recovery token: '.$user['token']);

    $this->mailer->send($message);
  }

}
?>
