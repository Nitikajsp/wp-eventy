<?php

function my_eventy_add_event_metaboxes() {
    add_meta_box(
        'my_eventy_event_details',
        'Event Details',
        'my_eventy_event_metabox_callback',
        'event',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'my_eventy_add_event_metaboxes' );

function my_eventy_event_metabox_callback( $post ) {
    // Nonce field for security
    wp_nonce_field( 'my_eventy_save_event_details', 'my_eventy_event_nonce' );

    $start_date = get_post_meta( $post->ID, 'event_start_date', true );
    $end_date   = get_post_meta( $post->ID, 'event_end_date', true );
    $start_time = get_post_meta( $post->ID, 'event_start_time', true );
    $end_time   = get_post_meta( $post->ID, 'event_end_time', true );
    $location   = get_post_meta( $post->ID, 'event_location', true );
    ?>
    <p>
        <label>Start Date: <input type="date" name="event_start_date" value="<?php echo esc_attr( $start_date ); ?>"></label>
    </p>
    <p>
        <label>End Date: <input type="date" name="event_end_date" value="<?php echo esc_attr( $end_date ); ?>"></label>
    </p>
    <p>
        <label>Start Time: <input type="time" name="event_start_time" value="<?php echo esc_attr( $start_time ); ?>"></label>
    </p>
    <p>
        <label>End Time: <input type="time" name="event_end_time" value="<?php echo esc_attr( $end_time ); ?>"></label>
    </p>
    <p>
        <label>Location: <input type="text" name="event_location" value="<?php echo esc_attr( $location ); ?>" style="width: 100%;"></label>
    </p>
    <?php
}

function my_eventy_save_event_metaboxes( $post_id ) {
    if ( ! isset( $_POST['my_eventy_event_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['my_eventy_event_nonce'], 'my_eventy_save_event_details' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $fields = [
        'event_start_date',
        'event_end_date',
        'event_start_time',
        'event_end_time',
        'event_location',
    ];

    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }
}
add_action( 'save_post_event', 'my_eventy_save_event_metaboxes' );