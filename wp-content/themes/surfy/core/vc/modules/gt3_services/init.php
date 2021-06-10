<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        "name" => esc_html__("Services box", "surfy"),
        "base" => "gt3_services",
        "class" => "gt3_services",
        "category" => esc_html__('GT3 Modules', 'surfy'),
        "icon" => 'gt3_icon',
        "content_element" => true,
        "description" => esc_html__("Services box","surfy"),
        "params" => array(
            // Select Background Image
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Select Background Image', 'surfy' ),
                'param_name' => 'box_image',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'surfy' ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Title", "surfy"),
                "param_name" => "title",
                "description" => esc_html__("Enter text for title line.", "surfy")
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Content Text", "surfy"),
                "param_name" => "content_text",
                "description" => esc_html__("Enter text.", "surfy")
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Select Icon', 'surfy' ),
                'param_name' => 'thumbnail',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'surfy' ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Index number", "surfy"),
                "param_name" => "index_number",
                "description" => esc_html__("Enter text for index number line.", "surfy")
            ),
            // Link
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'surfy' ),
                'param_name' => 'link',
                "description" => esc_html__("Add link to box.", "surfy")
            ),
            // Module Height
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Module Height', 'surfy'),
                'param_name' => 'module_height',
                'value' => '275',
                'description' => esc_html__( 'Enter module height in pixels.', 'surfy' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Rotate Direction', 'surfy' ),
                'param_name' => 'rotate_direction',
                "value"         => array(
                    esc_html__( 'Left', 'surfy' ) => 'left',
                    esc_html__( 'Right', 'surfy' )    => 'right',
                    esc_html__( 'Top', 'surfy' )  => 'top',
                    esc_html__( 'Bottom', 'surfy' )   => 'bottom'
                )
            ),
            vc_map_add_css_animation( true ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", "surfy"),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "surfy")
            ),
            // S T Y L I N G
            // Custom Title
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Title Font Size', 'surfy'),
                'param_name' => 'custom_title_size',
                'value' => '30',
                'description' => esc_html__( 'Enter Title font-size in pixels.', 'surfy' ),
                "group" => esc_html__( "Styling", 'surfy' )
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for box title?', 'surfy' ),
                'param_name' => 'use_theme_fonts_box_title',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'surfy' ),
                "group" => esc_html__( "Styling", 'surfy' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_box_title',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'surfy' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'surfy' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_box_title',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'surfy' ),
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Title Color', 'surfy' ),
                "param_name"    => "title_color",
                "group"         => esc_html__( "Styling", 'surfy' ),
                "value"         => "#ffffff",
                'save_always' => true,
            ),
            // Custom Index Number
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Index Number Font Size', 'surfy'),
                'param_name' => 'custom_index_number_size',
                'value' => '72',
                'description' => esc_html__( 'Enter Index Number font-size in pixels.', 'surfy' ),
                "group" => esc_html__( "Styling", 'surfy' )
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for box index number?', 'surfy' ),
                'param_name' => 'use_theme_fonts_box_index_number',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'surfy' ),
                "group" => esc_html__( "Styling", 'surfy' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_box_index_number',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'surfy' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'surfy' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_box_index_number',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'surfy' ),
            ),
            // Box Index Number Color
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Index Number Color', 'surfy' ),
                "param_name"    => "index_number_color",
                "group"         => esc_html__( "Styling", 'surfy' ),
                "value"         => "rgba(255,255,255,0.2)",
                'save_always' => true,
            ),
            // Custom Content
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Content Font Size', 'surfy'),
                'param_name' => 'custom_content_size',
                'value' => '16',
                'description' => esc_html__( 'Enter Content font-size in pixels.', 'surfy' ),
                "group" => esc_html__( "Styling", 'surfy' )
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Content Text Color', 'surfy' ),
                "param_name"    => "content_text_color",
                "group"         => esc_html__( "Styling", 'surfy' ),
                "value"         => "#ffffff",
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Box Background (Hover State)
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Box Background (Hover State)', 'surfy' ),
                "param_name"    => "box_hover_bg",
                "group"         => esc_html__( "Styling", 'surfy' ),
                "value"         => esc_attr(gt3_option("theme-custom-color")),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for box content?', 'surfy' ),
                'param_name' => 'use_theme_fonts_box_content',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'surfy' ),
                "group" => esc_html__( "Styling", 'surfy' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_box_content',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'surfy' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'surfy' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_box_content',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'surfy' ),
            ),
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_services extends WPBakeryShortCode {
        }
    } 
}
