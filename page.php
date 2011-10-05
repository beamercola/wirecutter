<?php get_header(); ?>

<div id="container" class="clearfix">
    <div id="main">

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h2 class="entry-title"><?php edit_post_link('Edit', '<span class="edit-link">[', ']</span>' ); ?><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h2>
            
        <div class="entry-content">
            <?php the_content(); ?>
        </div><!-- .entry-content -->
    </div><!-- #post -->
    
    <?php endwhile; // end of the loop. ?>
			
    </div><!-- #main -->
    
    <?php get_sidebar('single'); ?>

</div><!-- #container -->
<?php get_footer(); ?>
