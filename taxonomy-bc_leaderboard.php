<?php get_header(); ?>

<div id="content">
  <h1 class="page-title">Leaderboard: <?php single_tag_title() ?></h1>

  <ul class="category-leaderboard">
    <?php while ( have_posts() ): the_post(); ?>
    <li <?php post_class(); ?>>
      <?php
        $attachments = get_posts(array( 'post_type' => 'attachment', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'asc', 'post_status' => null, 'post_parent' => $post->ID ));
        if(count($attachments) > 0) {
          $image_attributes = wp_get_attachment_image_src( $attachments[0]->ID, array(450,450)); ?>
          <a href="<?php echo the_permalink(); ?>" class="image"><img src="<?php echo $image_attributes[0]; ?>" width="200"  /></a>
        <?php } else {
          echo '<a href="#" class="image"><img src="http://placehold.it/200x150" /></a>';
        }
      ?>
      <a href="<?php echo the_permalink(); ?>">
        <h2 class="entry-title"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <h3><?php echo get_post_meta($post->ID, $prefix.'sub_title', true);?></h3>
      </a>
      <div class="entry-content">
        <?php echo substr(preg_replace("/Last Updated: .* \d{4}/i", "", get_the_excerpt()), 0, 80) . '...'; ?>
        <a href="<?php echo the_permalink(); ?>">more</a>
      </div><!-- .entry-content -->
    </li><!-- #post -->
    <?php endwhile; // end of the loop. ?>
  </ul>
</div>

<div id="side">
  <div class="side-wrapper">
    LIST OF GUIDES HERE
  </div>
</div>
    
<?php get_footer(); ?>
