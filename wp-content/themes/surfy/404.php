<?php get_header();
	$image_404 = gt3_option('404_image');
	$image_id = '';
	
	if (!empty($image_404) && is_array($image_404) && !empty($image_404['id'])) {
		$image_id = $image_404['id'];
	}
?>
	<div class="wrapper_404 height_100percent">
		<div class="container_vertical_wrapper">
			<div class="container a-center">
				<?php
					if (!empty($image_id)) {
					 	echo '<h1 class="number_404 with_image">';
					 	echo wp_get_attachment_image($image_id,'full');
					 	echo '</h1>';
					}else{
						echo '<h1 class="number_404">' . esc_html__('404', 'surfy') . '</h1>';
					}
				?>
				<h1 class="number_404__subtitle"><?php echo esc_html__('Nothing Was Found!', 'surfy'); ?></h1>
				<p class="number_404__text-info"><?php echo esc_html__('Either Something Get Wrong or the Page Doesn\'t Exist Anymore.', 'surfy'); ?></p>
				<div class="number_404__search">
					<?php get_search_form(); ?>
				</div>
				<div class="number_404__btn gt3_module_button  button_alignment_inline">
					<a class="button_size_normal text-uppercase rounded_r3" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Take me home', 'surfy'); ?></a>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>