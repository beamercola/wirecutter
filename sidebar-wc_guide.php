<?php
  // find the $slug for the bc_category this Guide belongs to
  global $post;
  $term = NULL;
  $slug = NULL;
  $terms = wp_get_object_terms( $post->ID, 'bc_leaderboard' );
  if( is_array($terms) && count($terms) > 0 ) {
    $term = $terms[0];
    $slug = $term->slug;
  }
?>
<div id="side">
  <div class="side-wrapper">
    <div class="recent">

      <ul class="blog">
      <?php
      // list all Guides having this leaderboard category
      $guides_query = new WP_Query(array('post_type' => 'wc_guide', 'bc_leaderboard' => $slug ));
      if( $guides_query->have_posts() ):
        while ( $guides_query->have_posts() ): $guides_query->the_post();
      ?>
        <li>
          <dl>
            <dt><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></dt>
            <dd>
              <a href="<?php echo the_permalink();?>"><?php do_action('wcthumb300') ?></a>
              <?php the_excerpt() ?>
            </dd>
          </dl>
        </li>
        <?php endwhile; ?>
      <?php endif; ?>
      </ul>
      
      <hr />

      <ul class="blog">
      <?php
      // list all Reviews having this leaderboard category
      $reviews_query = new WP_Query(array('post_type' => 'bc_review', 'bc_leaderboard' => $slug ));
      if( $reviews_query->have_posts() ):
        while ( $reviews_query->have_posts() ): $reviews_query->the_post();
      ?>
        <li>
          <dl>
            <dt><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></dt>
            <dd>
              <a href="<?php echo the_permalink();?>"><?php do_action('wcthumb300') ?></a>
              <?php the_excerpt() ?>
            </dd>
          </dl>
        </li>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No Reviews</p>
      <?php endif; ?>
      </ul>



    </div>
  </div>
</div>

