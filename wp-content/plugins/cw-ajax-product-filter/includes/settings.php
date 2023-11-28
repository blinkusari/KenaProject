<?php
/**
 * HTML markup for Settings page.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}
?>
<div class="wrap">
	<h1><?php _e('Clever WooCommerce Ajax Product Filter', 'cwapf'); ?></h1>
	<form method="post" action="options.php">
		<?php
		settings_fields('cwapf_settings');
		do_settings_sections('cwapf_settings');

		// check if filter is applied
		$settings = apply_filters('cwapf_settings', get_option('cwapf_settings'));
		?>

		<?php if (has_filter('cwapf_settings')): ?>
			<p><span class="dashicons dashicons-info"></span> <?php _e('Filter has been applied and that may modify the settings below.', 'cwapf'); ?></p>
		<?php endif ?>

		<table class="form-table">
			<tr>
				<th scope="row"><?php _e('Shop loop container', 'cwapf'); ?></th>
				<td>
					<input type="text" name="cwapf_settings[shop_loop_container]" size="50" value="<?php echo isset($settings['shop_loop_container']) ? esc_attr($settings['shop_loop_container']) : '.products'; ?>" >
					<br />
					<span><?php _e('Selector for tag that is holding the shop loop. Most of cases you won\'t need to change this.', 'cwapf'); ?></span>
				</td>
			</tr>
            <tr>
				<th scope="row"><?php _e('Breadcrumb container', 'cwapf'); ?></th>
				<td>
					<input type="text" name="cwapf_settings[shop_breadcrumb_container]" size="50" value="<?php echo isset($settings['shop_breadcrumb_container']) ? esc_attr($settings['shop_breadcrumb_container']) : '.woocommerce-breadcrumb'; ?>" >
					<br />
					<span><?php _e('Selector for tag that is holding the breadcrumb. Most of cases you won\'t need to change this.', 'cwapf'); ?></span>
				</td>
			</tr>
            <tr>
				<th scope="row"><?php _e('Result count container', 'cwapf'); ?></th>
				<td>
					<input type="text" name="cwapf_settings[shop_result_count_container]" size="50" value="<?php echo isset($settings['shop_result_count_container']) ? esc_attr($settings['shop_result_count_container']) : '.woocommerce-result-count'; ?>" >
					<br />
					<span><?php _e('Selector for tag that is holding the result count. Most of cases you won\'t need to change this.', 'cwapf'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('No products container', 'cwapf'); ?></th>
				<td>
					<input type="text" name="cwapf_settings[not_found_container]" size="50" value="<?php echo isset($settings['not_found_container']) ? esc_attr($settings['not_found_container']) : '.products'; ?>" >
					<br />
					<span><?php _e('Selector for tag that is holding no products found message. Most of cases you won\'t need to change this.', 'cwapf'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Pagination container', 'cwapf'); ?></th>
				<td>
					<input type="text" name="cwapf_settings[pagination_container]" size="50" value="<?php echo isset($settings['pagination_container']) ? esc_attr($settings['pagination_container']) : '.woocommerce-pagination'; ?>" >
					<br />
					<span><?php _e('Selector for tag that is holding the pagination. Most of cases you won\'t need to change this.', 'cwapf'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Overlay background color', 'cwapf'); ?></th>
				<td>
					<input type="text" name="cwapf_settings[overlay_bg_color]" size="50" value="<?php echo isset($settings['overlay_bg_color']) ? esc_attr($settings['overlay_bg_color']) : '#fff'; ?>">
					<br />
					<span><?php _e('Change this color according to your theme, eg: #fff', 'cwapf'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Product sorting', 'cwapf'); ?></th>
				<td>
					<input type="checkbox" name="cwapf_settings[sorting_control]" value="1" <?php (!empty($settings['sorting_control'])) ? checked(1, $settings['sorting_control'], true) : 1; ?>>
					<span><?php _e('Check if you want to sort your products via ajax.', 'cwapf'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Scroll to top', 'cwapf'); ?></th>
				<td>
					<input type="checkbox" name="cwapf_settings[scroll_to_top]" value="1" <?php (!empty($settings['scroll_to_top'])) ? checked(1, $settings['scroll_to_top'], true) : 1; ?>>
					<span><?php _e('Check if to enable scroll to top after updating shop loop.', 'cwapf'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Scroll to top offset', 'cwapf'); ?></th>
				<td>
					<input type="text" name="cwapf_settings[scroll_to_top_offset]" size="50" value="<?php echo isset($settings['scroll_to_top_offset']) ? esc_attr($settings['scroll_to_top_offset']) : 150; ?>">
					<br />
					<span><?php _e('You need to change this value to match with your theme, eg: 150', 'cwapf'); ?></span>
				</td>
			</tr>
			<tr style="display: none;">
				<th scope="row"><?php _e('Custom JavaScript after update', 'cwapf'); ?></th>
				<td>
					<textarea name="cwapf_settings[custom_scripts]" rows="5" cols="70"><?php echo ''; ?></textarea>
					<br />
					<span><?php _e('If you want to add custom scripts that would be loaded after updating shop loop, eg: alert("hello");', 'cwapf'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Disable Transients', 'cwapf'); ?></th>
				<td>
					<input type="checkbox" name="cwapf_settings[disable_transients]" value="1" <?php (!empty($settings['disable_transients'])) ? checked(1, $settings['disable_transients'], true) : ''; ?>>
					<span><?php _e('To disable transients check this checkbox.', 'cwapf'); ?></span>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e('Clear Transients', 'cwapf'); ?></th>
				<td>
					<input type="checkbox" name="cwapf_settings[clear_transients]" value="1">
					<span><?php _e('To clean transients check this checkbox and then press \'Save Changes\' button.', 'cwapf'); ?></span>
				</td>
			</tr>
		</table>
		<?php submit_button() ?>
	</form>
</div>
