<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        https://www.zootemplate.com/
 * @copyright   Copyright (c) 2018 Zootemplate
 
 */

get_header();
?>
    <main id="site-main-content" class="main-content">
        <?php while (have_posts()) : the_post();
            ?>
            <div class="container">
                <?php
                get_template_part('content', 'page');
                ?>
            </div>
            <?php
            if (comments_open() || get_comments_number()) :
                comments_template('', true);
            endif;
        endwhile; ?>
    </main>
<?php
get_footer();
