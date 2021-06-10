<?php

class posts extends WP_Widget
{

    function __construct() {
        parent::__construct( false, esc_html__('Posts (current theme)', 'surfy'));
    }

    function widget($args, $instance)
    {
        $after_widget = $before_widget = $before_title = $after_title = '';

        extract($args);

        echo  $before_widget;
        echo  $before_title;
        echo esc_attr($instance['widget_title']);
        echo  $after_title;

        $postsArgs = array(
            'showposts' => $instance['posts_widget_number'],
            'offset' => 0,
            'orderby' => 'date',
            'order' => 'DESC',
            'post_type' => 'post',
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1
        );

        $compilepopular = '';

        $gt3_wp_query_posts = new WP_Query();
        $gt3_wp_query_posts->query($postsArgs);
        while ($gt3_wp_query_posts->have_posts()) : $gt3_wp_query_posts->the_post();
            $gt3_theme_featured_image_latest = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()));

            $compilepopular .= '
            <li ' . ((!empty($gt3_theme_featured_image_latest)) ? 'class="with_img"' : '') . '>';
            if (empty($gt3_theme_featured_image_latest)) {
                $widg_img = '';
            } else {
                $widg_img = '<a href="' . esc_url(get_permalink()) . '"><img src="' . esc_url(aq_resize($gt3_theme_featured_image_latest[0], "170", "170", true, true, true)) . '" alt="' . esc_attr(get_the_title()) . '"></a>';
            }

            if (has_excerpt()) {
                $post_excerpt = get_the_excerpt();
            } else {
                $post_excerpt = get_the_content();
            }

            $post_excerpt = preg_replace( '~\[[^\]]+\]~', '', $post_excerpt);
            $post_excerpt_without_tags = strip_tags($post_excerpt);
            $post_descr = gt3_smarty_modifier_truncate($post_excerpt_without_tags, 50, "...");

            $compilepopular .= '
                <div class="recent_posts_content">
                    ' . $widg_img . '
                    <div class="listing_meta">
                        <span>' . esc_html__('by', 'surfy') . ' <a class="text_capitalize" href="' . esc_url(get_author_posts_url( get_the_author_meta('ID'))) . '">' . esc_html(get_the_author_meta('display_name')) . '</a></span>
                        <span>' . esc_html(get_the_time(get_option( 'date_format' ))) . '</span>
                    </div>
                    <div class="post_title"><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></div>
                    <div class="recent_post__cont">'.esc_html($post_descr).'</div>
                </div>
            </li>
        ';

        endwhile;
        wp_reset_postdata();

        echo '
            <ul class="recent_posts">
                ' . $compilepopular . '
            </ul>
        ';
        
        #END OUTPUT

        echo  $after_widget;
    }


    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['widget_title'] = esc_attr($new_instance['widget_title']);
        $instance['posts_widget_number'] = absint($new_instance['posts_widget_number']);

        return $instance;
    }

    function form($instance)
    {
        $defaultValues = array(
            'widget_title' => esc_html__( 'Recent Posts', 'surfy' ),
            'posts_widget_number' => '3'
        );
        $instance = wp_parse_args((array)$instance, $defaultValues);
        ?>
        <table class="fullwidth">
            <tr>
                <td><?php echo esc_html__( 'Title:', 'surfy' ); ?></td>
                <td><input type='text' class="fullwidth" name='<?php echo esc_attr($this->get_field_name('widget_title')); ?>'
                           value='<?php echo esc_attr($instance['widget_title']); ?>'/></td>
            </tr>
            <tr>
                <td><?php echo esc_html__( 'Number:', 'surfy' ); ?></td>
                <td><input type='text' class="fullwidth"
                           name='<?php echo esc_attr($this->get_field_name('posts_widget_number')); ?>'
                           value='<?php echo esc_attr($instance['posts_widget_number']); ?>'/></td>
            </tr>
        </table>
    <?php
    }
}

function posts_register_widgets()
{
    register_widget('posts');
}

add_action('widgets_init', 'posts_register_widgets');

?>