<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'protocol' => 'smtp',
    'smtp_host' => 'ssl://smtp.googlemail.com',
    'smtp_port' => 465,
    'smtp_user' => $_ENV['AUTH_EMAIL'],
    'smtp_pass' => $_ENV['AUTH_PASSWORD'],
    'mailtype' => 'html',
    'smtp_timeout' => '5',
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE,
    'newline' => "\r\n"
);