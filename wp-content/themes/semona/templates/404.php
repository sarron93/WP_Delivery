<?php 

$error404_bg = crf_get_theme_mod_value( 'error404-bg-image' );
$error404_bg_repeat = crf_get_theme_mod_value( 'error404-bg-repeat' );

?>
<div class='sm-404-content' style='background-image: url("<?php echo esc_url( $error404_bg ) ?>"); background-repeat: <?php echo esc_attr( $$error404_bg_repeat ); ?>'>
	<div class='message'>
		<?php echo esc_html__( 'It looks like that page doesn\'t exist.', 'semona' ) ?><br>
		<?php echo esc_html__( 'Maybe, it\'s been removed!', 'semona' ) ?>
	</div>
	<a class='home-link' href='<?php echo esc_url( home_url() ) ?>'><?php echo esc_html__( 'Back Home', 'semona' ) ?></a>
</div>
<div class='sm-404-searchbox'>
	<form action="<?php echo esc_url( home_url() ) ?>" method="post">
	<div class='searchbox-wrapper'>
		<div class='search-field-wrapper'>
			<input type='text' name='s' placeholder='<?php echo esc_html__( 'Type a keyword and search again...', 'semona' ) ?>'>
		</div>
		<button class='search-button'>
			<i class='fa fa-search'></i>
		</button>
	</div>
	</form>
</div>