<?php get_header(); ?>

<ul class="leaderboard">
<?php
  global $prefix;
  global $wpdb;
  $args = array(
    'type'            => $prefix.'review',
    'orderby'         => 'count',
    'parent'          => 0,
    'order'           => 'DESC',
    'hide_empty'      => 0,
    'hierarchical'    => 0,
    'taxonomy'        => $prefix.'leaderboard',
    'pad_counts'      => false
  );
  $leaderboard_categories = get_categories($args);
  
  foreach($leaderboard_categories as $category) {
?>
  <li class="<?php echo $category->slug ?>">
    <dl>
      <dt><a href="/leaderboard/<?php echo $category->slug; ?>"><?php echo $category->name; ?></a></dt>
      <dd>
        <a href="#"><img src="http://placehold.it/200x75/ffffff" /></a>
        <ul>
<?php
        $wp_query = null;
        $wp_query = new WP_Query();
        $args = array(
          'tax_query' => array(
            'relation' => 'AND',
            array(
              'taxonomy' => $prefix.'leaderboard',
              'field' => 'slug',
              'terms' => array($category -> slug),
            ),
            array(
              'taxonomy' => 'category',
              'field' => 'id',
              'terms' => array(1),
              'operator' => 'NOT IN',
            )
          ),
          'posts_per_page' => '3',
          'meta_key'=> $prefix.'order',
          'orderby'=> 'meta_value',
          'order'=>'ASC',
          'post_type'=> $prefix.'review'
        );
        
        $wp_query->query($args);
		    
        while( $wp_query->have_posts() ) {
          $wp_query->the_post();
          if( get_post_meta($post->ID, $prefix.'short_title') ) {
            $homeTitle = get_post_meta( $post->ID, $prefix.'short_title', true );
          } else {
            $homeTitle = $post->post_title;
          }
?>
            <li><a class="li" href="<?php echo the_permalink(); ?>"><?php echo $homeTitle; ?></a></li>
<?php } ?>
          </ul>
        </dd>
      </dl>
<?php } ?>
    </ul>
  <div class="clear"></div>
</div>
    
<?php get_sidebar('home'); ?>

<?php get_footer(); ?>
