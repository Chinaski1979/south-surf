<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__('Blog Posts', 'surfy'),
        'base' => 'gt3_blog',
        'class' => 'gt3_blog',
        "description" => esc_html__("Display blog posts", "surfy"),
        'category' => esc_html__('GT3 Modules', 'surfy'),
        'icon' => 'gt3_icon',
        'params' => array(
            array(
                'type' => 'loop',
                'heading' => esc_html__('Blog Items', 'surfy'),
                'param_name' => 'build_query',
                'settings' => array(
                    'size' => array('hidden' => false, 'value' => 4 * 3),
                    'order_by' => array('value' => 'date'),
                    'post_type' => array('value' => 'post', 'hidden' => true),
                    'categories' => array('hidden' => false),
                    'tags' => array('hidden' => false)
                ),
                'description' => esc_html__('Create WordPress loop, to populate content from your site.', 'surfy')
            ),
            // Post meta
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Cut off text in blog listing', 'surfy' ),
                'param_name' => 'blog_post_listing_content_module',
                'description' => esc_html__( 'If checked, cut off text in blog listing.', 'surfy' ),
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show post-meta author?', 'surfy' ),
                'param_name' => 'meta_author',
                'description' => esc_html__( 'If checked, post-meta will have author.', 'surfy' ),
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'yes',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show post-meta comments?', 'surfy' ),
                'param_name' => 'meta_comments',
                'description' => esc_html__( 'If checked, post-meta will have comments.', 'surfy' ),
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'yes',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show post-meta categories?', 'surfy' ),
                'param_name' => 'meta_categories',
                'description' => esc_html__( 'If checked, post-meta will have categories.', 'surfy' ),
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'yes',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show post-meta date?', 'surfy' ),
                'param_name' => 'meta_date',
                'description' => esc_html__( 'If checked, post-meta will have date.', 'surfy' ),
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'yes',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Items per line
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Items Per Line', 'surfy' ),
                'param_name' => 'items_per_line',
                "value"         => array(
                    esc_html__( '1', 'surfy' ) => '1',
                    esc_html__( '2', 'surfy' ) => '2',
                    esc_html__( '3', 'surfy' ) => '3',
                    esc_html__( '4', 'surfy' ) => '4'
                ),
                "description" => esc_html__("Select post items per line.", "surfy")
            ),
            // Spacing beetween items
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Spacing beetween items', 'surfy' ),
                'param_name' => 'spacing_beetween_items',
                "value"         => array(
                    esc_html__( '5px', 'surfy' )      => '5',
                    esc_html__( '10px', 'surfy' )      => '10',
                    esc_html__( '15px', 'surfy' )      => '15',
                    esc_html__( '20px', 'surfy' )      => '20',
                    esc_html__( '25px', 'surfy' )      => '25',
                    esc_html__( '30px', 'surfy' )      => '30'
                ),
                "description" => esc_html__("Select spacing beetween items.", "surfy"),
                "dependency" => Array("element" => "items_per_line","value" => array("2", "3", "4")),
            ),
            vc_map_add_css_animation( true ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", "surfy"),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "surfy")
            ),
        ),

    ));

    class WPBakeryShortCode_Gt3_Blog extends WPBakeryShortCode {
    }
}