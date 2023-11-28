<?php
/**
 * The template for displaying search results pages.
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        https://www.zootemplate.com/
 * @copyright   Copyright (c) 2018 Zootemplate
 
 */

$zoo_block_layout = get_theme_mod('zoo_blog_layout', 'list');
$main_class = 'main-content archive-content';
$loop_class = 'wrap-loop-content col-12';
$zoo_sidebar = get_theme_mod('zoo_blog_sidebar_config', 'right');
if(is_active_sidebar(get_theme_mod('zoo_blog_sidebar','sidebar'))) {
    if ($zoo_sidebar == 'left') {
        $loop_class .= ' col-md-9';
        $main_class .= ' has-left-sidebar';
    } else if ($zoo_sidebar == 'right') {
        $loop_class .= ' col-md-9';
        $main_class .= ' has-right-sidebar';
    }
}
$loop_class .= ' '.$zoo_block_layout . '-layout';

get_header();
?>
    <main id="site-main-content" class="<?php echo esc_attr($main_class)?>">
        <div class="container">
            <div class="row">
                <?php
                if ($zoo_sidebar == 'left') {
                    get_sidebar();
                }
                ?>
                <div class="<?php echo esc_attr($loop_class) ?>">
                        <div class="row">
                            <?php if (have_posts()) : ?>
                                <h1 class="page-title the-title"><?php printf(esc_html__('Search Results for: %s', 'fona'), get_search_query()); ?></h1>
                                <?php
                                while (have_posts()) : the_post();
                                    get_template_part('inc/templates/posts/loop/' . $zoo_block_layout, 'layout');
                                endwhile;
                            else :
                                get_template_part('content', 'none');
                            endif; ?>
                        </div>
                        <?php get_template_part('inc/templates/posts/post', 'pagination'); ?>
                </div>
                <?php
                if ($zoo_sidebar == 'right') {
                    get_sidebar();
                }
                ?>
            </div>
        </div>
    </main>
<?php
get_footer();
