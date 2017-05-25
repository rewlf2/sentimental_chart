<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

class Test extends Public_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $client = new Predis\Client();
        $client->set('foo', 'bar');
        $this->data['foo'] = $client->get('foo');
        $this->render('public/test');
    }
}
