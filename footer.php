      <div class="clear"></div>
    </div> <!-- content -->
    <?php get_sidebar('home'); ?>
    <div class="clear"></div>
  </div> <!-- wrapper -->
  <div class="clear"></div>
</div> <!-- main -->
<div class="clear"></div>

<footer>
  <div class="wrapper">
    <div class="grid_5">
    <p class="about">The Wirecutter is an up-to-date list of the best gadgets.</p>
    <p class="by">By <a href="/author/blam8/">Brian Lam</a> and <a href="/authors">Friends</a></p>
    </div>
    <div class="grid_5">
      <p class="contact">
        <a href="mailto:notes@thewirecutter.com">Contact</a>
        <a href="/about">About</a>
        <a href="/legal">Legal</a>
        <a href="mailto:advertise@thewirecutter.com">Advertising</a>
      </p>
      <p class="awl">
        Part of the Awl Family:<br />
        <a href="http://www.theawl.com">The Awl</a>,
        <a href="http://splitsider.com">Splitsider</a> and 
        <a href="http://thehairpin.com">The Hairpin</a>
      </p>
    </div>
    <div class="clear"></div>
  </div>
</footer>

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


</div><!-- #wrap -->

<script> // Change UA-XXXXX-X to be your site's ID
  window._gaq = [['_setAccount','UA-8268915-4'],['_trackPageview'],['_trackPageLoadTime']];
  Modernizr.load({
    load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
  });
</script>

<!--[if lt IE 7 ]>
  <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]-->


<?php wp_footer(); ?>

</body>
</html>
