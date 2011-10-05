<div id="sidebar">
    
    <?php do_action('wcfn_openx', '300a'); ?>

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

    <h3><?php echo wcfn_format_stars('Categories') ?></h3>
    <div class="sidebar-box">
    <ul>
    <?php wp_list_categories( $args ); ?>
    </ul>
    </div>
    
    
</div><!-- #sidebar -->
