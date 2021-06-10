<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$header_font = gt3_option('header-font');
$main_font = gt3_option('main-font');

if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        "name" => esc_html__("Process Bar", "surfy"),
        "base" => "gt3_process_bar",
        "class" => "gt3_process_bar",
        "category" => esc_html__('GT3 Modules', 'surfy'),
        "icon" => 'gt3_icon',
        "content_element" => true,
        "description" => esc_html__("Process Bar","surfy"),
        "params" => array(
            // Icon Section
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__( 'Steps Count', 'surfy' ),
                "param_name"    => "steps",
                "value"         => array(
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ),
                'save_always' => true,
            ),
            array(
                "type"          => "backend_divider",
                "heading" => esc_html__("Step 1:", "surfy"),
                "param_name"    => "backend_divider",
            ),
            /* step 1 */
            array(
                "type" => "textfield",
                "heading" => esc_html__("Step 1 Heading", "surfy"),
                "param_name" => "heading1",
                "description" => esc_html__("Enter text for heading line.", "surfy")
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Step 1 Text", "surfy"),
                "param_name" => "text1",
                "description" => esc_html__("Enter text.", "surfy")
            ),            
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 1 Link', 'surfy' ),
                "param_name"    => "url1",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 1 Link Text', 'surfy' ),
                "param_name"    => "url_text1",
                'edit_field_class' => 'vc_col-sm-6',
            ),  
            /* step 2 */
            array(
                "type"          => "backend_divider",
                "heading" => esc_html__("Step 2:", "surfy"),
                "param_name"    => "backend_divider",
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Step 2 Heading", "surfy"),
                "param_name" => "heading2",
                "description" => esc_html__("Enter text for heading line.", "surfy")
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Step 2 Text", "surfy"),
                "param_name" => "text2",
                "description" => esc_html__("Enter text.", "surfy")
            ),            
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 2 Link', 'surfy' ),
                "param_name"    => "url2",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 2 Link Text', 'surfy' ),
                "param_name"    => "url_text2",
                'edit_field_class' => 'vc_col-sm-6',
            ), 
            /* step 3 */
            array(
                "type"          => "backend_divider",
                "heading" => esc_html__("Step 3:", "surfy"),
                "param_name"    => "backend_divider",
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Step 3 Heading", "surfy"),
                "param_name" => "heading3",
                "description" => esc_html__("Enter text for heading line.", "surfy")
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Step 3 Text", "surfy"),
                "param_name" => "text3",
                "description" => esc_html__("Enter text.", "surfy")
            ),            
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 3 Link', 'surfy' ),
                "param_name"    => "url3",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 3 Link Text', 'surfy' ),
                "param_name"    => "url_text3",
                'edit_field_class' => 'vc_col-sm-6',
            ), 
            /* step 4 */
            array(
                "type"          => "backend_divider",
                "heading" => esc_html__("Step 4:", "surfy"),
                "param_name"    => "backend_divider",
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Step 4 Heading", "surfy"),
                "param_name" => "heading4",
                "description" => esc_html__("Enter text for heading line.", "surfy"),
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Step 4 Text", "surfy"),
                "param_name" => "text4",
                "description" => esc_html__("Enter text.", "surfy"),
            ),            
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 4 Link', 'surfy' ),
                "param_name"    => "url4",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 4 Link Text', 'surfy' ),
                "param_name"    => "url_text4",
                'edit_field_class' => 'vc_col-sm-6',

            ), 
            /* step 5 */
            array(
                "type"          => "backend_divider",
                "heading" => esc_html__("Step 5:", "surfy"),
                "param_name"    => "backend_divider",
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Step 5 Heading", "surfy"),
                "param_name" => "heading5",
                "description" => esc_html__("Enter text for heading line.", "surfy"),
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Step 5 Text", "surfy"),
                "param_name" => "text5",
                "description" => esc_html__("Enter text.", "surfy"),
            ),            
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 5 Link', 'surfy' ),
                "param_name"    => "url5",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Step 5 Link Text', 'surfy' ),
                "param_name"    => "url_text5",
                'edit_field_class' => 'vc_col-sm-6',
            ), 
            // Styling
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__( 'Icon Size', 'surfy' ),
                "param_name"    => "icon_size",
                "value"         => array(
                    esc_html__( 'Regular', 'surfy' )   => 'regular',
                    esc_html__( 'Mini', 'surfy' )      => 'mini',
                    esc_html__( 'Small', 'surfy' )     => 'small',
                    esc_html__( 'Large', 'surfy' )     => 'large',
                    esc_html__( 'Huge', 'surfy' )      => 'huge'
                ),              
                "group"         => esc_html__( "Styling", 'surfy' ),
                'save_always' => true,
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Icon Background', 'surfy' ),
                "param_name"    => "icon_bg",
                "group"         => esc_html__( "Styling", 'surfy' ),
                "value"         => esc_attr(gt3_option("theme-custom-color")),
                'save_always' => true,
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Icon Color', 'surfy' ),
                "param_name"    => "icon_color",
                "group"         => esc_html__( "Styling", 'surfy' ),
                "value"         => '#ffffff',
                'save_always' => true,
            ),
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
            // Icon Box title Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title Font Size', 'surfy'),
                'param_name' => 'iconbox_title_size',
                'value' => '18',
                'description' => esc_html__( 'Enter title font-size in pixels.', 'surfy' ),
                "group" => esc_html__( "Styling", 'surfy' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Iconbox Title Fonts
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for title?', 'surfy' ),
                'param_name' => 'use_theme_fonts_iconbox_title',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'surfy' ),
                "group" => esc_html__( "Styling", 'surfy' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_iconbox_title',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'surfy' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'surfy' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_iconbox_title',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'surfy' ),
            ),
            // Icon Box content Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Content Font Size', 'surfy'),
                'param_name' => 'iconbox_content_size',
                'value' => '16',
                'description' => esc_html__( 'Enter content font-size in pixels.', 'surfy' ),
                "group" => esc_html__( "Styling", 'surfy' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Iconbox content Fonts
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for content?', 'surfy' ),
                'param_name' => 'use_theme_fonts_iconbox_content',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'surfy' ),
                "group" => esc_html__( "Styling", 'surfy' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_iconbox_content',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'surfy' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'surfy' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_iconbox_content',
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
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_process_bar extends WPBakeryShortCode {
            
        }
    } 
}
