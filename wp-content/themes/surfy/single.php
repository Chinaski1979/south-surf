<?php 
if ( !post_password_required() ) {
	get_header();
	the_post();

	$layout = gt3_option('page_sidebar_layout');
	$sidebar = gt3_option('page_sidebar_def');
	if (class_exists( 'RWMB_Loader' )) {
		$mb_layout = rwmb_meta('mb_page_sidebar_layout');
		if (!empty($mb_layout) && $mb_layout != 'default') {
			$layout = $mb_layout;
			$sidebar = rwmb_meta('mb_page_sidebar_def');
		}
	}
	$column = 12;
	if ( $layout == 'left' || $layout == 'right' ) {
		$column = 9;
	}else{
		$sidebar = '';
	}
	$row_class = ' sidebar_'.$layout;

	$show_likes = gt3_option('blog_post_likes');
	$show_share = gt3_option('blog_post_share');

	$all_likes = gt3pb_get_option("likes");

	$comments_num = '' . get_comments_number(get_the_ID()) . '';

	if ($comments_num == 1) {
		$comments_text = '' . esc_html__('comment', 'surfy') . '';
	} else {
		$comments_text = '' . esc_html__('comments', 'surfy') . '';
	}

	$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');

	$pf = get_post_format();
	if (empty($pf)) $pf = "standard";

	$width = '1170';
	$height = '725';

	if (get_the_category()) $categories = get_the_category();
	if (!empty($categories)) {
		$post_categ = '';
		$post_category_compile = '<span>';
		foreach ($categories as $category) {
			$post_categ = $post_categ . '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->cat_name) . '</a>' . ', ';
		}
		$post_category_compile .= ' ' . trim($post_categ, ', ') . '</span>';
	}else{
		$post_category_compile = '';
	}

	$pf_media = gt3_get_pf_type_output($pf, $width, $height, $featured_image, $post_category_compile);
	$pf = $pf_media['pf'];

	$post_title = get_the_title();

?>

<div class="container">
        <div class="row<?php echo esc_attr($row_class); ?>">
            <div class="content-container span<?php echo (int)esc_attr($column); ?>">
                <section id='main_content'>
					<div class="blog_post_preview format-<?php echo esc_attr($pf); ?>">
						<div <?php post_class("single_meta"); ?>>
							<div class="item_wrapper">
								<div class="blog_content">
									<?php
										if ($pf == 'quote' || $pf == 'audio' || $pf == 'link') {
										} else {
											echo (($pf_media['content']));
										}
									?>
									<div class="listing_meta">
										<span><?php echo esc_html__("by", "surfy"); ?> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo esc_html(get_the_author_meta('display_name')); ?></a></span>
										<span><?php echo esc_html(get_the_time(get_option( 'date_format' ))); ?></span>
										<span><a href="<?php echo esc_url(get_comments_link()); ?>"><?php echo esc_html(get_comments_number(get_the_ID())); ?> <?php echo esc_html($comments_text); ?></a></span>
									</div>
									<?php
									if ($pf != 'quote' && $pf != 'link') {
										$pf_icon = '';
										if ( is_sticky() ) {
											$pf_icon = '<i class="fa fa-thumb-tack"></i>';
										}
										$page_title_conditional = ((gt3_option('page_title_conditional') == '1' || gt3_option('page_title_conditional') == true)) ? 'yes' : 'no' ;
										if (class_exists( 'RWMB_Loader' ) && get_the_ID() !== 0) {
								            $page_sub_title = rwmb_meta('mb_page_sub_title');
								            $mb_page_title_conditional = rwmb_meta('mb_page_title_conditional');
								            if ($mb_page_title_conditional == 'yes') {
								                $page_title_conditional = 'yes';
								            }elseif($mb_page_title_conditional == 'no'){
								                $page_title_conditional = 'no';
								            }
								        }
								        if ($page_title_conditional != 'yes') {
								        	echo '<h3 class="blogpost_title">' . $pf_icon . esc_html($post_title) . '</h3>';
								        }
										
									}
									?>
									<?php
										if ($pf == 'quote' || $pf == 'audio' || $pf == 'link') {
											echo (($pf_media['content']));
										}

										the_content();
										wp_link_pages(array('before' => '<div class="page-link"><span class="pagger_info_text">' . esc_html__('Pages', 'surfy') . ': </span>', 'after' => '</div>'));
									?>
									<div class="dn"><?php posts_nav_link(); ?></div>
									<div class="clear post_clear"></div>
									<div class="fleft">
										<div class="tagcloud">
											<?php the_tags("", ' ', ''); ?>
										</div>
									</div>
									<div class="post_info">
										<?php if ($show_share == "1") {	?>
											<!-- post share block -->
											<div class="post_share">
												<a href="<?php echo esc_js("javascript:void(0)"); ?>"><?php echo esc_html__("Share", "surfy"); ?></a>
												<div class="share_wrap">
													<ul>
														<li><a target="_blank" href="<?php echo esc_url('https://www.linkedin.com/shareArticle?mini=true&url='.get_permalink().'&title='.get_the_title().'&source='.get_bloginfo("name")) ?>"><span class="fa fa-linkedin"></span></a></li>
														<li><a target="_blank" href="<?php echo esc_url('https://twitter.com/intent/tweet?text='. get_the_title() .'&amp;url='. get_permalink()); ?>"><span class="fa fa-twitter"></span></a></li>
														<li><a target="_blank" href="<?php echo  esc_url('https://www.facebook.com/share.php?u='. get_permalink()); ?>"><span class="fa fa-facebook"></span></a></li>
													<?php
														if (strlen($featured_image[0]) > 0) {
															echo '<li><a target="_blank" href="'. esc_url('https://pinterest.com/pin/create/button/?url='. get_permalink() .'&media='. $featured_image[0]) .'"><span class="fa fa-pinterest"></span></a></li>';
														}
													?>
													</ul>
												</div>
											</div>
											<!-- //post share block -->
										<?php
										}
										if ($show_likes == "1") {
											echo "<div class='likes_block post_likes_add ". (isset($_COOKIE["like_post".get_the_ID()]) ? 'already_liked' : '') ."' data-postid='". esc_attr(get_the_ID())."' data-modify='like_post'>
												<span class='fa fa-heart icon'></span>
												<span class='like_count'>".((isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()]>0) ? esc_html($all_likes[get_the_ID()]) : 0)."</span>
											</div>";
										} ?>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>
					</div>
					<!-- prev next links -->
					<div class="prev_next_links">
						<?php
						$prev_post = get_adjacent_post(false, '', true);
						$next_post = get_adjacent_post(false, '', false);
						if($prev_post){
							$post_url = get_permalink($prev_post->ID);
							echo '<div class="fleft"><a href="' . esc_url($post_url) . '" title="' . esc_attr($prev_post->post_title) . '"><b>' . esc_html($prev_post->post_title) . '</b><span><i></i>' . esc_html__('Prev', 'surfy') . '</span></a></div>';
						}
						if($next_post) {
							$post_url = get_permalink($next_post->ID);
							echo '<div class="fright"><a href="' . esc_url($post_url) . '" title="' . esc_attr($next_post->post_title) . '"><b>' . esc_html($next_post->post_title) . '</b><span>' . esc_html__('Next', 'surfy') . '<i></i></span></a></div>';
						}
						?>
						<div class="clear"></div>
					</div>
					<!-- //prev next links -->
					<?php
						// Related Posts
						$show_post_featured = gt3_option("related_posts");
						if ($show_post_featured == "1" && class_exists('Vc_Manager')) {
							// Get Cats_ID
							if (get_the_category()) $categories = get_the_category();
							if ($categories) {
								$post_categ = '';
								$post_category_compile = '';
								foreach ($categories as $category) {
									$post_categ = $post_categ . $category->cat_ID . ',';
								}
								$post_category_compile .= '' . trim($post_categ, ',') . '';
							}
							echo '<div class="gt3_module_title"><h3>' . esc_html__('Related Posts', 'surfy') . '</h3></div>';
							echo do_shortcode('[gt3_featured_posts
							meta_categories=""
							view_type="type3"
							pf_post_icon="yes"
							post_read_more_link="yes"
							boxed_text_content="yes"
							image_proportions="4_3"
							items_per_line="'.(($layout == "none") ? "3" : "2").'"
							content_letter_count="230"
							build_query="size:'.(($layout == "none") ? "3" : "2").'|order_by:rand|categories:'.$post_category_compile.'"]');
						}
					?>
					<?php if (gt3_option('post_comments') == "1") {?>
						<div class="row">
							<div class="span12">
								<?php comments_template(); ?>
							</div>
						</div>
					<?php } ?>
				</section>
			</div>
			<?php
			if ($layout == 'left' || $layout == 'right') {
				echo '<div class="sidebar-container span'.(12 - (int)esc_attr($column)).'">';
				if (is_active_sidebar( $sidebar )) {
					echo "<aside class='sidebar'>";
					dynamic_sidebar( $sidebar );
					echo "</aside>";
				}
				echo "</div>";
			}
			?>
		</div>

</div>

<?php
	get_footer();
} else {
	get_header();
?>
	<div class="wrapper_404 height_100percent pp_block">
		<div class="container_vertical_wrapper">
			<div class="container a-center pp_container">
				<h1><?php echo esc_html__('Password Protected', 'surfy'); ?></h1>
				<h2><?php echo esc_html__('This content is password protected. Please enter your password below to continue.', 'surfy'); ?></h2>
				<?php the_content(); ?>
			</div>
		</div>
	</div>
<?php 
	get_footer();
} ?>