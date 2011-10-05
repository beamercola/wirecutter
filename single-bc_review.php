<?php get_header(); ?>
<?php 
  global $post;
  global $wpdb;

  $term_object = wp_get_object_terms(  $post->ID, 'bc_leaderboard');
  $badges = wp_get_object_terms(  $post->ID, 'bc_badges'); 
  $source_meta = get_post_meta($post->ID, 'bc_buy_sources');
  $sources = json_decode($source_meta[0], true);
  $price = get_post_meta($post->ID, 'bc_price');
  $attachments = get_posts(array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID ));
?>

<div class="grid_6 alpha article">

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <h1 class="entry-title"><?php edit_post_link('Edit', '<span class="edit-link">[', ']</span>' ); ?><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h1>
      
      <div class="meta">
        <span class="date"><?php the_date('Y-m-d'); ?></span>
        <span class="author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></span>
        <div class="clear"></div>
        <div class="categories">
          <?php
            // Categories, only shown if any
            $catlist = get_the_term_list( $post->ID, 'bc_leaderboard', '<ul><li>', '</li><li>', '</li></ul>' );
            if( $catlist ):
              echo $catlist;
            endif;
          ?>
          <div class="clear"></div>
        </div>
      </div>
      
      <?php if(count($attachments) > 0): ?>
      <div class="image">
        <div class="large">
          <?php
            $image_attributes = wp_get_attachment_image_src( $attachments[0]->ID, array(450,450));
            echo("<img src=\"".$image_attributes[0]."\" width=\"".$image_attributes[1]."\" height=\"".$image_attributes[2]."\"/>");
          ?>
        </div>
        
        <ul>
          <?php
            foreach ( $attachments as $attachment ):
              $large = wp_get_attachment_image_src($attachment->ID, 'large');
              $image_attributes = wp_get_attachment_image_src($attachment->ID, array(90,90));
              echo("<li><a href='".$large[0]."'><img src=\"".$image_attributes[0]."\" width=\"".$image_attributes[1]."\" height=\"".$image_attributes[2]."\"/></a></li>");
            endforeach;
          ?>
        </ul>
        <div class="clear"></div>
      </div>
      <?php endif; ?>
      
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
    
  	<?php // comments_template(); // Comments disabled on Reviews ?>
    <?php // get_sidebar('single-bc_review'); ?>
    <div class="clear"></div>
</div>

<div class="grid_3 side omega">
  <div class="right">
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
    
    <?php echo wcfn_mylifescoop() ?>
    
    <div class="related-categories box">
      <h2>Read More</h2>
      <ul>
        <li>Back to <a href="/">Home</a></li>
        <?php
        // Categories, only shown if any
        $catlist = get_the_term_list( $post->ID, 'bc_leaderboard', '<li>Back to ', '</li><li>Back to ', '</li>' );
        if( $catlist ):
        ?>
          <?php echo $catlist; ?>
        <?php endif; ?>
      </ul>
    </div>
  </div>
  
</div>

<?php get_footer(); ?>
