<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://themeforest.net/user/gt3themes
 * @since      1.0.0
 *
 * @package    Gt3_surfy_core
 * @subpackage Gt3_surfy_core/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Gt3_surfy_core
 * @subpackage Gt3_surfy_core/includes
 * @author     GT3themes <GT3themes@gmail.com>
 */
class Gt3_surfy_core {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Gt3_surfy_core_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'gt3_surfy_core';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_CPT_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Gt3_surfy_core_Loader. Orchestrates the hooks of the plugin.
	 * - Gt3_surfy_core_i18n. Defines internationalization functionality.
	 * - Gt3_surfy_core_Admin. Defines all hooks for the admin area.
	 * - Gt3_surfy_core_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) .'/includes/widgets/posts.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) .'/includes/widgets/flickr.php';
		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-gt3_surfy_core-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-gt3_surfy_core-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-gt3_surfy_core-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-gt3_surfy_core-public.php';

		//Load redux
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/framework/class.redux-plugin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/framework/init.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/redux-extension-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/redux-importer-config.php';
		//Load meta-box
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/meta-box/meta-box.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/metabox-addon.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/post-types/post-types-register.php';
		/*require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/post-types/tour/tour-register.php';*/
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/post-types/team/team-register.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/post-types/practice/practice-register.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/post-types/practice/shortcodes/practice.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-gt3-woocommerce-adjacent-products.php';

		$this->loader = new Gt3_surfy_core_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Gt3_surfy_core_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Gt3_surfy_core_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Gt3_surfy_core_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}


	/**
	 * Register all of the hooks related to the CPT functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_CPT_hooks(){
		$plugin_CPT = GT3PostTypesRegister::getInstance();
		$this->loader->add_action( 'after_setup_theme', $plugin_CPT, 'register' );
		$this->loader->add_action( 'after_setup_theme', $plugin_CPT, 'shortcodes' );

		/*$tours = new GT3TourRegister();*/
		$practice = new GT3PracticeRegister();
		/*$this->loader->add_filter( 'manage_edit-'.$tours->cpt.'_columns', $tours, 'gt3_tours_columns_settings',10,1);
        $this->loader->add_action( 'manage_'.$tours->cpt.'_posts_custom_column', $tours, 'gt3_tours_columns_content',10,2);

        $this->loader->add_filter( 'manage_edit-'.$tours->dest_taxonomy.'_columns', $tours, 'gt3_destination_columns_settings',10,1);
        $this->loader->add_filter( 'manage_'.$tours->dest_taxonomy.'_custom_column', $tours, 'gt3_destination_columns_content',10,3);

        $this->loader->add_action( 'add_meta_boxes', $tours, 'tours_price_box',1,1);
        $this->loader->add_action( 'save_post', $tours, 'tour_price_box_save',1,2);
        $this->loader->add_action( $tours->dest_taxonomy.'_add_form_fields', $tours, 'add_thumbnail_to_taxonomy',10,2);
        $this->loader->add_action( 'admin_footer', $tours, 'add_thumbnail_to_taxonomy_sctipt');
        $this->loader->add_action( 'created_'.$tours->dest_taxonomy, $tours, 'save_taxonomy_thumbnail',10,2);
        $this->loader->add_action( $tours->dest_taxonomy.'_edit_form_fields', $tours, 'update_taxonomy_thumbnail',10,2);
        $this->loader->add_action( 'edited_'.$tours->dest_taxonomy, $tours, 'updated_taxonomy_thumbnail',10,2);*/

        /*register practice single*/
        $this->loader->add_filter( 'single_template', $practice, 'registerSingleTemplate');
        /*register tour single*/
        //$this->loader->add_filter( 'single_template', $tours, 'registerSingleTemplate');
        /* register archive tour */
        //$this->loader->add_filter( 'archive_template', $tours, 'registerArchiveTemplate');

        /* search tour */
        /*$tour_search = new GT3TourSearchRegister();

        $this->loader->add_action( 'query_vars', $tour_search, 'sm_register_query_vars');

        $this->loader->add_action( 'pre_get_posts', $tour_search, 'sm_pre_get_posts',1,1);*/

        // out search shortcode
		if (!function_exists('gt3_search_shortcode')) {
		    function gt3_search_shortcode(){
		        $header_height = gt3_option('header_height');
		        $header_height = $header_height['height'];
		        if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
		            if (rwmb_meta('mb_customize_header_layout') == 'custom') {
		                $header_height = rwmb_meta("mb_header_height");
		            }
		        }

		        $search_style = '';
		        $search_style .= !empty($header_height) ? 'height:'.$header_height.'px;' : '';
		        $search_style = !empty($search_style) ? ' style="'.$search_style.'"' : '' ;


		        $out = '<div class="header_search"'.$search_style.'>';
		            $out .= '<div class="header_search__container">';
		                $out .= '<div class="header_search__icon">';
		                    $out .= '<i></i>';
		                $out .= '</div>';
		                $out .= '<div class="header_search__inner">';
		                    $out .= get_search_form(false);
		                $out .= '</div>';
		            $out .= '</div>';
		        $out .= '</div>';
		        return $out;
		    }
		    add_shortcode('gt3_search', 'gt3_search_shortcode');

		}

        add_action('wp_head','gt3_wp_head_custom_code',1000);
		function gt3_wp_head_custom_code() {
		    // this code not only js or css / can insert any type of code
		    if (function_exists('gt3_option')) {
		    	$header_custom_code = gt3_option('header_custom_js');
	        	echo isset($header_custom_code) ? $header_custom_code : '';
		    }

		}

		add_action('wp_footer', 'gt3_custom_footer_js',1000);
		function gt3_custom_footer_js() {
			if (function_exists('gt3_option')) {
			    $custom_js = gt3_option('custom_js');
			    echo isset($custom_js) ? '<script type="text/javascript" id="gt3_custom_footer_js">'.$custom_js.'</script>' : '';
			}
		}


	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Gt3_surfy_core_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Gt3_surfy_core_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
