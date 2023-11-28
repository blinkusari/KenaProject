<?php
/**
 * The template for displaying all single posts.
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        https://www.zootemplate.com/
 * @copyright   Copyright (c) 2018 Zootemplate
 
 */

get_header();
$main_class = 'wrap-main-content content-single';?>
    <main id="site-main-content" class="main-content content-single-post">
        <div class="<?php echo esc_attr($main_class) ?>">
            <?php if (have_posts()) :
                while (have_posts()) : the_post();
                    get_template_part('content', 'single');
                endwhile;
            endif; ?>
        </div>
    </main>
<?php
get_footer();
