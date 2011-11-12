<?php get_header(); ?>
<?php 
  global $post;
  global $wpdb;
  global $prefix;

  $term_object = wp_get_object_terms(  $post->ID, 'bc_leaderboard');
  $badges = wp_get_object_terms(  $post->ID, 'bc_badges'); 
  $source_meta = get_post_meta($post->ID, 'bc_buy_sources');
  $sources = json_decode($source_meta[0], true);
  $price = get_post_meta($post->ID, 'bc_price');
  $attachments = get_posts(array( 'post_type' => 'attachment', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'asc', 'post_status' => null, 'post_parent' => $post->ID ));
?>

<?php if(count($attachments) > 0): ?>
<div class="image">
  <div class="large">
    <?php
      $image_attributes = wp_get_attachment_image_src( $attachments[0]->ID, array(450,450));
      //echo("<img src=\"".$image_attributes[0]."\" width=\"".$image_attributes[1]."\" height=\"".$image_attributes[2]."\"/>");
      echo("<img src=\"".$image_attributes[0]."\" width=\"".$image_attributes[1]."\" />");
    ?>
  </div>
</div>
<?php endif; ?>


<div class="grid_6 alpha article">
  
  <div class="breadcrumbs">
    <a href="/">Home</a> &rsaquo;
    <?php
    $catlist = get_the_term_list( $post->ID, 'bc_leaderboard', '', ' &rsaquo; ', '</li>' );
    if( $catlist ):
    ?>
      <?php echo $catlist; ?>
    <?php endif; ?>
  </div>
  
  
  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  
  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h1 class="entry-title"><?php edit_post_link('Edit', '<span class="edit-link">[', ']</span>' ); ?><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <h2><?php echo get_post_meta($post->ID, $prefix.'sub_title', true); ?></h2>
    
    <div class="meta">
      <ul>
        <li class="date"><span><?php the_date('Y-m-d'); ?></span></span>
        <li class="author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></span>
        <?php
          // Categories, only shown if any
          $catlist = get_the_term_list( $post->ID, 'bc_leaderboard', '<li class="category">', '</li><li class="category">', '</li>' );
          if( $catlist ):
            echo $catlist;
          endif;
        ?>
        <div class="clear"></div>
      </ul>
    </div>
    
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
  </div>
  
  <div class="best-sources">
    <?php $appendix = get_post_meta($post->ID, 'bc_appendix', true); ?>
    <?php if( $appendix ): ?>
      <h2>Best Sources</h2>
      <?php echo $appendix ?>
    <?php endif; ?>
  </div>
  
  
  <?php endwhile ?>
  
	<?php  comments_template(); // Comments disabled on Reviews ?>
  <?php // get_sidebar('single-bc_review'); ?>
  <div class="clear"></div>
</div>

<div class="grid_2 side omega">
  <div class="right">
    <div class="box specs">
      <?php $key_specs = get_post_meta($post->ID, '_wcspecs', true); ?>
      <?php if( $key_specs ): ?>
        <h2>Key Specs</h2>
        <?php echo $key_specs ?>
      <?php endif; ?>
    </div>
    
    <div class="buy">
      <dl>
        <?php
          // price, only shown if set
          $price = $price[0];
          if($price):
        ?>
          <dt>
            Approximate Price
            <div class="price"><?php echo $price; ?></div>
          </dt>
        <?php endif; ?>
        
        <dd>
          <ul>
            <?php foreach($sources as $s) { ?>
              <li class="<?php echo strtolower($s['source_entry_title']) ?>">
                <a href="<?php echo $s['source_url'] ?>">Buy on <?php echo $s['source_entry_title'] ?></a>
              </li>
            <?php } ?>
          </ul>
        </dd>
      </dl>
    </div>
    
    <div class="related-categories box">
      <h2>Read More</h2>
      <ul>
        <?php
        // Categories, only shown if any
        $catlist = get_the_term_list( $post->ID, 'bc_leaderboard', '<li>', '</li><li>', '</li>' );
        if( $catlist ):
        ?>
          <?php echo $catlist; ?>
        <?php endif; ?>
      </ul>
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
    
    
    <div class="social">
      <a href="https://twitter.com/share" class="twitter-share-button" data-count="vertical">Tweet</a>
      <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
      <div id="facebook" class="fb-like" data-href="<?php global $fburl; echo $fburl ?>" data-send="false" data-layout="box_count" data-width="60" data-show-faces="false"></div>
    </div>
  </div>
  
</div>

<?php get_footer(); ?>
