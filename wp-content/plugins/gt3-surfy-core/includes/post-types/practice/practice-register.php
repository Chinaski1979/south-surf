<?php


/**
* 
*/
class GT3PracticeRegister{

	public $cpt;
	public $dest_taxonomy;
    private $tag_taxonomy;
	private $slug;
	
	function __construct(){
		$this->cpt = 'practice';
		$this->taxonomy = $this->cpt.'-category';
		$this->slug = $this->cpt;
        if (function_exists('gt3_option')) {
            $slug_option = gt3_option('practice_slug');
        }else{
            $slug_option = '';
        }
        
        if (empty($slug_option)) {
            $this->slug = 'practice';
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

        register_post_type($this->cpt,
            array(
                'labels' 		=> array(
                    'name' 				=> __('Practices','gt3_surfy_core' ),
                    'singular_name' 	=> __('Practice','gt3_surfy_core' ),
                    'add_item'			=> __('New Practice','gt3_surfy_core'),
                    'add_new_item' 		=> __('Add New Practice','gt3_surfy_core'),
                    'edit_item' 		=> __('Edit Practice','gt3_surfy_core')
                ),
                'public'		=>	true,
                'has_archive' => true,
                'rewrite' 		=> 	array('slug' => $this->slug),
                'menu_position' => 	5,
                'show_ui' => true,
                'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'revisions'),
                'menu_icon'  =>  'dashicons-chart-area'
            )
        );

	}

	private function registerTax() {
        $labels = array(
            'name' => __( 'Practice Categories', 'gt3_surfy_core' ),
            'singular_name' => __( 'Practice Category', 'gt3_surfy_core' ),
            'search_items' =>  __( 'Search Practice Categories','gt3_surfy_core' ),
            'all_items' => __( 'All Practice Categories','gt3_surfy_core' ),
            'parent_item' => __( 'Parent Practice Category','gt3_surfy_core' ),
            'parent_item_colon' => __( 'Parent Practice Category:','gt3_surfy_core' ),
            'edit_item' => __( 'Edit Practice Category','gt3_surfy_core' ),
            'update_item' => __( 'Update Practice Category','gt3_surfy_core' ),
            'add_new_item' => __( 'Add New Practice Category','gt3_surfy_core' ),
            'new_item_name' => __( 'New Practice Category Name','gt3_surfy_core' ),
            'menu_name' => __( 'Categories','gt3_surfy_core' ),
        );

        register_taxonomy($this->taxonomy, array($this->cpt), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => self::getSlug().'-category' ),
        ));
        /*$dest_labels = array(
            'name' => __( 'Destinations', 'gt3_surfy_core' ),
            'singular_name' => __( 'Destination', 'gt3_surfy_core' ),
            'search_items' =>  __( 'Search Destinations','gt3_surfy_core' ),
            'all_items' => __( 'All Destinations','gt3_surfy_core' ),
            'parent_item' => __( 'Parent Destination','gt3_surfy_core' ),
            'parent_item_colon' => __( 'Parent Destination:','gt3_surfy_core' ),
            'edit_item' => __( 'Edit Destination','gt3_surfy_core' ),
            'update_item' => __( 'Update Destination','gt3_surfy_core' ),
            'add_new_item' => __( 'Add New Destination','gt3_surfy_core' ),
            'new_item_name' => __( 'New Destination Name','gt3_surfy_core' ),
            'menu_name' => __( 'Destinations','gt3_surfy_core' ),
        );

        register_taxonomy($this->dest_taxonomy, array($this->cpt), array(
            'hierarchical' => true,
            'labels' => $dest_labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => $this->slug.'-category' ),
        ));

        $tag_labels = array(
            'name' => __( 'Tags', 'gt3_surfy_core' ),
            'singular_name' => __( 'Tag', 'gt3_surfy_core' ),
            'search_items' =>  __( 'Search Tags','gt3_surfy_core' ),
            'all_items' => __( 'All Tags','gt3_surfy_core' ),
            'parent_item' => __( 'Parent Tag','gt3_surfy_core' ),
            'parent_item_colon' => __( 'Parent Tag:','gt3_surfy_core' ),
            'edit_item' => __( 'Edit Tag','gt3_surfy_core' ),
            'update_item' => __( 'Update Tag','gt3_surfy_core' ),
            'add_new_item' => __( 'Add New Tag','gt3_surfy_core' ),
            'new_item_name' => __( 'New Tag Name','gt3_surfy_core' ),
            'menu_name' => __( 'Tags','gt3_surfy_core' ),
        );

        register_taxonomy($this->tag_taxonomy, array($this->cpt), array(
            'hierarchical' => true,
            'labels' => $tag_labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => $this->slug.'-tag' ),
        ));*/

    }

    public function registerSingleTemplate($single){
        global $post;

        if($post->post_type == $this->cpt) {
            if(!file_exists(get_template_directory().'/single-'.$this->cpt.'.php')) {
                return plugin_dir_path( dirname( __FILE__ ) ) .'practice/templates/single-'.$this->cpt.'.php';
            }
        }

        return $single;  
    }

    /*public function registerArchiveTemplate($archive){
        global $post;

        if(is_post_type_archive ($this->cpt)) {
            if(!file_exists(get_template_directory().'/archive-'.$this->cpt.'.php')) {
                return plugin_dir_path( dirname( __FILE__ ) ) .'tour/templates/archive-'.$this->cpt.'.php';
            }
        }

        return $archive;  
    }*/

}



?>