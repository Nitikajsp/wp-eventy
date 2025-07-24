// No imports! Use the global wp object
const { registerBlockType } = wp.blocks;
const { InspectorControls } = wp.blockEditor;
const { PanelBody, TextControl, SelectControl } = wp.components;
const { __ } = wp.i18n;
const ServerSideRender = wp.serverSideRender;


registerBlockType('my-eventy/event-list', {
    title: __('Event List', 'event-list'),
    icon: 'calendar',
    category: 'widgets',
    attributes: {
        view: { type: 'string', default: 'list' },
        cat: { type: 'string', default: '' },
        order: { type: 'string', default: 'asc' },
        type: { type: 'string', default: '' },
        count: { type: 'string', default: '-1' },
    },
    edit: function ({ attributes, setAttributes }) {
        return wp.element.createElement(
            "div",
            null,
            wp.element.createElement(
                InspectorControls,
                null,
                wp.element.createElement(
                    PanelBody,
                    { title: __('Event List Settings', 'event-list') },
                    wp.element.createElement(
                        SelectControl,
                        {
                            label: __('View', 'event-list'),
                            value: attributes.view,
                            options: [
                                { label: 'List', value: 'list' },
                                { label: 'Grid', value: 'grid' },
                            ],
                            onChange: (view) => setAttributes({ view })
                        }
                    ),
                    wp.element.createElement(
                        TextControl,
                        {
                            label: __('Category Slug', 'event-list'),
                            value: attributes.cat,
                            onChange: (cat) => setAttributes({ cat })
                        }
                    ),
                    wp.element.createElement(
                        SelectControl,
                        {
                            label: __('Order', 'event-list'),
                            value: attributes.order,
                            options: [
                                { label: 'Ascending', value: 'asc' },
                                { label: 'Descending', value: 'desc' },
                            ],
                            onChange: (order) => setAttributes({ order })
                        }
                    ),
                    wp.element.createElement(
                        SelectControl,
                        {
                            label: __('Type', 'event-list'),
                            value: attributes.type,
                            options: [
                                { label: 'All', value: '' },
                                { label: 'Upcoming', value: 'upcoming' },
                                { label: 'Past', value: 'past' },
                            ],
                            onChange: (type) => setAttributes({ type })
                        }
                    ),
                    wp.element.createElement(
                        TextControl,
                        {
                            label: __('Count', 'event-list'),
                            value: attributes.count,
                            onChange: (count) => setAttributes({ count })
                        }
                    )
                )
            ),
            wp.element.createElement(
                ServerSideRender,
                {
                    block: 'my-eventy/event-list',
                    attributes: attributes
                }
            )
        );
    },
    save: function () {
        return null;
    }
});