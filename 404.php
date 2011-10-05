<?php get_header(); ?>

<div id="container" class="clearfix">
    <div id="main">

    <h1>404 - Sorry - we couldn't find that page!</h1>
    
    <p>Why not go back to the <b><a href="/">Homepage</a></b>?</p>
    
    <?php
    $args = array(
      'taxonomy'     => 'bc_leaderboard',
      'orderby'      => 'name',
      'show_count'   => 0,
      'pad_counts'   => 1,
      'hierarchical' => 1,
      'title_li'     => 0,
      'use_desc_for_title' => 0
    );
    ?>

    <ul>
    <?php wp_list_categories( $args ); ?>
    </ul>
    
    </div><!-- #main -->
    
    <?php get_sidebar('home'); ?>

</div><!-- #container -->
<?php get_footer(); ?>
