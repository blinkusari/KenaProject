<?php namespace CleverSoft\WpPlugin\Cmm4EPro;

use WP_Post;

/**
 * MenuLocationMeta
 */
final class MenuLocationMeta
{
    /**
     * Meta key
     *
     * @var    string
     */
    const META_KEY = 'cmm4e_menu_location_meta';

    /**
     * Meta fields
     *
     * @var    array
     */
    public static $fields = array(
        'php'       => '',
        'shortcode' => ''
    );

    /**
     * Meta values
     *
     * @var    array
     */
    private $values;

    /**
     * Constructor
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
            add_action('add_meta_boxes_cmm4e_menu_location', [$self, '_add']);
        }
    }

    /**
     * Add theme meta boxes
     *
     * @internal    Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
     */
    function _add(WP_Post $post)
    {
        add_meta_box(
            'cmm4e-menu-location-metabox',
	        esc_html__('Display options', 'clever-mega-menu-pro-for-elementor'),
            array($this, '_render'),
            'cmm4e_menu_location',
            'normal',
            'high'
        );
    }

    /**
     * Render meta box
     *
     * @internal    Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
     */
    function _render()
    {
        $php = '';
        $shortcode = '';

        if (!empty($_GET['post'])) {
            $post = get_post(intval($_GET['post']));
            if (!empty($post->post_name)) {
                $php = sprintf("<?php wp_nav_menu( array( 'theme_location' => '%s' ) ); ?>", $post->post_name);
                $shortcode = sprintf('[cmm4e loc="%s"]', $post->post_name);
            }
        }
        ?><table class="form-table clever-mega-menu-admin">
            <tr>
                <td class="row-label"><?php esc_html_e('Shortcode', 'clever-mega-menu-pro-for-elementor') ?></td>
                <td>
                    <?php if ($shortcode) : ?>
                        <pre><code><?php echo htmlentities($shortcode) ?></code></pre>
                        <p class="description"><?php esc_html_e('Insert the shortcode into any page or post where you want to display navigation menus using the current menu location.', 'clever-mega-menu-pro-for-elementor') ?></p>
                    <?php else : ?>
                        <code>NULL</code>
                    <?php endif ?>
                </td>
            </tr>
            <tr class="last-row">
                <td class="row-label"><?php esc_html_e('PHP Code', 'clever-mega-menu-pro-for-elementor') ?></td>
                <td>
                    <?php if ($php) : ?>
                        <pre><code><?php echo htmlentities($php) ?></code></pre>
                        <p class="description"><?php esc_html_e('Insert the PHP code into any theme template where you want to display navigation menus using the current menu location.', 'clever-mega-menu-pro-for-elementor') ?></p>
                    <?php else : ?>
                        <code>NULL</code>
                    <?php endif ?>
                </td>
            </tr>
        </table><?php
    }
}
MenuLocationMeta::init();
