<div class='sm-portfolio-featured-media'>
	<?php
	$image_ids = crf_get_post_gallery_ids( get_the_ID() );
	$gallery_images = array();
	$gallery_images_thumb = array();
	foreach( $image_ids as $imgid ) {
		$imgurl = wp_get_attachment_image_src( $imgid, 'full' );
		if( !empty( $imgurl[0] ) ) {
			$gallery_images[] = $imgurl[0];
			$imgthumb = wp_get_attachment_image_src( $imgid );
			$gallery_images_thumb[] = $imgthumb[0];
		}
	}
	if( count( $gallery_images ) > 0 ):
	?>
	<div class="sm-flexslider flexslider" data-smooth-height="true" data-controlnav="thumbnails" data-directionnav="true">
		<ul class="slides">
		<?php
		$i = 0;
		foreach( $gallery_images as $image ) {
			echo "<li data-thumb=" . esc_url( $gallery_images_thumb[$i++] ) . ">";
			echo "<img src='" . esc_url( $image ) . "' alt='" . get_the_title() . " " . esc_html__( 'Image', 'semona' ) . "'>";
			echo "</li>";
		}
		?>
		</ul>
	</div>
	<?php
	endif;
	?>
</div>