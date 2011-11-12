<?php get_header(); ?>

<div class="article alpha grid_6">
  
  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  
  <?php do_action('wcsponsored_post_single') ?>
  
  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h1 class="entry-title"><?php edit_post_link('Edit', '<span class="edit-link">[', ']</span>' ); ?><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h1>
    
    <div class="meta">
      <ul>
        <li class="date"><span><?php the_date('Y-m-d'); ?></span></li>
        <li class="author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></li>
      </ul>
      <div class="clear"></div>
    </div>
    
    <div class="entry-content" style="clear: left;">
      <?php the_content(); ?>
    </div>
  </div>
  
  <div class="appendix">
    <?php echo get_post_meta($post->ID, 'bc_appendix', true); ?>
  </div>
  <?php endwhile; // end of the loop. ?>
  
  <div id="nav-below" class="single navigation clearfix">
    <div class="nav-next"><?php next_post_link('<span class="meta-nav"><b>Next:</b> %link</span>', '%title'); ?></div>
    <div class="nav-previous"><?php previous_post_link('<span class="meta-nav"><b>Previous:</b> %link</span>', '%title'); ?></div>
  </div>
  
  <div class="line"></div>
  
  <?php comments_template(); ?>
</div>

<div class="side grid_3 omega">

  <div class="box related-categories">
    <h2>Read More</h2>
    <ul>
      <li><a href="/">Back to Home</a></li>
    </ul>
  </div>
</div>


<?php get_footer(); ?>
