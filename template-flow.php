<?php
/*
Template Name: Flow Page
*/

get_header(); ?>

<div class="article alpha grid_6">
  <h1 class="page-title">Tech as Magic</h1>
  <?php
    $args = array(
        'showposts' => 5,
        'post_type' => 'post',
        'post_status' => 'publish',
        'orderby' => 'date',
        'paged' => $paged,
        'post__not_in' => array(93),    // skip WELCOME post
    );
    $temp = $wp_query;
    $wp_query = null;
    $wp_query = new WP_Query();
    $wp_query->query($args);
    while ($wp_query->have_posts()) : 
        $wp_query->the_post(); 
    ?>
    <div class="flow_item">
      <h3><a href="<?php echo the_permalink();?>"><?php echo substr($post->post_title, 0); ?></a></h3>
      <p><?php echo get_the_excerpt(); ?></p>
    </div>
  
    <?php endwhile; ?>

    <div id="nav-below" class="navigation clearfix">
      <div class="nav-next"><?php next_posts_link( '<span class="meta-nav">&laquo;</span> Older posts' ) ?></div>
      <div class="nav-previous"><?php previous_posts_link( 'Newer posts <span class="meta-nav">&raquo;</span>' ) ?></div>
    </div>
  
    <?php
      $wp_query = null; 
      $wp_query = $temp;
    ?>

</div>

<div class="grid_2 omega side">
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

  <div class="box">
    <h3>Leaderboards</h3>
    <ul class="categories">
      <?php wp_list_categories( $args ); ?>
    </ul>
  </div>
</div>

<?php get_footer(); ?>

