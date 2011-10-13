<?php get_header(); ?>

<div class="grid_6 leaderboard article alpha">
  <h1 class="page-title">Leaderboard: <?php single_tag_title() ?></h1>
  
  <div class="reviews">
    <?php while ( have_posts() ): the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <h2 class="entry-title"><?php edit_post_link('Edit', '<span class="edit-link">[', ']</span>' ); ?><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <h3><?php echo get_post_meta($post->ID, $prefix.'sub_title', true);?></h3>
      <?php
        // echo var_dump($post);
        $attachments = get_posts(array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID ));
        if(count($attachments) > 0) {
          $image_attributes = wp_get_attachment_image_src( $attachments[0]->ID, array(450,450)); ?>
          <a href="<?php echo the_permalink(); ?>"><img src="<?php echo $image_attributes[0]; ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" /></a>
        <?php }
      ?>
      <div class="entry-content">
        <?php the_excerpt('[...]'); ?>
      </div><!-- .entry-content -->
    </div><!-- #post -->
    <?php endwhile; // end of the loop. ?>
  </div>
    
  <div id="nav-below" class="navigation clearfix">
    <div class="nav-next"><?php next_posts_link( '<span class="meta-nav">&laquo;</span> Older posts' ) ?></div>
    <div class="nav-previous"><?php previous_posts_link( 'Newer posts <span class="meta-nav">&raquo;</span>' ) ?></div>
  </div>
        
  <?php 
    $slug = get_query_var('bc_leaderboard');
    $description = term_description( get_term_by( 'slug', $slug, 'bc_leaderboard' )->term_id, 'bc_leaderboard' );
    if( $description ):
  ?>
    <div class="vbreak">***</div>
    <?php echo $description ?>
  <?php endif; ?>
  	
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
    <h3>Other Categories</h3>
    <ul class="categories">
      <?php wp_list_categories( $args ); ?>
    </ul>
  </div>
  
</div>
    
<?php get_footer(); ?>
