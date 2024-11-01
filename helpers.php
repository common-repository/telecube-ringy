<?php
/*
 For Plugin Name:  TeleCube Ringy
 File Desc:    Telecube plugin helpers
 Author:       Łukasz A. Grabowski
 Author URI:   https://telecube.pl/
 License:      Copywrite 2018 by Claude ICT Poland
 Text Domain:  tcp-ringy
 */

/**
 * Get plugin full path
 * (optionalii add subpath)
 *
 * @param string|null $subpath
 * @return string path to plugin
 */
function tcp_ringy_plugin_path($subpath = null) {
    static $path;
    if(!isset($path)) $path = plugin_dir_path(__FILE__);
    if($subpath) return path_join($path, $subpath);
    return $path;
};
