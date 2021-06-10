<?php
	$defaults = array(
		'title' => '',
		'package_is_active' => 'no',
		'price' => '',
		'header_img' => '',
		'price_prefix' => '',
		'price_suffix' => '',
		'price_description' => '',
	  	'button_link' => '',
		'item_el_class' => '',
		'css' => '',
	);

	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);
	$compile = '';

	$class_to_filter = vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $item_el_class );
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );


	// Header Image
	
	$img_id = preg_replace( '/[^\d]/', '', $header_img );
	$featured_image = wp_get_attachment_image_src($img_id, 'full');
	if (strlen($featured_image[0]) > 0) {
	  $featured_image_url = $featured_image[0];
	} else {
	  $featured_image_url = "";
	}
	
	// Button Settings
	$button_link_temp = vc_build_link($button_link);
	$url = $button_link_temp['url'];
	$link_title = $button_link_temp['title'];
	$target = $button_link_temp['target'];
	if($url !== '') {
		$url = $url;
	} else {
		$url = '#';
	}		
	if($link_title !== '') {
		$link_for_button = $link_title;
	} else {
		$link_for_button = '';
	}
	if($target !== '') {
		$button_target = 'target="' . esc_attr($target) . '"';
	} else {
		$button_target = '';
	}

	if (!empty($link_for_button) && !empty($url) ) {
		$button_link_html = '<div class="price_button"><a class="shortcode_button" href="'.esc_url($url).'" '.$button_target.'><span>' . $link_for_button . '</span></a></div>';
	} else {
		$button_link_html = '';
	}
	// Button Settings (End)

	$heading_text = $description_text = $heading_text = $description_text = $prefix_text = $suffix_text = $price_content = $price_wrapper = $price_val = '';
	// Package name
	if ($title != '') {
		$heading_text = '<div class="price_item_title"><h3>' . esc_html($title) . '</h3></div>';
	}
	// Package description
	if ($price_description != '') {
		$description_text = '<div class="price_item_description">' . $price_description . '</div>';
	}
	// Package price
	if ($price_prefix != '') {
		$prefix_text = '<span class="price_item_prefix">'.$price_prefix.'</span>';
	}
	if ($price_suffix != '') {
		$suffix_text = '<span class="price_item_suffix">'.$price_suffix.'</span>';
	}
	if ($price != '') {
		$price_val = '<span class="price_value">'.$price.'</span>';
	}
	$price_content = $price_prefix . $price . $price_suffix;

	if (strlen($price_content) > 0) {
		$price_wrapper = '<div class="price_content">' . $prefix_text . $price_val . $suffix_text . '</div>';
	}

	$header_style_bg = '';
	if (!empty($featured_image_url)) {
		$header_style_bg = 'style="background-image:url('.esc_attr($featured_image_url).');"';
	}	

	$header_style = '';
	$header_style .= !empty($price_title_font) ? $price_title_font : '';
	$content_style = !empty($price_content_font) ? 'style="'.$price_content_font.'"' : '';
	$header_class = (!empty($featured_image_url) ? ' with-image' : '');
	$header_class .= (!empty($price_title_font) ? ' custom-font' : '');

	$compile .= '
		<div class="price_item'.esc_attr($header_class).' '.($package_is_active == "yes" ? ' most_popular ' : ' standard').' '.esc_attr($css_class).'" '.$header_style_bg.'>
			<div class="price_item_wrapper">
				<div class="item_cost_wrapper ">
					<div class="package_head">
						<div class="item_cost_wrapper">
							' . $heading_text . $price_wrapper . $description_text . '
						</div>
						<div class="price_item_body">
							<div class="items_text">' .	wpb_js_remove_wpautop( $content, true ) . '
							</div>
							' .	$button_link_html . '
						</div>
					</div>
				</div>
			</div>
		</div>
	';
	
	echo (($compile));
?>
    
