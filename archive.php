<?php get_header(); ?>
<div id="content">
<div id="container" class="clearfix">
    <div id="main">
        
        <h1 class="page-title">Archive</h1>

    <?php while ( have_posts() ): the_post(); ?>

        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h2 class="entry-title"><?php edit_post_link('Edit', '<span class="edit-link">[', ']</span>' ); ?><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h2>
            
            <div class="entry-content">
                <?php the_excerpt('[...]'); ?>
            </div><!-- .entry-content -->
        </div><!-- #post -->
    
    <?php endwhile; // end of the loop. ?>
    
        <div id="nav-below" class="navigation clearfix">
            <div class="nav-next"><?php next_posts_link( '<span class="meta-nav">&laquo;</span> Older posts' ) ?></div>
            <div class="nav-previous"><?php previous_posts_link( 'Newer posts <span class="meta-nav">&raquo;</span>' ) ?></div>
        </div>
			
    </div><!-- #main -->
    
    <?php get_sidebar(); ?>

</div><!-- #container -->
</div>
<?php get_sidebar('home'); ?>
<?php get_footer(); ?>
