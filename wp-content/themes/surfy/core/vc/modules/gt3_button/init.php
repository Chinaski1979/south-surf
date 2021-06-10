<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    // Add button
    vc_map(array(
        "name" => esc_html__("Button", "surfy"),
        "base" => "gt3_button",
        "class" => "gt3_button",
        "category" => esc_html__('GT3 Modules', 'surfy'),
        "icon" => 'gt3_icon',
        "content_element" => true,
        "description" => esc_html__("Add custom button","surfy"),
        "params" => array(
            // Text
            array(
                "type" => "textfield",
                "heading" => esc_html__("Text", "surfy"),
                "param_name" => "button_title",
                "value" => esc_html__("Text on the button", "surfy")
            ),
            // Link
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'surfy' ),
                'param_name' => 'link',
                "description" => esc_html__("Add link to button.", "surfy")
            ),
            // Size
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Size', 'surfy' ),
                'param_name' => 'button_size',
                "value"         => array(
                    esc_html__( 'Normal', 'surfy' )   => 'normal',
                    esc_html__( 'Mini', 'surfy' )      => 'mini',
                    esc_html__( 'Small', 'surfy' )     => 'small',
                    esc_html__( 'Large', 'surfy' )     => 'large'
                ),
                "description" => esc_html__("Select button display size.", "surfy")
            ),
            // Alignment
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Alignment', 'surfy' ),
                'param_name' => 'button_alignment',
                "value"         => array(
                    esc_html__( 'Inline', 'surfy' )      => 'inline',
                    esc_html__( 'Left', 'surfy' )     => 'left',
                    esc_html__( 'Right', 'surfy' )   => 'right',
                    esc_html__( 'Center', 'surfy' )     => 'center',
                    esc_html__( 'Block', 'surfy' )      => 'block'
                ),
                "description" => esc_html__("Select button alignment.", "surfy")
            ),
            // Button Border
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Button Border Radius', 'surfy' ),
                'param_name' => 'btn_border_radius',
                "value"         => array(
                    esc_html__( 'None', 'surfy' )      => 'none',
                    esc_html__( '1px', 'surfy' )      => '1px',
                    esc_html__( '2px', 'surfy' )      => '2px',
                    esc_html__( '3px', 'surfy' )      => '3px',
                    esc_html__( '4px', 'surfy' )      => '4px',
                    esc_html__( '5px', 'surfy' )      => '5px',
                    esc_html__( '10px', 'surfy' )      => '10px',
                    esc_html__( '15px', 'surfy' )      => '15px',
                    esc_html__( '20px', 'surfy' )      => '20px',
                    esc_html__( '25px', 'surfy' )      => '25px',
                    esc_html__( '30px', 'surfy' )      => '30px',
                    esc_html__( '35px', 'surfy' )      => '35px'
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Button Border Style', 'surfy' ),
                'param_name' => 'btn_border_style',
                "value"         => array(
                    esc_html__( 'Solid', 'surfy' )     => 'solid',
                    esc_html__( 'Dashed', 'surfy' )   => 'dashed',
                    esc_html__( 'Dotted', 'surfy' )     => 'dotted',
                    esc_html__( 'Double', 'surfy' )      => 'double',
                    esc_html__( 'Inset', 'surfy' )      => 'inset',
                    esc_html__( 'Outset', 'surfy' )      => 'outset',
                    esc_html__( 'None', 'surfy' )      => 'none'
                ),
                'dependency' => array(
                    'callback' => 'gt3ButtonDependency',
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Button Border Width', 'surfy' ),
                'param_name' => 'btn_border_width',
                "value"         => array(
                    esc_html__( '1px', 'surfy' )      => '1px',
                    esc_html__( '2px', 'surfy' )      => '2px',
                    esc_html__( '3px', 'surfy' )      => '3px',
                    esc_html__( '4px', 'surfy' )      => '4px',
                    esc_html__( '5px', 'surfy' )      => '5px',
                    esc_html__( '6px', 'surfy' )      => '6px',
                    esc_html__( '7px', 'surfy' )      => '7px',
                    esc_html__( '8px', 'surfy' )      => '8px',
                    esc_html__( '9px', 'surfy' )      => '9px',
                    esc_html__( '10px', 'surfy' )      => '10px'
                ),
                'dependency' => array(
                    'element' => 'btn_border_style',
                    'value_not_equal_to' => 'none',
                ),
            ),
            // --- ICON GROUP --- //
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Icon Type", "surfy"),
                "param_name" => "btn_icon_type",
                "value" => array(
                    esc_html__("None","surfy") => "none",
                    esc_html__("Font","surfy") => "font",
                    esc_html__("Image","surfy") => "image",
                ),
                'group' => esc_html__( 'Icon', 'surfy' ),
                "description" => esc_html__("Use an existing font icon or upload a custom image.", "surfy"),
                'dependency' => array(
                    'callback' => 'gt3ButtonDependency',
                ),
            ),
            // Icon
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__('Icon', 'surfy'),
                'param_name' => 'btn_icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 200, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                "dependency" => Array("element" => "btn_icon_type","value" => array("font")),
                'description' => esc_html__( 'Select icon from library.', 'surfy' ),
                'group' => esc_html__( 'Icon', 'surfy' ),
            ),
            // Image
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Image', 'surfy'),
                'param_name' => 'btn_image',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'surfy' ),
                "dependency" => Array("element" => "btn_icon_type","value" => array("image")),
                'group' => esc_html__( 'Icon', 'surfy' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Image Width', 'surfy'),
                'param_name' => 'btn_img_width',
                'value' => '',
                'description' => esc_html__( 'Enter image width in pixels.', 'surfy' ),
                "dependency" => Array("element" => "btn_icon_type","value" => array("image")),
                'edit_field_class' => 'vc_col-sm-6',
                'group' => esc_html__( 'Icon', 'surfy' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Icon Position', 'surfy'),
                'param_name' => 'btn_icon_position',
                'value' => array(
                    esc_html__("Left", "surfy") => 'left',
                    esc_html__("Right", "surfy") => 'right'
                ),
                "dependency" => Array("element" => "btn_icon_type","value" => array("image", "font")),
                'group' => esc_html__( 'Icon', 'surfy' ),
            ),
            // Icon Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Icon Font Size', 'surfy'),
                'param_name' => 'icon_font_size',
                'value' => '18',
                'description' => esc_html__( 'Enter icon font-size in pixels.', 'surfy' ),
                "dependency" => Array("element" => "btn_icon_type","value" => array("font")),
                "group" => esc_html__( "Icon", 'surfy' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // --- TYPOGRAPHY GROUP --- //
            // Button Font
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for button?', 'surfy' ),
                'param_name' => 'use_theme_fonts_button',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'surfy' ),
                "group" => esc_html__( "Typography", 'surfy' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_button',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'surfy' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'surfy' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Typography", 'surfy' ),
            ),
            // Button Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button Font Size', 'surfy'),
                'param_name' => 'btn_font_size',
                'value' => '12',
                'description' => esc_html__( 'Enter button font-size in pixels.', 'surfy' ),
                "group" => esc_html__( "Typography", 'surfy' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // --- SPACING GROUP --- //
            array(
                'type' => 'css_editor',
                'param_name' => 'css',
                'group' => esc_html__( 'Spacing', 'surfy' ),
            ),
            vc_map_add_css_animation( true ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", "surfy"),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "surfy")
            ),
            // --- CUSTOM GROUP --- //
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default button?', 'surfy' ),
                'param_name' => 'use_theme_button',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'description' => esc_html__( 'Use button from the theme.', 'surfy' ),
                "group" => esc_html__( "Custom", 'surfy' ),
                'std' => 'yes',
            ),
            // Button Bg
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Background", "surfy"),
                "param_name" => "btn_bg_color",
                "value" => esc_attr(gt3_option("theme-custom-color")),
                "description" => esc_html__("Select custom background for button.", "surfy"),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'surfy' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button text-color
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Text Color", "surfy"),
                "param_name" => "btn_text_color",
                "value" => "#ffffff",
                "description" => esc_html__("Select custom text color for button.", "surfy"),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'surfy' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover Bg
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Button Hover Background", "surfy"),
                "param_name" => "btn_bg_color_hover",
                "value" => "#ffffff",
                "description" => esc_html__("Select custom background for hover button.", "surfy"),
                'dependency' => array(
                    'element' => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'surfy' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover text-color
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Button Hover Text Color", "surfy"),
                "param_name" => "btn_text_color_hover",
                "value" => esc_attr(gt3_option("theme-custom-color")),
                "description" => esc_html__("Select custom text color for hover button.", "surfy"),
                'dependency' => array(
                    'element' => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'surfy' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button icon-color
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Icon Color", "surfy"),
                "param_name" => "btn_icon_color",
                "value" => "#ffffff",
                "description" => esc_html__("Select icon color for button.", "surfy"),
                'dependency' => array(
                    'element' => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'surfy' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover icon-color
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Button Hover Icon Color", "surfy"),
                "param_name" => "btn_icon_color_hover",
                "value" => "#ffffff",
                "description" => esc_html__("Select icon color for hover button.", "surfy"),
                'dependency' => array(
                    'element' => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'surfy' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button border-color
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Button Border Color", "surfy"),
                "param_name" => "btn_border_color",
                "value" => esc_attr(gt3_option("theme-custom-color")),
                "description" => esc_html__("Select custom border color for button.", "surfy"),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'surfy' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover border-color
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Button Hover Border Color", "surfy"),
                "param_name" => "btn_border_color_hover",
                "value" => esc_attr(gt3_option("theme-custom-color")),
                "description" => esc_html__("Select custom border color for hover button.", "surfy"),
                "group" => esc_html__( "Custom", 'surfy' ),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'use_theme_button',
                    'value_not_equal_to' => 'yes',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),


        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_Button extends WPBakeryShortCode {
        }
    }
}