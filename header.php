<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://feeds.feedburner.com/TheWirecutter" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/modernizr-2.0.6.min.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/js/facebox/facebox.css" />
<link href='http://fonts.googleapis.com/css?family=Cantarell' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>
<?php do_action('wcfn_remember_fburl'); ?>
</head>

<body <?php body_class(); ?>>
  <div id="container">
    <header>
      <div class="wrapper">
        <div class="ad">
          <?php do_action('wcfn_openx', '728'); ?>
        </div>
        
        <div class="content">
          <a href="/"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="The Wirecutter" id="logo" /></a>
          <dl class="slogan">
            <dt>A List of Only<br />Great Technology</dt>
            <dd><a href="/2011/10/how-to-use-the-wirecutter/">How To Use This Site &raquo;</a></dd>
          </dl>
          
          <div class="search">
            <form method="GET" action="/">
              <input id="search-box" type="text" name="s" value="" />
              <input id="search-button" type="submit" value="Search"/>
              <div class="clear"></div>
            </form>
          </div>
          
          <a href="http://ad.doubleclick.net/clk;246498667;71659097;j;pc=[TPAS_ID]" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/intel.png" class="sponsor" /></a>
          <IMG SRC="http://ad.doubleclick.net/ad/N5364.federatedmedia.com/B5812614.15;sz=1x1;pc=[TPAS_ID];ord=[timestamp]?" BORDER=0 WIDTH=1 HEIGHT=1 ALT="">
        </div>
        
        <div id="social">
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
          <div class="snipsnip">#snipsnip</div>
        </div>
        
      </div>
      <?php do_action('wcfn_welcomex'); ?>
      
    </header>
    <div id="main" role="main">
      <div class="wrapper">
        <div id="content">

