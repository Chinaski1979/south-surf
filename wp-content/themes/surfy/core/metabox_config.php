<?php


if (!class_exists( 'RWMB_Loader' )) {
	return;
}


add_filter( 'rwmb_meta_boxes', 'gt3_practices_meta_boxes' );
function gt3_practices_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Practice Options', 'surfy' ),
        'post_types' => array( 'practice' ),
        'context' => 'advanced',
        'fields'     => array(
	        array(
				'name'     => esc_html__( 'Icons', 'surfy' ),
				'id'          => "icon_selection",
				'type'        => 'select_icon',
				'options'     => gt3_get_all_icon(),
				'placeholder' => esc_html__( 'Select an icon', 'surfy' ),
				'multiple'    => false,
				'std'         => 'default',
			),
        ),
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_pteam_meta_boxes' );
function gt3_pteam_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Team Options', 'surfy' ),
        'post_types' => array( 'team' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
	            'name' => esc_html__( 'Info Name Position', 'surfy' ),
	            'id'   => 'position_member_title',
	            'type' => 'text',
	            'class' => 'name-field'
	        ),
        	array(
	            'name' => esc_html__( 'Member Positions', 'surfy' ),
	            'id'   => 'position_member',
	            'type' => 'text',
	            'clone' => true,
	            'sort_clone'     => true,
	            'class' => 'field-inputs'
	        ),
	        array(
	        	'name' => esc_html__( 'Info Name Location', 'surfy' ),
	            'id'   => 'location_title',
	            'type' => 'text',
	            'class' => 'name-field'
	        ),
	        array(
	        	'name' => esc_html__( 'Member Location', 'surfy' ),
	            'id'   => 'location_member',
	            'type' => 'text',
	            'clone' => true,
	            'sort_clone'     => true,
	            'class' => 'field-inputs',
	        ),
	        array(
	        	'name' => esc_html__( 'Info Experience', 'surfy' ),
	            'id'   => 'experience_title',
	            'type' => 'text',
	            'class' => 'name-field'
	        ),
	        array(
	        	'name' => esc_html__( 'Member Experience', 'surfy' ),
	            'id'   => 'experience_member',
	            'type' => 'text',
	            'clone' => true,
	            'sort_clone'     => true,
	            'class' => 'field-inputs',
	        ),
	        array(
	        	'name' => esc_html__( 'Info Email', 'surfy' ),
	            'id'   => 'email_title',
	            'type' => 'text',
	            'class' => 'name-field'
	        ),
	        array(
	        	'name' => esc_html__( 'Member Email', 'surfy' ),
	            'id'   => 'email_member',
	            'type' => 'text',
	            'clone' => true,
	            'sort_clone'     => true,
	            'class' => 'field-inputs',
	        ),
			array(
				'name' => esc_html__( 'Link to', 'surfy' ),
	            'id'   => 'social_url',
	            'type' => 'social',
	            'clone' => true,
	            'sort_clone'     => true,
	            'desc' => esc_html__( 'Description', 'surfy' ),
	            'options' => array(
					'name'    => array(
						'name' => esc_html__( 'Name', 'surfy' ),
						'type_input' => "text"
						),
					'address' => array(
						'name' => esc_html__( 'Url', 'surfy' ),
						'type_input' => "text"
						),
					'description' => array(
						'name' => esc_html__( 'Description', 'surfy' ),
						'type_input' => "text"
						),
				),
	        ),
	        array(
	            'name' => esc_html__( 'Phones Name', 'surfy' ),
	            'id'   => 'phone_title',
	            'type' => 'text',
	            'class' => 'name-field'
	        ),
	        array(
	            'name' => esc_html__( 'Phone Numbers', 'surfy' ),
	            'id'   => 'phone_number',
	            'type' => 'text',
	            'clone' => true,
	            'sort_clone'     => true,
	            'class' => 'field-inputs',
	        ),
	        array(
				'name'     => esc_html__( 'Icons', 'surfy' ),
				'id'          => "icon_selection",
				'type'        => 'select_icon',
				'options'     => function_exists('gt3_get_all_icon') ? gt3_get_all_icon() : '',
				'clone' => true,
				'sort_clone'     => true,
				'placeholder' => esc_html__( 'Select an icon', 'surfy' ),
				'multiple'    => false,
				'std'         => 'default',
			),
        ),
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_blog_meta_boxes' );
function gt3_blog_meta_boxes( $meta_boxes ) {
	$meta_boxes[] = array(
		'title'      => esc_html__( 'Post Format Layout', 'surfy' ),
		'post_types' => array( 'post' ),
		'context' => 'advanced',
		'fields'     => array(
			// Standard Post Format
			array(
				'name'             => esc_html__( 'You can use only featured image for this post-format', 'surfy' ),
				'id'               => "post_format_standard",
				'type'             => 'static-text',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','0'),
							array('post-format-selector-0','=','standard')
						),
					),
				),
			),
			// Gallery Post Format
			array(
				'name'             => esc_html__( 'Gallery images', 'surfy' ),
				'id'               => "post_format_gallery_images",
				'type'             => 'image_advanced',
				'max_file_uploads' => '',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','gallery'),
							array('post-format-selector-0','=','gallery')
						),
					),
				),
			),
			// Video Post Format
			array(
				'name' => esc_html__( 'oEmbed', 'surfy' ),
				'id'   => "post_format_video_oEmbed",
				'desc' => esc_html__( 'enter URL', 'surfy' ),
				'type' => 'oembed',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','video'),
							array('post-format-selector-0','=','video')
						),
						array(
							array('post_format_video_select','=','oEmbed')
						)
					),
				),
			),
			// Audio Post Format
			array(
				'name' => esc_html__( 'oEmbed', 'surfy' ),
				'id'   => "post_format_audio_oEmbed",
				'desc' => esc_html__( 'enter URL', 'surfy' ),
				'type' => 'oembed',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','audio'),
							array('post-format-selector-0','=','audio')
						),
						array(
							array('post_format_audio_select','=','oEmbed')
						)
					),
				),
			),
			// Quote Post Format
			array(
				'name'             => esc_html__( 'Quote Author', 'surfy' ),
				'id'               => "post_format_qoute_author",
				'type'             => 'text',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','quote'),
							array('post-format-selector-0','=','quote')
						),
					),
				),
			),
			array(
				'name'             => esc_html__( 'Quote Content', 'surfy' ),
				'id'               => "post_format_qoute_text",
				'type'             => 'textarea',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','quote'),
							array('post-format-selector-0','=','quote')
						),
					),
				),
			),
			// Link Post Format
			array(
				'name'             => esc_html__( 'Link URL', 'surfy' ),
				'id'               => "post_format_link",
				'type'             => 'url',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','link'),
							array('post-format-selector-0','=','link')
						),
					),
				),
			),
			array(
				'name'             => esc_html__( 'Link Text', 'surfy' ),
				'id'               => "post_format_link_text",
				'type'             => 'text',
				'attributes' => array(
					'data-dependency' => array(
						array(
							array('formatdiv','=','link'),
							array('post-format-selector-0','=','link')
						),
					),
				),
			),


		)
	);
	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_page_layout_meta_boxes' );
function gt3_page_layout_meta_boxes( $meta_boxes ) {

    $meta_boxes[] = array(
        'title'      => esc_html__( 'Page Layout', 'surfy' ),
        'post_types' => array( 'page' , 'post', 'team', 'practice', 'product' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
				'name'     => esc_html__( 'Page Sidebar Layout', 'surfy' ),
				'id'          => "mb_page_sidebar_layout",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'surfy' ),
					'none' => esc_html__( 'None', 'surfy' ),
					'left' => esc_html__( 'Left', 'surfy' ),
					'right' => esc_html__( 'Right', 'surfy' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),
			array(
				'name'     => esc_html__( 'Page Sidebar', 'surfy' ),
				'id'          => "mb_page_sidebar_def",
				'type'        => 'select',
				'options'     => gt3_get_all_sidebar(),
				'multiple'    => false,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_sidebar_layout','!=','default'),
						array('mb_page_sidebar_layout','!=','none'),
					)),
				),
			),
        )
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_logo_meta_boxes' );
function gt3_logo_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Logo Options', 'surfy' ),
        'post_types' => array( 'page' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
				'name'     => esc_html__( 'Logo', 'surfy' ),
				'id'          => "mb_customize_logo",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'surfy' ),
					'custom' => esc_html__( 'custom', 'surfy' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),
			array(
				'name'             => esc_html__( 'Header Logo', 'surfy' ),
				'id'               => "mb_header_logo",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_logo','=','custom')
					)),
				),
			),
			array(
				'id'   => 'mb_logo_height_custom',
				'name' => esc_html__( 'Enable Logo Height', 'surfy' ),
				'type' => 'checkbox',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_customize_logo','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Set Logo Height', 'surfy' ),
				'id'   => "mb_logo_height",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 50,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_logo','=','custom'),
						array('mb_logo_height_custom','=',true)
					)),
				),
			),
			array(
				'name' => esc_html__( 'Don\'t limit maximum height', 'surfy' ),
				'id'   => "mb_logo_max_height",
				'type' => 'checkbox',
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_logo','=','custom'),
						array('mb_logo_height_custom','=',true)
					)),
				),
			),
			array(
				'name' => esc_html__( 'Set Sticky Logo Height', 'surfy' ),
				'id'   => "mb_sticky_logo_height",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_logo','=','custom'),
						array('mb_logo_height_custom','=',true),
						array('mb_logo_max_height','=',true),
					)),
				),
			),
			array(
				'name'             => esc_html__( 'Sticky Logo', 'surfy' ),
				'id'               => "mb_logo_sticky",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_logo','=','custom')
					)),
				),
			),
			array(
				'name'             => esc_html__( 'Mobile Logo', 'surfy' ),
				'id'               => "mb_logo_mobile",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_logo','=','custom')
					)),
				),
			),
        )
    );
    return $meta_boxes;
}

//add_filter( 'rwmb_meta_boxes', 'gt3_header_option_meta_boxes' );
function gt3_header_option_meta_boxes( $meta_boxes ) {
	$meta_boxes[] = array(
        'title'      => esc_html__( 'Header Layout and Color', 'surfy' ),
        'post_types' => array( 'page' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
				'name'     => esc_html__( 'Header Settings', 'surfy' ),
				'id'          => "mb_customize_header_layout",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'surfy' ),
					'custom' => esc_html__( 'custom', 'surfy' ),
					'none' => esc_html__( 'none', 'surfy' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),
			// Top header settings
			array(
				'name'     => esc_html__( 'Top Header Settings', 'surfy' ),
				'id'          => "mb_customize_top_header_layout",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'surfy' ),
					'custom' => esc_html__( 'custom', 'surfy' ),
				),
				'multiple'    => false,
				'std'         => 'default',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Top Header Background', 'surfy' ),
				'id'   => "mb_top_header_background",
				'type' => 'color',
				'std'         => '#f5f5f5',
				'js_options' => array(
					'defaultColor' => '#f5f5f5',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_top_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Top Header Background Opacity', 'surfy' ),
				'id'   => "mb_top_header_background_opacity",
				'type' => 'number',
				'std'  => 0.44,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_top_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Text Color', 'surfy' ),
				'id'   => "mb_top_header_color",
				'type' => 'color',
				'std'         => '#94958d',
				'js_options' => array(
					'defaultColor' => '#94958d',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_top_header_layout','=','custom')
					)),
				),
			),
			array(
				'id'   => 'mb_top_header_bottom_border',
				'name' => esc_html__( 'Set Top Header Bottom Border', 'surfy' ),
				'type' => 'checkbox',
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_top_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Top Header Border color', 'surfy' ),
				'id'   => "mb_header_top_bottom_border_color",
				'type' => 'color',
				'std'         => '#000000',
				'js_options' => array(
					'defaultColor' => '#000000',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_top_header_layout','=','custom'),
						array('mb_top_header_bottom_border','=',true)
					)),
				),
			),
			array(
				'name' => esc_html__( 'Top Header Border Opacity', 'surfy' ),
				'id'   => "mb_header_top_bottom_border_color_opacity",
				'type' => 'number',
				'std'  => 0.1,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_top_header_layout','=','custom'),
						array('mb_top_header_bottom_border','=',true)
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Middle Header Settings', 'surfy' ),
				'id'          => "mb_customize_middle_header_layout",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'surfy' ),
					'custom' => esc_html__( 'custom', 'surfy' ),
				),
				'multiple'    => false,
				'std'         => 'default',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom')
					)),
				),
			),

			// Middle header settings
			array(
				'name' => esc_html__( 'Middle Header Background', 'surfy' ),
				'id'   => "mb_middle_header_background",
				'type' => 'color',
				'std'         => '#ffffff',
				'js_options' => array(
					'defaultColor' => '#ffffff',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_middle_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Middle Header Background Opacity', 'surfy' ),
				'id'   => "mb_middle_header_background_opacity",
				'type' => 'number',
				'std'  => 0.44,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_middle_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Middle Header Text Color', 'surfy' ),
				'id'   => "mb_middle_header_color",
				'type' => 'color',
				'std'         => '#000000',
				'js_options' => array(
					'defaultColor' => '#000000',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_middle_header_layout','=','custom')
					)),
				),
			),
			array(
				'id'   => 'mb_middle_header_bottom_border',
				'name' => esc_html__( 'Set Middle Header Bottom Border', 'surfy' ),
				'type' => 'checkbox',
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_middle_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Middle Header Border color', 'surfy' ),
				'id'   => "mb_header_middle_bottom_border_color",
				'type' => 'color',
				'std'         => '#000000',
				'js_options' => array(
					'defaultColor' => '#000000',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_middle_header_layout','=','custom'),
						array('mb_middle_header_bottom_border','=',true)
					)),
				),
			),
			array(
				'name' => esc_html__( 'Middle Header Border Opacity', 'surfy' ),
				'id'   => "mb_header_middle_bottom_border_color_opacity",
				'type' => 'number',
				'std'  => 0.1,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_middle_header_layout','=','custom'),
						array('mb_middle_header_bottom_border','=',true)
					)),
				),
			),

			// Bottom header settings
			array(
				'name'     => esc_html__( 'Bottom Header Settings', 'surfy' ),
				'id'          => "mb_customize_bottom_header_layout",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'surfy' ),
					'custom' => esc_html__( 'custom', 'surfy' ),
				),
				'multiple'    => false,
				'std'         => 'default',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Bottom Header Background', 'surfy' ),
				'id'   => "mb_bottom_header_background",
				'type' => 'color',
				'std'         => '#ffffff',
				'js_options' => array(
					'defaultColor' => '#ffffff',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_bottom_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Bottom Header Background Opacity', 'surfy' ),
				'id'   => "mb_bottom_header_background_opacity",
				'type' => 'number',
				'std'  => 0.44,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_bottom_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Bottom Header Text Color', 'surfy' ),
				'id'   => "mb_bottom_header_color",
				'type' => 'color',
				'std'         => '#000000',
				'js_options' => array(
					'defaultColor' => '#000000',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_bottom_header_layout','=','custom')
					)),
				),
			),
			array(
				'id'   => 'mb_bottom_header_bottom_border',
				'name' => esc_html__( 'Set Bottom Header Bottom Border', 'surfy' ),
				'type' => 'checkbox',
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_bottom_header_layout','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Bottom Header Border color', 'surfy' ),
				'id'   => "mb_header_bottom_bottom_border_color",
				'type' => 'color',
				'std'         => '#000000',
				'js_options' => array(
					'defaultColor' => '#000000',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_bottom_header_layout','=','custom'),
						array('mb_bottom_header_bottom_border','=',true)
					)),
				),
			),
			array(
				'name' => esc_html__( 'Bottom Header Border Opacity', 'surfy' ),
				'id'   => "mb_header_bottom_bottom_border_color_opacity",
				'type' => 'number',
				'std'  => 0.1,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_customize_header_layout','=','custom'),
						array('mb_customize_bottom_header_layout','=','custom'),
						array('mb_bottom_header_bottom_border','=',true)
					)),
				),
			),





			//mobile options
			array(
				'id'   => 'mb_header_on_bg',
				'name' => esc_html__( 'Header Above Content', 'surfy' ),
				'type' => 'checkbox',
				'std'  => 0,
			),



			// Mobile Top header settings
			array(
				'name'     => esc_html__( 'Top Mobile Header Settings', 'surfy' ),
				'id'          => "mb_customize_top_header_layout_mobile",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'surfy' ),
					'custom' => esc_html__( 'custom', 'surfy' ),
				),
				'multiple'    => false,
				'std'         => 'default',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_header_on_bg','=','1')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Top Mobile Header Background', 'surfy' ),
				'id'   => "mb_top_header_background_mobile",
				'type' => 'color',
				'std'         => '#f5f5f5',
				'js_options' => array(
					'defaultColor' => '#f5f5f5',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_header_on_bg','=','1'),
						array('mb_customize_top_header_layout_mobile','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Top Mobile Header Background Opacity', 'surfy' ),
				'id'   => "mb_top_header_background_opacity_mobile",
				'type' => 'number',
				'std'  => 1,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_header_on_bg','=','1'),
						array('mb_customize_top_header_layout_mobile','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Top Mobile Header Text Color', 'surfy' ),
				'id'   => "mb_top_header_color_mobile",
				'type' => 'color',
				'std'         => '#94958d',
				'js_options' => array(
					'defaultColor' => '#94958d',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_header_on_bg','=','1'),
						array('mb_customize_top_header_layout_mobile','=','custom')
					)),
				),
			),



			// Mobile Middle header settings
			array(
				'name'     => esc_html__( 'Middle Mobile Header Settings', 'surfy' ),
				'id'          => "mb_customize_middle_header_layout_mobile",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'surfy' ),
					'custom' => esc_html__( 'custom', 'surfy' ),
				),
				'multiple'    => false,
				'std'         => 'default',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_header_on_bg','=','1')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Middle Mobile Header Background', 'surfy' ),
				'id'   => "mb_middle_header_background_mobile",
				'type' => 'color',
				'std'         => '#ffffff',
				'js_options' => array(
					'defaultColor' => '#ffffff',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_header_on_bg','=','1'),
						array('mb_customize_middle_header_layout_mobile','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Middle Mobile Header Background Opacity', 'surfy' ),
				'id'   => "mb_middle_header_background_opacity_mobile",
				'type' => 'number',
				'std'  => 1,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_header_on_bg','=','1'),
						array('mb_customize_middle_header_layout_mobile','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Middle Mobile Header Text Color', 'surfy' ),
				'id'   => "mb_middle_header_color_mobile",
				'type' => 'color',
				'std'         => '#000000',
				'js_options' => array(
					'defaultColor' => '#000000',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_header_on_bg','=','1'),
						array('mb_customize_middle_header_layout_mobile','=','custom')
					)),
				),
			),


			// Mobile Bottom header settings
			array(
				'name'     => esc_html__( 'Bottom Mobile Header Settings', 'surfy' ),
				'id'          => "mb_customize_bottom_header_layout_mobile",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'surfy' ),
					'custom' => esc_html__( 'custom', 'surfy' ),
				),
				'multiple'    => false,
				'std'         => 'default',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_header_on_bg','=','1')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Bottom Mobile Header Background', 'surfy' ),
				'id'   => "mb_bottom_header_background_mobile",
				'type' => 'color',
				'std'         => '#ffffff',
				'js_options' => array(
					'defaultColor' => '#ffffff',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_header_on_bg','=','1'),
						array('mb_customize_bottom_header_layout_mobile','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Bottom Mobile Header Background Opacity', 'surfy' ),
				'id'   => "mb_bottom_header_background_opacity_mobile",
				'type' => 'number',
				'std'  => 1,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_header_on_bg','=','1'),
						array('mb_customize_bottom_header_layout_mobile','=','custom')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Bottom Mobile Header Text Color', 'surfy' ),
				'id'   => "mb_bottom_header_color_mobile",
				'type' => 'color',
				'std'         => '#000000',
				'js_options' => array(
					'defaultColor' => '#000000',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_header_on_bg','=','1'),
						array('mb_customize_bottom_header_layout_mobile','=','custom')
					)),
				),
			),

        )

	);
	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_header_meta_boxes' );
function gt3_header_meta_boxes( $meta_boxes ) {
	$preset_opt = gt3_option('gt3_header_builder_presets');
	$presets_array = array();
	if (isset($preset_opt['current_active'])) {
        unset($preset_opt['current_active']);
    }
    if (isset($preset_opt['def_preset'])) {
        unset($preset_opt['def_preset']);
    }
    if (isset($preset_opt['items_count'])) {
        unset($preset_opt['items_count']);
    }
    $presets_array['default'] = esc_html__( 'Default from Theme Options', 'surfy' );
    if (!empty($preset_opt) && is_array($preset_opt)) {
		foreach ($preset_opt as $key => $value) {
			if (!empty($value['title'])) {
				$presets_array[$key] = $value['title'];
			}else{
				$presets_array[$key] = esc_html__( 'No Name', 'surfy' );
			}
		}
	}


    $meta_boxes[] = array(
        'title'      => esc_html__( 'Header Builder', 'surfy' ),
        'post_types' => array( 'page', 'post', 'team', 'practice', 'product' ),
        'context' => 'advanced',
        'fields'     => array(
			array(
				'name'     => esc_html__( 'Choose presets', 'surfy' ),
				'id'          => "mb_header_presets",
				'type'        => 'select',
				'options'     => $presets_array,
				'multiple'    => false,
				'std'         => 'default',
			),
        )
    );
    return $meta_boxes;
}


add_filter( 'rwmb_meta_boxes', 'gt3_page_title_meta_boxes' );
function gt3_page_title_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Page Title Options', 'surfy' ),
        'post_types' => array( 'page', 'post', 'team', 'practice', 'product' ),
        'context' => 'advanced',
        'fields'     => array(
			array(
				'name'     => esc_html__( 'Show Page Title', 'surfy' ),
				'id'          => "mb_page_title_conditional",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'surfy' ),
					'yes' => esc_html__( 'yes', 'surfy' ),
					'no' => esc_html__( 'no', 'surfy' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),
			array(
				'name' => esc_html__( 'Page Sub Title Text', 'surfy' ),
				'id'   => "mb_page_sub_title",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','!=','no'),
					)),
				),
			),
			array(
				'id'   => 'mb_show_breadcrumbs',
				'name' => esc_html__( 'Show Breadcrumbs', 'surfy' ),
				'type' => 'checkbox',
				'std'  => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Vertical Alignment', 'surfy' ),
				'id'       => 'mb_page_title_vertical_align',
				'type'     => 'select_advanced',
				'options'  => array(
					'top' => esc_html__( 'top', 'surfy' ),
					'middle' => esc_html__( 'middle', 'surfy' ),
					'bottom' => esc_html__( 'bottom', 'surfy' ),
				),
				'multiple' => false,
				'std'         => 'middle',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Horizontal Alignment', 'surfy' ),
				'id'       => 'mb_page_title_horizontal_align',
				'type'     => 'select_advanced',
				'options'  => array(
					'left' => esc_html__( 'left', 'surfy' ),
					'center' => esc_html__( 'center', 'surfy' ),
					'right' => esc_html__( 'right', 'surfy' ),
				),
				'multiple' => false,
				'std'         => 'left',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Font Color', 'surfy' ),
				'id'   => "mb_page_title_font_color",
				'type' => 'color',
				'std'         => '#ffffff',
				'js_options' => array(
					'defaultColor' => '#ffffff',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Background Color', 'surfy' ),
				'id'   => "mb_page_title_bg_color",
				'type' => 'color',
				'std'  => '#f5f5f5',
				'js_options' => array(
					'defaultColor' => '#f5f5f5',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'             => esc_html__( 'Page Title Background Image', 'surfy' ),
				'id'               => "mb_page_title_bg_image",
				'type'             => 'file_advanced',
				'max_file_uploads' => 1,
				'mime_type'        => 'image',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'id'   => 'mb_masked_row',
				'name' => esc_html__( 'Add Mask?', 'surfy' ),
				'type' => 'checkbox',
				'std'  => 1,
			),
			array(
				'name'             => esc_html__( 'Mask Image', 'surfy' ),
				'id'               => "mb_mask_image",
				'type'             => 'file_advanced',
				'max_file_uploads' => 1,
				'mime_type'        => 'image',
				'desc' => esc_html__( 'Need .png image with solid color', 'surfy' ),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_masked_row','=','1')
					)),
				),
			),

			array(
				'name'     => esc_html__( 'Background Repeat', 'surfy' ),
				'id'       => 'mb_page_title_bg_repeat',
				'type'     => 'select_advanced',
				'options'  => array(
					'no-repeat' => esc_html__( 'no-repeat', 'surfy' ),
					'repeat' => esc_html__( 'repeat', 'surfy' ),
					'repeat-x' => esc_html__( 'repeat-x', 'surfy' ),
					'repeat-y' => esc_html__( 'repeat-y', 'surfy' ),
					'inherit' => esc_html__( 'inherit', 'surfy' ),
				),
				'multiple' => false,
				'std'         => 'no-repeat',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Size', 'surfy' ),
				'id'       => 'mb_page_title_bg_size',
				'type'     => 'select_advanced',
				'options'  => array(
					'inherit' => esc_html__( 'inherit', 'surfy' ),
					'cover' => esc_html__( 'cover', 'surfy' ),
					'contain' => esc_html__( 'contain', 'surfy' )
				),
				'multiple' => false,
				'std'         => 'cover',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Attachment', 'surfy' ),
				'id'       => 'mb_page_title_bg_attachment',
				'type'     => 'select_advanced',
				'options'  => array(
					'fixed' => esc_html__( 'fixed', 'surfy' ),
					'scroll' => esc_html__( 'scroll', 'surfy' ),
					'inherit' => esc_html__( 'inherit', 'surfy' )
				),
				'multiple' => false,
				'std'         => 'scroll',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Position', 'surfy' ),
				'id'       => 'mb_page_title_bg_position',
				'type'     => 'select_advanced',
				'options'  => array(
					'left top' => esc_html__( 'left top', 'surfy' ),
					'left center' => esc_html__( 'left center', 'surfy' ),
					'left bottom' => esc_html__( 'left bottom', 'surfy' ),
					'center top' => esc_html__( 'center top', 'surfy' ),
					'center center' => esc_html__( 'center center', 'surfy' ),
					'center bottom' => esc_html__( 'center bottom', 'surfy' ),
					'right top' => esc_html__( 'right top', 'surfy' ),
					'right center' => esc_html__( 'right center', 'surfy' ),
					'right bottom' => esc_html__( 'right bottom', 'surfy' ),
				),
				'multiple' => false,
				'std'         => 'center center',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Height', 'surfy' ),
				'id'   => "mb_page_title_height",
				'type' => 'number',
				'std'  => 220,
				'min'  => 0,
				'step' => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_page_title_conditional','=','yes')
					)),
				),
			),
        ),
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_footer_meta_boxes' );
function gt3_footer_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => esc_html__( 'Footer Options', 'surfy' ),
        'post_types' => array( 'page' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
				'name'     => esc_html__( 'Show Footer', 'surfy' ),
				'id'          => "mb_footer_switch",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'surfy' ),
					'yes' => esc_html__( 'yes', 'surfy' ),
					'no' => esc_html__( 'no', 'surfy' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),
			array(
				'name'     => esc_html__( 'Footer Column', 'surfy' ),
				'id'          => "mb_footer_column",
				'type'        => 'select',
				'options'     => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'multiple'    => false,
				'std'         => '4',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Column 1', 'surfy' ),
				'id'          => "mb_footer_sidebar_1",
				'type'        => 'select',
				'options'     => gt3_get_all_sidebar(),
				'multiple'    => false,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Column 2', 'surfy' ),
				'id'          => "mb_footer_sidebar_2",
				'type'        => 'select',
				'options'     => gt3_get_all_sidebar(),
				'multiple'    => false,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','!=','1')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Column 3', 'surfy' ),
				'id'          => "mb_footer_sidebar_3",
				'type'        => 'select',
				'options'     => gt3_get_all_sidebar(),
				'multiple'    => false,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','!=','1'),
						array('mb_footer_column','!=','2')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Column 4', 'surfy' ),
				'id'          => "mb_footer_sidebar_4",
				'type'        => 'select',
				'options'     => gt3_get_all_sidebar(),
				'multiple'    => false,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','!=','1'),
						array('mb_footer_column','!=','2'),
						array('mb_footer_column','!=','3')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Column Layout', 'surfy' ),
				'id'          => "mb_footer_column2",
				'type'        => 'select',
				'options'     => array(
					'6-6' => '50% / 50%',
                    '3-9' => '25% / 75%',
                    '9-3' => '75% / 25%',
                    '4-8' => '33% / 66%',
                    '8-3' => '66% / 33%',
				),
				'multiple'    => false,
				'std'         => '6-6',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','=','2')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Column Layout', 'surfy' ),
				'id'          => "mb_footer_column3",
				'type'        => 'select',
				'options'     => array(
					'4-4-4' => '33% / 33% / 33%',
                    '3-3-6' => '25% / 25% / 50%',
                    '3-6-3' => '25% / 50% / 25%',
                    '6-3-3' => '50% / 25% / 25%',
				),
				'multiple'    => false,
				'std'         => '4-4-4',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes'),
						array('mb_footer_column','=','3')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Footer Title Text Align', 'surfy' ),
				'id'          => "mb_footer_align",
				'type'        => 'select',
				'options'     => array(
					'left' => 'Left',
                    'center' => 'Center',
                    'right' => 'Right'
				),
				'multiple'    => false,
				'std'         => 'left',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Padding Top (px)', 'surfy' ),
				'id'   => "mb_padding_top",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 55,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Padding Bottom (px)', 'surfy' ),
				'id'   => "mb_padding_bottom",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 55,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Padding Left (px)', 'surfy' ),
				'id'   => "mb_padding_left",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Padding Right (px)', 'surfy' ),
				'id'   => "mb_padding_right",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'id'   => 'mb_footer_full_width',
				'name' => esc_html__( 'Full Width Footer', 'surfy' ),
				'type' => 'checkbox',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Background Color', 'surfy' ),
				'id'   => "mb_footer_bg_color",
				'type' => 'color',
				'std'  => '#ffffff',
				'js_options' => array(
					'defaultColor' => '#ffffff',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Footer Text Color', 'surfy' ),
				'id'   => "mb_footer_text_color",
				'type' => 'color',
				'std'  => '#29343f',
				'js_options' => array(
					'defaultColor' => '#29343f',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Footer Heading Color', 'surfy' ),
				'id'   => "mb_footer_heading_color",
				'type' => 'color',
				'std'  => '#27323d',
				'js_options' => array(
					'defaultColor' => '#27323d',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'             => esc_html__( 'Footer Background Image', 'surfy' ),
				'id'               => "mb_footer_bg_image",
				'type'             => 'file_advanced',
				'max_file_uploads' => 1,
				'mime_type'        => 'image',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Repeat', 'surfy' ),
				'id'       => 'mb_footer_bg_repeat',
				'type'     => 'select_advanced',
				'options'  => array(
					'no-repeat' => esc_html__( 'no-repeat', 'surfy' ),
					'repeat' => esc_html__( 'repeat', 'surfy' ),
					'repeat-x' => esc_html__( 'repeat-x', 'surfy' ),
					'repeat-y' => esc_html__( 'repeat-y', 'surfy' ),
					'inherit' => esc_html__( 'inherit', 'surfy' ),
				),
				'multiple' => false,
				'std'         => 'repeat',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Size', 'surfy' ),
				'id'       => 'mb_footer_bg_size',
				'type'     => 'select_advanced',
				'options'  => array(
					'inherit' => esc_html__( 'inherit', 'surfy' ),
					'cover' => esc_html__( 'cover', 'surfy' ),
					'contain' => esc_html__( 'contain', 'surfy' )
				),
				'multiple' => false,
				'std'         => 'cover',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Attachment', 'surfy' ),
				'id'       => 'mb_footer_attachment',
				'type'     => 'select_advanced',
				'options'  => array(
					'fixed' => esc_html__( 'fixed', 'surfy' ),
					'scroll' => esc_html__( 'scroll', 'surfy' ),
					'inherit' => esc_html__( 'inherit', 'surfy' )
				),
				'multiple' => false,
				'std'         => 'scroll',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Background Position', 'surfy' ),
				'id'       => 'mb_footer_bg_position',
				'type'     => 'select_advanced',
				'options'  => array(
					'left top' => esc_html__( 'left top', 'surfy' ),
					'left center' => esc_html__( 'left center', 'surfy' ),
					'left bottom' => esc_html__( 'left bottom', 'surfy' ),
					'center top' => esc_html__( 'center top', 'surfy' ),
					'center center' => esc_html__( 'center center', 'surfy' ),
					'center bottom' => esc_html__( 'center bottom', 'surfy' ),
					'right top' => esc_html__( 'right top', 'surfy' ),
					'right center' => esc_html__( 'right center', 'surfy' ),
					'right bottom' => esc_html__( 'right bottom', 'surfy' ),
				),
				'multiple' => false,
				'std'         => 'center center',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),

			array(
				'id'   => 'mb_copyright_switch',
				'name' => esc_html__( 'Show Copyright', 'surfy' ),
				'type' => 'checkbox',
				'std'  => 1,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Editor', 'surfy' ),
				'id'   => "mb_copyright_editor",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name'     => esc_html__( 'Copyright Title Text Align', 'surfy' ),
				'id'       => 'mb_copyright_align',
				'type'     => 'select',
				'options'  => array(
					'left' => esc_html__( 'left', 'surfy' ),
					'center' => esc_html__( 'center', 'surfy' ),
					'right' => esc_html__( 'right', 'surfy' ),
				),
				'multiple' => false,
				'std'         => 'center',
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Padding Top (px)', 'surfy' ),
				'id'   => "mb_copyright_padding_top",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 20,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Padding Bottom (px)', 'surfy' ),
				'id'   => "mb_copyright_padding_bottom",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 20,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Padding Left (px)', 'surfy' ),
				'id'   => "mb_copyright_padding_left",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Padding Right (px)', 'surfy' ),
				'id'   => "mb_copyright_padding_right",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Background Color', 'surfy' ),
				'id'   => "mb_copyright_bg_color",
				'type' => 'color',
				'std'  => '#31373d',
				'js_options' => array(
					'defaultColor' => '#31373d',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
						array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Text Color', 'surfy' ),
				'id'   => "mb_copyright_text_color",
				'type' => 'color',
				'std'  => '#848d95',
				'js_options' => array(
					'defaultColor' => '#848d95',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'id'   => 'mb_copyright_top_border',
				'name' => esc_html__( 'Set Copyright Top Border?', 'surfy' ),
				'type' => 'checkbox',
				'std'  => 0,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes')
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Border Color', 'surfy' ),
				'id'   => "mb_copyright_top_border_color",
				'type' => 'color',
				'std'         => '#000000',
				'js_options' => array(
					'defaultColor' => '#000000',
				),
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes'),
						array('mb_copyright_top_border','=',true)
					)),
				),
			),
			array(
				'name' => esc_html__( 'Copyright Border Opacity', 'surfy' ),
				'id'   => "mb_copyright_top_border_color_opacity",
				'type' => 'number',
				'std'  => 0.1,
				'min'  => 0,
				'max'  => 1,
				'step' => 0.01,
				'attributes' => array(
				    'data-dependency'  =>  array( array(
				    	array('mb_copyright_switch','=',true),
						array('mb_footer_switch','=','yes'),
						array('mb_copyright_top_border','=',true)
					)),
				),
			),
        ),
     );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_contact_widget_meta_boxes' );
function gt3_contact_widget_meta_boxes( $meta_boxes ) {

    $meta_boxes[] = array(
        'title'      => esc_html__( 'Contact Widget', 'surfy' ),
        'post_types' => array( 'page' , 'post', 'team', 'practice' ),
        'context' => 'advanced',
        'fields'     => array(
        	array(
				'name'     => esc_html__( 'Display Contact Widget', 'surfy' ),
				'id'          => "mb_display_contact_widget",
				'type'        => 'select',
				'options'     => array(
					'default' => esc_html__( 'default', 'surfy' ),
					'on' => esc_html__( 'On', 'surfy' ),
					'off' => esc_html__( 'Off', 'surfy' ),
				),
				'multiple'    => false,
				'std'         => 'default',
			),
        )
    );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_shortcode_meta_boxes' );
function gt3_shortcode_meta_boxes( $meta_boxes ) {
	$meta_boxes[] = array(
		'title'      => esc_html__( 'Shortcode Above Content', 'surfy' ),
		'post_types' => array( 'page' ),
		'context' => 'advanced',
		'fields'     => array(
			array(
				'name' => esc_html__( 'Shortcode', 'surfy' ),
				'id'   => "mb_page_shortcode",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3
			),
		),
     );
    return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'gt3_single_product_meta_boxes' );
function gt3_single_product_meta_boxes( $meta_boxes ) {

	$meta_boxes[] = array(
		'title'      	=> esc_html__( 'Single Product Settings', 'surfy' ),
		'post_types' 	=> array( 'product' ),
		'context' 		=> 'advanced',
		'fields'     	=> array(
			array(
				'name' 			=> esc_html__( 'Single Product Page Settings', 'surfy' ),
				'id'          	=> "mb_single_product",
				'type'        	=> 'select',
				'options'     	=> array(
					'default' => esc_html__( 'default', 'surfy' ),
					'custom'  => esc_html__( 'Custom', 'surfy' ),
				),
				'multiple'    	=> false,
				'std'  			=> 'default',
			),

			array(
				'name' 			=> esc_html__( 'Product Page Layout', 'surfy' ),
				'id'          	=> "mb_product_container",
				'type'        	=> 'select',
				'options'     	=> array(
					'container' 	=> esc_html__( 'Container', 'surfy' ),
					'full_width' 	=> esc_html__( 'Full Width', 'surfy' ),
				),
				'multiple'    	=> false,
				'std'  			=> 'container',
				'attributes' 	=>  array(
					'data-dependency' => array( array(
						array('mb_single_product','=','custom')
					)),
				),
			),
			array(
				'name' 			=> esc_html__( 'Size Guide for this product', 'surfy' ),
				'id'          	=> "mb_img_size_guide",
				'type'        	=> 'select',
				'options'     	=> array(
					'default' => esc_html__( 'default', 'surfy' ),
					'custom'  => esc_html__( 'Custom', 'surfy' ),
					'none'    => esc_html__( 'None', 'surfy' ),
				),
				'multiple'    	=> false,
				'std'  			=> 'default',
			),
			array(
				'id'   			=> 'mb_size_guide',
				'name' 			=> esc_html__( 'Size guide Popup Image', 'surfy' ),
				'type' 			=> 'image_advanced',
				'attributes' 	=>  array(
					'data-dependency' => array( array(
						array('mb_img_size_guide','=','custom')
					)),
				),
			),
		)
	);
	return $meta_boxes;
}
