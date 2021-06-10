<?php
function gt3_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'gt3_content_width', 940 );
}
add_action( 'after_setup_theme', 'gt3_content_width', 0 );


if (!function_exists('gt3_get_theme_option')) {
    function gt3_get_theme_option($optionname, $defaultValue = null)
    {
        $gt3_options = get_option("surfy_gt3_options");

        if (isset($gt3_options[$optionname])) {
            if (gettype($gt3_options[$optionname]) == "string") {
                return stripslashes($gt3_options[$optionname]);
            } else {
                return $gt3_options[$optionname];
            }
        } else {
            return $defaultValue;
        }
    }
}

if(!function_exists('gt3_option')) {
    function gt3_option($name) {

        if (  class_exists( 'Redux' ) ) {
            $theme_options = get_option( 'surfy' );
            if (empty($theme_options)) {
                $theme_options = get_option( 'surfy_default_options' );
            }
            return isset($theme_options[$name]) ? $theme_options[$name] : null;
        }else{
            $default_option = get_option( 'surfy_default_options' );
            return isset($default_option[$name]) ? $default_option[$name] : null;
        }


    }
}

if (!function_exists('gt3_theme_comment')) {
    function gt3_theme_comment($comment, $args, $depth)
    {
        $max_depth_comment = ($args['max_depth'] > 4 ? 4 : $args['max_depth']);

        $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>" class="stand_comment">
            <div class="thiscommentbody">
                <div class="commentava">
                    <?php echo get_avatar($comment->comment_author_email, 120); ?>
                </div>
                <div class="comment_info">
                    <div class="comment_author_says"><?php printf('%s', get_comment_author_link()) ?></div>
                    <div class="listing_meta">
                        <span><?php printf('%1$s', get_comment_date()) ?></span>
                        <?php edit_comment_link('<span>('.esc_html__('Edit', 'surfy').')</span>', '  ', '') ?>
                    </div>
                </div>
                <div class="comment_content">
                    <?php if ($comment->comment_approved == '0') : ?>
                        <p><?php esc_html_e('Your comment is awaiting moderation.', 'surfy'); ?></p>
                    <?php endif; ?>
                    <?php comment_text() ?>
                </div>
                <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'reply_text' => '' . esc_html__('Reply', 'surfy'), 'max_depth' => $max_depth_comment))) ?>
            </div>
        </div>
        <?php
    }
}

#Custom paging
if (!function_exists('gt3_get_theme_pagination')) {
    function gt3_get_theme_pagination($range = 5, $type = "")
    {
        if ($type == "show_in_shortcodes") {
            global $paged, $gt3_wp_query_in_shortcodes;
            $wp_query = $gt3_wp_query_in_shortcodes;
        } else {
            global $paged, $wp_query;
        }
        if (empty($paged)) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        }

        $compile = '';
        $max_page = $wp_query->max_num_pages;

        if ($max_page > 1) {
            $compile .= '<ul class="pagerblock">';
        }
        if($paged > 1) $compile .= '<li class="prev_page"><a href="' .esc_url(get_pagenum_link($paged - 1)) . '"><i class="fa fa-angle-left"></i></a></li>';
        if ($max_page > 1) {
            if (!$paged) {
                $paged = 1;
            }
            if ($max_page > $range) {
                if ($paged < $range) {
                    for ($i = 1; $i <= ($range + 1); $i++) {
                        $compile .= "<li><a href='" . esc_url(get_pagenum_link($i)) . "'";
                        if ($i == $paged) $compile .= " class='current'";
                        $compile .= ">$i</a></li>";
                    }
                } elseif ($paged >= ($max_page - ceil(($range / 2)))) {
                    for ($i = $max_page - $range; $i <= $max_page; $i++) {
                        $compile .= "<li><a href='" . esc_url(get_pagenum_link($i)) . "'";
                        if ($i == $paged) $compile .= " class='current'";
                        $compile .= ">$i</a></li>";
                    }
                } elseif ($paged >= $range && $paged < ($max_page - ceil(($range / 2)))) {
                    for ($i = ($paged - ceil($range / 2)); $i <= ($paged + ceil(($range / 2))); $i++) {
                        $compile .= "<li><a href='" . esc_url(get_pagenum_link($i)) . "'";
                        if ($i == $paged) $compile .= " class='current'";
                        $compile .= ">$i</a></li>";
                    }
                }
            } else {
                for ($i = 1; $i <= $max_page; $i++) {
                    $compile .= "<li><a href='" . esc_url(get_pagenum_link($i)) . "'";
                    if ($i == $paged) $compile .= " class='current'";
                    $compile .= ">$i</a></li>";
                }
            }
        }
        if ($paged < $max_page) $compile .= '<li class="next_page"><a href="' . esc_url(get_pagenum_link($paged + 1)) . '"><i class="fa fa-angle-right"></i></a></li>';
        if ($max_page > 1) {
            $compile .= '</ul>';
        }

		return $compile;
    }
}


if (!function_exists('gt3_HexToRGB')) {
    function gt3_HexToRGB($hex = "#ffffff")
    {
        $color = array();
        if (strlen($hex) < 1) {
            $hex = "#ffffff";
        }

        $color['r'] = hexdec(substr($hex, 1, 2));
        $color['g'] = hexdec(substr($hex, 3, 2));
        $color['b'] = hexdec(substr($hex, 5, 2));

        return $color['r'] . "," . $color['g'] . "," . $color['b'];
    }
}

if (!function_exists('gt3_smarty_modifier_truncate')) {
    function gt3_smarty_modifier_truncate($string, $length = 80, $etc = '... ', $break_words = false) {
        if ($length == 0)
            return '';

        if (mb_strlen($string, 'utf8') > $length) {
            $length -= mb_strlen($etc, 'utf8');
            if (!$break_words) {
                $string = preg_replace('/\s+\S+\s*$/su', '', mb_substr($string, 0, $length + 1, 'utf8'));
            }
            return mb_substr($string, 0, $length, 'utf8') . $etc;
        } else {
            return $string;
        }
    }
}

if (!function_exists('gt3_get_pf_type_output')) {
	function gt3_get_pf_type_output($pf, $width, $height, $featured_image, $post_category_compile = '')
	{
        $compile = "";

        $featured_standard = '<div class="blog_post_media"><a href="' . esc_url(get_permalink()) . '"><img src="' . esc_url($featured_image[0]) . '" alt="'. esc_attr__('Featured image', 'surfy') .'" /></a>'.$post_category_compile.'</div>';

        if (class_exists( 'RWMB_Loader' )) {

            $pf_post_content = $quote_author = $quote_text = $link = $link_text = $pf_post_meta ='';

            switch($pf) {
                case 'gallery':
                    $pf_post_content = rwmb_meta('post_format_gallery_images');
                    $pf_post_meta = get_post_meta(get_the_ID(), 'post_format_gallery_images');
                    break;

                case 'video':
                    $pf_post_content = rwmb_meta('post_format_video_oEmbed', 'type=oembed');
                    $pf_post_meta = get_post_meta(get_the_ID(), 'post_format_video_oEmbed');
                    break;

                case 'audio':
                    $pf_post_content = rwmb_meta('post_format_audio_oEmbed', 'type=oembed');
                    $pf_post_meta = get_post_meta(get_the_ID(), 'post_format_audio_oEmbed');
                    break;

                case 'quote':
                    $quote_author = rwmb_meta('post_format_qoute_author');
                    $quote_text = rwmb_meta('post_format_qoute_text');
                    $pf_post_content = $quote_author . $quote_text;
                    break;

                case 'link':
                    $link = rwmb_meta('post_format_link');
                    $link_text = rwmb_meta('post_format_link_text');
                    $pf_post_content = $link . $link_text;
                    break;
            }

            /* Gallery */
            if ($pf == 'gallery' && !empty($pf_post_meta)) {
                if (!empty($pf_post_content)) {
                    if (count($pf_post_content) == 1) {
                        $onlyOneImage = "oneImage";
                    } else {
                        $onlyOneImage = "";
                    }
                    $compile .= '
                    <div class="blog_post_media">
                        <div class="slider-wrapper theme-default ' . esc_attr($onlyOneImage) . '">
                            <div class="nivoSlider">';

                    foreach ($pf_post_content as $image) {
                        $img_url = $image["full_url"];
                        $compile .= "<img src='" . esc_url(aq_resize($img_url, $width, $height, true, true, true)) . "' alt='". esc_attr__('Slider image', 'surfy') ."' />";
                    }

                    $compile .= '
                            </div>
                        </div>'.$post_category_compile.'
                    </div>';
                    wp_enqueue_script('gt3-nivo', get_template_directory_uri() . '/js/nivo.js', array(), false, true);
                }
            /* Video */
            } else if ($pf == 'video' && !empty($pf_post_meta)) {
                $compile .= '<div class="blog_post_media">' . $pf_post_content . $post_category_compile . '</div>';
            /* Audio */
            } else if ($pf == 'audio' && !empty($pf_post_meta)) {
                $compile .= '<div class="blog_post_media">' . $pf_post_content . $post_category_compile . '</div>';
            /* Quote */
            } else if ($pf == 'quote' && strlen($pf_post_content) > 0) {
                $compile .= '<div class="blog_post_media">' . (strlen($quote_text) ? '<h3 class="blogpost_title"><i class="post-quote-icon"></i>' . esc_html($quote_text) . '</h3>' : '') . '' . (strlen($quote_author) ? '<div class="post_media_info">' . esc_html($quote_author) . '</div>' : '') . '</div>';
            /* Link */
            } else if ($pf == 'link' && strlen($pf_post_content) > 0) {
                $compile .= '<div class="blog_post_media"><h3 class="blogpost_title"><i class="fa fa-link"></i>';
                    if (strlen($link) > 0) {
                        $compile .= '<a href="' . esc_url($link) . '">';
                    }
                    if (strlen($link_text) > 0) {
                        $compile .= '' . esc_html($link_text) . '';
                    } else {
                        $compile .= '' . esc_url($link) . '';
                    }
                    if (strlen($link) > 0) {
                        $compile .= '</a>';
                    }
                $compile .= '</h3></div>';
            /* Standard */
            } else {
                $pf = 'standard';
                if (strlen($featured_image[0]) > 0) {
                    $compile .= '' . $featured_standard . '';
                    $pf = 'standard-image';
                }
            }
        } else {
            $pf = 'standard';
            if (strlen($featured_image[0]) > 0) {
                $compile .= '' . $featured_standard . '';
                $pf = 'standard-image';
            }
        }

        $compile = array(
            'content' => $compile,
            'pf' => $pf
        );

        return $compile;
	}
}


if (!function_exists('gt3_get_field_media_and_attach_id')) {
    function gt3_get_field_media_and_attach_id($name, $attach_id, $previewW = "200px", $previewH = null, $classname = "")
    {
        return "<div class='select_image_root " . esc_attr($classname) . "'>
        <input type='hidden' name='" .  esc_attr($name) . "' value='" .  esc_attr($attach_id) . "' class='select_img_attachid'>
        <div class='select_img_preview'><img src='" . esc_url(($attach_id > 0 ? aq_resize(wp_get_attachment_url($attach_id), $previewW, $previewH, true, true, true) : "")) . "' alt='". esc_attr($name) ."'></div>
        <input type='button' class='button button-secondary button-large select_attach_id_from_media_library' value='" .  esc_attr__('Select', 'surfy') . "'>
    </div>";
    }
}

function gt3_theme_slug_setup()
{
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'gt3_theme_slug_setup');

require_once(get_template_directory() . "/core/loader.php");

add_action('init', 'gt3_page_init');
if (!function_exists('gt3_page_init')) {
    function gt3_page_init()
    {
        add_post_type_support('page', 'excerpt');
    }
}

/// Post Page Settings //


/*Work with options*/
if (!function_exists('gt3pb_get_option')) {
    function gt3pb_get_option($optionname, $defaultValue = "")
    {
        $returnedValue = get_option("gt3pb_" . $optionname, $defaultValue);

        if (gettype($returnedValue) == "string") {
            return stripslashes($returnedValue);
        } else {
            return $returnedValue;
        }
    }
}

if (!function_exists('gt3pb_delete_option')) {
    function gt3pb_delete_option($optionname)
    {
        return delete_option("gt3pb_" . $optionname);
    }
}

if (!function_exists('gt3pb_update_option')) {
    function gt3pb_update_option($optionname, $optionvalue)
    {
        if (update_option("gt3pb_" . $optionname, $optionvalue)) {
            return true;
        }
    }
}

add_action('wp_footer','gt3_wp_footer');
function gt3_wp_footer() {
    echo gt3_get_theme_option("code_before_body");
}

if (!function_exists('gt3_get_image_bg')) {
    function gt3_get_image_bg($gt3_img_src, $gt3_is_grid) {
		if (isset($gt3_is_grid) && $gt3_is_grid == 'yes') {
			echo "<div class='fullscreen_block fw_background bg_image grid_background image_video_bg_block' data-bg='" . esc_url($gt3_img_src) . "'></div>";
		} else {
			echo "<div class='fullscreen_block fw_background bg_image image_video_bg_block' data-bg='" . esc_url($gt3_img_src) . "'></div>";
		}
	}
}
if (!function_exists('gt3_get_color_bg')) {
    function gt3_get_color_bg($gt3_bg_color) {
		echo "<div class='fullscreen_block fw_background bg_color grid_background' data-bgcolor='" . esc_attr($gt3_bg_color) . "'></div>";
	}
}

if (!function_exists('gt3_page_title')) {
    function gt3_page_title(){
        if (is_home() || is_front_page()) {
            $title = '';
        }elseif (class_exists('WooCommerce') && is_product()) {
	        if (gt3_option('product_title_conditional') == '1') {
		        $title = esc_html(get_the_title());
	        }else{
		        $title = '';
	        }
        }elseif (class_exists('WooCommerce') && is_product_category()) {
	        $title = single_cat_title('', false);
        }elseif (class_exists('WooCommerce') && is_product_tag()) {
	        $title = single_term_title("", false);
        }elseif (class_exists('WooCommerce') && is_woocommerce()) {
	        $title = woocommerce_page_title(false);
        }elseif (is_category()) {
            $title = single_cat_title('', false);
        }elseif (is_tag()) {
            $title = single_term_title("", false).esc_html__(' Tag', 'surfy');
        }elseif (is_date()) {
            $title = esc_html(get_the_time('F Y'));
        }elseif(is_author()){
            $title = esc_html__('Author:', 'surfy') . " " . esc_html(get_the_author());
        }elseif (is_search()) {
            $title = esc_html__('Search', 'surfy');
        }elseif (is_404()) {
            $title = '';
        }elseif (is_archive()) {
            $title = esc_html__('Archive','surfy');
        }elseif(is_home() || is_front_page()){
            $title = '';
        }else{
            global $post;
            $id = $post->ID;
            $title = esc_html(get_the_title($id));
        }
        return $title;
    }
}


function gt3_the_breadcrumb()
{
    $showOnHome = 1;
    $delimiter = esc_html__(' / ', 'surfy');
    $home = esc_html__('Home', 'surfy');
    $showCurrent = 1;
    $before = '<span class="current">';
    $after = '</span>';
    global $post;
    $homeLink = esc_url(home_url('/'));

	if ( class_exists('WooCommerce') && is_woocommerce() ) {
		echo '<div class="breadcrumbs">';
		woocommerce_breadcrumb();
		echo '</div>';

	}else if (is_home() || is_front_page()) {
        if ($showOnHome == 1) echo '<div class="breadcrumbs"><span>' . $home . '</span></div>';
    } else {

        echo '<div class="breadcrumbs"><a href="' . $homeLink . '">' . $home . '</a>' . $delimiter . '';
        if (is_category()) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
            echo  wp_kses_post($before) . esc_html__('Archive','surfy').' "' . esc_html(single_cat_title('', false)) . '"' . $after;

        }
        elseif (get_post_type() == 'port') {

            the_terms($post->ID, 'portcat', '', '', '');

            if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . esc_html(get_the_title()) . $after;

        } elseif (is_search()) {
            echo  wp_kses_post($before) . esc_html__('Search for','surfy').' "' . esc_html(get_search_query()) . '"' . $after;

        } elseif (is_day()) {
            echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a> ' . $delimiter . ' ';
            echo '<a href="' . esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) . '">' . esc_html(get_the_time('F')) . '</a> ' . $delimiter . ' ';
            echo  wp_kses_post($before) . esc_html(get_the_time('d')) . $after;

        } elseif (is_month()) {
            echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a> ' . $delimiter . ' ';
            echo  wp_kses_post($before) . esc_html(get_the_time('F')) . $after;

        } elseif (is_year()) {
            echo  wp_kses_post($before) . esc_html(get_the_time('Y')) . $after;

        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {

                $parent_id = $post->post_parent;
                if ($parent_id > 0) {
                    $breadcrumbs = array();
                    while ($parent_id) {
                        $page = get_page($parent_id);
                        $breadcrumbs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html(get_the_title($page->ID)) . '</a>';
                        $parent_id = $page->post_parent;
                    }
                    $breadcrumbs = array_reverse($breadcrumbs);
                    for ($i = 0; $i < count($breadcrumbs); $i++) {
                        echo  wp_kses_post($breadcrumbs[$i]);
                        if ($i != count($breadcrumbs) - 1) echo ' ' . $delimiter . ' ';
                    }
                    if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . esc_html(get_the_title()) . $after;
                } else {
                    echo wp_kses_post($before) . esc_html(get_the_title()) . $after;
                }

            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                echo  wp_kses_post($cats);
                if ($showCurrent == 1) echo wp_kses_post($before) . esc_html(get_the_title()) . $after;
            }

        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            echo wp_kses_post($before) . esc_html($post_type->labels->singular_name) . $after;

        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo '<a href="' . esc_url(get_permalink($parent)) . '">' . esc_html($parent->post_title) . '</a>';
            if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . esc_html(get_the_title()) . $after;

        } elseif (is_page() && !$post->post_parent) {
            if ($showCurrent == 1) echo  wp_kses_post($before) . esc_html(get_the_title()) . $after;


        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html(get_the_title($page->ID)) . '</a>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo  wp_kses_post($breadcrumbs[$i]);
                if ($i != count($breadcrumbs) - 1) echo ' ' . $delimiter . ' ';
            }
            if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . esc_html(get_the_title()) . $after;

        } elseif (is_tag()) {
            echo wp_kses_post($before) . esc_html__('Tag','surfy').' "' . esc_html(single_tag_title('', false)) . '"' . $after;

        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo wp_kses_post($before) . esc_html__('Author','surfy').' ' . esc_html($userdata->display_name) . $after;

        } elseif (is_404()) {
            echo wp_kses_post($before) . esc_html__('Error 404','surfy') . $after;
        }

        echo '</div>';

    }
}


if (!function_exists('gt3_get_page_title')) {
    function gt3_get_page_title($id) {

        $page_title_conditional = ((gt3_option('page_title_conditional') == '1' || gt3_option('page_title_conditional') == true)) ? 'yes' : 'no' ;

	    $product_title_conditional = ((gt3_option('product_title_conditional') == '1' || gt3_option('product_title_conditional') == true)) ? 'yes' : 'no';
	    $shop_cat_title_conditional = ((gt3_option('shop_cat_title_conditional') == '1' || gt3_option('shop_cat_title_conditional') == true)) ? 'yes' : 'no';

	    if (class_exists('WooCommerce') && is_product() && $page_title_conditional == 'yes' && $product_title_conditional == 'no') {
		    $page_title_conditional = 'no';
	    }
	    if (class_exists('WooCommerce') && is_product_category() && $page_title_conditional == 'yes' && $shop_cat_title_conditional == 'no' ) {
		    $page_title_conditional = 'no';
	    }

	    $page_title_bottom_margin = gt3_option("page_title_bottom_margin");
        $page_title_bottom_margin = !empty($page_title_bottom_margin['margin-bottom']) ? (int)$page_title_bottom_margin['margin-bottom'] : '';
        $masked_row = '';
        if ($page_title_conditional == 'yes') {
            $page_title_breadcrumbs_conditional = gt3_option("page_title_breadcrumbs_conditional") == '1' ? 'yes' : 'no';
            $page_title_vert_align = gt3_option("page_title_vert_align");
            $page_title_horiz_align = gt3_option("page_title_horiz_align");
            $page_title_font_color = gt3_option("page_title_font_color");
            $page_title_bg_color = gt3_option("page_title_bg_color");
            $page_title_bg_image_array = gt3_option("page_title_bg_image");
            $masked_row = gt3_option("masked_row") == '1' ? 'yes' : 'no';
            $mask_image = gt3_option("mask_image");
            $mask_image = !empty($mask_image) ? $mask_image['url'] : '';
            $header_logo_src = gt3_option("header_logo");

            $page_title_height = gt3_option("page_title_height");
            $page_title_height = $page_title_height['height'];
            $header_height = gt3_option('header_height');
            $header_height = $header_height['height'];

            if (gt3_option('header_on_bg') == '1') {
                if (gt3_option('top_header_bar_left') == '1' || gt3_option('top_header_bar_right') == '1') {
                    $top_header_height = 40;
                }else{
                    $top_header_height = 0;
                }
                $header_height = gt3_option("header_height");
                $page_title_top_padding = !empty($header_height['height']) ? 20 + (int)$header_height['height'] + (int)$top_header_height : '';
            }else{
                $page_title_top_padding = '';
            }
        }

	    if (class_exists('WooCommerce') && is_product_category()) {
		    $term = get_queried_object();
		    if ( $term && ! empty( $term->description ) ) {
			    $page_sub_title = $term->description;
		    }
	    }

        if (class_exists( 'RWMB_Loader' ) && $id !== 0) {
            $page_sub_title = rwmb_meta('mb_page_sub_title');
            $mb_page_title_conditional = rwmb_meta('mb_page_title_conditional');
            if ($mb_page_title_conditional == 'yes') {
                $page_title_conditional = 'yes';
                $page_title_breadcrumbs_conditional = rwmb_meta('mb_show_breadcrumbs') == '1' ? 'yes' : 'no';
                $page_title_vert_align = rwmb_meta('mb_page_title_vertical_align');
                $page_title_horiz_align = rwmb_meta('mb_page_title_horizontal_align');
                $page_title_font_color = rwmb_meta('mb_page_title_font_color');
                $page_title_bg_color = rwmb_meta('mb_page_title_bg_color');
                $masked_row = rwmb_meta('mb_masked_row') == '1' ? 'yes' : 'no';


                $mb_mask_image = rwmb_meta("mb_mask_image");
                if (!empty($mb_mask_image)) {
                    $mb_mask_image = array_values($mb_mask_image);
                    $mask_image = $mb_mask_image[0]['url'];
                }


                $page_title_height = rwmb_meta('mb_page_title_height');
            }elseif($mb_page_title_conditional == 'no'){
                $page_title_conditional = 'no';
            }
        }


        $page_title_classes = !empty($page_title_horiz_align) ? ' gt3-page-title_horiz_align_'.esc_attr($page_title_horiz_align) : 'gt3-page-title_horiz_align_left';
        $page_title_classes .= !empty($page_title_vert_align) ? ' gt3-page-title_vert_align_'.esc_attr($page_title_vert_align) : 'gt3-page-title_vert_align_middle';


        $page_title_styles = !empty($page_title_bg_color) ? 'background-color:'.esc_attr($page_title_bg_color).';' : '';
        $page_title_styles .= !empty($page_title_top_padding) ? 'padding-top:'.esc_attr($page_title_top_padding).'px;' : '';
        $page_title_styles .= !empty($page_title_height) ? 'height:'.esc_attr($page_title_height).'px;' : '';
        $page_title_styles .= !empty($page_title_font_color) ? 'color:'.esc_attr($page_title_font_color).';' : '';
        $page_title_styles .= !empty($page_title_bottom_margin) ? 'margin-bottom:'.esc_attr($page_title_bottom_margin).'px;' : '';

        $page_title_styles .= gt3_background_render('page_title','mb_page_title_conditional','yes');

        if ($masked_row == 'yes' && !empty($mask_image)) {
            $page_title_styles .= '-webkit-mask-image: url('.esc_url($mask_image).');
            mask-image: url('.esc_url($mask_image).');
            ';
            $page_title_classes .= ' gt3_mask_image';
        }

        $gt3_page_title = gt3_page_title();

	    if ( $page_title_conditional == 'yes' && !is_404() && ( !empty($gt3_page_title) || ( class_exists('WooCommerce') &&  is_product() && gt3_option('product_cat_name_conditional') == '1') ) ) {
            echo "<div class='gt3-page-title". (!empty($page_title_classes) ? esc_attr($page_title_classes) : '' ) ."'".( !empty($page_title_styles) ? ' style="'.esc_attr($page_title_styles).'"' : '').">";
                echo "<div class='gt3-page-title__inner'>";
                    echo "<div class='container'>";
                        echo "<div class='gt3-page-title__content'>";
                            echo "<div class='page_title'><h1>";
                                echo  esc_html($gt3_page_title);
                            echo "</h1>";
                            if (!empty($page_sub_title) && $page_title_horiz_align != 'center') {
                                echo "<div class='page_sub_title'><div>";
                                echo esc_attr( $page_sub_title );
                                echo "</div></div>";
                            }
                            echo "</div>";
                            if (!empty($page_sub_title) && $page_title_horiz_align == 'center') {
                                echo "<div class='page_sub_title'><div>";
                                echo esc_attr( $page_sub_title );
                                echo "</div></div>";
                            }
                            if ($page_title_breadcrumbs_conditional == 'yes') {
                                echo "<div class='gt3_breadcrumb'>";
                                    gt3_the_breadcrumb();
                                echo "</div>";
                            }
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";

        }
    }
}



if (!function_exists('gt3_get_logo')) {
    function gt3_get_logo() {
        $header_logo_src = gt3_option("header_logo");
        $header_logo_src = !empty($header_logo_src) ? $header_logo_src['url'] : '';
        $logo_light_src = gt3_option("logo_light");
        $logo_light_src = !empty($logo_light_src) ? $logo_light_src['url'] : '';
        $logo_dark_src =  gt3_option("logo_dark");
        $logo_dark_src =  !empty($logo_dark_src) ? $logo_dark_src['url'] : '';
        $logo_sticky_src =  gt3_option("logo_sticky");
        $logo_sticky_src =  !empty($logo_sticky_src) ? $logo_sticky_src['url'] : '';
        $logo_mobile_src =  gt3_option("logo_mobile");
        $logo_mobile_src =  !empty($logo_mobile_src) ? $logo_mobile_src['url'] : '';
        $logo_limit_on_mobile = gt3_option("logo_limit_on_mobile");

        if (class_exists( 'RWMB_Loader' ) && gt3_get_queried_object_id() !== 0) {
            if (rwmb_meta('mb_customize_logo') == 'custom') {
                $mb_header_logo_src = rwmb_meta("mb_header_logo");
                if (!empty($mb_header_logo_src)) {
                    $header_logo_src = array_values($mb_header_logo_src);
                    $header_logo_src = $header_logo_src[0]['full_url'];
                }
                $mb_logo_sticky_src = rwmb_meta("mb_logo_sticky");
                if (!empty($mb_logo_sticky_src)) {
                    $logo_sticky_src = array_values($mb_logo_sticky_src);
                    $logo_sticky_src = $logo_sticky_src[0]['full_url'];
                }
                $mb_logo_mobile_src = rwmb_meta("mb_logo_mobile");
                if (!empty($mb_logo_mobile_src)) {
                    $logo_mobile_src = array_values($mb_logo_mobile_src);
                    $logo_mobile_src = $logo_mobile_src[0]['full_url'];
                }
            }
        }

        $logo_height_custom = gt3_option('logo_height_custom');
        $logo_height = gt3_option('logo_height');
        $logo_height = $logo_height['height'];
        $logo_max_height = gt3_option('logo_max_height');
        $sticky_logo_height = gt3_option('sticky_logo_height');
        $sticky_logo_height = $sticky_logo_height['height'];

        // height for logo
        $header_height = gt3_option('header_height');
        $header_height = $header_height['height'];


        if (class_exists( 'RWMB_Loader' ) && gt3_get_queried_object_id() !== 0) {
            if (rwmb_meta('mb_customize_logo') == 'custom') {
                if (rwmb_meta('mb_logo_height_custom') == '1') {
                    $logo_height_custom = rwmb_meta('mb_logo_height_custom');
                    $logo_height = rwmb_meta('mb_logo_height');
                    $logo_max_height = rwmb_meta('mb_logo_max_height');
                    $sticky_logo_height = rwmb_meta('mb_sticky_logo_height');
                }
            }
            if (rwmb_meta('mb_customize_header_layout') == 'custom') {
                $header_height = rwmb_meta("mb_header_height");
            }
        }

        if (!empty($header_height) && $logo_max_height != '1') {
            $header_height_css = ' style="max-height:'.esc_attr($header_height*0.9).'px;"';
        }else{
            $header_height_css = '';
        }

        $logo_height_style = '';
        if (!empty($logo_height) && $logo_height_custom == '1') {
            $logo_height_style .= 'height:'.(esc_attr($logo_height)).'px;';
        }
        if (!empty($header_height) && $logo_max_height != '1') {
            $logo_height_style .= 'max-height:'.esc_attr($header_height*0.9).'px;';
        }
        $logo_height_style = !empty($logo_height_style) ? ' style="'.$logo_height_style.'"' : '';



        $sticky_logo_height_style = '';
        if (!empty($sticky_logo_height) && $logo_height_custom == '1') {
            $sticky_logo_height_style .= 'height:'.(esc_attr($sticky_logo_height)).'px;';
        }elseif(!empty($logo_height) && $logo_height_custom == '1'){
            $sticky_logo_height_style .= 'height:'.(esc_attr($logo_height)).'px;';
        }
        $sticky_logo_height_style = !empty($sticky_logo_height_style) ? ' style="'.$sticky_logo_height_style.'"' : '';



        $logo_class = '';
        if ($logo_height_custom == '1' && $logo_max_height == '1' ) {
            $logo_class .= ' no_height_limit';
        }

        if ($logo_limit_on_mobile == '0') {
            $logo_class .= ' logo_mobile_not_limited';
        }

        $logo = "";
        $logo .= "<div class='logo_container".$logo_class.
        (!empty($logo_sticky_src) ? ' sticky_logo_enable' : '').
        (!empty($logo_mobile_src) ? ' mobile_logo_enable' : '')."'>";
        $logo .= "<a href='".esc_url(home_url('/'))."'".$header_height_css.">";
        if (!empty($header_logo_src)) {
            $logo .= '<img class="default_logo" src="'.esc_url($header_logo_src).'" alt="'. esc_attr__('logo', 'surfy') .'" '.$logo_height_style.'>';
        }else{
            $logo .= '<h1 class="site-title">';
            $logo .= get_bloginfo( 'name' );
            $logo .= '</h1>';
        }
        if (!empty($logo_sticky_src)) {
            $logo .= '<img class="sticky_logo" src="'.esc_url($logo_sticky_src).'" alt="'. esc_attr__('logo', 'surfy') .'" '.$sticky_logo_height_style.'>';
        }
        if (!empty($logo_mobile_src)) {
            $logo .= '<img class="mobile_logo" src="'.esc_url($logo_mobile_src).'" alt="'. esc_attr__('logo', 'surfy') .'" '.$logo_height_style.'>';
        }
        $logo .= "</a>";
        $logo .= "</div>";
        return $logo;
    }
}

if (!function_exists('gt3_get_header_builder_text_component')) {
    function gt3_get_header_builder_text_component($index){
        $text_editor_content = '';
        $hide_class = '';
        if (class_exists( 'RWMB_Loader' ) && gt3_get_queried_object_id() !== 0) {
            $mb_header_presets = rwmb_meta('mb_header_presets');
            $presets = gt3_option('gt3_header_builder_presets');
            if ($mb_header_presets != 'default' && isset($mb_header_presets) && !empty($presets[$mb_header_presets]) && !empty($presets[$mb_header_presets]['preset'])) {
                $preset = $presets[$mb_header_presets]['preset'];
                $preset = json_decode($preset,true);
                $text_editor_content = gt3_option_presets($preset,"text".$index."_editor");
                $text_hide_on_desktop = gt3_option_presets($preset,"text".$index."_hide_on_desktop");
                $text_hide_on_tablet = gt3_option_presets($preset,"text".$index."_hide_on_tablet");
                $text_hide_on_mobile = gt3_option_presets($preset,"text".$index."_hide_on_mobile");
            }else{
                $text_editor_content = gt3_option("text".$index."_editor");
                $text_hide_on_desktop = gt3_option("text".$index."_hide_on_desktop");
                $text_hide_on_tablet = gt3_option("text".$index."_hide_on_tablet");
                $text_hide_on_mobile = gt3_option("text".$index."_hide_on_mobile");
            }
        }else{
            $text_editor_content = gt3_option("text".$index."_editor");
            $text_hide_on_desktop = gt3_option("text".$index."_hide_on_desktop");
            $text_hide_on_tablet = gt3_option("text".$index."_hide_on_tablet");
            $text_hide_on_mobile = gt3_option("text".$index."_hide_on_mobile");
        }

        if (!empty($text_hide_on_desktop)) {
            $hide_class .= ' gt3_hide_on_desktop';
        }
        if (!empty($text_hide_on_tablet)) {
            $hide_class .= ' gt3_hide_on_tablet';
        }
        if (!empty($text_hide_on_mobile)) {
            $hide_class .= ' gt3_hide_on_mobile';
        }

        $out = '';
        $out .= '<div class="gt3_header_builder_component gt3_header_builder_text_component'.esc_attr($hide_class).'">';
        $out .= $text_editor_content;
        $out .= '</div>';
        return $out;
    }
}


if (!function_exists('gt3_get_header_builder')) {
    function gt3_get_header_builder($id){
        $gt3_header_builder_array = gt3_option("gt3_header_builder_id");
        $preset = '';
        //check if preset set in metabox
        if (class_exists( 'RWMB_Loader' ) && $id !== 0) {
            $mb_header_presets = rwmb_meta('mb_header_presets');
            $presets = gt3_option('gt3_header_builder_presets');
            if ($mb_header_presets != 'default' && isset($mb_header_presets) && !empty($presets[$mb_header_presets]) && !empty($presets[$mb_header_presets]['preset'])) {
                $preset = $presets[$mb_header_presets]['preset'];
                $preset = json_decode($preset,true);
                $gt3_header_builder_array = gt3_option_presets($preset,'gt3_header_builder_id');
            }
        }
        if (!empty($gt3_header_builder_array)) {

            $header_sections = array();

            /* header builder main settings */
            $header_full_width = (bool)gt3_option('header_full_width');
            $header_sticky = (bool)gt3_option('header_sticky');
            $header_on_bg = (bool)gt3_option('header_on_bg');
            /* end header builder main settings */

            /* header builder component */

            // LOGO
            $logo = gt3_get_logo();

            //MENU
            $menu_slug = gt3_option("menu_select");
            if ( !class_exists( 'Gt3_surfy_core' ) ) {
                $menu_array = get_nav_menu_locations();
                if (!empty($menu_array) && is_array($menu_array) && !empty($menu_array['main_menu'])) {
                    $menu_slug = $menu_array['main_menu'];
                }else{
                    $menu_slug = '';
                }
            }

            $menu_ative_top_line = gt3_option('menu_ative_top_line');

            // Burger sidebar
            $is_burger_sidebar = false;
            $sidebar = gt3_option("burger_sidebar_select");
            //login
            $is_login = false;

            /* end header builder component */

            /* sticky */
            if ($header_sticky) {
                $options['header_sticky'] = $header_sticky;
                $header_sticky_appearance_style = gt3_option('header_sticky_appearance_style');
                $header_sticky_appearance_number = gt3_option('header_sticky_appearance_number');
                $header_sticky_appearance_number = (gt3_option('header_sticky_appearance_from_top') == 'custom') && !empty($header_sticky_appearance_number) ? $header_sticky_appearance_number['height'] : '';
                $header_sticky_shadow = gt3_option('header_sticky_shadow');
            }
            /* end sticky */

            // change option by option from metabox
            if (class_exists( 'RWMB_Loader' ) && $id !== 0) {
                if ($mb_header_presets != 'default' && isset($mb_header_presets) && !empty($presets[$mb_header_presets]) && !empty($presets[$mb_header_presets]['preset'])) {
                    $header_full_width = (bool)gt3_option_presets($preset,'header_full_width');
                    $header_sticky = (bool)gt3_option_presets($preset,'header_sticky');
                    $header_on_bg = (bool)gt3_option_presets($preset,'header_on_bg');
                    $menu_slug = gt3_option_presets($preset,"menu_select");
                    $menu_ative_top_line = gt3_option_presets($preset,'menu_ative_top_line');
                    $sidebar = gt3_option_presets($preset,"burger_sidebar_select");
                }

                $mb_customize_header_layout = rwmb_meta('mb_customize_header_layout');
                if ($mb_customize_header_layout == 'none') {
                    return false;
                }
            }

            echo "<div class='gt3_header_builder".((bool)$header_on_bg ? ' header_over_bg' : '')."'>";

                $options = array('gt3_header_builder_array' => $gt3_header_builder_array );
                $options['header_full_width'] = $header_full_width;
                $options['logo'] = $logo;
                $options['menu_slug'] = $menu_slug;
                $options['menu_ative_top_line'] = $menu_ative_top_line;
                $options['header_sticky'] = false;
                if (!empty($preset)) {
                    $options['preset'] = $preset;
                }else{
                    $options['preset'] = '';
                }


                $gt3_header_builder_out_array = gt3_header_builder__container($options);
                $is_burger_sidebar = $gt3_header_builder_out_array['is_burger_sidebar'];
                $is_login = $gt3_header_builder_out_array['is_login'];
                $is_header_menu = $gt3_header_builder_out_array['is_header_menu'];
                echo (($gt3_header_builder_out_array['header_out']));
                if ($header_sticky) {
                    $options['header_sticky'] = (bool)$header_sticky;
                    echo "<div class='sticky_header".($header_sticky_shadow == '1' ? ' header_sticky_shadow' : '')."'".(!empty($sticky_styles) ? $sticky_styles : '').(!empty($header_sticky_appearance_style) ? ' data-sticky-type="'.esc_attr($header_sticky_appearance_style).'"' : '').(!empty($header_sticky_appearance_number) ? ' data-sticky-number="'.((int)$header_sticky_appearance_number).'"' : '').">";

                    $gt3_header_builder_out_array = gt3_header_builder__container($options);
                    echo (($gt3_header_builder_out_array['header_out']));
                    echo "</div>";
                }
                if ($is_header_menu && !empty($menu_slug)) {
                    ob_start();
                        gt3_header_builder_menu($menu_slug);
                    $menu = ob_get_clean();
                    if (!empty($menu)) {
                        echo "<div class='mobile_menu_container'>";
                            echo ((bool) $header_full_width) ? "<div class='fullwidth-wrapper'>":"<div class='container'>";
                                echo "<div class='gt3_header_builder_component gt3_header_builder_menu_component'><nav class='main-menu main_menu_container".($menu_ative_top_line == '1' ? ' menu_line_enable' : '')."'>";
                                echo ''.$menu;
                                echo "</nav>";
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                }
            echo "</div>";
            if ($is_burger_sidebar) {
                echo '<div class="gt3_header_builder__burger_sidebar">';
                    echo '<div class="gt3_header_builder__burger_sidebar-cover"></div>';
                    echo '<div class="gt3_burger_sidebar_container">';
                        if (is_active_sidebar( $sidebar )) {
                            echo "<aside class='sidebar'>";
                            dynamic_sidebar( $sidebar );
                            echo "</aside>";
                        }
                    echo '</div>';
                echo '</div>';
            }
            if ($is_login) {
                echo "<div class='gt3_header_builder__login-modal".(get_option('woocommerce_enable_myaccount_registration') !='yes' ? ' without_register' : '').(is_user_logged_in() ? ' user_logged_in' : '')."'>";
                    echo "<div class='gt3_header_builder__login-modal-cover'></div>";
                    echo "<div class='gt3_header_builder__login-modal_container container'>";
                        echo "<div class='gt3_header_builder__login-modal-close'></div>";
                        if ( is_user_logged_in() ) {
                            wc_get_template('myaccount/navigation.php');
                        }
                        if (!is_user_logged_in()) {
                            $is_nextend_facebook = in_array( 'nextend-facebook-connect/nextend-facebook-connect.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
                            $is_nextend_google = in_array( 'nextend-google-connect/nextend-google-connect.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
                            $is_nextend_twitter = in_array( 'nextend-twitter-connect/nextend-twitter-connect.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
                            echo do_shortcode('[woocommerce_my_account]');
                            if (($is_nextend_facebook || $is_nextend_google || $is_nextend_twitter) && get_option('woocommerce_enable_myaccount_registration')=='yes') {
                                echo "<div class='gt3_header_builder__login-modal_footer'>";
                                if ($is_nextend_facebook) {
                                    echo "<div class='gt3_module_button button_alignment_inline'>";
                                        echo "<a href='" . esc_url(wp_login_url() . "?loginSocial=facebook&redirect=" . get_permalink()) . "' class='button_size_normal gt3_facebook_login' data-plugin='nsl' data-action='connect' data-redirect='current' data-provider='facebook' data-popupwidth='475' data-popupheight='175'>";
                                        echo '<i class="fa fa-facebook" aria-hidden="true"></i>';
                                        echo '<span>'.esc_html__( 'Login with Facebook', 'surfy' ).'</span>';
                                        echo "</a>";
                                    echo "</div>";
                                }
                                if ($is_nextend_google) {
                                    echo "<div class='gt3_module_button button_alignment_inline'>";
                                        echo "<a href='" . esc_url(wp_login_url() . "?loginSocial=google&redirect=" . get_permalink()) . "' class='button_size_normal gt3_google_login' data-plugin='nsl' data-action='connect' data-redirect='current' data-provider='google' data-popupwidth='475' data-popupheight='175'>";
                                        echo '<i class="fa fa-google" aria-hidden="true"></i>';
                                        echo '<span>'.esc_html__( 'Login with Google', 'surfy' ).'</span>';
                                        echo "</a>";
                                    echo "</div>";
                                }
                                if ($is_nextend_twitter) {
                                    echo "<div class='gt3_module_button button_alignment_inline'>";
                                        echo "<a href='" . esc_url(wp_login_url() . "?loginSocial=twitter&redirect=" . get_permalink()) . "' class='button_size_normal gt3_twitter_login' title='".esc_attr__( 'Login with Twitter', 'surfy' )."' data-plugin='nsl' data-action='connect' data-redirect='current' data-provider='twitter' data-popupwidth='475' data-popupheight='175'>";
                                        echo '<i class="fa fa-twitter" aria-hidden="true"></i>';
                                        echo '<span>'.esc_html__( 'Login with Twitter', 'surfy' ).'</span>';
                                        echo "</a>";
                                    echo "</div>";
                                }
                                echo "</div>";
                            }
                        }
                    echo "</div>";

                echo "</div>";
            }

        }
    }
}

if (!function_exists('gt3_header_builder__container')) {
    function gt3_header_builder__container($options = null) {
        extract($options);
        $header_sections = array();
        $is_burger_sidebar = false;
        $is_login = false;
        $is_header_menu = false;
        ob_start();
        echo "<div class='gt3_header_builder__container'>";

        unset(
            $gt3_header_builder_array['all_item'] ,
            $gt3_header_builder_array['all_item__tablet'],
            $gt3_header_builder_array['all_item__mobile']
        );
            foreach ($gt3_header_builder_array as $side => $value) {


                if (!empty($gt3_header_builder_array[$side]['content']) && $side != 'all_item' ) {

                    $side_out = '';

                    if (count($gt3_header_builder_array[$side]['content']) == 1 && empty($gt3_header_builder_array[$side]['content']['placebo']) || count($gt3_header_builder_array[$side]['content']) > 1) {
                        //get level and position of menu part
                        $side_filterred = str_replace('__', '_', $side);
                        $full_position = explode('_', $side_filterred, 3);
                        $level         = !empty($full_position[0]) ? $full_position[0] : '';
                        $position      = !empty($full_position[1]) ? $full_position[1] : '';
                        $responsive    = !empty($full_position[2]) ? $full_position[2] : '';

                        if ($header_sticky) {
                            if (!empty($preset)) {
                                $enable_section_in_sticky = (bool)gt3_option_presets($preset, "side_" . $level . "_sticky");
                            } else {
                                $enable_section_in_sticky = (bool)gt3_option("side_" . $level . "_sticky");
                            }

                        } else {
                            $enable_section_in_sticky = true;
                        }

                        if ($enable_section_in_sticky) {

                            $side_class = '';
                            $side_class .= sanitize_html_class($side);
                            $side_class .= !empty($position) ? ' '.sanitize_html_class($position) : '';

                            if (!empty($preset)) {
                                $side_align = gt3_option_presets($preset,$side."-align");
                            }else{
                                $side_align = gt3_option($side."-align");
                            }

                            if ($side_align != $position) {
                                $side_class .= ' header_side--custom-align header_side--'.$side_align.'-align';
                            }

                                $side_content_out = '';
                                ob_start();
                                foreach ($gt3_header_builder_array[$side]['content'] as $key => $value) {
                                    if ($key != 'placebo' && $key != 'undefined') {

                                            switch ($key) {
                                                case 'left_bar':
                                                    echo !empty($bottom_header_left) ? $bottom_header_left  : '';
                                                    break;
                                                case 'logo':
                                                    echo !empty($logo) ? $logo : '';
                                                    break;
                                                case 'menu':
                                                    if (!empty($menu_slug)) {
                                                        $is_header_menu = true;
                                                            echo "<div class='gt3_header_builder_component gt3_header_builder_menu_component'><nav class='main-menu main_menu_container".($menu_ative_top_line == '1' ? ' menu_line_enable' : '')."'>";
                                                            if ( class_exists( 'Gt3_surfy_core' ) ) {
                                                                gt3_header_builder_menu($menu_slug);
                                                            }else{
                                                                if (has_nav_menu( 'main_menu' )) {
                                                                    gt3_main_menu();
                                                                }
                                                            }

                                                            echo  "</nav>";
                                                            echo '<div class="mobile-navigation-toggle"><div class="toggle-box"><div class="toggle-inner"></div></div></div></div>';

                                                    }
                                                    break;
                                                case 'search':
                                                    echo '<div class="gt3_header_builder_component gt3_header_builder_search_component">'.do_shortcode('[gt3_search]').'</div>';
                                                    break;
	                                            case 'search_cat':
		                                            if ( class_exists('WooCommerce') ) {
			                                            echo '<div class="gt3_header_builder_component gt3_header_builder_search_cat_component">'.gt3_search_category().'</div>';
		                                            }
		                                            break;
                                                case 'login':
                                                    $is_login = true;
	                                                if ( !class_exists('WooCommerce') ) {
                                                        $is_login = false;
                                                    }
                                                    echo '<div class="gt3_header_builder_component gt3_header_builder_login_component"><i class="gt3_login_icon"></i></div>';
                                                    break;
                                                case 'cart':
	                                                if ( class_exists('WooCommerce') ) {
		                                                ob_start();
		                                                woocommerce_mini_cart();
		                                                $woo_mini_cart = ob_get_clean();
		                                                ob_start();
		                                                ?>
                                                        <a class="woo_icon" href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_html_e( 'View your shopping cart', 'surfy' ); ?>">
                                                            <i class='woo_mini-count'>
				                                                <?php if(WC()->cart->cart_contents_count > 0){ ?>
                                                                    <span><?php echo esc_html( WC()->cart->cart_contents_count ); ?></span>
				                                                <?php }; ?>
                                                            </i>
                                                        </a>
		                                                <?php
		                                                $woo_mini_icon = ob_get_clean(); ?>

                                                        <div class="gt3_header_builder_component gt3_header_builder_cart_component">
			                                                <?php echo '' . $woo_mini_icon; ?>
                                                            <div class="gt3_header_builder_cart_component__cart">
                                                                <div class="gt3_header_builder_cart_component__cart-container">
					                                                <?php echo '' . $woo_mini_cart; ?>
                                                                </div>
                                                            </div>
                                                        </div>

	                                                <?php }
                                                    break;
                                                case 'burger_sidebar':
                                                    $is_burger_sidebar = true;
                                                    echo '<div class="gt3_header_builder_component gt3_header_builder_burger_sidebar_component"><i class="burger_sidebar_icon"><span class="first"></span><span class="second"></span><span class="third"></span></i></div>';
                                                    break;
                                                case 'text1':
                                                    $text1_out = gt3_get_header_builder_text_component(1);
                                                    echo !empty($text1_out) ? do_shortcode( $text1_out )  : '';
                                                    break;
                                                case 'text2':
                                                    $text2_out = gt3_get_header_builder_text_component(2);
                                                    echo !empty($text2_out) ? do_shortcode($text2_out)  : '';
                                                    break;
                                                case 'text3':
                                                    $text3_out = gt3_get_header_builder_text_component(3);
                                                    echo !empty($text3_out) ? do_shortcode($text3_out)  : '';
                                                    break;
                                                case 'text4':
                                                    $text4_out = gt3_get_header_builder_text_component(4);
                                                    echo !empty($text4_out) ? do_shortcode($text4_out)  : '';
                                                    break;
                                                case 'text5':
                                                    $text5_out = gt3_get_header_builder_text_component(5);
                                                    echo !empty($text5_out) ? do_shortcode($text5_out)  : '';
                                                    break;
                                                case 'text6':
                                                    $text6_out = gt3_get_header_builder_text_component(6);
                                                    echo !empty($text6_out) ? do_shortcode($text6_out)  : '';
                                                    break;
                                                case 'delimiter1':
                                                    echo '<div class="gt3_header_builder_component gt3_header_builder_delimiter_component gt3_delimiter1"></div>';
                                                    break;
                                                case 'delimiter2':
                                                    echo '<div class="gt3_header_builder_component gt3_header_builder_delimiter_component gt3_delimiter2"></div>';
                                                    break;
                                                case 'delimiter3':
                                                    echo '<div class="gt3_header_builder_component gt3_header_builder_delimiter_component gt3_delimiter3"></div>';
                                                    break;
                                                case 'delimiter4':
                                                    echo '<div class="gt3_header_builder_component gt3_header_builder_delimiter_component gt3_delimiter4"></div>';
                                                    break;
                                                case 'delimiter5':
                                                    echo '<div class="gt3_header_builder_component gt3_header_builder_delimiter_component gt3_delimiter5"></div>';
                                                    break;
                                                case 'delimiter6':
                                                    echo '<div class="gt3_header_builder_component gt3_header_builder_delimiter_component gt3_delimiter6"></div>';
                                                    break;

                                                case 'empty_space1':
                                                case 'empty_space2':
                                                case 'empty_space3':
                                                case 'empty_space4':
                                                case 'empty_space5':
                                                    echo '<div class="gt3_header_builder_component gt3_header_builder_empty_space_component"></div>';
                                                    break;

                                            }
                                    }
                                }
                                $side_content_out = ob_get_clean();
                                if (!empty($side_content_out)) {
                                    $side_out .= "<div class='".$side_class." header_side'>";
                                        $side_out .=  "<div class='header_side_container'>";
                                            $side_out .= $side_content_out;
                                        $side_out .=  "</div>";//header side container end
                                    $side_out .=  "</div>";//header side end
                                }

                            if (!empty($side_out)) {
                                if (!empty($responsive)) {
                                    $level = $level .'_'.$responsive;
                                }
                                $header_sections[$level][$position] = $side_out;
                            }
                        }
                    }
                }
            }
            $is_tablet = false;
            $is_mobile = false;
            $all_header_section = array_keys($header_sections);
            foreach ($all_header_section as $header_section) {
                if (strpos($header_section, 'tablet')) {
                    $is_tablet = true;
                }
                if (strpos($header_section, 'mobile')) {
                    $is_mobile = true;
                }
            }
            foreach ($header_sections as $header_section => $header_section_content) {
                $responsive_class = $header_mobile_class = '';
                if (!empty($preset)) {
                    $header_show_on_mobile = gt3_option_presets($preset,"side_".$header_section."_mobile");
                    $header_mobile_class = isset($header_show_on_mobile) && !(bool)$header_show_on_mobile ? ' gt3_header_builder__section--hide_on_mobile' : '';
                }else{
                    $header_show_on_mobile = gt3_option("side_" . $header_section . "_mobile");
                    $header_mobile_class = isset($header_show_on_mobile) && !(bool)$header_show_on_mobile ? ' gt3_header_builder__section--hide_on_mobile' : '';
                }


                if ($is_tablet && !strpos($header_section, 'tablet')) {
                    $responsive_class .= ' gt3_header_builder__section--hide_on_tablet';
                }elseif($is_tablet && strpos($header_section, 'tablet')){
                    $responsive_class .= ' gt3_header_builder__section--show_on_tablet';
                }

                if ($is_mobile && !strpos($header_section, 'mobile') && $header_mobile_class != ' gt3_header_builder__section--hide_on_mobile') {
                    $responsive_class .= ' gt3_header_builder__section--hide_on_mobile';
                }elseif($is_mobile && strpos($header_section, 'mobile')){
                    $responsive_class .= ' gt3_header_builder__section--show_on_mobile';
                }

                $header_section = str_replace('_', '__', $header_section);

                echo "<div class='gt3_header_builder__section gt3_header_builder__section--" . esc_attr($header_section) . $responsive_class . (!empty($header_section_content['center']) ? ' not_empty_center_side' : '') . $header_mobile_class . "'>";
                echo "<div class='gt3_header_builder__section-container" . (!$header_full_width ? ' container' : ' container_full') . "'>";
                if (empty($header_section_content['left'])) {
                    echo "<div class='" . esc_attr($header_section) . "_left left header_side'></div>";
                }
                foreach ($header_section_content as $side => $side_content) {
                    echo '' . $side_content;
                }
                if (empty($header_section_content['right'])) {
                    echo "<div class='" . esc_attr($header_section) . "_right right header_side'></div>";
                }
                echo "</div>";
                echo "</div>";
            }
        echo "</div>";
        $gt3_header_builder__container = ob_get_clean();
        $output_array = array();
        $output_array['header_out'] = $gt3_header_builder__container;
        $output_array['is_login'] = $is_login;
        $output_array['is_burger_sidebar'] = $is_burger_sidebar;
        $output_array['is_header_menu'] = $is_header_menu;
        return $output_array;
    }
}


if (!function_exists('gt3_option_presets')) {
    function gt3_option_presets($preset = '',$name = ''){
        return isset($preset[$name]) ? $preset[$name] : null;
    }
}


if (!function_exists('gt3_main_menu')) {
    function gt3_main_menu (){
        wp_nav_menu( array(
            'theme_location'  => 'main_menu',
            'container' => '',
            'container_class' => '',
            'after' => '',
            'link_before'     => '<span>',
            'link_after'      => '</span>',
            'walker' => ''
        ) );
    }
}

if (!function_exists('gt3_header_builder_menu')) {
    function gt3_header_builder_menu ($menu_slug){
        wp_nav_menu( array(
            'menu'            => $menu_slug,
            'container'       => '',
            'container_class' => '',
            'after'           => '',
            'link_before'     => '<span>',
            'link_after'      => '</span>',
            'walker' => new GT3_Walker_Nav_Menu (),
        ) );
    }
}

// need for vertical view of header in theme options (admin)
if (!function_exists('gt3_add_admin_class_menu_order')) {
    add_filter('admin_body_class', 'gt3_add_admin_class_menu_order');
    function gt3_add_admin_class_menu_order($classes) {
        if (gt3_option('bottom_header_vertical_order')) {
            $classes .= ' bottom_header_vertical_order';
        }
        return $classes;
    }
}


if (!function_exists('gt3_footer_area')) {
    function gt3_footer_area(){
        // footer option
        $footer_switch = gt3_option('footer_switch');
        $footer_spacing = gt3_option('footer_spacing');
        $footer_column = gt3_option_compare('footer_column','mb_footer_switch','yes');
        $footer_column2 = gt3_option_compare('footer_column2','mb_footer_switch','yes');
        $footer_column3 = gt3_option_compare('footer_column3','mb_footer_switch','yes');
        $footer_align = gt3_option_compare('footer_align','mb_footer_switch','yes');
        $footer_full_width = gt3_option_compare('footer_full_width','mb_footer_switch','yes');
        $footer_bg_color = gt3_option_compare('footer_bg_color','mb_footer_switch','yes');

        $footer_masked_row = gt3_option("footer_masked_row") == '1' ? 'yes' : 'no';
        $footer_mask_image = gt3_option("footer_mask_image");
        $footer_mask_image = !empty($footer_mask_image) ? $footer_mask_image['url'] : '';
        $footer_cont_class = '';

        // copyright option
        $copyright_switch = gt3_option('copyright_switch');
        $copyright_spacing = gt3_option('copyright_spacing');
        $copyright_editor = gt3_option_compare('copyright_editor','mb_copyright_switch','1','mb_footer_switch','yes');
        $copyright_align = gt3_option_compare('copyright_align','mb_copyright_switch','1','mb_footer_switch','yes');
        $copyright_bg_color = gt3_option_compare('copyright_bg_color','mb_copyright_switch','1','mb_footer_switch','yes');


        $copyright_top_border = gt3_option("copyright_top_border");
        $copyright_top_border_color = gt3_option("copyright_top_border_color");

        // METABOX VAR
        if (class_exists( 'RWMB_Loader' ) && gt3_get_queried_object_id() !== 0) {
            $mb_footer_switch = rwmb_meta('mb_footer_switch');
            if ($mb_footer_switch == 'yes') {
                $footer_switch = true;
                $footer_spacing = array();
                $mb_padding_top = rwmb_meta('mb_padding_top');
                $mb_padding_bottom = rwmb_meta('mb_padding_bottom');
                $mb_padding_left = rwmb_meta('mb_padding_left');
                $mb_padding_right = rwmb_meta('mb_padding_right');
                $footer_spacing['padding-top'] = !empty($mb_padding_top) ? $mb_padding_top : '';
                $footer_spacing['padding-bottom'] = !empty($mb_padding_bottom) ? $mb_padding_bottom : '';
                $footer_spacing['padding-left'] = !empty($mb_padding_left) ? $mb_padding_left : '';
                $footer_spacing['padding-right'] = !empty($mb_padding_right) ? $mb_padding_right : '';
                $mb_footer_sidebar_1 = rwmb_meta('mb_footer_sidebar_1');
                $mb_footer_sidebar_2 = rwmb_meta('mb_footer_sidebar_2');
                $mb_footer_sidebar_3 = rwmb_meta('mb_footer_sidebar_3');
                $mb_footer_sidebar_4 = rwmb_meta('mb_footer_sidebar_4');
            }elseif (rwmb_meta('mb_footer_switch') == 'no') {
                $footer_switch = false;
            }

            if ($mb_footer_switch == 'yes') {
                $mb_copyright_switch = rwmb_meta('mb_copyright_switch');
                if ($mb_copyright_switch == '1') {
                    $copyright_switch = true;
                    $mb_copyright_padding_top = rwmb_meta('mb_copyright_padding_top');
                    $mb_copyright_padding_bottom = rwmb_meta('mb_copyright_padding_bottom');
                    $mb_copyright_padding_left = rwmb_meta('mb_copyright_padding_left');
                    $mb_copyright_padding_right = rwmb_meta('mb_copyright_padding_right');
                    $copyright_spacing['padding-top'] = !empty($mb_copyright_padding_top) ? $mb_copyright_padding_top : '';
                    $copyright_spacing['padding-bottom'] = !empty($mb_copyright_padding_bottom) ? $mb_copyright_padding_bottom : '';
                    $copyright_spacing['padding-left'] = !empty($mb_copyright_padding_left) ? $mb_copyright_padding_left : '';
                    $copyright_spacing['padding-right'] = !empty($mb_copyright_padding_right) ? $mb_copyright_padding_right : '';

                    $copyright_top_border = rwmb_meta("mb_copyright_top_border");
                    $mb_copyright_top_border_color = rwmb_meta("mb_copyright_top_border_color");
                    $mb_copyright_top_border_color_opacity = rwmb_meta("mb_copyright_top_border_color_opacity");

                    if (!empty($mb_copyright_top_border_color) && $copyright_top_border == '1') {
                        $copyright_top_border_color['rgba'] = 'rgba('.(gt3_HexToRGB($mb_copyright_top_border_color)).','.$mb_copyright_top_border_color_opacity.')';
                    }else{
                        $copyright_top_border_color = '';
                    }


                }else{
                    $copyright_switch = false;
                }
            }elseif (rwmb_meta('mb_footer_switch') == 'no') {
                $copyright_switch = false;
            }

        }else{
            $mb_footer_switch = false;
        }

        //footer container style
        $footer_cont_style = !empty($footer_bg_color) ? ' background-color :'.esc_attr($footer_bg_color).';' : '';
        $footer_cont_style .= gt3_background_render('footer','mb_footer_switch','yes');

        if ($footer_masked_row == 'yes' && !empty($footer_mask_image)) {
           $footer_cont_style .= '-webkit-mask-image: url('.esc_url($footer_mask_image).');
            mask-image: url('.esc_url($footer_mask_image).');
            ';
            $footer_cont_class .= ' gt3_mask_image';
        }


        $footer_cont_style = !empty($footer_cont_style) ? ' style="'.$footer_cont_style.'"' : '' ;

        //footer container class
        $footer_class = '';
        $footer_class .= ' align-'.esc_attr($footer_align);

        //footer padding
        $footer_top_padding = !empty($footer_spacing['padding-top']) ? (int)$footer_spacing['padding-top'] : '';
        $footer_bottom_padding = !empty($footer_spacing['padding-bottom']) ? (int)$footer_spacing['padding-bottom'] : '';
        $footer_left_padding = !empty($footer_spacing['padding-left']) ? (int)$footer_spacing['padding-left'] : '';
        $footer_right_padding = !empty($footer_spacing['padding-right']) ? (int)$footer_spacing['padding-right'] : '';

        //footer style
        $footer_style = '';
        $footer_style .= !empty($footer_top_padding) ? 'padding-top:'.esc_attr($footer_top_padding).'px;' : '' ;
        $footer_style .= !empty($footer_bottom_padding) ? 'padding-bottom:'.esc_attr($footer_bottom_padding).'px;' : '' ;
        $footer_style .= !empty($footer_left_padding) ? 'padding-left:'.esc_attr($footer_left_padding).'px;' : '' ;
        $footer_style .= !empty($footer_right_padding) ? 'padding-right:'.esc_attr($footer_right_padding).'px;' : '' ;
        $footer_style = !empty($footer_style) ? ' style="'.$footer_style.'"' : '';

        /*
        *
        * copyright code
        */
        // copyright class
        $copyright_class = '';
        $copyright_class .= ' align-'.esc_attr($copyright_align);

        // copyright container style
        $copyright_cont_style = '';
        $copyright_cont_style .= !empty($copyright_bg_color) ? 'background-color:'.esc_attr($copyright_bg_color).';' : '';
        if ($copyright_top_border == '1') {
            $copyright_cont_style .= !empty($copyright_top_border_color['rgba']) ? 'border-top: 1px solid '.esc_attr($copyright_top_border_color['rgba']).';' : '';
        }
        $copyright_cont_style = !empty($copyright_cont_style) ? ' style="'.$copyright_cont_style.'"' : '';

        // copyright padding
        $copyright_top_padding = !empty($copyright_spacing['padding-top']) ? $copyright_spacing['padding-top'] : '';
        $copyright_bottom_padding = !empty($copyright_spacing['padding-bottom']) ? $copyright_spacing['padding-bottom'] : '';
        $copyright_left_padding = !empty($copyright_spacing['padding-left']) ? $copyright_spacing['padding-left'] : '';
        $copyright_right_padding = !empty($copyright_spacing['padding-right']) ? $copyright_spacing['padding-right'] : '';
        // copyright style
        $copyright_style = '';
        $copyright_style .= !empty($copyright_top_padding) ? 'padding-top:'.esc_attr($copyright_top_padding).'px;' : '' ;
        $copyright_style .= !empty($copyright_bottom_padding) ? 'padding-bottom:'.esc_attr($copyright_bottom_padding).'px;' : '' ;
        $copyright_style .= !empty($copyright_left_padding) ? 'padding-left:'.esc_attr($copyright_left_padding).'px;' : '' ;
        $copyright_style .= !empty($copyright_right_padding) ? 'padding-right:'.esc_attr($copyright_right_padding).'px;' : '' ;


        $copyright_style = !empty($copyright_style) ? ' style="'.$copyright_style.'"' : '';

        /*
        *
        * column build
        */
        $column_sizes = array();
        switch ((int)$footer_column) {
            case 1:
                $column_sizes = array('12');
                break;
            case 2:
                $column_sizes = explode("-", $footer_column2);
                break;
            case 3:
                $column_sizes = explode("-", $footer_column3);
                break;
            case 4:
                $column_sizes = array('3','3','3','3');
                break;
            default:
                $column_sizes = array('3','3','3','3');
                break;
        }

        /*
        *
        * footer out
        */
        if ($footer_switch || $copyright_switch) {
            echo "<footer class='main_footer fadeOnLoad clearfix ".$footer_cont_class."' ".$footer_cont_style." id='footer'>";

                if ($footer_switch) {
                    echo "<div class='top_footer column_".(int)$footer_column.$footer_class."'>";
                        echo ((bool)$footer_full_width ? "" : "<div class='container'>");
                        echo "<div class='row'".$footer_style.">";
                            for ($i=0; $i < (int)$footer_column; $i++) {
                                echo "<div class='span".$column_sizes[$i]."'>";
                                    if ($mb_footer_switch == 'yes') {
                                        if (is_active_sidebar( ${'mb_footer_sidebar_'.($i+1)} )) {
                                            dynamic_sidebar( ${'mb_footer_sidebar_'.($i+1)} );
                                        }
                                    }else{
                                        if (is_active_sidebar( 'footer_column_' . ($i+1) )) {
                                            dynamic_sidebar( 'footer_column_' . ($i+1) );
                                        }
                                    }

                                echo "</div>";
                            }
                        echo "</div>";
                        echo ((bool)$footer_full_width ? "" : "</div>");
                    echo "</div>";
                }

                if ($copyright_switch) {
                    echo "<div class='copyright".$copyright_class."'".$copyright_cont_style.">";
                        echo ((bool)$footer_full_width ? "" : "<div class='container'>");
                           echo "<div class='row'".$copyright_style.">";
                               echo "<div class='span12'>";
                               echo do_shortcode( $copyright_editor );
                               echo "</div>";
                           echo "</div>";
                        echo ((bool)$footer_full_width ? "" : "</div>");
                    echo "</div>";
                }

            echo "</footer>";
        }
    }
}

if (!function_exists('gt3_option_compare')) {
    function gt3_option_compare($opt_name,$meta_conditional = false,$meta_value = false,$meta_conditional2 = false,$meta_value2 = false){
        $option = gt3_option($opt_name);
        if (class_exists( 'RWMB_Loader' ) && gt3_get_queried_object_id() !== 0) {
            if ($meta_conditional != false) {
                if ($meta_conditional2 != false) {
                    if (rwmb_meta($meta_conditional) == $meta_value &&rwmb_meta($meta_conditional2) == $meta_value2) {
                        $option = rwmb_meta('mb_'.$opt_name);
                    }
                }else{
                    if (rwmb_meta($meta_conditional) == $meta_value ) {
                        $option = rwmb_meta('mb_'.$opt_name);
                    }
                }
            }else{
                $option = rwmb_meta('mb_'.$opt_name);
            }
        }
        return $option;
    }
}

// need for comparing (theme_options or metabox) and out html with background settings
if (!function_exists('gt3_background_render')) {
    function gt3_background_render($opt_name,$meta_conditional = false,$meta_value = false){
        $image_array = gt3_option($opt_name."_bg_image");
        $bg_src = !empty($image_array['background-image']) ? $image_array['background-image'] : '';
        $bg_repeat = !empty($image_array['background-repeat']) ? $image_array['background-repeat'] : '';
        $bg_size = !empty($image_array['background-size']) ? $image_array['background-size'] : '';
        $attachment = !empty($image_array['background-attachment']) ? $image_array['background-attachment'] : '';
        $position = !empty($image_array['background-position']) ? $image_array['background-position'] : '';

        $id = gt3_get_queried_object_id();
        if (class_exists( 'RWMB_Loader' ) && $id !== 0) {
            if ($meta_conditional != false) {
                $mb_conditional = rwmb_meta($meta_conditional, array(), $id);
                if ($mb_conditional == $meta_value) {
                    $bg_src = rwmb_meta('mb_'.$opt_name.'_bg_image', array(), $id);
                    $bg_src = !empty($bg_src) ? $bg_src : '';
                    if (!empty($bg_src)) {
                        $bg_src = array_values($bg_src);
                        $bg_src = $bg_src[0]['url'];
                    }
                    if (!empty($bg_src)) {
                        $bg_repeat = rwmb_meta('mb_'.$opt_name.'_bg_repeat', array(), $id);
                        $bg_repeat = !empty($bg_repeat) ? $bg_repeat : '';
                        $bg_size = rwmb_meta('mb_'.$opt_name.'_bg_size', array(), $id);
                        $bg_size = !empty($bg_size) ? $bg_size : '';
                        $attachment = rwmb_meta('mb_'.$opt_name.'_bg_attachment', array(), $id);
                        $attachment = !empty($attachment) ? $attachment : '';
                        $position = rwmb_meta('mb_'.$opt_name.'_bg_position', array(), $id);
                        $position = !empty($position) ? $position : '';
                    }else{
                        $bg_repeat = '';
                        $bg_size = '';
                        $attachment = '';
                        $position = '';
                    }
                }
            }
        }
        $bg_styles = '';
        $bg_styles .= !empty($bg_src) ? 'background-image:url('.esc_url($bg_src).');' : '';
        if (!empty($bg_src)) {
           $bg_styles .= !empty($bg_size) ? 'background-size:'.esc_attr($bg_size).';' : '';
            $bg_styles .= !empty($bg_repeat) ? 'background-repeat:'.esc_attr($bg_repeat).';' : '';
            $bg_styles .= !empty($attachment) ? 'background-attachment:'.esc_attr($attachment).';' : '';
            $bg_styles .= !empty($position) ? 'background-position:'.esc_attr($position).';' : '';
        }

        return $bg_styles;
    }
}

// return all sidebars
if (!function_exists('gt3_get_all_sidebar')) {
    function gt3_get_all_sidebar() {
        global $wp_registered_sidebars;
        $out = array('' => '' );
        if ( empty( $wp_registered_sidebars ) )
            return;
         foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar) :
            $out[$sidebar_id] = $sidebar['name'];
         endforeach;
         return $out;
    }
}


function gt3_get_attachment( $attachment_id ) {
	/* Source: http://wpcodelib.com/function/custom/get_attachment/ */
	$attachment = get_post( $attachment_id );
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}

// GT3 Featured Post CSS
add_action('wp_enqueue_scripts', 'gt3_blog_custom_styles_js');
function gt3_blog_custom_styles_js($custom_blog_css) {
    echo '
        <script type="text/javascript">
            var custom_blog_css = "' . $custom_blog_css . '";
            if (document.getElementById("custom_blog_styles")) {
                document.getElementById("custom_blog_styles").innerHTML += custom_blog_css;
            } else if (custom_blog_css !== "") {
                document.head.innerHTML += \'<style id="custom_blog_styles" type="text/css">\'+custom_blog_css+\'</style>\';
            }
        </script>
    ';
}

if (!function_exists('gt3_showJSInFooter')) {
    function gt3_showJSInFooter()
    {
        if (isset($GLOBALS['showOnlyOneTimeJS']) && is_array($GLOBALS['showOnlyOneTimeJS'])) {
            foreach ($GLOBALS['showOnlyOneTimeJS'] as $id => $js) {
                echo esc_js($js);
            }
        }
    }
}
add_action('wp_footer', 'gt3_showJSInFooter');

//* Tiny mce adding *//
function gt3_mce_buttons() {
    if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
    add_filter('mce_external_plugins', 'gt3_add_external_plugins');
    add_filter('mce_buttons_3', 'gt3_mce_buttons_register_button');
    add_filter('mce_buttons_2', 'gt3_mce_buttons_2');
    }
}
add_action('init', 'gt3_mce_buttons');

function gt3_add_external_plugins() {
$plugin_array['gt3_external_tinymce_plugins'] = get_template_directory_uri() . '/core/admin/js/tinymce-button.js';
return $plugin_array;
}
function gt3_mce_buttons_register_button($buttons) {
array_push($buttons, 'SocialIcon', 'DropCaps', 'Highlighter', 'SecondaryFont', 'LinkStyling', 'ListStyle', 'Columns');
return $buttons;
}
function gt3_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}

function gt3_tiny_mce_before_init($settings) {
$settings['theme_advanced_blockformats'] = 'p,h1,h2,h3,h4';
$style_formats = array(
array(
'title' => esc_html__('Font Weight', 'surfy'), 'items' => array(
array('title' => esc_html__('Default', 'surfy'), 'inline' => 'span', 'classes' => 'gt3_font-weight', 'styles' => array('font-weight' => 'inherit')),
array('title' => esc_html__('Lightest (100)', 'surfy'), 'inline' => 'span', 'classes' => 'gt3_font-weight', 'styles' => array('font-weight' => '100')),
array('title' => esc_html__('Lighter (200)', 'surfy'), 'inline' => 'span', 'classes' => 'gt3_font-weight', 'styles' => array('font-weight' => '200')),
array('title' => esc_html__('Light (300)', 'surfy'), 'inline' => 'span', 'classes' => 'gt3_font-weight', 'styles' => array('font-weight' => '300')),
array('title' => esc_html__('Normal (400)', 'surfy'), 'inline' => 'span', 'classes' => 'gt3_font-weight', 'styles' => array('font-weight' => '400')),
array('title' => esc_html__('Medium (500)', 'surfy'), 'inline' => 'span', 'classes' => 'gt3_font-weight', 'styles' => array('font-weight' => '500')),
array('title' => esc_html__('Semi-Bold (600)', 'surfy'), 'inline' => 'span', 'classes' => 'gt3_font-weight', 'styles' => array('font-weight' => '600')),
array('title' => esc_html__('Bold (700)', 'surfy'), 'inline' => 'span', 'classes' => 'gt3_font-weight', 'styles' => array('font-weight' => '700')),
array('title' => esc_html__('Bolder (800)', 'surfy'), 'inline' => 'span', 'classes' => 'gt3_font-weight', 'styles' => array('font-weight' => '800')),
array('title' => esc_html__('Extra Bold (900)', 'surfy'), 'inline' => 'span', 'classes' => 'gt3_font-weight', 'styles' => array('font-weight' => '900'))
),
),
);

$settings['style_formats']           = str_replace('"', "'", json_encode($style_formats));
$settings['extended_valid_elements'] = 'span[*],a[*],i[*]';
return $settings;
}
add_filter('tiny_mce_before_init', 'gt3_tiny_mce_before_init');

function gt3_theme_add_editor_styles() {
add_editor_style('css/font-awesome.min.css');
add_editor_style('css/tiny_mce.css');
}
add_action('current_screen', 'gt3_theme_add_editor_styles');

function gt3_categories_postcount_filter($variable) {
preg_match('/(class="count")/', $variable, $matches);
if (empty($matches)) {
$variable = str_replace('</a> (', '</a> <span class="post_count">', $variable);
        $variable = str_replace('</a>&nbsp;(', '</a>&nbsp;<span class="post_count">', $variable);
        $variable = str_replace(')', '</span>', $variable);
    }
    return $variable;
}

add_filter('get_archives_link', 'gt3_categories_postcount_filter');
add_filter('wp_list_categories', 'gt3_categories_postcount_filter');

function wpdocs_theme_add_editor_styles() {
    add_editor_style( 'css/font-awesome.min.css' );
    add_editor_style( 'css/tiny_mce.css' );
}
add_action( 'current_screen', 'wpdocs_theme_add_editor_styles' );

if (!function_exists('gt3_open_graph_meta') && !class_exists( 'WPSEO_Options' )) {
    add_action( 'wp_head', 'gt3_open_graph_meta', 5 );
    function gt3_open_graph_meta(){
        global $post;
        if ( !is_singular()) //if it is not a post or a page
            return;
            echo '<meta property="og:title" content="' . esc_html(get_the_title()) . '"/>';
            echo '<meta property="og:type" content="article"/>';
            echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '"/>';
            echo '<meta property="og:site_name" content="'.esc_html(get_bloginfo('name')).'"/>';
        if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
            $header_logo_src = gt3_option("header_logo");
            $header_logo_src = !empty($header_logo_src) ? $header_logo_src['url'] : '';
            if (class_exists( 'RWMB_Loader' ) && gt3_get_queried_object_id() !== 0) {
                if (rwmb_meta('mb_customize_logo') == 'custom') {
                    $mb_header_logo_src = rwmb_meta("mb_header_logo");
                    if (!empty($mb_header_logo_src)) {
                        $header_logo_src = array_values($mb_header_logo_src);
                        $header_logo_src = $header_logo_src[0]['full_url'];
                    }
                }
            }
            echo '<meta property="og:image" content="' . esc_url($header_logo_src) . '"/>';
        }
        else{
            $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium_large' );
            echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
        }
    }
}
if (!function_exists('gt3_gallery_array2js')) {
    function gt3_gallery_array2js($grid_array, $gal_id) {
        ?>
        <script>
            if (typeof grid_gal_array == "undefined") {
                var grid_gal_array = [];
            }
            if (typeof packery_gal_array == "undefined") {
                var packery_gal_array = [];
            }
            var packery_item = {},
                already_showed = 0;
            if (jQuery('.grid_gallery').size() > 0) {
                var grid_container = jQuery('.grid_gallery'),
                    grid_container_wrapper = jQuery('.grid_gallery_wrapper');

                grid_gal_array['grid_<?php echo esc_attr($gal_id); ?>'] = {};
                grid_gal_array['grid_<?php echo esc_attr($gal_id); ?>'].id = '<?php echo esc_attr($gal_id); ?>';
                grid_gal_array['grid_<?php echo esc_attr($gal_id); ?>'].showed = 0;
                grid_gal_array['grid_<?php echo esc_attr($gal_id); ?>'].items = [];
                <?php
                $i = 0;
            foreach ($grid_array as $image) {
                    ?>
                packery_item = {};
                packery_item.slide_type = "<?php echo esc_attr($image['slide_type']); ?>";
                <?php if ($image['slide_type'] == 'video') { ?>
                packery_item.src = "<?php echo esc_attr($image['url']); ?>";
                <?php } ?>
                packery_item.img = "<?php echo esc_url($image['url']); ?>";
                packery_item.thmb = "<?php echo esc_url($image['thmb']); ?>";
                packery_item.title = "<?php echo esc_attr($image['title']); ?>";
                packery_item.caption = "<?php echo !empty($image['caption']) ? esc_attr($image['caption']) : ''; ?>";
                packery_item.counter = "<?php echo esc_attr($image['count']); ?>";
                grid_gal_array['grid_<?php echo esc_attr($gal_id); ?>'].items.push(packery_item);
            <?php $i++;} ?>
            }
            if (jQuery('.packery_gallery').size() > 0) {
                var packery_container = jQuery('.packery_gallery'),
                    packery_container_wrapper = jQuery('.packery_gallery_wrapper');

                packery_gal_array['packery_<?php echo esc_attr($gal_id); ?>'] = {};
                packery_gal_array['packery_<?php echo esc_attr($gal_id); ?>'].id = '<?php echo esc_attr($gal_id); ?>';
                packery_gal_array['packery_<?php echo esc_attr($gal_id); ?>'].showed = 0;
                packery_gal_array['packery_<?php echo esc_attr($gal_id); ?>'].items = [];
                <?php
                $i = 0;
            foreach ($grid_array as $image) {
                    ?>
                packery_item = {};
                packery_item.slide_type = "<?php echo esc_attr($image['slide_type']); ?>";
                <?php if ($image['slide_type'] == 'video') { ?>
                packery_item.src = "<?php echo esc_attr($image['src']); ?>";
                <?php } ?>
                packery_item.img = "<?php echo esc_url($image['url']); ?>";
                packery_item.thmb = "<?php echo esc_url($image['thmb']); ?>";
                packery_item.title = "<?php echo esc_attr($image['title']); ?>";
                packery_item.caption = "<?php echo !empty($image['caption']) ? esc_attr($image['caption']) : ''; ?>";
                packery_item.counter = "<?php echo esc_attr($image['count']); ?>";
                packery_gal_array['packery_<?php echo esc_attr($gal_id); ?>'].items.push(packery_item);
            <?php $i++;} ?>
            }

        </script>
        <?php
    }
}

if ( class_exists('WooCommerce') ) {
	require_once( get_template_directory() . '/woocommerce/wooinit.php' ); // Woocommerce ini file
}

function gt3_get_queried_object_id(){
	$id = get_queried_object_id();
	if ( $id == 0 && class_exists('WooCommerce') ) {
		if (is_shop()) {
			$id = get_option('woocommerce_shop_page_id');
		}else if (is_cart()) {
			$id = get_option('woocommerce_cart_page_id');
		}else if (is_checkout()) {
			$id = get_option('woocommerce_checkout_page_id');
		}
	}
	return $id;
}

add_filter('pre_set_site_transient_update_plugins', function($repo_updates) {
	$plugins = get_option( 'gt3_plugins');
	if (!is_array($plugins)) {
		$plugins = array();
	}
	if(!function_exists('get_plugin_data')) {
		require_once(ABSPATH.'wp-admin/includes/plugin.php');
	}

	if(count($plugins)) {
		foreach($plugins as $slug_plugin => $plugin) {
			$file_path = sprintf('%1$s/%1$s.php', $slug_plugin);
			$full_path = sprintf('%1$s/%2$s', WP_PLUGIN_DIR, $file_path);
			if(!file_exists($full_path)) {
				continue;
			}

			$plugin_info = get_plugin_data($full_path);

			if(version_compare($plugin_info['Version'], $plugin['version'], '>=')) {
				continue;
			}

			if(empty($repo_updates->response[$file_path])) {
				$repo_updates->response[$file_path] = new stdClass;
			}

			// We only really need to set package, but let's do all we can in case WP changes something.
			$repo_updates->response[$file_path]->slug        = $slug_plugin;
			$repo_updates->response[$file_path]->plugin      = $file_path;
			$repo_updates->response[$file_path]->new_version = $plugin['version'];
			$repo_updates->response[$file_path]->package     = $plugin['source'];
			if(empty($repo_updates->response[$file_path]->url) && !empty($plugin['external_url'])) {
				$repo_updates->response[$file_path]->url = $plugin['external_url'];
			}
		}
	}

	return $repo_updates;
},0);

add_action(
	'init', function(){
	if(class_exists('Vc_Manager')) {
		$vc      = \Vc_Manager::getInstance();
		$updater = $vc->updater();
		if($updater instanceof \Vc_Updater) {
			remove_filter(
				'upgrader_pre_download', array(
				$updater,
				'preUpgradeFilter',
			), 10, 4
			);
		}
	}
}, 99);
