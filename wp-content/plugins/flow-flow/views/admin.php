<?php if ( ! defined( 'WPINC' ) ) die;
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   FlowFlow
 * @author    Looks Awesome <email@looks-awesome.com>
 * @link      http://looks-awesome.com
 * @copyright 2014 Looks Awesome
 */
?>
<div id="fade-overlay" class="loading">
	<i class="flaticon-settings"></i>
</div>
<!-- @TODO: Provide markup for your options page here. -->
<form id="flow_flow_form" method="post" action="<?php echo $context['form-action']; ?>" enctype="multipart/form-data">
	<script>
		var _ajaxurl = '<?php echo $context['admin_url']; ?>';
		var la_plugin_slug_down = '<?php echo $context['slug_down']; ?>';
        var plugin_url = '<?php echo $context['plugin_url'] . '/' . $context['slug'] ; ?>';
		<?php if (isset($context['js-vars'])) echo $context['js-vars'];?>
	</script>
	<?php
		settings_fields('ff_opts');
		if (isset($context['hidden-inputs'])) echo $context['hidden-inputs'];
	?>
	<div class="wrapper">
		<?php
			if (FF_USE_WP) {
                echo '<h2>'. $context['admin_page_title'] . ' v. ' . $context['version'] . ' <a href="http://' . ( strpos($context['admin_page_title'], 'Stack') !== false ? 'stack' : 'flow' )  . '.looks-awesome.com/docs/Getting_Started" target="_blank">Documentation & FAQ</a></h2>';

                echo '<div id="ff-cats">';
                wp_dropdown_categories( );
                echo '</div>';

                echo '<div><select id="ff-roles">';
                wp_dropdown_roles( );
                echo '</select></div>';
            }
		?>
		<ul class="section-tabs">
			<?php
				/** @var LATab $tab*/
				foreach ( $context['tabs'] as $tab ) {
					echo '<li id="'.$tab->id().'"><i class="'.$tab->flaticon().'"></i> <span>'.$tab->title().'</span></li>';
				}
				if (isset($context['buttons-after-tabs'])) echo $context['buttons-after-tabs'];
			?>
		</ul>
		<div class="section-contents">
			<?php
				/** @var LATab $tab*/
				foreach ( $context['tabs'] as $tab ) {
					$tab->includeOnce($context);
				}
			?>
		</div>
	</div>

	<?php if (!FF_USE_WP):?>
		<div id="ff-footer">
			<div class="width-wrapper">
				<div class="ff-table">
					<div class="ff-cell">
						Flow-Flow Social Hub plugin<br>
						<?php if (defined( 'FF_PLUGIN_VER' )) echo 'Version: ' . FF_PLUGIN_VER;?><br>
						Made by <a href="http://looks-awesome.com/">Looks Awesome</a>
					</div>
					<div class="ff-cell">
						<h1>HOT TOPICS</h1>
						<a href="http://flow-php.looks-awesome.com/docs/Getting_Started/First_Steps_After_Installation">How to add stream on page</a><br>
						<a href="http://flow-php.looks-awesome.com/docs/Getting_Started/First_Steps_After_Installation#refresh">How to refresh my streams</a><br>
						<a href="http://flow-php.looks-awesome.com/docs/Social_Networks_Auth/Authenticate_with_Facebook">How to authorize Facebook</a><br>
						<a href="">Frequently asked questions</a>
					</div>
					<div class="ff-cell">
						<h1>CONTACT US</h1>
						<a href="http://codecanyon.net/user/looks_awesome#contact">Support request</a><br>
						<a href="http://looks-awesome.com/">Looks Awesome site</a><br>
						<a href="https://twitter.com/looks_awesooome">Twitter</a><br>
						<a href="https://www.facebook.com/looksawesooome">Facebook</a>
					</div>
				</div>
			</div>
		</div>
	<?php endif?>
</form>
<script>jQuery(document).trigger('html_ready')</script>
