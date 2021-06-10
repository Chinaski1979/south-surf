<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_testimonials',
        'name' => esc_html__('Testimonials', 'surfy'),
        'description' => esc_html__('Display testimonials', 'surfy'),
        'category' => esc_html__('GT3 Modules', 'surfy'),
        'icon' => 'gt3_icon',
        'js_view' => 'VcColumnView',
        "as_parent" => array('only' => 'gt3_testimonial_item'),
        "content_element" => true,
        'show_settings_on_create' => false,
        'params' => array(
            array(
                'type' => 'gt3_dropdown',
                'class' => '',
                'heading' => esc_html__('Style select', 'surfy'),
                'param_name' => 'view_type',
                'fields' => array(
                    'type1' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/img1.jpg', 
                        'descr' => esc_html__('Type 1', 'surfy')),
                    'type2' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/img2.jpg', 
                        'descr' => esc_html__('Type 2', 'surfy')),
                    'type3' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/img3.jpg', 
                        'descr' => esc_html__('Type 3', 'surfy')),
                    'type4' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/img4.jpg', 
                        'descr' => esc_html__('Type 4', 'surfy')),
                ),
                'value' => 'type1',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use testimonials carousel?', 'surfy' ),
                'param_name' => 'use_carousel',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'yes',
                /*'dependency' => array(
                    'element' => 'view_type',
                    'value_not_equal_to' => array("type4"),
                ),*/
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Autoplay time.', 'surfy' ),
                'param_name' => 'auto_play_time',
                'value' => '3000',
                'description' => esc_html__( 'Enter autoplay time in milliseconds.', 'surfy' ),
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value" => array("yes")
                )
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Items Per Line', 'surfy'),
                'param_name' => 'posts_per_line',
                'value' => array(
                    esc_html__("1", "surfy") => '1',
                    esc_html__("2", "surfy") => '2',
                    esc_html__("3", "surfy") => '3',
                    esc_html__("4", "surfy") => '4',
                ),
                'dependency' => array(
                    'element' => 'view_type',
                    'value_not_equal_to' => array("type4"),
                ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", "surfy"),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "surfy")
            ),
            // Testimonials Text Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Testimonials Text Font Size', 'surfy'),
                'param_name' => 'testimonilas_text_size',
                'value' => '16',
                'description' => esc_html__( 'Enter testimonials text font-size in pixels.', 'surfy' ),
                "group" => esc_html__( "Styling", 'surfy' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Testimonials Text Fonts
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Text Color", "surfy"),
                "param_name" => "text_color",
                "value" => "",
                "description" => esc_html__("Select text color for this item.", "surfy"),
                "group" => esc_html__( "Styling", 'surfy' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Testimonials Author Font Size', 'surfy'),
                'param_name' => 'testimonilas_author_size',
                'value' => '16',
                'description' => esc_html__( 'Enter testimonials author font-size in pixels.', 'surfy' ),
                "group" => esc_html__( "Styling", 'surfy' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Sign Color", "surfy"),
                "param_name" => "sign_color",
                "value" => "",
                "description" => esc_html__("Select sign color for this item.", "surfy"),
                "group" => esc_html__( "Styling", 'surfy' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Image setting section
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Image Width', 'surfy' ),
                'param_name' => 'img_width',
                'value' => '70',
                'description' => esc_html__( 'Enter image width in pixels.', 'surfy' ),
                "group" => "Styling",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Image Height', 'surfy' ),
                'param_name' => 'img_height',
                'value' => '70',
                'description' => esc_html__( 'Enter image height in pixels.', 'surfy' ),
                "group" => "Styling",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Circular Images?', 'surfy' ),
                'param_name' => 'round_imgs',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'yes',
                "group" => "Styling",
            ),
        )
    ));
    
    // Testimonial item options
    vc_map(array(
        "name" => esc_html__("Testimonial item", "surfy"),
        "base" => "gt3_testimonial_item",
        "class" => "gt3_info_list",
        "category" => esc_html__('GT3 Modules', 'surfy'),
        "icon" => site_url(str_replace(ABSPATH, '', __DIR__ . '/')) . 'icon.png',
        "content_element" => true,
        "as_child" => array('only' => 'gt3_testimonials'),
        "params" => array(
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Author name", "surfy"),
                "param_name" => "tstm_author",
                "value" => "",
                "description" => esc_html__("Provide a title for this list item.", "surfy"),
                'admin_label' => true,
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Author position", "surfy"),
                "param_name" => "tstm_position",
                "value" => "",
                "description" => esc_html__("Provide a position for this list item.", "surfy"),
                'admin_label' => true,
            ),
            // Image Section
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'surfy' ),
                'param_name' => 'image',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'surfy' ),
                'admin_label' => true,
            ),
            array(
                "type" => "textarea_html",
                "class" => "",
                "heading" => esc_html__("Description", "surfy"),
                "param_name" => "content",
                "value" => "",
                "description" => esc_html__("Description about this list item", "surfy")
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Select Rate', 'surfy'),
                'param_name' => 'select_rate',
                'value' => array(
                    esc_html__("none", "surfy") => 'none',
                    esc_html__("1", "surfy") => '1',
                    esc_html__("2", "surfy") => '2',
                    esc_html__("3", "surfy") => '3',
                    esc_html__("4", "surfy") => '4',
                    esc_html__("5", "surfy") => '5',
                ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", "surfy"),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "surfy")
            )
        )
    ));

    if (class_exists('WPBakeryShortCodesContainer')) {
        class WPBakeryShortCode_Gt3_Testimonials extends WPBakeryShortCodesContainer
        {
        }
    }
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_Testimonial_Item extends WPBakeryShortCode
        {
        }
    }
}