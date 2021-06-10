<?php

include_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (!class_exists('Vc_Manager')) {
    return;
}

    require_once get_template_directory() . '/core/vc/custom_types/gt3_on_off.php';
	require_once get_template_directory() . '/core/vc/custom_types/gt3_packery_layout_select.php';	
	require_once get_template_directory() . '/core/vc/custom_types/gt3_element_pos.php';
	require_once get_template_directory() . '/core/vc/custom_types/image_select.php';

add_action('vc_before_init', 'gt3_vcSetAsTheme');
function gt3_vcSetAsTheme() {
    vc_set_as_theme($disable_updater = true);
}

/* List of Active VC Modules */
$gt3_vc_modules = array(
    'gt3_blog',
    'gt3_counter',
    'gt3_featured_posts',
    'gt3_carousel',
    'gt3_price_block',
    'gt3_team',
    'gt3_testimonials',
    'gt3_icon_box',
    'gt3_message_box',
    'gt3_button',
    'gt3_custom_text',
    'gt3_process_bar',
    'gt3_countdown',
    'gt3_video_popup',
    'gt3_services',
    'gt3_image_box',
    'gt3_gallery_packery',
    'gt3_spacing'
);

foreach ($gt3_vc_modules as $gt3_vc_module) {
    require_once get_template_directory() . '/core/vc/modules/' . $gt3_vc_module . '/init.php';
}

vc_remove_param( 'vc_tta_tabs', 'style' );
vc_remove_param( 'vc_tta_tabs', 'shape' );
vc_remove_param( 'vc_tta_tabs', 'color' );
vc_remove_param( 'vc_tta_tabs', 'spacing' );
vc_remove_param( 'vc_tta_tabs', 'gap' );
vc_remove_param( 'vc_tta_tabs', 'pagination_style' );
vc_remove_param( 'vc_tta_tabs', 'pagination_color' );
vc_remove_param( 'vc_tta_tabs', 'no_fill_content_area' );


vc_remove_param( 'vc_tta_tour', 'style' );
vc_remove_param( 'vc_tta_tour', 'shape' );
vc_remove_param( 'vc_tta_tour', 'color' );
vc_remove_param( 'vc_tta_tour', 'spacing' );
vc_remove_param( 'vc_tta_tour', 'gap' );
vc_remove_param( 'vc_tta_tour', 'pagination_style' );
vc_remove_param( 'vc_tta_tour', 'pagination_color' );
vc_remove_param( 'vc_tta_tour', 'no_fill_content_area' );

vc_remove_param( 'vc_tta_accordion', 'color' );
vc_remove_param( 'vc_tta_accordion', 'spacing' );
vc_remove_param( 'vc_tta_accordion', 'gap' );
vc_remove_param( 'vc_tta_accordion', 'shape' );
vc_remove_param( 'vc_tta_accordion', 'no_fill' );
vc_add_param( 'vc_tta_accordion' , array(
    'type' => 'dropdown',
    'heading' => "Accordion Style",
    'param_name' => 'style',
    'value' => array(
        esc_html__( 'Classic', 'surfy' ) => "classic",
        esc_html__( 'Alternative', 'surfy' ) => "accordion_alternative",
        esc_html__( 'Solid', 'surfy' ) => "accordion_solid",
        esc_html__( 'In Border', 'surfy' ) => "accordion_bordered",
    )
));

vc_remove_param( 'vc_toggle', 'use_custom_heading' );
vc_remove_param( 'vc_toggle', 'custom_font_container' );
vc_remove_param( 'vc_toggle', 'custom_use_theme_fonts' );
vc_remove_param( 'vc_toggle', 'custom_google_fonts' );
vc_remove_param( 'vc_toggle', 'custom_css_animation' );
vc_remove_param( 'vc_toggle', 'custom_el_class' );

vc_add_param( 'vc_toggle' , array(
    'type' => 'dropdown',
    'heading' => "Style",
    'param_name' => 'style',
    'value' => array(
        esc_html__( 'Classic', 'surfy' ) => "classic",
        esc_html__( 'Alternative', 'surfy' ) => "accordion_alternative",
        esc_html__( 'Solid', 'surfy' ) => "accordion_solid",
        esc_html__( 'In Border', 'surfy' ) => "accordion_bordered",
    )
));
vc_add_param( 'vc_toggle' , array(
    'type' => 'dropdown',
    'heading' => "Icon",
    "param_name" => "color",
    'value' => array(
        esc_html__( 'None', 'surfy' ) => "none",
        esc_html__( 'Chevron', 'surfy' ) => "chevron",
        esc_html__( 'Plus', 'surfy' ) => "plus",
        esc_html__( 'Triangle', 'surfy' ) => "triangle",
    )
));
vc_add_param( 'vc_toggle' , array(
    'type' => 'dropdown',
    'heading' => "Icon Position",
    "param_name" => "size",
    'value' => array(
        esc_html__( 'Left', 'surfy' ) => "left",
        esc_html__( 'Right', 'surfy' ) => "right",
    )
));

vc_add_param("vc_separator",array(
    'type' => 'dropdown',
    'heading' => esc_html__( 'Element width', 'surfy' ),
    'param_name' => 'el_width',
    'value' => array(
        '100%' => '',
        '90%' => '90',
        '80%' => '80',
        '70%' => '70',
        '60%' => '60',
        '50%' => '50',
        '40%' => '40',
        '30%' => '30',
        '20%' => '20',
        '10%' => '10',
        '40px' => '40px',
        ),
    'description' => esc_html__( 'Select separator width (percentage or px).', 'surfy' ),
));

/* Row Settings */
vc_add_param( 'vc_row' , array(
    'type' => 'checkbox',
    'heading' => esc_html__( 'Reverse Columns in Mobile', 'surfy' ),
    'param_name' => 'reverse_columns_in_mobile',
    'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
));

vc_add_param( 'vc_row' , array(
    'type' => 'checkbox',
    'heading' => esc_html__( 'Enable column separator?', 'surfy' ),
    'param_name' => 'column_separator_row',
    'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
));

vc_add_param( 'vc_row' , array(
    'type' => 'colorpicker',
    'heading' => esc_html__( 'Column separator color', 'surfy' ),
    'param_name' => 'column_separator_color_row',
    'dependency' => array(
        'element' => 'column_separator_row',
        'not_empty' => true,
    ),
));



/* Row Settings */
vc_add_param( 'vc_row' , array(
    'type' => 'checkbox',
    'heading' => esc_html__( 'Enable column separator?', 'surfy' ),
    'param_name' => 'column_separator_row',
    'std' => 'no',
    'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
));

vc_add_param( 'vc_row' , array(
    'type' => 'colorpicker',
    'heading' => esc_html__( 'Column separator color', 'surfy' ),
    'param_name' => 'column_separator_color_row',
    'dependency' => array(
        'element' => 'column_separator_row',
        'not_empty' => true,
    ),
));

vc_add_param( 'vc_row' , array(
    'type' => 'checkbox',
    'heading' => esc_html__( 'Add Mask?', 'surfy' ),
    'param_name' => 'masked_row',
    'std' => 'no',
    'edit_field_class' => 'vc_col-sm-4',
    'group' => esc_html__( 'Design Options', 'surfy' ),
));

vc_add_param( 'vc_row' , array(
    'type' => 'attach_image',
    'heading' => esc_html__( 'Mask', 'surfy' ),
    'param_name' => 'mask_image',
    'value' => '',
    'description' => esc_html__( 'Need .png image with solid color', 'surfy' ),
    'edit_field_class' => 'vc_col-sm-8',
    'group' => esc_html__( 'Design Options', 'surfy' ),
    'dependency' => array(
        'element' => 'masked_row',
        'value' => "true",
    ),
));


/* Row inner Settings */
vc_add_param( 'vc_row_inner' , array(
    'type' => 'checkbox',
    'heading' => esc_html__( 'Enable column separator?', 'surfy' ),
    'param_name' => 'column_separator_row_inner',
    'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
));

vc_add_param( 'vc_row_inner' , array(
    'type' => 'colorpicker',
    'heading' => esc_html__( 'Column separator color', 'surfy' ),
    'param_name' => 'column_separator_color_row_inner',
    'dependency' => array(
        'element' => 'column_separator_row_inner',
        'not_empty' => true,
    ),
));

/* Separator with Text Settings */
vc_add_param( 'vc_text_separator' , array(
    'type' => 'checkbox',
    'heading' => esc_html__( 'Enable custom text color?', 'surfy' ),
    'param_name' => 'text_separator_custom_color',
    'value' => array( esc_html__( 'Yes', 'surfy' ) => 'yes' ),
));

vc_add_param( 'vc_text_separator' , array(
    'type' => 'colorpicker',
    'heading' => esc_html__( 'Custom text color', 'surfy' ),
    'param_name' => 'text_separator_custom_color_value',
    'value' => esc_attr(gt3_option("theme-custom-color")),
    'dependency' => array(
        'element' => 'text_separator_custom_color',
        'not_empty' => true,
    ),
));