<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo $page_title;?></title>
  <meta name="description" value="<?php echo $page_description;?>" />
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <link href="<?php echo site_url('assets/admin/css/bootstrap.min.css');?>" rel="stylesheet">
  <?php echo $before_closing_head;?>
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand"
           href="<?php echo site_url('admin');?>"><?php echo $this->config->item('cms_title');?></a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <?php foreach($other_langs as $key => $lang){ ?>
            <li><a href="<?php echo site_url($key);?>"><?php echo $lang['name'] ?></a></li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>
