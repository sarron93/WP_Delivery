<?php

$titlebar_style = sm_get_titlebar_style();

if( $titlebar_style != 'none' ) {
	get_template_part( 'templates/titlebar/' . $titlebar_style );
}