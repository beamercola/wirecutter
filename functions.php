<?php

/*
 * TESTING MODE for ads
 * set to FALSE to start the ads
 * (commenting this out will still show fake ads)
 */
define('WC_TESTING', TRUE);

/*
 * Shorten excerpt length for homepage Flow sidebar 
 */
function wcfn_excerpt_length( $length ) {
    global $wc_excerpt_first;
    global $wc_excerpt_home;
    if( $wc_excerpt_first ) {
        $wc_excerpt_first = 0;
        return $length;
    } else if( $wc_excerpt_home ) {
        return 20;
    }
    return $length;
}
add_filter( 'excerpt_length', 'wcfn_excerpt_length' );


/*
 * Link-ify the_excerpt
 */
function wcfn_excerpt_ellipse( $text ) {
   return str_replace( '[...]', ' [<a href="'.get_permalink().'">...</a>]', $text );
}
add_filter( 'get_the_excerpt', 'wcfn_excerpt_ellipse' );


/*
 * Remember URL so we can use in #facebook
 */
function wcfn_remember_fburl() {
    global $fburl;
    global $post;
    if (is_home() || is_front_page() ) {
        $fburl = get_bloginfo('url');
    } else {
        $fburl = get_permalink($post->ID);
    }
}
add_action( 'wcfn_remember_fburl', 'wcfn_remember_fburl' );

/*
 * Enable tag/category pages for custom post types
 */
function wcfn_query_post_type($query) {
    if(is_category() || is_tag()) {
        $post_type = get_query_var('post_type');
        if($post_type) {
            $post_type = $post_type;
        } else {
            $post_type = array('post', 'bc_review'); //add bc_review type
        }
        $query->set('post_type', $post_type);
        return $query;
    }
}
add_filter('pre_get_posts', 'wcfn_query_post_type');

/*
 * Turn off stupid quotes
 */
function wcfn_stupidquotes($text = '') {
	$text = str_replace(array("&#8216;", "&#8217;", "&#8242;"), "&#039;", $text);
	$text = str_replace(array("&#8220;", "&#8221;", "&#8243;"), "&#034;", $text);
	return $text;
}
add_filter('category_description', 'wcfn_stupidquotes');
add_filter('list_cats', 'wcfn_stupidquotes');
add_filter('comment_author', 'wcfn_stupidquotes');
add_filter('comment_text', 'wcfn_stupidquotes');
add_filter('single_post_title', 'wcfn_stupidquotes');
add_filter('the_title', 'wcfn_stupidquotes');
add_filter('the_content', 'wcfn_stupidquotes');
add_filter('the_excerpt', 'wcfn_stupidquotes');
add_filter('bloginfo', 'wcfn_stupidquotes');
add_filter('widget_text', 'wcfn_stupidquotes');

/*
 * Ads
 */
function wcfn_openx_head() { // prepare single page call
    if( ! WC_TESTING ) {
        echo("<script type='text/javascript' src='http://ads2.theawl.com/openx/www/delivery/spcjs.php?id=6'></script>");
    }
}
add_action( 'wp_head', 'wcfn_openx_head' );

function wcfn_openx_zone($zoneid, $n, $id) {
    return "
    <div id=\"$id\"><div class=\"inner\">
    <script type='text/javascript'><!--// <![CDATA[
        OA_show($zoneid);
    // ]]> --></script><noscript><a target='_blank' href='http://ads2.theawl.com/openx/www/delivery/ck.php?n=$n'><img border='0' alt='' src='http://ads2.theawl.com/openx/www/delivery/avw.php?zoneid=$zoneid&amp;n=$n' /></a></noscript>
    </div></div>
    ";
}
function wcfn_openx($slot) {
    if( ! WC_TESTING ) {
        if($slot == '728' && is_home()) {
            echo wcfn_openx_zone(194,'603558a','ad728');
        } else if($slot == '728') {
            echo wcfn_openx_zone(199,'26aaf7f','ad728');
        } else if($slot == '300a' && is_home()) {
            echo wcfn_openx_zone(195,'6b8347b','ad300a');
        } else if($slot == '300a') {
            echo wcfn_openx_zone(197,'7aa17b0','ad300a');
        } else if($slot == '300b' && is_home()) {
            echo wcfn_openx_zone(196,'5166973','ad300b');
        } else if($slot == '300b') {
            echo wcfn_openx_zone(198,'307c937','ad300b');
        }
    } else {
        if($slot == '728') {
            echo('<div id="ad728"><div class="inner"><img src="'.get_template_directory_uri().'/tmp/top_ad.png"/></div></div>');
        } else if($slot == '300a') {
            echo('<div id="ad300a"><div class="inner"><img src="'.get_template_directory_uri().'/tmp/right_ad.png"/></div></div>');
        } else if($slot == '300b') {
            echo('<div id="ad300b"><div class="inner"><img src="'.get_template_directory_uri().'/tmp/right_ad.png"/></div></div>');
        }
    }
}
add_action( 'wcfn_openx', 'wcfn_openx' );

/*
 * My Life Scoop feed items
 */
function wcfn_mylifescoop() {
    return "
    <div class='box' id=\"mylifescoop\">
    
    <h3>Sponsored Links</h3>
    <h4>From My Life Scoop</h4>
    <ul>
    <li><a href=\"http://mylifescoop.com/featured-stories/2011/02/whats-the-difference-between-3g-and-4g.html\">What's the Difference Between 3G and 4G?</a></li>
    <li><a href=\"http://mylifescoop.com/featured-stories/2011/07/top-6-sites-to-find-cool-gadgets-and-gear.html\">Top 6 Sites to Find Cool Gadgets and Gear</a></li>
    <li><a href=\"http://mylifescoop.com/featured-stories/2010/06/25-cool-usb-drives.html\">25 Cool USB Drives</a></li>
    <li><a href=\"http://mylifescoop.com/featured-stories/2011/03/20-gadgets-for-the-diyer.html\">20 Gadgets for the DIYer</a></li>
    <li><a href=\"http://mylifescoop.com/featured-stories/2011/06/34-incredibly-awesome-business-cards.html\">34 Incredibly Awesome Business Cards</a></li>
    <li><a href=\"http://mylifescoop.com/top-10/2010/09/top-10-blogs-to-learn-something-new.html\">Top 10 Blogs To Learn Something New</a></li>
    <li><a href=\"http://mylifescoop.com/featured-stories/2011/03/four-crucial-mobile-photo-apps.html\">Four Crucial Mobile Photo Apps</a></li>
    <li><a href=\"http://mylifescoop.com/featured-stories/2011/08/the-top-6-exercise-gadgets.html\">The Top 6 Exercise Gadgets</a></li>
    <li><a href=\"http://mylifescoop.com/featured-stories/2011/06/5-tech-related-ways-to-reuse-an-altoids-tin.html\">5 Tech-Related Ways to Reuse an Altoids Tin</a></li>
    <li><a href=\"http://mylifescoop.com/featured-stories/2011/06/top-10-android-apps-for-music-lovers.html\">Top 10 Android Apps for Music Lovers</a></li>
    </ul>
    </div>
    ";
}


function wcfn_thumbnail_slideshow($post) {
    $args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID ); 
    $attachments = get_posts($args);
    if( $attachments ):
        $attachment0 = $attachments[0];
        $attributes0 = wp_get_attachment_image_src( $attachment0->ID, 'thumb');
    ?>
        <h3><?php echo wcfn_format_stars('Thumbnails') ?></h3>
        <img id="thumb0" src="<?php echo $attributes0[0]; ?>" width="<?php echo $attributes0[1]; ?>" height="<?php echo $attributes0[2]; ?>"/>
        <script type="text/javascript">
        var wc_slideshow = [];
        var wc_slideshow_current = 0;
    <?php
        foreach ( $attachments as $attachment ):
            $image_attributes = wp_get_attachment_image_src( $attachment->ID, 'medium');
            echo("wc_slideshow.push('<img src=\"".$image_attributes[0]."\" width=\"".$image_attributes[1]."\" height=\"".$image_attributes[2]."\"/>');\n");
        endforeach;
    ?>
        $('#thumb0').click(function() {
            var wc_slideshow_img0 = wc_slideshow[0];
            var box  = '<div>';
            box += '<div id="wc_slideshow_img">';
            box += wc_slideshow_img0;
            box += '</div>';
            box += '<div id="wc_slideshow_txt">';
            box += '<span id="wc_slideshow_count">1/'+wc_slideshow.length+'</span>';
            box += '<a id="wc_slideshow_prev" href="#">Prev</a>';
            box += '<a id="wc_slideshow_next" href="#">Next</a>';
            box += '</div>';
            box += '</div>';
            $.facebox(box);
            return false;
        });
        $('#wc_slideshow_next').live('click', function() {
            wc_slideshow_current++;
            if(wc_slideshow_current >= wc_slideshow.length) {
                wc_slideshow_current = 0;
            }
            $('#wc_slideshow_count').text((wc_slideshow_current+1)+'/'+wc_slideshow.length);
            $('#wc_slideshow_img').html(wc_slideshow[wc_slideshow_current]);
            return false;
        });
        $('#wc_slideshow_prev').live('click', function() {
            wc_slideshow_current--;
            if(wc_slideshow_current < 0) {
                wc_slideshow_current = wc_slideshow.length - 1;
            }
            $('#wc_slideshow_count').text((wc_slideshow_current+1)+'/'+wc_slideshow.length);
            $('#wc_slideshow_img').html(wc_slideshow[wc_slideshow_current]);
            return false;
        });
        </script>
<?php
    endif;
}

/*
 * Format **** like this **** for the sidebar
 */
function wcfn_format_stars($s='') {
    $stars = 33;
    return str_pad(" $s ", $stars, "*", STR_PAD_BOTH);
}


/*
 * Temporary - show "welcome" link on every page via header.php
 */
function wcfn_sticky_welcome() {
    $p = get_post($dummy=93);   // the welcome post ID
    $permalink = get_permalink($p->ID);
?>
    <div id="welcome"><p>
    <b>Welcome to the Wirecutter:</b> <a href="<?php echo($permalink); ?>">How to use this site</a>
    </p></div>
<?php
}
add_action( 'wcfn_welcome', 'wcfn_sticky_welcome' );








/*
 * Google Analytics in the Footer
 */
function wcfn_footer_google_analytics() {
?>
<!-- Google Analytics -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-8268915-4']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<?php
}
add_action('wp_footer', 'wcfn_footer_google_analytics');

/*
 * Chartbeat in the Header and the Footer
 */
function wcfn_head_chartbeat() {
?>
<script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>
<?php
}

function wcfn_footer_chartbeat() {
?>
<!-- Chartbeat -->
<script type="text/javascript">
var _sf_async_config={uid:4191,domain:"thewirecutter.com"};
(function(){
  function loadChartbeat() {
    window._sf_endpt=(new Date()).getTime();
    var e = document.createElement('script');
    e.setAttribute('language', 'javascript');
    e.setAttribute('type', 'text/javascript');
    e.setAttribute('src',
       (("https:" == document.location.protocol) ? "https://a248.e.akamai.net/chartbeat.download.akamai.com/102508/" : "http://static.chartbeat.com/") +
       "js/chartbeat.js");
    document.body.appendChild(e);
  }
  var oldonload = window.onload;
  window.onload = (typeof window.onload != 'function') ?
     loadChartbeat : function() { oldonload(); loadChartbeat(); };
})();
</script>
<?php
}
add_action('wp_head', 'wcfn_head_chartbeat');
add_action('wp_footer', 'wcfn_footer_chartbeat');



/*
 * Quantcast
 */
function wcfn_footer_quantcast() {
?>
<!-- Quantcast -->
<script type="text/javascript">
var _qevents = _qevents || [];
(function() {
var elem = document.createElement('script');
elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
elem.async = true;
elem.type = "text/javascript";
var scpt = document.getElementsByTagName('script')[0];
scpt.parentNode.insertBefore(elem, scpt);
})();
_qevents.push({
qacct:"p-32QdpOnYAOIhc"
});
</script>
<noscript>
<div style="display:none;">
<img src="//pixel.quantserve.com/pixel/p-32QdpOnYAOIhc.gif" border="0" height="1" width="1" alt="Quantcast"/>
</div>
</noscript>
<?php
}
add_action('wp_footer', 'wcfn_footer_quantcast');







/*
 * List of Authors and Link to Author Page
 */
function wcfn_wp_list_authors($args = '') {
    // a slightly hacked version of wp-includes/wp_list_authors to allow bc_review as a post_type
    global $wpdb;
    
    $post_types = array('post','bc_review');
    $post_types = join("','",$post_types);
    
	$defaults = array(
		'orderby' => 'name', 'order' => 'ASC', 'number' => '',
		'optioncount' => false, 'exclude_admin' => true,
		'show_fullname' => false, 'hide_empty' => true,
		'feed' => '', 'feed_image' => '', 'feed_type' => '', 'echo' => true,
		'style' => 'list', 'html' => true
	);

	$args = wp_parse_args( $args, $defaults );
	extract( $args, EXTR_SKIP );

	$return = '';

	$query_args = wp_array_slice_assoc( $args, array( 'orderby', 'order', 'number' ) );
	$query_args['fields'] = 'ids';
	//$authors = get_users( $query_args );
    $sql = "SELECT $wpdb->users.ID FROM {$wpdb->prefix}users LEFT OUTER JOIN ( SELECT post_author, COUNT(*) as post_count FROM $wpdb->posts WHERE post_type IN ('$post_types') AND (post_status = 'publish' OR post_status = 'private') GROUP BY post_author ) p ON ($wpdb->users.ID = p.post_author) WHERE 1=1 ORDER BY post_count DESC";
    $authors = $wpdb->get_col( $sql );
    $author_count = array();
	foreach ( (array) $wpdb->get_results("SELECT DISTINCT post_author, COUNT(ID) AS count FROM $wpdb->posts WHERE post_type IN ('$post_types') AND " . get_private_posts_cap_sql( 'post' ) . " GROUP BY post_author") as $row )
		$author_count[$row->post_author] = $row->count;

	foreach ( $authors as $author_id ) {
		$author = get_userdata( $author_id );

		if ( $exclude_admin && 'admin' == $author->display_name )
			continue;

		$posts = isset( $author_count[$author->ID] ) ? $author_count[$author->ID] : 0;

		if ( !$posts && $hide_empty )
			continue;

		$link = '';

		if ( $show_fullname && $author->first_name && $author->last_name )
			$name = "$author->first_name $author->last_name";
		else
			$name = $author->display_name;

		if ( !$html ) {
			$return .= $name . ', ';

			continue; // No need to go further to process HTML.
		}

		if ( 'list' == $style ) {
			$return .= '<li>';
		}

		$link = '<a href="' . get_author_posts_url( $author->ID, $author->user_nicename ) . '" title="' . esc_attr( sprintf(__("Posts by %s"), $author->display_name) ) . '">' . $name . '</a>';

		if ( !empty( $feed_image ) || !empty( $feed ) ) {
			$link .= ' ';
			if ( empty( $feed_image ) ) {
				$link .= '(';
			}

			$link .= '<a href="' . get_author_feed_link( $author->ID ) . '"';

			$alt = $title = '';
			if ( !empty( $feed ) ) {
				$title = ' title="' . esc_attr( $feed ) . '"';
				$alt = ' alt="' . esc_attr( $feed ) . '"';
				$name = $feed;
				$link .= $title;
			}

			$link .= '>';

			if ( !empty( $feed_image ) )
				$link .= '<img src="' . esc_url( $feed_image ) . '" style="border: none;"' . $alt . $title . ' />';
			else
				$link .= $name;

			$link .= '</a>';

			if ( empty( $feed_image ) )
				$link .= ')';
		}

		if ( $optioncount )
			$link .= ' ('. $posts . ')';

		$return .= $link;
		$return .= ( 'list' == $style ) ? '</li>' : ', ';
	}

	$return = rtrim($return, ', ');

	if ( !$echo )
		return $return;

	echo $return;
}




function twentyeleven_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyeleven' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'twentyeleven' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'twentyeleven' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyeleven' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'twentyeleven' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}




/*
 * Add a meta box for "Key Specs" to Reviews
 */

// add meta box to post type bc_review
function wcspecs_add_meta_boxes() {
    add_meta_box( 'wcspecs-meta', 'Key Specs', 'wcspecs_meta_function', 'bc_review', 'normal', 'high');
}
add_action( 'add_meta_boxes', 'wcspecs_add_meta_boxes' );

// fixup funny spacing on mce editor
function wcspecs_admin_print_styles() {
?>
    <style type="text/css">
    #wcspecs-meta { padding-bottom: 20px; }
    #wcspecs-meta .inside { padding: 0; margin: 0;}
    </style>
<?php
}
add_action( 'admin_print_styles-post.php', 'wcspecs_admin_print_styles' );
add_action( 'admin_print_styles-post-new.php', 'wcspecs_admin_print_styles' );

// add wcspecs_meta as a rich textarea
function wcspecs_meta_function( $post ) {
    $wcspecs_meta = get_post_meta( $post->ID, '_wcspecs', true);
    // attach the tiny mce editor to #wcspecs_meta
    // http://stackoverflow.com/questions/2855890/add-tinymce-to-wordpress-plugin
    if (function_exists('wp_tiny_mce')) {
        add_filter('teeny_mce_before_init', create_function('$a', '
            $a["theme"] = "advanced";
            $a["skin"] = "wp_theme";
            $a["height"] = "200";
            $a["width"] = "100%";
            $a["onpageload"] = "";
            $a["mode"] = "exact";
            $a["elements"] = "wcspecs_meta";
            $a["editor_selector"] = "mceEditor";
            $a["plugins"] = "safari,inlinepopups,spellchecker";
            $a["forced_root_block"] = false;
            $a["force_br_newlines"] = true;
            $a["force_p_newlines"] = false;
            $a["convert_newlines_to_brs"] = true;
            return $a;'));
        wp_tiny_mce(true);
    }
?> 
    <textarea id="wcspecs_meta" name="wcspecs_meta"><?php echo $wcspecs_meta ?></textarea>
<?php
}

// save _wcspecs as post meta
function wcspecs_save_post( $post_id ) {
    // verify meta is present
    if( ! isset( $_POST['wcspecs_meta'] ) ) {
        return;
    }
    // update
    $wcspecs_meta = $_POST['wcspecs_meta'];
    update_post_meta( $post_id, '_wcspecs', $wcspecs_meta );
}
add_action( 'save_post', 'wcspecs_save_post' );
