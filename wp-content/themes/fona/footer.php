<?php
/**
 * Default site footer
 *
 * @package  Zoo_Theme\Templates
 * @author   zootemplate
 * @link     https://www.zootemplate.com/
 *
 */
do_action('zoo_render_site_footer');
if (zoo_site_layout() == 'boxed') { ?>
    </div>
    <?php
}
?>
<div class="zoo-mask-close"></div>
<?php
if(get_theme_mod('zoo_enable_back_top_top','1')){
    ?>
    <a id="zoo-back-to-top" href="#site-header" title="<?php echo esc_attr__('Back to Top','fona')?>"><i class="cs-font clever-icon-up"></i></a>
<?php
}
wp_footer();
?>
</body>
</html>
