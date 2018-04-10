<div class="section-stream" id="streams-update-<?php echo $id?>" data-view-mode="streams-update">
<input type="hidden" name="stream-<?php echo $id?>-id" class="stream-id-value" value="<?php echo $id?>"/>
<div class="section" id="stream-name-<?php echo $id?>">
	<h1>Edit stream name <span class="admin-button grey-button button-go-back">Go back to list</span></h1>
	<p><input type="text" name="stream-<?php echo $id?>-name" placeholder="Type name of stream."/></p>
	<span id="stream-name-sbmt-<?php echo $id?>" class="admin-button green-button submit-button">Save Changes</span>
</div>
<div class="section" id="stream-feeds-<?php echo $id?>">
	<input type="hidden" name="stream-<?php echo $id?>-feeds"/>
	<h1>Feeds in your stream <span class="admin-button green-button button-add">Add social feed</span></h1>
	<table>
		<thead>
		<tr>
			<th></th>
			<th>Feed</th>
			<th>Settings</th>
		</tr>
		</thead>
		<tbody>
		%LIST%
		</tbody>
	</table>
	<div class="popup" id="feeds-settings-<?php echo $id?>">
		<i class="popupclose flaticon-close-4"></i>
		<div class="section">
			<div class="networks-choice add-feed-step">
				<h1>Add feed to your stream</h1>
				<p class="desc">Choose one social network and then set up what content to show.</p>
				<ul class="networks-list">
					<li class="network-twitter" data-network="twitter" data-network-name="Twitter"><i class="flaticon-twitter"></i></li>
					<li class="network-facebook" data-network="facebook" data-network-name="Facebook"><i class="flaticon-facebook"></i></li>
					<li class="network-google" data-network="google" data-network-name="Google +"><i class="flaticon-google"></i></li>
					<li class="network-pinterest" data-network="pinterest" data-network-name="Pinterest"><i class="flaticon-pinterest"></i></li><br>
					<li class="network-instagram" data-network="instagram" data-network-name="Instagram"><i class="flaticon-instagram"></i></li>
					<li class="network-youtube" data-network="youtube" data-network-name="YouTube"><i class="flaticon-youtube"></i></li>
					<li class="network-wordpress" data-network="wordpress" data-network-name="WordPress"><i class="flaticon-wordpress"></i></li>
					<li class="network-rss" data-network="rss" data-network-name="RSS"><i class="flaticon-rss"></i></li>
				</ul>
			</div>
			<div class="networks-content  add-feed-step">
				%FEEDS%
				<p class="feed-popup-controls add">
					<span id="networks-sbmt-<?php echo $id?>" class="admin-button green-button submit-button">Add feed</span><span class="space"></span><span class="admin-button grey-button button-go-back">Back to first step</span>
				</p>
				<p class="feed-popup-controls edit">
					<span id="networks-sbmt-<?php echo $id?>" class="admin-button green-button submit-button">Save changes</span>
				</p>
			</div>
		</div>
	</div>
</div>
<div class="section" id="stream-settings-<?php echo $id?>">
	<h1>Stream general settings</h1>
	<dl class="section-settings section-compact">
		<dt>Items order</dt>
		<dd>
			<input id="stream-<?php echo $id?>-date-order" type="radio" name="stream-<?php echo $id?>-order" checked value="compareByTime"/>
			<label for="stream-<?php echo $id?>-date-order">By Date</label>
			<input id="stream-<?php echo $id?>-random-order" type="radio" name="stream-<?php echo $id?>-order" value="randomCompare"/>
			<label for="stream-<?php echo $id?>-random-order">Random</label>
		</dd>
		<dt>Display last
		<p class="desc">Leave fields empty for default values</p>
		</dt>
		<dd><input type="text"  name="stream-<?php echo $id?>-posts" value="20" class="short clearcache"/> posts <span class="space"></span><input type="text" class="short clearcache" name="stream-<?php echo $id?>-days"/> days</dd>

		<dt class="multiline">Cache
		<p class="desc">Caching stream data to reduce loading time</p></dt>
		<dd>
			<label for="stream-<?php echo $id?>-cache"><input id="stream-<?php echo $id?>-cache" class="switcher clearcache" type="checkbox" name="stream-<?php echo $id?>-cache" checked value="yep"/><div><div></div></div></label>
		</dd>
		<dt class="multiline">Cache lifetime
		<p class="desc">Make it longer if you rarely update source feed</p></dt>
		<dd>
			<label for="stream-<?php echo $id?>-cache-lifetime"><input id="stream-<?php echo $id?>-cache-lifetime" class="short clearcache" type="text" name="stream-<?php echo $id?>-cache-lifetime" value="10"/> minutes</label>
		</dd>

		<dt class="multiline">Show lightbox when clicked
		<p class="desc">Otherwise click will open original URL</p></dt>
		<dd>
			<label for="stream-<?php echo $id?>-gallery"><input id="stream-<?php echo $id?>-gallery" class="switcher" type="checkbox" checked name="stream-<?php echo $id?>-gallery" value="yep"/><div><div></div></div></label>
		</dd>

		<dt class="multiline">Private stream<p class="desc">Show only for logged in users</p></dt>
		<dd>
			<label for="stream-<?php echo $id?>-private"><input id="stream-<?php echo $id?>-private" class="switcher" type="checkbox" name="stream-<?php echo $id?>-private" value="yep"/><div><div></div></div></label>
		</dd>
		<dt>Hide stream on a desktop</dt>
		<dd>
			<label for="stream-<?php echo $id?>-hide-on-desktop"><input id="stream-<?php echo $id?>-hide-on-desktop" class="switcher" type="checkbox" name="stream-<?php echo $id?>-hide-on-desktop" value="yep"/><div><div></div></div></label>
		</dd>
		<dt>Hide stream on a mobile device</dt>
		<dd>
			<label for="stream-<?php echo $id?>-hide-on-mobile"><input id="stream-<?php echo $id?>-hide-on-mobile" class="switcher" type="checkbox" name="stream-<?php echo $id?>-hide-on-mobile" value="yep"/><div><div></div></div></label>
		</dd>
	</dl>
	<span id="stream-settings-sbmt-<?php echo $id?>" class="admin-button green-button submit-button">Save Changes</span>
</div>

<div class="section" id="cont-settings-<?php echo $id?>">
	<h1>Stream container settings</h1>
	<dl class="section-settings section-compact">
		<dt class="multiline">Stream heading
		<p class="desc">Leave empty to not show</p></dt>
		<dd>
			<input id="stream-<?php echo $id?>-heading" type="text" name="stream-<?php echo $id?>-heading" placeholder="Enter heading"/>
		</dd>
		<dt class="multiline">Heading and filter hover color
		<p class="desc">Click on field to open colorpicker</p>
		</dt>
		<dd>
			<input id="heading-color-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-headingcolor" type="text" value="rgb(154, 78, 141)" tabindex="-1">
		</dd>
		<dt>Stream subheading</dt>
		<dd>
			<input id="stream-<?php echo $id?>-subheading" type="text" name="stream-<?php echo $id?>-subheading" placeholder="Enter subheading"/>
		</dd>
		<dt class="multiline">Subheading color
		<p class="desc">You can also paste color in input</p>
		</dt>
		<dd>
			<input id="subheading-color-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-subheadingcolor" type="text" value="rgb(114, 112, 114)" tabindex="-1">
		</dd>
		<dt><span class="valign">Heading and subheading alignment</span></dt>
		<dd class="">
			<div class="select-wrapper">
				<select name="stream-<?php echo $id?>-hhalign" id="hhalign-<?php echo $id?>">
					<option value="center" selected>Centered</option>
					<option value="left">Left</option>
					<option value="right">Right</option>
				</select>
			</div>
		</dd>
		<dt class="multiline">Container background color
		<p class="desc">You can see it in preview below</p>
		</dt>
		<dd>
			<input data-prop="backgroundColor" id="bg-color-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-bgcolor" type="text" value="rgb(240, 240, 240)" tabindex="-1">
		</dd>
		<dt>Include filter and search in grid</dt>
		<dd>
			<label for="stream-<?php echo $id?>-filter"><input id="stream-<?php echo $id?>-filter" class="switcher" type="checkbox" name="stream-<?php echo $id?>-filter" checked value="yep"/><div><div></div></div></label>
		</dd>
		<dt>Filters and controls color
		</dt>
		<dd>
			<input id="filter-color-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-filtercolor" type="text" value="rgb(205, 205, 205)" tabindex="-1">
		</dd>
		<dt class="multiline">Slider on mobiles <p class="desc">On mobiles grid will turn into slider with 3 items per slide</p></dt>
		<dd>
			<label for="stream-<?php echo $id?>-mobileslider"><input id="stream-<?php echo $id?>-mobileslider" class="switcher" type="checkbox" name="stream-<?php echo $id?>-mobileslider" value="yep"/><div><div></div></div></label>
		</dd>
		<dt class="multiline">Animate grid items <p class="desc">When they appear in viewport (otherwise all items are visible immediately)</p></dt>
		<dd>
			<label for="stream-<?php echo $id?>-viewportin"><input id="stream-<?php echo $id?>-viewportin" class="switcher" type="checkbox" name="stream-<?php echo $id?>-viewportin" checked value="yep"/><div><div></div></div></label>
		</dd>

	</dl>
	<span id="stream-cont-sbmt-<?php echo $id?>" class="admin-button green-button submit-button">Save Changes</span>
</div>
<div class="section" id="stream-stylings-<?php echo $id?>">
<div class="design-step-1">
	<h1 class="desc-following">Stream layout</h1>
	<p class="desc">Choose layout to have different sets of options</p>

	<div class="choose-wrapper">
		<input name="stream-<?php echo $id?>-layout" class="clearcache" id="stream-layout-grid-<?php echo $id?>" type="radio" value="grid"/><label for="stream-layout-grid-<?php echo $id?>"><span class="choose-button"><i class="flaticon-grid"></i>Normal view (grid)</span><br><span class="desc">Universal format for any page to achieve masonry style. Min-width 300px</span></label>
		<span class="or">Or</span>
		<input name="stream-<?php echo $id?>-layout" class="clearcache" id="stream-layout-compact-<?php echo $id?>" type="radio" value="compact"/><label for="stream-layout-compact-<?php echo $id?>"><span class="choose-button"><i class="flaticon-bars"></i>Compact view</span><br><span class="desc">Special layout to put your stream in sidebar (not wider than 300px).</span></label>
	</div>
</div>
<div class="design-step-2 layout-grid">
	<h1>Grid stylings</h1>
	<dl class="section-settings section-compact">
		<dt><span class="valign">Stream theme</span></dt>
		<dd class="theme-choice">
			<input id="theme-classic-<?php echo $id?>" type="radio" class="clearcache" name="stream-<?php echo $id?>-theme" checked value="classic"/> <label for="theme-classic-<?php echo $id?>">Classic</label> <input class="clearcache" id="theme-flat-<?php echo $id?>" type="radio" name="stream-<?php echo $id?>-theme" value="flat"/> <label for="theme-flat-<?php echo $id?>">Modern</label>
		</dd>
	</dl>
	<dl class="classic-style style-choice section-settings section-compact">
		<dt><span class="valign">Classic card style</span></dt>
		<dd>
			<div class="select-wrapper">
				<select name="stream-<?php echo $id?>-gc-style" id="gc-style-<?php echo $id?>">
					<option value="style-1" selected>Centered meta, round icon</option>
					<option value="style-2">Centered meta, bubble icon</option>
					<option value="style-6">Centered meta, no social icon</option>
					<option value="style-3">Userpic, rounded icon</option>
					<option value="style-4">No userpic, rounded icon</option>
					<option value="style-5">No userpic, bubble icon</option>
				</select>
			</div>
		</dd>

		<dt class="multiline">Card background color
		<p class="desc">Click on field to open colorpicker</p>
		</dt>
		<dd>
			<input data-prop="backgroundColor" id="card-color-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-cardcolor" type="text" value="rgb(255,255,255)" tabindex="-1">
		</dd>
		<dt class="multiline">Color for heading & name
		<p class="desc">Or paste rgb() string</p>
		</dt>
		<dd>
			<input data-prop="color" id="name-color-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-namecolor" type="text" value="rgb(154, 78, 141)" tabindex="-1">
		</dd>
		<dt>Regular text color
		</dt>
		<dd>
			<input data-prop="color" id="text-color-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-textcolor" type="text" value="rgb(85,85,85)" tabindex="-1">
		</dd>
		<dt>Links color</dt>
		<dd>
			<input data-prop="color" id="links-color-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-linkscolor" type="text" value="rgb(94, 159, 202)" tabindex="-1">
		</dd>
		<dt class="multiline">Other text color
		<p class="desc">Nicknames, timestamps</p></dt>
		<dd>
			<input data-prop="color" id="other-color-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-restcolor" type="text" value="rgb(132, 118, 129)" tabindex="-1">
		</dd>
		<dt>Card shadow</dt>
		<dd>
			<input data-prop="box-shadow" id="shadow-color-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-shadow" type="text" value="rgba(0, 0, 0, 0.22)" tabindex="-1">
		</dd>
		<dt>Separator line color</dt>
		<dd>
			<input data-prop="border-color" id="bcolor-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-bcolor" type="text" value="rgba(240, 237, 231, 0.4)" tabindex="-1">
		</dd>
		<dt><span class="valign">Text alignment</span></dt>
		<dd class="">
			<div class="select-wrapper">
				<select name="stream-<?php echo $id?>-talign" id="talign-<?php echo $id?>">
					<option value="left" selected>Left</option>
					<option value="center">Centered</option>
					<option value="right">Right</option>
				</select>
			</div>
		</dd>
		<dt class="hide">Preview</dt>
		<dd class="preview">
			<h1>Live preview</h1>
			<div data-preview="bg-color" class="ff-stream-wrapper ff-layout-grid ff-theme-classic ff-style-1 shuffle">
				<div data-preview="card-color,shadow-color" class="ff-item ff-twitter shuffle-item filtered" style="visibility: visible; opacity:1;">
					<h4 data-preview="name-color">Header example</h4>
					<p data-preview="text-color">This is regular text paragraph, can be tweet, facebook post etc. This is example of <a href="#" data-preview="links-color">link in text</a>.</p>
					<span class="ff-img-holder" style="max-height: 171px"><img src="' . FlowFlow::get_plugin_directory() . '/assets/67.png" style="width:240px;"></span>
					<div class="ff-item-meta">
						<span class="separator" data-preview="bcolor"></span>
						<span class="ff-userpic" style="background:url(<?php echo FlowFlow::get_plugin_directory() ?>/assets/chevy.jpeg)"><i class="ff-icon" data-overrideProp="border-color" data-preview="card-color"><i class="ff-icon-inner"></i></i></span><a data-preview="name-color" target="_blank" rel="nofollow" href="#" class="ff-name">Looks Awesome</a><a data-preview="other-color" target="_blank" rel="nofollow" href="#" class="ff-nickname">@looks_awesome</a><a data-preview="other-color" target="_blank" rel="nofollow" href="#" class="ff-timestamp">21m ago </a>
					</div>
				</div>
			</div>
		</dd>
	</dl>

	<dl class="flat-style style-choice section-settings section-compact">
		<dt><span class="valign">Modern card style</span></dt>
		<dd class="flat-style style-choice">
			<div class="select-wrapper">
				<select name="stream-<?php echo $id?>-gf-style" id="gf-style-<?php echo $id?>">
					<option value="style-3" selected>Cornered social icon</option>
					<option value="style-1">Rounded userpic</option>
					<option value="style-2">Square userpic</option>
				</select>
			</div>
		</dd>

		<dt class="multiline">Card background color
		<p class="desc">Click on field to open colorpicker</p>
		</dt>
		<dd>
			<input data-prop="backgroundColor" id="fcolor-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-fcardcolor" type="text" value="rgb(64,68,71)" tabindex="-1">
		</dd>
		<dt class="multiline">Secondary background color
		<p class="desc">Depends on card content</p>
		</dt>
		<dd>
			<input data-prop="backgroundColor" id="fscolor-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-fscardcolor" type="text" value="rgb(44,45,46)" tabindex="-1">
		</dd>
		<dt>Heading and regular text color
		</dt>
		<dd>
			<input data-prop="color" id="ftextcolor-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-ftextcolor" type="text" value="rgb(255,255,255)" tabindex="-1">
		</dd>
		<dt>Card color for links & name
		</dt>
		<dd>
			<input data-prop="color" id="fnamecolor-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-fnamecolor" type="text" value="rgb(94,191,255);" tabindex="-1">
		</dd>
		<dt class="multiline">Color for other texts
		<p class="desc">Nickname and timestamp</p>
		</dt>
		<dd>
			<input data-prop="color" id="frest-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-frestcolor" type="text" value="rgb(175,195,208);" tabindex="-1">
		</dd>

		<dt>Separator line color</dt>
		<dd>
			<input data-prop="border-color" id="fbcolor-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-fbcolor" type="text" value="rgba(255,255,255,0.4)" tabindex="-1">
		</dd>
		<dt class="multiline">Card border
		<p class="desc">If photo is merging to background</p></dt>
		<dd>
			<label for="stream-<?php echo $id?>-mborder-yep"><input id="stream-<?php echo $id?>-mborder-yep" class="switcher" type="checkbox" name="stream-<?php echo $id?>-mborder" value="yep"/><div><div></div></div></label>
		</dd>
		<dt><span class="valign">Text alignment</span></dt>
		<dd class="">
			<div class="select-wrapper">
				<select name="stream-<?php echo $id?>-ftalign" id="ftalign-<?php echo $id?>">
					<option value="center" selected>Centered</option>
					<option value="left" >Left</option>
					<option value="right">Right</option>
				</select>
			</div>
		</dd>
		<dt class="hide">Preview</dt>
		<dd class="preview">
			<h1>Live preview</h1>
			<div data-preview="bg-color" class="ff-stream-wrapper ff-layout-grid ff-theme-flat ff-style-1 shuffle">
				<div data-preview="fcolor" class="ff-item ff-twitter shuffle-item filtered" style="visibility: visible; opacity:1;">
					<div class="ff-item-cont">
						<span class="overlay" data-preview="fscolor"></span>
						<span class="ff-img-holder" style="max-height:162px"><img src="' . FlowFlow::get_plugin_directory() . '/assets/7.jpg" style="width:260px;"></span>

						<p data-preview="ftextcolor, fbcolor">This is regular text paragraph, can be tweet, facebook post etc. This is example of <a href="#" data-preview="fnamecolor">link in text</a>. Good day!</p>

						<div class="ff-item-meta">
							<span class="ff-userpic" style="background:url(<?php echo FlowFlow::get_plugin_directory() ?>/assets/Steve-Zissou.png)"><i class="ff-icon"><i class="ff-icon-inner"></i></i></span><a data-preview="fnamecolor" target="_blank" rel="nofollow" href="#" class="ff-name">Looks Awesome</a><a data-preview="frest" target="_blank" rel="nofollow" href="#" class="ff-nickname">@looks_awesome</a><a data-preview="frest" target="_blank" rel="nofollow" href="#" class="ff-timestamp">21m ago </a>
						</div>
					</div>
				</div>
			</div>
		</dd>
	</dl>

	<span id="stream-stylings-sbmt-<?php echo $id?>" class="admin-button green-button submit-button">Save Changes</span>
</div>
<div class="design-step-2 layout-compact">
	<h1>Compact stylings</h1>
	<dl class="section-settings section-compact">

		<dt><span class="valign">Item style</span></dt>
		<dd>
			<div class="select-wrapper">
				<select name="stream-<?php echo $id?>-compact-style" id="compact-style-<?php echo $id?>">
					<option value="c-style-1" selected>Text and meta in container</option>
					<option value="c-style-2">Text in bubble, meta separately</option>
				</select>
			</div>
		</dd>

		<dt>Color for heading & name</dt>
		<dd>
			<input data-prop="color" id="cnamecolor-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-cnamecolor" type="text" value="rgb(154, 78, 141)" tabindex="-1">
		</dd>
		<dt>Regular text color
		</dt>
		<dd>
			<input data-prop="color" id="ctextcolor-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-ctextcolor" type="text" value="rgb(85,85,85)" tabindex="-1">
		</dd>
		<dt>Links color</dt>
		<dd>
			<input data-prop="color" id="clinkscolor-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-clinkscolor" type="text" value="rgb(94, 159, 202)" tabindex="-1">
		</dd>
		<dt class="multiline">Other text color
		<p class="desc">Nicknames, timestamps</p></dt>
		<dd>
			<input data-prop="color" id="crestcolor-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-crestcolor" type="text" value="rgb(132, 118, 129)" tabindex="-1">
		</dd>
		<dt>Item border color</dt>
		<dd>
			<input data-prop="border-color" id="cbcolor-<?php echo $id?>" data-color-format="rgba" name="stream-<?php echo $id?>-cbcolor" type="text" value="rgba(226,226,226,1)" tabindex="-1">
		</dd>
		<dt><span class="valign">Show in item meta</span></dt>
		<dd>
			<div class="select-wrapper">
				<select name="stream-<?php echo $id?>-cmeta" id="cmeta-<?php echo $id?>">
					<option value="upic" selected>User picture</option>
					<option value="icon">Social icon</option>
				</select>
			</div>
		</dd>
		<dt><span class="valign">Text alignment</span></dt>
		<dd class="">
			<div class="select-wrapper">
				<select name="stream-<?php echo $id?>-calign" id="calign-<?php echo $id?>">
					<option value="left" selected>Left</option>
					<option value="center" >Centered</option>
					<option value="right">Right</option>
				</select>
			</div>
		</dd>
		<dt class="multiline">Number of items to show in slide
		<p class="desc">Leave empty to show all at once in long container</p>
		</dt>
		<dd>
			<input class="short" id="cards-num-<?php echo $id?>" name="stream-<?php echo $id?>-cards-num" type="text" value="3" tabindex="-1">
		</dd>
		<dt class="multiline">Scroll top when user slides<p class="desc">Recommended when there are many items in one slide</p></dt>
		<dd>
			<label for="stream-<?php echo $id?>-scrolltop"><input id="stream-<?php echo $id?>-scrolltop" class="switcher" type="checkbox" name="stream-<?php echo $id?>-scrolltop" checked value="yep"/><div><div></div></div></label>
		</dd>
		<dt class="hide">Preview</dt>
		<dd class="preview  ff-layout-compact">
			<h1>Live preview</h1>
			<div data-preview="bg-color" class="ff-stream-wrapper ff-c-style-1 ff-c-upic shuffle">
				<div data-preview="fcolor" class="ff-item ff-twitter shuffle-item filtered" style="visibility: visible; opacity:1;">
					<div data-preview="cbcolor" class="ff-item-cont">

						<span class="corner1" data-preview="cbcolor" data-overrideProp="border-top-color"></span>
						<h4 data-preview="cnamecolor">Header example</h4>
						<span class="ff-img-holder" style="max-height:152px"><img src="' . FlowFlow::get_plugin_directory() . '/assets/compact.jpg" style="width:260px;"></span>

						<p data-preview="ctextcolor">This is regular text paragraph, can be tweet, facebook post etc. This is example of <a href="#" data-preview="clinkscolor">link in text</a>. Good day!</p>

						<div class="ff-item-meta">
							<span class="ff-userpic" style="background:url(<?php echo FlowFlow::get_plugin_directory() ?>/assets/Steve-Zissou.png)"><i class="ff-icon"><i class="ff-icon-inner"></i></i></span><a data-preview="cnamecolor" target="_blank" rel="nofollow" href="#" class="ff-name">Looks Awesome</a><a data-preview="crestcolor" target="_blank" rel="nofollow" href="#" class="ff-nickname">@looks_awesome</a><a data-preview="crestcolor" target="_blank" rel="nofollow" href="#" class="ff-timestamp">21m ago </a>
						</div>
						<span class="corner2" data-preview="bg-color"  data-overrideProp="border-top-color"></span>

					</div>
				</div>
			</div>
		</dd>
	</dl>
	<span id="stream-stylings-sbmt-<?php echo $id?>" class="admin-button green-button submit-button">Save Changes</span>
</div>
</div>
<div class="section" id="css-<?php echo $id?>">
	<h1 class="desc-following">Stream custom CSS</h1>
	<p class="desc" style="margin-bottom:10px">
		Prefix your selectors with <strong>#ff-stream-<?php echo $id?></strong> to target this specific stream
	</p>
	<textarea  name="stream-<?php echo $id?>-css" cols="100" rows="10" id="stream-<?php echo $id?>-css"/> </textarea>
	<p style="margin-top:10px"><span id="stream-css-sbmt-<?php echo $id?>" class="admin-button green-button submit-button">Save Changes</span><p>
</div>

</div>