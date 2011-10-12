<?php get_header(); ?>
<?php 
  $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
  $args = array(
      'showposts' => -1,
      'author' => $curauth->ID,
      'post_type' => array('post','bc_review'),
      'post_status' => 'publish',
      'orderby' => 'date',
  );
  
  $temp = $wp_query;
  $wp_query = null;
  $wp_query = new WP_Query();
  $wp_query->query($args);
?>

<div class="grid_6 leaderboard article alpha">
  <h1 class="page-title">Posts by: <?php echo $curauth->nickname; ?></h1>
    <?php while ( $wp_query->have_posts() ): $wp_query->the_post(); ?>
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
        
    <?php $wp_query = null; $wp_query = $temp; ?>
    
</div><!-- #container -->
<div class="grid_2 side omega">
  <div class="box">
    <h2>Authors</h2>
    <?php wcfn_wp_list_authors('show_fullname=1&optioncount=1&orderby=post_count&order=DESC'); ?>
  </div>
  
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
