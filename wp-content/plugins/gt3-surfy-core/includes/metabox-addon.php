<?php 
function gt3_woo_adding_function(){
    if ( class_exists('WooCommerce') ) {
        // New tab for Single Product Data Tabs
        function gt3_new_product_tab() {
            add_meta_box( 'gt3_new_product_tab', esc_html__( 'Product details', 'sunergy' ), 'gt3_new_product_tab_callback', 'product' );
        }
        add_action('add_meta_boxes', 'gt3_new_product_tab');

        function gt3_new_product_tab_callback() {
            $post_id = get_the_ID();
            if (get_post_type($post_id) != 'product') return;
            $gt3_product_details = get_post_meta($post_id,'gt3_new_product_tab_meta_value_key',true);
            $gt3_product_subtitle = get_post_meta($post_id,'gt3_product_subtitle_meta_value_key',true);

            echo '<div class="rwmb-field rwmb-select-wrapper">';
            wp_nonce_field('gt3_new_product_tab_nonce_'.$post_id,'gt3_new_product_tab_nonce');
                echo '<div class="rwmb-label">
                          <label for="gt3_product_subtitle_field">'.esc_html__("Sub-Title for this product", 'sunergy' ).'</label>
                      </div>
                      <div class="rwmb-input">
                          <textarea id="gt3_product_subtitle_field" name="gt3_product_subtitle_field" style="width:100%;height:90px;" />'.$gt3_product_subtitle.'</textarea>
                      </div>';
                echo '<div class="rwmb-label">
                          <label for="gt3_new_product_tab_field">'.esc_html__("Description for this product", 'sunergy' ).'</label>
                      </div>
                      <div class="rwmb-input">
                          <textarea id="gt3_new_product_tab_field" name="gt3_new_product_tab_field" style="width:100%;height:90px;" />'.$gt3_product_details.'</textarea>
                      </div>';
            echo '</div>';
        }

        function gt3_new_product_tab_save_postdata( $post_id ) {
            if (!isset($_POST['gt3_new_product_tab_nonce']) || !wp_verify_nonce($_POST['gt3_new_product_tab_nonce'],'gt3_new_product_tab_nonce_'.$post_id)) return;
            if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
                return $post_id;
            }
            if ( 'page' == $_POST['post_type'] && ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            } elseif( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
            if ( !isset($_POST['gt3_new_product_tab_field']) && !isset($_POST['gt3_product_subtitle_field']) )
                return;

            $_data = wp_kses_post( $_POST['gt3_new_product_tab_field'] );
            $_data_2 = wp_kses_post( $_POST['gt3_product_subtitle_field'] );
            update_post_meta( $post_id, 'gt3_new_product_tab_meta_value_key', $_data );
            update_post_meta( $post_id, 'gt3_product_subtitle_meta_value_key', $_data_2 );
        }
        add_action( 'save_post', 'gt3_new_product_tab_save_postdata' );

        function gt3_new_product_tab_frontend( $tabs ) {
            $gt3_product_details = get_post_meta(get_the_ID(),'gt3_new_product_tab_meta_value_key',true);
            if ( !empty( $gt3_product_details ) ) {
                $tabs['details'] = array(
                    'title'     => esc_html__( 'Details', 'sunergy' ),
                    'priority'  => 20,
                    'callback'  => 'woo_new_product_tab_content'
                );
            }
            return $tabs;
        }
        function woo_new_product_tab_content() {
            $gt3_product_details = get_post_meta(get_the_ID(),'gt3_new_product_tab_meta_value_key',true);
            echo '<h2>'.esc_html__( 'Details', 'sunergy' ).'</h2>';
            echo '<p>'.wp_kses_post($gt3_product_details).'</p>';
        }
        add_filter( 'woocommerce_product_tabs', 'gt3_new_product_tab_frontend' );

        // Display Product Title
        function gt3_product_subtitle_frontend() {
            $gt3_product_subtitle = get_post_meta(get_the_ID(),'gt3_product_subtitle_meta_value_key',true);
            if ( !empty( $gt3_product_subtitle ) ) {
                echo '<h4 class="gt3-product-subtitle">'.esc_attr($gt3_product_subtitle).'</h4>';
            }
        }
        add_action('woocommerce_single_product_summary','gt3_product_subtitle_frontend', 6);
    }
}
add_action('init', 'gt3_woo_adding_function');

remove_filter('pre_user_description', 'wp_filter_kses');

function gt3_get_all_icon () {
    
    $file = get_template_directory() . '/css/font-awesome.min.css';
    $myfile = call_user_func('fopen', $file, "r") or die("Unable to open file!");
    $fa_content = call_user_func('fread', $myfile, filesize($file)) ;
    call_user_func('fclose', $myfile);

    if ( preg_match_all( "/fa-((\w+|-?)+):before/", $fa_content, $matches, PREG_PATTERN_ORDER ) ){
        $gt3_fa_options = array();
        for ($i=0; $i<count($matches[1]); $i++) {
            $gt3_fa_options['fa fa-'.$matches[1][$i]] = esc_html($matches[1][$i]);
        }
        return $gt3_fa_options;
    }

}

if ( class_exists( 'RWMB_Field' ) )
{
    class RWMB_Social_Field extends RWMB_Field
    {
        /**
         * Get field HTML
         *
         * @param mixed $meta
         * @param array $field
         *
         * @return string
         */
        static public function html( $meta, $field )
        {
            $out = '<fieldset>';
            
            foreach ($field['options'] as $key => $value) {
                $meta[$key] = !empty($meta[$key]) ? $meta[$key] : '';
                $out .= '<label style="display:inline-block; padding: 0 20px 0 0;">'.$value["name"].'<br>';
                $out .= '<input '.($field['clone'] ? 'class="rwmb-fieldset_text"' : '').' id="'.$field['id'].'" type="'.$value["type_input"].'" name="'.$field['field_name'].'['.$key.']" value="'.$meta[$key].'">';
                $out .= '</label>';
            }
            $out .= '</fieldset>';
            return sprintf(
                $out,
                $field['field_name'],
                $field['id'],
                $meta
            );
        }
    }

    class RWMB_Select_Icon_Field extends RWMB_Select_Field {

        /**
         * Enqueue scripts and styles
         */
        public static function admin_enqueue_scripts() {
            parent::admin_enqueue_scripts();
            wp_enqueue_style( 'rwmb-select2', RWMB_CSS_URL . 'select2/select2.css', array(), '4.0.1' );
            wp_enqueue_style( 'rwmb-select-advanced', RWMB_CSS_URL . 'select-advanced.css', array(), RWMB_VER );

            wp_register_script( 'rwmb-select2', RWMB_JS_URL . 'select2/select2.min.js', array( 'jquery' ), '4.0.2', true );

            // Localize
            $dependencies = array( 'rwmb-select2', 'rwmb-select' );
            $locale       = str_replace( '_', '-', get_locale() );
            $locale_short = substr( $locale, 0, 2 );
            $locale       = file_exists( RWMB_DIR . "js/select2/i18n/$locale.js" ) ? $locale : $locale_short;

            if ( file_exists( RWMB_DIR . "js/select2/i18n/$locale.js" ) ) {
                wp_register_script( 'rwmb-select2-i18n', RWMB_JS_URL . "select2/i18n/$locale.js", array( 'rwmb-select2' ), '4.0.2', true );
                $dependencies[] = 'rwmb-select2-i18n';
            }

            wp_enqueue_script( 'rwmb-select', RWMB_JS_URL . 'select.js', array( 'jquery' ), RWMB_VER, true );
            wp_enqueue_script( 'rwmb-select-advanced', RWMB_JS_URL . 'select-advanced.js', $dependencies, RWMB_VER, true );
        }

        public static function walk( $field, $options, $db_fields, $meta ) {
            $attributes = self::call( 'get_attributes', $field, $meta );
            $walker     = new RWMB_Walker_Select( $db_fields, $field, $meta );

            $attributes_select = $attributes;
            $attributes_select['name'] = $attributes['name'].'[select]';

            $output     = sprintf(
                '<select %s>',
                self::render_attributes( $attributes_select )
            );
            if ( false === $field['multiple'] ) {
                $output .= $field['placeholder'] ? '<option value="">' . esc_html( $field['placeholder'] ) . '</option>' : '';
            }
            $output .= $walker->walk( $options, $field['flatten'] ? - 1 : 0 );
            $output .= '</select>';
            $meta['input'] = empty($meta['input']) ? '' : $meta['input'];
            $output .= '<lable style="vertical-align:middle; margin-left: 20px"> Url:';
            $output .= '<input type="text" '.($field['clone'] ? 'class="rwmb-fieldset_text"' : '').' id="'.$field['id'].'" name="'.$attributes['name'].'[input]'.'" value="'.$meta['input'].'">';
            $output .= '</lable>';
            $output .= self::get_select_all_html( $field );
            return $output;
        }

        /**
         * Normalize parameters for field
         *
         * @param array $field
         * @return array
         */
        public static function normalize( $field ) {
            $field = wp_parse_args( $field, array(
                'js_options'  => array(),
                'placeholder' => __( 'Select an item', 'surfylaw' ),
            ) );

            $field = parent::normalize( $field );

            $field['js_options'] = wp_parse_args( $field['js_options'], array(
                'allowClear'  => true,
                'width'       => 'none',
                'placeholder' => $field['placeholder'],
            ) );

            return $field;
        }

        /**
         * Get the attributes for a field
         *
         * @param array $field
         * @param mixed $value
         * @return array
         */
        public static function get_attributes( $field, $value = null ) {
            $attributes = parent::get_attributes( $field, $value );
            $attributes = wp_parse_args( $attributes, array(
                'data-options' => wp_json_encode( $field['js_options'] ),
            ) );

            return $attributes;
        }
    }
}



function gt3_changelog(){

    global $wp_version;
    $my_theme = wp_get_theme();
    $version = $my_theme->get( 'Version' );


    $gt3_changelog = get_option( 'gt3_changelog' );

    if (!empty($gt3_changelog) && is_array($gt3_changelog)) {      
        if (version_compare( $version, $gt3_changelog['version'], '>')) {
            $gt3_changelog['version'] = $version;
            $gt3_changelog['changelog'] = gt3_get_changlog_content();
            update_option( 'gt3_changelog' , $gt3_changelog);
        }
    }else{
        $gt3_changelog = array();
        $gt3_changelog['version'] = $version;
        $gt3_changelog['changelog'] = gt3_get_changlog_content();
        update_option( 'gt3_changelog' , $gt3_changelog);
    }

}
gt3_changelog();

function gt3_get_changlog_content(){
    $changelog = '';
    $file = get_template_directory() . '/changelog.txt';
    if (!file_exists($file)) {
        return 'No Logs';
    }
    $myfile = call_user_func('fopen', $file, "r") or die("Unable to open file!");
    $changelog_content = call_user_func('fread', $myfile, filesize($file)) ;
    call_user_func('fclose', $myfile);
    $changelog_content = explode("------------------------------------------------------------------------------", $changelog_content);
    if (!empty($changelog_content) && is_array($changelog_content)) {
        foreach ($changelog_content as $changelog_item) {
            $changelog_item = trim($changelog_item);
            if ( preg_match_all( "/^.+/", $changelog_item, $matches, PREG_PATTERN_ORDER ) ){
                $content = str_replace($matches[0], '', $changelog_item);
                $content_array = explode('Changed files:', $content);
                $content = !empty($content_array[0]) ? $content_array[0] : $content;
                $changed_files = !empty($content_array[1]) ? $content_array[1] : '';
                $changelog .= "<div class='gt3_changelog'>";
                $changelog .=  "<h2>".$matches[0][0]."</h2>";
                $changelog .=  "<pre>".$content."</pre>";
                if (!empty($changed_files)) {
                    $changelog .=  "<strong>Changed files:</strong>";
                    $changelog .=  "<pre>".trim($changed_files)."</pre>";
                }
                $changelog .=  "</div>";                
            }                                                                                                                              
        }
    }
    return $changelog;
}

if (!function_exists('gt3_string_coding')) {
    function gt3_string_coding($code){
        if (!empty($code)) {
            return base64_encode($code);
        }   
        return;     
    }
}

?>