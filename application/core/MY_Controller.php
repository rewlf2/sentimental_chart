<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $data = array();

    protected $langs = array();
    protected $other_langs = array();
    protected $default_lang;
    protected $current_lang;

    function __construct()
    {
        parent::__construct();
        // First of all let's see what languages we have and also get the default language
        $this->load->model('language_model');
        $available_languages = $this->language_model->get_all();
        if (isset($available_languages)) {
            foreach ($available_languages as $lang) {
                $this->langs[$lang->slug] = array(
                    'id' => $lang->id,
                    'name' => $lang->language_name,
                    'slug' => $lang->slug,
                    'language_directory' => $lang->language_directory,
                    'language_code' => $lang->language_code,
                    'default' => $lang->default
                );
                if ($lang->default == '1') {
                    $this->default_lang = $lang->slug;
                }
            }
        }

        // Verify if we have a language set in the URL;
        $lang_slug = $this->uri->segment(1);
        // If we do, and we have that languages in our set of languages, we store the language slug in the session
        if (isset($lang_slug) && array_key_exists($lang_slug, $this->langs)) {
            $this->current_lang = $lang_slug;
            $_SESSION['set_language'] = $lang_slug;
        } // If not, we look to see if the language session variable is set
        elseif (isset($_SESSION['set_language'])) {
            $this->current_lang = $_SESSION['set_language'];
        } // If not, we set the language session to the default language
        else {
            $this->current_lang = $this->default_lang;
            $_SESSION['set_language'] = $this->default_lang;
        }
        // Now we store the languages as a $data key, just in case we need them in our views
        $this->data['langs'] = $this->langs;
        // Also let's have our current language in a $data key
        $this->data['current_lang'] = $this->langs[$this->current_lang];


        // put all other langs (except current lang) in an array
        $this->data['other_langs'] = [];
        foreach ($this->langs as $key => $lang) {
            if ($key != $this->current_lang) {
                $this->data['other_langs'][$key] = $lang;
            }
        }

        // For links inside our views we only need the lang slug. If the current language is the default language we don't need to append the language slug to our links
        if ($this->current_lang != $this->default_lang) {
            $this->data['lang_slug'] = $this->current_lang . '/';
        } else {
            $this->data['lang_slug'] = '';
        }

        $this->data['page_title'] = 'CI App';
        $this->data['page_description'] = 'CI_App';
        $this->data['before_closing_head'] = '';
        $this->data['before_closing_body'] = '';

        // Load libraries and css for view
        $this->load->helper('load_helper');
        if(!$this->input->is_ajax_request()){
            Load_helper::load_libraries('default');
        }
    }

    protected function render($the_view = NULL, $template = 'master')
    {
        if ($template == 'json' || $this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        } elseif (is_null($template)) {
            $this->load->view($the_view, $this->data);
        } else {
            $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, TRUE);
            $this->load->view('templates/' . $template . '_view', $this->data);
        }
    }
}


class Auth_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->helper('url');
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('user/login', 'refresh');
        }
        $current_user = $this->ion_auth->user()->row();
        // get the current user's ID
        $this->user_id = $current_user->id;
        $this->data['current_user'] = $current_user;
        $this->data['current_user_menu'] = '';

        if ($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('member')) {
            $this->data['current_user_menu'] = $this->load->view('templates/_parts/user_menu/auth_view.php', NULL, TRUE);
        }

        if ($this->ion_auth->in_group('admin')) {
            $this->data['current_user_menu'] = $this->load->view('templates/_parts/user_menu/admin_view.php', NULL, TRUE) . $this->data['current_user_menu'];
        }

        if ($this->ion_auth->in_group('member')) {
            $this->data['current_user_menu'] = $this->load->view('templates/_parts/user_menu/member_view.php', NULL, TRUE) . $this->data['current_user_menu'];
        }

        $this->data['page_title'] = 'CI App - Dashboard';
    }

    protected function render($the_view = NULL, $template = 'auth_master')
    {
        parent::render($the_view, $template);
    }
}

class Admin_Controller extends Auth_Controller
{
    function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('message', 'You are not allowed to visit the page');
            redirect('dashboard', 'refresh');
        }

        $this->data['page_title'] = 'CI App - Admin - Dashboard';
    }
}

class Member_Controller extends Auth_Controller
{
    function __construct()
    {
        parent::__construct();

        if (!($this->ion_auth->in_group('admin') || $this->ion_auth->in_group('member'))) {
            $this->session->set_flashdata('message', 'You are not allowed to visit the page');
            redirect('dashboard', 'refresh');
        }

        $this->data['page_title'] = 'CI App - Member - Dashboard';
    }
}

class Public_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $language = $this->data['current_lang'];
        $this->load->language('interface_lang', $language['language_directory']);
    }

    protected function render($the_view = NULL, $template = 'public_master')
    {
        // $this->load->library('menus');
        // $this->data['top_menu'] = $this->menus->get_menu('top-menu',$this->current_lang,'bootstrap_menu');
        parent::render($the_view, $template);
    }
}