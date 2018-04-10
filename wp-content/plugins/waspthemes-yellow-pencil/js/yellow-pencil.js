;(function($) {
	
    "use strict";

    // Ace Editor Set Up
	var editor = ace.edit("cssData");
	editor.setTheme("ace/theme/twilight");	
	editor.getSession().setUseWrapMode(true);
    editor.getSession().setMode("ace/mode/css");
    editor.$blockScrolling = Infinity;
	
	editor.setOptions({
		fontSize: "17px"
	});


	// Separator
	window.separator = ' ';


	// After main page load, go to loading iframe.
	window.onload = function(){
		setTimeout(function(){
			var s = $("#iframe").attr("data-href");
			$("#iframe").attr("src",s);
		},5);
	}


	// All Yellow Pencil Functions.
	window.yellow_pencil_main = function() {

	// Don't load again.
	if($("body").hasClass("yp-yellow-pencil-loaded")){
		return false;
	}

	// Seting popular variables.
	var iframe = $($('#iframe').contents().get(0));
	var iframeBody = iframe.find("body");
	var body = $(document.body).add(iframeBody);
	var mainDocument = $(document).add(iframe);


	// Lite Version Modal Close
	$(".yp-info-modal-close").click(function(){
		$(this).parent().parent().hide();
		$(".yp-popup-background").hide();
	});


	// Background uploader Popup Close.
	$(".yp-popup-background").click(function(){
		$(this).hide();
		$(".yp-info-modal").hide();
	});


	// Setting Shortcuts.
	mainDocument.on("keydown",function(e){

		// Getting current tag name.
		var tag = e.target.tagName.toLowerCase();

		// Getting Keycode.
		var code = e.keyCode || e.which;

		// Control
		var ctrlKey = 0;
		var tagType = 0;

		// Stop If CTRL Keys hold.
		if((e.ctrlKey === true || e.metaKey === true)){
			ctrlKey = 1;
		}

		// ESC for custom selector.
		if (code == 27 && ctrlKey == 0 && tagType == 0){
			if(!$(".yp-button-target.active").length > 0){
				$("#yp-button-target-input").val("");
				$(".yp-button-target").trigger("click");
				return false;
			}
		}

		// Stop if this target is input or textarea.
		if(tag == 'input' || tag == 'textarea'){
			tagType = 1;
		}

		// Z Key
		if (code == 90 && ctrlKey == 0 && tagType == 0){
			e.preventDefault();
			editor.commands.exec("undo", editor);

			var element = iframe.find(yp_get_current_selector());

			if(element.length > 0){

				if(element.css("position") == "static" && element.hasClass("ready-for-drag") == false){
					element.addClass("ready-for-drag");
				}

				// Update font-weight family
				setTimeout(function(){
					$("#wqselect2-yp-font-weight-results li,#wqselect2-yp-font-weight-container").each(function(){
						$(this).css("font-family",$("#yp-font-family").val());
					});
				},100);

			}

			$("#cssData").trigger("keyup");

			return false;
		}

		// Y Key
		if (code == 89 && ctrlKey == 0 && tagType == 0){
			editor.commands.exec("redo", editor);

			var element = iframe.find(yp_get_current_selector());

			if(element.length > 0){
				if(element.css("position") == "static" && element.hasClass("ready-for-drag") == false){
					element.addClass("ready-for-drag");
				}

				// Update font-weight family
				setTimeout(function(){
					$("#wqselect2-yp-font-weight-results li,#wqselect2-yp-font-weight-container").each(function(){
						$(this).css("font-family",$("#yp-font-family").val());
					});
				},100);

			}

			$("#cssData").trigger("keyup");

			return false;
		}
		
		// ESC
		if (code == 27 && ctrlKey == 0 && tagType == 0){
			
			e.preventDefault();

			if($(".yp-select-open").length == 0 && $(".iris-picker:visible").length == 0){

				if(!$("body").hasClass("css-editor-close-by-editor")){
					if($("#cssEditorBar").css("display") == 'block'){
						if(body.hasClass("yp-fullscreen-editor")){
							body.removeClass("yp-fullscreen-editor");
						}
						$(".css-editor-btn").trigger("click");
						return false;
					}else if($("body").hasClass("yp-contextmenuopen")){
						iframe.trigger("scroll");
						$("body").removeClass("yp-contextmenuopen");
						return false;
					}else if($("body").hasClass("yp-medium-device")){
						$(".yp-button-large-device").trigger("click");
						return false;
					}else if($("body").hasClass("yp-small-device")){
						$(".yp-button-large-device").trigger("click");
						return false;
					}else if($("body").hasClass("yp-content-selected")){
						if(!body.hasClass("yp-dragging")){
							yp_clean();
							yp_resize();
						}
						return false;
					}

				}else{
					$("body").removeClass("css-editor-close-by-editor");
					return false;
				}

			}else{
				body.removeClass("yp-select-open");
			}
			
		}

		// Space key go to selected element
		if(code == 32 && ctrlKey == 0 && tagType == 0){

			e.preventDefault();

			var element = iframe.find(yp_get_current_selector());

			if(iframe.find(".yp-selected-tooltip").hasClass("yp-fixed-tooltip")){
				var height = parseInt($(window).height()/2);
				var selectedHeight = parseInt(element.height()/2);
				if(selectedHeight < height){
					var scrollPosition = selectedHeight+element.offset().top-height;
					iframe.scrollTop(scrollPosition);
				}
			}

			return false;

		}
		
		// R Key
		if (code == 82 && ctrlKey == 0 && tagType == 0){
			e.preventDefault();
			$(".yp-button-reset").trigger("click");
			return false;
		}

		// H Key
		if (code == 72 && ctrlKey == 0 && tagType == 0){
			e.preventDefault();
			$("body").toggleClass("yp-clean-look");
			if($("body").hasClass("yp-css-editor-active")){
				$("body").removeClass("yp-css-editor-active");
				$("#leftAreaEditor").hide();
			}
			yp_resize();
			return false;
		}

		// L Key
		if (code == 76 && ctrlKey == 0 && tagType == 0){
			e.preventDefault();
			iframeBody.toggleClass("yp-hide-borders-now");
			return false;
		}
		
		// S Key
		if (code == 83 && ctrlKey == 0 && tagType == 0){
			e.preventDefault();
			$(".yp-save-btn").removeClass("yp-disabled").trigger("click");
			return false;
		}

		// " Key
		if (code == 162 && ctrlKey == 0 && tagType == 0){
			e.preventDefault();
			$(".yp-button-target").trigger("click");
			return false;
		}

		// " For Chrome Key
		if (code == 192 && ctrlKey == 0 && tagType == 0){
			e.preventDefault();
			$(".yp-button-target").trigger("click");
			return false;
		}
		
		// F Key
		if (code == 70 && ctrlKey == 0 && tagType == 0){
			e.preventDefault();
			toggleFullScreen(document.body);
			return false;
		}

		// C Key
		if (code == 67 && ctrlKey == 0 && tagType == 0){
			e.preventDefault();
			body.toggleClass("yp-metric-disable");
			$(this).tooltip('hide');
			return false;
		}

		// Shift
		if (code == 16 && ctrlKey == 0 && tagType == 0 && $("body").hasClass("process-by-code-editor") == false){
			e.preventDefault();			
			$(".css-editor-btn").trigger("click");
			return false;
		}
		
	});


	// Arrow Keys Up/Down The Value.
	$(".yp-after-css-val").keydown(function(e) {

		var code = e.keyCode || e.which;

		if (code == 38) {
			$(this).val(parseFloat($(this).val()) + parseFloat(1));
		}

		if (code == 40) {
			$(this).val(parseFloat($(this).val()) - parseFloat(1));
		}

	});


	// Arrow Keys Up/Down The Value.
	$(".yp-after-prefix").keydown(function(e) {

		var code = e.keyCode || e.which;

		if (code == 40 || code == 38){

			// em -> % -> px 
			if($(this).val() == 'em'){
				$(this).val("%");
			}else if($(this).val() == '%'){
				$(this).val("px");
			}else if($(this).val() == 'px'){
				$(this).val("em");
			}

		}

	});


	// Close Shortcut for editor.
	editor.commands.addCommand({
		
		name: 'close',
		bindKey: {win: 'ESC', mac: 'ESC'},
		exec: function(editor) {
			
			if(body.hasClass("yp-fullscreen-editor")){
				body.removeClass("yp-fullscreen-editor");
			}

			$(".css-editor-btn").trigger("click");
			$("body").removeClass("process-by-code-editor");
			$("body").addClass("css-editor-close-by-editor");
			
		},
		
		readOnly: false
		
	});


	// Keyup: Custom Slider Value
	$(".yp-after-css").keyup(function(e){

		$(this).attr("data-yp-val",$(this).val());
		
		yp_slide_action($(this).parent().parent().find(".wqNoUi-target"), $(this).parent().parent().find(".wqNoUi-target").attr("id").replace("yp-",""), false);

	});		
		

	// Update on Enter Key.
	$(".yp-after-css-val").keydown(function(e){

		switch ( e.which ) {
			case 13:
			$(this).trigger("blur");
			return false;
			break;
		}
			
	});
	

	// Getting ID.
	function yp_id_hammer(element){
		return $(element).attr("id").replace("-group", "");
	}

	

	/* ---------------------------------------------------- */
    /* YP_SET_SELECTOR										*/
    /*														*/
    /* Creating tooltip, borders. Set as selected element.  */
    /* ---------------------------------------------------- */
	function yp_set_selector(selector){

		yp_clean();

		var element = iframe.find(selector);

		body.attr("data-clickable-select",selector);

		if($.trim(selector.toLowerCase()) != 'body' && $.trim(selector.toLowerCase()) != 'html'){

			element.first().trigger("mouseover").trigger("click");
			if(element.length > 1){
				element.addClass("yp-selected-others");
				iframe.find(".yp-selected").removeClass("yp-selected-others");
			}

		}else{
			iframe.find($.trim(selector.toLowerCase())).addClass("yp-selected");
		}

		body.addClass("yp-content-selected");
		
		body.attr("data-clickable-select",selector);

		yp_insert_default_options();

		yp_resize();

		yp_draw();

	}


   	// Get All Data and set to editor.
    editor.setValue(yp_get_clean_css());
    

	// Tooltip
	$('[data-toggle="tooltip"]').tooltip({container: ".yp-select-bar",html:true});
	$('[data-toggle="popover"]').popover({trigger:'hover',container: ".yp-select-bar"});
	$(".yp-none-btn").tooltip({container: '.yp-select-bar', title: l18_none});
	$(".yp-element-picker").tooltip({placement: 'bottom', container: '.yp-select-bar', title: l18_picker});


	// CSSEngine is javascript based jquery
	// plugin by WaspThemes Team.
	$(document).CallCSSEngine(yp_get_clean_css());


	// Set Class to Body.
	body.addClass("yp-yellow-pencil");
	body.addClass("yp-yellow-pencil-loaded");
		
	// Draggable editor area
	$(".yp-select-bar").draggable({ axis: 'x',containment: "parent",handle:".yp-editor-top" });


	// Yellow Pencil Toggle Advanced Boxes. Used For Parallax, Transform.
	$(".yp-advanced-link").click(function() {

		$(".yp-on").not(this).removeClass("yp-on");

		$(".yp-advanced-option").not($(this).next(".yp-advanced-option")).hide(0);

		$(this).next(".yp-advanced-option").toggle(0);

		$(this).toggleClass("yp-on");
	
		yp_resize();

	});

	// Fullscreen Editor
	$(".yp-css-fullscreen-btn").click(function(){

		// Fullscreen class
		body.toggleClass("yp-fullscreen-editor");

		editor.focus();
		editor.execCommand("gotolineend");
		editor.resize();

	});

	// If There not have any selected item
	// and if mouseover on options, so hide borders.
	$(".top-area-btn-group,.yp-select-bar,.metric").hover(function(){
		if(body.hasClass("yp-content-selected") == false){
			yp_clean();
		}
	});

		
	// Background Assents Set Active Click.
	$(".yp-bg-img-btn").click(function(){
			
		$(this).toggleClass("active");
		$(".yp_background_assets").toggle();

		yp_resize();
			
	});


	// Active Class For undo, redo, CSS Editor buttons.
	$(".top-area-btn:not(.undo-btn):not(.redo-btn):not(.css-editor-btn)").click(function(){
		$(this).toggleClass("active");
	});


	// Fullscreen
	$(".fullscreen-btn").click(function(){
		toggleFullScreen(document.body);
	});

	// Undo
	$(".undo-btn").click(function(){
		editor.commands.exec("undo", editor);
		$("#cssData").trigger("keyup");
	});

	// Redo
	$(".redo-btn").click(function(){
		editor.commands.exec("redo", editor);
		$("#cssData").trigger("keyup");	
	});

		
	// Background Assents Loading On Scrolling.
	$(".yp_background_assets").scroll(function(){
			
		$(".yp_bg_assets").filter(":onScreenQ").each(function(){
				var $d = $(this).data("url");
				$(this).css("background-image","url("+$(this).data("url")+")");
		});
			
	});
		

	// Set Background Assents
	$(".yp-bg-img-btn:not(.yp-first-clicked)").click(function(){

		$(this).addClass("yp-first-clicked");
			
		$(".yp_bg_assets").filter(":onScreenQ").each(function(){
			var $d = $(this).data("url");
			$(this).css("background-image","url("+$(this).data("url")+")");
		});

	});
		
	// Flat color helper toggle
	$(".yp-flat-colors").click(function(){
			
		$(this).toggleClass("active");
		$(this).parent().find(".yp_flat_colors_area").toggle();

		yp_resize();
			
	});

	// Meterial color helper toggle
	$(".yp-meterial-colors").click(function(){
			
		$(this).toggleClass("active");
		$(this).parent().find(".yp_meterial_colors_area").toggle();

		yp_resize();
			
	});
		
	// Nice color helper toggle.
	$(".yp-nice-colors").click(function(){
			
		$(this).parent().find(".yp_nice_colors_area").toggle();
		$(this).toggleClass("active");

		yp_resize();
			
	});

	// Image Uploader
	$(".yp-upload-btn").click(function(){

		$('#image_uploader iframe').attr( 'src', function ( i, val ) { return val; });

		window.send_to_editor = function(output){
				
			var imgurl = output.match(/src="(.*?)"/g);

			imgurl = imgurl.toString().replace('src="','').replace('"','');

			// Always get full size.
			if(imgurl != ''){

				var y = imgurl.split("-").length-1;
				var imgNew = '';

				if(imgurl.split("-")[y].match(/(.*?)x(.*?)\./g) !== null){

					imgNew = imgurl.replace("-"+imgurl.split("-")[y],'');
				
					// format
					if(imgurl.split("-")[y].indexOf(".") != -1){
						imgNew = imgNew + "." + imgurl.split("-")[y].split(".")[1];
					}

			    }else{
			   		imgNew = imgurl;
				}

			}

			$("#yp-background-image").val(imgNew).trigger("keyup");
			    
			window.send_to_editor = window.restore_send_to_editor;

			$("#image_uploader").toggle();
			$("#image_uploader_background").toggle();
				
		}

		$("#image_uploader").toggle();
		$("#image_uploader_background").toggle();

	});


	// Image Uploader close
	$("#image_uploader_background").click(function(){
		$("#image_uploader").toggle();
		$("#image_uploader_background").toggle();
		$('#image_uploader iframe').attr( 'src', function ( i, val ) { return val; });
	});


	// Uploader callback
	window.restore_send_to_editor = window.send_to_editor;

	window.send_to_editor = function(html) {

		var imgurl = $('img',html).attr('src');
		$("#yp-background-image").val(imgurl);
			   
		window.send_to_editor = window.restore_send_to_editor;

		$("#image_uploader").toggle();
		$("#image_uploader_background").toggle();
		$('#image_uploader iframe').attr( 'src', function ( i, val ) { return val; });
	
	}


	// Trigger Options Update.
	yp_option_update();


	// The title
	$("title").html("Yellow Pencil: " + iframe.find("title").html());


	// Check before exit page.
	window.onbeforeunload = confirmExit;

	// exit confirm
	function confirmExit(){

		if ($(".yp-save-btn").hasClass("waiting-for-save")) {
			return l18_sure;
		}

	}


	// Save Button
	$(".yp-save-btn").on("click", function() {


		// If all changes already saved, So Stop.
		if ($(this).hasClass("yp-disabled")) {
			return false;
		}

		// Getting Customized page id.
		var id = window.location.href.split("&yp_id=");

		if (typeof id[1] !== typeof undefined && id[1] !== false) {
			id = id[1].split("&");
			id = id[0];
		}else{
			id = undefined;
		}
			
		// Getting Customized Post Type
		var type = window.location.href.split("&yp_type=");
		if (typeof type[1] !== typeof undefined && type[1] !== false) {
			type = type[1].split("&");
			type = type[0];
		}else{
			type = undefined;
		}

		// Send Ajax If Not Demo Mode.
		if(!$("body").hasClass("yp-yellow-pencil-demo-mode")){

			var data = yp_get_clean_css();

			// Lite Version Checking.
			var status = true;
			
			if($("body").hasClass("wtfv")){

				if(
					data.indexOf("font-family:") != -1 ||
					data.indexOf("text-shadow:") != -1 ||
					data.indexOf("text-transform:") != -1 ||
					data.indexOf("background-color:") != -1 ||
					data.indexOf("background-image:") != -1 ||
					data.indexOf("animation-name:") != -1 ||
					data.indexOf("filter:") != -1 ||
					data.indexOf("opacity:") != -1 ||
					data.indexOf("background-parallax:") != -1 ||
					data.indexOf("	width:") != -1 ||
					data.indexOf("	height:") != -1 ||
					data.indexOf("	color:") != -1){
					status = false;

					$(".wt-save-btn").html(save).removeClass("waiting-for-save").removeClass("wt-disabled");

					$(".yp-info-modal,.yp-popup-background").show();

				}else{

					// BeforeSend
	           		$(".yp-save-btn").html(saving).addClass("yp-disabled");

				}

			}else{

				// BeforeSend
	            $(".yp-save-btn").html(saving).addClass("yp-disabled");

			}

			// Convert CSS To Data and save.
			if(body.hasClass("yp-need-to-process")){

				if(status){
					yp_process(false,id,type);
				}

			}else{

				if(status){

					var posting = $.post(ajaxurl,{

						action: "yp_ajax_save",
							yp_id: id,
							yp_stype: type,
							yp_data: data,
							yp_editor_data: yp_get_styles_area()
						
					});
						
					// Done.
					posting.complete(function(data) {
						$(".yp-save-btn").html(saved).addClass("yp-disabled").removeClass("waiting-for-save");
					});

				}

			}
				
		}else{
				
			alert(demo_alert);
			$(".yp-save-btn").html(saved).addClass("yp-disabled").removeClass("waiting-for-save");
				
		}

	});


	// Hide contextmenu on scroll.
	iframe.scroll(function(){

		if(iframe.find(".context-menu-active").length > 0){
			iframe.find(".yp-selected").contextMenu("hide");
		}
				
		yp_draw();

	});


	// Resize Callback.
	// Draw again borders and tooltip while resize.
	$(window).resize(function() {

		yp_draw();
		yp_resize();

	});
		
		
	// Set As Background Image
	$(".yp_background_assets div").click(function() {
		$(".yp_background_assets div.active").removeClass("active");
		$(this).parent().parent().find(".yp-input").val($(this).data("url")).trigger("keyup");
		$(this).addClass("active");
		$("#background-repeat-group .yp-none-btn:not(.active),#background-size-group .yp-none-btn:not(.active)").trigger("click");
	});
		
		
	// Set Color
	$(".yp_flat_colors_area div,.yp_meterial_colors_area div,.yp_nice_colors_area div").click(function() {

		var element = $(this);
		var elementParent = element.parent();

		elementParent.find(".active").removeClass("active");
		elementParent.parent().parent().parent().find(".wqcolorpicker").val($(this).data("color")).trigger("change");
		$(this).addClass("active");

	});
		

	// Custom Blur Callback
	$(document).click(function(event){

		var evenTarget = $(event.target);

		if(evenTarget.is(".wqcolorpicker")){
			yp_resize();
		}

		if(evenTarget.is(".iris-picker") == false && evenTarget.is(".iris-square-inner") == false && evenTarget.is(".iris-square-handle") == false && evenTarget.is(".iris-slider-offset") == false && evenTarget.is(".iris-slider-offset .ui-slider-handle") == false && evenTarget.is(".iris-picker-inner") == false && evenTarget.is(".wqcolorpicker") == false){
			$(".iris-picker").hide();
			yp_resize();
		}
		
		if(evenTarget.is('.yp_bg_assets') == false && evenTarget.is('.yp-none-btn') == false && evenTarget.is('.yp-bg-img-btn') == false && $(".yp_background_assets:visible").length > 0){
			$(".yp_background_assets").hide();
			$(".yp-bg-img-btn").removeClass("active");
		}
			
		if(evenTarget.is('.yp-flat-c') == false && evenTarget.is('.yp-flat-colors') == false && $(".yp_flat_colors_area:visible").length > 0){
			$(".yp_flat_colors_area").hide();
			$(".yp-flat-colors").removeClass("active");
		}

		if(evenTarget.is('.yp-meterial-c') == false && evenTarget.is('.yp-meterial-colors') == false && $(".yp_meterial_colors_area:visible").length > 0){
			$(".yp_meterial_colors_area").hide();
			$(".yp-meterial-colors").removeClass("active");
		}
			
		if(evenTarget.is('.yp-nice-c') == false && evenTarget.is('.yp-nice-colors') == false && $(".yp_nice_colors_area:visible").length > 0){
			$(".yp_nice_colors_area").hide();
			$(".yp-nice-colors").removeClass("active");
		}
			
	});


	function yp_add_similar_selectors(selector,classes){

		var has = false;

		if(selector == '' || selector == '.' || selector == '#' || selector == ' ' || selector == '  ' || selector == yp_get_current_selector() || selector == $("#yp-button-target-input").val()){
			return false;
		}

		if($("#yp-target-dropdown li").length != 6){

			$("#yp-target-dropdown li").each(function(){
				if($(this).text() == selector){
					has = true;
				}
			});

			if(has == false){

				if(selector.indexOf("::") != -1){
					var selectorParts = selector.split("::");
					selector = selectorParts[0]+"<b>::"+selectorParts[1]+"</b>";
				}else if(selector.indexOf(":") != -1){
					var selectorParts = selector.split(":");
					selector = selectorParts[0]+"<b>:"+selectorParts[1]+"</b>";
				}

				if(selector.indexOf(" > ") != -1){
					var role = ' > ';
				}else{
					var role = ' ';
				}

				selector = "<span style=\"color:#D70669\">"+selector.replace(new RegExp(role,"g"),'</span>'+role+'<span style="color:#D70669">')+"</span>";
				selector = selector.replace(/<span style=\"(.*?)\">\#(.*?)<\/span>/g,'<span style="color:#6300FF">\#$2<\/span>');


				$("#yp-target-dropdown").append("<li class='"+classes+"'>"+selector+"</li>");

				$("."+classes).tooltip("destroy");

				setTimeout(function(){
				if(classes == 'selecting-with-tagname'){
					$("."+classes).tooltip({title:l18_tag_name_selector,trigger:'hover',placement:"left"});
				}

				if(classes == 'selecting-with-class'){
					$("."+classes).tooltip({title:l18_with_class_selector,trigger:'hover',placement:"left"});
				}

				if(classes == 'selecting-with-one-class'){
					$("."+classes).tooltip({title:l18_with_one_class_selector,trigger:'hover',placement:"left"});
				}

				if(classes == 'selecting-with-id'){
					$("."+classes).tooltip({title:l18_width_id,trigger:'hover',placement:"left"});
				}

				if(classes == 'selecting-with-hover'){
					$("."+classes).tooltip({title:l18_hover_selector,trigger:'hover',placement:"left"});
				}

				if(classes == 'selecting-with-focus'){
					$("."+classes).tooltip({title:l18_focus_selector,trigger:'hover',placement:"left"});
				}

				if(classes == 'selecting-with-max'){
					$("."+classes).tooltip({title:l18_sharp_selector,trigger:'hover',placement:"left"});
				}

				if(classes == 'selecting-with-three'){
					$("."+classes).tooltip({title:l18_simple_sharp_selector,trigger:'hover',placement:"left"});
				}

				if(classes == 'selecting-with-two'){
					$("."+classes).tooltip({title:l18_clean_selector,trigger:'hover',placement:"left"});
				}

				if(classes == 'selecting-with-one'){
					$("."+classes).tooltip({title:l18_simple_title,trigger:'hover',placement:"left"});
				}
				},200);

			}

		}



	}


	function yp_create_similar_selectors(){

		$("#yp-target-dropdown li").tooltip("destroy");
		$("#yp-target-dropdown li").remove();

			if($("#yp-button-target-input").val() == ''){

				var selector = yp_get_current_selector();

			}else{

				var selector = $("#yp-button-target-input").val();

			}

			selector = $.trim(selector);



			if(selector.indexOf("::") > -1){
				selector = selector.split("::")[0];
			}else if(selector.indexOf(":") > -1){
				selector = selector.split(":")[0];
			}

			if(selector == '.' || selector == "#" || selector == '  ' || selector == ' ' || selector == ''){
				return false;
			}

			var element = iframe.find(selector);

			if(element.length == 0){
				return false;
			}

			var tagName = element[0].nodeName.toLowerCase();

			var classes = element.attr("class");

			if(selector.indexOf(" > ") != -1){
				var role = ' > ';
				var roleLength = 3;
			}else{
				var role = ' ';
				var roleLength = 1;
			}

			if(classes != undefined && classes != null){
				classes = yp_classes_clean(classes);
				classes = $.trim(classes);
				var classesArray = classes.split(" ");
			}else{
				classes = '';
				var classesArray = '';
			}

			var id = element.attr("id");

			if(id == undefined || id == null){
				id = '';
			}

			var total = selector.split(role).length;

			var array = selector.split(role);

			var last = array[total-1];

			if(last == '' || last == undefined){
				last = selector;
			}

			var lastLength = last.length;

			var selectorLastExclude = selector.substring(0, selector.length - lastLength);
			var selectorLastExcludeTrim = selectorLastExclude.substring(0, selectorLastExclude.length - roleLength);

			// Tag Name Alternatives.
			if(tagName != 'div'){

				// For Class Selector
				if(last.indexOf(".") != -1){
					yp_add_similar_selectors(selectorLastExclude+tagName,"selecting-with-tagname");
				}

			}

			// Show ID Alternative
			if(id != '' && last.indexOf("#") == -1){
				yp_add_similar_selectors(selectorLastExclude+"#"+id,"selecting-with-id");
			}

			// Select element with extra class.
			if(classesArray != ''){
				for(var i = 0; i<classesArray.length; i++){
					if(last != "."+classesArray[i]){

						// Last element match
						var lastMatch = 0;

						if(last != null && last.match(/\./g) != null){
							lastMatch = last.match(/\./g).length;
						}

						if(lastMatch == null || lastMatch == '' || lastMatch == undefined){
							lastMatch = 0;
						}
						
						if(lastMatch == 0 || lastMatch == 1){
							if(selector.indexOf(classesArray[i]) == -1){
								yp_add_similar_selectors(selector+"."+classesArray[i],"selecting-with-class");
							}

						}else if(lastMatch > 1){
							if(last.split(".")[1]){
								yp_add_similar_selectors(selectorLastExclude+"."+last.split(".")[1],"selecting-with-one-class");
							}
						}
						
					}
				}
			}


			// select element with another class
			if(classesArray != ''){

				for(var i = 0; i<classesArray.length; i++){
					if(last != "."+classesArray[i]){
						
						if(selector.indexOf(classesArray[i]) == -1){
							yp_add_similar_selectors(selectorLastExclude+"."+classesArray[i],"selecting-with-two");
						}
						
					}

				}

			}


			// :hover for a and li tag
			if(tagName == 'a' || tagName == 'li' || tagName == 'img'){
				yp_add_similar_selectors(selector+":hover","selecting-with-hover");
			}

			// li:hover a
			if(tagName == 'a' && iframe.find(selector).parent()[0].nodeName.toLowerCase() == 'li'){
				yp_add_similar_selectors(selectorLastExcludeTrim+":hover"+role+last,"selecting-with-hover");
			}

			// :focus for form tags
			if(tagName == 'input' || tagName == 'textarea'){
				yp_add_similar_selectors(selector+":focus","selecting-with-focus");
			}

			// Full sharp
			if(selector.indexOf(" > ") == -1){
				yp_add_similar_selectors(selector.replace(/ /g,' > '),"selecting-with-max");
			}

			if(total > 3){

				for(var i = 0; i<array.length; i++){
						
					if(iframe.find(array[i]).length == 1 && array[i] != last){
						yp_add_similar_selectors(array[i]+role+last,"selecting-with-three");
					}
					
				}

			}

			if(array[total-1].indexOf("#") != -1 || array[total-1].indexOf(".") != -1){
				yp_add_similar_selectors(array[total-1],"selecting-with-one");
			}


	}

	$(document).on("click", "#yp-target-dropdown li", function(){

		$("#yp-target-dropdown li").tooltip("destroy");
		$("#yp-button-target-input").val($(this).text()).trigger("keyup");
		$(".yp-button-target").trigger("click");

	});


	// Custom Selector
	$(".yp-button-target").click(function(e){

		if($(e.target).hasClass("yp-button-target-input")){
			return false;
		}

		var tooltip = iframe.find(".yp-selected-tooltip");

		$("#yp-target-dropdown li").tooltip("destroy");

		if(iframe.find(".context-menu-active").length > 0){
			iframe.find(".yp-selected").contextMenu("hide");
		}

		var element = $(this);

		if (element.hasClass("active")){

			body.addClass("yp-target-active");
			element.removeClass("active");

			var selector = yp_get_current_selector();

			if(body.attr("data-yp-selector") == ':hover'){
				selector = selector+":hover";
			}

			if(body.attr("data-yp-selector") == ':focus'){
				selector = selector+":focus";
			}

			$("#yp-button-target-input").trigger("focus").val(selector);

			yp_create_similar_selectors();

		}else{

			var selector = $("#yp-button-target-input").val();

			if(selector == '' || selector == ' '){
				element.addClass("active");
				body.removeClass("yp-target-active");
			}

			if(selector.match(/:hover/g)){
				var selectorNew = selector.replace(/:hover/g,'');
			}else if(selector.match(/:focus/g)){
				var selectorNew = selector.replace(/:focus/g,'');
			}else{
				var selectorNew = selector;
			}
				
			if(iframe.find(selectorNew).length > 0 && selectorNew != '*'){

				yp_set_selector(selectorNew);

				// selected element
				var selectedElement = iframe.find(selectorNew);

				// scroll to element if not visible on screen.
				setTimeout(function(){
					if(iframe.find(".yp-selected-tooltip").hasClass("yp-fixed-tooltip")){
						var height = parseInt($(window).height()/2);
						var selectedHeight = parseInt(selectedElement.height()/2);
						if(selectedHeight < height){
							var scrollPosition = selectedHeight+selectedElement.offset().top-height;
							iframe.scrollTop(scrollPosition);
						}
					}
				},45);

				// Set New Selector To Tooltip.
				tooltip.html("<small>"+iframe.find(".yp-selected-tooltip small").html()+"</small> "+selectorNew);

				if(selector.match(/:hover/g)){

					body.addClass("yp-selector-hover");
					body.attr("data-yp-selector",":hover");
					$(".yp-contextmenu-hover").addClass("yp-active-contextmenu");
					iframe.find(".yp-selected-tooltip span").remove();
					tooltip.append("<span>:hover</span>");
					
				}

				if(selector.match(/:focus/g)){

					body.addClass("yp-selector-focus");
					body.attr("data-yp-selector",":focus");
					$(".yp-contextmenu-focus").addClass("yp-active-contextmenu");
					iframe.find(".yp-selected-tooltip span").remove();
					tooltip.append("<span>:focus</span>");

				}


				element.addClass("active");
				body.removeClass("yp-target-active");

			}else if(selectorNew != '' && selectorNew != ' '){

				$("#yp-button-target-input").css("color","red");

			}

		}

	});


	// Custom Selector Close.
	$("#target_background").click(function(){

		body.removeClass("yp-target-active");
		$(".yp-button-target").addClass("active");

	});


	// Custom Selector Keyup
	$("#yp-button-target-input").keyup(function(e){

		yp_create_similar_selectors();

		$(this).attr("style","");

		$("#yp-target-dropdown li").tooltip("destroy");

		// Enter
		if(e.keyCode == 13){
			$(".yp-button-target").trigger("click");
			return false;
		}

	});


	// Selector Color Red Remove.
	$("#yp-button-target-input").keydown(function(){

		$(this).attr("style","");

		$("#yp-target-dropdown li").tooltip("destroy");

	});


	// iris plugin.
	$('.yp-select-bar > ul > li > div > div > div > div > .wqcolorpicker').iris({

		hide: true,

		width: 237,

		change: function(event, ui) {
			$(this).parent().find(".wqminicolors-swatch-color").css("background-color",ui.color.toString());
		}

	});

	// iris plugin.
	$('.yp-select-bar .yp-advanced-option .wqcolorpicker').iris({

		hide: true,

		width: 199,

		change: function(event, ui) {
			$(this).parent().find(".wqminicolors-swatch-color").css("background-color",ui.color.toString());
		}

	});

	// Smart insert default values for options.
	function yp_insert_default_options(){

		// current options
		var options = $(".yp-editor-list > li.active:not(.yp-li-about) .yp-option-group");

		// delete all cached data.
		$("li[data-loaded]").removeAttr("data-loaded");

		// UpData current active values.
		if(options.length > 0){
			options.each(function(){
				yp_set_default(".yp-selected", yp_id_hammer(this), false);
			});
		}

		// cache to loaded data.
		options.parent().attr("data-loaded","true");

	}


	// Select2 Install
	$(".yp-select-bar .yp-this-content select").wqselect2({
		language: "en"
	});
		
		
	// Responsive helper: mobile
	$(".responsive-list .yp-button-small-device").click(function(){
		
		if($(this).hasClass("active")){
			return false;
		}
			
		body.removeClass("yp-medium-device").addClass("yp-small-device");
		$(".responsive-list a").removeClass("active");
		$(this).addClass("active");

		$(".responsive-selector").removeClass("active");
		$(".responsive-selector.yp-button-small-device").addClass("active");

		yp_insert_default_options();

		yp_draw();
		yp_tooltip_draw();
		
	});
		

	// Responsive Helper: tablet
	$(".responsive-list .yp-button-medium-device").click(function(){
		
		if($(this).hasClass("active")){
			return false;
		}
		
		body.removeClass("yp-small-device").addClass("yp-medium-device");
		$(".responsive-list a").removeClass("active");
		$(this).addClass("active");
			
		$(".responsive-selector").removeClass("active");
		$(".responsive-selector.yp-button-medium-device").addClass("active");
			
		yp_insert_default_options();

		yp_draw();
		yp_tooltip_draw();

	});
		

	// Responsive Helper: desktop
	$(".responsive-list .yp-button-large-device").click(function(){
		
		if($(this).hasClass("active")){
			return false;
		}
			
		body.removeClass("yp-small-device").removeClass("yp-medium-device");
		$(".responsive-list a").removeClass("active");
		$(this).addClass("active");
		yp_draw();
		yp_tooltip_draw();
			
		$(".responsive-selector").removeClass("active");
		$(".responsive-selector.yp-button-large-device").addClass("active");
			
		yp_insert_default_options();

	});
		

	// Responsive Helper
	$(".responsive-selector,.responsive-list").hover(function(){
			
		$(".responsive-list").toggle();
			
	});


	// Reset Button
	$(".yp-button-reset").click(function(){

		if (confirm(l18_reset)){

			iframe.find(".yp_current_styles").remove();

			// Clean Editor Value.
			editor.setValue('');

			// Clean CSS Data
			iframe.find("#yp-css-data-full").html("");

			// Reset Parallax.
			iframe.find(".yp-parallax-disabled").removeClass("yp-parallax-disabled");

			// Update Changes.
			if(body.hasClass("yp-content-selected")){

				yp_insert_default_options();

				var element = iframe.find(yp_get_current_selector());

				setTimeout(function(){
					if(element.length > 0){
						if(element.css("position") == "static" && element.hasClass("ready-for-drag") == false){
							element.addClass("ready-for-drag");
						}
					}
				},50);

				yp_draw();

			}

			// Option Changed
			yp_option_change();

		}

	});


	// Install All Options Types.
	// Installing and setting default value to all.
	$(".yp-slider-option").each(function() {
		yp_slider_option(yp_id_hammer(this), $(this).data("decimals"), $(this).data("pxv"), $(this).data("pcv"), $(this).data("emv"));
	});

	$(".yp-radio-option").each(function() {
		yp_radio_option(yp_id_hammer(this));
	});

	$(".yp-select-option").each(function() {
		yp_select_option(yp_id_hammer(this));
	});

	$(".yp-color-option").each(function() {
		yp_color_option(yp_id_hammer(this));
	});

	$(".yp-input-option").each(function() {
		yp_input_option(yp_id_hammer(this));
	});


	// Updating slider by input value.
	function yp_update_slide_by_input(element){

		element  = $(element);
		var elementParent = element.parent().parent().parent();

		var value = element.attr("data-yp-val");
		var prefix = element.parent().find(".yp-after-prefix").val();
		var slide = element.parent().parent().find(".wqNoUi-target");
			
		// Update PX
		if (prefix == 'px') {
			var range = elementParent.data("px-range").split(",");
		}

		// Update %.
		if (prefix == '%') {
			var range = elementParent.data("pc-range").split(",");
		}

		// Update EM.
		if (prefix == 'em') {
			var range = elementParent.data("em-range").split(",");
		}
			
		// min and max values
		var min = parseInt(range[0]);
		var max = parseInt(range[1]);
			
		if(value < min){
			min = value;
		}
			
		if(value > max){
			max = value;
		}

		if(isNaN(parseInt(min)) == false && isNaN(parseInt(max)) == false && isNaN(parseInt(value)) == false){

			slide.wqNoUiSlider({
				range: {
					'min': parseInt(min),
					'max': parseInt(max)
				},
				
				start: value
			}, true);

		}

	}


	// Hide CSS Editor.
	$(".css-editor-btn,.yp-css-close-btn").click(function() {

		// delete fullscreen editor
		if(body.hasClass("yp-fullscreen-editor")){
			body.removeClass("yp-fullscreen-editor");
		}
				
		if($("#leftAreaEditor").css("display") == 'none'){

			editor.focus();
			editor.execCommand("gotolineend");
			$("#cssData,#cssEditorBar,#leftAreaEditor").show();
			$("body").addClass("yp-css-editor-active");
			iframeBody.trigger("scroll");
				
		}else{
				
			// CSS To data
			yp_process(true,false,false);
								
		}

		// Update All.
		yp_draw();

	});


	// Blur: Custom Slider Value
	$(".yp-after-css-val").blur(function(){
		
		yp_update_slide_by_input(this);

	});


	// Keyup format.
	$(".yp-after-prefix").keyup(function(){

		yp_update_slide_by_input(this);

	});


	// Call function.
	yp_resize();


    /* ---------------------------------------------------- */
    /* Set context menu options.							*/
    /* ---------------------------------------------------- */
    $.contextMenu({

        events: {

        	// Draw Again Borders, Tooltip After Contextmenu Hide.
            hide: function(opt) {

                yp_draw();

            },

            // if contextmenu show; update some options.
            show: function() {

                var selector = yp_get_current_selector();

                var elementP = iframe.find(selector).parent();

                if(elementP.length > 0){
                	if(elementP[0].nodeName != "BODY" && elementP[0].nodeName != "HTML"){
                		$(".yp-contextmenu-parent").removeClass("yp-disable-contextmenu");
                	}else{
                		$(".yp-contextmenu-parent").addClass("yp-disable-contextmenu")
                	}
                }else{
                	$(".yp-contextmenu-parent").addClass("yp-disable-contextmenu")
                }

                body.addClass("yp-contextmenuopen");

            }

        },

        // Open context menu only if a element selected.
        selector: 'body.yp-content-selected .yp-selected',
        callback: function(key, options) {

        	var element = iframe.find(selector);

            body.removeClass("yp-contextmenuopen");

            var selector = yp_get_current_selector();

            // Context Menu: Parent
            if (key == "parent") {

            	// If Disable, Stop.
                if ($(".yp-contextmenu-parent").hasClass("yp-disable-contextmenu")) {
                    return false;
                }

                // add class to parent.
                iframe.find(".yp-selected").parent().addClass("yp-will-selected");

                // clean
                yp_clean();

				// Get parent selector.
				var parentSelector = $.trim(yp_get_parents(iframe.find(".yp-will-selected"),"default"));

				// remove parent class.
				iframe.find(".yp-will-selected").removeClass("yp-will-selected");

				// Use Sharp
				if(parentSelector.indexOf(" > ") == -1 && parentSelector.indexOf("  ") == -1){

					// Get Sharp Selector
					var parentSharpSelector = parentSelector.replace(/ /g,' > ');
					
				}

				// Use sharp if not same.
				if(iframe.find(parentSelector).length > iframe.find(parentSharpSelector).length){
					parentSelector = parentSharpSelector;
				}

				// Set Selector
				yp_set_selector(parentSelector);

            }


            // Context Menu: Hover
            if (key == "hover" || key == "focus") {

            	if(key == 'hover'){
            		var keyOther = 'focus';
            	}else{
            		var keyOther = 'hover';
            	}

                // Remove other selector, if isset.
                var attr = body.attr('data-yp-selector');
                if (typeof attr !== typeof undefined && attr !== false){
                    if (attr == ':'+keyOther) {
                        body.removeAttr("data-yp-selector").removeClass("yp-selector-"+keyOther);
                        iframe.find(".yp-selected-tooltip span").remove();
                    }
                }

                // Remove current selector, if isset.
                if (body.attr("data-yp-selector") == ":"+key) {
                    body.removeAttr("data-yp-selector").removeClass("yp-selector-"+key);
                    iframe.find(".yp-selected-tooltip span").remove();
                    $(".yp-active-contextmenu").removeClass("yp-active-contextmenu");
                }else{
                    body.attr("data-yp-selector", ":"+key).addClass("yp-selector-"+key);
                    iframe.find(".yp-selected-tooltip span").remove();
                    iframe.find(".yp-selected-tooltip").append("<span>:"+key+"</span>");
                    $(".yp-active-contextmenu").removeClass("yp-active-contextmenu");
                    $(".yp-contextmenu-"+key).addClass("yp-active-contextmenu");
                }
				
				yp_insert_default_options();

            }
			

			// Select Just It
			if (key == 'selectjustit'){
					
				var selectorCount = 0;
				var selectedElementCount = 0;
					
				iframe.find(yp_get_current_selector()).each(function(){
				
					selectorCount = selectorCount+1;
						
					if($(this).hasClass("yp-selected")){
						selectedElementCount = selectorCount;
					}
					
				});

				// Check for if there is any class for select
				// just this element
				var elementClasses = $.trim(yp_classes_clean(iframe.find(".yp-selected").attr("class")));

				if (typeof elementClasses !== typeof undefined && elementClasses !== false){

					var classes = elementClasses.split(" ");
					var canBeSelectedClass = '';

					for(var i = 0; i<classes.length; i++){
						if(classes[i] != '' && classes[i] != ' '){
							if(iframe.find("."+classes[i]).length == 1){
								canBeSelectedClass = classes[i];
							}
						}
					}
					
					if(canBeSelectedClass != '' && selector.indexOf(canBeSelectedClass) == -1){
						body.attr("data-clickable-select",selector+"."+canBeSelectedClass);
						yp_set_selector(selector+"."+canBeSelectedClass);
						return false;
					}
				
				}

				// If no classes, so using nth-child for select just this element.
				body.attr("data-clickable-select",selector+":nth-child("+selectedElementCount+")");
				
				if(iframe.find(yp_get_current_selector()).length == 1){
					
					if(!iframe.find(yp_get_current_selector()).hasClass("yp-selected")){
						body.attr("data-clickable-select",selector.split(":")[0]+":nth-child("+(selectedElementCount-1)+")");
					}
					
					if(!iframe.find(yp_get_current_selector()).hasClass("yp-selected")){
						body.attr("data-clickable-select",selector.split(":")[0]+":nth-child("+(selectedElementCount+1)+")");
					}
					
				}

				if(iframe.find(yp_get_current_selector()).length != 1){
					
					var selectorNew = selector.split(":")[0];
					var selectorArray = selectorNew.split(">");
					var selectorLast = selectorArray[selectorArray.length-1];
					var reg = new RegExp(" >"+selectorLast,"g");
					var selectorA = selectorNew.replace(reg,"")+":nth-child("+(selectedElementCount-2)+")"+" >" + selectorLast;
					var selectorB = selectorNew.replace(reg,"")+":nth-child("+(selectedElementCount-1)+")"+" >" + selectorLast;
					var selectorC = selectorNew.replace(reg,"")+":nth-child("+selectedElementCount+")"+" >" + selectorLast;
					var selectorD = selectorNew.replace(reg,"")+":nth-child("+(selectedElementCount+1)+")"+" >" + selectorLast;
					var selectorF = selectorNew.replace(reg,"")+":nth-child("+(selectedElementCount+2)+")"+" >" + selectorLast;
					
					// If Selector A Working.
					if(iframe.find(selectorA).length == 1){

						if(iframe.find(selectorA).hasClass("yp-selected")){
							body.attr("data-clickable-select",selectorA);
						}
						
					}
					
					// If Selector B Working.
					if(iframe.find(selectorB).length == 1){
					
						if(iframe.find(selectorB).hasClass("yp-selected")){
							body.attr("data-clickable-select",selectorB);
						}
						
					}
					
					// If Selector C Working.
					if(iframe.find(selectorC).length == 1){
					
						if(iframe.find(selectorC).hasClass("yp-selected")){
							body.attr("data-clickable-select",selectorC);
						}
						
					}
					
					// If Selector D Working.
					if(iframe.find(selectorD).length == 1){
						
						if(iframe.find(selectorD).hasClass("yp-selected")){
							body.attr("data-clickable-select",selectorD);
						}
						
					}
						
					// If Selector F Working.
					if(iframe.find(selectorF).length == 1){
						
						if(iframe.find(selectorF).hasClass("yp-selected")){
							body.attr("data-clickable-select",selectorF);
						}
						
					}
					
				}
				

				// If selector element is one.
				if(iframe.find(yp_get_current_selector()).length == 1){

					// Remove other borders.
					iframe.find(".yp-selected-others").removeClass("yp-selected-others");
					iframe.find(".yp-selected-others-top,.yp-selected-others-bottom,.yp-selected-others-left,.yp-selected-others-right").remove();


					if(!$(".yp-contextmenu-select-it").hasClass("yp-active-contextmenu")){

						$(".yp-contextmenu-select-it").addClass("yp-active-contextmenu");
						iframe.find(".yp-selected-tooltip span").remove();
                   		iframe.find(".yp-selected-tooltip").append("<span class='selected-just-it-span'>:just-it</span>");

					}else{

						$(".yp-contextmenu-select-it").removeClass("yp-active-contextmenu");
						var selectorClean = selector.replace(/:nth-child\((.*?)\)/g,'');
						body.attr("data-clickable-select",selectorClean);
						iframe.find(".selected-just-it-span").remove();

					}

					// Remove Select Just It Tooltip.
					$(".yp-contextmenu-select-it").tooltip("destroy");

				}else{

					if(!$(".yp-contextmenu-select-it").hasClass("yp-active-contextmenu")){

						$(".yp-contextmenu-select-it").tooltip({title:"Not possible, Can't select just this element. Please add custom id or class to this element.",trigger:'hover',placement:"left",container: ".yp-select-bar"}).tooltip("show");
						var selectorClean = selector.replace(/:nth-child\((.*?)\)/g,'');
						body.attr("data-clickable-select",selectorClean);
						return false;

					}else{

						$(".yp-contextmenu-select-it").removeClass("yp-active-contextmenu");
						var selectorClean = selector.replace(/:nth-child\((.*?)\)/g,'');
						body.attr("data-clickable-select",selectorClean);
						iframe.find(".selected-just-it-span").remove();

					}

				}
				
			}
			/* Select just it functions end here */
			

			// leave Selected element.
			if (key == 'close'){
				yp_clean();
				yp_resize();
			}


			// toggle selector editor.
			if(key == "editselector"){
				$(".yp-button-target").trigger("click");
			}


        },

        // Content menu elements.
        items: {
            "hover": {
                name: ":Hover",
                className: "yp-contextmenu-hover"
            },
            "focus": {
                name: ":Focus",
                className: "yp-contextmenu-focus"
            },
			"sep1": "---------",
            "parent": {
                name: "Parent Element",
                className: "yp-contextmenu-parent"
            },
            "editselector": {
                name: "Edit Selector",
                className: "yp-contextmenu-selector-edit"
            },
			"selectjustit": {
                name: "Select just it",
                className: "yp-contextmenu-select-it"
            },
            "close": {
                name: "Leave",
                className: "yp-contextmenu-close"
            }
        }


    });




    /* ---------------------------------------------------- */
    /* Resize.												*/
    /* Dynamic resize yellow pencil panel 					*/
    /* ---------------------------------------------------- */
    function yp_resize() {

    	// top margin for matgin.
    	var topMargin = 0;
    	if(!$("body").hasClass("yp-metric-disable")){
    		topMargin = 31;
    	}

    	// Right menu fix.
    	if (iframe.height() > $(window).height()){
    		$(".yp-select-bar").css("margin-right","26px");
    	}else{
    		$(".yp-select-bar").css("margin-right","10px");
    	}
		
		// Maximum Height.
		var maximumHeight = $(window).height()-24-topMargin;
		
		// Difference size for 790 and more height.
		if($(window).height() > 790){
			var topBarHeight = 46;
		}else{
			var topBarHeight = 43;
		}
		
        // Resize. If no selected menu showing.
		if($(".yp-no-selected").css("display") == "block"){
			
			var height = $(".yp-no-selected").height()+140;
			
			if(height <= maximumHeight){
				$(".yp-select-bar").height(height);
				$(".yp-editor-list").height(height-45);
			}else{
				$(".yp-select-bar").height(maximumHeight);
				$(".yp-editor-list").height(maximumHeight-45);
			}
		
		// If any options showing.
		}else if($(".yp-this-content:visible").length > 0){
			
			var height = $(".yp-this-content:visible").parent().height();

			if(height <= maximumHeight){
				height = height+117;
				var heightLitte = height-45;
			}

			if($(window).height() < 700){
				height = height-3;
			}
			
			if(height <= maximumHeight){
				$(".yp-select-bar").height(height);
				$(".yp-editor-list").height(heightLitte);
			}else{
				$(".yp-select-bar").height(maximumHeight);
				$(".yp-editor-list").height(maximumHeight-45);
			}
			
		}else{ // If Features list showing.
			
			if($(window).height() > 700){
				var footerHeight = 125;
			}else{
				var footerHeight = 33;
			}

			var topPadding = (($(".yp-editor-list > li").length-2)*topBarHeight)+footerHeight;

			var topHeightBar = $(".yp-editor-top").height()+topPadding;
			
			if(topHeightBar <= maximumHeight){
				$(".yp-select-bar").height(topHeightBar);
				$(".yp-editor-list").height(topPadding);
			}else{
				$(".yp-select-bar").height(maximumHeight);
				$(".yp-editor-list").height(topPadding);
			}
			
		}

    }


    // Element Picker Helper
    $(".yp-element-picker").click(function(){
    	$("body").toggleClass("yp-element-picker-active");
    	$(this).toggleClass("active");
    });


    /* ---------------------------------------------------- */
    /* Element Selector Box Function						*/
    /* ---------------------------------------------------- */
	iframe.on("mouseover mouseout", iframe, function(evt){
		
		// Element
		var element = $(evt.target);

		var elementClasses = element.attr("class");

		if(element.hasClass("yp-selected")){
			return false;
		}

		if(body.hasClass("yp-content-selected") == false){
			if(element.hasClass("yp-selected-tooltip") == true){
				yp_clean();
				return false;
			}

			if(element.parent().length > 0){
				if(element.parent().hasClass("yp-selected-tooltip")){
					yp_clean();
					return false;
				}
			}
		}

		// If not any yellow pencil element.
		if (typeof elementClasses !== typeof undefined && elementClasses !== false){
			if(elementClasses.indexOf("yp-selected-boxed-") > -1){
				return false;
			}
		}

		// If colorpicker stop.
		if($("body").hasClass("yp-element-picker-active") == true){

			window.pickerColor = element.css("background-color");

			if(window.pickerColor == '' || window.pickerColor == 'transparent'){

				element.parents().each(function(){

					if($(this).css("background-color") != 'transparent' && $(this).css("background-color") != '' && $(this).css("background-color") != null){
						window.pickerColor = $(this).css("background-color");
						return false;
					}

				});

			}

			var color = window.pickerColor.toString();

			$(".yp-element-picker.active").parent().parent().find(".wqcolorpicker").val(rgb2hex(color)).trigger("change");
		}

		// If element already selected, stop.
		if(body.hasClass("yp-content-selected")){
			return false;
		}

		// If mouse on HTML Or Body, Stop.
		if(element[0].nodeName == "HTML" || element[0].nodeName == "BODY"){
			return false;
		}

		// Not show if p tag and is empty.
		if(element.html() == '&nbsp;' && element[0].nodeName == 'P'){
			return false;
		}

		// if Not Null continue.
		if(element === null){
			return false;
		}

		// stop if not have
		if(element.length == 0){
			return false;
		}
		
		// if element not on screen stop.
		if(!element.filter(":onScreen").length === 0){
			return false;
		}
	
		// If selector disable stop.
		if (body.hasClass("yp-selector-disabled")){
            return false;
        }

        // Geting selector.
        var selector = yp_get_parents(element,"default");


        // Be sure this is visible on screen
		if (element.css("display") == 'none' || element.css("visibility") == 'hidden' || element.css("opacity") == '0'){
			return false;
		}

		// Be sure this is visible on screen (For parent)
		if(element.parent().length !== 0 && element.parent()[0].nodeName !== 'HTML' && element.parent()[0].nodeName !== 'BODY'){
			
			if (element.parent().css("display") == 'none' || element.parent().css("visibility") == 'hidden' || element.parent().css("opacity") == '0'){
				return false;
			}
		

			// Be sure this is visible on screen (For parent parent)
			if(element.parent().parent().length !== 0 && element.parent().parent()[0].nodeName !== 'HTML' && element.parent().parent()[0].nodeName !== 'BODY'){
				if (element.parent().parent().css("display") == 'none' || element.parent().parent().css("visibility") == 'hidden' || element.parent().parent().css("opacity") == '0'){
					return false;
				}
			

				// Be sure this is visible on screen (For parent parent parent)
				if(element.parent().parent().parent().length !== 0 && element.parent().parent().parent()[0].nodeName !== 'HTML' && element.parent().parent().parent()[0].nodeName !== 'BODY'){
					if (element.parent().parent().parent().css("display") == 'none' || element.parent().parent().parent().css("visibility") == 'hidden' || element.parent().parent().parent().css("opacity") == '0'){
						return false;
					}
				
					// Be sure this is visible on screen (For parent parent parent)
					if(element.parent().parent().parent().parent().length !== 0 && element.parent().parent().parent().parent()[0].nodeName != 'HTML' && element.parent().parent().parent().parent()[0].nodeName != 'BODY'){
						if (element.parent().parent().parent().parent().css("display") == 'none' || element.parent().parent().parent().parent().css("visibility") == 'hidden' || element.parent().parent().parent().parent().css("opacity") == '0'){
							return false;
						}
					}

				}

			}

		}

        var nodeName = element[0].nodeName;

			evt.stopPropagation();
			evt.preventDefault();

            if (nodeName != 'BODY' && nodeName != 'HTML' && body.hasClass("yp-content-selected") == false){

                // Remove all ex data.
                yp_clean();

                // Hover it
                element.addClass("yp-selected");
				
				// transform.
				if(element.css("transform") != 'none' && element.css("transform") != 'inherit' && element.css("transform") != ''){
					body.addClass("yp-has-transform");
				}
				
				if(element.parent().length != 0){
					if(element.parent().css("transform") != 'none' && element.parent().css("transform") != 'inherit' && element.parent().css("transform") != ''){
						body.addClass("yp-has-transform");
					}
				}
				
				if(element.parent().parent().length != 0){
					if(element.parent().parent().css("transform") != 'none' && element.parent().parent().css("transform") != 'inherit' && element.parent().parent().css("transform") != ''){
						body.addClass("yp-has-transform");
					}
				}

                // For tooltip
                var tagName = nodeName;

                yp_draw_box(evt.target, 'yp-selected-boxed');

                // Element Tooltip
                iframeBody.append("<div class='yp-selected-tooltip'><small>" + yp_tag_info(tagName, selector) + "</small> " + selector + "</div>");

                yp_tooltip_draw();

                // Select Others.
                iframe.find(selector+":not(.yp-selected)").each(function(i) {
					
					$(this).addClass("yp-selected-others");
					yp_draw_box_other(this, 'yp-selected-others', i);

                });


            }

            // if body and html so clean.
            if (nodeName == 'BODY' || nodeName == 'HTML'){

                if (body.hasClass("yp-content-selected") == false) {

                    // Remove all ex data.
                    yp_clean();

                }

            }

    });



    /* ---------------------------------------------------- */
    /* Doing update the draw.		 						*/
    /* ---------------------------------------------------- */
    function yp_draw() {

    	// If not visible stop.
    	if(iframe.find(".yp-selected").css("display") == 'none'){
			return false;
		}

        // selected boxed.
        yp_draw_box(".yp-selected", 'yp-selected-boxed');


        // Select Others.
        iframe.find(".yp-selected-others").each(function(i) {
			yp_draw_box_other(this, 'yp-selected-others', i);
        });

        // Tooltip
    	yp_tooltip_draw();

		// Dragger update.
		yp_get_handler();

    }


    /* ---------------------------------------------------- */
    /* use important if CSS not working without important 	*/
    /* ---------------------------------------------------- */
    function yp_insert_important_rule(selector, id, css, value, prefix){

    	// Clean value
    	value = value.replace(/ !important/g, "").replace(/!important/g, "");

		// Remove Style Without important.
        iframe.find("." + yp_id(selector) + '-' + id + '-style[data-size-mode="'+$(".responsive-selector.active").data("mode")+'"]').remove();

        // Append Style Area If Not Have.
        if (!iframe.find(".yp-styles-area").length > 0){
            iframeBody.append("<div class='yp-styles-area'></div>");
        }
		
		// Responsive Settings
		var mediaBefore = '';
		var mediaAfter = '';
		
		if($(".responsive-selector.active").data("mode") == 'mobile'){
			mediaBefore = '@media (max-width:767px){';
			mediaAfter = '}';
		}
		
		if($(".responsive-selector.active").data("mode") == 'tablet'){
			mediaBefore = '@media (min-width: 768px) and (max-width: 991px){';
			mediaAfter = '}';
		}

		// Append.
		if(yp_id(selector) != ''){
			iframe.find(".yp-styles-area").append('<style data-size-mode="'+$(".responsive-selector.active").data("mode")+'" data-style="' + yp_id(selector) + '" class="' + yp_id(selector) + '-' + id + '-style yp_current_styles">'+mediaBefore+'' + '' + selector + '{' + css + ':' + value + prefix + ' !important}' + ''+mediaAfter+'</style>');
		}
		
    }
	
	
	// Keyup bind For CSS Editor.
	$("#cssData").keyup(function(){
		
		// Append all css to iframe.
		if(iframe.find("#yp-css-data-full").length == 0){
			iframeBody.append("<style id='yp-css-data-full'></style>");
		}

		// Need to process.
		body.addClass("yp-need-to-process");
		
		// Update css source.
		iframe.find("#yp-css-data-full").html(editor.getValue());
		
		// Empty data.
		iframe.find(".yp-styles-area").empty();

		// Remove ex.
		iframe.find(".yp-live-css").remove();
		//yp_clean();

		// Update Changes.
		if(body.hasClass("yp-content-selected")){

			yp_insert_default_options();

			// Draw.
			yp_draw();

			// Up Draw
			setTimeout(function(){
				yp_draw();
			},20);

		}
		
		// Update
		$(".yp-save-btn").html("Save").removeClass("yp-disabled").addClass("waiting-for-save");
		
		// Update sceen.
		yp_resize();
		
	});
	
	
	// Return to data again.
	$(".yp-select-bar").on("mouseover mouseout",function(){
		
		if(body.hasClass("yp-need-to-process") == true){

			// CSS To Data.
			yp_process(false,false);

		}
		
	});


	// Hide Slowly
	function yp_hide_selects_with_animation(){
		yp_draw();
		iframe.find(".yp-selected-handle,.yp-selected-tooltip,.yp-selected-boxed-margin-top,.yp-selected-boxed-margin-bottom,.yp-selected-boxed-margin-left,.yp-selected-boxed-margin-right,.yp-selected-boxed-top,.yp-selected-boxed-bottom,.yp-selected-boxed-left,.yp-selected-boxed-right,.yp-selected-others-top,.yp-selected-others-bottom,.yp-selected-others-left,.yp-selected-others-right").stop().animate({ opacity: 0},200);
	}


	// Show Slowly.
	function yp_show_selects_with_animation(){
		yp_draw();
		iframe.find(".yp-selected-handle,.yp-selected-tooltip,.yp-selected-boxed-margin-top,.yp-selected-boxed-margin-bottom,.yp-selected-boxed-margin-left,.yp-selected-boxed-margin-right,.yp-selected-boxed-top,.yp-selected-boxed-bottom,.yp-selected-boxed-left,.yp-selected-boxed-right,.yp-selected-others-top,.yp-selected-others-bottom,.yp-selected-others-left,.yp-selected-others-right").stop().animate({ opacity: 1},200);
	}


	// Hide Borders If mouse over select2 dropdown
	$(document).on("mouseover", ".wqselect2-dropdown", function(){

		if($("body").hasClass("yp-selectors-hide") == false){

			$("body").addClass("yp-selectors-hide");

			// Opacity Selector
			if (iframe.find(".context-menu-active").length > 0){
				iframe.find(".yp-selected").contextMenu("hide");
			}

			yp_hide_selects_with_animation();

		}

	});


	// Hide borders while editing.
	$(".yp-this-content").hover(function(){

		if($("body").hasClass("yp-selectors-hide") == false){

			$("body").addClass("yp-selectors-hide");

			// Opacity Selector
			if (iframe.find(".context-menu-active").length > 0){
				iframe.find(".yp-selected").contextMenu("hide");
			}

			yp_hide_selects_with_animation();

		}

	},function(){

		if($("body").hasClass("yp-selectors-hide") && $(".wqNoUi-active").length == 0){

			$("body").removeClass("yp-selectors-hide");

			yp_show_selects_with_animation();

		}

	});
	
	
	// CSS To Yellow Pencil Data.
	function yp_cssToData(type){
		
		body.addClass("process-by-code-editor");
		
		if(type == 'desktop'){		
		if(body.hasClass("yp-medium-device")){
			body.attr("data-type-default",".yp-button-medium-device");
		}
		
		if(body.hasClass("yp-small-device")){
			body.attr("data-type-default",".yp-button-small-device");
		}
		
		if(body.hasClass("yp-small-device") == false && body.hasClass("yp-medium-device") == false){
			body.attr("data-type-default",".yp-button-large-device");
		}
		}
		
		if(iframe.find("#yp-css-data-full").length == 0){
			return false;
		}

		// Source.
		var source = editor.getValue();

		// Nth child
		source = source.replace(/:nth-child\((.*?)\)/g,'\.nth-child\.$1\.');
		
		// Clean.
		source = source.replace(/(\r\n|\n|\r)/g,"").replace(/\t/g, '');
		
		// Don't care rules in comment.
		source = source.replace(/\/\*(.*?)\*\//g,"");
		
		// if desktop, update.
		if(type == 'desktop'){
			$(".yp-button-large-device").trigger("click");
		}
		
		// Resposive media converter
		if(source.indexOf("@media") != -1){
			
			// Clean.
			source = source.replace(/\} \}/g,'}}').replace(/\}  \}/g,'}}').replace(/\}   \}/g,'}}').replace(/\}   \}/g,'}}').replace(/\}    \}/g,'}}').replace(/\}	\}/g,'}}').replace(/\}		\}/g,'}}').replace(/\}	 \}/g,'}}').replace(/\} 	\}/g,'}}');
			
			// if tablet.
			if(type == 'tablet'){
				source = source.match(/@media \(min(.*?)\}\}/g);
				if(source === null){
					$(".responsive-list").find(".active").removeClass("active");
					$(body.attr("data-type-default")).trigger("click").addClass("active");
					return false;
				}
				source = source.toString().replace("@media (min-width: 768px) and (max-width: 991px){","");
				source = source.toString().replace("}}","}");
				$(".yp-button-medium-device").trigger("click");
			}
			
			// if mobile.
			if(type == 'mobile'){
				source = source.match(/@media \(max(.*?)\}\}/g);
				if(source === null){
					$(".responsive-list").find(".active").removeClass("active");
					$(body.attr("data-type-default")).trigger("click").addClass("active");
					return false;
				}
				source = source.toString().replace("@media (max-width:767px){","");
				source = source.toString().replace("}}","}");
				$(".yp-button-small-device").trigger("click");
			}
		}
		
		// if no source, stop.
		if(source == ''){
			return false;
		}
		
		// if have a problem in source, stop.
		if(source.indexOf("{") == source.indexOf("}")){
			
			return false;
			
		}
		
		var CSSRules;
		var selector;
		
		// IF Desktop; Remove All Rules. (because first call by desktop)
		if(type == 'desktop'){
			iframe.find(".yp-styles-area").empty();
		}
		
		// If mobile, remove CSS data area. (because last call by mobile)
		if(type == 'mobile'){
			iframe.find("#yp-css-data-full").remove();
		}
		
		// Don't care rules in media query.
		source = source.replace(/@media(.*?)\}\}/g, '');
		
		// Getting All CSS Selectors.
		var allSelectors = yp_cleanArray(source.replace(/\{(.*?)\}/g,'|BREAK|').split("|BREAK|"));
		
		// Each All Selectors
		for (var i = 0; i < allSelectors.length; i++){

			// Get Selector.
			selector = $.trim(allSelectors[i]);
			
			if(selector != '}' && selector != '}}' && selector != '{' && selector != '' && selector != ' ' && selector != '  ' && selector != '	'){

				// Getting CSS Rules.
				CSSRules = source.match(new RegExp('}'+selector+'{(.*)}'));
				
				if(CSSRules == null || CSSRules == undefined){
					CSSRules = source.match(new RegExp('^'+selector+'{(.*)}'));
				}

				selector = selector.replace(/\.nth-child\.(.*?)\./g,':nth-child($1)');
			
				if(CSSRules != null && CSSRules != ''){
			
					// Clean.
					CSSRules = CSSRules.toString().replace(/^\}/g).split("}")[0].split("{")[1].split(";");
					
					// Variables.
					var ruleAll;
					var ruleName;
					var ruleVal;
					
					// Each CSSRules.
					for (var iq = 0; iq < CSSRules.length; iq++){
						
						ruleAll = $.trim(CSSRules[iq]);
						
						if(typeof ruleAll != undefined && ruleAll.length >= 3 && ruleAll.indexOf(":") != -1){
						
							ruleName = ruleAll.split(":")[0];
							
							if(ruleName != ''){
							
								ruleVal = ruleAll.split(':').slice(1).join(':');

								ruleVal = ruleVal;
								
								if(ruleVal != '' && ruleName.indexOf("-webkit-filter") === -1 && ruleName.indexOf("-webkit-transform") === -1){

									if($(".yp_debug").css(ruleName) != undefined || ruleName != 'background-parallax' || ruleName != 'background-parallax-speed' || ruleName != 'background-parallax-x'){
										
										$(".yp_debug").removeAttr("style");

										body.addClass("yp-css-converter"); // for not use important tag.

										// Adding classes.
										iframe.find(selector).addClass("yp_selected").addClass("yp_onscreen").addClass("yp_hover").addClass("yp_focus").addClass("yp_click");

										// Update
										yp_insert_rule(selector, ruleName, ruleName, ruleVal, '');

										body.removeClass("yp-css-converter"); // remove class after update.

										// Removing classes.
										iframe.find(selector).removeClass("yp_selected").removeClass("yp_onscreen").removeClass("yp_hover").removeClass("yp_focus").removeClass("yp_click");
									
									}
								
								}
							
							}
						
						}
						
					}
				
				}
		
			}
			
		}
		
		// Mobile is last
		if(type == 'mobile'){
			$(".responsive-list").find(".active").removeClass("active");
			$(body.attr("data-type-default")).trigger("click").addClass("active");
		}
		
	}



    /* ---------------------------------------------------- */
    /* Appy CSS To theme for demo	 						*/
    /* ---------------------------------------------------- */
    function yp_insert_rule(selector, id, css, value, prefix){

    	// adding class
    	body.addClass("yp-inserting");

    	// Delete basic CSS.
    	yp_clean_live_css(id,false);

    	// clean value.
    	if (typeof value === typeof undefined || value === false){
    		var valCon = $.trim(value.replace(/!important/g,''));
    	}

    	// border style.
		if(id == 'border-style'){
			yp_insert_rule(selector, 'border-left-style', 'border-left-style', value, prefix);
			yp_insert_rule(selector, 'border-right-style', 'border-right-style', value, prefix);
			yp_insert_rule(selector, 'border-top-style', 'border-top-style', value, prefix);
			yp_insert_rule(selector, 'border-bottom-style', 'border-bottom-style', value, prefix);
			return false;
		}

		// border width.
		if(id == 'border-width'){
			yp_insert_rule(selector, 'border-left-width', 'border-left-width', value, prefix);
			yp_insert_rule(selector, 'border-right-width', 'border-right-width', value, prefix);
			yp_insert_rule(selector, 'border-top-width', 'border-top-width', value, prefix);
			yp_insert_rule(selector, 'border-bottom-width', 'border-bottom-width', value, prefix);
			return false;
		}

		// border color.
		if(id == 'border-color'){
			yp_insert_rule(selector, 'border-left-color', 'border-left-color', value, prefix);
			yp_insert_rule(selector, 'border-right-color', 'border-right-color', value, prefix);
			yp_insert_rule(selector, 'border-top-color', 'border-top-color', value, prefix);
			yp_insert_rule(selector, 'border-bottom-color', 'border-bottom-color', value, prefix);
			return false;
		}

    	// Background image fix.
 		if(id == 'background-image' && value != 'disable' && value != 'none' && value != ''){
	    	if(value.replace(/\s/g,"") == 'url()' || value.indexOf("//") == -1){
				value = 'disable';
			}
		}

		// adding automatic relative.
		if(id == 'top' || id == 'bottom' || id == 'left' || id == 'right'){
			
			iframe.find(selector).removeClass("ready-for-drag");

			setTimeout(function(){
				if(iframe.find(selector).css("position") == 'static'){
					$("#position-relative").trigger("click");
					iframe.find(selector).addClass("ready-for-drag");
				}
			},5);

		}

		// Background color
		if(id == 'background-color'){
			if($("#yp-background-image").val() != 'none' && $("#yp-background-image").val() != ''){
				yp_insert_important_rule(selector, id, css, value, prefix);
				body.removeClass("yp-inserting");
				return false;
			}
		}

		// Position Drag&Drop helper
		if(id == 'position' && valCon == 'static'){
			body.addClass("yp-position-static");
		}else if(id == 'position'){
			body.removeClass("yp-position-static");
		}


    	// Animation Name Settings.
		if(id == 'animation-name' && body.hasClass("process-by-code-editor") == false){
			
			selector = selector.replace(/\.yp_onscreen/g,'').replace(/\.yp_hover/g,'').replace(/\.yp_focus/g,'').replace(/\.yp_click/g,'');
			
			var selectorNew = selector.split(":");
			var play = "."+$("select#yp-animation-play").val();
			
			if(selectorNew[1] != undefined){
				selector = selectorNew[0]+play+":"+selectorNew[1];
			}else{
				selector = selectorNew[0]+play;
			}
			
		}

		if(id == 'position'){

			if(value == 'static'){
				iframe.find(".yp-selected-handle").hide();
			}else{
				iframe.find(".yp-selected-handle").show();
			}

		}
	
		// Selection settings.
        var selection = $('body').attr('data-yp-selector');

        if (typeof selection === typeof undefined || selection === false){
			
            var selection = '';
			
        } else {
			
			selector = selector.replace("body ","")
			selector.replace("body","");
			
            selector = 'body.yp-selector-' + selection.replace(':', '') + " " + selector;
			
			selector = selector.replace('body.yp-selector-'+selection.replace(':', '')+' body.yp-selector-'+selection.replace(':', '')+' ','body.yp-selector-'+selection.replace(':', '')+' ');
        
		}
		

		// Delete same data.
		var exStyle = iframe.find("." + yp_id(selector) + '-' + id + '-style[data-size-mode="'+$(".responsive-selector.active").data("mode")+'"]');
		if(exStyle.length > 0){
			if(exStyle.html().split(":")[1].split("}")[0] == value){
				body.removeClass("yp-inserting");
				return false;
			}else{
				exStyle.remove(); // else remove.
			}
		}

		// Delete same data for filter and transform -webkit- prefix.
		var exStyle = iframe.find("." + yp_id(selector) + '-' + "-webkit-"+id + '-style[data-size-mode="'+$(".responsive-selector.active").data("mode")+'"]');
		if(exStyle.length > 0){
			if(exStyle.html().split(":")[1].split("}")[0] == value){
				body.removeClass("yp-inserting");
				return false;
			}else{
				exStyle.remove(); // else remove.
			}
		}


		// Filter
		if(id == 'filter' || id == 'transform'){

			if (value != 'disable' && value != '' && value != 'undefined' && value != null){
    			yp_insert_rule(selector, "-webkit-"+id, "-webkit-"+css, value, prefix);
    		}

    	}


		// Append style area.
		if (!iframe.find(".yp-styles-area").length > 0) {
			iframeBody.append("<div class='yp-styles-area'></div>");
		}

		// No px em etc for this options.
		if (id == 'z-index' || id == 'opacity' || id == 'background-parallax-speed' || id == 'background-parallax-x' || id == 'blur-filter' || id == 'grayscale-filter' || id == 'brightness-filter' || id == 'contrast-filter' || id == 'hue-rotate-filter' || id == 'saturate-filter' || id == 'sepia-filter' || id.indexOf("-transform") != -1) {
			if(id != 'text-transform' && id != '-webkit-transform'){
				value = yp_num(value);
				prefix = '';
			}
		}
		
		// Filter Default options.
		if(id == 'blur-filter' || id == 'grayscale-filter' || id == 'brightness-filter' || id == 'contrast-filter' || id == 'hue-rotate-filter' || id == 'saturate-filter' || id == 'sepia-filter'){
			
			if(iframe.find('.' + yp_id(selector) + '-filter-style').length > 0){

				var $filterBefore = iframe.find('.' + yp_id(selector) + '-filter-style').html();

				// Fix responsive bug
				if($filterBefore.indexOf("@media") != -1){

					$filterBefore = $filterBefore.match(/{(.*)}/g).toString().replace(/{(.*)}/g,"$1").split(":")[1].split("}")[0];

				}else{

					$filterBefore = $filterBefore.split(":")[1].split("}")[0];

				}

			}else{
				var $filterBefore = '';
			}
			
			prefix = '';
			
		}
		
		// Blur filter
		if(id == 'blur-filter'){
			if($filterBefore.indexOf("blur") == -1){
				// Add new
				yp_insert_rule(selector, 'filter', 'filter', $filterBefore+" blur("+yp_num(value)+"px)", prefix);
			}else if(value != 'disable' && value != '' && value != 'undefined' && value != null){
				// Replace with ex.
				$filterBefore = $filterBefore.replace(/blur\((.*?)\)/g,'blur('+yp_num(value)+'px)');
				yp_insert_rule(selector, 'filter', 'filter', $filterBefore, prefix);
			}else{
				yp_insert_rule(selector, 'filter', 'filter', $filterBefore.replace(/ blur\((.*?)\)/g,''), '');
			}
			body.removeClass("yp-inserting");
			return false;
		}
		
		// Grayscale filter
		if(id == 'grayscale-filter'){
			
			if($filterBefore.indexOf("grayscale") == -1){
				// Add new
				yp_insert_rule(selector, 'filter', 'filter', $filterBefore+" grayscale("+yp_num(value)+")", prefix);
			}else if(value != 'disable' && value != '' && value != 'undefined' && value != null){
				// Replace with ex.
				$filterBefore = $filterBefore.replace(/grayscale\((.*?)\)/g,'grayscale('+yp_num(value)+')');
				yp_insert_rule(selector, 'filter', 'filter', $filterBefore, prefix);
			}else{
				yp_insert_rule(selector, 'filter', 'filter', $filterBefore.replace(/ grayscale\((.*?)\)/g,''), '');
			}
			body.removeClass("yp-inserting");
			return false;
		}
		
		// Brightness Filter
		if(id == 'brightness-filter'){
			
			if($filterBefore.indexOf("brightness") == -1){
				// Add new
				yp_insert_rule(selector, 'filter', 'filter', $filterBefore+" brightness("+yp_num(value)+")", prefix);
			}else if(value != 'disable' && value != '' && value != 'undefined' && value != null){
				// Replace with ex.
				$filterBefore = $filterBefore.replace(/brightness\((.*?)\)/g,'brightness('+yp_num(value)+')');
				yp_insert_rule(selector, 'filter', 'filter', $filterBefore, prefix);
			}else{
				yp_insert_rule(selector, 'filter', 'filter', $filterBefore.replace(/ brightness\((.*?)\)/g,''), '');
			}
			body.removeClass("yp-inserting");
			return false;
		}
		
		// Contrast Filter
		if(id == 'contrast-filter'){
			
			if($filterBefore.indexOf("contrast") == -1){
				// Add new
				yp_insert_rule(selector, 'filter', 'filter', $filterBefore+" contrast("+yp_num(value)+")", prefix);
			}else if(value != 'disable' && value != '' && value != 'undefined' && value != null){
				// Replace with ex.
				$filterBefore = $filterBefore.replace(/contrast\((.*?)\)/g,'contrast('+yp_num(value)+')');
				yp_insert_rule(selector, 'filter', 'filter', $filterBefore, prefix);
			}else{
				yp_insert_rule(selector, 'filter', 'filter', $filterBefore.replace(/ contrast\((.*?)\)/g,''), '');
			}
			body.removeClass("yp-inserting");
			return false;
		}
		
		// Hue rotate filter
		if(id == 'hue-rotate-filter'){
			
			if($filterBefore.indexOf("hue-rotate") == -1){
				// Add new
				yp_insert_rule(selector, 'filter', 'filter', $filterBefore+" hue-rotate("+yp_num(value)+"deg)", prefix);
			}else if(value != 'disable' && value != '' && value != 'undefined' && value != null){
				// Replace with ex.
				$filterBefore = $filterBefore.replace(/hue-rotate\((.*?)\)/g,'hue-rotate('+yp_num(value)+'deg)');
				yp_insert_rule(selector, 'filter', 'filter', $filterBefore, prefix);
			}else{
				yp_insert_rule(selector, 'filter', 'filter', $filterBefore.replace(/ hue-rotate\((.*?)\)/g,''), '');
			}
			body.removeClass("yp-inserting");
			return false;
		}
		
		// Saturate filter
		if(id == 'saturate-filter'){
			
			if($filterBefore.indexOf("saturate") == -1){
				// Add new
				yp_insert_rule(selector, 'filter', 'filter', $filterBefore+" saturate("+yp_num(value)+")", prefix);
			}else if(value != 'disable' && value != '' && value != 'undefined' && value != null){
				// Replace with ex.
				$filterBefore = $filterBefore.replace(/saturate\((.*?)\)/g,'saturate('+yp_num(value)+')');
				yp_insert_rule(selector, 'filter', 'filter', $filterBefore, prefix);
			}else{
				yp_insert_rule(selector, 'filter', 'filter', $filterBefore.replace(/ saturate\((.*?)\)/g,''), '');
			}
			body.removeClass("yp-inserting");
			return false;
		}
		
		// Sepia Filter
		if(id == 'sepia-filter'){
			
			if($filterBefore.indexOf("sepia") == -1){
				// Add new
				yp_insert_rule(selector, 'filter', 'filter', $filterBefore+" sepia("+yp_num(value)+")", prefix);
			}else if(value != 'disable' && value != '' && value != 'undefined' && value != null){
				// Replace with ex.
				$filterBefore = $filterBefore.replace(/sepia\((.*?)\)/g,'sepia('+yp_num(value)+')');
				yp_insert_rule(selector, 'filter', 'filter', $filterBefore, prefix);
			}else{
				yp_insert_rule(selector, 'filter', 'filter', $filterBefore.replace(/ sepia\((.*?)\)/g,''), '');
			}
			body.removeClass("yp-inserting");
			return false;
		}
		
		// Transform Settings
		if(id.indexOf("-transform") != -1 && id != 'text-transform'){
			
			body.addClass("yp-has-transform");
			
			if(iframe.find('.' + yp_id(selector) + '-transform-style').length > 0){
				var $transformBefore = iframe.find('.' + yp_id(selector) + '-transform-style').html()
			
				// Fix responsive bug
				if($transformBefore.indexOf("@media") != -1){

					$transformBefore = $transformBefore.match(/{(.*)}/g).toString().replace(/{(.*)}/g,"$1").split(":")[1].split("}")[0];

				}else{

					$transformBefore = $transformBefore.split(":")[1].split("}")[0];

				}

			}else{
				var $transformBefore = '';
			}
			
			prefix = '';
			
		}
		
		// Scale transfrom
		if(id == 'scale-transform'){
			if($transformBefore.indexOf("scale") == -1){
				// Add new
				yp_insert_rule(selector, 'transform', 'transform', $transformBefore+" scale("+yp_num(value)+")", prefix);
			}else if(value != 'disable' && value != '' && value != 'undefined' && value != null){
				// Replace with ex.
				$transformBefore = $transformBefore.replace(/scale\((.*?)\)/g,'scale('+yp_num(value)+')');
				yp_insert_rule(selector, 'transform', 'transform', $transformBefore, prefix);
			}else{
				yp_insert_rule(selector, 'transform', 'transform', $transformBefore.replace(/ scale\((.*?)\)/g,''), '');
			}
			body.removeClass("yp-inserting");
			return false;
		}
		
		// Rotate Transform
		if(id == 'rotate-transform'){
			if($transformBefore.indexOf("rotate") == -1){
				// Add new
				yp_insert_rule(selector, 'transform', 'transform', $transformBefore+" rotate("+yp_num(value)+"deg)", prefix);
			}else if(value != 'disable' && value != '' && value != 'undefined' && value != null){
				// Replace with ex.
				$transformBefore = $transformBefore.replace(/rotate\((.*?)\)/g,'rotate('+yp_num(value)+'deg)');
				yp_insert_rule(selector, 'transform', 'transform', $transformBefore, prefix);
			}else{
				yp_insert_rule(selector, 'transform', 'transform', $transformBefore.replace(/ rotate\((.*?)\)/g,''), '');
			}
			body.removeClass("yp-inserting");
			return false;
		}
		
		// Translate transform
		if(id == 'translate-x-transform'){
			if($transformBefore.indexOf("translateX") == -1){
				// Add new
				yp_insert_rule(selector, 'transform', 'transform', $transformBefore+" translateX("+yp_num(value)+"px)", prefix);
			}else if(value != 'disable' && value != '' && value != 'undefined' && value != null){
				// Replace with ex.
				$transformBefore = $transformBefore.replace(/translateX\((.*?)\)/g,'translateX('+yp_num(value)+'px)');
				yp_insert_rule(selector, 'transform', 'transform', $transformBefore, prefix);
			}else{
				yp_insert_rule(selector, 'transform', 'transform', $transformBefore.replace(/ translateX\((.*?)\)/g,''), '');
			}
			body.removeClass("yp-inserting");
			return false;
		}
		
		// Translate transform
		if(id == 'translate-y-transform'){
			if($transformBefore.indexOf("translateY") == -1){
				// Add new
				yp_insert_rule(selector, 'transform', 'transform', $transformBefore+" translateY("+yp_num(value)+"px)", prefix);
			}else if(value != 'disable' && value != '' && value != 'undefined' && value != null){
				// Replace with ex.
				$transformBefore = $transformBefore.replace(/translateY\((.*?)\)/g,'translateY('+yp_num(value)+'px)');
				yp_insert_rule(selector, 'transform', 'transform', $transformBefore, prefix);
			}else{
				yp_insert_rule(selector, 'transform', 'transform', $transformBefore.replace(/ translateY\((.*?)\)/g,''), '');
			}
			body.removeClass("yp-inserting");
			return false;
		}
		
		// Skew transform
		if(id == 'skew-x-transform'){
			if($transformBefore.indexOf("skewX") == -1){
				// Add new
				yp_insert_rule(selector, 'transform', 'transform', $transformBefore+" skewX("+yp_num(value)+"deg)", prefix);
			}else if(value != 'disable' && value != '' && value != 'undefined' && value != null){
				// Replace with ex.
				$transformBefore = $transformBefore.replace(/skewX\((.*?)\)/g,'skewX('+yp_num(value)+'deg)');
				yp_insert_rule(selector, 'transform', 'transform', $transformBefore, prefix);
			}else{
				yp_insert_rule(selector, 'transform', 'transform', $transformBefore.replace(/ skewX\((.*?)\)/g,''), '');
			}
			body.removeClass("yp-inserting");
			return false;
		}
		
		// Skew transform
		if(id == 'skew-y-transform'){
			if($transformBefore.indexOf("skewY") == -1){
				// Add new
				yp_insert_rule(selector, 'transform', 'transform', $transformBefore+" skewY("+yp_num(value)+"deg)", prefix);
			}else if(value != 'disable' && value != '' && value != 'undefined' && value != null){
				// Replace with ex.
				$transformBefore = $transformBefore.replace(/skewY\((.*?)\)/g,'skewY('+yp_num(value)+'deg)');
				yp_insert_rule(selector, 'transform', 'transform', $transformBefore, prefix);
			}else{
				yp_insert_rule(selector, 'transform', 'transform', $transformBefore.replace(/ skewY\((.*?)\)/g,''), '');
			}
			body.removeClass("yp-inserting");
			return false;
		}
		
		// Box Shadow
		if(id == 'box-shadow-inset' || id == 'box-shadow-color' || id == 'box-shadow-vertical' || id == 'box-shadow-blur-radius' || id == 'box-shadow-spread' || id == 'box-shadow-horizontal'){
			
			if(iframe.find('.' + yp_id(selector) + '-box-shadow-style').length > 0){
				var shadowData = iframe.find('.' + yp_id(selector) + '-box-shadow-style').html();

				// Fix responsive bug
				if(shadowData.indexOf("@media") != -1){

					shadowData = shadowData.match(/{(.*)}/g).toString().replace(/{(.*)}/g,"$1").split(":")[1].split("}")[0];

				}else{

					shadowData = shadowData.split(":")[1].split("}")[0];

				}

			}else{
				var color = $("#yp-box-shadow-color").val();
				var shadowData = '0px 0px 0px 0px '+color;
			}
			
			prefix = '';
			
		}
		
		// Box shadow options
		if(id.indexOf("box-shadow-") != -1){
			
			var shadowType = id.replace("box-shadow-","");

			if(shadowType == "horizontal"){

				var lastF = '';
				if(shadowData.indexOf("inset") != -1){
					lastF = ' inset';
				}
				
				if(value != 'disable' && valCon != 'none' && value != '' && value != null){

					shadowData = value+"px"+" "+shadowData.split(" ")[1]+" "+shadowData.split(" ")[2]+" "+shadowData.split(" ")[3]+" "+shadowData.split(" ")[4]+" "+shadowData.split(" ")[5]+lastF;
					
				}else{
					shadowData = "0px"+" "+shadowData.split(" ")[1]+" "+shadowData.split(" ")[2]+" "+shadowData.split(" ")[3]+" "+shadowData.split(" ")[4]+" "+shadowData.split(" ")[5]+lastF;
				}

				shadowData = shadowData.replace(/undefined/g,'');
				shadowData = $.trim(shadowData.replace(/  /g,' '));
				shadowData = shadowData.replace(/inset inset/g, 'inset');


				yp_insert_rule(selector, 'box-shadow', 'box-shadow', shadowData, prefix);
				body.removeClass("yp-inserting");
				return false;
			}
			
			if(shadowType == "vertical"){

				var lastF = '';
				if(shadowData.indexOf("inset") != -1){
					lastF = ' inset';
				}
				
				if(value != 'disable' && valCon != 'none' && value != '' && value != null){

					shadowData = shadowData.split(" ")[0]+" "+value+"px"+" "+shadowData.split(" ")[2]+" "+shadowData.split(" ")[3]+" "+shadowData.split(" ")[4]+" "+shadowData.split(" ")[5]+lastF;
					
				}else{
					shadowData = shadowData.split(" ")[0]+" 0px"+" "+shadowData.split(" ")[2]+" "+shadowData.split(" ")[3]+" "+shadowData.split(" ")[4]+" "+shadowData.split(" ")[5]+lastF;
				}

				shadowData = shadowData.replace(/undefined/g,'');
				shadowData = $.trim(shadowData.replace(/  /g,' '));
				shadowData = shadowData.replace(/inset inset/g, 'inset');
				
				yp_insert_rule(selector, 'box-shadow', 'box-shadow', shadowData, prefix);
				body.removeClass("yp-inserting");
				return false;
			}
			
			if(shadowType == "blur-radius"){

				var lastF = '';
				if(shadowData.indexOf("inset") != -1){
					lastF = ' inset';
				}
				
				if(value != 'disable' && valCon != 'none' && value != '' && value != null){
					
					shadowData = shadowData.split(" ")[0]+" "+shadowData.split(" ")[1]+" "+value+"px"+" "+shadowData.split(" ")[3]+" "+shadowData.split(" ")[4]+" "+shadowData.split(" ")[5]+lastF;
					
				}else{
					shadowData = shadowData.split(" ")[0]+" "+shadowData.split(" ")[1]+" 0px"+" "+shadowData.split(" ")[3]+" "+shadowData.split(" ")[4]+" "+shadowData.split(" ")[5]+lastF;
				}

				shadowData = shadowData.replace(/undefined/g,'');
				shadowData = $.trim(shadowData.replace(/  /g,' '));
				shadowData = shadowData.replace(/inset inset/g, 'inset');
				
				yp_insert_rule(selector, 'box-shadow', 'box-shadow', shadowData, prefix);
				body.removeClass("yp-inserting");
				return false;
			}
			
			if(shadowType == "spread"){

				var lastF = '';
				if(shadowData.indexOf("inset") != -1){
					lastF = ' inset';
				}
				
				if(value != 'disable' && valCon != 'none' && value != '' && value != null){
					
					shadowData = shadowData.split(" ")[0]+" "+shadowData.split(" ")[1]+" "+shadowData.split(" ")[2]+" "+value+"px"+" "+shadowData.split(" ")[4]+" "+shadowData.split(" ")[5]+lastF;
					
				}else{
					shadowData = shadowData.split(" ")[0]+" "+shadowData.split(" ")[1]+" "+shadowData.split(" ")[2]+" 0px"+" "+shadowData.split(" ")[4]+" "+shadowData.split(" ")[5]+lastF;
				}

				shadowData = shadowData.replace(/undefined/g,'');
				shadowData = $.trim(shadowData.replace(/  /g,' '));
				shadowData = shadowData.replace(/inset inset/g, 'inset');
				
				yp_insert_rule(selector, 'box-shadow', 'box-shadow', shadowData, prefix);
				body.removeClass("yp-inserting");
				return false;
			}
			
			if(shadowType == "color"){

				var lastF = '';
				if(shadowData.indexOf("inset") != -1){
					lastF = ' inset';
				}
				
				if(value != 'disable' && valCon != 'none' && value != '' && value != null){
					
					if(shadowData.indexOf("#") == -1){
						shadowData = shadowData + " " + value;
					}else{
						
						shadowData = shadowData.split("#")[0] + " " + value+lastF;
						
						shadowData = shadowData.replace(/undefined/g,'');
						shadowData = $.trim(shadowData.replace(/  /g,' '));
						shadowData = shadowData.replace(/inset inset/g, 'inset');
						
					}
					
				}else{

					if(shadowData.indexOf("#") == -1){
						shadowData = shadowData + " " + value;
					}else{
						
						var color = $("#yp-box-shadow-color").val();
						shadowData = shadowData.split("#")[0] + " " + color+lastF;
						
						shadowData = shadowData.replace(/undefined/g,'');
						shadowData = $.trim(shadowData.replace(/  /g,' '));
						shadowData = shadowData.replace(/inset inset/g, 'inset');
						
					}

				}

				if(shadowData.indexOf("transparent") != -1){
					yp_insert_rule(selector, 'box-shadow', 'box-shadow', "none", prefix);
					body.removeClass("yp-inserting");
					return false;
				}
				
				yp_insert_rule(selector, 'box-shadow', 'box-shadow', shadowData, prefix);
				body.removeClass("yp-inserting");
				return false;
			}
			
			if(shadowType == "inset"){
				
				if(value == 'inset' && shadowData.indexOf("inset") == -1){
					shadowData = shadowData+" inset";
				}else{
					shadowData = shadowData.replace(" inset",'').replace(" inset",'');
				}
				
				shadowData = shadowData.replace(/undefined/g,'');
				shadowData = $.trim(shadowData.replace(/  /g,' '));
				shadowData = shadowData.replace(/inset inset/g, 'inset');

				yp_insert_rule(selector, 'box-shadow', 'box-shadow', shadowData, prefix);
				body.removeClass("yp-inserting");
				return false;
			}
			
		}
		// Box shadow options end

		// Animation options
		if(id == 'animation-play'){
			
			iframe.find("[data-style]").each(function(){
					
				var classes = null;
				var $style = null;
				var data = null;
				
				// onscreen
				if($(this).data("style") == yp_id(selector)+"yp_onscreen"){
					$(this).remove();
				}
				
				// hover
				if($(this).data("style") == yp_id(selector)+"yp_hover"){
					$(this).remove();
				}
				
				// click
				if($(this).data("style") == yp_id(selector)+"yp_click"){
					$(this).remove();
				}
				
				// click
				if($(this).data("style") == yp_id(selector)+"yp_focus"){
					$(this).remove();
				}

			});
				
			yp_insert_rule(selector, 'animation-name', 'animation-name', $("#yp-animation-name").val(), prefix);
			
			body.removeClass("yp-inserting");
			return false;
			
		}
		
		// Animation name
		if(id == 'animation-name'){

			if(value != 'disable' && value != 'none'){
				yp_insert_rule(selector, 'animation-fill-mode', 'animation-fill-mode', 'both', prefix);
				yp_insert_rule(selector, 'animation-duration', 'animation-duration', '1s', prefix);
			}else{
				yp_insert_rule(selector, 'animation-fill-mode', 'animation-fill-mode', value, prefix);
				yp_insert_rule(selector, 'animation-duration', 'animation-duration', value, prefix);
			}
			
			if(valCon == 'bounce'){

				if(value != 'disable' && value != 'none'){
					yp_insert_rule(selector, 'transform-origin', 'transform-origin', 'center bottom', prefix);
				}else{
					yp_insert_rule(selector, 'transform-origin', 'transform-origin', value, prefix);
				}

				
			}else if(valCon == 'swing'){
				
				if(value != 'disable' && value != 'none'){
					yp_insert_rule(selector, 'transform-origin', 'transform-origin', 'top center', prefix);
				}else{
					yp_insert_rule(selector, 'transform-origin', 'transform-origin', value, prefix);
				}

			}else if(valCon == 'jello'){
				
				if(value != 'disable' && value != 'none'){
					yp_insert_rule(selector, 'transform-origin', 'transform-origin', 'center', prefix);
				}else{
					yp_insert_rule(selector, 'transform-origin', 'transform-origin', value, prefix);
				}

			}else{
				yp_insert_rule(selector, 'transform-origin', 'transform-origin', 'disable', prefix);
			}
			
			if(valCon == 'flipInX'){
				yp_insert_rule(selector, 'backface-visibility', 'backface-visibility', 'visible', prefix);
			}else{
				yp_insert_rule(selector, 'backface-visibility', 'backface-visibility', 'disable', prefix);
			}
		
		}
		
		// Responsive setting
		var mediaBefore = '';
		var mediaAfter = '';
			
		if($(".responsive-selector.active").data("mode") == 'mobile'){
			mediaBefore = '@media (max-width:767px){';
			mediaAfter = '}';
		}
			
		if($(".responsive-selector.active").data("mode") == 'tablet'){
			mediaBefore = '@media (min-width: 768px) and (max-width: 991px){';
			mediaAfter = '}';
		}

		// Checking.
		if (value == 'disable' || value == '' || value == 'undefined' || value == null) {
			body.removeClass("yp-inserting");
			return false;
		}

		// New Value
		var current = value + prefix;

		// Clean.
		if(body.hasClass("yp-css-converter") == false){
			current = current.replace(/ !important/g, "").replace(/!important/g, "");
		}

		if(id == 'box-shadow'){
			var color = $("#yp-box-shadow-color").val();
			if(current == '0px 0px 0px 0px '+color){
				body.removeClass("yp-inserting");
				return false;
			}
		}

		// Append default value.
		if(yp_id(selector) != ''){
			iframe.find(".yp-styles-area").append('<style data-size-mode="'+$(".responsive-selector.active").data("mode")+'" data-style="' + yp_id(selector) + '" class="' + yp_id(selector) + '-' + id + '-style yp_current_styles">'+mediaBefore+'' + '' + selector + '{' + css + ':' + current + '}' + ''+mediaAfter+'</style>');

			if(!body.hasClass("yp-css-converter")){
				yp_draw();
			}
		}

		// If CSS converter, stop here.
		if(body.hasClass("yp-css-converter")){
			body.removeClass("yp-inserting");
			return false;
		}

			// No need to important for text-shadow.
			if(id == 'text-shadow'){
				body.removeClass("yp-inserting");
				return false;
			}

			// Current Value
			var isValue = iframe.find(".yp-selected").css(css);

			// If current value not undefined
			if(isValue !== undefined && isValue !== null){
				
				// for color
				if (isValue.indexOf("rgb") != -1 && id != 'box-shadow') {

					// Convert to hex.
					isValue = rgb2hex(isValue);

				}else if(isValue.indexOf("rgb") != -1 && id == 'box-shadow'){

					// for box shadow.
					var justRgb = isValue.match(/rgb(.*?)\((.*?)\)/g).toString();
					var valueNoColor = isValue.replace(/rgb(.*?)\((.*?)\)/g,"");
					isValue = valueNoColor+" "+rgb2hex(justRgb);

				}

				// Clean
				isValue = isValue.replace(" ","");

			}
				
			// Clean
			current = current.replace(" ","");
					
			// false/true
			var $is_important = false;
						
			// If has attr, use important.
			iframe.find(selector).each(function(){
				
				var attr = $(this).attr('style');

				if (typeof attr !== typeof undefined && attr !== false){
					if($(this).attr("style").indexOf(css) >= 0){
						$is_important = true;
					}
				}
				
			});

			// If date mean same thing: stop.
			if(yp_id(current) == 'length' && yp_id(isValue) == 'autoauto'){
				body.removeClass("yp-inserting");
				return false;
			}

			if(yp_id(current) == 'inherit' && yp_id(isValue) == 'normal'){
				body.removeClass("yp-inserting");
				return false;
			}

			// No need important for parallax and filter.
			if(id == 'background-parallax' || id == 'background-parallax-x' || id == 'background-parallax-speed' || id == 'filter' || id == '-webkit-filter' || id == '-webkit-transform'){
				body.removeClass("yp-inserting");
				return false;
			}

			// If value is similar.
			if (yp_num(current.replace(".00","").replace(".0","")) !== '' && yp_num(current.replace(".00","").replace(".0","")) !== ' ' && yp_num(current.replace(".00","").replace(".0","")).substring(0, 2) ==  yp_num(isValue.replace(".00","").replace(".0","")).substring(0, 2)){
				body.removeClass("yp-inserting");
				return false;
			}

			// if value is same, stop.
			if ((current) == (isValue) && $is_important != true){
				body.removeClass("yp-inserting");
				return false;
			}

			// font-family bug.
			if ((current.replace(/'/g,'"').replace(/, /g,",")) == isValue && $is_important != true){
				body.removeClass("yp-inserting");
				return false;
			}

			// background position fix.
			if(id == 'background-position'){

				if(current == 'lefttop' && isValue == '0%0%'){
					body.removeClass("yp-inserting");
					return false;
				}

				if(current == 'leftcenter' && isValue == '0%50%'){
					body.removeClass("yp-inserting");
					return false;
				}

				if(current == 'leftbottom' && isValue == '0%100%'){
					body.removeClass("yp-inserting");
					return false;
				}

				if(current == 'righttop' && isValue == '100%0%'){
					body.removeClass("yp-inserting");
					return false;
				}

				if(current == 'rightcenter' && isValue == '100%50%'){
					body.removeClass("yp-inserting");
					return false;
				}

				if(current == 'rightbottom' && isValue == '100%100%'){
					body.removeClass("yp-inserting");
					return false;
				}

				if(current == 'centertop' && isValue == '50%0%'){
					body.removeClass("yp-inserting");
					return false;
				}

				if(current == 'centercenter' && isValue == '50%50%'){
					body.removeClass("yp-inserting");
					return false;
				}

				if(current == 'centercenter' && isValue == '50%50%'){
					body.removeClass("yp-inserting");
					return false;
				}

				if(current == 'centerbottom' && isValue == '50%100%'){
					body.removeClass("yp-inserting");
					return false;
				}

				if(current == 'centerbottom' && isValue == '50%100%'){
					body.removeClass("yp-inserting");
					return false;
				}

			}


		if(id == 'width' || id == 'min-width' || id == 'max-width' || id == 'height' || id == 'min-height' || id == 'max-height' || id == 'font-size' || id == 'line-height' || id == 'letter-spacing' || id == 'word-spacing' || id == 'margin-top' || id == 'margin-left' || id == 'margin-right' || id == 'margin-bottom' || id == 'padding-top' || id == 'padding-left' || id == 'padding-right' || id == 'padding-bottom' || id == 'border-left-width' || id == 'border-right-width' || id == 'border-top-width' || id == 'border-bottom-width' || id == 'border-top-left-radius' || id == 'border-top-right-radius' || id == 'border-bottom-left-radius' || id == 'border-bottom-right-radius'){

			// Browser always return in px format, custom check for %, em.
			if(current.indexOf("%") != -1 && isValue.indexOf("px") != -1){

				iframe.find(".yp-selected").addClass("yp-full-width");
				var fullWidth = iframe.find(".yp-full-width").css("width");
				iframe.find(".yp-selected").removeClass("yp-full-width");

				if(parseInt(parseInt(fullWidth)*parseInt(current)/100) == parseInt(isValue)){
					body.removeClass("yp-inserting");
					return false;
				}

			}

			// smart important not available for em format
			if(current.indexOf("em") != -1 && isValue.indexOf("px") != -1){
				body.removeClass("yp-inserting");
				return false;
			}

		}

		// not use important, if browser return value with matrix.
		if(id == "transform"){
			if(isValue.indexOf("matrix") != -1){
				body.removeClass("yp-inserting");
				return false;
			}
		}

		// not use important, If value is inherit.
		if(current == "inherit" || current == "auto"){
			body.removeClass("yp-inserting");
			return false;
		}

		// Use important.
		yp_insert_important_rule(selector, id, css, value, prefix);

		// Update
		yp_draw();

		body.removeClass("yp-inserting");

	}

	// border style disable toggerher.
	$("#border-style-group .yp-disable-btn").on("click",function(e){

		if(e.originalEvent){

			$("#border-top-style-group,#border-left-style-group,#border-right-style-group,#border-bottom-style-group").addClass("eye-enable");

			if($(this).hasClass("active") == true){

				$("#border-top-style-group .yp-disable-btn,#border-right-style-group .yp-disable-btn,#border-left-style-group .yp-disable-btn,#border-bottom-style-group .yp-disable-btn,#border-top-style-group .yp-disable-btn").addClass("active").trigger("click");

			}else{


				$("#border-top-style-group .yp-disable-btn,#border-right-style-group .yp-disable-btn,#border-left-style-group .yp-disable-btn,#border-bottom-style-group .yp-disable-btn,#border-top-style-group .yp-disable-btn").removeClass("active").trigger("click");

			}

		}

	});

	// border width disable toggerher.
	$("#border-width-group .yp-disable-btn").on("click",function(e){

		if(e.originalEvent){

			$("#border-top-width-group,#border-left-width-group,#border-right-width-group,#border-bottom-width-group").addClass("eye-enable");

			if($(this).hasClass("active") == true){

				$("#border-top-width-group .yp-disable-btn,#border-right-width-group .yp-disable-btn,#border-left-width-group .yp-disable-btn,#border-bottom-width-group .yp-disable-btn,#border-top-width-group .yp-disable-btn").addClass("active").trigger("click");

			}else{

				$("#border-top-width-group .yp-disable-btn,#border-right-width-group .yp-disable-btn,#border-left-width-group .yp-disable-btn,#border-bottom-width-group .yp-disable-btn,#border-top-width-group .yp-disable-btn").removeClass("active").trigger("click");

			}

		}

	});


	// border color disable toggerher.
	$("#border-color-group .yp-disable-btn").on("click",function(e){

		if(e.originalEvent){

			$("#border-top-color-group,#border-left-color-group,#border-right-color-group,#border-bottom-color-group").addClass("eye-enable");

			if($(this).hasClass("active") == true){

				$("#border-top-color-group .yp-disable-btn,#border-right-color-group .yp-disable-btn,#border-left-color-group .yp-disable-btn,#border-bottom-color-group .yp-disable-btn,#border-top-color-group .yp-disable-btn").addClass("active").trigger("click");

			}else{

				$("#border-top-color-group .yp-disable-btn,#border-right-color-group .yp-disable-btn,#border-left-color-group .yp-disable-btn,#border-bottom-color-group .yp-disable-btn,#border-top-color-group .yp-disable-btn").removeClass("active").trigger("click");

			}

		}

	});

	// Border style none toggle
	$("#border-style-group .yp-none-btn").on("click",function(){

		if(!$(this).hasClass("active")){
			$("#border-bottom-style-group .yp-none-btn,#border-right-style-group .yp-none-btn,#border-left-style-group .yp-none-btn,#border-top-style-group .yp-none-btn").removeClass("active");
		}else{
			$("#border-bottom-style-group .yp-none-btn,#border-right-style-group .yp-none-btn,#border-left-style-group .yp-none-btn,#border-top-style-group .yp-none-btn").addClass("active");
		}

		$("#border-bottom-style-group .yp-none-btn,#border-right-style-group .yp-none-btn,#border-left-style-group .yp-none-btn,#border-top-style-group .yp-none-btn").trigger("click");

	});


	// Border color none toggle
	$("#border-color-group .yp-none-btn").on("click",function(){

		if(!$(this).hasClass("active")){
			$("#border-bottom-color-group .yp-none-btn,#border-right-color-group .yp-none-btn,#border-left-color-group .yp-none-btn,#border-top-color-group .yp-none-btn").removeClass("active");
		}else{
			$("#border-bottom-color-group .yp-none-btn,#border-right-color-group .yp-none-btn,#border-left-color-group .yp-none-btn,#border-top-color-group .yp-none-btn").addClass("active");
		}

		$("#border-bottom-color-group .yp-none-btn,#border-right-color-group .yp-none-btn,#border-left-color-group .yp-none-btn,#border-top-color-group .yp-none-btn").trigger("click");

	});


    /* ---------------------------------------------------- */
    /* Setup Slider Option			 						*/
    /* ---------------------------------------------------- */
    function yp_slider_option(id, decimals, pxv, pcv, emv) {

        // Set Maximum and minimum values for custom prefixs.
        $("#" + id + "-group").data("px-range", pxv);
        $("#" + id + "-group").data("pc-range", pcv);
        $("#" + id + "-group").data("em-range", emv);

        // Default PX
        var range = $("#" + id + "-group").data("px-range").split(",");

        // Update PX.
        if ($("#" + id + "-group .yp-after-prefix").val() == 'px') {
            var range = $("#" + id + "-group").data("px-range").split(",");
        }

        // Update %.
        if ($("#" + id + "-group .yp-after-prefix").val() == '%') {
            var range = $("#" + id + "-group").data("pc-range").split(",");
        }

        // Update EM.
        if ($("#" + id + "-group .yp-after-prefix").val() == 'em') {
            var range = $("#" + id + "-group").data("em-range").split(",");
        }
		

        // Setup slider.
        $('#yp-' + id).wqNoUiSlider({

            start: [0],

            range: {
                'min': parseInt(range[0]),
                'max': parseInt(range[1])
            },

            format: wNumb({
                mark: '.',
                decimals: decimals
            })


        }).Link('lower').to($('#' + id + '-value')).on('change', function() {

            yp_slide_action($(this), id, true);

        }).Link('lower').to($('#' + id + '-value')).on('slide', function() {

        	// some rules not support live css, so we check some rules.
        	if(id != 'background-parallax-speed' && id != 'background-parallax-x' && id != 'blur-filter' && id != 'grayscale-filter' && id != 'brightness-filter' && id != 'contrast-filter' && id != 'hue-rotate-filter'&& id != 'saturate-filter' && id != 'sepia-filter' && id.indexOf("box-shadow-") == -1){

        		// if transfrom
        		if(id.indexOf("-transform") != -1 && id != 'text-transform' && id != '-webkit-transform'){

        			yp_slide_action($(this), id, true);

        		}else{ // if not

					var val = $(this).val();
					var prefix = $(this).parent().find("#" + id + "-after").val();
					yp_clean_live_css(id,false);
			        yp_live_css(id,val+prefix,false);

		        }

	    	}else{ // for make it as live, inserting css to data.
	    		yp_slide_action($(this), id, true);
	    	}

        });

    }




    /* ---------------------------------------------------- */
    /* Slider Event					 						*/
    /* ---------------------------------------------------- */
    function yp_slide_action(element, id, $slider){

        var css = element.parent().parent().data("css");
        element.parent().parent().addClass("eye-enable");

        if ($slider == true) {

            var val = element.val();

            // If active, disable it.
            element.parent().parent().find(".yp-btn-action.active").trigger("click");

        } else {

            var val = element.parent().find("#" + css + "-value").val();

        }

        var selector = yp_get_current_selector();
        var css_after = element.parent().find("#" + css + "-after").val();


        // Border Width Fix
        if (id == 'border-width') {

 			// Set border width to all top, right..
			if(css_after != $("#border-top-width-after").val()){
				$("#border-top-width-after").val(css_after).trigger("keyup");
			}
			if(css_after != $("#border-right-width-after").val()){
				$("#border-right-width-after").val(css_after).trigger("keyup");
			}
			if(css_after != $("#border-bottom-width-after").val()){
				$("#border-bottom-width-after").val(css_after).trigger("keyup");
			}
			if(css_after != $("#border-right-width-after").val()){
				$("#border-right-width-after").val(css_after).trigger("keyup");
			}
			

            // Value
            $("#yp-border-top-width,#yp-border-bottom-width,#yp-border-left-width,#yp-border-right-width").val(val);

            // disable
            $("#border-top-width-group .yp-disable-btn.active,#border-right-width-group .yp-disable-btn.active,#border-bottom-width-group .yp-disable-btn.active,#border-left-width-group .yp-disable-btn.active").trigger("click");


            // set solid for default.
            if($('input[name="border-style"]:checked').val() == 'none' || $('input[name="border-style"]:checked').val() === undefined || $('input[name="border-style"]:checked').val() == 'hidden'){
	            $("#border-style-solid").trigger("click");
            }

            // update CSS
            yp_insert_rule(selector, 'border-top-width', 'border-top-width', val, css_after);
            yp_insert_rule(selector, 'border-bottom-width', 'border-bottom-width', val, css_after);
            yp_insert_rule(selector, 'border-left-width', 'border-left-width', val, css_after);
            yp_insert_rule(selector, 'border-right-width', 'border-right-width', val, css_after);

            // add eye icon
            $("#border-top-width-group,#border-left-width-group,#border-right-width-group,#border-bottom-width-group").addClass("eye-enable");

        }


        if (id != 'border-width') {

            // Set for demo
            yp_insert_rule(selector, id, css, val, css_after);

        }

        // Option Changed
        yp_option_change();

    }


    function yp_escape(s) {
	    return ('' + s) /* Forces the conversion to string. */
	        .replace(/\\/g, '\\\\') /* This MUST be the 1st replacement. */
	        .replace(/\t/g, '\\t') /* These 2 replacements protect whitespaces. */
	        .replace(/\n/g, '\\n')
	        .replace(/\u00A0/g, '\\u00A0') /* Useful but not absolutely necessary. */
	        .replace(/&/g, '\\x26') /* These 5 replacements protect from HTML/XML. */
	        .replace(/'/g, '\\x27')
	        .replace(/"/g, '\\x22')
	        .replace(/</g, '\\x3C')
	        .replace(/>/g, '\\x3E')
	        ;
	}


    /* ---------------------------------------------------- */
    /* Getting radio val.									*/
    /* ---------------------------------------------------- */
    function yp_radio_value(the_id, $n, data) {

        var id_prt = the_id.parent().parent();

        // for none btn
        id_prt.find(".yp-btn-action.active").trigger("click");

        if (data == id_prt.find(".yp-none-btn").text()) {
            id_prt.find(".yp-none-btn").trigger("click");
        }

        if (data == 'auto auto') {
            data = 'auto';
        }

        if (data != '' && typeof data != 'undefined') {

			if(data.match(/\bauto\b/g)){
				data = 'auto';
			}

			if(data.match(/\bnone\b/g)){
				data = 'none';
			}

            if ($("input[name=" + $n + "][value=" + yp_escape(data) + "]").length > 0) {

                the_id.find(".active").removeClass("active");

                $("input[name=" + $n + "][value=" + yp_escape(data) + "]").prop('checked', true).parent().addClass("active");

            } else {

                the_id.find(".active").removeClass("active");

                // Disable all.
                $("input[name=" + $n + "]").each(function() {

                    $(this).prop('checked', false);

                });

                id_prt.find(".yp-none-btn:not(.active)").trigger("click");

            }

        }

    }


    /* ---------------------------------------------------- */
    /* Radio Event					 						*/
    /* ---------------------------------------------------- */
    function yp_radio_option(id) {

        $("#yp-" + id + " label").on('click', function() {

        	if($(this).parent().hasClass("active")){
        		return false;
        	}

            var selector = yp_get_current_selector();
            var css = $(this).parent().parent().parent().parent().data("css");

            // Disable none.
            $(this).parent().parent().parent().parent().find(".yp-btn-action.active").removeClass("active");
            $(this).parent().parent().parent().parent().addClass("eye-enable").css("opacity",1);

            $("#yp-" + id).find(".active").removeClass("active");

            $(this).parent().addClass("active");

            $("#" + $(this).attr("data-for")).prop('checked', true);

            var val = $("input[name=" + id + "]:checked").val();

            // Border style fix.
            if (id == 'border-style'){

                yp_radio_value($("#yp-border-top-style"), 'border-top-style', val);
                yp_radio_value($("#yp-border-bottom-style"), 'border-bottom-style', val);
                yp_radio_value($("#yp-border-left-style"), 'border-left-style', val);
                yp_radio_value($("#yp-border-right-style"), 'border-right-style', val);

                // Update
                yp_insert_rule(selector, 'border-top-style', 'border-top-style', val, '');
                yp_insert_rule(selector, 'border-bottom-style', 'border-bottom-style', val, '');
                yp_insert_rule(selector, 'border-left-style', 'border-left-style', val, '');
                yp_insert_rule(selector, 'border-right-style', 'border-right-style', val, '');

                // add eye icon
                $("#border-top-style-group,#border-left-style-group,#border-right-style-group,#border-bottom-style-group").addClass("eye-enable");

            }


            if (id != 'border-style') {

                // Set for demo
                yp_insert_rule(selector, id, css, val, '');

            }

            // Option Changed
            yp_option_change();


        });

    }


    /* ---------------------------------------------------- */
    /* Check if is safe font family.						*/
    /* ---------------------------------------------------- */
    function yp_safe_fonts(a) {

        if (a == 'Arial') {
            return true;
        } else if (a == 'Arial Black') {
            return true;
        } else if (a == 'Arial Narrow') {
            return true;
        } else if (a == 'Arial Rounded MT Bold') {
            return true;
        } else if (a == 'Avant Garde') {
            return true;
        } else if (a == 'Calibri') {
            return true;
        } else if (a == 'Candara') {
            return true;
        } else if (a == 'Century Gothic') {
            return true;
        } else if (a == 'Franklin Gothic Medium') {
            return true;
        } else if (a == 'Futura') {
            return true;
        } else if (a == 'Geneva') {
            return true;
        } else if (a == 'Gill Sans') {
            return true;
        } else if (a == 'Helvetica Neue') {
            return true;
        } else if (a == 'Impact') {
            return true;
        } else if (a == 'Lucida Grande') {
            return true;
        } else if (a == 'Optima') {
            return true;
        } else if (a == 'Segoe UI') {
            return true;
        } else if (a == 'Tahoma') {
            return true;
        } else if (a == 'Trebuchet MS') {
            return true;
        } else if (a == 'Verdana') {
            return true;
        } else if (a == 'Big Caslon') {
            return true;
        } else if (a == 'Bodoni MT') {
            return true;
        } else if (a == 'Book Antiqua') {
            return true;
        } else if (a == 'Calisto MT') {
            return true;
        } else if (a == 'Cambria') {
            return true;
        } else if (a == 'Didot') {
            return true;
        } else if (a == 'Garamond') {
            return true;
        } else if (a == 'Georgia') {
            return true;
        } else if (a == 'Goudy Old Style') {
            return true;
        } else if (a == 'Hoefler Text') {
            return true;
        } else if (a == 'Lucida Bright') {
            return true;
        } else if (a == 'Palatino') {
            return true;
        } else if (a == 'Perpetua') {
            return true;
        } else if (a == 'Rockwell') {
            return true;
        } else if (a == 'Rockwell Extra Bold') {
            return true;
        } else if (a == 'Baskerville') {
            return true;
        } else if (a == 'Times New Roman') {
            return true;
        } else if (a == 'Consolas') {
            return true;
        } else if (a == 'Courier New') {
            return true;
        } else if (a == 'Lucida Console') {
            return true;
        } else if (a == 'HelveticaNeue') {
			return true;
		} else {
            return false;
        }

    }


    /* ---------------------------------------------------- */
    /* Warning System				 						*/
    /* ---------------------------------------------------- */

    /* For animations and display inline. */
    $(document).on("change", "#yp-animation-name,#yp-animation-play,#yp-animation-iteration-count", function(e){

    	if(!e.originalEvent){
    		return false;
    	}

    	if(iframe.find(".yp-selected").css("display") == "inline"){
    		$(this).parent().parent().popover({title: "Warning",content:l18_animation_notice,trigger:'click',placement:"left",container: ".yp-select-bar"}).popover("show");
    	}else{
    		$(this).parent().parent().popover("destroy");
    	}

    });

    // Margin not working because display inline.
    $("#margin-left-group,#margin-right-group,#margin-top-group,#margin-bottom-group").on("mouseenter click",function(e){

    	if(!e.originalEvent){
    		return false;
    	}

	    if(iframe.find(".yp-selected").css("display") == "inline" || iframe.find(".yp-selected").css("display") == "table-cell"){
		   	$(this).popover({title: "Warning",content:l18_margin_notice,trigger:'hover',placement:"left",container: ".yp-select-bar"}).popover("show");
		}else{
			$(this).popover("destroy");
		}

	});

    // Padding maybe not working, because display inline.
	$("#padding-left-group,#padding-right-group,#padding-top-group,#padding-bottom-group").on("mouseenter click",function(e){

		if(!e.originalEvent){
    		return false;
    	}

	    if(iframe.find(".yp-selected").css("display") == "inline"){
		   	$(this).popover({title: "Notice",content:l18_padding_notice,trigger:'hover',placement:"left",container: ".yp-select-bar"}).popover("show");
		}else{
			$(this).popover("destroy");
		}

	});

	// Border with must minimum 1px
	$("#border-width-group").on("mouseenter click",function(e){

		if(!e.originalEvent){
    		return false;
    	}

	    if(parseInt($("#border-width-value").val()) <= 0){
		   	$(this).popover({title: "Notice",content:l18_border_width_notice,trigger:'hover',placement:"left",container: ".yp-select-bar"}).popover("show");
		}else{
			$(this).popover("destroy");
		}

	});

	// There is background image, maybe background color not work
	$("#background-color-group").on("mouseenter click",function(e){

		if(!e.originalEvent){
    		return false;
    	}

	    if($("#yp-background-image").val() != ''){
		   	$(this).popover({title: "Notice",content:l18_bg_img_notice,trigger:'hover',placement:"left",container: ".yp-select-bar"}).popover("show");
		}else{
			$(this).popover("destroy");
		}

	});

	// There not have background image, parallax not work without background image.
	$(".background-parallax-div,#background-size-group,#background-repeat-group,#background-attachment-group,#background-position-group").on("mouseenter click",function(e){

		if(!e.originalEvent){
    		return false;
    	}

	    if($("#yp-background-image").val() == ''){
		   	$(this).popover({title: "Notice",content:l18_bg_img_notice_two,trigger:'hover',placement:"left",container: ".yp-select-bar"}).popover("show");
		}else{
			$(this).popover("destroy");
		}

	});
	
	// Box shadow need to any color.
	$("#box-shadow-color-group").on("mouseenter click",function(e){

		if(!e.originalEvent){
    		return false;
    	}

	    if($("#yp-box-shadow-color").val() == ''){
		   	$(this).popover({title: "Notice",content:l18_shadow_notice,trigger:'hover',placement:"left",container: ".yp-select-bar"}).popover("show");
		}else{
			$(this).popover("destroy");
		}

	});

	// Need border style set.
	$("#border-style-group").on("mouseenter click",function(e){

		if(!e.originalEvent){
    		return false;
    	}

	    if($("#yp-border-style input:checked").val() == 'hidden' || $("#yp-border-style input:checked").val() == 'none' || $("#yp-border-style input:checked").val() == undefined){
		   	$(this).popover({title: "Notice",content:l18_border_style_notice,trigger:'hover',placement:"left",container: ".yp-select-bar"}).popover("show");
		}else{
			$(this).popover("destroy");
		}

	});


	
	/* ---------------------------------------------------- */
    /* Select li hover				 						*/
    /* ---------------------------------------------------- */
	var timerL;
	var delay = 160;
	$(document).on("mouseover", ".wqselect2-results__options li", function() {
		
		var element = $(this);
			
		timerL = setTimeout(function() {
		
			// If not current.
			if(!element.hasClass("wqselect2-results__option--highlighted")){
				return false;
			}
			
			// If not undefined.
			if(typeof element.parent().attr("id") == 'undefined'){
				return false;
			}

			// Font weight
			if (element.parent().attr("id").replace("wqselect2-", "").replace("-results", "").replace("yp-", "") == 'font-weight' && element.text() != 'No results found') {

				yp_clean_live_css("font-weight","#yp-font-weight-test-style");
				yp_live_css("font-weight",yp_num(element.text()).replace("-",""),"#yp-font-weight-test-style");

			}

			
			// Font family
			if (element.parent().attr("id").replace("wqselect2-", "").replace("-results", "").replace("yp-", "") == 'font-family' && element.text() != 'No results found') {
		
				var $activeFont = iframe.find(".yp-font-test-style").data("family");
				
				yp_clean_live_css("font-family","#yp-font-test-style");
					
				var $fid = yp_id($.trim(element.text().replace(/ /g, '+')));

					if (yp_safe_fonts(element.text()) == false && iframe.find(".yp-font-test-" + $fid).length == 0 && $activeFont != element.text()) {

						var $weight = yp_num(iframe.find("#yp-font-weight").val());

						var $normal = '';
							
						if ($weight != '400') {
							$normal = '400,400italic';
						}
							
						if ($weight != '600') {
							$normal += ',600,600italic';
						}
							
						if ($weight != '300') {
							$normal += ',300';
						}
							
						$weight = $weight+","+$weight+"italic,"+$normal;
							
						$weight = $weight.replace(/,,/g,",");
							
						if (!isFontAvailable(element.text())) {
							iframeBody.append("<link rel='stylesheet' class='yp-font-test-" + $fid + "'  href='http://fonts.googleapis.com/css?family=" + $.trim(element.text().replace(/ /g, '+')) + ":"+$weight+"' type='text/css' media='all' />");
						}

						// Append always to body.
						body.append("<link rel='stylesheet' class='yp-font-test-" + $fid + "'  href='http://fonts.googleapis.com/css?family=" + $.trim(element.text().replace(/ /g, '+')) + ":"+$weight+"' type='text/css' media='all' />");
							
					}
					
					// Append test font family.
					yp_live_css('font-family',"'"+element.text()+"'","#yp-font-test-style");

					
					// Check font loaded.
					var $clearFix = setInterval(function() {

						// Send Update
						yp_draw();

					}, 150);

					setTimeout(function() {

						// clear.
						clearInterval($clearFix);

					}, 2000);
					

				element.css("font-family", element.text());

			}

			
		}, delay);

		// Font Weight
		if (element.parent().attr("id").replace("wqselect2-", "").replace("-results", "").replace("yp-", "") == 'font-weight') {

			$(".wqselect2-results__options li").each(function() {
				element.css("font-weight", yp_num(element.text()).replace(/-/g, ''));
			});

			$(".wqselect2-results__options li").css("font-family", $("#yp-font-family").val());
		}

		// Text shadow
		if (element.parent().attr("id").replace("wqselect2-", "").replace("-results", "").replace("yp-", "") == 'text-shadow'){

			$(".wqselect2-results__options li").each(function(){

				if($(this).text() == 'Basic Shadow'){
					$(this).css("text-shadow", 'rgba(0, 0, 0, 0.3) 0px 1px 1px');
				}

				if($(this).text() == 'Shadow Multiple'){
					$(this).css("text-shadow", 'rgb(255, 255, 255) 1px 1px 0px, rgb(170, 170, 170) 2px 2px 0px');
				}

				if($(this).text() == 'Anaglyph'){
					$(this).css("text-shadow", 'rgb(255, 0, 0) -1px 0px 0px, rgb(0, 255, 255) 1px 0px 0px');
				}

				if($(this).text() == 'Emboss'){
					$(this).css("text-shadow", 'rgb(255, 255, 255) 0px 1px 1px, rgb(0, 0, 0) 0px -1px 1px');
				}

				if($(this).text() == 'Neon'){
					$(this).css("text-shadow", 'rgb(255, 255, 255) 0px 0px 2px, rgb(255, 255, 255) 0px 0px 4px, rgb(255, 255, 255) 0px 0px 6px, rgb(255, 119, 255) 0px 0px 8px, rgb(255, 0, 255) 0px 0px 12px, rgb(255, 0, 255) 0px 0px 16px, rgb(255, 0, 255) 0px 0px 20px, rgb(255, 0, 255) 0px 0px 24px');
				}

				if($(this).text() == 'Outline'){
					$(this).css("text-shadow", 'rgb(0, 0, 0) 0px 1px 1px, rgb(0, 0, 0) 0px -1px 1px, rgb(0, 0, 0) 1px 0px 1px, rgb(0, 0, 0) -1px 0px 1px');
				}

			});

		}

	});

	
	// If mouseout, stop clear time out.
	$(document).on("mouseout", ".wqselect2-results__options li", function(){
		
		clearTimeout(timerL);
	
	});

	
	// Toggle options.
	$(".wf-close-btn-link").click(function(e){
		if($(".yp-editor-list > li.active:not(.yp-li-about):not(.yp-li-footer)").length > 0){
			e.preventDefault();
			$(".yp-editor-list > li.active:not(.yp-li-about):not(.yp-li-footer) > h3").trigger("click");
		}
	});
	

	/* Creating live CSS for color, slider and font-family and weight. */
	function yp_live_css(id,val,custom){

		// Responsive helper
		var mediaBefore = '';
		var mediaAfter = '';
						
		if($(".responsive-selector.active").data("mode") == 'mobile'){
			mediaBefore = '@media (max-width:767px){';
			mediaAfter = '}';
		}
						
		if($(".responsive-selector.active").data("mode") == 'tablet'){
			mediaBefore = '@media (min-width: 768px) and (max-width: 991px){';
			mediaAfter = '}';
		}

		// Style id
		if(custom != false){
			var styleId = custom;
		}else{
			var styleId = "#"+id+"-live-css";
		}

		//Element
		var element = iframe.find(styleId);

		// Check
		if(element.length == 0){

			var idAttr = styleId.replace('#','').replace('.','');

			var customAttr = '';

			// For font family.
			if(id == 'font-family'){
				var customAttr = "data-family='"+val+"'";
			}

			// not use prefix (px,em,% etc)
			if (id == 'z-index' || id == 'opacity') {
				val = parseFloat(val);
			}

			// Append
			iframeBody.append("<style data-size-mode='"+$(".responsive-selector.active").data("mode")+"' class='"+idAttr+" yp-live-css' id='"+idAttr+"' "+customAttr+">"+mediaBefore+".yp-selected,.yp-selected-others,"+yp_get_current_selector()+"{"+id+":"+val+" !important;}"+mediaAfter+"</style>");

		}

	}


	/* Removing created live CSS */
	function yp_clean_live_css(id,custom){

		// Style id
		if(custom != false){
			var styleId = custom;
		}else{
			var styleId = "#"+id+"-live-css";
		}

		var element = iframe.find(styleId);

		if(element.length > 0){
			element.remove();
		}

	}



    /* ---------------------------------------------------- */
    /* Select Event					 						*/
    /* ---------------------------------------------------- */
    function yp_select_option(id) {

    	// select on close
        $("#yp-" + id).on("wqselect2:close", function() {

            if (id == 'font-family') {
                yp_clean_live_css("font-family","#yp-font-test-style");
            }

            if (id == 'font-weight') {
                yp_clean_live_css("font-weight","#yp-font-weight-test-style");
            }

            setTimeout(function(){
            	body.removeClass("yp-select-open");
        	},400);

        });

        // select on close
        $("#yp-" + id).on("wqselect2:open", function() {

            body.addClass("yp-select-open");

        });

        // Select on change
        $("#yp-" + id).on('change', function() {
			
            if ($("#" + id + "-group .yp-setted-default").length > 0) {
                $("#" + id + "-group .yp-setted-default").removeClass("yp-setted-default");
                return false;
            }

            var selector = yp_get_current_selector()
            var css = $(this).parent().parent().data("css");

            // Disable
            $(this).parent().parent().find(".yp-btn-action.active").trigger("click");
            $("#" + id + "-group").addClass("eye-enable");


            // Import google font
            if (id == 'font-family' && $(this).val() != null && $(".wqselect2-container--open").length > 0) {

                if ($("#" + yp_id($(this).val())).length == 0) {

                	// Check if its not a safe font.
                    if (!yp_safe_fonts($(this).val())) {

                    	// be sure font not available.
						if (!isFontAvailable($(this).text())){
							
							// be sure its google font.
							if(yp_is_google_font($(this).text())){

								// Append font to DOM.
								iframeBody.append("<link rel='stylesheet' class='yp-font-link' id='" + yp_id($(this).val()) + "' href='http://fonts.googleapis.com/css?family=" + $.trim($(this).val().replace(/ /g, '+')) + ":300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' type='text/css' media='all' />");

							}

						}
						
                        yp_clean_live_css("font-family","#yp-font-test-style");

                        // Check if font loaded.
						var $clearFix = setInterval(function() {

							// Send Update
							yp_draw();


						}, 150);

						setTimeout(function() {

							// clear.
							clearInterval($clearFix);


						}, 2000);

                    }

                }

            }


            // Font weight.
            if (id == 'font-weight') {
                $("#" + id + "-group .wqselect2-selection__rendered").css(id, $(this).val()).css("font-family", $("#yp-font-family").val());
            }

            // Font family
            if (id == 'font-family') {
                $("#" + id + "-group .wqselect2-selection__rendered").css(id, $(this).val());
                $("#font-weight-group .wqselect2-selection__rendered").css("font-family", $("#yp-font-family").val());
            }


            // Animation name play.
            if(id == 'animation-name'){

				// Add class.
				iframeBody.addClass("yp-hide-borders-now");

				setTimeout(function() {

					// remove class.
					iframeBody.removeClass("yp-hide-borders-now");

					// Update.
					yp_draw();

				}, 1100);

			}


            // If open, update.
			if($(".wqselect2-container--open").length > 0){
				
				// Set for demo
				yp_insert_rule(selector, id, css, $(this).val(), '');

				yp_option_change();
			
			}

        });

    }


    // Iris color picker creating live css on mousemove
    mainDocument.on("mousemove", function(){

    	if($(".iris-dragging").length > 0){

			var element = $(".iris-dragging").parents(".yp-option-group");

			var css = element.data("css");
			var val = element.find(".wqcolorpicker").val();

			if(css.indexOf("box-shadow-color") == -1){

				yp_clean_live_css(css,false);
				yp_live_css(css,val,false);

    		}else{

				element.find(".wqcolorpicker").trigger("change");	

    		}

		}

		if($(".iris-slider").find(".ui-state-active").length > 0){

	    	var element = $(".iris-slider").find(".ui-state-active").parents(".yp-option-group");

			var css = element.data("css");
			var val = element.find(".wqcolorpicker").val();

			yp_clean_live_css(css,false);
			yp_live_css(css,val,false);

		}

	});

    
    // Iris color picker click update.
	$(".iris-square-handle").on("mouseup",function(){

		var element = $(this).parents(".yp-option-group");

		element.find(".wqcolorpicker").trigger("change");

	});
	

	// Iris color picker creating YP Data.
	mainDocument.on("mouseup", function(){

		if($(document).find(".iris-dragging").length > 0){

			var element = $(".iris-dragging").parents(".yp-option-group");

			element.find(".wqcolorpicker").trigger("change");
			

		}else if($(document).find(".iris-slider .ui-state-active").length > 0){

			var element = $(".ui-state-active").parents(".yp-option-group");

			element.find(".wqcolorpicker").trigger("change");

		}

	});




    /* ---------------------------------------------------- */
    /* Color Event					 						*/
    /* ---------------------------------------------------- */
    function yp_color_option(id){

    	// Color picker on blur
        $("#yp-" + id).on("blur", function(){

        	// If empty, set disable.
            if ($(this).val() == '') {
            	return false;
            }

        });

        // Show picker on click
        $("#yp-"+ id).on("click", function(){

        	$(this).parent().parent().find(".iris-picker").show();
        	$(this).parent().parent().parent().css("opacity",1);

        });

        // disable to true.
        $("#"+ id + "-group").find(".yp-after a").on("click",function(){
        	$(this).parent().parent().parent().css("opacity",1);
        });

        // Update on keyup
        $("#yp-"+ id).on("keydown keyup", function(){
			$(this).parent().find(".wqminicolors-swatch-color").css("background-color",$(this).val());
        });

        // Color picker on change
        $("#yp-" + id).on('change', function(){

            var selector = yp_get_current_selector();
            var css = $(this).parent().parent().parent().data("css");
            $(this).parent().parent().parent().addClass("eye-enable");
            var val = $(this).val();

            if (val.indexOf("#") == -1){
                val = "#" + val;
            }

            // Disable
            $(this).parent().parent().find(".yp-btn-action.active").trigger("click");
            $(this).parent().parent().find(".yp-after-disable,.yp-after-disable-disable").hide();


            // Border Color Fix
            if (id == 'border-color') {

                $("#yp-border-top-color").val(val);
                $("#yp-border-bottom-color").val(val);
                $("#yp-border-left-color").val(val);
                $("#yp-border-right-color").val(val);

                // set color
                $("#border-top-color-group .wqminicolors-swatch-color,#border-bottom-color-group .wqminicolors-swatch-color,#border-left-color-group .wqminicolors-swatch-color,#border-right-color-group .wqminicolors-swatch-color").css("background-color", val);

                // disable
            	$("#border-top-color-group .yp-disable-btn.active,#border-right-color-group .yp-disable-btn.active,#border-bottom-color-group .yp-disable-btn.active,#border-left-color-group .yp-disable-btn.active").trigger("click");

            	// none
            	$("#border-top-color-group .yp-none-btn.active,#border-right-color-group .yp-none-btn.active,#border-bottom-color-group .yp-none-btn.active,#border-left-color-group .yp-none-btn.active").trigger("click");

            	// Update
                yp_insert_rule(selector, 'border-top-color', 'border-top-color', val, '');
                yp_insert_rule(selector, 'border-bottom-color', 'border-bottom-color', val, '');
                yp_insert_rule(selector, 'border-left-color', 'border-left-color', val, '');
                yp_insert_rule(selector, 'border-right-color', 'border-right-color', val, '');

                // add eye icon
                $("#border-top-color-group,#border-left-color-group,#border-right-color-group,#border-bottom-color-group").addClass("eye-enable");

            }

            // If not border color.
            if (id != 'border-color') {

                // Set for demo
                yp_clean_live_css(css,false);

                //setTimeout(function(){
                	yp_insert_rule(selector, id, css, val, '');
            	//},10);

            }

            // Update.
            $(this).parent().find(".wqminicolors-swatch-color").css("background-image","none");

            // Option Changed
            yp_option_change();

		});

    }


    /* ---------------------------------------------------- */
    /* Input Event					 						*/
    /* ---------------------------------------------------- */
    function yp_input_option(id){

    	// Keyup
        $("#yp-" + id).on('keyup', function() {

        	$(this).parent().parent().addClass("eye-enable");

            var selector = yp_get_current_selector();
            var css = $(this).parent().parent().data("css");
            var val = $(this).val();

            // Disable
            $(this).parent().find(".yp-btn-action.active").trigger("click");

            if (val == 'none') {
                $(this).parent().parent().find(".yp-none-btn").not(".active").trigger("click");
                $(this).val('');
            }

            if (val == 'disable') {
                $(this).parent().parent().find(".yp-disable-btn").not(".active").trigger("click");
                $(this).val('');
            }

            val = val.replace(/\)/g,'').replace(/\url\(/g,'');

			$(this).val(val);
			
			if(id == 'background-image'){

				val = 'url(' + val + ')';

				$(".yp-background-image-show").remove();
				var imgSrc = val.replace(/"/g, "").replace(/'/g, "").replace(/url\(/g, "").replace(/\)/g, "");

				if(val.indexOf("yellow-pencil") == -1){

					if(imgSrc.indexOf("//") != -1 && imgSrc != '' && imgSrc.indexOf(".") != -1){
						$("#yp-background-image").after("<img src='"+imgSrc+"' class='yp-background-image-show' />");
					}

				}

			}

            // Set for demo

            yp_insert_rule(selector, id, css, val, '');

            // Option Changed
            yp_option_change();

        });


    }


    /* ---------------------------------------------------- */
    /* Remove data											*/
    /* ---------------------------------------------------- */
    function yp_clean() {

    	$(".yp-editor-list > li.active:not(.yp-li-about) > h3").trigger("click");

    	// destroy ex element draggable feature.
    	if(body.hasClass("yp-content-selected")){
    		iframe.find(".yp-selected").draggable( "destroy" );
    	}

    	iframe.find(".yp-selected,.yp-selected-others").removeClass("ui-draggable ui-draggable-handle ui-draggable-handle");

    	/* this function remove selected element */
		if (iframe.find(".context-menu-active").length > 0){
			iframe.find(".yp-selected").contextMenu("hide");
		}
	
		body.removeAttr("data-clickable-select").removeAttr("data-yp-selector").removeClass("yp-selector-focus").removeClass("yp-selector-hover").removeClass("yp-left-selected-resizeable");

        body.removeClass("yp-content-selected").removeClass("yp-body-select-just-it").removeClass("yp-has-transform");

        iframe.find(".yp-selected-others,.yp-selected").removeClass("yp-selected-others").removeClass("yp-selected");

        iframe.find(".ready-for-drag").removeClass("ready-for-drag");

        iframe.find(".yp-selected-handle,.yp-selected-others-top,.yp-selected-others-left,.yp-selected-others-right,.yp-selected-others-bottom,.yp-selected-tooltip,.yp-selected-boxed-top,.yp-selected-boxed-left,.yp-selected-boxed-right,.yp-selected-boxed-bottom,.yp-selected-boxed-margin-top,.yp-selected-boxed-margin-left,.yp-selected-boxed-margin-right,.yp-selected-boxed-margin-bottom,.selected-just-it-span").remove();
		
		iframe.find(".yp_onscreen").removeClass("yp_onscreen");
		iframe.find(".yp_hover").removeClass("yp_hover");
		iframe.find(".yp_click").removeClass("yp_click");
		iframe.find(".yp_focus").removeClass("yp_focus");

		iframe.find(".yp-live-css").remove();

		body.removeClass("yp-position-static yp-element-resizing yp-element-resizing-height-top yp-element-resizing-height-bottom yp-element-resizing-width-left yp-element-resizing-width-right");

		$(".eye-enable").removeClass("eye-enable");

		$(".yp-option-group").css("opacity","1");
		$(".yp-after").css("display","block");

		// delete ex cache data.
		$("li[data-loaded]").removeAttr("data-loaded");

    }


    /* ---------------------------------------------------- */
    /* Getting Stylizer data								*/
    /* ---------------------------------------------------- */
    function yp_get_styles_area() {
        return iframe.find(".yp-styles-area").html();
    }

	
	/* ---------------------------------------------------- */
    /* Getting CSS data										*/
    /* ---------------------------------------------------- */
	function yp_get_clean_css(){
		
		var data = yp_get_css_data('desktop')+"@media (min-width: 768px) and (max-width: 991px){"+yp_get_css_data('tablet')+"}"+"@media (max-width:767px){"+yp_get_css_data('mobile')+"}";
		
		// remove blank lines.
		data = data.replace("@media (max-width:767px){}","");
		data = data.replace("@media (min-width: 768px) and (max-width: 991px){}","");
		
		// Adding break
		data = data.replace(/\)\{/g,"){\r");
		data = data.replace(/\)\{/g,"){\r");

		data = data.replace(/nth-child\((.*?)\)\{\r\r/g,"nth-child\($1\)\{");

		data = data.replace("@media (max-width:767px){","\r\r@media (max-width:767px){");
		
		// add notes
		data = data.replace("@media (max-width:767px){","/* Mobile responsive support */\r@media (max-width:767px){");
		
		data = data.replace("@media (min-width: 768px) and (max-width: 991px){","/* Tablet responsive support */\r@media (min-width: 768px) and (max-width: 991px){");
		
		// Fix some bugs
		return data;
		
	}


    /* ---------------------------------------------------- */
    /* Create All Css Codes For current selector			*/
    /* ---------------------------------------------------- */
    function yp_get_css_data(size) {

        if (iframe.find(".yp_current_styles").length <= 0) {
            return '';
        }

        var $totalcreated, classes, $selector;

        $totalcreated = '';

        iframe.find(".yp_current_styles:not(.yp_step_end)[data-size-mode='"+size+"']").each(function() {

			if (!$(this).hasClass("yp_step_end")) {
				
				
				if(size == 'tablet' || size == 'mobile'){
					var data = $(this).first().html().split("{")[1]+"{"+$(this).first().html().split("{")[2].replace("}}","}");
				}
				
				if(size == 'desktop'){
					var data = $(this).first().html();
				}

				$selector = data.split("{")[0];

				$totalcreated += $selector + "{\r";

				classes = $(this).data("style");

				iframe.find("style[data-style=" + classes + "][data-size-mode='"+size+"']").each(function() {
	
					if(size == 'tablet' || size == 'mobile'){
						var datai = $(this).first().html().split("{")[1]+"{"+$(this).first().html().split("{")[2].replace("}}","}");
					}
					
					if(size == 'desktop'){
						var datai = $(this).first().html();
					}

					$totalcreated += "\t" + datai.split("{")[1].split("}")[0] + ';\r';

					$(this).addClass("yp_step_end");

				});

				$totalcreated += "}\r\r";

				$(this).addClass("yp_step_end");

			}
				
        });

        iframe.find(".yp_step_end").removeClass("yp_step_end");
		
        return $totalcreated;

    }


    // toggle created background image.
    $("#background-image-group .yp-none-btn,#background-image-group .yp-disable-btn").click(function(){
    	$("#background-image-group .yp-background-image-show").toggle();
    });


    /* ---------------------------------------------------- */
    /* Set Default Option Data								*/
    /* ---------------------------------------------------- */
    function yp_set_default(evt, $n, evt_status) {

		// element
        if (evt_status == true) {
            var eventTarget = iframe.find(evt.target);
        } else {
			var eventTarget = iframe.find(evt);
        }

        // Remove Active colors:
        $(".yp-nice-c.active,.yp-flat-c.active,.yp-meterial-c.active").removeClass("active");

		// Adding animation helper classes
		if($n == 'animation-name' || $n == 'animation-iteration-count' || $n == 'animation-fill-mode' || $n == 'animation-duration' || $n == 'animation-iteration-count'){
			iframe.find(".yp-selected,.yp-selected-others").addClass("yp_onscreen").addClass("yp_hover").addClass("yp_click").addClass("yp_focus");
		}
		
		setTimeout(function(){

		var elementID = yp_id($("body").attr("data-clickable-select"));

		// There is any css
		if(iframe.find('.'+elementID+"-"+$n+"-style").length > 0){
			$("#"+$n+"-group").addClass("eye-enable");
		}

		// add disable eye icon for border style
		if($n == "border-style"){
			if(iframe.find('.'+elementID+"-border-top-style-style").length > 0 && iframe.find('.'+elementID+"-border-bottom-style-style").length > 0 && iframe.find('.'+elementID+"-border-left-style-style").length > 0 && iframe.find('.'+elementID+"-border-right-style-style").length > 0){
				$("#"+$n+"-group").addClass("eye-enable");
			}
		}

		// add disable eye icon for border style
		if($n == "border-width"){
			if(iframe.find('.'+elementID+"-border-top-width-style").length > 0 && iframe.find('.'+elementID+"-border-bottom-width-style").length > 0 && iframe.find('.'+elementID+"-border-left-width-style").length > 0 && iframe.find('.'+elementID+"-border-right-width-style").length > 0){
				$("#"+$n+"-group").addClass("eye-enable");
			}
		}

		// add disable eye icon for border style
		if($n == "border-color"){
			if(iframe.find('.'+elementID+"-border-top-color-style").length > 0 && iframe.find('.'+elementID+"-border-bottom-color-style").length > 0 && iframe.find('.'+elementID+"-border-left-color-style").length > 0 && iframe.find('.'+elementID+"-border-right-color-style").length > 0){
				$("#"+$n+"-group").addClass("eye-enable");
			}
		}
		
		// data is default value
		if($n != 'animation-play'){
			var data = eventTarget.css($n);
		}

		// Chome return "rgba(0,0,0,0)" if no background color,
		// its is chrome hack.
		if($n == 'background-color'){
			if(data == 'rgba(0, 0, 0, 0)'){
				data = 'transparent';
			}
		}

		// Animation name play.
		if($n == 'animation-name' && data != 'none'){

			// Add class.
			iframeBody.addClass("yp-hide-borders-now");

			var time = eventTarget.css("animation-duration");

			if(time == null || time == undefined){
				time = '1200';
			}else{
				time = time.replace("ms",""); // ms delete
				time = time.replace("s","000");
			}

			time = parseInt(time)+300;

			setTimeout(function() {

				// Update.
				yp_draw();

				// remove class.
				iframeBody.removeClass("yp-hide-borders-now");

			}, time);

		}

		// animation helpers: because need special data for animation rules.
		if($n == 'animation-play'){
			
			// Default
			var data = 'yp_onscreen';
			
			if(iframe.find('[data-style="'+elementID+'yp_onscreen"]').length > 0){
				data = 'yp_onscreen';
			}
			
			if(iframe.find('[data-style="'+elementID+'yp_click"]').length > 0){
				data = 'yp_click';
			}
			
			if(iframe.find('[data-style="'+elementID+'yp_hover"]').length > 0){
				data = 'yp_hover';
			}
			
			if(iframe.find('[data-style="'+elementID+'yp_focus"]').length > 0){
				data = 'yp_focus';
			}
			
			if($("body").hasClass("yp-selector-hover")){
				data = 'yp_hover';
			}
			
			if($("body").hasClass("yp-selector-focus")){
				data = 'yp_focus';
			}
			
			if(data === undefined || data === null){
				return false;
			}

		}

		// Num: numberic data
        var $num = yp_num(eventTarget.css($n));

        // filter = data of filter css rule.
        if($n.indexOf("-filter") != -1){

	        var filter = eventTarget.css("filter");
	        if(filter == null || filter == 'none' || filter == undefined){
	        	filter = eventTarget.css("-webkit-filter"); // for chrome.
	        }
			

			// Special default values for filter css rule.
			if(filter != 'none' && filter !== null && filter !== undefined && $n.indexOf("-filter") != -1){
				
				if($n == 'blur-filter'){
					data = filter.match(/blur\((.*?)\)/g);
				}
				
				if($n == 'brightness-filter'){
					data = filter.match(/brightness\((.*?)\)/g);
				}
				
				if($n == 'grayscale-filter'){
					data = filter.match(/grayscale\((.*?)\)/g);
				}
				
				if($n == 'contrast-filter'){
					data = filter.match(/contrast\((.*?)\)/g);
				}
				
				if($n == 'hue-rotate-filter'){
					data = filter.match(/hue-rotate\((.*?)\)/g);

					if(data !== null){
						data = (data.toString().replace("deg","").replace("hue-rotate(","").replace(")",""));
					}

				}
				
				if($n == 'saturate-filter'){
					data = filter.match(/saturate\((.*?)\)/g);
				}
				
				if($n == 'sepia-filter'){
					data = filter.match(/sepia\((.*?)\)/g);
				}
				
				if(data !== undefined && data !== null){
					data = yp_num(data.toString());
					$num = data;
				}else{
					$num = 0;
					data = 'disable';
				}
				
			}

			// Special default values for brightness and contrast.
			if($n.indexOf("-filter") != -1){
				if(filter == 'none' || filter == null || filter == undefined){
					data = 'disable';
					$num = 0;

					if($n == 'brightness-filter'){
						$num = 1;
					}

					if($n == 'contrast-filter'){
						$num = 1;
					}

				}
			}

		}

		// Font weight fix.
		if($n == 'font-weight'){
			if(data == 'bold'){
				data = '600'
			}
			if(data == 'normal'){
				data = '600'
			}
		}
		
		if($n.indexOf("-transform") != -1 && $n != 'text-transform'){
			// Getting transform value from HTML Source.
			if(iframe.find('.' + elementID + '-' + 'transform-style').length > 0){
				var ht = iframe.find('.' + elementID + '-' + 'transform-style').html();
				var transform = ht.split(":")[1].split("}")[0];
			}else{
				var transform = 'none';
			}
			
			// Special Default Transform css rule value.
			if(transform != 'none' && transform !== null && transform !== undefined && $n.indexOf("-transform") != -1 && $n != 'text-transform'){
				
				if($n == 'scale-transform'){
					data = transform.match(/scale\((.*?)\)/g);
				}
				
				if($n == 'rotate-transform'){
					data = transform.match(/rotate\((.*?)\)/g);
				}
				
				if($n == 'translate-x-transform'){
					data = transform.match(/translateX\((.*?)\)/g);
				}
				
				if($n == 'translate-y-transform'){
					data = transform.match(/translateY\((.*?)\)/g);
				}
				
				if($n == 'skew-x-transform'){
					data = transform.match(/skewX\((.*?)\)/g);
				}
				
				if($n == 'skew-y-transform'){
					data = transform.match(/skewY\((.*?)\)/g);
				}
				
				if(data !== undefined && data !== null){
					data = yp_num(data.toString());
					$num = data;
				}else{
					$num = 0;
					data = 'disable';

					if($n == 'scale-transform'){
						$num = 1;
					}

				}
				
			}

		}

		if($n == 'position' && eventTarget.hasClass("ready-for-drag") == true){
			data = 'static';
		}
	
		// Box Shadow.
		if($n.indexOf("box-shadow-") != -1 && eventTarget.css("box-shadow") != 'none' && eventTarget.css("box-shadow") !== null && eventTarget.css("box-shadow") !== undefined){
			
			// Box shadow color default value.
			if($n == 'box-shadow-color'){
				if(eventTarget.css("box-shadow").indexOf("#") != -1){
					if(eventTarget.css("box-shadow").split("#")[1].indexOf("inset") == -1){
						data = $.trim(eventTarget.css("box-shadow").split("#")[1]);
					}else{
						data = $.trim(eventTarget.css("box-shadow").split("#")[1].split(' ')[0]);
					}
				}else{
					if(data !== undefined){
						data = eventTarget.css("box-shadow").match(/rgb(.*?)\((.*?)\)/g).toString();
					}
				}
			}
			
			// split all box-shadow data.
			var numbericBox = eventTarget.css("box-shadow").replace(/rgb(.*?)\((.*?)\) /g,'').replace(/ rgb(.*?)\((.*?)\)/g,'').replace(/inset /g,'').replace(/ inset/g,'');
			
			// shadow horizontal value.

			if($n == 'box-shadow-horizontal'){
				data = numbericBox.split(" ")[0];
				$num = yp_num(data);
			}
			
			// shadow vertical value.
			if($n == 'box-shadow-vertical'){
				data = numbericBox.split(" ")[1];
				$num = yp_num(data);
			}
			
			// Shadow blur radius value.
			if($n == 'box-shadow-blur-radius'){
				data = numbericBox.split(" ")[2];
				$num = yp_num(data);
			}
			
			// Shadow spread value.
			if($n == 'box-shadow-spread'){
				data = numbericBox.split(" ")[3];
				$num = yp_num(data);
			}
			
		}

		// if no info about inset, default is no.
		if($n == 'box-shadow-inset'){

			if(eventTarget.css("box-shadow") === undefined){

				data = 'no';

			}else{

				if(eventTarget.css("box-shadow").indexOf("inset") == -1){
					data = 'no';
				}else{
					data = 'inset';
				}

			}

		}

		// box shadow notice
		if(eventTarget.css("box-shadow") != 'none' && eventTarget.css("box-shadow") != 'undefined' && eventTarget.css("box-shadow") != undefined && eventTarget.css("box-shadow") != ''){
			$(".yp-has-box-shadow").show();
		}else{
			$(".yp-has-box-shadow").hide();
		}

		// Getting format: px, em, etc.
        var $format = yp_alfa(eventTarget.css($n)).replace("-", "");

        // option element.
        var the_id = $("#yp-" + $n);

        // option element parent of parent.
        var id_prt = the_id.parent().parent();

        // option element parent.
        var id_prtz = the_id.parent();


		// if special CSS, get css by CSS data.
		// ie for parallax. parallax not a css rule.
		// yellow pencil using css engine for parallax Property.
		if(eventTarget.css($n) == undefined && iframe.find('.'+elementID+'-'+$n+'-style').length > 0){
			
			data = iframe.find('.'+elementID+'-'+$n+'-style').html().split(":")[1].split('}')[0].replace(/;/g,'').replace(/!important/g,'');
			$num = yp_num(data);
			
		}else if(eventTarget.css($n) == undefined) { // if no data, use "disable" for default.
			
			if($n == 'background-parallax'){
				data = 'disable';
			}
			
			if($n == 'background-parallax-speed'){
				data = 'disable';
			}
			
			if($n == 'background-parallax-x'){
				data = 'disable';
			}
			
		}
		
		var element = iframe.find(".yp-selected");

        // IF THIS IS A SLIDER
        if (the_id.hasClass("wqNoUi-target")) {


            // Border width Fix
            if ($n == 'border-width') {

            	var element = iframe.find(".yp-selected");

                if (element.css("border-top-width") == element.css("border-bottom-width")) {

                    if (element.css("border-left-width") == element.css("border-right-width")) {

                        if (element.css("border-top-width") == element.css("border-left-width")) {

                            $num = yp_num(element.css("border-top-width"));
                            $format = yp_alfa(element.css("border-top-width"));

                        }

                    }

                }

            } // border width end.

 			
 			// if no data, active none option.
            if (data == 'none' || data == 'auto') {
                id_prt.find(".yp-none-btn").not(".active").trigger("click");
                $format = 'px';
            }else{
            	id_prt.find(".yp-none-btn.active").trigger("click"); // else disable none option.
            }

            // be sure format is valid.
            if ($format == '' || $format == 'px .px' || $format == 'px px') {
                $format = 'px';
            }

            // Default value is 1 for transform scale.
            if ($num == '' && $n == 'scale-transform') {
            	$num = 1;
            }

            // default value is 1 for opacity.
            if ($num == '' && $n == 'opacity') {
            	$num = 1;
            }

            // If no data, set zero value.
            if ($num == '') {
                $num = 0;
            }

			var range = id_prt.data("px-range").split(",");
			
		
			var $min = parseInt(range[0]); // mininum value
			var $max = parseInt(range[1]); // maximum value
			
			// Check values.
			if($num < $min){
				$min = $num;
			}
			
			if($num > $max){
				$max = $num;
			}
			
			// Speacial max and min limits for CSS size rules.
			if($n == 'width' || $n == 'max-width' || $n == 'min-width' || $n == 'height' || $n == 'min-height' || $n == 'max-height'){
				$max = parseInt($max)+(parseInt($max)*1.5);
				$min = parseInt($min)+(parseInt($min)*1.5);
			}

			// if width is same with windows width, so set 100%!
			// Note: browsers always return value in PX format.
			if(eventTarget.css("display") == 'block' || eventTarget.css("display") == 'inline-block'){

				if($n == 'width' && parseInt($(window).innerWidth()) == parseInt($num)){
					$num = '100';
					$format = '%';
				}

				// if  width is same with parent width, so set 100%!
				if(eventTarget.parent().length > 0){
					if($n == 'width' && parseInt(eventTarget.parent().innerWidth()) == parseInt($num)){
						$num = '100';
						$format = '%';
					}
				}

				// if  width is 50% of parent width, so set 50%!
				if(eventTarget.parent().length > 0){
					if($n == 'width' && parseInt(eventTarget.parent().innerWidth()) == (parseInt($num)*2)){
						$num = '50';
						$format = '%';
					}
				}

				// if  width is 25% of parent width, so set 25%!
				if(eventTarget.parent().length > 0){
					if($n == 'width' && parseInt(eventTarget.parent().innerWidth()) == (parseInt($num)*4)){
						$num = '25';
						$format = '%';
					}
				}

				// if  width is 20% of parent width, so set 20%!
				if(eventTarget.parent().length > 0){
					if($n == 'width' && parseInt(eventTarget.parent().innerWidth()) == (parseInt($num)*5)){
						$num = '20';
						$format = '%';
					}
				}

			}


			// max and min for %.
			if($format == '%'){
				$min = 0;
				$max = 200;
			}


			// Okay now set nouislider.
			var slider = the_id.wqNoUiSlider({
				range: {
					'min': parseInt($min),
					'max': parseInt($max)
				},
				start: parseFloat($num)
			}, true);

			// Set new value.
			the_id.val($num);

			// set format of value. px, em etc.
			$("#" + $n + "-after").val($format);
			
			return false;

		// IF THIS IS A SELECT TAG
        } else if (the_id.hasClass("wqselect2-select")) {

        	// Checking font family settings.
            if ($n == 'font-family' && typeof data != 'undefined') {

                if (data.indexOf(",") >= 0) {

                    data = data.split(",");
					
					var founded = false;
					
					$.each( data, function (i, v) {
						if(founded == false){
							data = $.trim(data[i].replace(/"/g, "").replace(/'/g, ""));
							founded = true;
						}
					});

                }

            }

            if(data  !== undefined && data  !== 'undefined' && data !== '' && data !== null){

				// Set CSS For this selected value. example: set font-family for this option.
	            id_prt.find(".wqselect2-selection__rendered").css($n, data);

	            // Append default font family to body. only for select font family.
	            if($(".yp-font-test-" + yp_id($.trim(data.replace(/ /g, '+')))).length == 0 && $n == 'font-family'){

		            var $weight = yp_num(iframe.find("#yp-font-weight").val());

					var $normal = '';
									
					if ($weight != '400') {
						$normal = '400,400italic';
					}
									
					if ($weight != '600') {
						$normal += ',600,600italic';
					}
									
					if ($weight != '300') {
						$normal += ',300';
					}
									
					$weight = $weight+","+$weight+"italic,"+$normal;
									
					$weight = $weight.replace(/,,/g,",");

		            // If safe font, stop.
		            if(yp_safe_fonts(data) == false){

		            	// Be sure its google font.
			            if(yp_is_google_font(data)){

			            	// Append always to body.
							body.append("<link rel='stylesheet' class='yp-font-test-" + yp_id($.trim(data.replace(/ /g, '+'))) + "'  href='http://fonts.googleapis.com/css?family=" + $.trim(data.replace(/ /g, '+')) + ":"+$weight+" type='text/css' media='all' />");
						}

					}

				}

	            // Adding class.
	            the_id.addClass("yp-setted-default");

            	// If have data, so set!
            	if($n == 'font-family' && data.indexOf("," == -1)){

            		// Getting value
					var value = $("#yp-font-family option").filter(function(){
					  return $(this).text() === data;
					}).first().attr("value");

					// Select by value.
					if(value != undefined){
						the_id.wqselect2("val", value);
					}

				}else if($n == 'font-family'){

					// Select by value.
					the_id.wqselect2("val", data);

				}else{

					// Select by value.
					the_id.wqselect2("val", data);
					
				}


				if($n == 'font-family'){
					$("#wqselect2-yp-font-weight-results li,#wqselect2-yp-font-weight-container").each(function(){
						$(this).css("font-family",data);
					});
				}

			}
			
            // Active none button.
            id_prt.find(".yp-btn-action.active").trigger("click");
			

			// If data is none, auto etc, so active none button.
            if (data == id_prt.find(".yp-none-btn").text()) {
                id_prt.find(".yp-none-btn").trigger("click");
            }
			

			// If not have this data in select options, insert this data.
            if (the_id.val() == null && data != id_prt.find(".yp-none-btn").text() && data !== undefined) {
                $('<option>' + data + '</option>').prependTo('#yp-' + $n);
                the_id.wqselect2('val', data);
                the_id.wqselect2('close');
            }

            return false;

        // IF THIS IS A RADIO TAG
        } else if (the_id.hasClass("yp-radio-content")) {

            // Border style Fix
            if ($n == 'border-style' && data == '') {
            	
                if (element.css("border-top-style") == element.css("border-bottom-style")) {

                    if (element.css("border-left-style") == element.css("border-right-style")) {

                        if (element.css("border-top-style") == element.css("border-left-style")) {

                            data = element.css("border-top-style");

                        }

                    }

                }

            }
		
			// Fix background size rule.
			if($n == 'background-size'){
				if(data == 'auto' || data == '' || data == ' ' || data == 'auto auto'){
					data = 'auto auto';
				}
			}
			
			// If disable, active disable button.
			if (data == 'disable' && $n != 'background-parallax') {
                id_prt.find(".yp-disable-btn").not(".active").trigger("click");
			}else{ 
				yp_radio_value(the_id, $n, data); // else Set radio value.
			}

			return false;


        // IF THIS IS COLORPICKER
        } else if (the_id.hasClass("wqcolorpicker")){
			
            // Border color Fix
            if ($n == 'border-color' && data == '') {

                if (element.css("border-top-color") == element.css("border-bottom-color")) {

                    if (element.css("border-left-color") == element.css("border-right-color")) {

                        if (element.css("border-top-color") == element.css("border-left-color")) {

                            data = element.css("border-top-color");

                        }

                    }

                }

            }

            if($n == 'box-shadow-color'){
            	data = $("#yp-color").val();
            }
			
			// Convert to rgb and set value.
			var rgbd = rgb2hex(data);

			// browsers return value always in rgb format.
            the_id.val(rgbd);

            the_id.iris('color',data);

            // Set current color on small area.
            the_id.parent().find(".wqminicolors-swatch-color").css("background-color", rgbd).css("background-image","none");

            // If transparent
            if(data == 'transparent'){
            	id_prt.find(".yp-disable-btn.active").trigger("click");
            	id_prt.find(".yp-none-btn:not(.active)").trigger("click");
            	the_id.parent().find(".wqminicolors-swatch-color").css("background-image","url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOwAAADsAQMAAABNHdhXAAAABlBMVEW/v7////+Zw/90AAAAUElEQVRYw+3RIQ4AIAwDwAbD/3+KRPKDGQQQbpUzbS6zF0lLeSffqYr3cXHzzd3PivHmzZs3b968efPmzZs3b968efPmzZs3b968efP+03sBF7TBCROHcrMAAAAASUVORK5CYII=)");
            }else{
            	id_prt.find(".yp-none-btn.active").trigger("click");
            }

            if($n == 'box-shadow-color'){
    			$("#box-shadow-color-group .wqminicolors-swatch-color").css("background-color",data);
            }

            return false;

        // IF THIS IS INPUT OR TEXTAREA
        } else if (the_id.hasClass("yp-input") == true || the_id.hasClass("yp-textarea")) {

        	// clean URL() prefix for background image.
			if(typeof data != 'undefined' && data != 'disable' && $n == "background-image"){

				the_id.val(data.replace(/"/g, "").replace(/'/g, "").replace(/url\(/g, "").replace(/\)/g, ""));

				if(data.indexOf("yellow-pencil") > -1){
					$(".yp_bg_assets").removeClass("active");
					$(".yp_bg_assets[data-url='"+data.replace(/"/g, "").replace(/'/g, "").replace(/url\(/g, "").replace(/\)/g, "")+"']").addClass("active");
				}else{
					$(".yp-background-image-show").remove();
					var imgSrc = data.replace(/"/g, "").replace(/'/g, "").replace(/url\(/g, "").replace(/\)/g, "");
					if(imgSrc.indexOf("//") != -1 && imgSrc != '' && imgSrc.indexOf(".") != -1){
						$("#yp-background-image").after("<img src='"+imgSrc+"' class='yp-background-image-show' />");
					}
				}

			}else{
				$(".yp-background-image-show").remove();
			}

            // If no data, active none button.
            if (data == 'none') {
                id_prtz.find(".yp-none-btn").not(".active").trigger("click");
                the_id.val(''); // clean value.
            } else {
                id_prtz.find(".yp-none-btn.active").trigger("click");  // else disable.
            }
			
		 	// If no data, active disable button.
			if (data == 'disable') {
                id_prtz.find(".yp-disable-btn").not(".active").trigger("click");
                the_id.val('');
            } else {
                id_prtz.find(".yp-disable-btn.active").trigger("click"); // else disable.
            }

            return false;

        }

		
	  },2);
		
    }


    function yp_is_google_font(font){

    	var status = false;
	    $('select#yp-font-family option').each(function(){
			if($(this).text() == font){
				status = true;
				return true;
			}
	    });

	    return status;

    }


    /* ---------------------------------------------------- */
    /* Get Best Class Name									*/
    /* ---------------------------------------------------- */
    /*
    	the most important function in yellow pencil scripts
		this functions try to find most important class name
		in classes.

		If no class, using ID else using tag name.
	*/
    function yp_get_best_class($element) {

        // Cache
		var element = $($element);

        // Element Classes
        var classes = element.attr("class");

        // Clean Yellow Pencil Classes
        if(classes != undefined && classes != null){
        	classes = yp_classes_clean(classes);
        }

        // Cache id and tagname.
        var id = element.attr("id");
        var tag = element[0].nodeName.toLowerCase();


        // Default
        var best_classes = '';
        var nummeric_class = '';
        var the_best = '';


		// If Element has ID, Return ID.
		if (typeof id != 'undefined'){	

			if(element.hasClass("widget") == true){
				id = '';
			}

			if($.trim(id).indexOf("menu-item-") != -1){
				id = '';
			}

			if($.trim(id).indexOf("comment-") != -1){
				id = '';
			}

			if($.trim(id).indexOf("post-") != -1){
				id = '';
			}

			if($.trim(id).indexOf("li-comment-") != -1){
				id = '';
			}

			if ($.trim(id) != '' && $.trim(the_best) == ''){
				return '#' + id;
			}

		}

        // If has classes.
         if(classes != undefined && classes != null){

            // Column class is second plan if
            // has small, large, medium classes.
        	if(classes.indexOf("columns") != -1 && classes.indexOf("small-") != -1){
        		classes = classes.replace(/\bcolumns\b/g,'');
        	}

        	if(classes.indexOf("columns") != -1 && classes.indexOf("medium-") != -1){
        		classes = classes.replace(/\bcolumns\b/g,'');
        	}

        	if(classes.indexOf("columns") != -1 && classes.indexOf("large-") != -1){
        		classes = classes.replace(/\bcolumns\b/g,'');
        	}

            // Classes to array.
            var ArrayClasses = classes.split(" ");

            // Foreach classes.
            // If has normal classes and nunmmeric classes,
            // Find normal classes and cache to best_classes variable.
            $(ArrayClasses).each(function(i, v) {
				
                if (v.match(/\d+/g)) {
                    nummeric_class = v;
                } else {
                    best_classes += ' ' + v;
                }

            });

        }

        // Use tag name with class.
		var ClassNameTag = '';
		if(tag != 'div' && tag != undefined && tag != null){
			var ClassNameTag = tag;
		}

        // If Has Best Classes
        if ($.trim(best_classes) != ''){

            // Make as array.
            the_best = $.trim(best_classes).split(" ");

            // Replace significant classes and keep best classes.
            var significant_classes = $.trim($.trim(best_classes).replace(/\brow\b/g, '').replace(/\bvc_row\b/g,'').replace(/\bcol-(\w+)-[0-9]\b/g, '').replace(/\bcol-(\w+)-offset-[0-9]\b/g, '').replace(/\bspan[0-9]\b/g,'').replace(/\bls-l-1\b/g,'').replace(/\bsmall-[0-9]\b/g,'').replace(/\bmedium-[0-9]\b/g,'').replace(/\blarge-[0-9]\b/g,'').replace(/\bsmall-push-[0-9]\b/g, '').replace(/\bsmall-pull-[0-9]\b/g, '').replace(/\bmedium-push-[0-9]\b/g, '').replace(/\bmedium-pull-[0-9]\b/g, '').replace(/\blarge-push-[0-9]\b/g, '').replace(/\blarge-pull-[0-9]\b/g, '').replace(/\bclearfix\b/g, '').replace(/\bclear\b/g, '').replace(/\bpull-left\b/g, '').replace(/\bpull-right\b/g, '').replace(/\bstatus-publish\b/g, '').replace(/\btype-page\b/g, '').replace(/\bhentry\b/g, '').replace(/\bpage_item\b/g,"").replace(/\bthread-even\b/g,"").replace(/\bthread-odd\b/g,"").replace(/\bthread-alt\b/g,"").replace(/\bmenu-item-type-post_type\b/g,"").replace(/\bmenu-item-object-page\b/g,"").replace(/\bmenu-item-object-custom\b/g,"").replace(/\bmenu-item-type-custom\b/g,""));



            // Important classes, current-menu-item etc
            // If has this any classes, keep this more important.
            var i;
            var return_the_best = '';
            for (i = 0; i < the_best.length; i++) {

                if (the_best[i] == 'current-menu-item' || the_best[i] == 'active' || the_best[i] == 'current' || the_best[i] == 'post' || the_best[i] == 'widget' || the_best[i] == 'sticky' || the_best[i] == 'wp-post-image' || the_best[i] == 'entry-title' || the_best[i] == 'entry-content' || the_best[i] == 'entry-meta' || the_best[i] == 'comment-author-admin') {
                    return_the_best = the_best[i];
                }

            }

            // If no best and has class menu item, use it.
            if(return_the_best == '' && element.hasClass("menu-item")){
            	return_the_best = 'menu-item';
            }

            // Image selection
            if(return_the_best == '' && nummeric_class.indexOf("wp-image-") > -1 && tag == 'img'){
            	return_the_best = $.trim(nummeric_class.match(/wp-image-[0-9]/g).toString());
            }


            // Some element selecting by tag names.
            var tagFounded = false;


            // If there not have any best class.
            if(return_the_best == ''){

	            // select img by tagname if no id or best class.
	            if(tag == 'li' && typeof id == 'undefined'){
	            	tagFounded = true;
	            	the_best = tag;
	            }

	            // select img by tagname if no id or best class.
	            if(tag == 'img' && typeof id == 'undefined'){
	            	tagFounded = true;
	            	the_best = tag;
	            }

	            // Use article for this tag.
	            if(tag == 'article' && element.hasClass("comment") == true){
	            	tagFounded = true;
	            	the_best = tag;
	            }

            }

            
            // If the best classes is there, return.
            if(return_the_best != ''){

                the_best = ClassNameTag+'.' + return_the_best;

            // If can't find best classes, use significant classes.
            } else if (significant_classes != '' && tagFounded == false){

                // Convert to array.
                significant_classes = significant_classes.split(" ");

                // Find most long classes.
                var maxlengh = significant_classes.sort(function(a,b){return b.length - a.length});

                // If finded, find classes with this char "-"
                if(maxlengh[0] != 'undefined'){

                    // Finded.
                    var maxChar = significant_classes.sort(function(a,b){return b.indexOf("-") - a.indexOf("-")});

                    // First prefer max class with "-" char.
                    if(maxChar[0] != 'undefined'){
                        the_best = ClassNameTag+'.' + maxChar[0];
                    }else if(maxlengh[0] != 'undefined'){ // else try most long classes.
                        the_best = ClassNameTag+'.' + maxlengh[0];
                    }

                }else{
                	// Get first class.
                	the_best = ClassNameTag+'.' + significant_classes[0];
                }

            }else if(tagFounded == false){
                the_best = ClassNameTag+'.' + the_best[0];
            }

        } else {

            // If has any class
            if ($.trim(nummeric_class) != ''){
                the_best = ClassNameTag+'.' + nummeric_class;				
            }

            // If has an id
            if ($.trim(id) != '' && $.trim(the_best) == '') {
                the_best = '#' + id;
            }	
			
            // If Nothing, Use tag name.
            if ($.trim(tag) != '' && $.trim(the_best) == '') {
                the_best = tag;
            }

        }

		return $.trim(the_best);

    }


    /* ---------------------------------------------------- */
    /* Get All Current Parents								*/
    /* ---------------------------------------------------- */
    function yp_get_current_selector(){

    	var parentsv = body.attr("data-clickable-select");
		
		if (typeof parentsv !== typeof undefined && parentsv !== false) {
			return parentsv;
		}else{
			yp_get_parents(iframe.find(".yp-selected"),"default");
		}

    }



    /* ---------------------------------------------------- */
    /* Get All Parents 										*/
    /* ---------------------------------------------------- */
    function yp_get_parents(a,status) {
		
		// If parent already has.
		var parentsv = body.attr("data-clickable-select");
		
		// If status default, return current data.
		if(status == 'default'){
			if (typeof parentsv !== typeof undefined && parentsv !== false) {
				return parentsv;
			}
		}
		
		// Be sure this item is valid.
		if(a[0] === undefined || a[0] === false || a[0] === null){
			return false;
		}

		// If body, return.
        if (a[0].tagName == 'BODY') {
            return 'body';
        }

        // Getting item parents.
        var parents = a.parents(document);

        // Empy variable.
        var selector = '';

        // Foreach all loops.
        for (var i = parents.length - 1; i >= 0; i--) {

        	// Not body or HTML.
            if (parents[i].tagName != 'BODY' && parents[i].tagName != 'HTML') {

            	// If Last Selector Item
                if (i == parents.length - 1) {

                    selector += yp_get_best_class(parents[i]);

                }else{ // If not.

                	// Get Selector name.
                	var thisSelector = yp_get_best_class(parents[i]);

                	// Check if this Class.
                	// Reset past selector names if current selector already one in document.
                	if(thisSelector.indexOf(".") != -1 && iframe.find(thisSelector).length == 1){

                		selector = thisSelector + window.separator; // Reset

                	}else{

                		selector += thisSelector + window.separator; // add new

                	}

                }

            }

        }

        // Clean selector.
        selector = $.trim(selector);

        // Adding Last Element selector.
		if(a[0].tagName == 'INPUT'){ // if input,use tag name.

			var type = a.attr("type");

			if(type != 'submit'){

				selector += window.separator+'input[type='+type+']';

			}

		}else{ // else find the best class.
			selector += window.separator+yp_get_best_class(a);
		}

		// Google map fix
		if (selector.indexOf(".gm-style") >= 0) {
			selector = selector.split(window.separator + ".gm-style");
			selector = selector[0];
		}

		if(selector.indexOf("#") >= 0 && selector.indexOf("yp-") == -1){
			selector = selector.split("#");
			selector = selector[(selector.length-1)];
			selector = "#"+selector;
		}

		// Return result.
        return selector;

    }



    /* ---------------------------------------------------- */
    /* Draw Tooltip and borders.							*/
    /* ---------------------------------------------------- */
    function yp_draw_box(element, classes) {
		
		if(typeof $(element) === 'undefined'){
			var element_p = $(element);
		}else{
			var element_p = iframe.find(element);
		}

		// Be sure this element have.
		if (element_p.length > 0) {
				
			var marginTop = element_p.css("margin-top");
			var marginBottom = element_p.css("margin-bottom");
			var marginLeft = element_p.css("margin-left");
			var marginRight = element_p.css("margin-right");

			//Dynamic boxes variables
			var topBoxes = element_p.offset().top;
			var leftBoxes = element_p.offset().left;
			var widthBoxes = element_p.outerWidth(false);
			var heightBoxes = element_p.outerHeight(false);
			var widthBoxesMargin = element_p.outerWidth(true);
			var heightBoxesMargin = element_p.outerHeight(true);

			var bottomBoxes = topBoxes + heightBoxes;

			if(body.hasClass("yp-content-selected")){
				var rightExtra = 2
			}else{
				var rightExtra = 1;
			}

			var rightBoxes = leftBoxes + widthBoxes - rightExtra;

			var windowWidth = $(window).width();
			var documentHeight = $(document).height();

			// If right border left is more then screen
			if (rightBoxes > windowWidth - 2) {
				rightBoxes = windowWidth - 2;
			}

			// If bottom border left is more then screen
			if (leftBoxes + widthBoxes > windowWidth) {
				widthBoxes = windowWidth - leftBoxes - 1;
			}
				
			if(heightBoxes > 1 && widthBoxes > 1){
					
				// Dynamic Box
				if (iframe.find("." + classes + "-top").length == 0) {
					iframeBody.append("<div class='" + classes + "-top'></div><div class='" + classes + "-bottom'></div><div class='" + classes + "-left'></div><div class='" + classes + "-right'></div>");
				}
					
				if (iframe.find("." + classes + "-margin-top").length == 0) {
					iframeBody.append("<div class='" + classes + "-margin-top'></div><div class='" + classes + "-margin-bottom'></div><div class='" + classes + "-margin-left'></div><div class='" + classes + "-margin-right'></div>");
				}

				// Dynamic Boxes position
				iframe.find("." + classes + "-top").css("top", topBoxes).css("left", leftBoxes).css("width", widthBoxes);

				iframe.find("." + classes + "-bottom").css("top", bottomBoxes).css("left", leftBoxes).css("width", widthBoxes);

				iframe.find("." + classes + "-left").css("top", topBoxes).css("left", leftBoxes).css("height", heightBoxes);

				iframe.find("." + classes + "-right").css("top", topBoxes).css("left", rightBoxes).css("height", heightBoxes);
					
					
				// Top Margin
				iframe.find("." + classes + "-margin-top").css("top", parseFloat(topBoxes)-parseFloat(marginTop)).css("left", parseFloat(leftBoxes)-parseFloat(marginLeft)).css("width", parseFloat(widthBoxes)+parseFloat(marginRight)+parseFloat(marginLeft)).css("height", marginTop);
					
				// Bottom Margin
				iframe.find("." + classes + "-margin-bottom").css("top", bottomBoxes).css("left", parseFloat(leftBoxes)-parseFloat(marginLeft)).css("width", parseFloat(widthBoxes)+parseFloat(marginRight)+parseFloat(marginLeft)).css("height", marginBottom);
					
				// Left Margin
				iframe.find("." + classes + "-margin-left").css("top", topBoxes).css("left", parseFloat(leftBoxes)-parseFloat(marginLeft)).css("height", heightBoxes).css("width", marginLeft);
					
				// Right Margin
				iframe.find("." + classes + "-margin-right").css("top", topBoxes).css("left", rightBoxes).css("height", heightBoxes).css("width", marginRight);
				
			}

		}

    }


    /* ---------------------------------------------------- */
    /* Draw Tooltip and borders.							*/
    /* ---------------------------------------------------- */
    function yp_draw_box_other(element, classes, $i){
		
		var element_p = $(element);

		if(element_p === null){
			return false;
		}

		if(element_p[0].nodeName == "HTML" || element_p[0].nodeName == "BODY"){
			return false;
		}

		if(element_p.length == 0){
			return false;
		}

		// Be sure this is visible on screen
		if (element_p.css("display") == 'none' || element_p.css("visibility") == 'hidden' || element_p.css("opacity") == '0'){
			return false;
		}

		// Not show if p tag and is empty.
		if(element_p.html() == '&nbsp;' && element_p.prop("tagName") == 'P'){
			return false;
		}

		// Be sure this is visible on screen
		if (element_p.css("display") == 'none' || element_p.css("visibility") == 'hidden' || element_p.css("opacity") == '0'){
			return false;
		}

		// Be sure this is visible on screen (For parent)
		if(element_p.parent().length !== 0 && element_p.parent()[0].nodeName !== 'HTML' && element_p.parent()[0].nodeName !== 'BODY'){
			
			if (element_p.parent().css("display") == 'none' || element_p.parent().css("visibility") == 'hidden' || element_p.parent().css("opacity") == '0'){
				return false;
			}

			// Be sure this is visible on screen (For parent parent)
			if(element_p.parent().parent().length !== 0 && element_p.parent().parent()[0].nodeName !== 'HTML' && element_p.parent().parent()[0].nodeName !== 'BODY'){
				if (element_p.parent().parent().css("display") == 'none' || element_p.parent().parent().css("visibility") == 'hidden' || element_p.parent().parent().css("opacity") == '0'){
					return false;
				}

				// Be sure this is visible on screen (For parent parent parent)
				if(element_p.parent().parent().parent().length !== 0 && element_p.parent().parent().parent()[0].nodeName !== 'HTML' && element_p.parent().parent().parent()[0].nodeName !== 'BODY'){
					if (element_p.parent().parent().parent().css("display") == 'none' || element_p.parent().parent().parent().css("visibility") == 'hidden' || element_p.parent().parent().parent().css("opacity") == '0'){
						return false;
					}
				
					// Be sure this is visible on screen (For parent parent parent)
					if(element_p.parent().parent().parent().parent().length !== 0 && element_p.parent().parent().parent().parent()[0].nodeName != 'HTML' && element_p.parent().parent().parent().parent()[0].nodeName != 'BODY'){
						if (element_p.parent().parent().parent().parent().css("display") == 'none' || element_p.parent().parent().parent().parent().css("visibility") == 'hidden' || element_p.parent().parent().parent().parent().css("opacity") == '0'){
							return false;
						}
					}

				}

			}

		}

		//Dynamic boxes variables
		var topBoxes = element_p.offset().top;
		var leftBoxes = element_p.offset().left;
		var widthBoxes = element_p.outerWidth(false);
		var heightBoxes = element_p.outerHeight(false);
		var widthBoxesMargin = element_p.outerWidth(true);
		var heightBoxesMargin = element_p.outerHeight(true);

		var bottomBoxes = topBoxes + heightBoxes;			
				
		if(heightBoxes > 1 && widthBoxes > 1){

		// Dynamic Box
			if (iframe.find("." + classes + "-" + $i + "-top").length == 0) {
				iframeBody.append("<div class='" + classes + "-top " + classes + "-" + $i + "-top'></div><div class='" + classes + "-bottom " + classes + "-" + $i + "-bottom'></div><div class='" + classes + "-left " + classes + "-" + $i + "-left'></div><div class='" + classes + "-right " + classes + "-" + $i + "-right'></div>");
			}

			// Dynamic Boxes position
			iframe.find("." + classes + "-" + $i + "-top").css("top", topBoxes).css("left", leftBoxes).css("width", widthBoxes);
			iframe.find("." + classes + "-" + $i + "-bottom").css("top", bottomBoxes).css("left", leftBoxes).css("width", widthBoxes);
			iframe.find("." + classes + "-" + $i + "-left").css("top", topBoxes).css("left", leftBoxes).css("height", heightBoxes);
			iframe.find("." + classes + "-" + $i + "-right").css("top", topBoxes).css("left", leftBoxes + widthBoxes).css("height", heightBoxes);

		}
		
    }



    /* ---------------------------------------------------- */
    /* Visible Height in scroll.							*/
    /* ---------------------------------------------------- */
    function yp_visible_height(t) {
        var top = t.offset().top;
        var windowHeight = iframe.height();
        var scrollTop = iframe.scrollTop();
        var height = t.outerHeight();

        if (top < scrollTop) {
            return height - (scrollTop - top);
        } else {
            return height;
        }

    }



    /* ---------------------------------------------------- */
    /* Draw Tooltip and borders.							*/
    /* ---------------------------------------------------- */
    function yp_tooltip_draw() {
		
		if(yp_get_current_selector() == "body" || yp_get_current_selector() == "html"){
			return false;
		}

		var element = iframe.find(".yp-selected");

		var tooltip = iframe.find(".yp-selected-tooltip");

		tooltip.removeClass("yp-tooltip-bottom-outside");

        var topElement = parseFloat(iframe.find(".yp-selected-boxed-top").css("top")) - 24;

        // If outside of bottom, show.
        if(topElement >= ($(window).height() + iframe.scrollTop() - 24)){

        	if(!tooltip.hasClass("yp-fixed-tooltip")){
        		tooltip.addClass("yp-fixed-tooltip");
        	}

        	// Update
        	topElement = ($(window).height() + iframe.scrollTop() - 24);

        }else{

        	if(tooltip.hasClass("yp-fixed-tooltip")){
        		tooltip.removeClass("yp-fixed-tooltip");
        	}

        }


        // If out of top, show.
        if (topElement < 30 || topElement < (iframe.scrollTop() + 30)) {

        	var bottomBorder = iframe.find(".yp-selected-boxed-bottom");

            topElement = parseFloat(bottomBorder.css("top")) - parseFloat(yp_visible_height(element));

            tooltip.addClass("yp-fixed-tooltip");

            var tooltipRatio = (tooltip.outerHeight() * 100 / yp_visible_height(element));

            if (tooltipRatio > 10) {
                tooltip.addClass("yp-tooltip-bottom-outside");
                topElement = parseFloat(bottomBorder.css("top")) - parseFloat(tooltip.outerHeight()) + tooltip.outerHeight();
            } else {
                tooltip.removeClass("yp-tooltip-bottom-outside");
            }


        }else{
        	tooltip.removeClass("yp-fixed-tooltip");
        }

        var leftElement = parseFloat(iframe.find(".yp-selected-boxed-top").css("left"));
		
		if(leftElement == 0){
			leftElement = parseFloat(iframe.find(".yp-selected-boxed-top").offset().left);
		}
		
        tooltip.css("top", topElement).css("left", leftElement);
		
		if(tooltip.height() > 16){
			
			 tooltip.css("top", topElement-(tooltip.height())+16);
			 
			 if(tooltip.height() > (element.height()/2) || tooltip.width() > (element.width()/2)){
				tooltip.remove();
			 }
			
		}

		if (tooltipRatio < 11) {
			tooltip.removeClass("yp-tooltip-bottom-outside");
		}

    }
	
	
	/* ---------------------------------------------------- */
    /* fix select2 bug.										*/
    /* ---------------------------------------------------- */
	$("html").click(function(e){
		
		if(e.target.nodeName == 'HTML' && $(".wqselect2-container--open").length === 0 && $(".iris-picker:visible").length === 0){
			yp_clean();
		}

		if($(".wqselect2-container--open").length > 0 && e.target.nodeName == 'HTML'){
			
			$("select").each(function(){
				$(this).wqselect2("close");
			});
			
		}
		
	});
	
	
	// if mouseup on iframe, trigger for document.
	iframe.on("mouseup", iframe, function(){
		
		$(document).trigger("mouseup");

	});


	/* ---------------------------------------------------- */
    /* Get Handler 											*/
    /* ---------------------------------------------------- */
    function yp_get_handler(){

    	// Element selected?
    	if(!$("body").hasClass("yp-content-selected")){
    		return false;
    	}

    	// element
    	var element = iframe.find(".yp-selected");

    	// If already have.
    	if(element.find(".yp-selected-handle").length > 0){
    		return false;
    	}

    	// Dont append in image tag and some tags.
    	if(element.prop("tagName") == 'IMG' ||
    		element.prop("tagName") == 'AUDIO' ||
    		element.prop("tagName") == 'VIDEO' ||
    		element.prop("tagName") == 'BR' ||
    		element.prop("tagName") == 'BUTTON' ||
    		element.prop("tagName") == 'TRACK' ||
    		element.prop("tagName") == 'PARAM' ||
    		element.prop("tagName") == 'INPUT' ||
    		element.prop("tagName") == 'TEXTAREA' ||
    		element.prop("tagName") == 'SELECT' ||
    		element.prop("tagName") == 'EMBED' ||
    		element.prop("tagName") == 'OPTION' ||
    		element.prop("tagName") == 'IFRAME'
    	){
    		return false;
    	}

    	// If static, use relative.
    	if(element.css("position") == 'static' && element.hasClass("ready-for-drag") == false){
    		element.addClass("ready-for-drag");
    	}

    	// Clean ex
		iframe.find(".yp-selected-handle").remove();

		// Add new
		if(element.height() > 20 && element.width() > 60){
			element.append("<div class='yp-selected-handle'></div>");
		}

		// If still static, stop.
		if(element.css("position") == 'static' && element.hasClass("ready-for-drag") == false){
			body.addClass("yp-position-static");
		}

		// destroy
		iframe.find(".yp-selected-handle").tooltip("destroy");

		// Check if using top, bottom for automatic size element.
		var top = element.css("top");
		var left = element.css("left");
		var bottom = element.css("bottom");
		var right = element.css("right");

		// show tooltip for info
		if(element.css("position") == 'absolute'){
			if(top != "auto" && left != "auto" && bottom != "auto" && right != "auto"){

				if(top != "" && left != "" && bottom != "" && right != ""){

					if(parseInt(top) != "0px" && parseInt(left) != "" && parseInt(bottom) != "" && parseInt(right) != ""){

						if(parseInt(bottom) + parseInt(top) != 0 && parseInt(left) + parseInt(right)  != 0){

							iframe.find(".yp-selected-handle").tooltip({placement: 'left', trigger:"hover", container: iframeBody, title: l18_drag_notice});
						}

					}

				}

			}
		}

    }


    window.mouseisDown = false;
	window.styleAttrBeforeChange = null;
	window.visualResizingType = null;
	window.ResizeSelectedBorder = null;
	window.elementOffsetLeft = null;
	window.elementOffsetRight = null;


    /* ---------------------------------------------------- */
    /* Cancel Selected El. And Select The Element Function	*/
    /* ---------------------------------------------------- */
    iframe.on("click", iframe, function(evt){

    	if(evt.which == 1 || evt.which == undefined){
    		evt.stopPropagation();
			evt.preventDefault();
		}

		// Resized
    	if(body.hasClass("yp-element-resized")){
    		body.removeClass("yp-element-resized");
    		return false;
    	}

    	// Colorpicker for all elements.
    	if($("body").hasClass("yp-element-picker-active")){
    		$(".yp-element-picker-active").removeClass("yp-element-picker-active");
    		$(".yp-element-picker.active").removeClass("active");
    		return false;
    	}

    	if($(".yp_flat_colors_area:visible").length != 0){

			$(".yp-flat-colors.active").each(function(){
				$(this).trigger("click");
			});

			return false;

    	}

    	if($(".yp_meterial_colors_area:visible").length != 0){

    		$(".yp-meterial-colors.active").each(function(){
				$(this).trigger("click");
			});

			return false;

    	}

    	if($(".yp_nice_colors_area:visible").length != 0){

			$(".yp-nice-colors.active").each(function(){
				$(this).trigger("click");
			});

			return false;

    	}

    	if($(".iris-picker:visible").length != 0){

    		$(".iris-picker:visible").each(function(){
				$(this).hide();
			});

			return false;

    	}

    	if($(".yp_background_assets:visible").length != 0){

    		$(".yp-bg-img-btn.active").each(function(){
				$(this).trigger("click");
			});

			return false;

    	}

		if($(".wqselect2-container--open").length != 0){
			
			$("select").each(function(){
				$(this).wqselect2("close");
			});
		
			return false;
			
		}
	
		var element = $(evt.target);

		if(evt.which == undefined || evt.which == 1){

			if (body.hasClass("yp-content-selected") == true){

				if(element.hasClass("yp-selected-tooltip") == true){
					$(".yp-button-target").trigger("click");
					return false;
				}else if(element.parent().length > 0){
					if(element.parent().hasClass("yp-selected-tooltip")){
						$(".yp-button-target").trigger("click");
						return false;
					}
				}

			}

			if($("body").hasClass("yp-content-selected") == true){
				
				if (iframe.find(".context-menu-active").length > 0){
					iframe.find(".yp-selected").contextMenu("hide");
				}

			}

		}
		
		if(!element.filter(":onScreen").length === 0){
			return false;
		}
		
		if (body.hasClass("yp-selector-disabled")) {
            return false;
        }

        if (body.hasClass("yp-disable-disable-yp")) {
            return false;
        }
		
        var selector = yp_get_parents(element,"default");
		
		if($(document).find(".wqselect2-container--open").length > 0 && selector == 'body'){
			return false;
		}

        if (evt.which == 1 || evt.which == undefined) {

            if (element.hasClass("yp-selected") == false) {

                if (body.hasClass("yp-content-selected") == true && element.parents(".yp-selected").length != 1) {
					
                    // remove ex
                    yp_clean();
					
					$(".yp-editor-list > li.active > h3").not(".yp-li-about").not(".yp-li-footer").trigger("click");

                    $(".wqselect2-selection__rendered").removeAttr("style");

                    body.removeAttr("data-clickable-select").removeAttr("data-yp-selector").removeClass("yp-selector-focus").removeClass("yp-selector-hover");

                    $(".yp-disable-contextmenu").removeClass("yp-disable-contextmenu");
                    $(".yp-active-contextmenu").removeClass("yp-active-contextmenu");

                    // Remove focus/hover.
                    if (body.hasClass("yp-contextmenuopen")) {
                        body.removeAttr("data-yp-selector").removeClass("yp-selector-focus").removeClass("yp-selector-hover");
                        iframe.find(".yp-selected-tooltip span").remove();
                    }

                }

            } else {

            	if(body.hasClass("yp-content-selected") == false){
                
					if(element.css("transform") != 'none' && element.css("transform") != 'inherit' && element.css("transform") != ''){
						body.addClass("yp-has-transform");
					}
					
					if(element.parent().length != 0){
						if(element.parent().css("transform") != 'none' && element.parent().css("transform") != 'inherit' && element.parent().css("transform") != ''){
							body.addClass("yp-has-transform");
						}
					
						if(element.parent().parent().length != 0){
							if(element.parent().parent().css("transform") != 'none' && element.parent().parent().css("transform") != 'inherit' && element.parent().parent().css("transform") != ''){
								body.addClass("yp-has-transform");
							}

						}

					}

					// Set selector as  body attr.
	                body.attr("data-clickable-select", selector);

	                // Add drag support
					if(iframe.find(".yp-selected").length > 0){

						element.draggable({

						  containment: iframeBody,
					      start: function() {

					      	// Get Element Style attr.
					        if(element.attr("style") == 'position:relative;'){
					        	window.styleAttr = element.attr("style");
					        }else{
					        	window.styleAttr = '';
					        	element.removeAttr("style");
					        }

					        // Remove static fixer class & Hide.
					        element.removeClass("ready-for-drag").css("visibility","hidden");

					        // Wait 2ms
					        setTimeout(function(){

					        	// Get element style.
					        	window.stylePositionType = element.css("position");

					        	// If static element, add ready-for-drag class.
					        	if(window.stylePositionType == 'static'){
					        		element.addClass("ready-for-drag");
					        	}

					        	// Show now.
					        	element.css("visibility","visible");

					    	},2);

					        // Add some classes
					    	body.addClass("yp-clean-look yp-dragging yp-hide-borders-now");

					      },
					      stop: function() {

					      	// Insert new data.
					        yp_insert_rule(yp_get_current_selector(), "top", "top", element.css("top"), '');
					        yp_insert_rule(yp_get_current_selector(), "left", "left", element.css("left"), '');
					      	
					        // Set default values for top and left options.
					        if($("li.position-option.active").length > 0){
				                $("#top-group,#left-group").each(function() {
				                    yp_set_default(".yp-selected", yp_id_hammer(this), true);
				                });
			                }else{
			                	$("li.position-option").removeAttr("data-loaded"); // delete cached data.
			                }

			                // Back To Orginal Style Attr.
			                if (typeof window.styleAttr !== typeof undefined && window.styleAttr !== false) {
							    element.attr("style",window.styleAttr);
							}else{
								element.removeAttr("style");
							}

							// Remove
			                iframe.find(".yp-selected,.yp-selected-others").removeClass("ui-draggable ui-draggable-handle ui-draggable-handle");

					        // Adding styles
							if(window.stylePositionType == 'static'){
								yp_insert_rule(yp_get_current_selector(), "position", "position", "relative", '');
							}else if(element.hasClass("ready-for-drag") == true){
								yp_insert_rule(yp_get_current_selector(), "position", "position", "relative", '');
							}

							// Remove Class.
							element.removeClass("ready-for-drag");

			                // Update css.
			                yp_option_change();

			                body.removeClass("yp-clean-look yp-dragging yp-hide-borders-now");
							
							yp_draw();

					      }

						});

					}

					// RESIZE ELEMENTS
					window.visualResizingType = 'width';
					window.ResizeSelectedBorder = "right";
					window.styleAttrBeforeChange = element.attr("style");

					window.elementOffsetLeft = element.offset().left;
					window.elementOffsetRight = element.offset().right;

					element.width(parseFloat(element.width()+10));

					if(window.elementOffsetLeft == element.offset().left && window.elementOffsetRight != element.offset().right){

						window.ResizeSelectedBorder = "right";

					}else if(window.elementOffsetLeft != element.offset().left && window.elementOffsetRight == element.offset().right){
						window.ResizeSelectedBorder = "left";
						body.addClass("yp-left-selected-resizeable");
					}else{
						window.ResizeSelectedBorder = "right";
					}

					if (typeof window.styleAttrBeforeChange !== typeof undefined && window.styleAttrBeforeChange !== false){
						element.attr("style",window.styleAttrBeforeChange);
					}else{
						element.removeAttr("style");
						window.styleAttrBeforeChange = null;
					}

	                // element selected
	                body.addClass("yp-content-selected");

					// Disable focus style after clicked.
					element.blur();

                }

            }

        }
		
		yp_draw();
		yp_resize();

    });

	
	// Width Change visual.
	iframe.on("mousedown",'.yp-selected-boxed-left,.yp-selected-boxed-right', function(){

		if(body.hasClass("yp-content-selected") == false){
			return false;
		}

		if($(this).hasClass(".yp-selected-boxed-left") && window.ResizeSelectedBorder == 'right'){
			return false;
		}

		window.visualResizingType = 'width';

		if(body.hasClass("yp-left-selected-resizeable")){
			window.ResizeSelectedBorder = "left";
		}else{
			window.ResizeSelectedBorder = "right";
		}

		window.mouseisDown = true;

		body.addClass("yp-element-resizing");


	});


	// Height Change visual.
	iframe.on("mousedown",'.yp-selected-boxed-bottom', function(){

		if(body.hasClass("yp-content-selected") == false){
			return false;
		}

		// Update variables
		window.mouseisDown = true;

		window.visualResizingType = 'height';
		window.ResizeSelectedBorder = "bottom";

		body.addClass("yp-element-resizing");

	});


	// Visual resizer
	iframe.on("mousemove",iframe, function(event){

		if(window.mouseisDown == true){

			event = event || window.event;

		    // cache
		    var element = iframe.find(".yp-selected");

		    // If width
		    if(window.visualResizingType == "width"){

		    	if(window.ResizeSelectedBorder == 'right'){
			    	var otherPos = 'left';
					var width = parseFloat(event.pageX)-parseFloat(iframe.find(".yp-selected-boxed-"+otherPos).css("left"));
			    }else{
			    	var otherPos = 'right';
			    	var width = parseFloat(iframe.find(".yp-selected-boxed-"+otherPos).css("left"))-parseFloat(event.pageX);
			    }

				// Min 4px
				if(width > 4){

					element.css("width",width);

					yp_draw();

				}

				body.addClass("yp-element-resizing-width-"+window.ResizeSelectedBorder);

			}else if(window.visualResizingType == "height"){ // else height

				if(window.ResizeSelectedBorder == 'top'){
			    	var otherPos = 'bottom';
			    }else{
			    	var otherPos = 'top';
			    }

				// Total width
				var height = parseFloat(event.pageY)-parseFloat(element.offset().top);

				// Min 4px
				if(height > 4){

					element.css("height",height);

					yp_draw();

				}

				body.addClass("yp-element-resizing-height-"+window.ResizeSelectedBorder);

			}

		}

	});


	// End visual resizer now
	iframe.on("mouseup",iframe, function(){

		if(body.hasClass("yp-element-resizing")){

			// cache
			var element = iframe.find(".yp-selected");

			// get result
			var width = parseFloat(element.css(window.visualResizingType)).toString();
			
			// insert to data.
			yp_insert_rule(yp_get_current_selector(), window.visualResizingType, window.visualResizingType, width,'px');

			//return to default
			if (typeof window.styleAttrBeforeChange !== typeof undefined || window.styleAttrBeforeChange !== false){
				element.attr("style",window.styleAttrBeforeChange);
			}else{
				element.removeAttr("style");
			}

			// Update
			yp_option_change();

			// Set default values for top and left options.
			if($("li.size-option.active").length > 0){

				if(body.hasClass("yp-element-resizing-height-bottom")){
					yp_set_default(".yp-selected", yp_id_hammer($("#height-group")), true);
				}else{
					yp_set_default(".yp-selected", yp_id_hammer($("#width-group")), true);
				}

			}else{
				$("li.size-option").removeAttr("data-loaded"); // delete cached data.
			}


			body.removeClass("yp-element-resizing").removeClass("yp-element-resizing-height-bottom").removeClass("yp-element-resizing-width-left").removeClass("yp-element-resizing-width-right").addClass("yp-element-resized");

			setTimeout(function(){

				yp_draw();

			},5);

			window.mouseisDown = false;

		}

	});


	// Load default value after setting pane hover
	// because I not want load ":hover" values.
	body.on('mousedown', '.yp-editor-list > li:not(.yp-li-footer):not(.yp-li-about):not(.active)', function (){

		if(body.hasClass("yp-content-selected") == true){

			// Get data
			var data = $(this).attr("data-loaded");

			// If no data, so set.
			if (typeof data == typeof undefined || data == false){

				// Set default values
				$(this).find(".yp-option-group").each(function(){
					yp_set_default(".yp-selected", yp_id_hammer(this), false);
				});

				// cache to loaded data.
				$(this).attr("data-loaded","true");

			}

		}

	});


	// Update boxes while mouse over and out selected elements.
	iframe.on("mouseout mouseover", '.yp-selected,.yp-selected-others',function(){

		if(body.hasClass("yp-content-selected")){
			setTimeout(function(){
				yp_draw();
			},5);
		}

	});



    /* ---------------------------------------------------- */
    /* Option None / Disable Buttons						*/
    /* ---------------------------------------------------- */
    /*
		none and disable button api.
    */
    $(".yp-btn-action").click(function(e) {

        var elementPP = $(this).parent().parent().parent();

        // inherit, none etc.
        if ($(this).hasClass("yp-none-btn")){

            if (elementPP.find(".yp-disable-btn.active").length >= 0) {
                elementPP.find(".yp-disable-btn.active").trigger("click");

                if (e.originalEvent) {
					elementPP.addClass("eye-enable");
				}

            }

            var prefix = '';

            // If slider
            if (elementPP.hasClass("yp-slider-option")) {

                var id = elementPP.attr("id").replace("-group", "");

                if ($(this).hasClass("active")) {

                    $(this).removeClass("active");

                    // Show
                    elementPP.find(".yp-after").show();

                    // Is Enable
                    elementPP.find(".yp-after-disable").hide();

                    // Value
                    var value = $("#yp-" + id).val();
                    var prefix = $("#" + id + "-after").val();

                } else {

                    $(this).addClass("active");

                    // Hide
                    elementPP.find(".yp-after").hide();

                    // Is Disable
                    elementPP.find(".yp-after-disable").show();

                    // Value
                    var value = elementPP.find(".yp-none-btn").text();

                }

            // If is radio
            } else if (elementPP.find(".yp-radio-content").length > 0) {

                var id = elementPP.attr("id").replace("-group", "");

                if ($(this).hasClass("active")) {

                    $(this).removeClass("active");

                    // Value
                    var value = $("input[name=" + id + "]:checked").val();

                    $("input[name=" + id + "]:checked").parent().addClass("active");

                } else {

                    $(this).addClass("active");

                    elementPP.find(".yp-radio.active").removeClass("active");

                    // Value
                    var value = elementPP.find(".yp-none-btn").text();

                }

                // If is select
            } else if (elementPP.find("select").length > 0) {

                var id = elementPP.attr("id").replace("-group", "");

                if ($(this).hasClass("active")) {

                    $(this).removeClass("active");

                    // Is Enable
                    elementPP.find(".yp-after-disable").hide();

                    // Value
                    var value = $("#yp-" + id).val();

                } else {

                    $(this).addClass("active");

                    // Is Enable
                    elementPP.find(".yp-after-disable").show();

                    // Value
                    var value = elementPP.find(".yp-none-btn").text();

                }

            } else {

                var id = elementPP.attr("id").replace("-group", "");

                if ($(this).hasClass("active")) {

                    $(this).removeClass("active");

                    // Is Disable
                    elementPP.find(".yp-after-disable").hide();

                    // Value
                    var value = $("#yp-" + id).val();

                } else {

                    $(this).addClass("active");

                    // Is Enable
                    elementPP.find(".yp-after-disable").show();

                    // Value
                    var value = 'transparent';

                }

            }

            var selector = yp_get_current_selector();
            var css = $("#" + id + "-group").data("css");
			
			if(id == 'background-image'){

				if(value.indexOf("//") != -1){
					value = "url("+value+")";
				}

				if(value == 'transparent'){
					value = 'none';
				}

			}

            if (e.originalEvent) {

                yp_insert_rule(selector, id, css, value, prefix);
                yp_option_change();

            }else if(id == 'background-repeat' || id == 'background-size'){
				
				if($(".yp_background_assets:visible").length > 0){
					yp_insert_rule(selector, id, css, value, prefix);
					yp_option_change();
				}
				
			}

        } else { // disable this option

            // Prefix.
            var prefix = '';

            // If slider
            if (elementPP.hasClass("yp-slider-option")){

                var id = elementPP.attr("id").replace("-group", "");

                if ($(this).hasClass("active")) {

                    $(this).removeClass("active");
                    elementPP.css("opacity",1);

                    // Show
                    elementPP.find(".yp-after").show();

                    // Is Enable
                    elementPP.find(".yp-after-disable-disable").hide();

                    // Value
                    if(!elementPP.find(".yp-none-btn").hasClass("active")){
                    	var value = $("#yp-" + id).val();
                    	var prefix = $("#" + id + "-after").val();
                    }else{
                    	var value = elementPP.find(".yp-none-btn").text();
                    }
                    

                } else {

                    $(this).addClass("active");
                    elementPP.css("opacity",0.5);

                    // Hide
                    elementPP.find(".yp-after").hide();

                    // Is Disable
                    elementPP.find(".yp-after-disable-disable").show();

                    // Value
                    var value = 'disable';

                }

            // If is radio
            } else if (elementPP.find(".yp-radio-content").length > 0) {

                var id = elementPP.attr("id").replace("-group", "");

                if ($(this).hasClass("active")) {

                    $(this).removeClass("active");
                    elementPP.css("opacity",1);

                    // Value
                    if(!elementPP.find(".yp-none-btn").hasClass("active")){
                    	var value = $("input[name=" + id + "]:checked").val();
                    }else{
                    	var value = elementPP.find(".yp-none-btn").text();
                    }

                } else {

                    $(this).addClass("active");
                    elementPP.css("opacity",0.5);

                    // Value
                    var value = 'disable';

                }

              // If is select
            } else if (elementPP.find("select").length > 0) {

                var id = elementPP.attr("id").replace("-group", "");

                if ($(this).hasClass("active")) {

                    $(this).removeClass("active");
                    elementPP.css("opacity",1);

                    // Is Enable
                    elementPP.find(".yp-after-disable-disable").hide();

                    // Value
                    if(!elementPP.find(".yp-none-btn").hasClass("active")){
                    	var value = $("#yp-" + id).val();
                    }else{
                    	var value = elementPP.find(".yp-none-btn").text();
                    }

                } else {

                    $(this).addClass("active");
                    elementPP.css("opacity",0.5);

                    // Is Enable
                    elementPP.find(".yp-after-disable-disable").show();

                    // Value
                    var value = 'disable';

                }

            } else {

                var id = elementPP.attr("id").replace("-group", "");

                if ($(this).hasClass("active")) {

                    $(this).removeClass("active");
                    elementPP.css("opacity",1);

                    // Is Disable
                    elementPP.find(".yp-after-disable-disable").hide();

                    // Value
                    if(!elementPP.find(".yp-none-btn").hasClass("active")){
                    	var value = $("#yp-" + id).val();
                    }else{
                    	var value = elementPP.find(".yp-none-btn").text();
                    }

                } else {

                    $(this).addClass("active");
                    elementPP.css("opacity",0.5);

                    // Is Enable
                    elementPP.find(".yp-after-disable-disable").show();

                    // Value
                    var value = 'disable';

                }

                if(id == 'background-image'){

					if(value.indexOf("//") != -1){
						value = "url("+value+")";
					}

					if(value == 'transparent'){
						value = 'none';
					}

				}

            }

            var selector = yp_get_current_selector();
            var css = $("#" + id + "-group").data("css");
				
			if (e.originalEvent) {

				yp_insert_rule(selector, id, css, value, prefix);

			}

            yp_draw();

            if (e.originalEvent) {
                yp_option_change();
			}

        }

        yp_resize();

    });

	

    /* ---------------------------------------------------- */
    /* Collapse List 										*/
    /* ---------------------------------------------------- */
    $(".yp-editor-list > li > h3").click(function() {

        if ($(this).parent().hasClass("yp-li-about") || $(this).parent().hasClass("yp-li-footer")) {
            return '';
        }

        $(this).parent().addClass("current");

        // Disable.
        $(".yp-editor-list > li.active:not(.current)").each(function(){

			$(".yp-editor-list > li").show(0);
            $(this).find(".yp-this-content").hide(0).parent().removeClass("active");

        });


        if ($(this).parent().hasClass("active")) {
            $(this).parent().removeClass("active");
        } else {
            $(this).parent().addClass("active");
			$(".yp-editor-list > li:not(.active)").hide(0);
        }

        $(this).parent().find(".yp-this-content").toggle(0);
        $(this).parent().removeClass("current");
		
		if($(".yp-close-btn.dashicons-menu").length > 0){
			$(".yp-close-btn").removeClass("dashicons-menu").addClass("dashicons-no-alt");
		}
		
		if($(".yp-editor-list > li.active:not(.yp-li-about):not(.yp-li-footer) > h3").length > 0){
			$(".yp-close-btn").removeClass("dashicons-no-alt").addClass("dashicons-menu");
		}

		$('.yp-editor-list').scrollTop(0);
		
		yp_resize();

    });




    /* ---------------------------------------------------- */
    /* Filters		 										*/
    /* ---------------------------------------------------- */
    function yp_num(a) {
		if(typeof a !== "undefined" && a != ''){
			if(a.replace(/[^\d.-]/g, '') === null || a.replace(/[^\d.-]/g, '') === undefined){
				return 0;
			}else{
				return a.replace(/[^\d.-]/g, '');
			}
		}else{
			return 0;
		}
    }

    function yp_alfa(a) {
		if(typeof a !== "undefined" && a != ''){
			return a.replace(/\d/g, '').replace(".px", "px");
		}else{
			return '';
		}
    }

    var yp_id = function(str) {
		if(typeof str !== "undefined" && str != ''){
			str = str.replace(/\W+/g, "");
			return str;
		}else{
			return '';
		}
    }
	
	function yp_cleanArray(actual){
	  var newArray = new Array();
	  for(var i = 0; i<actual.length; i++){
		  if (actual[i]){
			newArray.push(actual[i]);
		}
	  }
	  return newArray;
	}



    /* ---------------------------------------------------- */
    /* Info About class or tagName							*/
    /* ---------------------------------------------------- */
    function yp_tag_info($a, $selector) {

        var $length = $selector.split(window.separator).length - 1;
        var $no = $selector.split(window.separator)[$length].toUpperCase();
        var $n = $selector.split(window.separator)[$length].toUpperCase().replace(/[^\w\s]/gi, '');

        if ($length > 1) {
            var $Pname = $selector.split(window.separator)[$length - 1].toUpperCase().replace(/[^\w\s]/gi, '')
        } else {
            var $Pname = '';
        }

        if ($length > 2) {
            var $PPname = $selector.split(window.separator)[$length - 2].toUpperCase().replace(/[^\w\s]/gi, '')
        } else {
            var $PPname = '';
        }


        // Parrent Class
        if ($PPname == 'LOGO' || $PPname == 'SITETITLE' || $Pname == 'LOGO' || $Pname == 'SITETITLE') {
            return l18_logo;
        } else if ($n == 'MAPCANVAS') {
            return l18_google_map;
        }
        if ($Pname == 'ENTRYTITLE' && $a == 'A') {
            return l18_entry_title_link;
        } else if ($Pname == 'CATLINKS' && $a == 'A') {
            return l18_category_link;
        } else if ($Pname == 'TAGSLINKS' && $a == 'A') {
            return l18_tag_link;
        }

        // Current Class
        if ($n == 'WIDGET') {
            return l18_widget;
        } else if ($n == 'FA' || $no.indexOf("FA-") >= 0) {
            return l18_font_awesome_icon;
        } else if ($n == 'SUBMIT' && $a == 'INPUT') {
            return l18_submit_button;
        } else if ($n == 'MENUITEM') {
            return l18_menu_item;
        } else if ($n == 'ENTRYMETA' || $n == 'ENTRYMETABOX' || $n == 'POSTMETABOX') {
            return l18_post_meta_division;
        } else if ($n == 'COMMENTREPLYTITLE') {
            return l18_comment_reply_title;
        } else if ($n == 'LOGGEDINAS') {
            return l18_login_info;
        } else if ($n == 'FORMALLOWEDTAGS') {
            return l18_allowed_tags;
        } else if ($n == 'LOGO') {
            return l18_logo;
        } else if ($n == 'ENTRYTITLE' || $n == 'POSTTITLE') {
            return l18_post_title;
        } else if ($n == 'COMMENTFORM') {
            return l18_comment_form;
        } else if ($n == 'WIDGETTITLE') {
            return l18_widget_title;
        } else if ($n == 'TAGCLOUD') {
            return l18_tag_cloud;
        } else if ($n == 'ROW') {
            return l18_row;
        } else if ($n == 'BUTTON') {
            return l18_button;
        } else if ($n == 'BTN') {
            return l18_button;
        } else if ($n == 'LEAD') {
            return l18_lead;
        } else if ($n == 'WELL') {
            return l18_well;
        } else if ($n == 'ACCORDIONTOGGLE') {
            return l18_accordion_toggle;
        } else if ($n == 'PANELBODY') {
            return l18_accordion_content;
        } else if ($n == 'ALERT') {
            return l18_alert_division;
        } else if ($n == 'FOOTERCONTENT') {
            return l18_footer_content;
        } else if ($n == 'GLOBALSECTION') {
            return l18_global_section;
        } else if ($n == 'MORELINK') {
            return l18_show_more_link;
        } else if ($n == 'CONTAINER') {
            return l18_wrapper;
        } else if ($n == 'DEFAULTTITLE') {
            return l18_article_title;


            // Bootstrap Columns
        } else if ($n == 'COLMD1' || $n == 'MEDIUM1' || $n == 'LARGE1' || $n == 'SMALL1') {
            return l18_column + ' 1/12';
        } else if ($n == 'COLMD2' || $n == 'MEDIUM2' || $n == 'LARGE2' || $n == 'SMALL2') {
            return l18_column + ' 2/12';
        } else if ($n == 'COLMD3' || $n == 'MEDIUM3' || $n == 'LARGE3' || $n == 'SMALL3') {
            return l18_column + ' 3/12';
        } else if ($n == 'COLMD4' || $n == 'MEDIUM4' || $n == 'LARGE4' || $n == 'SMALL4') {
            return l18_column + ' 4/12';
        } else if ($n == 'COLMD5' || $n == 'MEDIUM5' || $n == 'LARGE5' || $n == 'SMALL5') {
            return l18_column + ' 5/12';
        } else if ($n == 'COLMD6' || $n == 'MEDIUM6' || $n == 'LARGE6' || $n == 'SMALL6') {
            return l18_column + ' 6/12';
        } else if ($n == 'COLMD7' || $n == 'MEDIUM7' || $n == 'LARGE7' || $n == 'SMALL7') {
            return l18_column + ' 7/12';
        } else if ($n == 'COLMD8' || $n == 'MEDIUM8' || $n == 'LARGE8' || $n == 'SMALL8') {
            return l18_column + ' 8/12';
        } else if ($n == 'COLMD9' || $n == 'MEDIUM9' || $n == 'LARGE9' || $n == 'SMALL9') {
            return l18_column + ' 9/12';
        } else if ($n == 'COLMD10' || $n == 'MEDIUM10' || $n == 'LARGE10' || $n == 'SMALL10') {
            return l18_column + ' 10/12';
        } else if ($n == 'COLMD11' || $n == 'MEDIUM11' || $n == 'LARGE11' || $n == 'SMALL11') {
            return l18_column + ' 11/12';
        } else if ($n == 'COLMD12' || $n == 'MEDIUM12' || $n == 'LARGE12' || $n == 'SMALL12') {
            return l18_column + ' 12/12';
        } else if ($n == 'COLXS1') {
            return l18_column + ' 1/12';
        } else if ($n == 'COLXS2') {
            return l18_column + ' 2/12';
        } else if ($n == 'COLXS3') {
            return l18_column + ' 3/12';
        } else if ($n == 'COLXS4') {
            return l18_column + ' 4/12';
        } else if ($n == 'COLXS5') {
            return l18_column + ' 5/12';
        } else if ($n == 'COLXS6') {
            return l18_column + ' 6/12';
        } else if ($n == 'COLXS7') {
            return l18_column + ' 7/12';
        } else if ($n == 'COLXS8') {
            return l18_column + ' 8/12';
        } else if ($n == 'COLXS9') {
            return l18_column + ' 9/12';
        } else if ($n == 'COLXS10') {
            return l18_column + ' 10/12';
        } else if ($n == 'COLXS11') {
            return l18_column + ' 11/12';
        } else if ($n == 'COLXS12') {
            return l18_column + ' 12/12';
        } else if ($n == 'COLSM1') {
            return l18_column + ' 1/12';
        } else if ($n == 'COLSM2') {
            return l18_column + ' 2/12';
        } else if ($n == 'COLSM3') {
            return l18_column + ' 3/12';
        } else if ($n == 'COLSM4') {
            return l18_column + ' 4/12';
        } else if ($n == 'COLSM5') {
            return l18_column + ' 5/12';
        } else if ($n == 'COLSM6') {
            return l18_column + ' 6/12';
        } else if ($n == 'COLSM7') {
            return l18_column + ' 7/12';
        } else if ($n == 'COLSM8') {
            return l18_column + ' 8/12';
        } else if ($n == 'COLSM9') {
            return l18_column + ' 9/12';
        } else if ($n == 'COLSM10') {
            return l18_column + ' 10/12';
        } else if ($n == 'COLSM11') {
            return l18_column + ' 11/12';
        } else if ($n == 'COLSM12') {
            return l18_column + ' 12/12';
        } else if ($n == 'COLLG1') {
            return l18_column + ' 1/12';
        } else if ($n == 'COLLG2') {
            return l18_column + ' 2/12';
        } else if ($n == 'COLLG3') {
            return l18_column + ' 3/12';
        } else if ($n == 'COLLG4') {
            return l18_column + ' 4/12';
        } else if ($n == 'COLLG5') {
            return l18_column + ' 5/12';
        } else if ($n == 'COLLG6') {
            return l18_column + ' 6/12';
        } else if ($n == 'COLLG7') {
            return l18_column + ' 7/12';
        } else if ($n == 'COLLG8') {
            return l18_column + ' 8/12';
        } else if ($n == 'COLLG9') {
            return l18_column + ' 9/12';
        } else if ($n == 'COLLG10') {
            return l18_column + ' 10/12';
        } else if ($n == 'COLLG11') {
            return l18_column + ' 11/12';
        } else if ($n == 'COLLG12') {
            return l18_column + ' 12/12';
        } else if ($n == 'POSTBODY') {
            return l18_post_division;
        } else if ($n == 'POST') {
            return l18_post_division;
        } else if ($n == 'CONTENT' || $n == 'DEFAULTCONTENT') {
            return l18_content_division;
        } else if ($n == 'ENTRYTITLE') {
            return l18_entry_title;
        } else if ($n == 'ENTRYCONTENT') {
            return l18_entry_content;
        } else if ($n == 'ENTRYFOOTER') {
            return l18_entry_footer;
        } else if ($n == 'ENTRYHEADER') {
            return l18_entry_header;
        } else if ($n == 'ENTRYTIME') {
            return l18_entry_time;
        } else if ($n == 'POSTEDITLINK') {
            return l18_post_edit_link;
        } else if ($n == 'POSTTHUMBNAIL') {
            return l18_post_thumbnail;
        } else if ($n == 'THUMBNAIL') {
            return l18_thumbnail;
        } else if ($n.indexOf("ATTACHMENT") >= 0) {
            return l18_thumbnail_image;
        } else if ($n == 'EDITLINK') {
            return l18_edit_link;
        } else if ($n == 'COMMENTSLINK') {
            return l18_comments_link_division;
        } else if ($n == 'SITEDESCRIPTION') {
            return l18_site_description;
        } else if ($n == 'POSTCLEAR' || $n == 'POSTBREAK') {
            return l18_post_break;
        }		

        // TAG NAME START
        if ($a == 'P') {
            return l18_paragraph;
        } else if ($a == 'BR') {
            return l18_line_break;
        } else if ($a == 'HR') {
            return l18_horizontal_rule;
        } else if ($a == 'A') {
            return l18_link;
        } else if ($a == 'LI') {
            return l18_list_item;
        } else if ($a == 'UL') {
            return l18_unorganized_list;
        } else if ($a == 'OL') {
            return l18_unorganized_list;
        } else if ($a == 'IMG') {
            return l18_image;
        } else if ($a == 'B') {
            return l18_bold_tag;
        } else if ($a == 'I') {
            return l18_italic_tag;
        } else if ($a == 'STRONG') {
            return l18_strong_tag;
        } else if ($a == 'Em') {
            return l18_italic_tag;
        } else if ($a == 'BLOCKQUOTE') {
            return l18_blockquote;
        } else if ($a == 'PRE') {
            return l18_preformatted;
        } else if ($a == 'TABLE') {
            return l18_table;
        } else if ($a == 'TR') {
            return l18_table_row;
        } else if ($a == 'TD') {
            return l18_table_data;
        } else if ($a == 'HEADER' || $n == 'HEADER') {
            return l18_header_division;
        } else if ($a == 'FOOTER' || $n == 'FOOTER') {
            return l18_footer_division;
        } else if ($a == 'SECTION' || $n == 'SECTION') {
            return l18_section;
        } else if ($a == 'FORM') {
            return l18_form_division;
        } else if ($a == 'BUTTON') {
            return l18_button;
        } else if ($a == 'CENTER') {
            return l18_centred_block;
        } else if ($a == 'DL') {
            return l18_definition_list;
        } else if ($a == 'DT') {
            return l18_definition_term;
        } else if ($a == 'DD') {
            return l18_definition_description;
        } else if ($a == 'H1') {
            return l18_header + ' (' + l18_level + ' 1)';
        } else if ($a == 'H2') {
            return l18_header + ' (' + l18_level + ' 2)';
        } else if ($a == 'H3') {
            return l18_header + ' (' + l18_level + ' 3)';
        } else if ($a == 'H4') {
            return l18_header + ' (' + l18_level + ' 4)';
        } else if ($a == 'H5') {
            return l18_header + ' (' + l18_level + ' 5)';
        } else if ($a == 'H6') {
            return l18_header + ' (' + l18_level + ' 6)';
        } else if ($a == 'SMALL') {
            return l18_smaller_text;
        } else if ($a == 'TEXTAREA') {
            return l18_text_area;
        } else if ($a == 'TBODY') {
            return l18_body_of_table;
        } else if ($a == 'THEAD') {
            return l18_head_of_table;
        } else if ($a == 'TFOOT') {
            return l18_foot_of_table;
        } else if ($a == 'U') {
            return l18_underline_text;
        } else if ($a == 'SPAN') {
            return l18_span;
        } else if ($a == 'Q') {
            return l18_quotation;
        } else if ($a == 'CITE') {
            return l18_citation;
        } else if ($a == 'CODE') {
            return l18_expract_of_code;
        } else if ($a == 'NAV' || $n == 'NAVIGATION' || $n == 'NAVIGATIONCONTENT') {
            return l18_navigation;
        } else if ($a == 'LABEL') {
            return l18_label;
        } else if ($a == 'TIME') {
            return l18_time;
        } else if ($a == 'DIV') {
            return l18_division;
        } else if ($a == 'CAPTION') {
            return l18_caption_of_table;
        } else if ($a == 'INPUT') {
            return l18_input;
        } else {
            return $a.toLowerCase();
        }

    }

	
	// disable jquery plugins. // Parallax.
	$("#yp-background-parallax .yp-radio").click(function(){

		var v = $(this).find("input").val();
		
		if(v == 'disable'){
			iframe.find(yp_get_current_selector()).addClass("yp-parallax-disabled");
		}else{
			iframe.find(yp_get_current_selector()).removeClass("yp-parallax-disabled");
		}

	});
	

    // Update saved btn
    function yp_option_change() {
		
        $(".yp-save-btn").html(save).removeClass("yp-disabled").addClass("waiting-for-save");
		
		var caller = setTimeout(function(){
			
			// Call CSS Engine.
			$(document).CallCSSEngine(yp_get_clean_css());
			
		},200);
		
		setTimeout(function(){
		editor.setValue(yp_get_clean_css());
		},200);

    }


    // Update saved btn
    function yp_option_update() {
        $(".yp-save-btn").html(saved).addClass("yp-disabled").removeClass("waiting-for-save");
    }


    // Wait until CSS process.
       function yp_process(close,id,type){

       	// close css editor with process..
		if(close == true){

			$("#cssData,#cssEditorBar,#leftAreaEditor").hide();
			iframeBody.trigger("scroll");
			$("body").removeClass("yp-css-editor-active");
				
			// Update All.
			yp_draw();

		}

		// IF not need to process, stop here.
       	if(body.hasClass("yp-need-to-process") == false){
       		return false;
       	}

       	// Remove class.
       	body.removeClass("yp-need-to-process");

       	// No need if empty.
       	if(editor.getValue() == ''){
       		return false;
       	}

       	// Processing.
		if(body.find(".yp-processing").length == 0){
			body.addClass("yp-processing-now");
			body.append("<div class='yp-processing'><span></span><p>"+l18_process+"</p></div>");
		}else{
			body.addClass("yp-processing-now");
			body.find(".yp-processing").show();
		}

		setTimeout(function(){

			yp_cssToData('desktop');
			yp_cssToData('tablet');
			yp_cssToData('mobile');
			body.removeClass("process-by-code-editor");

			setTimeout(function(){
				body.removeClass("yp-processing-now");
				body.find(".yp-processing").hide();
				editor.setValue(yp_get_clean_css());
			},5);

			// Save
			if(id != false){
				var posting = $.post(ajaxurl, {
					action: "yp_ajax_save",
					yp_id: id,
					yp_stype: type,
					yp_data: yp_get_clean_css(),
					yp_editor_data: yp_get_styles_area()
				});
				
				// Done.
				posting.complete(function(data) {
					$(".yp-save-btn").html(saved).addClass("yp-disabled").removeClass("waiting-for-save");
				});
			}

		},50);

	}


    //Function to convert hex format to a rgb color
    function rgb2hex(rgb) {
		if(typeof rgb !== 'undefined'){
        rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
        return (rgb && rgb.length === 4) ? "#" + ("0" + parseInt(rgb[1], 10).toString(16)).slice(-2) + ("0" + parseInt(rgb[2], 10).toString(16)).slice(-2) + ("0" + parseInt(rgb[3], 10).toString(16)).slice(-2) : '';
		}else{
			return '';
		}
    }
	

	// Check if font available
	function isFontAvailable (font) {
		var testString  = '~iomwIOMW';
		var containerId = 'is-font-available-container';
		
		var fontArray = font instanceof Array;
		
		if (!fontArray) {
			font = [ font ];
		}
		
		var fontAvailability = [];
		
		var containerSel = '#' + containerId;
		var spanSel      = containerSel + ' span';
			
		var familySansSerif = 'sans-serif';
		var familyMonospace = 'monospace, monospace';
		// Why monospace twice? It's a bug in the Mozilla and Webkit rendering engines:
		// http://www.undermyhat.org/blog/2009/09/css-font-family-monospace-renders-inconsistently-in-firefox-and-chrome/

		// DOM:
		iframeBody.append('<div id="' + containerId + '"></div>');
		iframe.find(containerSel).append('<span></span>');
		iframe.find(spanSel).append(document.createTextNode(testString));
		
		// CSS:
		iframe.find(containerSel).css('visibility', 'hidden');
		iframe.find(containerSel).css('position', 'absolute');
		iframe.find(containerSel).css('left', '-9999px');
		iframe.find(containerSel).css('top', '0');
		iframe.find(containerSel).css('font-weight', 'bold');
		iframe.find(containerSel).css('font-size', '200px !important');
		
		jQuery.each( font, function (i, v) {
			iframe.find(spanSel).css('font-family', v + ',' + familyMonospace );
			var monospaceFallbackWidth = iframe.find(spanSel).width();
			var monospaceFallbackHeight = iframe.find(spanSel).height();
			
			iframe.find(spanSel).css('font-family', v + ',' + familySansSerif );
			var sansSerifFallbackWidth = iframe.find(spanSel).width();
			var sansSerifFallbackHeight = iframe.find(spanSel).height();
			
			fontAvailability[i] = true
				&& monospaceFallbackWidth == sansSerifFallbackWidth
				&& monospaceFallbackHeight == sansSerifFallbackHeight;
		} );
		
		iframe.find(containerSel).remove();
		
		if (!fontArray && fontAvailability.length == 1) {
			fontAvailability = fontAvailability[0];
		}
		
		return fontAvailability;
	}

	// Clean classes by yellow pencil control classes.
	function yp_classes_clean(data){
		return data.replace(/ui-draggable-handle|yp-yellow-pencil-loaded|yp-element-resized|yp-selected-handle|yp-parallax-disabled|ready-for-drag|yp_onscreen|yp_hover|yp_click|yp_focus|yp-selected-others|yp-selected|yp-demo-link|yp-live-editor-link|yp-yellow-pencil|wt-yellow-pencil|yp-content-selected|yp-hide-borders-now|ui-draggable|yp-target-active|yp-yellow-pencil-disable-links|yp-closed|yp-medium-device|yp-small-device|yp-large-device|yp-metric-disable|yp-css-editor-active|wtfv|yp-clean-look|yp-has-transform|yp-will-selected|yp-selected|yp-fullscreen-editor|context-menu-active|yp-yellow-pencil-demo-mode|yp-element-resizing|yp-element-resizing-width-left|yp-element-resizing-width-right|yp-element-resizing-height-top|yp-element-resizing-height-bottom|context-menu-active|yp-left-selected-resizeable/gi,'');
	}


	// Browser fullscreen
	function toggleFullScreen(elem) {
	    // ## The below if statement seems to work better ## if ((document.fullScreenElement && document.fullScreenElement !== null) || (document.msfullscreenElement && document.msfullscreenElement !== null) || (!document.mozFullScreen && !document.webkitIsFullScreen)) {
	    if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
	        if (elem.requestFullScreen) {
	            elem.requestFullScreen();
	        } else if (elem.mozRequestFullScreen) {
	            elem.mozRequestFullScreen();
	        } else if (elem.webkitRequestFullScreen) {
	            elem.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
	        } else if (elem.msRequestFullscreen) {
	            elem.msRequestFullscreen();
	        }
	        body.addClass("yp-fullscreen");
	    } else {
	        if (document.cancelFullScreen) {
	            document.cancelFullScreen();
	        } else if (document.mozCancelFullScreen) {
	            document.mozCancelFullScreen();
	        } else if (document.webkitCancelFullScreen) {
	            document.webkitCancelFullScreen();
	        } else if (document.msExitFullscreen) {
	            document.msExitFullscreen();
	        }
	        body.removeClass("yp-fullscreen");
	    }
	}

} // Yellow Pencil main function.
	
}(jQuery));