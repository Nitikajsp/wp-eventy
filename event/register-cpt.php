<?php

// Register Event Post Type
function mep_register_event_post_type() {
    $labels = [
        'name' => 'Events',
        'singular_name' => 'Event',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Event',
        'edit_item' => 'Edit Event',
        'new_item' => 'New Event',
        'view_item' => 'View Event',
        'search_items' => 'Search Events',
        'not_found' => 'No events found',
        'not_found_in_trash' => 'No events found in Trash',
        'all_items' => 'All Events',
    ];
    register_post_type('event', [
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'excerpt'],
        'rewrite' => ['slug' => 'events'],
    ]);
}
add_action('init', 'mep_register_event_post_type');
 
// Register Event Category Taxonomy
function mep_register_event_category_taxonomy() {
    $labels = [
        'name' => 'Event Categories',
        'singular_name' => 'Event Category',
        'search_items' => 'Search Event Categories',
        'all_items' => 'All Event Categories',
        'edit_item' => 'Edit Event Category',
        'update_item' => 'Update Event Category',
        'add_new_item' => 'Add New Event Category',
        'new_item_name' => 'New Event Category Name',
        'menu_name' => 'Event Categories',
    ];
    register_taxonomy('event_category', 'event', [
        'labels' => $labels,
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'event-category'],
    ]);
}
add_action('init', 'mep_register_event_category_taxonomy');
