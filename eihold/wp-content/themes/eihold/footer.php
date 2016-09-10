
  </div><!-- /#wrap -->

  <?php roots_footer_before(); ?>
  <footer id="content-info" class="<?php echo WRAP_CLASSES; ?>" role="contentinfo">
    <?php roots_footer_inside(); ?>
    <?php dynamic_sidebar('sidebar-footer'); ?>
	<div class="row footercopy">
                                <div class="span3">
                                    <div class="pbi">Powered By<img width="60" align="absmiddle" src="/images/logo_iprof.png"></div>
                                </div>
                                <div class="span3">
                                    <a href="mailto:info@thedigilibrary.com"><img align="absmiddle" src="/images/info.png"> info@thedigilibrary.com</a>
                                </div>
                                <div class="span3">
                                    <img width="18" align="absmiddle" src="/images/phone.png"> 1800-200-2001
                                </div>
                                <div class="span3">
                                    <span class="flold">Follow Us : </span>
                                    <div class="social_top">
                                       <a class="social_one" target="_new" href="http://www.youtube.com/user/thedigilibrary" alt="youtube" title="youtube"></a>
                                       <a class="social_two" target="_new" href="https://www.facebook.com/TheDigiLibrary.India" alt="facebook" title="facebook"></a>
                                       <a class="social_three" target="_new" href="https://twitter.com/TheDigiLibrary" title="twitter" alt="twitter"></a>
                                       <a class="social_four" target="_new" href="https://plus.google.com/110262914637768978046/about" title="google plus" alt="google plus"></a>
                                     </div>
                                </div>
                            </div>
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
  </footer>
  <?php roots_footer_after(); ?>

  <?php wp_footer(); ?>
  <?php roots_footer(); ?>

</body>
</html>