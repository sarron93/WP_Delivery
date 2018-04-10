<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

?>
<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

	<div id="comment-<?php comment_ID(); ?>" class="comment_container">

		<?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '100' ), '' ); ?>

		<div class="comment-text">

			<?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>

				<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf( esc_html__( 'Rated %d out of 5', 'semona' ), $rating ) ?>">
					<span style="width:<?php echo ( $rating / 5 ) * 100; ?>%"><strong itemprop="ratingValue"><?php echo ( $rating ); ?></strong> <?php _e( 'out of 5', 'semona' ); ?></span>
				</div>

			<?php endif; ?>

			<?php if ( $comment->comment_approved == '0' ) : ?>

				<p class="meta"><em><?php _e( 'Your comment is awaiting approval', 'semona' ); ?></em></p>

			<?php else : ?>

				<div class="meta">
					<h5 class='author-name' itemprop="author"><?php comment_author(); ?></h5><?php

						if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' ) :
							if ( wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID ) ) : ?>
								<em class="verified">( <?php echo esc_html__( 'verified owner', 'semona' ); ?> )</em>
							<?php 
							endif;
						endif;

					?>
					<time itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( esc_html( get_option( 'date_format' ) ) ); ?></time>
				</div>

			<?php endif; ?>

			<div itemprop="description" class="description"><?php comment_text(); ?></div>
		</div>
	</div>
