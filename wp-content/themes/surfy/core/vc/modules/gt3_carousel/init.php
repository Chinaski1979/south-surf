<?php
if (function_exists('vc_map')) {
    vc_map(array(		
		
        'base' => 'gt3_carousel',
        'name' => esc_html__('GT3 Carousel', 'surfy'),
		'class' => 'gt3_carousel_module',
        "description" => esc_html__("Display carousel", "surfy"),
		"as_parent" => array('only' => 'gt3_counter, gt3_button, vc_column_text, gt3_price_block, vc_single_image, vc_tta_tabs, vc_tta_tour, vc_tta_accordion, vc_images_carousel, vc_gallery, vc_message, vc_row'),
		"content_element" => true,		
        'category' => esc_html__('GT3 Modules', 'surfy'),
        "icon" => 'gt3_icon',
		'show_settings_on_create' => true,
		"is_container" => true,
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Items Per Line', 'surfy'),
                'param_name' => 'posts_per_line',
                'admin_label' => true,
                'value' => array(
                    esc_html__("1", "surfy") => '1',
                    esc_html__("2", "surfy") => '2',
                    esc_html__("3", "surfy") => '3',
                    esc_html__("4", "surfy") => '4',
                    esc_html__("5", "surfy") => '5',
                    esc_html__("6", "surfy") => '6'
                )
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Autoplay carousel', 'surfy' ),
                'param_name' => 'autoplay_carousel',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'yes'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slider speed', 'surfy' ),
                'param_name' => 'slider_speed',
                'value' => '3000',
                'description' => esc_html__( 'Enter autoplay time in milliseconds.', 'surfy' ),
                'dependency' => array(
                    'element' => 'autoplay_carousel',
                    'value' => array("yes"),
                ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Single slide to scroll', 'surfy' ),
                'param_name' => 'scroll_items',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'not',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Multiple Items', 'surfy' ),
                'param_name' => 'multiple_items',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'not',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Hide Pagination control', 'surfy' ),
                'param_name' => 'use_pagination',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'not',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Hide prev/next buttons', 'surfy' ),
                'param_name' => 'use_prev_next',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'not',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Adaptive Height', 'surfy' ),
                'param_name' => 'adaptive_height',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'not',
                'dependency' => array(
                    'element' => 'posts_per_line',
                    'value' => array("1"),
                ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", "surfy"),
                "param_name" => "el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "surfy")
            )			
        ),
		'js_view' => 'VcColumnView'
    ));


    if (class_exists('WPBakeryShortCodesContainer')) {
        class WPBakeryShortCode_Gt3_carousel extends WPBakeryShortCodesContainer
        {
        }
    }
}