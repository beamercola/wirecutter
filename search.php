<?php get_header(); ?>

<div class="grid_6 leaderboard article alpha">
  <h1 class="page-title">Search Results: <?php echo wp_specialchars($s, 1) ?></h1>
  <?php while ( have_posts() ): the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <h2 class="entry-title"><?php edit_post_link('Edit', '<span class="edit-link">[', ']</span>' ); ?><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h2>
      
      <div class="entry-content">
        <?php the_excerpt('[...]'); ?>
      </div><!-- .entry-content -->
    </div><!-- #post -->
  <?php endwhile; // end of the loop. ?>
  <div id="nav-below" class="navigation clearfix">
    <div class="nav-next"><?php next_posts_link( '<span class="meta-nav">&laquo;</span> Older posts' ) ?></div>
    <div class="nav-previous"><?php previous_posts_link( 'Newer posts <span class="meta-nav">&raquo;</span>' ) ?></div>
  </div>
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
