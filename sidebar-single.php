<div id="sidebar">
   
<?//php do_action('wcfn_openx', '300a'); ?>

<?php 
  global $post;
  wcfn_thumbnail_slideshow($post); 
?>

<?php
    // Tags, only shown if any
    $taglist = get_the_tag_list( '<ul><li>', '</li><li>', '</li></ul>' );
    if( $taglist ):
    ?>
    <h3><?php echo wcfn_format_stars('Tags') ?></h3>
    <div class="sidebar-box"><?php echo $taglist; ?></div>
    <?php endif; ?>

<?php
  $catlist = get_the_term_list( $post->ID, 'bc_leaderboard', '<ul><li>', '</li><li>', '</li></ul>' );
  if( $catlist ):
?>
  <h3><?php echo wcfn_format_stars('Categories') ?></h3>
  <div class="sidebar-box"><?php echo $catlist; ?></div>
<?php endif; ?>

<?php echo wcfn_mylifescoop() ?>

</div>
