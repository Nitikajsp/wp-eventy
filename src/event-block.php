<?php
function my_eventy_enqueue_block_assets() {
    wp_register_script(
        'my-eventy-block-event-list',
        plugins_url( 'block-event-list.js', __FILE__ ),
        array( 'wp-blocks', 'wp-element', 'wp-i18n', 'wp-components', 'wp-editor' ),
        filemtime( plugin_dir_path( __FILE__ ) . 'block-event-list.js' )
    );
    register_block_type( 'my-eventy/event-list', array(
        'editor_script'   => 'my-eventy-block-event-list',
        'render_callback' => 'my_eventy_block_render_callback',
        'attributes'      => array(
            'view'  => array( 'type' => 'string', 'default' => 'list' ),
            'cat'   => array( 'type' => 'string', 'default' => '' ),
            'order' => array( 'type' => 'string', 'default' => 'asc' ),
            'type'  => array( 'type' => 'string', 'default' => '' ),
            'count' => array( 'type' => 'string', 'default' => '-1' ),
        ),
    ) );
}
add_action( 'init', 'my_eventy_enqueue_block_assets' );

function my_eventy_block_render_callback( $atts ) {
    return my_eventy_shortcode( $atts );
}