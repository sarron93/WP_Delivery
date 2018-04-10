<ul class="crf_metabox_tabs">
	<li class="active"><a href="#page"><?php echo esc_html__( "Page", 'semona' ) ?></a></li>
	<?php sm_metabox_common_options_li() ?>
</ul>
<div class="crf_metabox" id="crf_metabox">
	<div class="crf_metabox_tab active" id="crf_tab_page">
		<?php
		$this->select ( 'page_enable_comment', __ ( 'Enable Comments', 'semona' ), array (
				'default' => __ ( 'Default', 'semona' ),
				'yes' => __ ( 'Yes', 'semona' ),
				'no' => __ ( 'No', 'semona' ),
		), __ ( 'Choose Yes to enable comments in this page.', 'semona' ) );
		?>
		<?php
		$this->select ( 'page_use_onepage_menu', __ ( 'Use Onepage Menu Navigation', 'semona' ), array (
				'no' => __ ( 'No', 'semona' ),
				'yes' => __ ( 'Yes', 'semona' ),
		), __ ( 'Choose Yes to enable onepage menu navigation.', 'semona' ) );
		?>
	</div>
	<?php sm_metabox_common_options_body( $this ) ?>
</div>
<div class="clear"></div>