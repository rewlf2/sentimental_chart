<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<li><a href="<?= site_url('facebook_reports/reports_overview') ?>">Reports overview</a></li>

<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page
        <span class="caret"></span></a>
    <ul class="dropdown-menu">
        <li><a href="<?= site_url('facebook_reports/page_growth') ?>">Page Growth</a></li>
        <li><a href="<?= site_url('facebook_reports/page_reach') ?>">Page Reach</a></li>
    </ul>
</li>

<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Post
        <span class="caret"></span></a>
    <ul class="dropdown-menu">
        <li><a href="<?= site_url('facebook_reports/post_reach') ?>">Post Reach</a></li>
        <li><a href="<?= site_url('facebook_reports/engagement') ?>">Engagement</a></li>
        <li><a href="<?= site_url('facebook_reports/overview') ?>">Facebook overview</a></li>
        <li><a href="<?= site_url('facebook_reports/content') ?>">Content</a></li>
    </ul>
</li>

<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Video
        <span class="caret"></span></a>
    <ul class="dropdown-menu">
        <li><a href="<?= site_url('facebook_reports/video') ?>">Video</a></li>
    </ul>
</li>