<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Administration
        <span class="caret"></span></a>
    <ul class="dropdown-menu">
        <li><a href="<?php echo site_url('admin/users'); ?>">Users</a></li>
        <li><a href="<?php echo site_url('admin/groups'); ?>">Groups</a></li>
        <li><a href="<?php echo site_url('admin/languages'); ?>">Languages</a></li>
        <li><a href="<?php echo site_url('admin/pages'); ?>">Pages</a></li>
    </ul>
</li>