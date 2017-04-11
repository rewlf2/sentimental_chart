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

	public function upload()
  {
    $this->load->helper('form');
    $data = array();
    $data['title'] = 'Multiple file upload';
    if($this->input->post())
    {
      // retrieve the number of images uploaded;
      $number_of_files = sizeof($_FILES['uploadedimages']['tmp_name']);
      // considering that do_upload() accepts single files, we will have to do a small hack so that we can upload multiple files. For this we will have to keep the data of uploaded files in a variable, and redo the $_FILE.
      $files = $_FILES['uploadedimages'];
      $errors = array();

      // first make sure that there is no error in uploading the files
      for($i=0;$i<$number_of_files;$i++)
      {
        if($_FILES['uploadedimages']['error'][$i] != 0) $errors[$i][] = 'Couldn\'t upload file '.$_FILES['uploadedimages']['name'][$i];
      }
      if(sizeof($errors)==0)
      {
        // now, taking into account that there can be more than one file, for each file we will have to do the upload
        // we first load the upload library
        $this->load->library('upload');
        // next we pass the upload path for the images
        $config['upload_path'] = FCPATH . 'uploads/';
        // also, we make sure we allow only certain type of images
        $config['allowed_types'] = 'gif|jpg|png';
        for ($i = 0; $i < $number_of_files; $i++) {
          $_FILES['uploadedimage']['name'] = $files['name'][$i];
          $_FILES['uploadedimage']['type'] = $files['type'][$i];
          $_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'][$i];
          $_FILES['uploadedimage']['error'] = $files['error'][$i];
          $_FILES['uploadedimage']['size'] = $files['size'][$i];
          //now we initialize the upload library
          $this->upload->initialize($config);
          // we retrieve the number of files that were uploaded
          if ($this->upload->do_upload('uploadedimage'))
          {
            $data['uploads'][$i] = $this->upload->data();
          }
          else
          {
            $data['upload_errors'][$i] = $this->upload->display_errors();
          }
        }
      }
      else
      {
        print_r($errors);
      }
      echo '<pre>';
      print_r($data);
      echo '</pre>';
    }
    else
    {
      $this->load->view('upload_form', $data);
    }
  }
}
