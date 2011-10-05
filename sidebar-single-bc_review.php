<div id="side">
  <div class="side-wrapper">
    <?php 
      global $post;
      global $wpdb;
  
      $term_object = wp_get_object_terms(  $post->ID, 'bc_leaderboard');
      $badges = wp_get_object_terms(  $post->ID, 'bc_badges'); 
      $source_meta = get_post_meta($post->ID, 'bc_buy_sources');
      $sources = json_decode($source_meta[0], true);
      $price = get_post_meta($post->ID, 'bc_price');
    ?>

    <h3><?php echo wcfn_format_stars('Author') ?></h3>
    <div class="sidebar-box">
      <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a>
    </div>

    <h3><?php echo wcfn_format_stars('Date') ?></h3>
    <div class="sidebar-box">
      <?php the_date('Y-m-d', '<span>', '</span>'); ?>
    </div>


    <?php// wcfn_thumbnail_slideshow($post); // thumbnails ?>

    <?php
      // Tags, only shown if any
      $taglist = get_the_tag_list( '<ul><li>', '</li><li>', '</li></ul>' );
      if( $taglist ):
    ?>
      <h3><?php echo wcfn_format_stars('Tags') ?></h3>
      <div class="sidebar-box"><?php echo $taglist; ?></div>
    <?php endif; ?>

    <?php
      // Categories, only shown if any
      $catlist = get_the_term_list( $post->ID, 'bc_leaderboard', '<ul><li>', '</li><li>', '</li></ul>' );
      if( $catlist ):
    ?>
      <h3><?php echo wcfn_format_stars('Categories') ?></h3>
      <div class="sidebar-box"><?php echo $catlist; ?></div>
    <?php endif; ?>

  </div>
</div>
