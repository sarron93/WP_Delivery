<?php
$portfolio_image = wp_get_attachment_url( get_post_thumbnail_id() );
?>
<article id='post-<?php the_ID(); ?>' <?php echo post_class( 'sm-portfolio v4 sm-isotope-item' ) ?>>
	<div class='featured-media fullwidth' style="background-image: url('<?php echo esc_url( $portfolio_image ) ?>')">
		<?php
		if( has_post_thumbnail() ) {
			the_post_thumbnail( 'full', array( 'class' => 'hidden' ) );
		}
		?>
		<div class='hover-area'>
			<div class='info'>
				<a href='<?php echo esc_url( get_permalink() ) ?>'><h5 class='title'><?php echo esc_html( get_the_title() ) ?></h5></a>
				<div class='categories'>
					<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ) ?>
				</div>
			</div>
			<div class='links'><?php
				?><a class='link zoom sm-icon-sonar-animation' href='<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ) ?>' title='<?php echo esc_attr( get_the_title() ) ?>' data-rel='prettyPhoto[portfolio]'>
					<i class='fa fa-search-plus'></i>
				</a><?php
				?><a class='link view sm-icon-sonar-animation' href='<?php echo esc_url( get_permalink() ) ?>'>
					<i class='fa fa-chain'></i>
				</a><?php
			?></div>
		</div>
	</div>
</article>