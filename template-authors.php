<?php
/*
Template Name: Authors Page
*/

get_header(); ?>

<div id="container" class="clearfix">
    <div id="main">
        
        <h1 class="page-title">Authors</h1>

    <?php wcfn_wp_list_authors('show_fullname=1&optioncount=1&orderby=post_count&order=DESC'); ?>
			
    </div><!-- #main -->
    
    <?php get_sidebar(); ?>

</div><!-- #container -->
<?php get_footer(); ?>

