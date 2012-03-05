<?php get_header(); ?>
<div id="content">
<ul class="leaderboard">
<?php
global $wpdb;

// get all the leaderboard categories
$args = array(
  'type'            => 'bc_review',
  'orderby'         => 'count',
  'parent'          => 0,
  'order'           => 'DESC',
  'hide_empty'      => 0,
  'hierarchical'    => 0,
  'taxonomy'        => 'bc_leaderboard',
  'pad_counts'      => false
);
$categories = get_categories($args);

// for sorting, build array of (term_id => category)
$categories_by_id = array();
for($i=0; $i<count($categories); $i++) {
  $category = $categories[$i];
  $categories_by_id[$category->term_id] = $category;
}
// set a default sorting order if sorting info is absent
$wchomeorder_order = get_option( 'wchomeorder_order', NULL );
if( ! is_array( $wchomeorder_order )) {
  $wchomeorder_order = array();
  foreach($categories as $category) {
    $wchomeorder_order[$category->term_id] = array();
  }
}

// categories to show on homepage ( map of term_id => bool )
$keep_categories = get_option( 'wc_homepage_checkbox', null );

$categories = array();
// loop over ordering
foreach($wchomeorder_order as $k => $v) {

  // get the category
  $category = $categories_by_id[$k];

  // skip if not a homepage category
  if( ! array_key_exists($category->term_id, $keep_categories) || ! $keep_categories[$category->term_id] ) {
    continue;
  }
  $categories[] = $category;

  // get all posts in this category
  $temp_posts = array();
  $wp_query = new WP_Query();
  $args = array( 'tax_query' => array( 'relation' => 'AND', array( 'taxonomy' => 'bc_leaderboard', 'field' => 'slug', 'terms' => array($category->slug), ), array( 'taxonomy' => 'category', 'field' => 'id', 'terms' => array(1), 'operator' => 'NOT IN', ) ), 'post_type'=> 'bc_review' );
  $wp_query->query($args);
  if($wp_query->have_posts()) {
    while( $wp_query->have_posts() ) {
      $homeTitle = ''; 
      $subTitle = '';
      $wp_query->the_post();
      if( get_post_meta($post->ID, 'bc_short_title') ) {
        $homeTitle = get_post_meta( $post->ID, 'bc_short_title', true );
      } else {
        $homeTitle = $post->post_title;
      }
      if( get_post_meta($post->ID, 'bc_sub_title') ) { 
        $subTitle = get_post_meta($post->ID, 'bc_sub_title', true);
      }

      $temp_posts[$post->ID] = array(
        'ID' => $post->ID,
        'homeTitle' => $homeTitle,
        'subTitle' => $subTitle,
        'permalink' => get_permalink($post->ID),
      );
    }
  }
  // sort posts in category according to order
  $category->posts = array();
  if( $v ) {
    $order = explode(',',$v);
    foreach($order as $idx) {
      // put in order, append missing indices to the end
      if( array_key_exists( $idx, $temp_posts ) ) {
        $category->posts[] = $temp_posts[$idx];
        unset( $temp_posts[$idx] );
      }
    }
    foreach( $temp_posts as $k => $v ) {
      $category->posts[] = $v;
    }
  } else {
    // no defined order, just add 'em
    foreach($temp_posts as $k => $v) {
      $category->posts[] = $v;
    }
  }
}

// write HTML
foreach( $categories as $category ) {
?>
  <li class="<?php echo $category->slug ?>">
    <dl>
      <dt style="<?php echo esc_attr( wchomeicons_inline_style( $category->term_id ) ) ?>" ><a href="/leaderboard/<?php echo $category->slug; ?>"><?php echo $category->name; ?></a></dt>
      <dd>
        <a href="/leaderboard/<?php echo $category->slug; ?>"><img src="<?php echo esc_url( wchomecats_imgsrc( $category->term_id ) ) ?>" /></a>
        <ul>
          <?php $i = 0; foreach( $category->posts as $k => $post ): ?>
          <?php if($i < 3): ?>
            <li>
              <a class="title" href="<?php echo $post['permalink'] ?>">
                <?php echo $post['homeTitle']; ?>
                <?php if( $post['subTitle'] ) { ?>
                  <div class="product">
                    <?php echo $post['subTitle'] ?>
                 </div>
                <?php } ?>
              </a>
            </li>
          <?php else: ?>
            <li class="more">
              <a href="/leaderboard/<?php echo $category->slug; ?>">More in <?php echo $category->name; ?>...</a>
            </li>
          <?php break; endif; ?>
        <?php $i++; endforeach; ?>
        </ul>
      </dd>
    </dl>
  </li>
<?php
} //endforeach
?>
</ul>
<div class="clear"></div>
</div>
<?php get_sidebar('home'); ?>
<?php get_footer(); ?>
