<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$header_font = gt3_option('header-font');
$main_font = gt3_option('main-font');

if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        "name" => esc_html__("Icon Box", "surfy"),
        "base" => "gt3_icon_box",
        "class" => "gt3_icon_box",
        "category" => esc_html__('GT3 Modules', 'surfy'),
        "icon" => 'gt3_icon',
        "content_element" => true,
        "description" => esc_html__("Icon Box","surfy"),
        "params" => array(
            // Icon Section
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__( 'Icon Type', 'surfy' ),
                "param_name"    => "icon_type",
                "value"         => array(
                    esc_html__( 'None', 'surfy' )      => 'none',
                    esc_html__( 'Font', 'surfy' )      => 'font',
                    esc_html__( 'Image', 'surfy' )     => 'image',
                    esc_html__( 'Number', 'surfy' )    => 'number',
                ),
                'save_always' => true,
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Number', 'surfy' ),
                "param_name"    => "number",
                'dependency'    => array(
                    'element'       => 'icon_type',
                    'value'         => 'number',
                ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'surfy' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 200,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'surfy' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'surfy' ),
                'param_name' => 'thumbnail',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'surfy' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => array( 'image' ),
                ),
            ),            
            array(
                "type"          => "checkbox",
                "heading"       => esc_html__( 'Set Icon below the Title', 'surfy' ),
                "param_name"    => "icon_below",
                'dependency'    => array(
                    'element'       => 'icon_position',
                    'value'         => array( 'inline_title' ),
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__( 'Icon Vertical Position', 'surfy' ),
                "param_name"    => "icon_vertical_position",
                "value"         => array(
                    esc_html__( 'Default', 'surfy' ) => 'default',
                    esc_html__( 'Top', 'surfy' )     => 'top',
                    esc_html__( 'Middle', 'surfy' )  => 'center',
                    esc_html__( 'Bottom', 'surfy' )  => 'bottom'
                ),
                'std'           => 'default',
                'dependency'    => array(
                    'element'       => 'icon_position',
                    'value'         => array( 'left', 'right' ),
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__( 'Icon Position', 'surfy' ),
                "param_name"    => "icon_position",
                "value"         => array(
                    esc_html__( 'Top', 'surfy' )               => 'top',
                    esc_html__( 'Left', 'surfy' )              => 'left',
                    esc_html__( 'Right', 'surfy' )             => 'right',
                    esc_html__('Inline with Title', 'surfy')   => 'inline_title'
                ),
                'save_always' => true,
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Heading", "surfy"),
                "param_name" => "heading",
                "description" => esc_html__("Enter text for heading line.", "surfy")
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
                "heading"       => esc_html__( 'Icon in circle', 'surfy' ),
                "param_name"    => "icon_circle",
                'save_always' => true,
            ),
             array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Circle Color', 'surfy' ),
                "param_name"    => "circle_bg",
                "value"         => '#e9e9e9',
                'save_always' => true,
                'dependency' => array(
                    'element' => 'icon_circle',
                    'value' => "true",
                ),
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
                "heading"       => esc_html__( 'Icon Size', 'surfy' ),
                "param_name"    => "icon_size",
                "value"         => array(
                    esc_html__( 'Regular', 'surfy' )   => 'regular',
                    esc_html__( 'Mini', 'surfy' )      => 'mini',
                    esc_html__( 'Small', 'surfy' )     => 'small',
                    esc_html__( 'Large', 'surfy' )     => 'large',
                    esc_html__( 'Huge', 'surfy' )      => 'huge',
                    esc_html__( 'Custom', 'surfy')     => 'custom'
                ),              
                "group"         => esc_html__( "Styling", 'surfy' ),
                'save_always' => true,
            ),
            // Custom icon size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Icon Size', 'surfy'),
                'param_name' => 'custom_icon_size',
                'value' => '28',
                'description' => esc_html__( 'Enter Icon size in pixels.', 'surfy' ),
                "group" => esc_html__( "Styling", 'surfy' ),
                'dependency' => array(
                    'element' => 'icon_size',
                    'value' => 'custom',
                ),
            ),
            array(
                "type"          => "colorpicker",
                "heading"       => esc_html__( 'Icon Color', 'surfy' ),
                "param_name"    => "icon_color",
                "group"         => esc_html__( "Styling", 'surfy' ),
                "value"         => esc_attr(gt3_option("theme-custom-color")),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' =>  array('font','number'),
                ),
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
                'heading' => esc_html__('Icon Box Title Font Size', 'surfy'),
                'param_name' => 'iconbox_title_size',
                'value' => '28',
                'description' => esc_html__( 'Enter Icon Box title font-size in pixels.', 'surfy' ),
                "group" => esc_html__( "Styling", 'surfy' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Iconbox Title Fonts
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for iconbox title?', 'surfy' ),
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
                'heading' => esc_html__('Icon Box Content Font Size', 'surfy'),
                'param_name' => 'iconbox_content_size',
                'value' => '14',
                'description' => esc_html__( 'Enter Icon Box content font-size in pixels.', 'surfy' ),
                "group" => esc_html__( "Styling", 'surfy' ),
                'edit_field_class' => 'vc_col-sm-6',
                'save_always' => true,
            ),
            // Iconbox content Fonts
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for iconbox content?', 'surfy' ),
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
        class WPBakeryShortCode_Gt3_icon_box extends WPBakeryShortCode {
            
        }
    } 
}
