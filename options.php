<?php
/*
 For Plugin Name:  TeleCube Ringy
 File Desc:    Admin options page definition
 Author:       Łukasz A. Grabowski
 Author URI:   https://telecube.pl/
 License:      Copywrite 2018 by Claude ICT Poland
 Text Domain:  tcp-ringy
 */

require_once(dirname(__FILE__) . '/helpers.php');

/**
 * Register admin page for ringy in admin menu
 */
add_action('admin_menu', 'tcp_ringy_add_admin_menu');
function tcp_ringy_add_admin_menu() {
   add_options_page(__('TeleCube Ringy', 'tcp-ringy'), __('TeleCube Ringy', 'tcp-ringy'), 'manage_options', 'tcp_ringy', 'tcp_ringy_options_page' );
};

/**
 * Initialize WP settings for ringy
 */
add_action('admin_init', 'tcp_ringy_settings_init');
function tcp_ringy_settings_init() {
   register_setting('tc_ringy_uuid', 'tc-ringy-uuid');
   add_settings_section(
      'tc-ringy-uuid',
      __( 'Settings', 'tcp-ringy' ),
      'tcp_ringy_section_callback',
      'tc_ringy_uuid'
   );
   add_settings_field(
      'tc-ringy-uuid-code',
      __( 'Ringy UUID', 'tcp-ringy' ),
      'tcp_ringy_render',
      'tc_ringy_uuid',
      'tc-ringy-uuid'
   );
};

/**
 * Callback for WP setting
 */
function tcp_ringy_section_callback() { };

/**
 * Options page form generations
 */
function tcp_ringy_options_page() {
   $logoPath = tcp_ringy_plugin_path('logo.svg');
   $img = $jsContent = file_get_contents($logoPath);
   ?>
    <div class="wrap">
    <div style="float: right;"><a href="https://telecube.pl"><?php echo $img; ?></a></div>
    <h1>TeleCube Ringy</h1>
    <p>    	
    	<?php 
            echo sprintf(__('You can get TeleCube Ringy UUID from: %s.', 'tcp-ringy'), '<a href="https://panel.telecube.pl/ringy/manage/">https://panel.telecube.pl/ringy/manage/</a>');
        ?>
    </p>
	<form action='options.php' method='post'>
		<?php
		settings_fields('tc_ringy_uuid');
		do_settings_sections('tc_ringy_uuid');
		submit_button();
		?>
	</form>
	<?php 
	   $cLoc = get_locale();
	   $iPath = tcp_ringy_plugin_path('info/' . $cLoc . '.tpl');
	   if(file_exists($iPath)) {
	       $iCnt = file_get_contents($iPath);
	       if($iCnt !== FALSE) echo $iCnt;
	   };
	?>
	</div>
	<?php
};

/** 
 * Render input field for ringy UUID
 */
function tcp_ringy_render() {
   $opt = get_option( 'tc-ringy-uuid' );
   echo '<input type="text" name="tc-ringy-uuid" id="tc-ringy-uuid" value="' . $opt . '" /><label for="tc-ringy-uuid">' . __('Write it without any spacer around it.', 'tcp-ringy') . "</label><br />\n";
}
