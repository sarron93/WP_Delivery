<ul class="crf_metabox_tabs">
	<li class="active"><a href="#post"><?php echo esc_html__( "Portfolio", 'semona' ) ?></a></li>
	<?php sm_metabox_common_options_li() ?>
</ul>
<div class='crf_metabox' id="crf_metabox">
	<div class="crf_metabox_tab active" id="crf_tab_post">
		<?php
		$this->select ( 'portfolio_layout', __ ( 'Portfolio Layout', 'semona' ), array (
				'full' => __ ( 'Full Width Content With Aside Info', 'semona' ),
				'full-noinfo' => __ ( 'Full Width Content Without Aside Info', 'semona' ),
				'half' => __ ( 'Aside Content', 'semona' ),
				'half-noinfo' => __ ( 'Aside Content Without Info', 'semona' ),
		), __ ( 'Select layout of portfolio single page. Note that "Full Width Content Without Aside Info" layout will be best suited for building portfolio content using Visual Composer.', 'semona' ) );
		?>
		<?php
		$this->select ( 'featured_image_masonry_size', __ ( 'Masonry Image Size', 'semona' ), array (
				'x_x' => __ ( 'X * X', 'semona' ),
				'x_dx' => __ ( 'X * 2X', 'semona' ),
				'dx_x' => __ ( '2X * X', 'semona' ),
				'dx_dx' => __ ( '2X * 2X', 'semona' ) 
		), __ ( 'Select featured image size in masonry layout. Note: it\'s always recommended to set featured image for portfolio.', 'semona' ) );
		?>
		<?php
		$this->text ( 'portfolio_featured_image_max_width', __ ( 'Featured Gallery/Image Max Width', 'semona' ), 
				__ ( 'Enter the max width of portfolio image. Leave empty to disable this setting.', 'semona' ) );
		?>
		<?php
		$this->text ( 'portfolio_featured_image_max_height', __ ( 'Featured Gallery/Image Max Height', 'semona' ), 
				__ ( 'Enter the max height of portfolio image. Leave empty to disable this setting.', 'semona' ) );
		?>
		<?php
		$this->select ( 'featured_media_type', __ ( 'Featured Audio/Video Type', 'semona' ), array (
				'embed' => esc_html__( 'Embed Code', 'semona' ),
				'url' => esc_html__( 'Hosted File URL', 'semona' ),
		), esc_html__( 'Choose to show or hide related posts on this post.', 'semona' ) );
		?>
		<?php
		$this->textarea ( 'featured_media_embed', __ ( 'Video / Audio Embed Code', 'semona' ), __ ( 'Copy and paste embed code of your favorite youtube, vimeo or soundcloud media.', 'semona' ) );
		?>
		<?php
		$this->textarea ( 'featured_media_url', __ ( 'Video / Audio Hosted File URL', 'semona' ), __ ( 'Copy and paste full url of audio/video.', 'semona' ) );
		?>
		<?php
		$this->text ( 'portfolio_client', __ ( 'Client', 'semona' ), __ ( 'Enter the name of the client personnel or company. Leave empty to hide.', 'semona' ) );
		?>
		<?php
		$this->text ( 'portfolio_demo', __ ( 'Demo Link', 'semona' ), __ ( 'Enter the demo link of the project. Leave empty to hide.', 'semona' ) );
		?>
		<?php
		$this->select ( 'portfolio_show_related', __ ( 'Show Related Portfolios', 'semona' ), array (
				'default' => __ ( 'Default', 'semona' ),
				'yes' => __ ( 'Yes', 'semona' ),
				'no' => __ ( 'No', 'semona' ) 
		), __ ( 'Choose to display or hide related portfolios.', 'semona' ) );
		?>
		<?php
		$this->select ( 'portfolio_related_style', __ ( 'Related Portfolios Style', 'semona' ), 
				sm_add_option_default( sm_portfolio_related_styles() ), 
				__ ( 'Select style of related portfolios for this portfolio post.', 'semona' ) );
		?>
		<?php
		$this->select ( 'portfolio_show_comments', __ ( 'Show Comments', 'semona' ), array (
				'default' => __ ( 'Default', 'semona' ),
				'yes' => __ ( 'Yes', 'semona' ),
				'no' => __ ( 'No', 'semona' ) 
		), __ ( 'Choose to display or hide comments.', 'semona' ) );
		?>
	</div>
	<?php sm_metabox_common_options_body( $this ) ?>
</div>
<div class="clear"></div>