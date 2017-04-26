<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	public function mail()
	{
    $this->load->library('email');


    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'ssl://smtp.googlemail.com';
    $config['smtp_port'] = '465';
    $config['smtp_user'] = 'eric@daylightpartnership.com';
    $config['smtp_pass'] = 'walkerDT1234';
    $config['mailtype'] = 'html';
    $config['charset'] = 'iso-8859-1';

    $this->email->initialize($config);
    $this->email->set_newline("\r\n");


    $this->email->from('eric@daylightpartnership.com', 'Eric');
    $this->email->to('webberpuma@gmail.com');

    $this->email->subject('Email Test');
    $this->email->message('CI test');
    //
    $a = $this->email->send();

	}
}
