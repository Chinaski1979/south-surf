<?php

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    $theme = wp_get_theme();
    $opt_name = 'surfy';

    $args = array(
        'opt_name'             => $opt_name,
        'display_name'         => $theme->get( 'Name' ),
        'display_version'      => $theme->get( 'Version' ),
        'menu_type'            => 'menu',
        'allow_sub_menu'       => true,
        'menu_title'           => esc_html__('Theme Options', 'surfy' ),
        'page_title'           => esc_html__('Theme Options', 'surfy' ),
        'google_api_key'       => '',
        'google_update_weekly' => false,
        'async_typography'     => true,
        'admin_bar'            => true,
        'admin_bar_icon'       => 'dashicons-admin-generic',
        'admin_bar_priority'   => 50,
        'global_variable'      => '',
        'dev_mode'             => false,
        'update_notice'        => true,
        'customizer'           => false,
        'page_priority'        => null,
        'page_parent'          => 'themes.php',
        'page_permissions'     => 'manage_options',
        'menu_icon'            => 'dashicons-admin-generic',
        'last_tab'             => '',
        'page_icon'            => 'icon-themes',
        'page_slug'            => '',
        'save_defaults'        => true,
        'default_show'         => false,
        'default_mark'         => '',
        'show_import_export'   => true,
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        'output_tag'           => true,
        'database'             => '',
        'use_cdn'              => true,
    );


    Redux::setArgs( $opt_name, $args );


    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title'            => __( 'General', 'surfy' ),
        'id'               => 'general',
        'customizer_width' => '400px',
        'icon'             => 'el el-home',
        'fields'           => array(
            array(
                'id'       => 'responsive',
                'type'     => 'switch',
                'title'    => esc_html__( 'Responsive', 'surfy' ),
                'default'  => true,
            ),
            array(
                'id'       => 'page_comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Page Comments', 'surfy' ),
                'default'  => true,
            ),
            array(
                'id'       => 'back_to_top',
                'type'     => 'switch',
                'title'    => esc_html__( 'Back to Top', 'surfy' ),
                'default'  => true,
            ),
            array(
                'id' => 'team_slug',
                'type' => 'text',
                'title' => esc_html__('Team Slug', 'surfy' ),
            ),
            array(
                'id' => 'practice_slug',
                'type' => 'text',
                'title' => esc_html__('Practice Slug', 'surfy' ),
            ),
            array(
                'id'       => 'custom_js',
                'type'     => 'ace_editor',
                'title'    => __( 'Custom JS', 'surfy' ),
                'subtitle' => __( 'Paste your JS code here.', 'surfy' ),
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'default'  => ""
            ),
            array(
                'id'       => 'header_custom_js',
                'type'     => 'ace_editor',
                'title'    => __( 'Custom JS', 'surfy' ),
                'subtitle' => __( 'Code to be added inside HEAD tag', 'surfy' ),
                'mode'     => 'html',
                'theme'    => 'chrome',
                'default'  => ""
            ),
            array(
                'id'       => '404_image',
                'type'     => 'media',
                'title'    => esc_html__( '404 Page Image', 'surfy' ),
            ),
        ),
    ) );


    // HEADER
    if (function_exists('gt3_header_presets')) {
        $presets = gt3_header_presets();
        $header_preset_1 = $presets['header_preset_1'];
        $header_preset_2 = $presets['header_preset_2'];
    }

    function gt3_getMenuList(){
        $menus = wp_get_nav_menus();
        $menu_list = array();

        foreach ($menus as $menu => $menu_obj) {
            $menu_list[$menu_obj->slug] = $menu_obj->name;
        }
        return $menu_list;
    }

$def_header_option = array(
    'all_item'      => array(
        'title'   => 'All Item',
        'layout'  => 'all',
        'content' => array(
            'search'         => array(
                'title'        => 'Search',
                'has_settings' => false,
            ),
            'login'          => array(
	            'title'        => 'Login',
	            'has_settings' => false,
            ),
            'cart'           => array(
	            'title'        => 'Cart',
	            'has_settings' => false,
            ),
            'burger_sidebar' => array(
                'title'        => 'Burger Sidebar',
                'has_settings' => true,
            ),
            'text1'          => array(
                'title'        => 'Text/HTML 1',
                'has_settings' => true,
            ),
            'text2'          => array(
                'title'        => 'Text/HTML 2',
                'has_settings' => true,
            ),

            'text3' => array(
                'title'        => 'Text/HTML 3',
                'has_settings' => true,
            ),
            'text4' => array(
                'title'        => 'Text/HTML 4',
                'has_settings' => true,
            ),

            'text5'      => array(
                'title'        => 'Text/HTML 5',
                'has_settings' => true,
            ),
            'text6'      => array(
                'title'        => 'Text/HTML 6',
                'has_settings' => true,
            ),
            'delimiter1' => array(
                'title'        => '|',
                'has_settings' => true,
            ),
            'delimiter2' => array(
                'title'        => '|',
                'has_settings' => true,
            ),
            'delimiter3' => array(
                'title'        => '|',
                'has_settings' => true,
            ),
            'delimiter4' => array(
                'title'        => '|',
                'has_settings' => true,
            ),
            'delimiter5' => array(
                'title'        => '|',
                'has_settings' => true,
            ),
            'delimiter6' => array(
                'title'        => '|',
                'has_settings' => true,
            ),
            'empty_space1' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space2' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space3' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space4' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space5' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
        ),
    ),
    'top_left'      => array(
        'title'        => 'Top Left',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'content'      => array(),
    ),
    'top_center'    => array(
        'title'        => 'Top Center',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'content'      => array(),
    ),
    'top_right'     => array(
        'title'        => 'Top Right',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'content'      => array(),
    ),
    'middle_left'   => array(
        'title'        => 'Middle Left',
        'has_settings' => true,
        'layout'       => 'one-thirds clear-item',
        'content'      => array(
            'logo' => array(
                'title'        => 'Logo',
                'has_settings' => true,
            ),
        ),
    ),
    'middle_center' => array(
        'title'        => 'Middle Center',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'content'      => array(),
    ),
    'middle_right'  => array(
        'title'        => 'Middle Right',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'content'      => array(
            'menu' => array(
                'title'        => 'Menu',
                'has_settings' => true,
            ),
        ),
    ),
    'bottom_left'   => array(
        'title'        => 'Bottom Left',
        'has_settings' => true,
        'layout'       => 'one-thirds clear-item',
        'content'      => array(),
    ),
    'bottom_center' => array(
        'title'        => 'Bottom Center',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'content'      => array(),
    ),
    'bottom_right'  => array(
        'title'        => 'Bottom Right',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'content'      => array(),
    ),

    /// tablet
    'all_item__tablet' => array(
        'title' => 'All Item',
        'layout' => 'all',
        'extra_class' => 'tablet',
        'content' => array(
            'logo' => array(
                'title'        => 'Logo',
                'has_settings' => true,
            ),
            'menu' => array(
                'title'        => 'Menu',
                'has_settings' => true,
            ),
            'search' => array(
                'title' => 'Search',
                'has_settings' => false,
            ),
            'login' => array(
	            'title' => 'Login',
	            'has_settings' => false,
            ),
            'cart' => array(
	            'title' => 'Cart',
	            'has_settings' => false,
            ),
            'burger_sidebar' => array(
                'title' => 'Burger Sidebar',
                'has_settings' => true,
            ),
            'text1' => array(
                'title' => 'Text/HTML 1',
                'has_settings' => true,
            ),
            'text2' => array(
                'title' => 'Text/HTML 2',
                'has_settings' => true,
            ),

            'text3' => array(
                'title' => 'Text/HTML 3',
                'has_settings' => true,
            ),
            'text4' => array(
                'title' => 'Text/HTML 4',
                'has_settings' => true,
            ),

            'text5' => array(
                'title' => 'Text/HTML 5',
                'has_settings' => true,
            ),
            'text6' => array(
                'title' => 'Text/HTML 6',
                'has_settings' => true,
            ),
            'delimiter1' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter2' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter3' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter4' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter5' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter6' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'empty_space1' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space2' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space3' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space4' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space5' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
        ),
    ),
    'top_left__tablet'      => array(
        'title'        => 'Top Left',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'top_center__tablet'    => array(
        'title'        => 'Top Center',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'top_right__tablet'     => array(
        'title'        => 'Top Right',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'middle_left__tablet'   => array(
        'title'        => 'Middle Left',
        'has_settings' => true,
        'layout'       => 'one-thirds clear-item',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'middle_center__tablet' => array(
        'title'        => 'Middle Center',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'middle_right__tablet'  => array(
        'title'        => 'Middle Right',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'bottom_left__tablet'   => array(
        'title'        => 'Bottom Left',
        'has_settings' => true,
        'layout'       => 'one-thirds clear-item',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'bottom_center__tablet' => array(
        'title'        => 'Bottom Center',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),
    'bottom_right__tablet'  => array(
        'title'        => 'Bottom Right',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'tablet',
        'content'      => array(),
    ),


    /// mobile
    'all_item__mobile' => array(
        'title' => 'All Item',
        'layout' => 'all',
        'extra_class' => 'mobile',
        'content' => array(
            'logo' => array(
                'title'        => 'Logo',
                'has_settings' => true,
            ),
            'menu' => array(
                'title'        => 'Menu',
                'has_settings' => true,
            ),
            'search' => array(
                'title' => 'Search',
                'has_settings' => false,
            ),
            'login' => array(
	            'title' => 'Login',
	            'has_settings' => false,
            ),
            'cart' => array(
	            'title' => 'Cart',
	            'has_settings' => false,
            ),
            'burger_sidebar' => array(
                'title' => 'Burger Sidebar',
                'has_settings' => true,
            ),
            'text1' => array(
                'title' => 'Text/HTML 1',
                'has_settings' => true,
            ),
            'text2' => array(
                'title' => 'Text/HTML 2',
                'has_settings' => true,
            ),

            'text3' => array(
                'title' => 'Text/HTML 3',
                'has_settings' => true,
            ),
            'text4' => array(
                'title' => 'Text/HTML 4',
                'has_settings' => true,
            ),

            'text5' => array(
                'title' => 'Text/HTML 5',
                'has_settings' => true,
            ),
            'text6' => array(
                'title' => 'Text/HTML 6',
                'has_settings' => true,
            ),
            'delimiter1' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter2' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter3' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter4' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter5' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'delimiter6' => array(
                'title' => '|',
                'has_settings' => true,
            ),
            'empty_space1' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space2' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space3' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space4' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
            'empty_space5' => array(
                'title' => '&#8592;&#8594;',
                'has_settings' => false,
            ),
        ),
    ),
    'top_left__mobile'      => array(
        'title'        => 'Top Left',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'top_center__mobile'    => array(
        'title'        => 'Top Center',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'top_right__mobile'     => array(
        'title'        => 'Top Right',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'middle_left__mobile'   => array(
        'title'        => 'Middle Left',
        'has_settings' => true,
        'layout'       => 'one-thirds clear-item',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'middle_center__mobile' => array(
        'title'        => 'Middle Center',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'middle_right__mobile'  => array(
        'title'        => 'Middle Right',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'bottom_left__mobile'   => array(
        'title'        => 'Bottom Left',
        'has_settings' => true,
        'layout'       => 'one-thirds clear-item',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'bottom_center__mobile' => array(
        'title'        => 'Bottom Center',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
    'bottom_right__mobile'  => array(
        'title'        => 'Bottom Right',
        'has_settings' => true,
        'layout'       => 'one-thirds',
        'extra_class' => 'mobile',
        'content'      => array(),
    ),
);

$options = array(
    array(
        'id'         => 'gt3_header_builder_id',
        'type'       => 'gt3_header_builder',
        'full_width' => true,
        'presets' => 'default',
        'options' => array(
            'all_item' => array(
                'title' => 'All Item',
                'layout' => 'all',
                'content' => array(
                    'search' => array(
                        'title' => 'Search',
                        'has_settings' => false,
                    ),
                    'login' => array(
	                    'title' => 'Login',
	                    'has_settings' => false,
                    ),
                    'cart' => array(
	                    'title' => 'Cart',
	                    'has_settings' => false,
                    ),
                    'burger_sidebar' => array(
                        'title' => 'Burger Sidebar',
                        'has_settings' => true,
                    ),
                    'text1' => array(
                        'title' => 'Text/HTML 1',
                        'has_settings' => true,
                    ),
                    'text2' => array(
                        'title' => 'Text/HTML 2',
                        'has_settings' => true,
                    ),

                    'text3' => array(
                        'title' => 'Text/HTML 3',
                        'has_settings' => true,
                    ),
                    'text4' => array(
                        'title' => 'Text/HTML 4',
                        'has_settings' => true,
                    ),

                    'text5' => array(
                        'title' => 'Text/HTML 5',
                        'has_settings' => true,
                    ),
                    'text6' => array(
                        'title' => 'Text/HTML 6',
                        'has_settings' => true,
                    ),
                    'delimiter1' => array(
                        'title' => '|',
                        'has_settings' => false,
                    ),
                    'delimiter2' => array(
                        'title' => '|',
                        'has_settings' => false,
                    ),
                    'delimiter3' => array(
                        'title' => '|',
                        'has_settings' => false,
                    ),
                    'delimiter4' => array(
                        'title' => '|',
                        'has_settings' => false,
                    ),
                    'delimiter5' => array(
                        'title' => '|',
                        'has_settings' => false,
                    ),
                    'delimiter6' => array(
                        'title' => '|',
                        'has_settings' => false,
                    ),
                    'empty_space1' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space2' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space3' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space4' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space5' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                ),
            ),
            'top_left' => array(
                'title' => 'Top Left',
                'has_settings' => true,
                'layout' => 'one-thirds',
                'content' => array(
                ),
            ),
            'top_center' => array(
                'title' => 'Top Center',
                'has_settings' => true,
                'layout' => 'one-thirds',
                'content' => array(
                ),
            ),
            'top_right' => array(
                'title' => 'Top Right',
                'has_settings' => true,
                'layout' => 'one-thirds',
                'content' => array(
                ),
            ),
            'middle_left' => array(
                'title' => 'Middle Left',
                'has_settings' => true,
                'layout' => 'one-thirds clear-item',
                'content' => array(
                    'logo' => array(
                        'title' => 'Logo',
                        'has_settings' => true,
                    ),
                ),
            ),
            'middle_center' => array(
                'title' => 'Middle Center',
                'has_settings' => true,
                'layout' => 'one-thirds',
                'content' => array(

                ),
            ),
            'middle_right' => array(
                'title' => 'Middle Right',
                'has_settings' => true,
                'layout' => 'one-thirds',
                'content' => array(
                    'menu' => array(
                        'title' => 'Menu',
                        'has_settings' => true,
                    ),
                ),
            ),
            'bottom_left' => array(
                'title' => 'Bottom Left',
                'has_settings' => true,
                'layout' => 'one-thirds clear-item',
                'content' => array(

                ),
            ),
            'bottom_center' => array(
                'title' => 'Bottom Center',
                'has_settings' => true,
                'layout' => 'one-thirds',
                'content' => array(

                ),
            ),
            'bottom_right' => array(
                'title' => 'Bottom Right',
                'has_settings' => true,
                'layout' => 'one-thirds',
                'content' => array(),
            ),
            /// tablet
            'all_item__tablet' => array(
                'title' => 'All Item',
                'layout' => 'all',
                'extra_class' => 'tablet',
                'content' => array(
                    'logo' => array(
                        'title'        => 'Logo',
                        'has_settings' => true,
                    ),
                    'menu' => array(
                        'title'        => 'Menu',
                        'has_settings' => true,
                    ),
                    'search' => array(
                        'title' => 'Search',
                        'has_settings' => false,
                    ),
                    'login' => array(
	                    'title' => 'Login',
	                    'has_settings' => false,
                    ),
                    'cart' => array(
	                    'title' => 'Cart',
	                    'has_settings' => false,
                    ),
                    'burger_sidebar' => array(
                        'title' => 'Burger Sidebar',
                        'has_settings' => true,
                    ),
                    'text1' => array(
                        'title' => 'Text/HTML 1',
                        'has_settings' => true,
                    ),
                    'text2' => array(
                        'title' => 'Text/HTML 2',
                        'has_settings' => true,
                    ),

                    'text3' => array(
                        'title' => 'Text/HTML 3',
                        'has_settings' => true,
                    ),
                    'text4' => array(
                        'title' => 'Text/HTML 4',
                        'has_settings' => true,
                    ),

                    'text5' => array(
                        'title' => 'Text/HTML 5',
                        'has_settings' => true,
                    ),
                    'text6' => array(
                        'title' => 'Text/HTML 6',
                        'has_settings' => true,
                    ),
                    'delimiter1' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter2' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter3' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter4' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter5' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter6' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'empty_space1' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space2' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space3' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space4' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space5' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                ),
            ),


            'top_left__tablet'      => array(
                'title'        => 'Top Left',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'top_center__tablet'    => array(
                'title'        => 'Top Center',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'top_right__tablet'     => array(
                'title'        => 'Top Right',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'middle_left__tablet'   => array(
                'title'        => 'Middle Left',
                'has_settings' => true,
                'layout'       => 'one-thirds clear-item',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'middle_center__tablet' => array(
                'title'        => 'Middle Center',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'middle_right__tablet'  => array(
                'title'        => 'Middle Right',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'bottom_left__tablet'   => array(
                'title'        => 'Bottom Left',
                'has_settings' => true,
                'layout'       => 'one-thirds clear-item',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'bottom_center__tablet' => array(
                'title'        => 'Bottom Center',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),
            'bottom_right__tablet'  => array(
                'title'        => 'Bottom Right',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'tablet',
                'content'      => array(),
            ),

            /// mobile
            'all_item__mobile' => array(
                'title' => 'All Item',
                'layout' => 'all',
                'extra_class' => 'mobile',
                'content' => array(
                    'logo' => array(
                        'title'        => 'Logo',
                        'has_settings' => true,
                    ),
                    'menu' => array(
                        'title'        => 'Menu',
                        'has_settings' => true,
                    ),
                    'search' => array(
                        'title' => 'Search',
                        'has_settings' => false,
                    ),
                    'login' => array(
	                    'title' => 'Login',
	                    'has_settings' => false,
                    ),
                    'cart' => array(
	                    'title' => 'Cart',
	                    'has_settings' => false,
                    ),
                    'burger_sidebar' => array(
                        'title' => 'Burger Sidebar',
                        'has_settings' => true,
                    ),
                    'text1' => array(
                        'title' => 'Text/HTML 1',
                        'has_settings' => true,
                    ),
                    'text2' => array(
                        'title' => 'Text/HTML 2',
                        'has_settings' => true,
                    ),

                    'text3' => array(
                        'title' => 'Text/HTML 3',
                        'has_settings' => true,
                    ),
                    'text4' => array(
                        'title' => 'Text/HTML 4',
                        'has_settings' => true,
                    ),

                    'text5' => array(
                        'title' => 'Text/HTML 5',
                        'has_settings' => true,
                    ),
                    'text6' => array(
                        'title' => 'Text/HTML 6',
                        'has_settings' => true,
                    ),
                    'delimiter1' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter2' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter3' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter4' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter5' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'delimiter6' => array(
                        'title' => '|',
                        'has_settings' => true,
                    ),
                    'empty_space1' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space2' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space3' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space4' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                    'empty_space5' => array(
                        'title' => '&#8592;&#8594;',
                        'has_settings' => false,
                    ),
                ),
            ),
            'top_left__mobile'      => array(
                'title'        => 'Top Left',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'top_center__mobile'    => array(
                'title'        => 'Top Center',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'top_right__mobile'     => array(
                'title'        => 'Top Right',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'middle_left__mobile'   => array(
                'title'        => 'Middle Left',
                'has_settings' => true,
                'layout'       => 'one-thirds clear-item',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'middle_center__mobile' => array(
                'title'        => 'Middle Center',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'middle_right__mobile'  => array(
                'title'        => 'Middle Right',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'bottom_left__mobile'   => array(
                'title'        => 'Bottom Left',
                'has_settings' => true,
                'layout'       => 'one-thirds clear-item',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'bottom_center__mobile' => array(
                'title'        => 'Bottom Center',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
            'bottom_right__mobile'  => array(
                'title'        => 'Bottom Right',
                'has_settings' => true,
                'layout'       => 'one-thirds',
                'extra_class' => 'mobile',
                'content'      => array(),
            ),
        ),
        'default'    => $def_header_option,
    ),

    //HEADER TEMPLATES
    // MAIN HEADER SETTINGS
    array(
        'id'       => 'header_templates-start',
        'type'     => 'gt3_section',
        'title'    => esc_html__( 'Header Templates', 'surfy' ),
        'indent'   => false,
        'section_role' => 'start'
    ),

    //HEADER TEMPLATES
    array(
        'id'         => 'gt3_header_builder_presets',
        'type'       => 'gt3_presets',
        'presets'    => true,
        'full_width' => true,
        'title'      => esc_html__('Gt3 Preset', 'surfy'),
        'subtitle'   => esc_html__('This allows you to set default header layout.', 'surfy'),
        'default'    => array(
            '0' => array(
                'title'     => esc_html__('Default', 'surfy'),
                'preset' => json_encode($def_header_option)
            ),
        ),
        'templates' => array(
            '1' => array(
                'alt'     => 'Header 1',
                'img'     => esc_url(ReduxFramework::$_url) . 'assets/img/header_1.jpg',
                'presets' => $header_preset_1
            ),
            '2' => array(
                'alt'     => 'Header 2',
                'img'     => esc_url(ReduxFramework::$_url) . 'assets/img/header_2.jpg',
                'presets' => $header_preset_2
            ),
        ),
        'options' => array(),
    ),
    array(
        'id'     => 'header_templates-end',
        'type'   => 'gt3_section',
        'indent' => false,
        'section_role' => 'end'
    ),

    // MAIN HEADER SETTINGS
    array(
        'id'       => 'main_header_settings-start',
        'type'     => 'gt3_section',
        'title'    => esc_html__( 'Header Main Settings', 'surfy' ),
        'indent'   => false,
        'section_role' => 'start'
    ),
    array(
        'id'       => 'header_full_width',
        'type'     => 'switch',
        'title'    => esc_html__( 'Full Width Header', 'surfy' ),
        'subtitle' => esc_html__( 'Set header content in full width layout', 'surfy' ),
        'default'  => false,
    ),
    array(
        'id'       => 'header_sticky',
        'type'     => 'switch',
        'title'    => esc_html__( 'Sticky Header', 'surfy' ),
        'default'  => true,
    ),
    array(
        'id'       => 'header_on_bg',
        'type'     => 'switch',
        'title'    => esc_html__( 'Header Above Content', 'surfy' ),
        'default'  => false,
    ),

    array(
        'id'       => 'header_sticky_appearance_style',
        'type'     => 'select',
        'title'    => esc_html__( 'Sticky Appearance Style', 'surfy' ),
        'options'  => array(
            'classic' => esc_html__( 'Classic', 'surfy' ),
            'scroll_top' => esc_html__( 'Appearance only on scroll top', 'surfy' ),
        ),
        'required' => array( 'header_sticky', '=', '1' ),
        'default'  => 'classic'
    ),
    array(
        'id'       => 'header_sticky_appearance_from_top',
        'type'     => 'select',
        'title'    => esc_html__( 'Sticky Header Appearance From Top of Page', 'surfy' ),
        'options'  => array(
            'auto' => esc_html__( 'Auto', 'surfy' ),
            'custom' => esc_html__( 'Custom', 'surfy' ),
        ),
        'required' => array( 'header_sticky', '=', '1' ),
        'default'  => 'auto'
    ),
    array(
        'id'             => 'header_sticky_appearance_number',
        'type'           => 'dimensions',
        'units'          => false,
        'units_extended' => false,
        'title'          => __( 'Set the distance from the top of the page', 'surfy' ),
        'height'         => true,
        'width'          => false,
        'default'        => array(
            'height' => 300,
        ),
        'required' => array( 'header_sticky_appearance_from_top', '=', 'custom' ),
    ),
    array(
        'id'       => 'header_sticky_shadow',
        'type'     => 'switch',
        'title'    => esc_html__( 'Sticky Header Bottom Shadow', 'surfy' ),
        'default'  => true,
        'required' => array( 'header_sticky', '=', '1' ),
    ),
    array(
        'id'     => 'main_header_settings-end',
        'type'   => 'gt3_section',
        'indent' => false,
        'section_role' => 'end'
    ),


    //LOGO SETTINGS
    array(
        'id'       => 'logo-start',
        'type'     => 'gt3_section',
        'title'    => __( 'Logo Settings', 'surfy' ),
        'indent'   => false,
        'section_role' => 'start'
    ),
    array(
        'id'       => 'header_logo',
        'type'     => 'media',
        'title'    => __( 'Header Logo', 'surfy' ),
    ),
    array(
        'id'       => 'logo_height_custom',
        'type'     => 'switch',
        'title'    => esc_html__( 'Enable Logo Height', 'surfy' ),
        'default'  => false,
    ),
    array(
        'id'             => 'logo_height',
        'type'           => 'dimensions',
        'units'          => false,
        'units_extended' => false,
        'title'          => __( 'Set Logo Height' , 'surfy' ),
        'height'         => true,
        'width'          => false,
        'default'        => array(
            'height' => 100,
        ),
        'required' => array( 'logo_height_custom', '=', '1' ),
    ),
    array(
        'id'       => 'logo_max_height',
        'type'     => 'switch',
        'title'    => esc_html__( 'Don\'t limit maximum height', 'surfy' ),
        'default'  => false,
        'required' => array( 'logo_height_custom', '=', '1' ),
    ),
    array(
        'id'             => 'sticky_logo_height',
        'type'           => 'dimensions',
        'units'          => false,
        'units_extended' => false,
        'title'          => __( 'Set Sticky Logo Height' , 'surfy' ),
        'height'         => true,
        'width'          => false,
        'default'        => array(
            'height' => '',
        ),
        'required' => array(
            array( 'logo_height_custom', '=', '1' ),
            array( 'logo_max_height', '=', '1' ),
        ),
    ),
    array(
        'id'       => 'logo_sticky',
        'type'     => 'media',
        'title'    => __( 'Sticky Logo', 'surfy' ),
    ),
    array(
        'id'       => 'logo_mobile',
        'type'     => 'media',
        'title'    => __( 'Mobile Logo', 'surfy' ),
    ),
    array(
        'id'       => 'logo_limit_on_mobile',
        'type'     => 'switch',
        'title'    => esc_html__( 'Limit Logo on Mobile', 'surfy' ),
        'default'  => false,
    ),
    array(
        'id'             => 'logo_mobile_width',
        'type'           => 'dimensions',
        'units'          => false,
        'units_extended' => false,
        'title'          => __( 'Set Mobile Logo Width' , 'surfy' ),
        'height'         => false,
        'width'          => true,
        'default'        => array(
            'width' => 90,
        ),
        'required' => array( 'logo_limit_on_mobile', '=', '1' ),
    ),
    array(
        'id'     => 'logo-end',
        'type'   => 'gt3_section',
        'indent' => false,
        'section_role' => 'end'
    ),

    // MENU
    array(
        'id'       => 'menu-start',
        'type'     => 'gt3_section',
        'title'    => __( 'Menu Settings', 'surfy' ),
        'indent'   => false,
        'section_role' => 'start'
    ),
    array(
        'id'       => 'menu_select',
        'type'     => 'select',
        'title'    => esc_html__( 'Select Menu', 'surfy' ),
        'options'  => gt3_getMenuList(),
        'default'  => 'left',
    ),
    array(
        'id'       => 'menu_ative_top_line',
        'type'     => 'switch',
        'title'    => esc_html__( 'Enable Active Menu Item Marker', 'surfy' ),
        'default'  => false,
    ),
    array(
        'id'       => 'sub_menu_background',
        'type'     => 'color_rgba',
        'title'    => __( 'Sub Menu Background', 'surfy' ),
        'subtitle' => __( 'Set sub menu background color', 'surfy' ),
        'default'  => array(
            'color' => '#2c2f36',
            'alpha' => '1',
            'rgba'  => 'rgba(44,47,54,1)'
        ),
        'mode'     => 'background',
    ),
    array(
        'id'       => 'sub_menu_color',
        'type'     => 'color',
        'title'    => __( 'Sub Menu Text Color', 'surfy' ),
        'subtitle' => __( 'Set sub menu header text color', 'surfy' ),
        'default'  => '#ffffff',
        'transparent' => false,
    ),
    array(
        'id'     => 'menu-end',
        'type'   => 'gt3_section',
        'indent' => false,
        'section_role' => 'end'
    ),

    // BURGER SIDEBAR
    array(
        'id'       => 'burger_sidebar-start',
        'type'     => 'gt3_section',
        'title'    => __( 'Burger Sidebar Settings', 'surfy' ),
        'indent'   => false,
        'section_role' => 'start'
    ),
    array(
        'id'       => 'burger_sidebar_select',
        'type'     => 'select',
        'title'    => esc_html__( 'Select Sidebar', 'surfy' ),
        'data'     => 'sidebars',
    ),
    array(
        'id'     => 'burger_sidebar-end',
        'type'   => 'gt3_section',
        'indent' => false,
        'section_role' => 'end'
    ),
);

$responsive_sections = array('','__tablet','__mobile');

$sections = array(
    'top_left'      => esc_html__('Top Left Settings', 'surfy'),
    'top_center'    => esc_html__('Top Center Settings', 'surfy'),
    'top_right'     => esc_html__('Top Right Settings', 'surfy'),
    'middle_left'   => esc_html__('Middle Left Settings', 'surfy'),
    'middle_center' => esc_html__('Middle Center Settings', 'surfy'),
    'middle_right'  => esc_html__('Middle Right Settings', 'surfy'),
    'bottom_left'   => esc_html__('Bottom Left Settings', 'surfy'),
    'bottom_center' => esc_html__('Bottom Center Settings', 'surfy'),
    'bottom_right'  => esc_html__('Bottom Right Settings', 'surfy'),
);
// add align options to each section
$aligns = array();
foreach ($responsive_sections as $responsive_section) {
    foreach ($sections as $section => $section_translate) {
        $default = explode("_", $section);
        array_push($aligns,
            array(
                'id'           => $section.$responsive_section.'-start',
                'type'         => 'gt3_section',
                'title'        => $section_translate,
                'indent'       => false,
                'section_role' => 'start'
            ),
            array(
                'id'      => $section.$responsive_section.'-align',
                'type'    => 'select',
                'title'   => esc_html__('Item Align', 'surfy'),
                'options' => array(
                    'left'   => esc_html__('Left', 'surfy'),
                    'center' => esc_html__('Center', 'surfy'),
                    'right'  => esc_html__('Right', 'surfy'),
                ),
                'default' => !empty($default[1]) ? $default[1] : 'left',
            ),
            array(
                'id'           => $section.$responsive_section.'-end',
                'type'         => 'gt3_section',
                'indent'       => false,
                'section_role' => 'end'
            )
        );
    }
}

$side_opt = array();
$sides = array(
    'top'      => esc_html__('Top Header Settings', 'surfy'),
    'middle'   => esc_html__('Middle Header Settings', 'surfy'),
    'bottom'   => esc_html__('Bottom Header Settings', 'surfy'),
);

foreach ($responsive_sections as $responsive_section) {
    foreach ($sides as $side => $section_translate) {
        array_push($side_opt,
            //TOP SIDE
            array(
                'id'           => 'side_'.$side.$responsive_section.'-start',
                'type'         => 'gt3_section',
                'title'        => $section_translate,
                'indent'       => false,
                'section_role' => 'start'
            ),
            array(
                'id'       => 'side_'.$side.$responsive_section.'_background',
                'type'     => 'color_rgba',
                'title'    => esc_html__('Background', 'surfy'),
                'subtitle' => esc_html__('Set background color', 'surfy'),
                'default'  => array(
                    'color' => '#2c2f36',
                    'alpha' => '1',
                    'rgba'  => 'rgba(44,47,54,1)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'          => 'side_'.$side.$responsive_section.'_color',
                'type'        => 'color',
                'title'       => esc_html__('Text Color', 'surfy'),
                'subtitle'    => esc_html__('Set text color', 'surfy'),
                'default'     => '#ffffff',
                'transparent' => false,
            ),
            array(
                'id'          => 'side_'.$side.$responsive_section.'_color_hover',
                'type'        => 'color',
                'title'       => esc_html__('Link Text Color on Hover', 'surfy'),
                'subtitle'    => esc_html__('Set text color', 'surfy'),
                'default'     => '#ffffff',
                'transparent' => false,
            ),
            array(
                'id'             => 'side_'.$side.$responsive_section.'_height',
                'type'           => 'dimensions',
                'units'          => false,
                'units_extended' => false,
                'title'          => esc_html__('Height', 'surfy'),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => 90,
                )
            ),
            array(
                'id'      => 'side_'.$side.$responsive_section.'_border',
                'type'    => 'switch',
                'title'   => esc_html__('Set Bottom Border', 'surfy'),
                'default' => false,
            ),
            array(
                'id'       => 'side_'.$side.$responsive_section.'_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__('Border Color', 'surfy'),
                'subtitle' => esc_html__('Set border color', 'surfy'),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '.15',
                    'rgba'  => 'rgba(255,255,255,0.15)'
                ),
                'mode'     => 'background',
                'required' => array('side_'.$side.$responsive_section.'_border', '=', '1'),
            )
        );

        if (empty($responsive_section)) {
            array_push($side_opt,
                array(
                    'id'       => 'side_'.$side.$responsive_section.'_sticky',
                    'type'     => 'switch',
                    'title'    => esc_html__('Show Section in Sticky Header?', 'surfy'),
                    'default'  => false,
                    'required' => array('header_sticky', '=', '1'),
                ),
                array(
                    'id'       => 'side_'.$side.$responsive_section.'_background_sticky',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__('Sticky Header Background', 'surfy'),
                    'subtitle' => esc_html__('Set background color', 'surfy'),
                    'default'  => array(
                        'color' => '#2c2f36',
                        'alpha' => '1',
                        'rgba'  => 'rgba(44,47,54,1)'
                    ),
                    'mode'     => 'background',
                    'required' => array('side_'.$side.$responsive_section.'_sticky', '=', '1'),
                ),
                array(
                    'id'          => 'side_'.$side.$responsive_section.'_color_sticky',
                    'type'        => 'color',
                    'title'       => esc_html__('Sticky Header Text Color', 'surfy'),
                    'subtitle'    => esc_html__('Set text color', 'surfy'),
                    'default'     => '#27323d',
                    'transparent' => false,
                    'required'    => array('side_'.$side.$responsive_section.'_sticky', '=', '1'),
                ),
                array(
                    'id'          => 'side_'.$side.$responsive_section.'_color_hover_sticky',
                    'type'        => 'color',
                    'title'       => esc_html__('Sticky Header Link Color on Hover', 'surfy'),
                    'subtitle'    => esc_html__('Set text color', 'surfy'),
                    'default'     => '#27323d',
                    'transparent' => false,
                    'required'    => array('side_'.$side.$responsive_section.'_sticky', '=', '1'),
                ),
                array(
                    'id'             => 'side_'.$side.$responsive_section.'_height_sticky',
                    'type'           => 'dimensions',
                    'units'          => false,
                    'units_extended' => false,
                    'title'          => esc_html__('Sticky Header Height', 'surfy'),
                    'height'         => true,
                    'width'          => false,
                    'default'        => array(
                        'height' => 90,
                    ),
                    'required'       => array('side_'.$side.$responsive_section.'_sticky', '=', '1'),
                ),
                array(
                    'id'      => 'side_'.$side.$responsive_section.'_mobile',
                    'type'    => 'switch',
                    'title'   => esc_html__('Show Section in Mobile Header?', 'surfy'),
                    'default' => true,
                )
            );
        }

        array_push($side_opt,
            array(
                'id'           => 'side_'.$side.$responsive_section.'-end',
                'type'         => 'gt3_section',
                'indent'       => false,
                'section_role' => 'end'
            )
        );

    }
}

// text editor
$text_editor_count = 6;
$text_opt = array();
for ($i=1; $i <= $text_editor_count ; $i++) {
    array_push($text_opt,
        array(
            'id'           => 'text'.$i.'-start',
            'type'         => 'gt3_section',
            'title'        => esc_html__('Text / HTML', 'surfy').' '.$i.' '.esc_html__('Settings', 'surfy'),
            'indent'       => false,
            'section_role' => 'start'
        ),
        array(
            'id'      => 'text'.$i.'_editor',
            'type'    => 'editor',
            'title'   => esc_html__('Text Editor', 'surfy'),
            'default' => '',
            'args'    => array(
                'wpautop'       => false,
                'media_buttons' => false,
                'textarea_rows' => 8,
                'teeny'         => false,
                'quicktags'     => true,
            ),
        ),
        array(
            'id'       => 'text'.$i.'_hide_on_desktop',
            'type'     => 'switch',
            'title'    => esc_html__( 'Hide on Desktop', 'surfy' ),
            'default'  => false,
        ),
        array(
            'id'       => 'text'.$i.'_hide_on_tablet',
            'type'     => 'switch',
            'title'    => esc_html__( 'Hide on Tablet', 'surfy' ),
            'default'  => false,
        ),
        array(
            'id'       => 'text'.$i.'_hide_on_mobile',
            'type'     => 'switch',
            'title'    => esc_html__( 'Hide on Mobile', 'surfy' ),
            'default'  => false,
        ),
        array(
            'id'           => 'text'.$i.'-end',
            'type'         => 'gt3_section',
            'indent'       => false,
            'section_role' => 'end'
        )
    );
};

// delimiter
$delimiter_count = 6;
$delimiter_opt = array();
for ($i=1; $i <= $delimiter_count ; $i++) {
    array_push($delimiter_opt,
        // Delimiters
        array(
            'id'           => 'delimiter'.$i.'-start',
            'type'         => 'gt3_section',
            'title'        => esc_html__('Delimiter', 'surfy').$i.' '.esc_html__('Settings', 'surfy'),
            'indent'       => false,
            'section_role' => 'start'
        ),
        array(
            'id'      => 'delimiter'.$i.'_height',
            'type'    => 'dimensions',
            'units'   => array('em', 'px', '%'),
            'title'   => esc_html__('Delimiter Height', 'surfy'),
            'height'  => true,
            'width'   => false,
            'output'  => array('height' => '.gt3_delimiter'.$i.''),
            'default' => array(
                'height' => 1,
                'units'  => 'em',
            )
        ),
        array(
            'id'           => 'delimiter'.$i.'-end',
            'type'         => 'gt3_section',
            'indent'       => false,
            'section_role' => 'end'
        )
    );
};

$options = array_merge($options,$aligns,$text_opt,$delimiter_opt,$side_opt);


    Redux::setSection( $opt_name, array(
        'id'     => 'gt3_header_builder_section',
        'title'  =>  __( 'GT3 Header Builder', 'surfy' ),
        'desc'   => __( 'This is GT3 Header Builder', 'surfy' ),
        'icon'   => 'el el-screen',
        'fields' => $options
    ) );
    // END HEADER


    Redux::setSection( $opt_name, array(
        'title'            => __( 'Page Title', 'surfy' ),
        'id'               => 'page_title',
        'icon'             => 'el-icon-screen',
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'page_title_conditional',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Page Title', 'surfy' ),
                'default'  => true,
            ),
            array(
                'id'       => 'page_title-start',
                'type'     => 'section',
                'title'    => __( 'Page Title Settings', 'surfy' ),
                'indent'   => true,
                'required' => array( 'page_title_conditional', '=', '1' ),
            ),
            array(
                'id'       => 'page_title_breadcrumbs_conditional',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Breadcrumbs', 'surfy' ),
                'default'  => true,
            ),
            array(
                'id'       => 'page_title_vert_align',
                'type'     => 'select',
                'title'    => esc_html__( 'Vertical Align', 'surfy' ),
                'options'  => array(
                    'top' => esc_html__( 'Top', 'surfy' ),
                    'middle' => esc_html__( 'Middle', 'surfy' ),
                    'bottom' => esc_html__( 'Bottom', 'surfy' )
                ),
                'default'  => 'middle'
            ),
            array(
                'id'       => 'page_title_horiz_align',
                'type'     => 'select',
                'title'    => esc_html__( 'Page Title Text Align?', 'surfy' ),
                'options'  => array(
                    'left' =>  esc_html__( 'Left', 'surfy' ),
                    'center' => esc_html__( 'Center', 'surfy' ),
                    'right' => esc_html__( 'Right', 'surfy' )
                ),
                'default'  => 'left'
            ),
            array(
                'id'       => 'page_title_font_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Page Title Font Color', 'surfy' ),
                'default'  => '#ffffff',
                'transparent' => false
            ),
            array(
                'id'       => 'page_title_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Page Title Background Color', 'surfy' ),
                'default'  => '#bfbfbf',
                'transparent' => false
            ),
            array(
                'id'       => 'page_title_bg_image',
                'type'     => 'media',
                'title'    => __( 'Page Title Background Image', 'surfy' ),
            ),
            array(
                'id'       => 'page_title_bg_image',
                'type'     => 'background',
                'background-color' => false,
                'preview_media' => true,
                'preview' => false,
                'title'    => __( 'Page Title Background Image', 'surfy' ),
                'default'  => array(
                    'background-repeat' => 'repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center center',
                    'background-color' => '#1e73be',
                )
            ),
            array(
                'id'       => 'masked_row',
                'type'     => 'switch',
                'title'    => esc_html__( 'Add Mask?', 'surfy' ),
                'default'  => false,
            ),
            array(
                'id'       => 'mask_image',
                'type'     => 'media',
                'title'    => esc_html__( 'Mask Image', 'surfy' ),
                'required' => array( 'masked_row', '=', '1' ),
            ),
            array(
                'id'             => 'page_title_height',
                'type'           => 'dimensions',
                'units'          => false,
                'units_extended' => false,
                'title'          => __( 'Page Title Height', 'surfy' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => 220,
                )
            ),
            array(
                'id'       => 'page_title_bottom_margin',
                'type'     => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'     => 'margin',
                'all'      => false,
                'bottom'   => true,
                'top'   => false,
                'left'   => false,
                'right'   => false,
                'title'    => esc_html__( 'Page Title Bottom Margin', 'surfy' ),
                'default'  => array(
                    'margin-bottom' => '10px',
                    )
            ),
            array(
                'id'     => 'page_title-end',
                'type'   => 'section',
                'indent' => false,
                'required' => array( 'page_title_conditional', '=', '1' ),
            ),

        )
    ) );

    // -> START Footer Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Footer', 'surfy' ),
        'id'               => 'footer-option',
        'customizer_width' => '400px',
        'icon' => 'el-icon-brush',
        'fields'           => array(
            array(
                'id'       => 'footer_full_width',
                'type'     => 'switch',
                'title'    => esc_html__( 'Full Width Footer', 'surfy' ),
                'default'  => false,
            ),
            array(
                'id'       => 'footer_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Background Color', 'surfy' ),
                'default'  => '#1f2937',
                'transparent' => false
            ),
            array(
                'id'       => 'footer_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Text color', 'surfy' ),
                'default'  => '#ffffff',
                'transparent' => false
            ),
            array(
                'id'       => 'footer_heading_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Heading color', 'surfy' ),
                'default'  => '#ffffff',
                'transparent' => false
            ),
            array(
                'id'       => 'footer_bg_image',
                'type'     => 'background',
                'background-color' => false,
                'preview_media' => true,
                'preview' => false,
                'title'    => __( 'Footer Background Image', 'surfy' ),
                'default'  => array(
                    'background-repeat' => 'repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center center',
                    'background-color' => '#1e73be',
                )
            ),
            array(
                'id'       => 'footer_masked_row',
                'type'     => 'switch',
                'title'    => esc_html__( 'Add Mask?', 'surfy' ),
                'default'  => false,
            ),
            array(
                'id'       => 'footer_mask_image',
                'type'     => 'media',
                'title'    => esc_html__( 'Mask Image', 'surfy' ),
                'required' => array( 'footer_masked_row', '=', '1' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Footer Content', 'surfy' ),
        'id'               => 'footer_content',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'footer_switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Footer', 'surfy' ),
                'default'  => true,
            ),
            array(
                'id'       => 'footer-start',
                'type'     => 'section',
                'title'    => __( 'Footer Settings', 'surfy' ),
                'indent'   => true,
                'required' => array( 'footer_switch', '=', '1' ),
            ),
            array(
                'id'       => 'footer_column',
                'type'     => 'select',
                'title'    => esc_html__( 'Footer Column', 'surfy' ),
                'options'  => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4'
                ),
                'default'  => '4'
            ),
            array(
                'id'       => 'footer_column2',
                'type'     => 'select',
                'title'    => esc_html__( 'Footer Column Layout', 'surfy' ),
                'options'  => array(
                    '6-6' => '50% / 50%',
                    '3-9' => '25% / 75%',
                    '9-3' => '25% / 75%',
                    '4-8' => '33% / 66%',
                    '8-3' => '66% / 33%',
                ),
                'default'  => '6-6',
                'required' => array( 'footer_column', '=', '2' ),
            ),
            array(
                'id'       => 'footer_column3',
                'type'     => 'select',
                'title'    => esc_html__( 'Footer Column Layout', 'surfy' ),
                'options'  => array(
                    '4-4-4' => '33% / 33% / 33%',
                    '3-3-6' => '25% / 25% / 50%',
                    '3-6-3' => '25% / 50% / 25%',
                    '6-3-3' => '50% / 25% / 25%',
                ),
                'default'  => '4-4-4',
                'required' => array( 'footer_column', '=', '3' ),
            ),
            array(
                'id'       => 'footer_align',
                'type'     => 'select',
                'title'    => esc_html__( 'Footer Title Text Align', 'surfy' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'surfy' ),
                    'center' => esc_html__( 'Center', 'surfy' ),
                    'right' => esc_html__( 'Right', 'surfy' ),
                ),
                'default'  => 'left'
            ),
            array(
                'id'       => 'footer_spacing',
                'type'     => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'     => 'padding',
                'all'      => false,
                'title'    => esc_html__( 'Footer Padding (px)', 'surfy' ),
                'default'  => array(
                    'padding-top'    => '60px',
                    'padding-right'  => '0px',
                    'padding-bottom' => '60px',
                    'padding-left'   => '0px'
                )
            ),
            array(
                'id'     => 'footer-end',
                'type'   => 'section',
                'indent' => false,
                'required' => array( 'footer_switch', '=', '1' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Copyright', 'surfy' ),
        'id'               => 'copyright',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'copyright_switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Copyright', 'surfy' ),
                'default'  => true,
            ),
            array(
                'id'      => 'copyright_editor',
                'type'    => 'editor',
                'title'   => __( 'Copyright Editor', 'surfy' ),
                'default' => '',
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 2,
                    'teeny'         => false,
                    'quicktags'     => true,
                ),
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_align',
                'type'     => 'select',
                'title'    => esc_html__( 'Copyright Title Text Align', 'surfy' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'surfy' ),
                    'center' => esc_html__( 'Center', 'surfy' ),
                    'right' => esc_html__( 'Right', 'surfy' ),
                ),
                'default'  => 'center',
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_spacing',
                'type'     => 'spacing',
                'mode'     => 'padding',
                'all'      => false,
                'title'    => __( 'Copyright Padding (px)', 'surfy' ),
                'default'  => array(
                    'padding-top'    => '30px',
                    'padding-right'  => '0px',
                    'padding-bottom' => '59px',
                    'padding-left'   => '0px'
                ),
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Copyright Background Color', 'surfy' ),
                'default'  => '#1f2937',
                'transparent' => true,
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Copyright Text Color', 'surfy' ),
                'default'  => '#909aa3',
                'transparent' => false,
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_top_border',
                'type'     => 'switch',
                'title'    => esc_html__( 'Set Copyright Top Border', 'surfy' ),
                'default'  => false,
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_top_border_color',
                'type'     => 'color_rgba',
                'title'    => __( 'Copyright Border Color', 'surfy' ),
                'default'  => array(
                    'color' => '#f0f0f0',
                    'alpha' => '1',
                    'rgba'  => 'rgba(240,240,240,1)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'copyright_top_border', '=', '1' ),
                    array( 'copyright_switch', '=', '1' )
                ),
            ),
        )
    ));

    // -> START Blog Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Blog', 'surfy' ),
        'id'               => 'blog-option',
        'customizer_width' => '400px',
        'icon' => 'el-icon-th-list',
        'fields'           => array(
            array(
                'id'       => 'related_posts',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related Posts', 'surfy' ),
                'default'  => true,
            ),
            array(
                'id'       => 'post_comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Comments', 'surfy' ),
                'default'  => true,
            ),
            array(
                'id'       => 'post_pingbacks',
                'type'     => 'switch',
                'title'    => esc_html__( 'Trackbacks and Pingbacks', 'surfy' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_post_likes',
                'type'     => 'switch',
                'title'    => esc_html__( 'Likes on Posts', 'surfy' ),
                'default'  => false,
            ),
            array(
                'id'       => 'blog_post_share',
                'type'     => 'switch',
                'title'    => esc_html__( 'Share on Posts', 'surfy' ),
                'default'  => false,
            ),
            array(
                'id'       => 'blog_post_listing_content',
                'type'     => 'switch',
                'title'    => esc_html__( 'Cut Off Text in Blog Listing', 'surfy' ),
                'default'  => false,
            ),
        )
    ) );

    // -> START Layout Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Sidebars', 'surfy' ),
        'id'               => 'layout_options',
        'customizer_width' => '400px',
        'icon' => 'el el-website',
        'fields'           => array(
            array(
                'id'       => 'page_sidebar_layout',
                'type'     => 'image_select',
                'title'    => __( 'Page Sidebar Layout', 'surfy' ),
                'options'  => array(
                    'none' => array(
                        'alt' => 'None',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                    ),
                    'left' => array(
                        'alt' => 'Left',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                    ),
                    'right' => array(
                        'alt' => 'Right',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'none'
            ),
            array(
                'id'       => 'page_sidebar_def',
                'type'     => 'select',
                'title'    => esc_html__( 'Page Sidebar', 'surfy' ),
                'data'     => 'sidebars',
                'required' => array( 'page_sidebar_layout', '!=', 'none' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Sidebar Generator', 'surfy' ),
        'id'               => 'sidebars_generator_section',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'=>'sidebars',
                'type' => 'multi_text',
                'validate' => 'no_html',
                'add_text' => esc_html__('Add Sidebar', 'surfy' ),
                'title' => esc_html__('Sidebar Generator', 'surfy' ),
                'default' => array('Main Sidebar','Surfing Lessons','Our Instructors'),
            ),
        )
    ) );


    // -> START Styling Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Color Options', 'surfy' ),
        'id'               => 'color_options',
        'customizer_width' => '400px',
        'icon' => 'el-icon-brush'
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Colors', 'surfy' ),
        'id'               => 'color_options_color',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'        => 'theme-custom-color',
                'type'      => 'color',
                'title'     => esc_html__('Theme Color 1', 'surfy' ),
                'transparent' => false,
                'default'   => '#eb5e6e',
                'validate'  => 'color',
            ),
            array(
                'id'        => 'theme-custom-color2',
                'type'      => 'color',
                'title'     => esc_html__('Theme Color 2', 'surfy' ),
                'transparent' => false,
                'default'   => '#ffffff',
                'validate'  => 'color',
            ),
            array(
                'id'        => 'body-background-color',
                'type'      => 'color',
                'title'     => esc_html__('Body Background Color', 'surfy' ),
                'transparent' => false,
                'default'   => '#ffffff',
                'validate'  => 'color',
                ),
        )
    ));



    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Typography', 'surfy' ),
        'id'               => 'typography_options',
        'customizer_width' => '400px',
        'icon' => 'el-icon-font',
        'fields'           => array(
            array(
                'id'          => 'menu-font',
                'type'        => 'typography',
                'title'       => __( 'Menu Font', 'surfy' ),
                'google' => true,
                'font-style'    => true,
                'color' => false,
                'line-height' => true,
                'font-size' => true,
                'font-backup' => false,
                'text-align' => false,
                'all_styles'  => true,
                'default'     => array(
                    'font-style'  => '400',
                    'font-family' => 'Roboto',
                    'google'      => true,
                    'font-size'   => '16px',
                    'line-height' => '36px'
                ),
            ),

            array(
                'id' => 'main-font',
                'type' => 'typography',
                'title' => esc_html__('Main Font', 'surfy' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => true,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'default' => array(
                    'font-size' => '16px',
                    'line-height' => '30px',
                    'color' => '#737d84',
                    'google' => true,
                    'font-family' => 'Roboto',
                    'font-weight' => '400',
                ),
            ),
            array(
                'id' => 'header-font',
                'type' => 'typography',
                'title' => esc_html__('Headers Font', 'surfy' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => false,
                'line-height' => false,
                'color' => true,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'color' => '#27323d',
                    'google' => true,
                    'font-family' => 'Roboto',
                    'font-weight' => '400',
                ),
            ),
            array(
                'id' => 'h1-font',
                'type' => 'typography',
                'title' => esc_html__('H1', 'surfy' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => true,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-size' => '48px',
                    'line-height' => '58px',
                    'google' => true,
                    'font-family' => 'Roboto',
                    'font-weight' => '700',
                    'letter-spacing' => ''
                ),
            ),
            array(
                'id' => 'h2-font',
                'type' => 'typography',
                'title' => esc_html__('H2', 'surfy' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => true,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-size' => '36px',
                    'line-height' => '46px',
                    'google' => true,
                    'font-family' => 'Roboto',
                    'font-weight' => '700',
                    'letter-spacing' => ''
                ),
            ),
            array(
                'id' => 'h3-font',
                'type' => 'typography',
                'title' => esc_html__('H3', 'surfy' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => true,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-size' => '30px',
                    'line-height' => '40px',
                    'google' => true,
                    'font-family' => 'Roboto',
                    'font-weight' => '700',
                    'letter-spacing' => ''
                ),
            ),
            array(
                'id' => 'h4-font',
                'type' => 'typography',
                'title' => esc_html__('H4', 'surfy' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => true,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-size' => '24px',
                    'line-height' => '34px',
                    'google' => true,
                    'font-family' => 'Roboto',
                    'font-weight' => '700',
                    'letter-spacing' => ''
                ),
            ),
            array(
                'id' => 'h5-font',
                'type' => 'typography',
                'title' => esc_html__('H5', 'surfy' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => true,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-size' => '18px',
                    'line-height' => '36px',
                    'google' => true,
                    'font-family' => 'Roboto',
                    'font-weight' => '700',
                    'letter-spacing' => ''
                ),
            ),
            array(
                'id' => 'h6-font',
                'type' => 'typography',
                'title' => esc_html__('H6', 'surfy' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => true,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-size' => '16px',
                    'line-height' => '26px',
                    'google' => true,
                    'font-family' => 'Roboto',
                    'font-weight' => '700',
                    'letter-spacing' => ''
                ),
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Contact Widget', 'surfy' ),
        'id'               => 'contact_widget_options',
        'customizer_width' => '400px',
        'icon' => 'el el-envelope',
        'fields'           => array(
            array(
                'title'    => __( 'Display on All Pages', 'surfy' ),
                'id'       => 'show_contact_widget',
                'type'     => 'switch',
                'default'  => false,
            ),
            array(
                'id' => 'title_contact_widget',
                'type' => 'text',
                'title' => esc_html__('Label Text', 'surfy' ),
            ),
            array(
                'id'       => 'label_contact_icon',
                'type'     => 'media',
                'title'    => __( 'Label\'s Image', 'surfy' ),
            ),
            array(
                'id'       => 'label_contact_widget_color',
                'type'     => 'color_rgba',
                'title'    => __( 'Label Color', 'surfy' ),
                'subtitle' => __( 'Set label\'s color of Contact Widget', 'surfy' ),
                'default'  => array(
                    'color' => '#2d628f',
                    'alpha' => '1',
                    'rgba'  => 'rgba(45,98,143,1)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id' => 'shortcode_contact_widget',
                'type' => 'text',
                'title' => esc_html__('Contact Form 7 Shortcode', 'surfy' ),
            ),
        )
    ) );

    /*
     * <--- END SECTIONS
     */

if (class_exists('WooCommerce')) {
	// -> START Layout Options
	Redux::setSection($opt_name, array(
		'title'            => esc_html__('Shop', 'surfy'),
		'id'               => 'woocommerce_layout_options',
		'customizer_width' => '400px',
		'icon'             => 'el el-shopping-cart',
		'fields'           => array()
	));
	Redux::setSection($opt_name, array(
		'title'            => esc_html__('Products Page', 'surfy'),
		'id'               => 'products_page_settings',
		'subsection'       => true,
		'customizer_width' => '450px',
		'fields'           => array(
			array(
				'id'       => 'shop_cat_title_conditional',
				'type'     => 'switch',
				'title'    => esc_html__('Show Title for Shop Category', 'surfy'),
				'default'  => true,
				'required' => array('page_title_conditional', '=', '1'),
			),
			array(
				'id'      => 'products_layout',
				'type'    => 'select',
				'title'   => esc_html__('Products Layout', 'surfy'),
				'options' => array(
					'container'  => esc_html__('Container', 'surfy'),
					'full_width' => esc_html__('Full Width', 'surfy'),
				),
				'default' => 'container'
			),
			array(
				'id'      => 'products_sidebar_layout',
				'type'    => 'image_select',
				'title'   => esc_html__('Products Page Sidebar Layout', 'surfy'),
				'options' => array(
					'none'  => array(
						'alt' => 'None',
						'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
					),
					'left'  => array(
						'alt' => 'Left',
						'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
					),
					'right' => array(
						'alt' => 'Right',
						'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
					)
				),
				'default' => 'right'
			),
			array(
				'id'       => 'products_sidebar_def',
				'type'     => 'select',
				'title'    => esc_html__('Products Page Sidebar', 'surfy'),
				'data'     => 'sidebars',
				'required' => array('products_sidebar_layout', '!=', 'none'),
			),
			array(
				'id'    => 'products_sorting_frontend',
				'type'  => 'switch',
				'title' => esc_html__('Show dropdown on the frontend to change Sorting of products displayed per page', 'surfy'),
			),
			array(
				'id'      => 'woocommerce_pagination',
				'type'    => 'select',
				'title'   => esc_html__('Pagination', 'surfy'),
				'desc'    => esc_html__('Select the position of pagination.', 'surfy'),
				'options' => array(
					'top'        => esc_html__('Top', 'surfy'),
					'bottom'     => esc_html__('Bottom', 'surfy'),
					'top_bottom' => esc_html__('Top and Bottom', 'surfy'),
					'off'        => esc_html__('Off', 'surfy'),
				),
				'default' => 'top_bottom',
			),
			array(
				'id'    => 'woocommerce_recently_viewed',
				'type'  => 'switch',
				'title' => esc_html__('Show Recently Viewed Products', 'surfy'),
			),
			array(
				'id'       => 'viewed_products_orderby',
				'type'     => 'switch',
				'title'    => esc_html__('Display Recently Viewed Products randomly', 'surfy'),
				'default'  => false,
				'required' => array('woocommerce_recently_viewed', '=', '1'),
			),
			array(
				'id'     => 'section-label_color-start',
				'type'   => 'section',
				'title'  => esc_html__('"Sale", "Hot" and "New" labels color', 'surfy'),
				'indent' => true,
			),
			array(
				'id'       => 'label_color_sale',
				'type'     => 'color_rgba',
				'title'    => esc_html__('Color for "Sale" label', 'surfy'),
				'subtitle' => esc_html__('Select the Background Color for "Sale" label.', 'surfy'),
				'default'  => array(
					'color' => '#f3dd76',
					'alpha' => '1',
					'rgba'  => 'rgba(243,221,118,1)'
				),
			),
			array(
				'id'       => 'label_color_hot',
				'type'     => 'color_rgba',
				'title'    => esc_html__('Color for "Hot" label', 'surfy'),
				'subtitle' => esc_html__('Select the Background Color for "Hot" label.', 'surfy'),
				'default'  => array(
					'color' => '#e63764',
					'alpha' => '1',
					'rgba'  => 'rgba(230,55,100,1)'
				),
			),
			array(
				'id'       => 'label_color_new',
				'type'     => 'color_rgba',
				'title'    => esc_html__('Color for "New" label', 'surfy'),
				'subtitle' => esc_html__('Select the Background Color for "New" label.', 'surfy'),
				'default'  => array(
					'color' => '#5dbafc',
					'alpha' => '1',
					'rgba'  => 'rgba(93,186,252,1)'
				),
			),
			array(
				'id'     => 'section-label_color-end',
				'type'   => 'section',
				'indent' => false,
			),
		)
	));
	Redux::setSection($opt_name, array(
		'title'            => esc_html__('Single Product Page', 'surfy'),
		'id'               => 'product_page_settings',
		'subsection'       => true,
		'customizer_width' => '450px',
		'fields'           => array(
			array(
				'id'       => 'product_title_conditional',
				'type'     => 'switch',
				'title'    => esc_html__('Show Product Page Title', 'surfy'),
				'default'  => false,
				'required' => array('page_title_conditional', '=', '1'),
			),
			array(
				'id'      => 'product_container',
				'type'    => 'select',
				'title'   => esc_html__('Product Page Layout', 'surfy'),
				'options' => array(
					'container'  => esc_html__('Container', 'surfy'),
					'full_width' => esc_html__('Full Width', 'surfy'),
				),
				'default' => 'container'
			),
			array(
				'id'      => 'product_sidebar_layout',
				'type'    => 'image_select',
				'title'   => esc_html__('Single Product Page Sidebar Layout', 'surfy'),
				'options' => array(
					'none'  => array(
						'alt' => 'None',
						'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
					),
					'left'  => array(
						'alt' => 'Left',
						'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
					),
					'right' => array(
						'alt' => 'Right',
						'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
					)
				),
				'default' => 'none'
			),
			array(
				'id'       => 'product_sidebar_def',
				'type'     => 'select',
				'title'    => esc_html__('Single Product Page Sidebar', 'surfy'),
				'data'     => 'sidebars',
				'required' => array('product_sidebar_layout', '!=', 'none'),
			),
			array(
				'id'      => 'shop_size_guide',
				'type'    => 'switch',
				'title'   => esc_html__('Show Size Guide', 'surfy'),
				'default' => false,
			),
			array(
				'id'       => 'size_guide',
				'type'     => 'media',
				'title'    => esc_html__('Size guide Popup Image', 'surfy'),
				'required' => array('shop_size_guide', '=', true),
			),
			array(
				'id'      => 'next_prev_product',
				'type'    => 'switch',
				'title'   => esc_html__('Show Next and Previous products', 'surfy'),
				'default' => true,
			),
		)
	));
}


$theme_header_woo_ready = get_option('theme_header_woo_ready');
$my_theme               = wp_get_theme();
$version                = $my_theme->get('Version');
if (!$theme_header_woo_ready && version_compare($version, '1.0.3.1', '>=')) {
	$gt3_header_builder_id = gt3_option('gt3_header_builder_id');
	if (is_array($gt3_header_builder_id) && !empty($gt3_header_builder_id['all_item'])) {
		$gt3_header_builder_id['all_item']['content']['login'] = array(
			'title'        => 'Login',
			'has_settings' => false,
		);
		$gt3_header_builder_id['all_item']['content']['cart']  = array(
			'title'        => 'Cart',
			'has_settings' => false,
		);
		Redux::setOption($opt_name, 'gt3_header_builder_id', $gt3_header_builder_id);
		update_option('theme_header_woo_ready', true);
	}
}