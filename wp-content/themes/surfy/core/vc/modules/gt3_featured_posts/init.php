<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$header_font = gt3_option('header-font');
$main_font = gt3_option('main-font');

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_featured_posts',
        'name' => esc_html__('Featured Blog Posts', 'surfy'),
        "description" => esc_html__("Display the featured blog posts", "surfy"),
        'category' => esc_html__('GT3 Modules', 'surfy'),
        'icon' => 'gt3_icon',
        'params' => array(
            array(
                'type' => 'loop',
                'heading' => esc_html__('Blog Items', 'surfy'),
                'param_name' => 'build_query',
                'settings' => array(
                    'size' => array('hidden' => false, 'value' => 4 * 3),
                    'order_by' => array('value' => 'date'),
                    'post_type' => array('value' => 'post', 'hidden' => true),
                    'categories' => array('hidden' => false),
                    'tags' => array('hidden' => false)
                ),
                'description' => esc_html__('Create WordPress loop, to populate content from your site.', 'surfy')
            ),
            // Module Title
            array(
                "type" => "textarea_html",
                'heading' => esc_html__('Module title', 'surfy'),
                "param_name" => "content",
                "value" => "",
                "description" => esc_html__("Enter text used as module title (Note: located above content element).", "surfy")
            ),
            // Link Text
            array(
                "type" => "textfield",
                "heading" => esc_html__("Module Link Text", "surfy"),
                "param_name" => "external_link_text",
                "value" => "",
                "description" => esc_html__("Text on the module link.", "surfy"),
            ),
            // Link Setts
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Module Link', 'surfy' ),
                'param_name' => 'external_link',
                "dependency" => Array("element" => "external_link_text", "not_empty" => true),
            ),
            // View Type
            array(
                'type' => 'gt3_dropdown',
                'class' => '',
                'heading' => esc_html__('Style select', 'surfy'),
                'param_name' => 'view_type',
                'fields' => array(
                    'type1' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/blog_type1.jpg',
                        'descr' => esc_html__('Type 1', 'surfy')),
                    'type2' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/blog_type2.jpg',
                        'descr' => esc_html__('Type 2', 'surfy')),
                    'type3' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/blog_type3.jpg',
                        'descr' => esc_html__('Type 3', 'surfy')),
                    'type4' => array(
                        'image' => get_template_directory_uri() . '/img/gt3_composer_addon/blog_type4.jpg',
                        'descr' => esc_html__('Type 4', 'surfy')),
                ),
                'value' => 'type4',
            ),
            // Post meta
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Allow uppercase post-meta text?', 'surfy' ),
                'param_name' => 'post_meta_uppercase',
                'description' => esc_html__( 'If checked, allow uppercase post-meta text.', 'surfy' ),
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'yes'
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Module on dark background?', 'surfy' ),
                'param_name' => 'module_on_dark_bg',
                'description' => esc_html__( 'If checked, change title and Module Link color.', 'surfy' ),
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'no'
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show post-meta author?', 'surfy' ),
                'param_name' => 'meta_author',
                'description' => esc_html__( 'If checked, post-meta will have author.', 'surfy' ),
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'yes',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show post-meta comments?', 'surfy' ),
                'param_name' => 'meta_comments',
                'description' => esc_html__( 'If checked, post-meta will have comments.', 'surfy' ),
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'yes',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show post-meta categories?', 'surfy' ),
                'param_name' => 'meta_categories',
                'description' => esc_html__( 'If checked, post-meta will have categories.', 'surfy' ),
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'yes',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show post-meta date?', 'surfy' ),
                'param_name' => 'meta_date',
                'description' => esc_html__( 'If checked, post-meta will have date.', 'surfy' ),
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'yes',
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Post Format Label
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show post-format label?', 'surfy' ),
                'param_name' => 'pf_post_icon',
                'description' => esc_html__( 'If checked, post-format label is visible.', 'surfy' ),
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'edit_field_class' => 'vc_col-sm-4',
                "dependency" => Array("element" => "view_type","value" => array("type4"))
            ),
            // Post Read More Link
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Show post read more link?', 'surfy' ),
                'param_name' => 'post_read_more_link',
                'description' => esc_html__( 'If checked, post read more link is visible.', 'surfy' ),
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'edit_field_class' => 'vc_col-sm-4',
                "dependency" => Array("element" => "view_type","value" => array("type2", "type4"))
            ),
            // Post Read More Link
            array(
                'type' => 'checkbox',
                'heading' => esc_html__('Allow boxed text content?', 'surfy' ),
                'param_name' => 'boxed_text_content',
                'description' => esc_html__( 'If checked, allow boxed text content.', 'surfy' ),
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'edit_field_class' => 'vc_col-sm-4',
                "dependency" => Array("element" => "view_type","value" => array("type3", "type4")),
                'std' => 'yes'
            ),
            // Image Proportions
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Image Proportions', 'surfy' ),
                'param_name' => 'image_proportions',
                "value"         => array(
                    esc_html__( '4/3', 'surfy' ) => '4_3',
                    esc_html__( 'Horizontal', 'surfy' ) => 'horizontal',
                    esc_html__( 'Vertical', 'surfy' ) => 'vertical',
                    esc_html__( 'Square', 'surfy' ) => 'square',
                    esc_html__( 'Original', 'surfy' ) => 'original'
                ),
                "description" => esc_html__("Select image proportions.", "surfy"),
                "dependency" => Array("element" => "view_type","value" => array("type3", "type4")),
            ),
            // Items per line
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Items Per Line', 'surfy' ),
                'param_name' => 'items_per_line',
                "value"         => array(
                    esc_html__( '1', 'surfy' ) => '1',
                    esc_html__( '2', 'surfy' ) => '2',
                    esc_html__( '3', 'surfy' ) => '3',
                    esc_html__( '4', 'surfy' ) => '4'
                ),
                "description" => esc_html__("Select post items per line.", "surfy"),
                "dependency" => Array("element" => "view_type","value" => array("type3", "type4")),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Items Per Line', 'surfy' ),
                'param_name' => 'items_per_line_type2',
                "value"         => array(
                    esc_html__( '1', 'surfy' ) => '1',
                    esc_html__( '2', 'surfy' ) => '2'
                ),
                "description" => esc_html__("Select post items per line.", "surfy"),
                "dependency" => Array("element" => "view_type","value" => array("type2")),
            ),
            // Spacing beetween items
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Spacing beetween items', 'surfy' ),
                'param_name' => 'spacing_beetween_items',
                "value"         => array(
                    esc_html__( '30px', 'surfy' )      => '30',
                    esc_html__( '25px', 'surfy' )      => '25',
                    esc_html__( '20px', 'surfy' )      => '20',
                    esc_html__( '15px', 'surfy' )      => '15',
                    esc_html__( '10px', 'surfy' )      => '10',
                    esc_html__( '5px', 'surfy' )      => '5'
                ),
                "description" => esc_html__("Select spacing beetween items.", "surfy"),
                "dependency" => Array("element" => "view_type","value" => array("type2", "type3", "type4")),
            ),
            // Post meta position
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Post meta position', 'surfy' ),
                'param_name' => 'meta_position',
                "value"         => array(
                    esc_html__( 'Before Title', 'surfy' ) => 'before_title',
                    esc_html__( 'After Title', 'surfy' ) => 'after_title'
                ),
                "description" => esc_html__("Select post-meta position.", "surfy"),
                "dependency" => Array("element" => "view_type","value" => array("type2", "type3", "type4")),
            ),
            // Content alignment
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Content alignment', 'surfy' ),
                'param_name' => 'content_alignment',
                "value"         => array(
                    esc_html__( 'Left', 'surfy' ) => 'left',
                    esc_html__( 'Center', 'surfy' ) => 'center',
                    esc_html__( 'Right', 'surfy' ) => 'right',
                    esc_html__( 'Justify', 'surfy' ) => 'justify'
                ),
                "description" => esc_html__("Select content alignment.", "surfy"),
                "dependency" => Array("element" => "view_type","value" => array("type3", "type4")),
            ),
            // Content Letter Count
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Content Letter Count', 'surfy'),
                'param_name' => 'content_letter_count',
                'value' => '85',
                'description' => esc_html__( 'Enter content letter count.', 'surfy' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // --- CAROUSEL GROUP --- //
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use blog-posts carousel?', 'surfy' ),
                'param_name' => 'use_carousel',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                "group" => esc_html__( "Carousel", 'surfy' )
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Autoplay carousel', 'surfy' ),
                'param_name' => 'autoplay_carousel',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'yes',
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value" => array("yes")
                ),
                "group" => esc_html__( "Carousel", 'surfy' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Autoplay time.', 'surfy' ),
                'param_name' => 'auto_play_time',
                'value' => '3000',
                'description' => esc_html__( 'Enter autoplay time in milliseconds.', 'surfy' ),
                'dependency' => array(
                    'element' => 'autoplay_carousel',
                    'value' => array("yes"),
                ),
                "group" => esc_html__( "Carousel", 'surfy' ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Single slide to scroll', 'surfy' ),
                'param_name' => 'scroll_items',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                "group" => esc_html__( "Carousel", 'surfy' ),
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value" => array("yes")
                ),
                'std' => 'yes',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Infinite Scroll', 'surfy' ),
                'param_name' => 'infinite_scroll',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'yes',
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value" => array("yes")
                ),
                "group" => esc_html__( "Carousel", 'surfy' ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Hide Pagination control', 'surfy' ),
                'param_name' => 'use_pagination_carousel',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value" => array("yes")
                ),
                "group" => esc_html__( "Carousel", 'surfy' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Hide prev/next buttons', 'surfy' ),
                'param_name' => 'use_prev_next_carousel',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value" => array("yes")
                ),
                "group" => esc_html__( "Carousel", 'surfy' ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Adaptive Height', 'surfy' ),
                'param_name' => 'adaptive_height',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'std' => 'yes',
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value" => array("yes")
                ),
                "group" => esc_html__( "Carousel", 'surfy' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Items Per Column', 'surfy' ),
                'param_name' => 'items_per_column',
                "value"         => array(
                    esc_html__( '1', 'surfy' ) => '1',
                    esc_html__( '2', 'surfy' ) => '2',
                    esc_html__( '3', 'surfy' ) => '3',
                    esc_html__( '4', 'surfy' ) => '4'
                ),
                "description" => esc_html__("Select post items per column.", "surfy"),
                'dependency' => array(
                    'element' => 'use_carousel',
                    "value" => array("yes")
                ),
                "group" => esc_html__( "Carousel", 'surfy' ),
            ),
            // --- CUSTOM GROUP --- //
            // Blog Font
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for blog?', 'surfy' ),
                'param_name' => 'use_theme_fonts_blog',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'surfy' ),
                "group" => esc_html__( "Custom", 'surfy' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_blog',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'surfy' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'surfy' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_blog',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'surfy' ),
            ),
            // Blog Headings Font
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default font family for blog headings?', 'surfy' ),
                'param_name' => 'use_theme_fonts_blog_headings',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'description' => esc_html__( 'Use font family from the theme.', 'surfy' ),
                "group" => esc_html__( "Custom", 'surfy' ),
                'std' => 'yes',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_blog_headings',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'surfy' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'surfy' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'use_theme_fonts_blog_headings',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'surfy' ),
            ),
            array(
                'type' => 'checkbox',
                'heading' => esc_html__( 'Use theme default blog style?', 'surfy' ),
                'param_name' => 'use_theme_blog_style',
                'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
                'description' => esc_html__( 'Use default blog style from the theme.', 'surfy' ),
                "group" => esc_html__( "Custom", 'surfy' ),
                'std' => 'yes',
            ),
            // Custom blog style
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Custom Theme Color", "surfy"),
                "param_name" => "custom_theme_color",
                "value" => esc_attr(gt3_option("theme-custom-color")),
                "description" => esc_html__("Select custom theme color.", "surfy"),
                'dependency' => array(
                    'element' => 'use_theme_blog_style',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'surfy' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Custom Headings Color", "surfy"),
                "param_name" => "custom_headings_color",
                "value" => esc_attr($header_font['color']),
                "description" => esc_html__("Select custom headings color.", "surfy"),
                'dependency' => array(
                    'element' => 'use_theme_blog_style',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'surfy' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Custom Content Color", "surfy"),
                "param_name" => "custom_content_color",
                "value" => esc_attr($main_font['color']),
                "description" => esc_html__("Select custom content color.", "surfy"),
                'dependency' => array(
                    'element' => 'use_theme_blog_style',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'surfy' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Heading Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Heading Font Size', 'surfy'),
                'param_name' => 'heading_font_size',
                'value' => '18',
                'description' => esc_html__( 'Enter heading font-size in pixels.', 'surfy' ),
                'dependency' => array(
                    'element' => 'use_theme_blog_style',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'surfy' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Heading Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Content Font Size', 'surfy'),
                'param_name' => 'content_font_size',
                'value' => '16',
                'description' => esc_html__( 'Enter content font-size in pixels.', 'surfy' ),
                'dependency' => array(
                    'element' => 'use_theme_blog_style',
                    'value_not_equal_to' => 'yes',
                ),
                "group" => esc_html__( "Custom", 'surfy' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            vc_map_add_css_animation( true ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", "surfy"),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "surfy")
            ),
        ),

    ));

    class WPBakeryShortCode_Gt3_Featured_Posts extends WPBakeryShortCode
    {
    }
}