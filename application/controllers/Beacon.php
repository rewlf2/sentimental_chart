<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Beacon extends Auth_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->helper('url');

        $this->load->model("beacon/post_model", 'beacon_post_model');
    }

    function index(){
        
    }
}
