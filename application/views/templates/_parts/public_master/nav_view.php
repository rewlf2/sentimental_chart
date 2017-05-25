<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand"
               href="<?php echo site_url('dashboard'); ?>"><?php echo $this->config->item('cms_title'); ?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php foreach ($other_langs as $key => $lang) { ?>
                    <li><a href="<?php echo site_url($key); ?>"><?php echo $lang['name'] ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
