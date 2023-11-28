<?php namespace CleverSoft\WpPlugin\Cmm4EPro;

use WP_Post;

/**
 * ImportExport
 *
 * @package    CMM4E
 */
final class ImportExport
{
    const SLUG = 'cmm4e-import-export-page';

    /**
     * Hook suffix
     *
     * @var    string
     *
     * @see    https://developer.wordpress.org/reference/functions/add_submenu_page/
     */
    public $hook_suffix;

    /**
     * Nope Constructor
     */
    private function __construct()
    {

    }

    /**
     * Singleton
     */
    static function init()
    {
        static $self = null;

        if (null === $self) {
            $self = new self;
            add_action('admin_menu', [$self, '_add']);
            add_action('admin_init', [$self, '_import'], 0, 0);
            add_action('admin_init', [$self, '_export'], 0, 0);
            add_action('admin_notices', [$self, '_notify'], 0, 0);
        }
    }

    /**
     * Add page
     *
     * @internal Used as a callback.
     *
     * @see    https://developer.wordpress.org/reference/hooks/admin_menu/
     */
    function _add($context)
    {
        $this->hook_suffix = add_submenu_page(
            'cmm4e-dashboard-page',
	        esc_html__('Import/Export', 'clever-mega-menu-pro-for-elementor'),
	        esc_html__('Import/Export', 'clever-mega-menu-pro-for-elementor'),
            'manage_options',
            self::SLUG,
            [$this, '_render']
        );
    }

    /**
     * Render
     *
     * @internal Used as a callback.
     */
    function _render()
    {
        ?><div class="wrap clever-mega-menu-admin">
            <h2><?php esc_html_e('Import/Export Menu Skins', 'clever-mega-menu-pro-for-elementor') ?></h2>
            <table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><?php esc_html_e('Import Menu Skin', 'clever-mega-menu-pro-for-elementor') ?></th>
						<td>
							<p><?php esc_html_e('Choose an import file from your computer then click on the "Import" button.', 'clever-mega-menu-pro-for-elementor') ?></p>
							<form enctype="multipart/form-data" method="post" action="<?php echo menu_page_url(self::SLUG, 0) ?>">
                                <?php wp_nonce_field('clever-mega-menu-import-data', 'clever-mega-menu-import-nonc3') ?>
								<label for="clever-mega-menu-import-data" class="screen-reader-text">
                                    <?php esc_html_e('Upload File', 'clever-mega-menu-pro-for-elementor') ?>:
                                </label>
								<p><input type="file" id="clever-mega-menu-import-data" name="clever-mega-menu-import-data"></p>
								<?php submit_button(esc_html__('Import', 'clever-mega-menu-pro-for-elementor'), 'primary', 'upload') ?>
							</form>

						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e('Export Menu Skin', 'clever-mega-menu-pro-for-elementor') ?></th>
						<td>
							<p><?php esc_html_e('Once you have saved the export file, you can use the import function to import the menu skin on any sites using the plugin.', 'clever-mega-menu-pro-for-elementor') ?></p>
							<form class="clever-mega-menu-export-form" method="post" action="<?php echo menu_page_url(self::SLUG, 0) ?>">
                                <?php
                                    wp_nonce_field('clever-mega-menu-export-data', 'clever-mega-menu-export-nonc3');
                                    $menu_themes = get_posts([
                                        'post_type'              => 'cmm4e_menu_theme',
                                        'post_status'            => 'publish',
                                        'suppress_filters'       => true,
                                        'no_found_rows'          => true,
                                        'cache_results'          => false,
                                        'update_post_term_cache' => false,
                                        'update_post_meta_cache' => false
                                    ]);
                                if ($menu_themes) :
                                    ?><div class="option-field"><label><select name="clever-mega-menu-exporting-menu-theme">
                                        <option value="">-- <?php esc_html_e('Select a menu skin', 'clever-mega-menu-pro-for-elementor') ?> --</option>
                                        <option value="all"><?php esc_html_e('All menu skins', 'clever-mega-menu-pro-for-elementor') ?></option><?php
                                        foreach ($menu_themes as $menu_theme) :
                                            ?><option value="<?php echo esc_attr($menu_theme->post_name) ?>"><?php echo esc_html($menu_theme->post_title) ?></option><?php
                                        endforeach;
                                    ?></select></label></div><?php
                                else :
                                    ?><p><?php esc_html_e('No menu skin found.', 'clever-mega-menu-pro-for-elementor') ?></p><?php
                                endif;
                                submit_button(esc_html__('Export', 'clever-mega-menu-pro-for-elementor'), 'primary', 'clever-mega-menu-export-btn');
								?>
							</form>
						</td>
					</tr>
				</tbody>
			</table>
        </div><?php
    }

    /**
     * Import
     *
     * @internal Used as a callback.
     */
    function _import()
    {
        if (
            !$this->validate_current_page() ||
			!isset($_POST['clever-mega-menu-import-nonc3']) ||
            empty($_FILES['clever-mega-menu-import-data']['tmp_name'])
        ) {
            return;
        }

        if (!wp_verify_nonce($_POST['clever-mega-menu-import-nonc3'], 'clever-mega-menu-import-data')) {
            return;
        }

        $imported = null;
		$upload_data = file_get_contents($_FILES['clever-mega-menu-import-data']['tmp_name']);
		$import_data = json_decode($upload_data, true);

        if ($import_data) {
            foreach ($import_data as $key => $value) {
                $menu_theme = get_page_by_path($key, OBJECT, 'cmm4e_menu_theme');
                if ($menu_theme && $menu_theme->post_title === $value['name']) {
                    continue;
                }
                $inserted = wp_insert_post([
                    'post_type'      => 'cmm4e_menu_theme',
                    'post_status'    => 'publish',
                    'post_title'     => $value['name'],
                    'post_name'      => $key,
                    'comment_status' => 'closed',
                    'ping_status'    => 'closed',
                    'meta_input'     => $value['value']
                ], true);
                if (is_wp_error($inserted)) {
                    $imported = false;
                    break;
                } else {
                    $theme_post = get_post($inserted);
                    $theme_meta = new MenuThemeMeta();
                    $theme_meta->generate_css($value['value'], $theme_post);
                }
            }
        }

        $page_url = html_entity_decode(menu_page_url(self::SLUG, 0));

		if ($_FILES['clever-mega-menu-import-data']['error'] || false === $imported) {
            wp_redirect($page_url . '&imported=false');
            exit;
		}

		wp_redirect($page_url. '&imported=true');

		exit;
    }

    /**
     * Export
     *
     * @internal Used as a callback.
     */
    function _export()
    {
        if (
            !$this->validate_current_page() ||
            !isset($_POST['clever-mega-menu-export-nonc3']) ||
            empty($_POST['clever-mega-menu-exporting-menu-theme'])
        ) {
            return;
        }

        if (!wp_verify_nonce($_POST['clever-mega-menu-export-nonc3'], 'clever-mega-menu-export-data')) {
            return;
        }

        $export_data = array();
        $meta_key    = MenuThemeMeta::META_KEY;
        $_menu_theme = sanitize_title($_POST['clever-mega-menu-exporting-menu-theme']);

        if ('all' === $_menu_theme) {
            $menu_themes = get_posts([
                'post_type'              => 'cmm4e_menu_theme',
                'post_status'            => 'publish',
                'suppress_filters'       => true,
                'no_found_rows'          => true,
                'cache_results'          => false,
                'update_post_term_cache' => false,
                'update_post_meta_cache' => false
            ]);
            if ($menu_themes) {
                foreach ($menu_themes as $menu_theme) {
                    $export_data[$menu_theme->post_name]['name'] = $menu_theme->post_title;
                    $export_data[$menu_theme->post_name]['value'] = get_post_meta($menu_theme->ID, $meta_key, true);
                }
            }
        } else {
            $menu_theme = get_page_by_path($_menu_theme, OBJECT, 'cmm4e_menu_theme');
            $export_data[$_menu_theme]['name'] = $menu_theme->post_title;
            $export_data[$_menu_theme]['value'] = get_post_meta($menu_theme->ID, $meta_key, true);
        }

        $export_json = json_encode($export_data);

	    header('Content-Description: File Transfer');
	    header('Cache-Control: public, must-revalidate');
	    header('Pragma: hack');
	    header('Content-Type: application/json; charset='.get_option('blog_charset'));
	    header('Content-Disposition: attachment; filename="cmm4e-menu-themes-'.date('Ymd-His').'.json"');
	    header('Content-Length: '.mb_strlen($export_json));

	    exit($export_json);
	}

    /**
     * Do notification
     *
     * @see    https://developer.wordpress.org/reference/hooks/admin_notices/
     */
    function _notify()
    {
        if ( !$this->validate_current_page() ) {
			return;
        }

        if ( isset( $_GET['imported'] ) && 'true' === $_GET['imported'] ) :
            ?><div class="notice notice-success is-dismissible">
                <p><strong>
                    <?php esc_html_e('Data have been imported successfully!', 'clever-mega-menu-pro-for-elementor') ?>
                </strong></p>
                <button type="button" class="notice-dismiss">
                    <span class="screen-reader-text">
                        <?php esc_html_e('Dismiss this notice.') ?>
                    </span>
                </button>
            </div><?php
        endif;
        if ( isset( $_GET['imported'] ) && 'false' === $_GET['imported'] ) :
            ?><div class="notice notice-error is-dismissible">
                <p><strong>
                    <?php esc_html_e('Failed to import data. Please try again!', 'clever-mega-menu-pro-for-elementor') ?>
                </strong></p>
                <button type="button" class="notice-dismiss">
                    <span class="screen-reader-text">
                        <?php esc_html_e('Dismiss this notice.') ?>
                    </span>
                </button>
            </div><?php
        endif;
    }

    /**
     * Validate current page
     */
    private function validate_current_page()
    {
    	global $page_hook;

    	if (isset($page_hook) && $page_hook === $this->hook_suffix) {
    		return true;
        }

    	if (isset($_GET['page']) && $_GET['page'] === self::SLUG) {
    		return true;
        }

    	return false;
    }
}
ImportExport::init();
