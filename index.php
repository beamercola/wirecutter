<?php get_header(); ?>
<div id="content">
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
  
  $i = 0;
  foreach($leaderboard_categories as $category) {
    $i++;
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
      'posts_per_page' => '4',
      'meta_key'=> $prefix.'order',
      'orderby'=> 'meta_value',
      'order'=>'ASC',
      'post_type'=> $prefix.'review'
    );
    
    $wp_query->query($args);
    if($wp_query->have_posts()) {
?>
  <li class="<?php echo $category->slug ?>">
    <dl>
      <dt style="<?php echo esc_attr( wchomeicons_inline_style( $category->term_id ) ) ?>" ><a href="/leaderboard/<?php echo $category->slug; ?>"><?php echo $category->name; ?></a></dt>
      <dd>
        <a href="/leaderboard/<?php echo $category->slug; ?>"><img src="<?php echo esc_url( wchomecats_imgsrc( $category->term_id ) ) ?>" /></a>
        <ul>
<?php
		    $i = 0;
        while( $wp_query->have_posts() ) {
          $i++;
          $wp_query->the_post();
          if( get_post_meta($post->ID, $prefix.'short_title') ) {
            $homeTitle = get_post_meta( $post->ID, $prefix.'short_title', true );
          } else {
            $homeTitle = $post->post_title;
          }
          if($i < 4) {
?>
            <li>
              <a class="title" href="<?php echo the_permalink(); ?>">
                <?php echo $homeTitle; ?>
                <?php if( get_post_meta($post->ID, $prefix.'sub_title') ) { ?>
                <div class="product"><?php echo get_post_meta($post->ID, $prefix.'sub_title', true) ?></div>
                <?php } ?>
              </a>
            </li>
<?php
} else {
  ?>
            <li class="more">
              <a href="/leaderboard/<?php echo $category->slug; ?>">More in <?php echo $category->name; ?>...</a>
            </li>
<?php
  }
}
?>
          </ul>
        </dd>
      </dl>
<?php
  }
}
?>
    </ul>
  <div class="clear"></div>
</div>
<?php get_sidebar('home'); ?>
<?php get_footer(); ?>
