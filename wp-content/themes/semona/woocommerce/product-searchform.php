<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<label class="screen-reader-text" for="wc_search_text"><?php _e( 'Search for:', 'semona' ); ?></label>
	<input type="search" class="search-field" id="wc_search_text" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'semona' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'semona' ); ?>" />
	<input type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'semona' ); ?>" />
	<input type="hidden" name="post_type" value="product" />
</form>
