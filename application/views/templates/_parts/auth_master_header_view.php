<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $page_title; ?></title>
        <?php echo Load_helper::get_libraries() ?>
        <?php echo $before_closing_head; ?>
    </head>
<body>
<?php
if ($this->ion_auth->logged_in()) {
    ?>
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
                   href="<?php echo site_url('dashboard'); ?>">
                    <?php echo $this->config->item('cms_title'); ?>
                </a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">

                    <?php echo $current_user_menu; ?>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo site_url('user/logout'); ?>">Logout</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>
    <?php
    if ($this->session->flashdata('message')) {
        ?>
        <div class="container" style="padding-top:40px;">
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <?php echo $this->session->flashdata('message'); ?>
            </div>
        </div>
        <?php
    }
    ?>
    <?php
}
?>