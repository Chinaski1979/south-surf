<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$header_font = gt3_option('header-font');
$main_font = gt3_option('main-font');

if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        "name" => esc_html__("Image Box", "surfy"),
        "base" => "gt3_image_box",
        "class" => "gt3_image_box",
        "category" => esc_html__('GT3 Modules', 'surfy'),
        "icon" => 'gt3_icon',
        "content_element" => true,
        "description" => esc_html__("Image Box","surfy"),
        "params" => array(
            // Image selection
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'surfy' ),
                'param_name' => 'thumbnail',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'surfy' ),
            ),
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__( 'Image Position', 'surfy' ),
                "param_name"    => "image_position",
                "value"         => array(
                    esc_html__( 'Top', 'surfy' )               => 'top',
                    esc_html__( 'Left', 'surfy' )              => 'left',
                    esc_html__( 'Right', 'surfy' )             => 'right'
                ),
                'save_always' => true,
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Heading", "surfy"),
                "param_name" => "heading",
                "description" => esc_html__("Enter text for heading line.", "surfy"),
                'admin_label' => true,
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Text", "surfy"),
                "param_name" => "text",
                "description" => esc_html__("Enter text.", "surfy")
            ),            
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Link', 'surfy' ),
                "param_name"    => "url",
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Link Text', 'surfy' ),
                "param_name"    => "url_text",
            ),            
            array(
                "type"          => "checkbox",
                "heading"       => esc_html__( 'Open in New Tab', 'surfy' ),
                "param_name"    => "new_tab",
                'save_always' => true,
            ),
            array(
                "type"          => "checkbox",
                "heading"       => esc_html__( 'Add divider after Heading', 'surfy' ),
                "param_name"    => "add_divider",
                'std' => '',
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Divider Color', 'surfy' ),
                "param_name"    => "divider_color",
                "value"         => esc_attr(gt3_option("theme-custom-color")),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'add_divider',
                    'value' => "true",
                ),
            ),
            vc_map_add_css_animation( true ),
            // Styling
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__( 'Title Tag', 'surfy' ),
                "param_name"    => "title_tag",
                "value"         => array(
                    esc_html__( 'H2', 'surfy' )    => 'h2',
                    esc_html__( 'H3', 'surfy' )    => 'h3',
                    esc_html__( 'H4', 'surfy' )    => 'h4',
                    esc_html__( 'H5', 'surfy' )    => 'h5',
                    esc_html__( 'H6', 'surfy' )    => 'h6',
                ),
                'save_always' => true,
                "group"         => esc_html__( "Styling", 'surfy' ),
            ),
            // Image Box title Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Image Box Title Font Size', 'surfy'),
                'param_name' => 'imagebox_title_size',
                'value' => '28',
                'description' => esc_html__( 'Enter Image Box title font-size in pixels.', 'surfy' ),
                "group" => esc_html__( "Styling", 'surfy' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Imagebox Title Fonts
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for iamgebox title?', 'surfy' ),
                'param_name' => 'use_theme_fonts_imagebox_title',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'surfy' ),
                "group" => esc_html__( "Styling", 'surfy' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_imagebox_title',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'surfy' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'surfy' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_imagebox_title',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'surfy' ),
            ),
            // Image Box content Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Image Box Content Font Size', 'surfy'),
                'param_name' => 'imagebox_content_size',
                'value' => '16',
                'description' => esc_html__( 'Enter Image Box content font-size in pixels.', 'surfy' ),
                "group" => esc_html__( "Styling", 'surfy' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Imagebox content Fonts
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for imagebox content?', 'surfy' ),
                'param_name' => 'use_theme_fonts_imagebox_content',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'surfy' ),
                "group" => esc_html__( "Styling", 'surfy' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_imagebox_content',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'surfy' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'surfy' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_imagebox_content',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'surfy' ),
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Title Color', 'surfy' ),
                "param_name"    => "title_color",
                "group"         => esc_html__( "Styling", 'surfy' ),
                "value"         => esc_attr($header_font['color']),
                'save_always' => true,
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Text Color', 'surfy' ),
                "param_name"    => "text_color",
                "group"         => esc_html__( "Styling", 'surfy' ),
                "value"         => esc_attr($main_font['color']),
                'save_always' => true,
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Link Color', 'surfy' ),
                "param_name"    => "link_color",
                "group"         => esc_html__( "Styling", 'surfy' ),
                "value"         => esc_attr(gt3_option("theme-custom-color")),
                'save_always' => true,
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Link Hover Color', 'surfy' ),
                "param_name"    => "link_hover_color",
                "group"         => esc_html__( "Styling", 'surfy' ),
                "value"         => esc_attr($header_font['color']),
                'save_always' => true,
            ),                
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_image_box extends WPBakeryShortCode {
            
        }
    } 
}
