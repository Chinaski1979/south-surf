<form name="search_form" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search_form">
    <input class="search_text" type="text" name="s" placeholder="<?php esc_attr_e('Search...', 'surfy'); ?>">
    <input class="search_submit" type="submit" value="<?php esc_attr_e('Search', 'surfy'); ?>">
</form>