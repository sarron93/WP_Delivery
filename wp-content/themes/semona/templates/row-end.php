<?php
global $crf_current_sidebar; 
if( $crf_current_sidebar ): ?>
		</div>
			<aside class='col-sidebar col-sm-3'>
				<?php
				if( is_active_sidebar( $crf_current_sidebar ) ) {
					dynamic_sidebar( $crf_current_sidebar );
				}
				?>
			</aside>
		</div>
<?php endif; ?>