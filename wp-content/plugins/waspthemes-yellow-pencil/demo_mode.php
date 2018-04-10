<?php

//Template fallback
add_action("template_redirect", 'yp_theme_redirect');

function yp_theme_redirect(){

    global $wp;

	if(defined("WT_DEMO_MODE") == true && isset($_GET['yellow_pencil']) == true){
		$n = 'yellow-pencil_frame.php';
		$yellow_pencil = dirname( __FILE__ ) . '/' . $n;
		yp_do_theme_redirect($yellow_pencil);
	}
	
}


function yp_do_theme_redirect($url) {

	global $post, $wp_query;
	
	if (have_posts()) {
	
		include($url);
		die();
		
	}else{
	
		$wp_query->is_404 = true;
		
	}
	
}

function get_yp_editor_link(){
	
	if(isset($_GET['page_id'])){
		$id = $_GET['page_id'];
	}elseif(isset($_GET['post']) && is_admin() == true){
		$id = $_GET['post'];
	}else{
		$id = get_queried_object_id();
	}

	if($id === 0 || $id === null || is_tag() || is_category() || is_archive() || is_author() || is_search() || is_404()){
		$href = add_query_arg(array('yellow_pencil' => 'true', 'href' => urlencode(get_home_url().'/')),get_home_url());
	}else{
		$href = add_query_arg(array('yellow_pencil' => 'true','href' => urlencode(get_permalink($id)),'yp_id' =>  $id),get_home_url());
	}

	return $href;

}

function yp_demo_editor_header(){

	echo '<style>
	.yp-demo-link{
		font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
		text-transform: uppercase;
		font-size: 12px;
		position:fixed;
		top:18%;
		left:0px;
		width:auto;
		border:1px solid #FFAE00;
		padding:6px;
		background:#FFDC00;
		color:#222 !important;
		text-decoration: none !important;
		z-index:9999999;
	}
	.yp-demo-link:hover{
		background:#F3D307;
	}
	body.yp-yellow-pencil .theme-demo-options{display:none !important;}@media(max-width:992px){.yp-demo-link{display:none !important;}}</style><a href="'.get_yp_editor_link().'" class="yp-demo-link yp-live-editor-link">Live Editor</a>';

}

add_action("wp_head","yp_demo_editor_header");