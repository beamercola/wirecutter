<?php add_filter('the_permalink', 'ichaltpermalink_permalink'); ?>
<div id="side">
  <div class="side-wrapper">
    <center><a href="/tech-as-magic/"><img src="<?php echo get_template_directory_uri(); ?>/img/tech_as_magic.png" alt="Tech As Magic" title="Tech As Magic" /></a></center>
    
    <div class="recent">
      <ul class="blog">
        <?php
        $args = array(
          'offset' => 0,
          'showposts' => 7,
          'post_type' => 'post',
          'post_status' => 'publish',
          'orderby' => 'date',
        );

        $wp_query_bottom = null;
        $wp_query_bottom = new WP_Query();
        $wp_query_bottom->query($args);
        $i = 0;
        while ($wp_query_bottom->have_posts()) : 
          $wp_query_bottom->the_post(); 
          $i++;
        ?>
        <li>
          <dl>
            <?php do_action('wcsponsored_post_sidebar') ?> 
            <dt><a href="<?php echo the_permalink();?>"><?php echo substr($post->post_title, 0); ?></a></dt>
            <dd>
              <a href="<?php echo the_permalink();?>"><?php do_action('wcthumb300') ?></a>
              <?php echo get_the_excerpt(); ?>
            </dd>
          </dl>
        </li>
        <?php if($i == 1) { echo "<li>" . do_action('wcfn_openx', '300b') . "</li>"; }?>
        <?php endwhile; ?>
      </ul>
      <a href="/tech-as-magic/" class="more">More Tech As Magic &raquo;</a>
    </div>
    
    <div class="box search">
      <form method="GET" action="/">
        <input id="search-box" type="text" name="s" value="" />
        <input id="search-button" type="submit" value="Search"/>
        <div class="clear"></div>
      </form>
    </div>
    
    <?php echo wcfn_mylifescoop() ?>
  </div>
  <div class="clear"></div>
</div><!-- #sidebar -->
<?php remove_filter('the_permalink', 'ichaltpermalink_permalink'); ?>
