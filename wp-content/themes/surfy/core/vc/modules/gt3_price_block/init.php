<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_price_block',
        'name' => esc_html__('Price Block', 'surfy'),
        "description" => esc_html__("Create price table", "surfy"),
        'category' => esc_html__('GT3 Modules', 'surfy'),
        'icon' => 'gt3_icon',
        'params' => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Package Name", "surfy"),
                "param_name" => "title",
                "description" => esc_html__("Enter title of price block.", "surfy")
            ),
            array(
                "type" => "attach_image",
                "heading" => esc_html__("Header Background Image", "surfy"),
                "param_name" => "header_img",
                "description" => esc_html__("Select header background image.", "surfy")
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Active package', 'surfy'),
                'param_name' => 'package_is_active',
                'admin_label' => true,
                'value' => array(
                    esc_html__("No", "surfy") => 'no',
                    esc_html__("Yes", "surfy") => 'yes',
                ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Package Price", "surfy"),
                "param_name" => "price",
                "description" => esc_html__("Enter the price for this package. e.g. '157'", "surfy")
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Price Prefix", "surfy"),
                "param_name" => "price_prefix",
                "description" => esc_html__("Enter the price prefix for this package. e.g. '$'", "surfy")
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Price Suffix", "surfy"),
                "param_name" => "price_suffix",
                "description" => esc_html__("Enter the price suffix for this package. e.g. '$'", "surfy")
            ),
            array(
                "type" => "textarea",
                "heading" => esc_html__("Package description", "surfy"),
                "param_name" => "price_description",
                "description" => esc_html__("Enter the package short description", "surfy")
            ),
            array(
                "type" => "vc_link",
                "heading" => esc_html__("Link", "surfy"),
                "param_name" => "button_link",
            ),
            array(
                "type" => "textarea_html",
                "heading" => esc_html__("Price field", "surfy"),
                "param_name" => "content",
            ),
            // General Params
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", "surfy"),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "surfy")
            ),

        ),

    ));

    class WPBakeryShortCode_Gt3_Price_block extends WPBakeryShortCode { }

}