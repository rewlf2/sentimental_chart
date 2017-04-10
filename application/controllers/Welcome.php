<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
    // first load the library
    $this->load->library('make_bread');

    // add the first crumb, the segment being added to the previous crumb's URL
    $this->make_bread->add('first crumb', 'testing', TRUE);

    // add the second crumb, the segment not being added to the previous crumb's URL
    $this->make_bread->add('second crumb', 'the_test', TRUE);

    // add another crumb with a absolute URL
    $this->make_bread->add('test','http://google.com');

    // being the last crumb in the breadcrumb I want this to have no link, so I will only put the title
    $this->make_bread->add('Testing breadcrumbs');

    // now, let's store the output of the breadcrumb in a variable and show it (preferably inside a view)
    $breadcrumb = $this->make_bread->output();
    echo $breadcrumb;
	}
}
