<?php

$defaults = array(
    'build_query' => '',
    'title' => '',
    'subtitle' => '',
    'view_all_link' => '',
    'use_filter' => false,
    'show_view_all' => 'no',
    'module_on_dark_bg' => 'no',
    'posts_per_line' => '1',
    'item_el_class' => '',
    'css' => ''
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
$atts['build_query'] .= "|post_type:team";
extract($atts);
$compile = '';


$class_to_filter = vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $item_el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
$style_gap = isset($grid_gap) && !empty($grid_gap) ? ' style="margin-right:-'.esc_attr($grid_gap).'"' : '';

// Button Settings
if ($show_view_all == 'yes') {
    $view_all_link_temp = vc_build_link($view_all_link);
    $url = $view_all_link_temp['url'];
    $link_title = $view_all_link_temp['title'];
    $target = $view_all_link_temp['target'];
    if($url !== '') {
        $url = $url;
    } else {
        $url = '#';
    }       
    if($link_title !== '') {
        $link_for_button = 'title="' . esc_attr($link_title) . '"';
    } else {    
        $link_for_button = '';
        $link_title = esc_html__('All', 'surfy');
    }
    if($target !== '') {
        $button_target = 'target="' . esc_attr($target) . '"';
    } else {
        $button_target = '';
    }

    $view_all_link_html = '<a class="view_all_link shortcode_button btn_normal btn_type1" href="'.esc_url($url).'" '.$link_for_button.' '.$button_target.'>'.esc_html($link_title).'</a>';
} else {
    $view_all_link_html = '';
}
// Button Settings (End)
if ($use_filter) {
	wp_enqueue_script('gt3-isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, false);
}

$cat_objects = get_terms('team_category');
foreach ( $cat_objects as $cat_obj ) {
    $cat_slugs[] = array('slug' => $cat_obj->slug,
                        'name' => $cat_obj->name);

}
if ($module_on_dark_bg == 'yes') {
    $css_class .= ' module_on_dark_bg';
}
?>


<div class="vc_row">
    <div class="vc_col-sm-12 module_team <?php echo esc_attr($css_class); ?>">
    <?php
        if ($title != '') echo '<h3 class="module-team_title">' . $title . '</h3>';
        if ($show_view_all == 'yes') echo (($view_all_link_html));
        if ($subtitle != '') echo '<p>' . $subtitle . '</p>';        
    ?>
    	<div class="shortcode_team">
	        <div class="items<?php echo esc_attr($posts_per_line); ?>">
	        <?php if ($use_filter): ?>
	        	<div class="isotope-filter">
	        		<?php
                    echo '<a href="'. esc_js("javascript:void(0)") .'" class="active" data-filter="*">'.esc_html__("All", 'surfy').'</a>';
                    foreach ($cat_slugs as $cat_slug) {
                        echo '<a href="'. esc_js("javascript:void(0)") .'" data-filter="'.esc_attr('.'.$cat_slug['slug']).'">'.esc_html($cat_slug['name']).'</a>';
                    }
					?>
	        	</div>
	        <?php endif ?>
	          <ul class="item_list <?php echo  (bool) $use_filter ? "isotope" : ""; ?>" <?php echo  (($style_gap));?> >
	         		<?php
					echo render_gt3_team($atts, $build_query);
					?>
	            </ul>
	            <div class="clear"></div>
	        </div>
    	</div>
    </div>
</div>