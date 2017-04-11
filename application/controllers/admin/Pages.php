<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();
    if(!$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('message','You are not allowed to visit the Pages page');
      redirect('admin','refresh');
    }
    $this->load->model('page_model');
    $this->load->model('page_translation_model');
    $this->load->model('language_model');
    $this->load->library('form_validation');
    $this->load->helper('text');
  }

  public function index()
  {
    $this->render('admin/pages/index_view');
  }

  public function create($language_slug = NULL, $page_id = 0)
  {
    $language_slug = (isset($language_slug) && array_key_exists($language_slug, $this->langs)) ? $language_slug : $this->current_lang;

    $this->data['content_language'] = $this->langs[$language_slug]['slug'];
    $this->data['language_slug'] = $language_slug;
    if($page_id != 0 && $this->page_model->get($page_id)===FALSE)
    {
      $page_id = 0;
    }
    if($this->page_translation_model->where(array('page_id'=>$page_id,'language_slug'=>$language_slug))->get())
    {
      $this->session->set_flashdata('message', 'A translation for that page already exists.');
      redirect('admin/pages', 'refresh');
    }
    $this->data['page_id'] = $page_id;
    $pages = $this->page_translation_model->where('language_slug',$language_slug)->order_by('menu_title')->fields('id,menu_title')->get_all();
    $this->data['parent_pages'] = array('0'=>'No parent page');
    if(!empty($pages))
    {
      foreach($pages as $page)
      {
        $this->data['parent_pages'][$page->id] = $page->menu_title;
      }
    }

    $rules = $this->page_model->rules;
    $this->form_validation->set_rules($rules['insert']);
    if($this->form_validation->run()===FALSE)
    {
      $this->render('admin/pages/create_view');
    }
    else
    {
      $parent_id = $this->input->post('parent_id');
      $title = $this->input->post('title');
      $menu_title = (strlen($this->input->post('menu_title')) > 0) ? $this->input->post('menu_title') : $title;
      $slug = (strlen($this->input->post('slug')) > 0) ? url_title($this->input->post('slug'),'-',TRUE) : url_title(convert_accented_characters($title),'-',TRUE);
      $order = $this->input->post('order');
      $content = $this->input->post('content');
      $teaser = (strlen($this->input->post('teaser')) > 0) ? $this->input->post('teaser') : substr($content, 0, strpos($content, '<!--more-->'));
      $page_title = (strlen($this->input->post('page_title')) > 0) ? $this->input->post('page_title') : $title;
      $page_description = (strlen($this->input->post('page_description')) > 0) ? $this->input->post('page_description') : ellipsize($teaser, 160);
      $page_keywords = $this->input->post('page_keywords');
      $page_id = $this->input->post('page_id');
      $language_slug = $this->input->post('language_slug');
      if ($page_id == 0)
      {
        $page_id = $this->page_model->insert(array('parent_id' => $parent_id, 'order' => $order, 'created_by'=>$this->user_id));
      }

      $insert_data = array('page_id'=>$page_id,'title' => $title, 'menu_title' => $menu_title, 'teaser' => $teaser,'content' => $content,'page_title' => $page_title, 'page_description' => $page_description,'page_keywords' => $page_keywords,'language_slug' => $language_slug,'created_by'=>$this->user_id);

      if($translation_id = $this->page_translation_model->insert($insert_data))
      {
        $url = $this->_verify_slug($slug,$language_slug);
        $this->slug_model->insert(array(
          'content_type'=>'page',
          'content_id'=>$page_id,
          'translation_id'=>$translation_id,
          'language_slug'=>$language_slug,
          'url'=>$url,
          'created_by'=>$this->user_id));
        //$this->slug_model->where(array('content_type'=>'page','content_id'=>$page_id,'id !='=>$slug_id))->update(array('redirect'=>$slug_id));
      }

      redirect('admin/pages','refresh');

    }


  }
  private function _verify_slug($str,$language)
  {
    $this->load->model('slug_model');
    if($this->slug_model->where(array('url'=>$str,'language_slug'=>$language))->get() !== FALSE)
    {
      $parts = explode('-',$str);
      if(is_numeric($parts[sizeof($parts)-1]))
      {
        $parts[sizeof($parts)-1] = $parts[sizeof($parts)-1]++;
      }
      else
      {
        $parts[] = '1';
      }
      $str = implode('-',$parts);
      $this->_verify_slug($str,$language);
    }
    return $str;
  }
}