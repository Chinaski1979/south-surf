<?php


/**
* 
*/
class GT3TeamRegister{

	private $cpt;
	private $taxonomy;
	private $slug;
	
	function __construct(){
		$this->cpt = 'team';
		$this->taxonomy = $this->cpt.'_category';
        $this->taxonomy_pos = $this->cpt.'_position';
		$this->slug = 'team';
        if (function_exists('gt3_option')) {
            $slug_option = gt3_option('team_slug');
        }else{
            $slug_option = '';
        }
        if (empty($slug_option)) {
            $this->slug = 'team';
        }else{
            $this->slug = sanitize_title( $slug_option );
        }
	}

	public function register(){
		$this->registerPostType();
		$this->registerTax();
	}

	private function getSlug(){
		$slug  = $this->slug;
	}

	private function registerPostType(){

        register_post_type('team',
            array(
                'labels' 		=> array(
                    'name' 				=> __('Team','gt3_surfy_core' ),
                    'singular_name' 	=> __('Team Member','gt3_surfy_core' ),
                    'add_item'			=> __('New Team Member','gt3_surfy_core'),
                    'add_new_item' 		=> __('Add New Team Member','gt3_surfy_core'),
                    'edit_item' 		=> __('Edit Team Member','gt3_surfy_core')
                ),
                'public'		=>	true,
                'has_archive' => true,
                'capability_type' => 'post',
                'rewrite'       =>  array('slug' => $this->slug),
                'menu_position' => 	5,
                'show_ui' => true,
                'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
                'menu_icon'  =>  'dashicons-groups',
                'taxonomies' => array( $this->taxonomy_pos )
            )
        );

	}

	private function registerTax() {
        $labels = array(
            'name' => __( 'Team Categories', 'gt3_surfy_core' ),
            'singular_name' => __( 'Team Category', 'gt3_surfy_core' ),
            'search_items' =>  __( 'Search Team Categories','gt3_surfy_core' ),
            'all_items' => __( 'All Team Categories','gt3_surfy_core' ),
            'parent_item' => __( 'Parent Team Category','gt3_surfy_core' ),
            'parent_item_colon' => __( 'Parent Team Category:','gt3_surfy_core' ),
            'edit_item' => __( 'Edit Team Category','gt3_surfy_core' ),
            'update_item' => __( 'Update Team Category','gt3_surfy_core' ),
            'add_new_item' => __( 'Add New Team Category','gt3_surfy_core' ),
            'new_item_name' => __( 'New Team Category Name','gt3_surfy_core' ),
            'menu_name' => __( 'Team Categories','gt3_surfy_core' ),
        );

        register_taxonomy($this->taxonomy, array($this->cpt), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => self::getSlug().'-category' ),
        ));
    }

}
add_filter('the_content', 'gt3_fix_shortcodes_autop' );
function gt3_fix_shortcodes_autop($content){
    $array = array (
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']'
    );

    $content = strtr($content, $array);
    return $content;
}
function render_gt3_team_item ($posts_per_line, $single_member = false, $grid_gap = '') {
    $compile = "";
    $positions_array = get_post_meta(get_the_ID(), "position_member");
    $location_array = get_post_meta(get_the_id(), "location_member");
    $experience_array = get_post_meta(get_the_id(), "experience_member");
    $email_array = get_post_meta(get_the_id(), "email_member");
    $phone_array = get_post_meta(get_the_ID(), "phone_number", true);
    $url_array = get_post_meta(get_the_id(), "social_url", true);
    $icon_array = get_post_meta(get_the_id(), "icon_selection", true);
    $gt3_theme_pagebuilder = get_post_meta(get_the_ID(), "phone_number", true);
    $taxonomy_objects = get_object_taxonomies( 'team', 'objects' );
    $post_excerpt = (gt3_smarty_modifier_truncate(get_the_excerpt(), 80));
    $wp_get_attachment_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
    $post_cats = wp_get_post_terms(get_the_id(), 'team_category');
    $style_gap = isset($grid_gap) && !empty($grid_gap) ? ' style="padding-right:'.$grid_gap.';padding-bottom:'.$grid_gap.'"' : '';

    $post_cats_str = '';
    for ($i=0; $i<count( $post_cats ); $i++) {
        $post_cat_term = $post_cats[$i];
        $post_cat_name = $post_cat_term->slug;
        $post_cats_str .= ' '.$post_cat_name;
    }

    $positions_str = "";
    if (!empty($positions_array)) {
        for ( $i=0; $i<count( $positions_array[0] ); $i++ ){
            $position = $positions_array[0][$i];
            $positions_str .= "<span>$position</span>";
            $positions_str .= $i < count( $positions_array[0] ) - 1 ? __( ', ', 'gt3_surfy_core' ) : "";
        }    
    }
    
    $location_str = "";
    if (!empty($location_array)) {
        for ( $i=0; $i<count( $location_array[0] ); $i++ ){
            $location = $location_array[0][$i];
            $location_str .= "<span>$location</span>";
            $location_str .= $i < count( $location_array[0] ) - 1 ? __( ', ', 'gt3_surfy_core' ) : "";
        }    
    }
    
    $experience_str = "";
    if (!empty($experience_array)) {
        for ( $i=0; $i<count( $experience_array[0] ); $i++ ){
            $experience = $experience_array[0][$i];
            $experience_str .= "<span>$experience</span>";
            $experience_str .= $i < count( $experience_array[0] ) - 1 ? __( ', ', 'gt3_surfy_core' ) : "";
        }    
    }
    
    $email_str = "";
    if (!empty($email_array)) {
        for ( $i=0; $i<count( $email_array[0] ); $i++ ){
            $email = $email_array[0][$i];
            $email_str .= "<span>$email</span>";
            $email_str .= $i < count( $email_array[0] ) - 1 ? __( ', ', 'gt3_surfy_core' ) : "";
        }    
    }

    $phone_str = "";
    if (isset($phone_array) && !empty($phone_array)) {
        $phone_str = '<div class="team-member-phones">';
        for ( $i=0; $i<count($phone_array); $i++) {

            $phone_str .= '<span class="phone-number">';
            $phone_str .= $phone_array[$i];
            if (count($phone_array) > 1 && ($i+1)<count($phone_array)) {
                $phone_str .= ',';
            }            
            $phone_str .= '</span>';
        }
        $phone_str .= '</div>';
    }
    
    $url_str = "";
    if (isset($url_array) && !empty($url_array)) {
        for ( $i=0; $i<count( $url_array ); $i++ ){
            $url = $url_array[$i];
            $url_name = $url['name'];
            $url_address = $url['address'];
            $url_description = !empty($url['description']) ? $url['description'] : 'link to';
            if ($single_member && !empty($url_name) && !empty($url_address) ) {
                $url_str .= '<div><h5>'.$url_name.':</h5><a href="'.esc_attr($url_address).'" class="team-link">'.esc_html($url_description).'</a></div>';
            } elseif (!empty($url_name) && !empty($url_address)) {
                $url_str .= '<a href="'.esc_attr($url_address).'" class="team-link" title="'.esc_attr($url_description).'">'.esc_html($url_name).'</a>';
            }
            
        }
    }

    $icon_str = "";
    if (isset($icon_array) && !empty($icon_array)) {
        $icon_str .= '<div class="team-icons">';
        for ( $i=0; $i<count( $icon_array ); $i++ ){
            $icon = $icon_array[$i];
            $icon_name = !empty($icon['select']) ? $icon['select'] : '';
            $icon_address = !empty($icon['input']) ? $icon['input'] : '#';
            $icon_str .= !empty($icon['select']) ? '<a href="'.$icon_address.'" class="member-icon '.$icon_name.'"></a>' : '';
        }
        $icon_str .= '</div>';
    }


    if (strlen($wp_get_attachment_url)) {
        switch ($posts_per_line) {
            case "1":
                $gt3_featured_image_url = $wp_get_attachment_url;
                break;
            case "2":
                $gt3_featured_image_url = aq_resize($wp_get_attachment_url, "585", "585", true, true, true);
                break;
            case "3":
                $gt3_featured_image_url = aq_resize($wp_get_attachment_url, "390", "390", true, true, true);
                break;
            case "4":
                $gt3_featured_image_url = aq_resize($wp_get_attachment_url, "293", "293", true, true, true);
                break;
            default:
                $gt3_featured_image_url = aq_resize($wp_get_attachment_url, "1170", "1170", true, true, true);
        }
        $featured_image = '<img  src="' . $gt3_featured_image_url . '" alt="' . get_the_title() . '" />';
    } else {
        $featured_image = '';
    }
    if (!$single_member) {
        $compile .= '
            <li class="item-team-member'.$post_cats_str.'" '.$style_gap.'>
                <div class="item_wrapper">
                    <div class="item">
                        <div class="team_img featured_img">
                            <span> ' . $featured_image . '</span>
                        </div>
                       <a class="team__link-to-single" href="' . get_permalink(get_the_ID()) . '"></a>
						';
						$compile .= !empty($icon_str) ? '<div class="member-icons">' . $icon_str . '</div>' : '';
						$compile .= '                        
                        <div class="team-infobox">
                            <div class="team_title">
                                <h4><a href="' . get_permalink(get_the_ID()) . '">' . get_the_title() . '</a></h4>'
                                .(!empty($positions_str) ? '<span class="team-positions">'.$positions_str.'</span>' : '') .'
                            </div>
                            
                        </div>
                    </div>
                </div>
            </li>
            ';
    } else {
        $position_member_title = get_post_meta(get_the_id(), "position_member_title", true);
        $location_title = get_post_meta(get_the_id(), "location_title", true);
        $experience_title = get_post_meta(get_the_id(), "experience_title", true);
        $email_title = get_post_meta(get_the_id(), "email_title", true);
        $phone_title = get_post_meta(get_the_id(), "phone_title", true);

        $compile .= '
            <div class="vc_row wpb_row vc_row-fluid single-member-page">
                <div class="wpb_column vc_column_container vc_col-sm-7">
                    <div class="vc_column-inner"> 
                        <div class="team_img featured_img">
                            ' . $featured_image . '
                        </div>
                    </div>
                </div>
                <div class="wpb_column vc_column_container vc_col-sm-5">
                    <div class="vc_column-inner"> 
                        <div class="team-infobox">
                            <div class="team_title">
                                <h2>' . get_the_title() . '</h2>
                            </div>
                            <div class="team_info">';
                                $compile .= !empty($positions_str) ? '<div class="team-positions"><h5>'.(!empty($position_member_title) ? $position_member_title : 'Position:').'</h5>'.$positions_str.'</div>' : '';
                                $compile .= !empty($location_str) ? '<div class="member-locations"><h5>'.(!empty($location_title) ? $location_title : 'Location:').'</h5>' . $location_str . '</div>' : '';
                                $compile .= !empty($experience_str) ? '<div class="member-experience"><h5>'.(!empty($experience_title) ? $experience_title : 'Experience:').'</h5>' . $experience_str . '</div>' : '';
                                $compile .= !empty($email_str) ? '<div class="member-email"><h5>'.(!empty($email_title) ? $email_title : 'Email:').'</h5>' . $email_str . '</div>' : '';
                                $compile .= !empty($url_str) ? '<div class="member-urls"><div class="team-links">' . $url_str . '</div></div>' : '';
                                $compile .= !empty($phone_str) ? '<div class="member-phones"><h5>'.(!empty($phone_title) ? $phone_title : 'Tel:').'</h5>' . $phone_str . '</div>' : '';
                                $compile .= !empty($icon_str) ? '<div class="member-icons">' . $icon_str . '</div>' : '';
                                /*'.(!empty($positions_str) ? '<div class="team-positions">'.$positions_str.'</div>' : '') .'
                                <div class="team_desc">' . $location_str . '</div>
                                <div class="team_icons_wrapper">';
                                $compile .= $phone_str;
                                $compile .= $url_str;*/
                            $compile .= '
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
    }
    
    return $compile;
}

function render_gt3_team ($atts, $build_query) {
    extract($atts);
    list($query_args, $build_query) = vc_build_loop_query($build_query);
    $gt3_posts = new WP_Query($query_args);
    $gt3_pid = get_the_ID();
    gt3_get_all_icon();
    $grid_gap = isset($grid_gap) && !empty($grid_gap) ? $grid_gap : '0';
    $compile = '';
    if ($gt3_posts->have_posts()):
        
        while ($gt3_posts->have_posts()):
            $gt3_posts -> the_post();
            $compile .= render_gt3_team_item($posts_per_line, false, $grid_gap);
        endwhile;
        wp_reset_postdata();
    endif;
    echo  $compile;
}
?>