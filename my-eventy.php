<?php

/**
 * Plugin Name:       Event List New
 * Description:       Example block scaffolded with Create Block tool.
 * Version:           0.1.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       event-list
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


require_once __DIR__ . '/event/register-cpt.php';
require_once __DIR__ . '/event/event-list.php';
require_once __DIR__ . '/event/event-metaboxes.php';
require_once __DIR__ . '/src/event-block.php';

add_filter( 'template_include', function( $template ) {
    if ( is_singular( 'event' ) ) {
        $plugin_template = plugin_dir_path( __FILE__ ) . 'event/single-event.php';
        if ( file_exists( $plugin_template ) ) {
            return $plugin_template;
        }
    }
    return $template;
});