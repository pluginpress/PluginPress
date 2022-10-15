<?php
/**
 * This file is read by WordPress to generate the plugin.
 *
 * This file is read by WordPress to generate the plugin information in the plugin admin area. This file also includes all of the dependencies used
 * by the plugin, registers the activation and deactivation functions, and defines a function that starts the plugin.
 *
 * @category                PluginPress
 * @package                 PluginPress
 * @link                    https://pluginpress.github.io
 * @copyright               2022 I am Programmer
 * @license                 LICENSE <https://github.com/PluginPress/PluginPress/blob/main/LICENSE>
 * @version                 GIT:1.0.0
 *
 * @author                  I am Programmer <contact@iamprogrammer.lk>
 * @since                   GIT:1.0.0
 * @link                    https://iamprogrammer.lk
 *
 * @file                    PluginPress.php
 * @file_version            GIT:1.0.0
 * @last_change             2022-10-15
 *
 * @wordpress-plugin
 * Plugin Name:             PluginPress
 * Description:             Skeleton framework for building object-oriented WordPress plugins. basic files and directory structure with the PluginPress APIs.
 * Plugin URI:              https://pluginpress.github.io
 * Version:                 1.0.0
 * Requires at least:       6.0.0
 * Requires PHP:            8.0.0
 * Author:                  I am Programmer
 * Author URI:              https://iamprogrammer.lk
 * Text Domain:             pluginpress
 * Domain Path:             /Common/Languages
 * Update URI:              https://github.com/PluginPress/PluginPress/
 * Network:                 false
 *
 */

namespace PluginPress\PluginPress;

// If this file is called directly, abort! for security purposes.
if(!defined('WPINC'))
{
    die('Unauthorized access..!');
}

// Dynamically include the classes.
require_once trailingslashit(dirname(__FILE__)) . 'vendor/autoload.php';

// initiate the plugin.
if(!class_exists('PluginPress'))
{
    // @string - required - absolute path to the primary plugin file (this file).
    // @string - required - absolute path to the plugin options(configurations) file.
    $test_plugin = new PluginPress(__FILE__, plugin_dir_path(__FILE__) . 'Configs/PluginOptions.php');
    $test_plugin->init();
}
