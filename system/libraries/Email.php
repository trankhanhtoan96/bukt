<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'vendors/PHPMailer/Exception.php';
require_once 'vendors/PHPMailer/OAuth.php';
require_once 'vendors/PHPMailer/PHPMailer.php';
require_once 'vendors/PHPMailer/POP3.php';
require_once 'vendors/PHPMailer/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;

class CI_Email
{
    public $mailer;

    public function __construct()
    {
        $CI = &get_instance();
        $this->mailer = new PHPMailer();
        $this->mailer->isSMTP();
        $this->mailer->Host = $CI->setting_model->get('mail_host');
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $CI->setting_model->get('mail_username');
        $this->mailer->Password = $CI->setting_model->get('mail_password');
        $this->mailer->SMTPSecure = $CI->setting_model->get('mail_secure');
        $this->mailer->Port = $CI->setting_model->get('mail_port');
        $this->mailer->setFrom($CI->setting_model->get('mail_from'), $CI->setting_model->get('mail_from_name'));
        $this->mailer->isHTML(true);
        $this->mailer->CharSet = 'utf-8';
        $this->mailer->setLanguage($this->config->item('language'));
    }
}