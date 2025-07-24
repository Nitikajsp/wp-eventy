<?php
// ...existing code...

function my_eventy_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'view'  => 'list',
        'cat'   => '',
        'order' => 'asc',
        'type'  => '', // or 'past'
        'count' => -1,
    ), $atts );

    $args = array(
        'post_type'      => 'event',
        'posts_per_page' => intval( $atts['count'] ),
        'orderby'        => 'meta_value',
        'meta_key'       => 'event_start_date',
        'order'          => strtoupper( $atts['order'] ),
    );

    // Filter by category if set
    if ( ! empty( $atts['cat'] ) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'event_category',
                'field'    => 'slug',
                'terms'    => $atts['cat'],
            ),
        );
    }

    // Filter by date
    $today = date( 'Y-m-d' );
    $meta_query = array();
    if ( $atts['type'] === 'upcoming' ) {
        $meta_query[] = array(
            'key'     => 'event_start_date',
            'value'   => $today,
            'compare' => '>=',
            'type'    => 'DATE',
        );
    } elseif ( $atts['type'] === 'past' ) {
        $meta_query[] = array(
            'key'     => 'event_start_date',
            'value'   => $today,
            'compare' => '<',
            'type'    => 'DATE',
        );
    }
    if ( $meta_query ) {
        $args['meta_query'] = $meta_query;
    }

    $query = new WP_Query( $args );
    if ( ! $query->have_posts() ) {
        return '<p>No events found.</p>';
    }

    $output = '<div class="my-eventy-view my-eventy-' . esc_attr( $atts['view'] ) . '">';
    foreach ( $query->posts as $post ) {
        $start_date = get_post_meta( $post->ID, 'event_start_date', true );
        $end_date   = get_post_meta( $post->ID, 'event_end_date', true );
        $start_time = get_post_meta( $post->ID, 'event_start_time', true );
        $end_time   = get_post_meta( $post->ID, 'event_end_time', true );
        $location   = get_post_meta( $post->ID, 'event_location', true );

        $output .= '<div class="event-item">';
        $output .= '<h3>' . esc_html( get_the_title( $post ) ) . '</h3>';
        $output .= '<div class="event-date">From: ' . esc_html( $start_date ) . ' ' . esc_html( $start_time ) . '</div>';
        $output .= '<div class="event-date">To: ' . esc_html( $end_date ) . ' ' . esc_html( $end_time ) . '</div>';
        $output .= '<div class="event-location">' . esc_html( $location ) . '</div>';
        $output .= '</div>';
    }
    $output .= '</div>';
    wp_reset_postdata();
    return $output;
}
add_shortcode( 'my_eventy', 'my_eventy_shortcode' );
// ...existing code...