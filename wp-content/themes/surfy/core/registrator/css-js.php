<?php

#Frontend
if (!function_exists('gt3_css_js_register')) {
	function gt3_css_js_register() {
		$wp_upload_dir = wp_upload_dir();

		wp_register_script( 'gt3-theme', get_template_directory_uri() . '/js/theme.js', array('jquery'), false, true);
        $translation_array = array(
		    'gt3_ajaxurl' => esc_url(admin_url('admin-ajax.php'))
		);
		wp_localize_script( 'gt3-theme', 'object_name', $translation_array );

		#CSS
		wp_enqueue_style('gt3-default-style', get_bloginfo('stylesheet_url'));
		wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0', 'all' );
		wp_enqueue_style('gt3-theme-style', get_template_directory_uri() . '/css/theme.css');
		wp_enqueue_style('gt3-composer-style', get_template_directory_uri() . '/css/base_composer.css');
		wp_enqueue_style('gt3-responsive-style', get_template_directory_uri() . '/css/responsive.css');

		#JS
		wp_enqueue_script('jquery-cookie', get_template_directory_uri() . '/js/jquery.cookie.js', array( 'jquery' ), '1.4.1', true);
		wp_enqueue_script('gt3-theme', get_template_directory_uri() . '/js/theme.js', array('jquery'), false, true);
		wp_enqueue_script('jquery-event-swipe', get_template_directory_uri() . '/js/jquery.event.swipe.js', array( 'jquery' ), '1.3.1', true);
	}
}
add_action('wp_enqueue_scripts', 'gt3_css_js_register');

#Admin
add_action('admin_enqueue_scripts', 'admin_css_js_register');
function admin_css_js_register() {
	$protocol = is_ssl() ? 'https' : 'http';

	/*CSS (MAIN)*/
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0', 'all' );
	wp_enqueue_style('gt3-admin-style', get_template_directory_uri() . '/core/admin/css/admin.css');
	wp_enqueue_style('wp-color-picker');
	wp_enqueue_style('gt3-admin-colorbox-style', get_template_directory_uri() . '/core/admin/css/colorbox.css');
	wp_enqueue_style('gt3-selectBox-style', get_template_directory_uri() . '/core/admin/css/jquery.selectBox.css');
	wp_enqueue_style('gt3-vc-backend-style', get_template_directory_uri() . '/core/admin/css/gt3-vc-backend.css');

	#JS (MAIN)
	wp_enqueue_script('gt3-admin', get_template_directory_uri() . '/core/admin/js/admin.js', array('jquery'), false, true);
	wp_enqueue_media();
	wp_enqueue_script('jquery-colorbox', get_template_directory_uri() . '/core/admin/js/jquery.colorbox-min.js', array('jquery'), '1.6.3', true);
	wp_enqueue_script('wp-color-picker');
	wp_enqueue_script('jquery-selectBox', get_template_directory_uri() . '/core/admin/js/jquery.selectBox.js', array('jquery'), false, true);

	if (class_exists( 'RWMB_Loader' )) {
		wp_enqueue_script('gt3-admin-metaboxes', get_template_directory_uri() . '/core/admin/js/metaboxes.js');
	}
}


function gt3_custom_styles() {
	$custom_css = '';

	// THEME COLOR
	$theme_color  = esc_attr(gt3_option("theme-custom-color"));
	$theme_color2 = esc_attr(gt3_option("theme-custom-color2"));
	// END THEME COLOR

	// BODY BACKGROUND
	$bg_body = esc_attr(gt3_option('body-background-color'));
	// END BODY BACKGROUND

	// BODY TYPOGRAPHY
	$main_font = gt3_option('main-font');
	if (!empty($main_font)) {
		$content_font_family = esc_attr($main_font['font-family']);
		$content_line_height = esc_attr($main_font['line-height']);
		$content_font_size = esc_attr($main_font['font-size']);
		$content_font_weight = esc_attr($main_font['font-weight']);
		$content_color = esc_attr($main_font['color']);
	}else{
		$content_font_family = '';
		$content_line_height = '';
		$content_font_size = '';
		$content_font_weight = '';
		$content_color = '';
	}
	// END BODY TYPOGRAPHY

	// HEADER TYPOGRAPHY
	$header_font = gt3_option('header-font');
	if (!empty($header_font)) {
		$header_font_family = esc_attr($header_font['font-family']);
		$header_font_weight = esc_attr($header_font['font-weight']);
		$header_font_color = esc_attr($header_font['color']);
	}else{
		$header_font_family = '';
		$header_font_weight = '';
		$header_font_color = '';
	}
	
	$h1_font = gt3_option('h1-font');
	if (!empty($h1_font)) {
		$H1_font_family = !empty($h1_font['font-family']) ? esc_attr($h1_font['font-family']) : '';
		$H1_font_weight = !empty($h1_font['font-weight']) ? esc_attr($h1_font['font-weight']) : '';
		$H1_font_line_height = !empty($h1_font['line-height']) ? esc_attr($h1_font['line-height']) : '';
		$H1_font_size = !empty($h1_font['font-size']) ? esc_attr($h1_font['font-size']) : '';
	}else{
		$H1_font_family = '';
		$H1_font_weight = '';
		$H1_font_line_height = '';
		$H1_font_size = '';
	}
	
	$h2_font = gt3_option('h2-font');
	if (!empty($h2_font)) {
		$H2_font_family = !empty($h2_font['font-family']) ? esc_attr($h2_font['font-family']) : '';
		$H2_font_weight = !empty($h2_font['font-weight']) ? esc_attr($h2_font['font-weight']) : '';
		$H2_font_line_height = !empty($h2_font['line-height']) ? esc_attr($h2_font['line-height']) : '';
		$H2_font_size = !empty($h2_font['font-size']) ? esc_attr($h2_font['font-size']) : '';
	}else{
		$H2_font_family = '';
		$H2_font_weight = '';
		$H2_font_line_height = '';
		$H2_font_size = '';
	}

	$h3_font = gt3_option('h3-font');
	if (!empty($h3_font)) {
		$H3_font_family = !empty($h3_font['font-family']) ? esc_attr($h3_font['font-family']) : '';
		$H3_font_weight = !empty($h3_font['font-weight']) ? esc_attr($h3_font['font-weight']) : '';
		$H3_font_line_height = !empty($h3_font['line-height']) ? esc_attr($h3_font['line-height']) : '';
		$H3_font_size = !empty($h3_font['font-size']) ? esc_attr($h3_font['font-size']) : '';
	}else{
		$H3_font_family = '';
		$H3_font_weight = '';
		$H3_font_line_height = '';
		$H3_font_size = '';
	}
	
	$h4_font = gt3_option('h4-font');
	if (!empty($h4_font)) {
		$H4_font_family = !empty($h4_font['font-family']) ? esc_attr($h4_font['font-family']) : '';
		$H4_font_weight = !empty($h4_font['font-weight']) ? esc_attr($h4_font['font-weight']) : '';
		$H4_font_line_height = !empty($h4_font['line-height']) ? esc_attr($h4_font['line-height']) : '';
		$H4_font_size = !empty($h4_font['font-size']) ? esc_attr($h4_font['font-size']) : '';
	}else{
		$H4_font_family = '';
		$H4_font_weight = '';
		$H4_font_line_height = '';
		$H4_font_size = '';
	}

	$h5_font = gt3_option('h5-font');
	if (!empty($h5_font)) {
		$H5_font_family = !empty($h5_font['font-family']) ? esc_attr($h5_font['font-family']) : '';
		$H5_font_weight = !empty($h5_font['font-weight']) ? esc_attr($h5_font['font-weight']) : '';
		$H5_font_line_height = !empty($h5_font['line-height']) ? esc_attr($h5_font['line-height']) : '';
		$H5_font_size = !empty($h5_font['font-size']) ? esc_attr($h5_font['font-size']) : '';
	}else{
		$H5_font_family = '';
		$H5_font_weight = '';
		$H5_font_line_height = '';
		$H5_font_size = '';
	}

	$h6_font = gt3_option('h6-font');
	if (!empty($h6_font)) {
		$H6_font_family = !empty($h6_font['font-family']) ? esc_attr($h6_font['font-family']) : '';
		$H6_font_weight = !empty($h6_font['font-weight']) ? esc_attr($h6_font['font-weight']) : '';
		$H6_font_line_height = !empty($h6_font['line-height']) ? esc_attr($h6_font['line-height']) : '';
		$H6_font_size = !empty($h6_font['font-size']) ? esc_attr($h6_font['font-size']) : '';
	}else{
		$H6_font_family = '';
		$H6_font_weight = '';
		$H6_font_line_height = '';
		$H6_font_size = '';
	}

	$menu_font = gt3_option('menu-font');
	if (!empty($menu_font)) {
		$menu_font_family = !empty($menu_font['font-family']) ? esc_attr($menu_font['font-family']) : '';
		$menu_font_weight = !empty($menu_font['font-weight']) ? esc_attr($menu_font['font-weight']) : '';
		$menu_font_line_height = !empty($menu_font['line-height']) ? esc_attr($menu_font['line-height']) : '';
		$menu_font_size = !empty($menu_font['font-size']) ? esc_attr($menu_font['font-size']) : '';
	}else{
		$menu_font_family = '';
		$menu_font_weight = '';
		$menu_font_line_height = '';
		$menu_font_size = '';
	}

	$sub_menu_bg = gt3_option('sub_menu_background');
	$sub_menu_color = gt3_option('sub_menu_color');


	/* GT3 Header Builder */
	$sections = array('top','middle','bottom','top__tablet','middle__tablet','bottom__tablet','top__mobile','middle__mobile','bottom__mobile');
    $desktop_sides = array('top', 'middle', 'bottom');

    foreach ($sections as $section) {
        ${'side_' . $section . '_background'} = gt3_option('side_'.$section.'_background');
        ${'side_' . $section . '_background'} = ${'side_' . $section . '_background'}['rgba'];
        ${'side_' . $section . '_color'}  = gt3_option('side_'.$section.'_color');
        ${'side_' . $section . '_color_hover'}  = gt3_option('side_'.$section.'_color_hover');
        ${'side_' . $section . '_height'} = gt3_option('side_'.$section.'_height');
        ${'side_' . $section . '_height'} = ${'side_' . $section . '_height'}['height'];

        ${'side_' . $section . '_border'} = (bool)gt3_option('side_' . $section . '_border');
        ${'side_' . $section . '_border_color'} = gt3_option('side_' . $section . '_border_color');

        ${'side_' . $section . '_color_hover_sticky'}  = gt3_option('side_'.$section.'_color_hover_sticky');

    }



	$logo_limit_on_mobile = gt3_option("logo_limit_on_mobile");
    $header_sticky = gt3_option("header_sticky");
    $side_top_sticky = gt3_option('side_top_sticky');
	$side_top_background_sticky = gt3_option('side_top_background_sticky');
	$side_top_color_sticky = gt3_option('side_top_color_sticky');
	$side_top_color_sticky = gt3_option('side_top_color_sticky');
	$side_top_height_sticky = gt3_option('side_top_height_sticky');

	$side_middle_sticky = gt3_option('side_middle_sticky');
	$side_middle_background_sticky = gt3_option('side_middle_background_sticky');
	$side_middle_color_sticky = gt3_option('side_middle_color_sticky');
	$side_middle_height_sticky = gt3_option('side_middle_height_sticky');

	$side_bottom_sticky = gt3_option('side_bottom_sticky');
	$side_bottom_background_sticky = gt3_option('side_bottom_background_sticky');
	$side_bottom_color_sticky = gt3_option('side_bottom_color_sticky');
	$side_bottom_height_sticky = gt3_option('side_bottom_height_sticky');


	/* mobile options */
	if (class_exists( 'RWMB_Loader' ) && gt3_get_queried_object_id() !== 0) {
        $mb_header_presets = rwmb_meta('mb_header_presets');  
        $presets = gt3_option('gt3_header_builder_presets');          
        if ($mb_header_presets != 'default' && isset($mb_header_presets) && !empty($presets[$mb_header_presets]) && !empty($presets[$mb_header_presets]['preset']) ) {

            $preset = $presets[$mb_header_presets]['preset'];
            $preset = json_decode($preset,true); 

            $sub_menu_bg = gt3_option_presets($preset,'sub_menu_background');
			$sub_menu_color = gt3_option_presets($preset,'sub_menu_color');

			foreach ($sections as $section) {
		        ${'side_' . $section . '_background'} = gt3_option_presets($preset,'side_'.$section.'_background');
		        ${'side_' . $section . '_background'} = ${'side_' . $section . '_background'}['rgba'];
		        ${'side_' . $section . '_color'}  = gt3_option_presets($preset,'side_'.$section.'_color');
		        ${'side_' . $section . '_color_hover'}  = gt3_option_presets($preset,'side_'.$section.'_color_hover');
		        ${'side_' . $section . '_height'} = gt3_option_presets($preset,'side_'.$section.'_height');
		        ${'side_' . $section . '_height'} = ${'side_' . $section . '_height'}['height'];

		        ${'side_' . $section . '_border'} = (bool)gt3_option_presets($preset,'side_' . $section . '_border');
		        ${'side_' . $section . '_border_color'} = gt3_option_presets($preset,'side_' . $section . '_border_color');
		    }   

		    $header_sticky = gt3_option_presets($preset,"header_sticky");
		    $side_top_sticky = gt3_option_presets($preset,'side_top_sticky');
			$side_top_background_sticky = gt3_option_presets($preset,'side_top_background_sticky');
			$side_top_color_sticky = gt3_option_presets($preset,'side_top_color_sticky');
			$side_top_height_sticky = gt3_option_presets($preset,'side_top_height_sticky');

			$side_middle_sticky = gt3_option_presets($preset,'side_middle_sticky');
			$side_middle_background_sticky = gt3_option_presets($preset,'side_middle_background_sticky');
			$side_middle_color_sticky = gt3_option_presets($preset,'side_middle_color_sticky');
			$side_middle_height_sticky = gt3_option_presets($preset,'side_middle_height_sticky');

			$side_bottom_sticky = gt3_option_presets($preset,'side_bottom_sticky');
			$side_bottom_background_sticky = gt3_option_presets($preset,'side_bottom_background_sticky');
			$side_bottom_color_sticky = gt3_option_presets($preset,'side_bottom_color_sticky');
			$side_bottom_height_sticky = gt3_option_presets($preset,'side_bottom_height_sticky');

			$side_top_mobile = gt3_option_presets($preset,'side_top_mobile');
			$side_top_height_mobile = gt3_option_presets($preset,'side_top_height_mobile');

			$side_middle_mobile = gt3_option_presets($preset,'side_middle_mobile');
			$side_middle_height_mobile = gt3_option_presets($preset,'side_middle_height_mobile');

			$side_bottom_mobile = gt3_option_presets($preset,'side_bottom_mobile');
			$side_bottom_height_mobile = gt3_option_presets($preset,'side_bottom_height_mobile');
        }

        $mb_customize_header_layout = rwmb_meta('mb_customize_header_layout'); 
        if ($mb_customize_header_layout == 'custom') {
	        $mb_customize_top_header_layout = rwmb_meta('mb_customize_top_header_layout'); 
	        $mb_customize_middle_header_layout = rwmb_meta('mb_customize_middle_header_layout'); 
	        $mb_customize_bottom_header_layout = rwmb_meta('mb_customize_bottom_header_layout'); 

	        if ($mb_customize_top_header_layout == 'custom') {
	        	//top
				$mb_top_header_background = rwmb_meta('mb_top_header_background');
	            $mb_top_header_background_opacity = rwmb_meta('mb_top_header_background_opacity');
	            $side_top_color = rwmb_meta('mb_top_header_color');
	            $side_top_border = rwmb_meta('mb_top_header_bottom_border');
	            $mb_header_top_bottom_border_color = rwmb_meta('mb_header_top_bottom_border_color');
	            $mb_header_top_bottom_border_color_opacity = rwmb_meta('mb_header_top_bottom_border_color_opacity');

	            if (!empty($mb_header_top_bottom_border_color)) {
	                $side_top_border_color['rgba'] = 'rgba('.(gt3_HexToRGB($mb_header_top_bottom_border_color)).','.$mb_header_top_bottom_border_color_opacity.')';
	            }else{
	                $side_top_border_color['rgba'] = '';
	            }            
	            if (!empty($mb_top_header_background)) {
	            	$mb_top_header_background_opacity = $mb_top_header_background_opacity == '' ? '1' : $mb_top_header_background_opacity;
	                $side_top_background = 'rgba('.(gt3_HexToRGB($mb_top_header_background)).','.$mb_top_header_background_opacity.')';
	            }else{
	                $side_top_background = '';
	            }
	        }

	        if ($mb_customize_middle_header_layout == 'custom') {
	        	//middle
				$mb_middle_header_background = rwmb_meta('mb_middle_header_background');
	            $mb_middle_header_background_opacity = rwmb_meta('mb_middle_header_background_opacity');
	            $side_middle_color = rwmb_meta('mb_middle_header_color');
	            $side_middle_border = rwmb_meta('mb_middle_header_bottom_border');
	            $mb_header_middle_bottom_border_color = rwmb_meta('mb_header_middle_bottom_border_color');
	            $mb_header_middle_bottom_border_color_opacity = rwmb_meta('mb_header_middle_bottom_border_color_opacity');

	            if (!empty($mb_header_middle_bottom_border_color)) {
	                $side_middle_border_color['rgba'] = 'rgba('.(gt3_HexToRGB($mb_header_middle_bottom_border_color)).','.$mb_header_middle_bottom_border_color_opacity.')';
	            }else{
	                $side_middle_border_color['rgba'] = '';
	            }            
	            if (!empty($mb_middle_header_background)) {
	            	$mb_middle_header_background_opacity = $mb_middle_header_background_opacity == '' ? '1' : $mb_middle_header_background_opacity;
	                $side_middle_background = 'rgba('.(gt3_HexToRGB($mb_middle_header_background)).','.$mb_middle_header_background_opacity.')';
	            }else{
	                $side_middle_background = '';
	            }
	        }

	        if ($mb_customize_bottom_header_layout == 'custom') {
	        	//bottom
				$mb_bottom_header_background = rwmb_meta('mb_bottom_header_background');
	            $mb_bottom_header_background_opacity = rwmb_meta('mb_bottom_header_background_opacity');
	            $side_bottom_color = rwmb_meta('mb_bottom_header_color');
	            $side_bottom_border = rwmb_meta('mb_bottom_header_bottom_border');
	            $mb_header_bottom_bottom_border_color = rwmb_meta('mb_header_bottom_bottom_border_color');
	            $mb_header_bottom_bottom_border_color_opacity = rwmb_meta('mb_header_bottom_bottom_border_color_opacity');

	            if (!empty($mb_header_bottom_bottom_border_color)) {
	            	$mb_header_bottom_bottom_border_color_opacity = $mb_header_bottom_bottom_border_color_opacity == '' ? '1' : $mb_header_bottom_bottom_border_color_opacity;
	                $side_bottom_border_color['rgba'] = 'rgba('.(gt3_HexToRGB($mb_header_bottom_bottom_border_color)).','.$mb_header_bottom_bottom_border_color_opacity.')';
	            }else{
	                $side_bottom_border_color['rgba'] = '';
	            }            
	            if (!empty($mb_bottom_header_background)) {
	                $side_bottom_background = 'rgba('.(gt3_HexToRGB($mb_bottom_header_background)).','.$mb_bottom_header_background_opacity.')';
	            }else{
	                $side_bottom_background = '';
	            }
	        }
	    }
    }

	/* End GT3 Header Builder */

	// END HEADER TYPOGRAPHY

	$custom_css = '
    /* Custom CSS */
		*{}
			
		a,
		a:hover,
		a:focus {
			text-decoration:none;
			outline:none !important;
			transition:all 400ms;
		}

		body {
			font-family: ' . $content_font_family . ';
			font-size:'.$content_font_size.';
			line-height:'.$content_line_height.';
			font-weight:'.$content_font_weight.';
			color: '.$content_color.';
			'.(!empty($bg_body) ? 'background:'.$bg_body.';' : '').';
		}

		/* Custom Fonts */
		h1, h1 span, h1 a,
		h2, h2 span, h2 a,
		h3, h3 span, h3 a,
		h4, h4 span, h4 a,
		h5, h5 span, h5 a,
		h6, h6 span, h6 a,
		.calendar_wrap tbody,
		.vc_tta.vc_general .vc_tta-tab{
			color: '.$header_font_color.';
		}

		h1, h1 span, h1 a,
		h2, h2 span, h2 a,
		h3, h3 span, h3 a,
		h4, h4 span, h4 a,
		h5, h5 span, h5 a,
		h6, h6 span, h6 a,
		.countdown-amount,
		.strip_template .strip-item a span,
		.column1 .item_title a,
		.index_number,
		.price_item_btn a,
		.prev_next_links a b,
		.shortcode_tab_item_title{
			font-family: ' . $header_font_family . ';
			font-weight: ' . $header_font_weight . '
		}

		h1, h1 a, h1 span {
			'.(!empty($H1_font_family) ? 'font-family:'.$H1_font_family.';' : '' ).'
			'.(!empty($H1_font_weight) ? 'font-weight:'.$H1_font_weight.';' : '' ).'
			'.(!empty($H1_font_size) ? 'font-size:'.$H1_font_size.';' : '' ).'
			'.(!empty($H1_font_line_height) ? 'line-height:'.$H1_font_line_height.';' : '' ).'
		}

		h2, h2 a, h2 span {
			'.(!empty($H2_font_family) ? 'font-family:'.$H2_font_family.';' : '' ).'
			'.(!empty($H2_font_weight) ? 'font-weight:'.$H2_font_weight.';' : '' ).'
			'.(!empty($H2_font_size) ? 'font-size:'.$H2_font_size.';' : '' ).'
			'.(!empty($H2_font_line_height) ? 'line-height:'.$H2_font_line_height.';' : '' ).'
		}

		h3, h3 a, h3 span,
		.sidepanel .title {
			'.(!empty($H3_font_family) ? 'font-family:'.$H3_font_family.';' : '' ).'
			'.(!empty($H3_font_weight) ? 'font-weight:'.$H3_font_weight.';' : '' ).'
			'.(!empty($H3_font_size) ? 'font-size:'.$H3_font_size.';' : '' ).'
			'.(!empty($H3_font_line_height) ? 'line-height:'.$H3_font_line_height.';' : '' ).'
		}

		h4, h4 a, h4 span {
			'.(!empty($H4_font_family) ? 'font-family:'.$H4_font_family.';' : '' ).'
			'.(!empty($H4_font_weight) ? 'font-weight:'.$H4_font_weight.';' : '' ).'
			'.(!empty($H4_font_size) ? 'font-size:'.$H4_font_size.';' : '' ).'
			'.(!empty($H4_font_line_height) ? 'line-height:'.$H4_font_line_height.';' : '' ).'
		}

		h5, h5 a, h5 span {
			'.(!empty($H5_font_family) ? 'font-family:'.$H5_font_family.';' : '' ).'
			'.(!empty($H5_font_weight) ? 'font-weight:'.$H5_font_weight.';' : '' ).'
			'.(!empty($H5_font_size) ? 'font-size:'.$H5_font_size.';' : '' ).'
			'.(!empty($H5_font_line_height) ? 'line-height:'.$H5_font_line_height.';' : '' ).'
		}

		h6, h6 a, h6 span {
			'.(!empty($H6_font_family) ? 'font-family:'.$H6_font_family.';' : '' ).'
			'.(!empty($H6_font_weight) ? 'font-weight:'.$H6_font_weight.';' : '' ).'
			'.(!empty($H6_font_size) ? 'font-size:'.$H6_font_size.';' : '' ).'
			'.(!empty($H6_font_line_height) ? 'line-height:'.$H6_font_line_height.';' : '' ).'
		}

		.diagram_item .chart, 
		.item_title a, 
		.contentarea ul,
		body .vc_pie_chart .vc_pie_chart_value,
		.price_item .shortcode_button.alt:hover span, 
		.price_item .price_value, 
		.widget_search .search_form:before, 
		.wrapper_404 .number_404__subtitle,
		body.wpb-js-composer .vc_tta-accordion .vc_tta-panel .vc_tta-panel-heading .vc_tta-panel-title, 
		.widget_product_categories ul li a, 
		.widget_nav_menu ul li a, 
		.widget_archive ul li a, 
		.widget_pages ul li a, 
		.widget_categories ul li a,
		.widget_recent_entries ul li a, 
		.widget_meta ul li a, 
		.widget_recent_comments ul li a, 
		.single_listing_tags a .tag_name,
		.gt3_practice_list__content .gt3_practice_list__title,
		blockquote cite a,
		.woocommerce table.shop_table td.product-name a,
		.woocommerce ul.product_list_widget li .price{
			color:'. $header_font_color .';
		}

		.vc_row .vc_progress_bar:not(.vc_progress-bar-color-custom) .vc_single_bar .vc_label:not([style*="color"]) {
			color: '. $header_font_color .' !important;
		}

		/* Theme color */
		a,
		.widget.widget_archive ul li:hover:before,
		.widget.widget_categories ul li:hover:before,
		.widget.widget_pages ul li:hover:before,
		.widget.widget_meta ul li:hover:before,
		.widget.widget_recent_comments ul li:hover:before,
		.widget.widget_recent_entries ul li:hover:before,
		.widget.widget_nav_menu ul li:hover:before,
		.widget.widget_archive ul li:hover > a,
		.widget.widget_categories ul li:hover > a,
		.widget.widget_pages ul li:hover > a,
		.widget.widget_meta ul li:hover > a,
		.widget.widget_recent_comments ul li:hover > a,
		.widget.widget_recent_entries ul li:hover > a,
		.widget.widget_nav_menu ul li:hover > a,
		.top_footer .widget.widget_archive ul li:hover > a,
		.top_footer .widget.widget_archive ul li:hover > .post_count,
		.top_footer .widget.widget_categories ul li:hover > a,
		.top_footer .widget.widget_categories ul li:hover > .post_count,
		.top_footer .widget.widget_pages ul li > a:hover,
		.top_footer .widget.widget_meta ul li > a:hover,
		.top_footer .widget.widget_recent_comments ul li > a:hover,
		.top_footer .widget.widget_recent_entries ul li > a:hover,
		.top_footer .widget.widget_nav_menu ul li > a:hover,		
		.price_item .item_cost_wrapper .price_item_title h3,
		.price_item .shortcode_button:hover span,
		.recent_posts_content .listing_meta,
		.calendar_wrap thead,
		.gt3_practice_list__image-holder i,
		.load_more_works:hover,
		.copyright a:hover,
		blockquote:before,
		.post-quote-icon,
		blockquote cite a:hover,
		.gt3_widget.woocommerce.widget_product_categories ul li:hover > a,
		.woocommerce table.shop_table td.product-name:hover a,
		.woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
		.woocommerce-info a:hover,
		.gt3_widget.woocommerce.widget_product_categories li:hover:before,	
		.woocommerce li.gt3_widget_product_list .gt3_woo_widget_title:hover span,
		.gt3_header_builder_cart_component .buttons .button:hover,
		.gt3_header_builder_cart_component ul.cart_list li a:hover{
			color: '.$theme_color.';
		}

		footer.main_footer .footer_menu a:hover,
		.price_item.most_popular .price_button .shortcode_button span,
		.gt3_module_featured_posts .featured_post_info.boxed_view .learn_more,
		.gt3_module_featured_posts.blog_type2 .featured_post_info .learn_more {
			color: '.$theme_color.';
		}

		.gt3_practice_list.module_on_dark .gt3_practice_list__content .gt3_practice_list__title,
		.gt3_practice_list__link.learn_more:hover,
		.gt3_module_title .module_title_content,
		.gt3_module_title .external_link .learn_more:hover,
		.module_team.gt3-team-on-dark-bg .module-team_title,
		.price_item .shortcode_button span,
		.module_team.module_on_dark_bg .module-team_title,
		.module_team.module_on_dark_bg .view_all_link.shortcode_button.btn_type1:hover,
		a.view_all_link.shortcode_button.btn_normal.btn_type2:hover,
		.price_item.most_popular .item_cost_wrapper .price_item_title h3,
		.price_item.most_popular .price_button .shortcode_button:hover span,
		.price_item.most_popular .price_item_prefix,
		.price_item.most_popular .price_value,
		.wrapper_404 .number_404__btn a,
		.countdown-section .countdown-amount,
		.price_item.most_popular .price_item_suffix,
		.price_item.most_popular .price_item_description,
		.grid_load_more, .packery_load_more,
		body.wpb-js-composer .vc_toggle.vc_toggle_accordion_alternative .vc_toggle_title h4,
		body.wpb-js-composer .vc_toggle.vc_toggle_accordion_alternative.vc_toggle_active .vc_toggle_content,
		body.wpb-js-composer .vc_tta-accordion.vc_tta-style-classic .vc_active.vc_tta-panel .vc_tta-panel-heading a .vc_tta-title-text,	
		body.wpb-js-composer .vc_tta-accordion.vc_tta-style-classic .vc_active.vc_tta-panel .vc_tta-panel-heading a .vc_tta-controls-icon:before,
		.contact-page .custom_textarea .gt3_submit_wrapper .wpcf7-form-control.wpcf7-submit,
		footer .widget_recent_comments ul li a,
		footer .widget_recent_comments a, 
		footer a.rsswidget:hover, 
		footer.main_footer .footer_menu a,
		footer .widget_rss .widget-title a.rsswidget,
		.top_footer .calendar_wrap tbody{
			color: '.$theme_color2.';			
		}
		.gt3_practice_list__link.learn_more:hover span:before,
		.gt3_module_title .external_link:hover .learn_more span:before,
		#back_to_top:before,
		#back_to_top:after,
		.comming-soon-mail .wpcf7-form-control[type="submit"]:hover,
		a.view_all_link.shortcode_button.btn_normal.btn_type2:hover:after,
		.price_item.most_popular .price_button .shortcode_button,
		body.wpb-js-composer .vc_toggle.vc_toggle_accordion_alternative.vc_toggle_active .vc_toggle_title,
		body.wpb-js-composer .vc_toggle.vc_toggle_accordion_alternative.vc_toggle_color_triangle .vc_toggle_title .vc_toggle_icon:before,
		.module_team.module_on_dark_bg a.view_all_link.shortcode_button.btn_type1:hover:after  {
			border-color: '.$theme_color2.';
		}
		
		.gt3_practice_list__link.learn_more:hover span,
		.footer-mail .wpcf7-form-control:hover[type="submit"],
		.gt3_module_title .external_link:hover .learn_more span,
		a.view_all_link.shortcode_button.btn_normal.btn_type2:hover:before,
		.price_item .price_button .shortcode_button:hover,
		.wrapper_404 .number_404__btn a:hover,		
		body .booked-calendar-wrap table.booked-calendar td:hover .date,
		.price_item.most_popular .price_button .shortcode_button,
		.packery_gallery_wrapper .gt3_grid_module_button .packery_load_more:hover,
		body.wpb-js-composer .vc_toggle.vc_toggle_accordion_alternative.vc_toggle_active .vc_toggle_title,
		.contact-page .custom_textarea .gt3_submit_wrapper .wpcf7-form-control.wpcf7-submit:hover,
		.module_team.module_on_dark_bg a.view_all_link.shortcode_button.btn_type1:hover:before,		
		.top_footer .mc_signup_submit:hover input#mc_signup_submit {
			background-color: '.$theme_color2.';
		}
		.main_wrapper ul li::before,
		.main_wrapper ol > li:before,
		.grid_load_more, .packery_load_more:hover,
		.widget_nav_menu .menu .menu-item.current-menu-item a,		
		footer .widget_rss .widget-title:hover a.rsswidget,		
		.top_footer .mc_signup_submit:hover input#mc_signup_submit,
		body.wpb-js-composer .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading .vc_tta-panel-title,		
		.widget.widget_nav_menu ul li:hover > a:before,		
		.widget_nav_menu ul li a:before{
			color: '.$theme_color.';
		}

		.tagcloud a:hover,
		.wrapper_404 .number_404__btn a,
		.comment-form .gt3_submit_wrapper .submit:hover,
		.grid_load_more, .packery_load_more,
		.price_item.most_popular .price_button .shortcode_button:hover,
		.gt3_module_featured_posts .featured_post_info.boxed_view .learn_more span,
		.gt3_module_featured_posts.blog_type2 .featured_post_info .learn_more span,
		body.wpb-js-composer .vc_tta-accordion.vc_tta-style-accordion_solid .vc_tta-panel.vc_active .vc_tta-panel-heading .vc_tta-panel-title {
			background-color: '.$theme_color.';
		}
		
		.price_item .item_cost_wrapper .bg-color,
		.main_menu_container .menu_item_line,
		.gt3_practice_list__link:before,
		.load_more_works,
		.footer-mail .wpcf7-form-control[type="submit"],
		.content-container .vc_progress_bar .vc_single_bar .vc_bar{
			background-color: '.$theme_color.';
		}

		.calendar_wrap caption,
		.widget .calendar_wrap table td#today:before,
		.price_item .price_button .shortcode_button,
		.price_item .shortcode_button.alt,
		body .vc_tta.vc_general .vc_tta-tab.vc_active>a,
		body .vc_tta.vc_tta-tabs .vc_tta-panel.vc_active .vc_tta-panel-heading .vc_tta-panel-title>a,
		.vc_row .vc_toggle_icon {
			background: '.$theme_color.';
		}

		.gt3_module_button a,
		input[type="submit"],
		#back_to_top,
		#back_to_top:hover:before{
			border-color: '.$theme_color.';
			background: '.$theme_color.';
		}
		#back_to_top:hover {
			background: '.$theme_color2.';
		}

		.gt3_submit_wrapper {
			background: '.$theme_color.';
		}

		.footer_socials_links a:hover i::before,
		input[type="submit"]:hover,
		.gt3_submit_wrapper:hover > i {
			color:'.$theme_color.';
		}

		.price_item .price_button .shortcode_button.alt:hover,
		.load_more_works,
		#back_to_top:hover:after,		
		.grid_load_more,
		.packery_load_more,
		body.wpb-js-composer .module_testimonial .slick-dots li button,
		body.wpb-js-composer .vc_row .vc_tta.vc_tta-accordion.vc_tta-style-accordion_bordered .vc_tta-controls-icon:after,
		.price_item .price_button .shortcode_button:hover,
		.comming-soon-mail .wpcf7-form-control[type="submit"],
		.price_item.most_popular .price_button .shortcode_button:hover,
		.gt3_module_featured_posts .featured_post_info.boxed_view .learn_more span:before,
		.gt3_module_featured_posts.blog_type2 .featured_post_info .learn_more span:before,
		.woocommerce div.product form.cart .qty {
			border-color: '.$theme_color.';
		}

		body .widget.widget_categories ul li:hover:before,
		.module_testimonial.type2 .testimonials-text:before,
		.listing_meta span:after,
		.listing_meta *{
			color: '.$theme_color.';
		}

		.wrapper_404 .number_404__btn a,
		body.wpb-js-composer .vc_toggle.vc_toggle_accordion_bordered .vc_toggle_title .vc_toggle_icon::after,
		body.wpb-js-composer .vc_tta-accordion.vc_tta-style-accordion_alternative .vc_tta-panel.vc_active .vc_tta-panel-heading,
		body.wpb-js-composer .vc_tta-accordion.vc_tta-style-accordion_alternative .vc_tta-panel.vc_active .vc_tta-panel-heading .vc_tta-controls-icon::before,
		.gt3_module_button a:hover {
			border-color: '.$theme_color.';
		}

		body.wpb-js-composer .module_testimonial .slick-dots li.slick-active button,
		body.wpb-js-composer .vc_toggle.vc_toggle_accordion_solid.vc_toggle_active .vc_toggle_title,
		body.wpb-js-composer .vc_toggle.vc_toggle_accordion_bordered.vc_toggle_active .vc_toggle_title,
		body.wpb-js-composer .vc_tta-accordion.vc_tta-style-accordion_solid .vc_tta-panel.vc_active .vc_tta-panel-heading .vc_tta-panel-title,
		body.wpb-js-composer .vc_tta-accordion.vc_tta-style-classic .vc_active.vc_tta-panel .vc_tta-panel-heading {
			background-color: '.$theme_color.';
		}

		body.wpb-js-composer .vc_tta-accordion.vc_tta-style-accordion_bordered .vc_tta-panel .vc_tta-panel-heading .vc_tta-panel-title,
		.gt3_module_button a:hover,
		.gt3_module_button a:hover .gt3_btn_icon.fa {
			color: '.$theme_color.';
		}

		.gt3_icon_box__link a:before,
		.module_team .view_all_link:before,
		a.view_all_link.shortcode_button.btn_normal.btn_type1:before,
		a.view_all_link.shortcode_button.btn_normal.btn_type2:before {
			background-color: '.$theme_color.';
		}

		.single-member-page .member-icon:hover,
		.widget_nav_menu .menu .menu-item:hover>a,
		.single-member-page .team-link:hover,
		.module_team .view_all_link,
		a.view_all_link.shortcode_button.btn_normal.btn_type1,
		a.view_all_link.shortcode_button.btn_normal.btn_type2,		
		.contact-page .custom_textarea .gt3_submit_wrapper .wpcf7-form-control.wpcf7-submit:hover {
			color: '.$theme_color.';
		}

		.module_team .view_all_link:after,
		a.view_all_link.shortcode_button.btn_normal.btn_type1:after,
		a.view_all_link.shortcode_button.btn_normal.btn_type2:after {
			border-color: '.$theme_color.';
		}
		.contact-page .custom_textarea .gt3_submit_wrapper .wpcf7-form-control.wpcf7-submit {
			background-color: '.$theme_color.';
		}


		/* menu fonts */
		.main-menu>ul,
		.main-menu>div>ul {
			font-family:'.esc_attr($menu_font_family).';
			font-weight:'.esc_attr($menu_font_weight).';
			line-height:'.esc_attr($menu_font_line_height).';
			font-size:'.esc_attr($menu_font_size).';
		}

		/* sub menu styles */
		.main-menu ul li ul.sub-menu,
		.gt3_currency_switcher ul,
		.gt3_header_builder .header_search__inner .search_form,
		.mobile_menu_container,
		.gt3_header_builder_cart_component__cart-container{
			background-color: ' .(!empty($sub_menu_bg['rgba']) ? esc_attr( $sub_menu_bg['rgba'] ) : "transparent" ).' ;
			color: '.esc_attr( $sub_menu_color ).' ;
		}
		.gt3_header_builder .header_search__inner .search_text::-webkit-input-placeholder{
			color: '.esc_attr( $sub_menu_color ).' !important;
		}
		.gt3_header_builder .header_search__inner .search_text:-moz-placeholder {
			color: '.esc_attr( $sub_menu_color ).' !important;
		}
		.gt3_header_builder .header_search__inner .search_text::-moz-placeholder {
			color: '.esc_attr( $sub_menu_color ).' !important;
		}
		.gt3_header_builder .header_search__inner .search_text:-ms-input-placeholder {
			color: '.esc_attr( $sub_menu_color ).' !important;
		}
		.gt3_header_builder .header_search .header_search__inner:before,
		.main-menu > ul > li > ul:before,
		.gt3_megamenu_triangle:before,
		.gt3_currency_switcher ul:before,
		.gt3_header_builder_cart_component__cart:before{
			border-bottom-color: ' .(!empty($sub_menu_bg['rgba']) ? esc_attr( $sub_menu_bg['rgba'] ) : "transparent" ).' ;
		}
		.gt3_header_builder .header_search .header_search__inner:before,
		.main-menu > ul > li > ul:before,
		.gt3_megamenu_triangle:before,
		.gt3_currency_switcher ul:before,
		.gt3_header_builder_cart_component__cart:before{
		    -webkit-box-shadow: 0px 1px 0px 0px ' .(!empty($sub_menu_bg['rgba']) ? esc_attr( $sub_menu_bg['rgba'] ) : "transparent" ).';
		    -moz-box-shadow: 0px 1px 0px 0px ' .(!empty($sub_menu_bg['rgba']) ? esc_attr( $sub_menu_bg['rgba'] ) : "transparent" ).';
		    box-shadow: 0px 1px 0px 0px ' .(!empty($sub_menu_bg['rgba']) ? esc_attr( $sub_menu_bg['rgba'] ) : "transparent" ).';
		}

		/* blog */
		.listing_meta a,
		.post_share > a,
		.share_wrap a span,
		.like_count,
		.likes_block .icon,
		.gt3_module_featured_posts .listing_meta a:hover,
		.main_wrapper .price_item .items_text li:not(.active),
		.recent_posts .listing_meta a:hover,
		.comment_info .listing_meta a:hover,
		.price_item_body .items_text ul li span, 
		.team-infobox .team_info span,
		.wrapper_404 .number_404__text-info,
		.number_404__search .search_form .search_text::-webkit-input-placeholder,
		.number_404__search .search_form .search_text::-moz-placeholder,
		.number_404__search .search_form .search_text:-ms-input-placeholder,
		.number_404__search .search_form .search_text:-ms-input-placeholder,
		.price_item_body .items_text ul li,
		.price_item span.price_item_suffix,
		.price_item .price_item_prefix,
		body .booked-calendar-wrap .booked-appt-list .timeslot .spots-available,
		.price_item .item_cost_wrapper,
		.gt3_widget .gt3_social a, 
		.gt3_custom_text .gt3_social a {
			color: '.$content_color.';
		}

		.post_share > a,
		.share_wrap a,
		.post_share > a::before, .share_wrap a span,
		body.wpb-js-composer .format-link.blog_post_preview .blogpost_title a,
		.blog_post_preview.format-quote .blogpost_title,
		.main_wrapper .price_item .items_text li,
		.prev_next_links .fleft a,
		.prev_next_links .fleft a:hover span i,
		.prev_next_links .fleft a span i::before,
		.prev_next_links .fright a,
		.prev_next_links .fright a:hover span i,
		.prev_next_links .fright a span i::before,
		.prev_next_links .fleft a:focus,
		.prev_next_links .fright a:focus {
			color: '.$content_color.';
		}

		.prev_next_links a span i {
			background-color: '.$content_color.';
		}
		.comment-reply-link {
			color: '.$content_color.';
		}
		
		.listing_meta a:hover,
		.blogpost_title a:hover,
		.post_share > a:hover,
		.post_share > a:hover:before,
		.post_share:hover > a:before,
		.gt3_module_featured_posts .listing_meta,
		.gt3_module_featured_posts .listing_meta a,
		.recent_posts .listing_meta a,
		.widget.widget_posts .recent_posts li > .recent_posts_content .post_title a:hover,
		.comment_info .listing_meta,
		.comment_info .listing_meta a,
		.prev_next_links .fleft a:hover,
		.prev_next_links .fright a:hover,
		.comment-reply-link:hover,
		.gt3_widget .gt3_social a:hover, 
		.gt3_custom_text .gt3_social a:hover,
		body .widget.widget_categories ul li:before,
		.widget.widget_archive ul li:before,
		.widget.widget_categories ul li:before,
		.widget.widget_pages ul li:before,
		.widget.widget_meta ul li:before,
		.widget.widget_recent_comments ul li:before,
		.widget.widget_recent_entries ul li:before,
		.widget.widget_nav_menu ul li:before  {
			color: '.$theme_color.';
		}

		body.wpb-js-composer .format-link.blog_post_preview .blogpost_title a:hover,
		.header-address:before,
		.blogpost_title i {
			color: '.$theme_color.';
		}

		body.wpb-js-composer .vc_toggle.vc_toggle_color_plus .vc_toggle_icon:before,
		body.wpb-js-composer .vc_toggle.vc_toggle_color_plus .vc_toggle_icon:after,
		body.wpb-js-composer .vc_toggle.vc_toggle_accordion_alternative.vc_toggle_active.vc_toggle_color_triangle .vc_toggle_title .vc_toggle_icon:before,
		body.wpb-js-composer .vc_tta-accordion.vc_tta-style-accordion_bordered .vc_tta-panel.vc_active .vc_tta-panel-heading .vc_tta-controls-icon:before,		
		body.wpb-js-composer .vc_row .vc_tta.vc_tta-accordion.vc_tta-style-accordion_bordered .vc_tta-controls-icon:before,	
		body.wpb-js-composer .vc_toggle.vc_toggle_active .vc_toggle_title .vc_toggle_icon:before,
		.gt3_module_featured_posts .featured_post_info.boxed_view .learn_more:hover span:before,
		.gt3_module_featured_posts.blog_type2 .featured_post_info .learn_more:hover span:before {
			border-color: '.$header_font_color.';
		}

		ul.pagerblock li a,
		ul.pagerblock li span,
		.learn_more:hover,
		.testimonials_title,
		.widget_nav_menu ul li a,
		.header-phone,
		.header-address,
		.isotope-filter a,
		.gt3_practice_list__filter a,
		.comment-form .gt3_submit_wrapper .submit,
		body .booked-calendar-wrap .booked-appt-list .timeslot .timeslot-time,
		.gt3_module_featured_posts .blog_post_preview.format-quote .blogpost_title a,
		body .booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button,
		body .booked-calendar-wrap table.booked-calendar td,
		.listing_meta span a:hover,
		a.view_all_link.shortcode_button.btn_normal.btn_type1:hover,
		.gt3_module_featured_posts.module_on_dark_bg .gt3_module_title .module_title_content,
		body.wpb-js-composer .vc_tta-accordion .vc_tta-panel .vc_tta-panel-heading a .vc_tta-title-text,
		body.wpb-js-composer .vc_toggle.vc_toggle_accordion_alternative.vc_toggle_active .vc_toggle_title h4,
		body.wpb-js-composer .vc_toggle.vc_toggle_active .vc_toggle_title h4,
		body.wpb-js-composer .vc_toggle.vc_toggle_accordion_bordered .vc_toggle_title h4,
		body.wpb-js-composer .vc_toggle.vc_toggle_accordion_bordered.vc_toggle_color_chevron .vc_toggle_title .vc_toggle_icon:before,
		.widget.widget_posts .recent_posts li > .recent_posts_content .post_title a,		
		.gt3_module_featured_posts.module_on_dark_bg .gt3_module_title .external_link a:hover,
		.gt3_module_featured_posts .featured_post_info.boxed_view .learn_more:hover,
		.gt3_module_featured_posts.blog_type2 .featured_post_info .learn_more:hover,
		footer input[type="text"]{
			color: '.$header_font_color.';
		}
		
		.module_team .view_all_link:hover:before ,
		a.view_all_link.shortcode_button.btn_normal.btn_type1:hover:before,		
		.gt3_module_featured_posts.module_on_dark_bg .gt3_module_title .external_link a:hover span,
		.gt3_module_featured_posts .featured_post_info.boxed_view .learn_more:hover span,
		.gt3_module_featured_posts.blog_type2 .featured_post_info .learn_more:hover span,
		body .mc_signup_submit:hover input#mc_signup_submit{
			background-color: '.$header_font_color.';
		}
		
		.module_team .view_all_link:hover:after,
		a.view_all_link.shortcode_button.btn_normal.btn_type1:hover:after,
		body.wpb-js-composer .vc_toggle_color_triangle .vc_toggle_icon::before,
		body.wpb-js-composer .vc_tta-accordion.vc_tta-style-accordion_alternative .vc_tta-panel .vc_tta-panel-heading .vc_tta-controls-icon::before,
		body.wpb-js-composer .vc_tta-accordion.vc_tta-style-accordion_alternative .vc_tta-controls-icon.vc_tta-controls-icon-plus::before,
		body.wpb-js-composer .vc_tta-accordion.vc_tta-style-accordion_alternative .vc_tta-controls-icon.vc_tta-controls-icon-plus::after,
		body.wpb-js-composer .vc_tta-accordion.vc_tta.vc_tta-style-accordion_alternative .vc_tta-controls-icon.vc_tta-controls-icon-chevron::before,
		.gt3_module_featured_posts.module_on_dark_bg .gt3_module_title .external_link a:hover span:before {
			border-color: '.$header_font_color.';
		}
		
		.learn_more span,
		.gt3_module_title .carousel_arrows a:hover span,
		.prev_next_links a span i {
			background: '.$theme_color.';
		}

		body.wpb-js-composer .gt3_carousel_list .slick-next::before,
		body.wpb-js-composer .gt3_carousel_list .slick-prev::before {
			background-color: '.$theme_color.';
		}

		.learn_more span:before, 
		.gt3_module_title .carousel_arrows a:hover span:before, 
		.prev_next_links a span i:before{
			border-color: '.$theme_color.';
		}
		.likes_block:hover .icon,
		.likes_block.already_liked .icon,
		.gt3_module_featured_posts .blog_post_preview.format-quote .blogpost_title a:hover,
		.isotope-filter a:hover,
		.gt3_breadcrumb .breadcrumbs a:hover,
		.isotope-filter a.active {
			color: '.$theme_color.';
		}

		.post_media_info {
			color: '.$header_font_color.';
		}

		.post_media_info:before {
			background: '.$header_font_color.';
		}

		.pagerblock li a:hover,
		.pagerblock li a:focus {
			background: '.$header_font_color.';
		}

		ul.pagerblock li a.current,
		ul.pagerblock li span {
			background: '.$theme_color.';
		}

		.gt3_module_title .external_link .learn_more {
			line-height:'.$content_line_height.';
		}

		.blog_type1 .blog_post_preview:before {
			background: '.$header_font_color.';
		}

		.post_share > a:before,
		.share_wrap a span {
			font-size:'.$content_font_size.';
		}

		ol.commentlist:after {
			'.(!empty($bg_body) ? 'background:'.$bg_body.';' : '').'
		}

		h3#reply-title a,
		.comment_author_says a:hover,
		.prev_next_links a:hover b,
		.dropcap,
		.gt3_custom_text a,
		.gt3_custom_button i {
			color: '.$theme_color.';
		}

		h3#reply-title a:hover,
		.comment_author_says,
		.comment_author_says a,
		.prev_next_links a b {
			color: '.$header_font_color.';
		}

		input[type="date"],
		input[type="email"],
		input[type="number"],
		input[type="password"],
		input[type="search"],
		input[type="tel"],
		input[type="text"],
		input[type="url"],
		select,
		textarea,
		.wrapper_404.pp_block input.search_submit{
			font-family:' . $content_font_family . ';
		}

		::-moz-selection {
			background: '.$theme_color.';
		}
		::selection {
			background: '.$theme_color.';
		}

		.widget_recent_comments a,
		a.rsswidget:hover,
		.widget_rss .widget-title a.rsswidget {
			color: '.$header_font_color.';
		}

		.widget_recent_comments a:hover {
			color: '.$theme_color.' !important;
		}
	';

	//sticky header logo 
	$header_sticky_height = gt3_option('header_sticky_height');
	if ($header_sticky_height) {
		$custom_css .='
		.sticky_header .logo_container > a,
		.sticky_header .logo_container > a > img{
			max-height: '.((int)$header_sticky_height['height']*0.9).'px !important;
		}
		.main_header .sticky_header .header_search{
			height: '.((int)$header_sticky_height['height']).'px !important;
		}';
	}	
	$custom_css .='	
		.gt3_services_box_content {
			font-size:'.$content_font_size.';
			line-height:'.$content_line_height.';
			font-family:' . $content_font_family . ';
			font-weight:'.$content_font_weight.';
			background-color: '.$theme_color.';
		}
		.gt3_services_img_bg {
			background-color: '.$theme_color.';
		}
		.main_wrapper ul.gt3_list_check li:before,
		.main_wrapper ul.gt3_list_check_circle li:before,
		.main_wrapper ul.gt3_list_check_square li:before,
		.main_wrapper ul.gt3_list_angle_right li:before,
		.main_wrapper ul.gt3_list_plus li:before,
		.main_wrapper ul.gt3_list_times li:before {
			color: '.$theme_color.';
		}
	';

	// footer styles
	$footer_text_color = gt3_option_compare('footer_text_color','mb_footer_switch','yes');
	$footer_heading_color = gt3_option_compare('footer_heading_color','mb_footer_switch','yes');
	$custom_css .= '
		.top_footer .widget-title,
		.top_footer .widget.widget_archive ul li > a,
		.top_footer .widget.widget_categories ul li > a,
		.top_footer .widget.widget_pages ul li > a,
		.top_footer .widget.widget_meta ul li > a,
		.top_footer .widget.widget_recent_comments ul li > a,
		.top_footer .widget.widget_recent_entries ul li > a,
		.top_footer strong{
			color: '.esc_attr($footer_heading_color).' ;
		}
		
		.top_footer .widget.widget_categories ul li > a,
		.top_footer .widget.widget_nav_menu ul li > a,
    .top_footer {
    	color: '.esc_attr($footer_text_color).';
		}
	';

	$copyright_text_color = gt3_option_compare('copyright_text_color','mb_footer_switch','yes');
	$custom_css .= '
		.main_footer .copyright {
			color: '.esc_attr($copyright_text_color).';
		}
	';

	$header_on_bg = gt3_option('header_on_bg');
	$mobile_color = '';
	if (gt3_option('header_on_bg') == '1') {
		$mobile_background = gt3_option("mobile_background");
		$mobile_color = gt3_option("mobile_color");
	}

	$header_color = gt3_option_compare('header_color','mb_customize_header_layout','custom');

	if ($header_on_bg == '1') {
        foreach ($desktop_sides as $desktop_side) {
            $custom_css .= '@media only screen and (max-width: 767px){
                .gt3_header_builder__section--'.esc_attr($desktop_side).'{'
                . (!empty(${'side_' . $desktop_side . '_background_mobile'}) ? 'background-color: ' . esc_attr(${'side_' . $desktop_side . '_background_mobile'}) . ' !important;' : '')
                . (!empty(${'side_' . $desktop_side . '_color_mobile'}) ? 'color: ' . esc_attr(${'side_' . $desktop_side . '_color_mobile'}) . ' !important;' : '') . '
                }
            }';
        }        
    }

    foreach ($sections as $section) {
        $custom_css .= '
        .gt3_header_builder__section--'.$section.'{
            background-color:' . esc_attr(${'side_' . $section . '_background'}) . ';
            color:' . esc_attr(${'side_' . $section . '_color'}) . ';
            /*height:' . (int)${'side_' . $section . '_height'} . 'px;*/
        }
        .gt3_header_builder__section--'.$section.' .gt3_header_builder__section-container{
            height:' . (int)${'side_' . $section . '_height'} . 'px;
        }
        .gt3_header_builder__section--'.$section.' ul.menu{
            line-height:' . (int)${'side_' . $section . '_height'} . 'px;
        }
        .gt3_header_builder__section--'.$section.' .main-menu ul li ul li.menu-item-has-children:hover:after, 
		.gt3_header_builder__section--'.$section.' .main-menu > ul > li.menu-item-has-children:hover > a:after,
		.gt3_header_builder__section--'.$section.' .main-menu ul li ul.sub-menu .menu-item:hover > a,
		.gt3_header_builder__section--'.$section.' .main-menu ul li ul .menu-item.current-menu-item > a,
		.gt3_header_builder__section--'.$section.' .current-menu-ancestor > a,
		.gt3_header_builder__section--'.$section.' .main-menu .menu .menu-item.current-menu-item > a,
		.gt3_header_builder__section--'.$section.' .main-menu .menu .menu-item.current-menu-ancestor > a,
		.gt3_header_builder__section--'.$section.' .main-menu>ul>li:hover>a>span, 
		.gt3_header_builder__section--'.$section.' .main-menu>div>ul>li:hover>a>span,
        .gt3_header_builder__section--'.$section.' a:hover,
        .gt3_header_builder__section--'.$section.' .menu-item.active_item > a,
        .gt3_header_builder__section--'.$section.' .current-menu-item a,
        .gt3_header_builder__section--'.$section.' .current-menu-ancestor > a,
        .gt3_header_builder__section--'.$section.' .gt3_header_builder_login_component:hover .wpd_login__user_name,
        .gt3_header_builder__section--'.$section.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown a:hover, 
        .gt3_header_builder__section--'.$section.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown a:focus, 
        .gt3_header_builder__section--'.$section.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown .wpml-ls-current-language:hover > a, 
        .gt3_header_builder__section--'.$section.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown-click a:hover, 
        .gt3_header_builder__section--'.$section.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown-click a:focus, 
        .gt3_header_builder__section--'.$section.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown-click .wpml-ls-current-language:hover > a{
            color:' . esc_attr(${'side_' . $section . '_color_hover'}) . ';
        }
        .gt3_header_builder__section--'.$section.' .main_menu_container .menu_item_line{
        	background-color:' . esc_attr(${'side_' . $section . '_color_hover'}) . ';
        }
        ';

        if (${'side_' . $section . '_border'}) {
            if (!empty(${'side_' . $section . '_border_color'}['rgba'])) {
                $custom_css .= '
                .gt3_header_builder__section--' . $section . '{
                    border-bottom: 1px solid ' . esc_attr(${'side_' . $section . '_border_color'}['rgba']) . ';
                }';
            }
        }
    }

    if ($logo_limit_on_mobile == '1') {
		$logo_mobile_width = gt3_option("logo_mobile_width");
		if (!empty($logo_mobile_width['width'])) {
			$custom_css .= '@media only screen and (max-width: 767px){
				.header_side_container .logo_container:not(.logo_mobile_not_limited){
					max-width: '.(int)$logo_mobile_width['width'].'px;
				}
			}';
		}
	}    

    if ((bool)$header_sticky) {
    	foreach ($desktop_sides as $sticky_side) {            
            if ((bool)${'side_' . $sticky_side . '_sticky'}) {
                ${'side_' . $sticky_side . '_background_sticky'} = ${'side_' . $sticky_side . '_background_sticky'}['rgba'];
                ${'side_' . $sticky_side . '_height_sticky'} = ${'side_' . $sticky_side . '_height_sticky'}['height'];
                $custom_css .= '
                .sticky_header .gt3_header_builder__section--' . $sticky_side . '{
                    background-color:' . esc_attr(${'side_' . $sticky_side . '_background_sticky'}) . ';
                    color:' . esc_attr(${'side_' . $sticky_side . '_color_sticky'}) . ';
                }
                .sticky_header .gt3_header_builder__section--' . $sticky_side . ' .gt3_header_builder__section-container{
                    height:' . (int)${'side_' . $sticky_side . '_height_sticky'} . 'px;
                }
                .sticky_header .gt3_header_builder__section--' . $sticky_side . ' ul.menu{
                    line-height:' . (int)${'side_' . $sticky_side . '_height_sticky'} . 'px;
                }

                .sticky_header .gt3_header_builder__section--'.$sticky_side.' .main-menu ul li ul li.menu-item-has-children:hover:after,
				.sticky_header .gt3_header_builder__section--'.$sticky_side.' .main-menu > ul > li.menu-item-has-children:hover > a:after,
				.sticky_header .gt3_header_builder__section--'.$sticky_side.' .main-menu ul li ul.sub-menu .menu-item:hover > a,
				.sticky_header .gt3_header_builder__section--'.$sticky_side.' .main-menu ul li ul .menu-item.current-menu-item > a,
				.sticky_header .gt3_header_builder__section--'.$sticky_side.' .current-menu-ancestor > a,
				.sticky_header .gt3_header_builder__section--'.$sticky_side.' .main-menu .menu .menu-item.current-menu-item > a,
				.sticky_header .gt3_header_builder__section--'.$sticky_side.' .main-menu .menu .menu-item.current-menu-ancestor > a,
				.sticky_header .gt3_header_builder__section--'.$sticky_side.' .main-menu>ul>li:hover>a>span,
				.sticky_header .gt3_header_builder__section--'.$sticky_side.' .main-menu>div>ul>li:hover>a>span,
		        .sticky_header .gt3_header_builder__section--'.$sticky_side.' a:hover,
		        .sticky_header .gt3_header_builder__section--'.$sticky_side.' .menu-item.active_item > a,
		        .sticky_header .gt3_header_builder__section--'.$sticky_side.' .current-menu-item a,
		        .sticky_header .gt3_header_builder__section--'.$sticky_side.' .current-menu-ancestor > a,
		        .sticky_header .gt3_header_builder__section--'.$sticky_side.' .gt3_header_builder_login_component:hover .wpd_login__user_name,
		        .sticky_header .gt3_header_builder__section--'.$sticky_side.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown a:hover,
		        .sticky_header .gt3_header_builder__section--'.$sticky_side.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown a:focus,
		        .sticky_header .gt3_header_builder__section--'.$sticky_side.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown .wpml-ls-current-language:hover > a,
		        .sticky_header .gt3_header_builder__section--'.$sticky_side.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown-click a:hover,
		        .sticky_header .gt3_header_builder__section--'.$sticky_side.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown-click a:focus,
		        .sticky_header .gt3_header_builder__section--'.$sticky_side.' .gt3_header_builder_wpml_component .wpml-ls-legacy-dropdown-click .wpml-ls-current-language:hover > a{
		            color:' . esc_attr(${'side_' . $sticky_side . '_color_hover_sticky'}) . ';
		        }
		        .sticky_header .gt3_header_builder__section--'.$sticky_side.' .main_menu_container .menu_item_line{
		        	background-color:' . esc_attr(${'side_' . $sticky_side . '_color_hover_sticky'}) . ';
		        }


                ';
            }
        }
    }


	// WooCommerce
    $custom_css .= '
    .widget_product_search .woocommerce-product-search .search-field,
    .main_wrapper .image_size_popup_button,
    .clear_recently_products,
    .woocommerce li.gt3_widget_product_list .gt3_woo_widget_title span{
        color: '.$header_font_color.';
    }
	.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
	.woocommerce .widget_price_filter .ui-slider .ui-slider-range{
        background-color: '.$theme_color.';
	}
	
	.woocommerce div.product form.cart .qty,
	.woocommerce nav.woocommerce-pagination ul li a,
	.woocommerce nav.woocommerce-pagination ul li span{
		font-family: ' . $header_font_family . ';
	}
	.quantity-spinner.quantity-up:hover,
	.quantity-spinner.quantity-down:hover,
	.woocommerce table.shop_table .product-quantity .qty.allotted,
	.woocommerce div.product form.cart .qty.allotted,
	.woocommerce .gt3-products-header .gridlist-toggle:hover,
    .main_wrapper .image_size_popup_button:hover,
    .clear_recently_products:hover{
		color: '.$theme_color.';
	}

	.woocommerce #respond input#submit,
	.woocommerce a.button,
	.woocommerce button.button,
	.woocommerce input.button,
	.woocommerce #respond input#submit.alt,
	.woocommerce a.button.alt,
	.woocommerce button.button.alt,
	.woocommerce input.button.alt,
	.woocommerce #reviews #respond input#submit,
	.woocommerce #reviews a.button,
	.woocommerce #reviews button.button,
	.woocommerce #reviews input.button{
		color: '.$theme_color.';
		border-color: '.$theme_color.';
	}
	.woocommerce #respond input#submit:hover,
	.woocommerce a.button:hover,
	.woocommerce button.button:hover,
	.woocommerce input.button:hover,
	.woocommerce #respond input#submit.alt:hover,
	.woocommerce a.button.alt:hover,
	.woocommerce button.button.alt:hover,
	.woocommerce input.button.alt:hover,
	.woocommerce #reviews #respond input#submit:hover,
	.woocommerce #reviews a.button:hover,
	.woocommerce #reviews button.button:hover,
	.woocommerce #reviews input.button:hover,
	.woocommerce #respond input#submit.disabled:hover,
	.woocommerce #respond input#submit:disabled:hover,
	.woocommerce #respond input#submit:disabled[disabled]:hover,
	.woocommerce a.button.disabled:hover,
	.woocommerce a.button:disabled:hover,
	.woocommerce a.button:disabled[disabled]:hover,
	.woocommerce button.button.disabled:hover,
	.woocommerce button.button:disabled:hover,
	.woocommerce button.button:disabled[disabled]:hover,
	.woocommerce input.button.disabled:hover,
	.woocommerce input.button:disabled:hover,
	.woocommerce input.button:disabled[disabled]:hover{
		border-color: '.$theme_color.';
		background-color: '.$theme_color.';
	}
	.woocommerce div.product form.cart div.quantity:hover,
	.woocommerce div.product form.cart div.quantity:focus,
	.woocommerce div.product form.cart div.quantity:focus-within{
		border-bottom-color: '.$theme_color.';
	}
	.woocommerce div.product p.price,
	.woocommerce div.product span.price,
	.woocommerce ul.products li.product .price,	
	.single-product.woocommerce div.product .product_meta a:hover{
		color: '.$theme_color.';
	}

	.woocommerce #respond input#submit.alt.disabled,
	.woocommerce #respond input#submit.alt:disabled,
	.woocommerce #respond input#submit.alt:disabled[disabled],
	.woocommerce a.button.alt.disabled,
	.woocommerce a.button.alt:disabled,
	.woocommerce a.button.alt:disabled[disabled],
	.woocommerce button.button.alt.disabled,
	.woocommerce button.button.alt:disabled,
	.woocommerce button.button.alt:disabled[disabled],
	.woocommerce input.button.alt.disabled,
	.woocommerce input.button.alt:disabled,
	.woocommerce input.button.alt:disabled[disabled]{
		color: '.$theme_color.';
		border-color: '.$theme_color.';
	}
	.woocommerce #respond input#submit.alt.disabled:hover,
	.woocommerce #respond input#submit.alt:disabled:hover,
	.woocommerce #respond input#submit.alt:disabled[disabled]:hover,
	.woocommerce a.button.alt.disabled:hover,
	.woocommerce a.button.alt:disabled:hover,
	.woocommerce a.button.alt:disabled[disabled]:hover,
	.woocommerce button.button.alt.disabled:hover,
	.woocommerce button.button.alt:disabled:hover,
	.woocommerce button.button.alt:disabled[disabled]:hover,
	.woocommerce input.button.alt.disabled:hover,
	.woocommerce input.button.alt:disabled:hover,
	.woocommerce input.button.alt:disabled[disabled]:hover{
		background-color: '.$theme_color.';
		border-color: '.$theme_color.';
	}

	.image_size_popup .close,
	#yith-quick-view-content .product_meta,
	.single-product.woocommerce div.product .product_meta,
	.woocommerce div.product form.cart .variations td,
	.woocommerce div.product .woocommerce-tabs ul.tabs li,
	.woocommerce .widget_shopping_cart .total,
	.woocommerce.widget_shopping_cart .total,
	.woocommerce table.shop_table thead th,
	.main_wrapper .gt3_product_list_nav li .product_list_nav_text .nav_title,
	.main_wrapper .gt3_product_list_nav li .product_list_nav_text .nav_text,
	.woocommerce table.woocommerce-checkout-review-order-table tfoot td .woocommerce-Price-amount{
		color: '.$header_font_color.';
	}
	#yith-quick-view-content .product_meta a,
	#yith-quick-view-content .product_meta .sku,
	.single-product.woocommerce div.product .product_meta a,
	.single-product.woocommerce div.product .product_meta .sku,
	.select2-container--default .select2-selection--single .select2-selection__rendered{
		color: '.$content_color.';
	}
	#yith-quick-view-content .product_meta a:hover{
		color: '.$theme_color.';
	}

	.woocommerce .star-rating::before,
	.woocommerce #reviews p.stars span a,
	.woocommerce p.stars span a:hover~a::before,
	.woocommerce p.stars.selected span a.active~a::before{
		color: '.$content_color.';
	}
	
	.woocommerce nav.woocommerce-pagination ul li span.current,
	.woocommerce div.product > .woocommerce-tabs ul.tabs li.active a{
			background: '.$theme_color.';
	}
	.woocommerce nav.woocommerce-pagination ul li a:focus,
	.woocommerce nav.woocommerce-pagination ul li a:hover{
		color: '.$theme_color.';
	}
	.woocommerce .woocommerce-ordering select,
	.woocommerce .gridlist-toggle,
	.woocommerce .gt3-products-header .gt3-gridlist-toggle{
		background-color: '.$bg_body.';
	}
	';


	$label_color_sale = gt3_option('label_color_sale');
	$label_color_hot  = gt3_option('label_color_hot');
	$label_color_new  = gt3_option('label_color_new');
	if (is_array($label_color_sale) && isset($label_color_sale['rgba'])) {
		$custom_css .= '
		.woocommerce ul.products li.product .onsale,
		#yith-quick-view-content .onsale,
		.woocommerce span.onsale{
			background-color: '.esc_attr($label_color_sale['rgba']).';
		}';
	}

	if (is_array($label_color_hot) && isset($label_color_hot['rgba'])) {
		$custom_css .= '
		.woocommerce ul.products li.product .onsale.hot-product,
		#yith-quick-view-content .onsale.hot-product,
		.woocommerce span.onsale.hot-product{
			background-color: '.esc_attr($label_color_hot['rgba']).';
		}';
	}

	if (is_array($label_color_new) && isset($label_color_new['rgba'])) {
		$custom_css .= '
		.woocommerce ul.products li.product .onsale.new-product,
		#yith-quick-view-content .onsale.new-product,
		.woocommerce span.onsale.new-product{
			background-color: '.esc_attr($label_color_new['rgba']).';
		}';
	}
	// WooCommerce end


	$custom_css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $custom_css);
	wp_add_inline_style( 'gt3-composer-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'gt3_custom_styles' );