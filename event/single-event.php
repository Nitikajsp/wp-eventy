<?php
get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        $start_date = get_post_meta( get_the_ID(), 'event_start_date', true );
        $end_date   = get_post_meta( get_the_ID(), 'event_end_date', true );
        $start_time = get_post_meta( get_the_ID(), 'event_start_time', true );
        $end_time   = get_post_meta( get_the_ID(), 'event_end_time', true );
        $location   = get_post_meta( get_the_ID(), 'event_location', true );
        ?>
        <div class="single-event">
            <h1><?php the_title(); ?></h1>
            <div class="event-meta">
                <p><strong>Start:</strong> <?php echo esc_html( $start_date . ' ' . $start_time ); ?></p>
                <p><strong>End:</strong> <?php echo esc_html( $end_date . ' ' . $end_time ); ?></p>
                <p><strong>Location:</strong> <?php echo esc_html( $location ); ?></p>
            </div>
            <div class="event-content">
                <?php the_content(); ?>
            </div>
        </div>
        <?php
    endwhile;
endif;

get_footer();