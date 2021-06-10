<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_video_popup',
        'name' => esc_html__('Video Popup', 'surfy'),
        "description" => esc_html__("Video Popup Widget", "surfy"),
        'category' => esc_html__('GT3 Modules', 'surfy'),
        'icon' => 'gt3_icon',
        'params' => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Title", "surfy"),
                "param_name" => "video_title",
                "description" => esc_html__("Enter title.", "surfy")
            ),
            array(
                "type" => "attach_image",
                "heading" => esc_html__("Background Image Video", "surfy"),
                "param_name" => "bg_image",
                "description" => esc_html__("Select video background image.", "surfy")
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Video Link", "surfy"),
                "param_name" => "video_link",
                "description" => esc_html__("Enter video link from youtube or vimeo.", "surfy")
            ),

            /* styling video popup */
            array(
                "type" => "colorpicker",
                "heading" => esc_html__("Title color", "surfy"),
                "param_name" => "title_color",
                "value" => esc_attr(gt3_option("theme-custom-color")),
                "description" => esc_html__("Select custom color for title.", "surfy"),
                "group" => esc_html__( "Styling", 'surfy' ),
            ),
            array(
                "type" => "colorpicker",
                "heading" => esc_html__("Button color", "surfy"),
                "param_name" => "btn_color",
                "value" => esc_attr("#ffffff"),
                "description" => esc_html__("Select custom color for button.", "surfy"),
                "group" => esc_html__( "Styling", 'surfy' ),
            ),
            // Video Popup Title Fonts
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for Video Popup title?', 'surfy' ),
                'param_name' => 'use_theme_fonts_vpopup_title',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'surfy' ),
                "group" => esc_html__( "Styling", 'surfy' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_vpopup_title',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'surfy' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'surfy' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_vpopup_title',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Styling", 'surfy' ),
            ),
            // Icon Box content Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Video Popup Content Font Size', 'surfy'),
                'param_name' => 'title_size',
                'value' => '24',
                'description' => esc_html__( 'Enter Video Popup Title font-size in pixels.', 'surfy' ),
                "group" => esc_html__( "Styling", 'surfy' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),

            
        ),


    ));

    class WPBakeryShortCode_Gt3_Video_Popup extends WPBakeryShortCode { }

}