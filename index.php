<?php
/*
  Plugin Name: Z-URL Preview
  Plugin URI: http://www.z-add.co.uk/
  Description: A plugin to embed a preview of a link, similar to facebook
  Version: 1.4
  Author: Stuart Millington
  Author URI: http://www.z-add.co.uk
  License: GPL
 */

add_action( 'wp_enqueue_scripts', 'zurlpreview_styles_method' );

function zurlpreview_styles_method() {
	wp_enqueue_style(
		'zurlcustom-style',
		plugins_url() . '/z-link-preview/zurlplugin.css'
	);
	wp_add_inline_style( 'zurlcustom-style', get_option('zurlpreview_css') );
}

add_action( 'admin_head', 'at_zurlpreview_add_tinymce' );

function at_zurlpreview_add_tinymce() {
    global $typenow;

    // only on Post Type: post and page
    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return ;

    add_filter( 'mce_external_plugins', 'at_zurlpreview_add_tinymce_plugin' );
    // Add to line 1 form WP TinyMCE
    add_filter( 'mce_buttons', 'at_zurlpreview_add_tinymce_button' );
}
// inlcude the js for tinymce
function at_zurlpreview_add_tinymce_plugin( $plugin_array ) {

    $plugin_array['at_zurlpreview'] = plugins_url( '/zurlplugin.js', __FILE__ );
    return $plugin_array;
}

// Add the button key for address via JS
function at_zurlpreview_add_tinymce_button( $buttons ) {

    array_push( $buttons, 'at_zurlpreview_button_key' );
    return $buttons;
}

/* Runs on plugin activation */
register_activation_hook(__FILE__, 'zurlpreview_install');

/* Runs on plugin deactivation */
register_deactivation_hook(__FILE__, 'zurlpreview_remove');

function zurlpreview_install() {
    /* Creates new database field */
    add_option("zurlpreview_css", get_zurlpreview_css(), '', 'yes');
}

function zurlpreview_remove() {
    /* Deletes the database field */
    delete_option('zurlpreview_css');
}

function get_zurlpreview_css() {
    return '#at_zurlpreview img {
				width: 100%;
				max-width:100%;
 			}';
}

if (is_admin()) {

    /* Call the html code */
    add_action('admin_menu', 'zurlpreview_admin_menu');

    function zurlpreview_admin_menu() {
        add_options_page('Z-URL Preview', 'Z-URL Preview', 'administrator', 'hello-world', 'z_url_preview_option_page');
    }
}

add_filter('tiny_mce_before_init', 'zurl_tiny_mce_before_init');

function zurl_tiny_mce_before_init($initArray) {
    $initArray['setup'] = <<<JS
[function(ed) {
    ed.onKeyDown.add(function(ed, e) {
        console.debug('Key down event: ' + e.keyCode);
    });
}][0]
JS;
    return $initArray;
}

function z_url_preview_option_page() {
    ?>
    <div>
        <h2>Z-URL Preview Options</h2>
        <hr>
        <form method="post" action="options.php">
            <?php wp_nonce_field('update-options'); ?>

            <table width="510">
                <tr valign="top">
                    <td width="92" scope="row">Z-URL Preview CSS</td>
                </tr>
                <tr valign="top">
                    <td width="406">
                        <textarea name="zurlpreview_css" id="zurlpreview_css" rows="10" cols="70"><?php echo get_option('zurlpreview_css'); ?></textarea>
                    </td>
                </tr>
            </table>

            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="zurlpreview_css" />

            <p>
                <input type="submit" value="<?php _e('Save Changes') ?>" />
            </p>

        </form>
    </div>
    <?php
}
?>