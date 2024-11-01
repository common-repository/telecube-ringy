<?php
/*
 Plugin Name:  TeleCube Ringy
 Plugin URI:   https://www.telecube.pl/callback-ringy/
 Description:  Insert Telecube Ringy to wordpress page.
 Version:      1.0.1
 Author:       Łukasz A. Grabowski
 Author URI:   https://telecube.pl/
 License:      Copywrite 2018 by Claude ICT Poland
 Text Domain:  tcp-ringy
 Domain Path:  /languages
 */


//Block direct access
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

//ensure we have options
add_option('tc-ringy-uuid');

require_once(dirname(__FILE__) . '/helpers.php');
require_once(dirname(__FILE__) . '/options.php');

/**
 * Register plugn text domain
 */
add_action('plugins_loaded', 'tcp_ringy_load_textdomain');
function tcp_ringy_load_textdomain() {
   load_plugin_textdomain('tcp-ringy', false, basename(dirname(__FILE__)) . '/languages');
};

/**
 * Add WP hook, that attach script to foot
 * im lower priority, so scripts will be to max to the end of foot
 */
add_action('get_footer', 'tcp_ringy_script', 9999, 0);
function tcp_ringy_script() {
    //get ringy uuid
    $uuid = get_option('tc-ringy-uuid');
    
    //i
    if($uuid) {
        $jsPath = tcp_ringy_plugin_path('footer.js'); //path to initial script
        if(file_exists($jsPath)) {
            $jsContent = file_get_contents($jsPath);
            if($jsContent !== FALSE) {
                echo "<script language=\"javascript\" type=\"text/javascript\">\n";
                echo "var tcc_uuid = \"" . $uuid . "\";\n";
                echo $jsContent;
                echo "</script>\n";
            };
        };
    };
};
