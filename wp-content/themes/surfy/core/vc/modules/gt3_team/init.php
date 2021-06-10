<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_team',
        'name' => esc_html__('Team', 'surfy'),
        "description" => esc_html__("Display team members", "surfy"),
        'category' => esc_html__('GT3 Modules', 'surfy'),
        'icon' => 'gt3_icon',
        'params' => array(
            array(
                'type' => 'loop',
                'heading' => esc_html__('Team Items', 'surfy'),
                'param_name' => 'build_query',
                'settings' => array(
                    'size' => array('hidden' => false, 'value' => 4 * 3),
                    'order_by' => array('value' => 'date'),
                    'post_type' => array('value' => 'team', 'hidden' => true),
                    'categories' => array('hidden' => true),
                    'tags' => array('hidden' => true),
                ),
                'description' => esc_html__('Create WordPress loop, to populate content from your site.', 'surfy')
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Module title", "surfy"),
                "param_name" => "title",
                "description" => esc_html__("Module title.", "surfy"),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Subtitle', 'surfy'),
                'param_name' => 'subtitle',
                "description" => esc_html__("Module subtitle.", "surfy"),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use Filter?', 'surfy' ),
                'param_name' => 'use_filter',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'not',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Show View All Link', 'surfy'),
                'param_name' => 'show_view_all',
                'admin_label' => true,
                'value' => array(
                    esc_html__("No", "surfy") => 'no',
                    esc_html__("Yes", "surfy") => 'yes',
                ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Module on dark background?', 'surfy' ),
                'param_name' => 'module_on_dark_bg',
                'description' => esc_html__( 'If checked, change title and View All Link color.', 'surfy' ),
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'no'
            ),
            array(
                "type" => "vc_link",
                "heading" => esc_html__("Link", "surfy"),
                "param_name" => "view_all_link",
                'dependency' => array(
                    'element' => 'show_view_all', 'value' => array( 'yes' ),
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Items Per Line', 'surfy'),
                'param_name' => 'posts_per_line',
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-6',
                'value' => array(
                    esc_html__("1", "surfy") => '1',
                    esc_html__("2", "surfy") => '2',
                    esc_html__("3", "surfy") => '3',
                    esc_html__("4", "surfy") => '4',
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Grid Gap', 'surfy'),
                'param_name' => 'grid_gap',
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-6',
                'value' => array(
                    esc_html__("0", "surfy") => '0px',
                    esc_html__("1", "surfy") => '1px',
                    esc_html__("2", "surfy") => '2px',
                    esc_html__("3", "surfy") => '3px',
                    esc_html__("4", "surfy") => '4px',
                    esc_html__("5", "surfy") => '5px',
                    esc_html__("10", "surfy") => '10px',
                    esc_html__("15", "surfy") => '15px',
                    esc_html__("20", "surfy") => '20px',
                    esc_html__("25", "surfy") => '25px',
                    esc_html__("30", "surfy") => '30px',
                    esc_html__("35", "surfy") => '35px',
                ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", "surfy"),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "surfy")
            ),
            array(
                'type' => 'css_editor',
                'heading' => esc_html__( 'CSS box', 'surfy' ),
                'param_name' => 'css',
                'group' => esc_html__( 'Design Options', 'surfy' ),
                'edit_field_class' => 'no-vc-background no-vc-border',
            ),
        )
    ));

    class WPBakeryShortCode_Gt3_Team extends WPBakeryShortCode
    {
    }
}