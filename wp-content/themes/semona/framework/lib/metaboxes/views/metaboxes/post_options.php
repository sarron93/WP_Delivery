<ul class="crf_metabox_tabs">
	<li class="active"><a href="#post"><?php echo esc_html__( "Post", 'semona' ) ?></a></li>
	<?php sm_metabox_common_options_li() ?>
</ul>
<div class='crf_metabox' id="crf_metabox">
	<div class="crf_metabox_tab active" id="crf_tab_post">
		<?php
		$this->select ( 'featured_media_type', __ ( 'Featured Audio/Video Type', 'semona' ), array (
				'embed' => esc_html__( 'Embed Code', 'semona' ),
				'url' => esc_html__( 'Hosted File URL', 'semona' ),
		), esc_html__( 'Choose to show or hide related posts on this post.', 'semona' ) );
		?>
		<?php
		$this->textarea ( 'featured_media_embed', 
				__ ( 'Video / Audio Embed Code', 'semona' ), 
				__ ( 'Copy and paste embed code of your favorite youtube, vimeo or soundcloud media.', 'semona' ),
				'',
				array(
						'option' => 'featured_media_type',
						'value' => 'embed',
				)
		);
		?>
		<?php
		$this->textarea ( 'featured_media_url', 
				__ ( 'Video / Audio Hosted File URL', 'semona' ), 
				__ ( 'Copy and paste full url of audio/video.', 'semona' ),
				'',
				array(
						'option' => 'featured_media_type',
						'value' => 'url',
				)
		);
		?>
		<?php
		$this->select ( 'related_posts', __ ( 'Show Related Posts', 'semona' ), array (
				'default' => esc_html__( 'Default', 'semona' ),
				'yes' => esc_html__( 'Show', 'semona' ),
				'no' => esc_html__( 'Hide', 'semona' ) 
		), esc_html__( 'Choose to show or hide related posts on this post.', 'semona' ) );
		?>
		<?php
		$this->select ( 'show_comments', __ ( 'Show Comments', 'semona' ), array (
				'yes' => __ ( 'Yes', 'semona' ),
				'no' => __ ( 'No', 'semona' ) 
		), __ ( 'Choose to show or hide comments.', 'semona' ) );
		?>
	</div>
	<?php sm_metabox_common_options_body( $this ) ?>
</div>
<div class="clear"></div>