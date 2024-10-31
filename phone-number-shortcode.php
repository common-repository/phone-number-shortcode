<?php
/*
Plugin Name: Phone Number Shortcode
Author: Liam McArthur
Text Domain: phone-number-shortcode
Author URI: https://twitter.com/liammcarthur
Plugin URI: https://www.silkwave.co.uk
Description: Create phone number attributes on the database for shortcode use throughout the website.
Version: 1.5
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

/*
 * Exit if directly accessed
 */
defined('ABSPATH') or die();

/*
 * Load languages
 */
load_plugin_textdomain('phone-number-shortcode', false, basename( dirname( __FILE__ ) ) . '/languages' );

/*
 * Create menu item in admin
 */
add_action('admin_menu', 'silkwave_phone_menu');

function silkwave_phone_menu()
{
    add_menu_page('Phone Numbers', 'Phone Numbers', 'administrator', 'silkwave-phone-number', 'silkwave_phone_number', 'dashicons-phone');
    add_action('admin_init', 'silkwave_phone_register_mysettings');
}

function silkwave_phone_register_mysettings()
{
    register_setting('silkwave-phone-settings', 'silkwave_phone_number', 'silkwave_phone_number_validation');
    register_setting('silkwave-phone-settings', 'silkwave_phone_number2', 'silkwave_phone_number2_validation');
    register_setting('silkwave-phone-settings', 'silkwave_phone_number3', 'silkwave_phone_number3_validation');
    register_setting('silkwave-phone-settings', 'silkwave_phone_number4', 'silkwave_phone_number4_validation');
    register_setting('silkwave-phone-settings', 'silkwave_phone_number5', 'silkwave_phone_number5_validation');
}

/*
 * Create shortcode functionality
 */
function silkwave_phone_shortcode()
{
    return get_option('silkwave_phone_number');
}
function silkwave_phone_shortcode2()
{
	return get_option('silkwave_phone_number2');
}
function silkwave_phone_shortcode3()
{
	return get_option('silkwave_phone_number3');
}
function silkwave_phone_shortcode4()
{
	return get_option('silkwave_phone_number4');
}
function silkwave_phone_shortcode5()
{
	return get_option('silkwave_phone_number5');
}

add_shortcode('phone_number', 'silkwave_phone_shortcode');
add_shortcode('phone_number2', 'silkwave_phone_shortcode2');
add_shortcode('phone_number3', 'silkwave_phone_shortcode3');
add_shortcode('phone_number4', 'silkwave_phone_shortcode4');
add_shortcode('phone_number5', 'silkwave_phone_shortcode5');

/*
 * Sanitize it
 */
function silkwave_phone_number_validation($input) {
    return sanitize_text_field($input);
}

// Deactivation hooks
register_deactivation_hook( __FILE__, 'silkwave_phone_number_shortcode_deactivate' );
function silkwave_phone_number_shortcode_deactivate(){
    //delete plugins option here ex:
    delete_option('silkwave_phone_number');
    delete_option('silkwave_phone_number2');
    delete_option('silkwave_phone_number3');
    delete_option('silkwave_phone_number4');
    delete_option('silkwave_phone_number5');
}


/*
 * Generate the admin page
 */
function silkwave_phone_number()
{
    ?>
    <div class="notice notice-info">
        <p><?php echo __('Thanks for using the Phone Number Shortcode plugin for WordPress. If you like this plugin, please');?> <a href="https://wordpress.org/support/plugin/phone-number-shortcode/reviews/" target="_blank"><?php echo __('leave a review');?></a>.</p>
    </div>
    <div class="wrap">
        <h2><?php echo __('Enter your phone number below', 'phone-number-shortcode');?>:</h2>

        <?php if (isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true'):
            echo '<div id="setting-error-settings_updated" class="updated settings-error"> 
            <p><strong>' . __("Settings saved", "phone-number-shortcode") . '</strong></p>
         </div>';
        endif;
        ?>

        <form method="post" action="options.php">
            <?php settings_fields('silkwave-phone-settings'); ?>
            <?php do_settings_sections('silkwave-phone-settings'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php echo __('[phone_number]', 'phone-number-shortcode');?></th>
                    <td><input type="text" style="width:50%" name="silkwave_phone_number" value="<?php echo get_option('silkwave_phone_number'); ?>" placeholder=""/></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php echo __('[phone_number2]', 'phone-number-shortcode');?></th>
                    <td><input type="text" style="width:50%" name="silkwave_phone_number2" value="<?php echo get_option('silkwave_phone_number2'); ?>" placeholder=""/></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php echo __('[phone_number3]', 'phone-number-shortcode');?></th>
                    <td><input type="text" style="width:50%" name="silkwave_phone_number3" value="<?php echo get_option('silkwave_phone_number3'); ?>" placeholder=""/></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php echo __('[phone_number4]', 'phone-number-shortcode');?></th>
                    <td><input type="text" style="width:50%" name="silkwave_phone_number4" value="<?php echo get_option('silkwave_phone_number4'); ?>" placeholder=""/></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php echo __('[phone_number5]', 'phone-number-shortcode');?></th>
                    <td><input type="text" style="width:50%" name="silkwave_phone_number5" value="<?php echo get_option('silkwave_phone_number5'); ?>" placeholder=""/></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php } ?>
