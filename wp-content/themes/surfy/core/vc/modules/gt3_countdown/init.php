<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$header_font = gt3_option('header-font');
$main_font = gt3_option('main-font');

if (function_exists('vc_map')) {
// Add list item
    vc_map(array(
        "name" => esc_html__("Countdown", "surfy"),
        "base" => "gt3_countdown",
        "class" => "gt3_countdown",
        "category" => esc_html__('GT3 Modules', 'surfy'),
        "icon" => 'gt3_icon',
        "content_element" => true,
        "description" => esc_html__("Countdown","surfy"),
        "params" => array(
            array(
                "type"          => "backend_divider",
                "heading" => esc_html__("Countdown Date:", "surfy"),
                "param_name"    => "backend_divider",
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Year", "surfy"),
                "param_name" => "countdown_year",
                "description" => esc_html__("Enter year EX.: 2018", "surfy"),
                'edit_field_class' => 'vc_col-sm-2',
            ),
             array(
                "type" => "textfield",
                "heading" => esc_html__("Month", "surfy"),
                "param_name" => "countdown_month",
                "description" => esc_html__("Enter month EX.: 08", "surfy"),
                'edit_field_class' => 'vc_col-sm-2',
            ),
              array(
                "type" => "textfield",
                "heading" => esc_html__("Day", "surfy"),
                "param_name" => "countdown_day",
                "description" => esc_html__("Enter day EX.: 20", "surfy"),
                'edit_field_class' => 'vc_col-sm-2',
            ),
                array(
                "type" => "textfield",
                "heading" => esc_html__("Hours", "surfy"),
                "param_name" => "countdown_hours",
                "description" => esc_html__("Enter hours EX.: 13", "surfy"),
                'edit_field_class' => 'vc_col-sm-2',
            ),
              array(
                "type" => "textfield",
                "heading" => esc_html__("Minutes", "surfy"),
                "param_name" => "countdown_min",
                "description" => esc_html__("Enter min. EX.: 24", "surfy"),
                'edit_field_class' => 'vc_col-sm-2',
            ),

                            
        )
    ));
    
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_gt3_countdown extends WPBakeryShortCode {

            
        }
    } 
}