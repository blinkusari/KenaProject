<?php
/**
 * Author info
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        https://www.zootemplate.com/
 * @copyright   Copyright (c) 2018 Zootemplate
 
 */
?>

<section class="author-info">
	<h2 class="author-heading"><?php esc_html_e( 'Published by', 'fona' ); ?></h2>
	<div class="author-avatar">
		<?php
		echo get_avatar( get_the_author_meta( 'user_email' ), '100' );
		?>
	</div>
	<div class="author-description">
		<h3 class="author-title"><?php echo get_the_author(); ?></h3>
		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
		</p>

	</div>
</section>
