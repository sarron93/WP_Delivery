<p><?php echo esc_html__( 'No posts found.', 'semona' ) ?></p>
<p>You might want to consider some of our suggestions to get better results: </p>
<ul>
	<li>Check your spelling.</li>
	<li>Try a similar keyword</li>
	<li>Try using more than one keyword</li>
</ul>
<p></p>
<p>Do you want to try another search?</p>
<form role="search" method="get" class="search-form clearfix" action="<?php echo esc_url( home_url() ) ?>">
	<input type="search" class="search-field" placeholder="<?php echo esc_html__( 'Enter your keyword', 'semona' ) ?>" value="" name="s" title="Search for:">
	<input type="submit" class="search-submit" value="Search">
</form>