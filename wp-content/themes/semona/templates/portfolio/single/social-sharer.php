			<div class='social-links'>
				<span>Share: </span>
				<?php
				$sharer_urls = sm_social_sharer_urls(); 
				foreach( $sharer_urls as $icon => $url ) {
					$link = sprintf( $url, rawurlencode( get_permalink() ), rawurlencode( get_the_title() ), rawurlencode( get_the_excerpt() ) );
					if( $link ) {
						$icon .= '-square';
						?>
						<a class='sm-sharer-link' href='<?php echo esc_url( $link ) ?>'><i class='fa fa-<?php echo esc_attr( $icon ) ?>'></i></a>
						<?php
					}
				}
				?>
			</div>