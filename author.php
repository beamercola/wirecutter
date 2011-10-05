<?php get_header(); ?>

<div id="container" class="clearfix">
    <div id="main">
        
        <?php 
            $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
        ?>

        <h1 class="page-title">Posts by: <?php echo $curauth->nickname; ?></h1>

    
    
    
    
    <?php 
    $args = array(
        'showposts' => -1,
        'author' => $curauth->ID,
        'post_type' => array('post','bc_review'),
        'post_status' => 'publish',
        'orderby' => 'date',
    );
    
    $temp = $wp_query;
    $wp_query = null;
    $wp_query = new WP_Query();
    $wp_query->query($args);
       
    //exit(print_r($wpdb));
    ?>
	
    <?php while ( $wp_query->have_posts() ): $wp_query->the_post(); ?>

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
        
    <?php $wp_query = null; $wp_query = $temp; ?>
    
    </div><!-- #main -->
    
    <?php get_sidebar('author'); ?>

</div><!-- #container -->
<?php get_footer(); ?>
