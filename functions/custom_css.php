<?php

add_action('admin_menu', 'baw_create_menu');

function baw_create_menu() {
	add_submenu_page( 'themes.php', 'Custom css gallery', 'Custom css gallery', 'manage_options', 'custom_css_gallery', 'custom_css_gallery_callback' );
	add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
	register_setting( 'custom_css_gallery', 'custom_css_gallery' );
}

function custom_css_gallery_callback() {

?>

<div class="wrap">
<h2>Custom css gallery</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'custom_css_gallery' ); ?>
    <?php do_settings_sections( 'custom_css_gallery' ); ?>
    <table class="form-table">
        <tr valign="top">
        
        <td><input class="button-primary" id="default_custom_css_gallery" type="button"  value="Default"/></td>
     
        <tr valign="top">

        <td><textarea id="custom_css_gallery" name="custom_css_gallery" cols="60" rows="4"  ><?php echo get_option('custom_css_gallery'); ?></textarea> </td>
        </tr>
        
 
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>