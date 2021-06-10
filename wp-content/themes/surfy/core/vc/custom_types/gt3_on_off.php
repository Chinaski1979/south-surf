<?php
call_user_func('vc_add'.'_shortcode_param','gt3_on_off_function', get_template_directory_uri().'/core/vc/custom_types/js/gt3_on_off.js');
function gt3_on_off_function($settings, $value) {
	$gt3_return = '';
	$default = isset($settings['default']) ? $settings['default'] : 'on';
	
	$gt3_return .= '
	<div class="gt3_radio_selector d_block_middle">
		<div class="gt3_radio_toggle_cont gt3_on_off_style" data-value="'. esc_attr($value) .'">
			<input type="hidden" name="' . esc_attr( $settings['param_name'] ) . '" class="gt3_checkbox_value wpb_vc_param_value" value="'. esc_attr($value) .'">
			<div class="gt3_radio_toggle_mirage checked"></div>
		</div>
	</div>
	';
	return $gt3_return;
	
}