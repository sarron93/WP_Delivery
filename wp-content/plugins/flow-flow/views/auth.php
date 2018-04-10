<?php if ( ! defined( 'WPINC' ) )  die;
/**
 * FlowFlow.
 *
 * @package   FlowFlow
 * @author    Looks Awesome <email@looks-awesome.com>
 *
 * @link      http://looks-awesome.com
 * @copyright 2014-2015 Looks Awesome
 */
$options = $context['options'];
$auth = $context['auth_options'];
//$facebook_long_life_token = $context['facebook_long_life_token'];
?>
<div class="section-content" data-tab="auth-tab">
	<div class="section" id="auth-settings">
		<h1 class="desc-following">Twitter auth settings</h1>
		<p class="desc">Valid for all (public) twitter accounts. You need to authenticate one (and any) twitter account here. <a target="_blank" href="http://flow.looks-awesome.com/docs/Setup/Authenticate_with_Twitter">Follow setup guide</a></p>
		<dl class="section-settings">
			<dt class="vert-aligned">Consumer Key (API Key)</dt>
			<dd>
				<input class="clearcache" type="text" name="flow_flow_options[consumer_key]" placeholder="Copy and paste from Twitter" value="<?php echo $options['consumer_key']?>"/>
			</dd>
			<dt class="vert-aligned">Consumer Secret (API Secret)</dt>
			<dd>
				<input class="clearcache" type="text" name="flow_flow_options[consumer_secret]" placeholder="Copy and paste from Twitter" value="<?php echo $options['consumer_secret']?>"/>
			</dd>
			<dt class="vert-aligned">Access Token</dt>
			<dd>
				<input class="clearcache" type="text" name="flow_flow_options[oauth_access_token]" placeholder="Copy and paste from Twitter" value="<?php echo $options['oauth_access_token']?>"/>
			</dd>
			<dt class="vert-aligned">Access Token Secret</dt>
			<dd>
				<input class="clearcache" type="text" name="flow_flow_options[oauth_access_token_secret]" placeholder="Copy and paste from Twitter" value="<?php echo $options['oauth_access_token_secret']?>"/>						</dd>

		</dl>
		<p class="button-wrapper"><span id="tw-auth-settings-sbmt" class='admin-button green-button submit-button'>Save Changes</span></p>

		<h1  class="desc-following">Facebook auth settings</h1>
		<p class="desc">Valid to pull any public FB page. <a target="_blank" href="http://flow.looks-awesome.com/docs/Setup/Authenticate_with_Facebook">Follow setup guide</a></p>
		<dl class="section-settings">
			<dt class="vert-aligned">Access Token</dt>
			<dd>
				<input class="clearcache" type="text" name="flow_flow_fb_auth_options[facebook_access_token]" placeholder="Copy and paste from Facebook" value="<?php echo $auth['facebook_access_token']?>"/>
				<?php
				$extended = $context['extended_facebook_access_token'];
				if(!empty($auth['facebook_access_token']) && !empty($extended) ) {
					echo '<p class="desc" style="margin: 10px 0 5px">Generated long-life token, it should be different from that you entered above then FB auth is OK</p><textarea disabled rows=3>' . $extended . '</textarea>';
				} else {
					if (empty($extended)) {
						echo '<p class="desc" style="margin: 10px 0 5px; color: red !important">! Extended token is not generated, Facebook feeds might not work</p>';
					}
				}
				?>
			</dd>
			<dt class="vert-aligned">APP ID</dt>
			<dd>
				<input class="clearcache" type="text" name="flow_flow_fb_auth_options[facebook_app_id]" placeholder="Copy and paste from Facebook" value="<?php echo $auth['facebook_app_id']?>"/>
			</dd>
			<dt class="vert-aligned">APP Secret</dt>
			<dd>
				<input class="clearcache" type="text" name="flow_flow_fb_auth_options[facebook_app_secret]" placeholder="Copy and paste from Facebook" value="<?php echo $auth['facebook_app_secret']?>"/>
			</dd>
		</dl>
		<p class="button-wrapper"><span id="fb-auth-settings-sbmt" class='admin-button green-button submit-button'>Save Changes</span></p>


		<h1 class="desc-following ">Instagram auth settings <span id="inst-auth" class='admin-button auth-button blue-button'>Authorize</span></h1>
		<p class="desc">You can use your own token or get token authorizing our app. <a target="_blank" href="http://flow.looks-awesome.com/docs/Setup/Authenticate_with_Instagram">Follow setup guide</a></p>
        <dl class="section-settings">
			<dt class="vert-aligned">Access Token</dt>
			<dd>
				<input class="clearcache" type="text" id="instagram_access_token" name="flow_flow_options[instagram_access_token]" placeholder="Copy and paste from Instagram" value="<?php echo $options['instagram_access_token']?>"/>
			</dd>
		</dl>
		<p class="button-wrapper"><span id="inst-auth-settings-sbmt" class='admin-button green-button submit-button'>Save Changes</span></p>

		<h1 class="desc-following">Google+ and YouTube auth settings</h1>
		<p class="desc">Valid to pull any public Google+ and YouTube page feed. <a target="_blank" href="http://flow.looks-awesome.com/docs/Setup/Authenticate_with_Google_and_YouTube">Follow setup guide</a></p>
		<dl class="section-settings">
			<dt class="vert-aligned">API key</dt>
			<dd>
				<input class="clearcache" type="text" name="flow_flow_options[google_api_key]" placeholder="Copy and paste from Google+" value="<?php echo $options['google_api_key']?>"/>
			</dd>
		</dl>
		<p class="button-wrapper"><span id="gp-auth-settings-sbmt" class='admin-button green-button submit-button'>Save Changes</span></p>


		<h1 class="desc-following">Foursquare auth settings  <span id="foursquare-auth" class='admin-button auth-button blue-button'>Authorize</span></h1>
		<p class="desc">Valid to pull any public Foursquare location comments. <a target="_blank" href="http://flow.looks-awesome.com/docs/Setup/Authenticate_with_Foursquare">Follow setup guide</a></p>
		<dl class="section-settings">
			<dt class="vert-aligned">Token</dt>
			<dd>
				<input class="clearcache" type="text" name="flow_flow_options[foursquare_access_token]" placeholder="Copy and paste from Foursquare" value="<?php echo $options['foursquare_access_token']?>"/>
			</dd>
            <dt class="vert-aligned">Client ID</dt>
			<dd>
				<input class="clearcache" id="foursquare_client_id" type="text" name="flow_flow_options[foursquare_client_id]" placeholder="Copy and paste from Foursquare" value="<?php echo $options['foursquare_client_id']?>"/>
			</dd>
			<dt class="vert-aligned">Client Secret</dt>
			<dd>
				<input class="clearcache" id="foursquare_client_secret" type="text" name="flow_flow_options[foursquare_client_secret]" placeholder="Copy and paste from Foursquare" value="<?php echo $options['foursquare_client_secret']?>"/>
			</dd>
		</dl>
		<p class="button-wrapper"><span id="fq-auth-settings-sbmt" class='admin-button green-button submit-button'>Save Changes</span></p>

		<h1 class="desc-following">LinkedIn auth settings</h1>
		<p class="desc">Valid to pull company pages where you are added as admin. <a target="_blank" href="http://flow.looks-awesome.com/docs/Setup/Authenticate_with_Linkedin">Follow setup guide</a></p>

		<dl class="section-settings">
			<dt class="vert-aligned">Client ID</dt>
			<dd>
				<input class="clearcache" type="text" id="linkedin_api_key" name="flow_flow_options[linkedin_api_key]" placeholder="Copy and paste from LinkedIn" value="<?php echo $options['linkedin_api_key']?>"/>
			</dd>
			<dt class="vert-aligned">Client Secret</dt>
			<dd>
				<input class="clearcache" type="text" id="linkedin_secret_key" name="flow_flow_options[linkedin_secret_key]" placeholder="Copy and paste from LinkedIn" value="<?php echo $options['linkedin_secret_key']?>"/>
			</dd>
			<dt class="vert-aligned">Access token</dt>
			<dd>
				<input class="clearcache" type="text" name="flow_flow_options[linkedin_access_token]" placeholder="Copy and paste from LinkedIn" value="<?php echo $options['linkedin_access_token']?>"/>
			</dd>
		</dl>
		<p class="button-wrapper"><span id="linkedin-auth-settings-sbmt" class='admin-button green-button submit-button'>Save Changes</span></p>

		<h1 class="desc-following">SoundCloud auth settings</h1>
		<p class="desc"><a target="_blank" href="http://soundcloud.com/you/apps/new">Create SoundCloud app</a> and paste its ID below.</p>


		<dl class="section-settings">
			<dt class="vert-aligned">Your app Client ID</dt>
			<dd>
				<input class="clearcache" type="text" name="flow_flow_options[soundcloud_api_key]" placeholder="Copy and paste from SoundCloud" value="<?php echo $options['soundcloud_api_key']?>"/>
			</dd>
		</dl>

		<p class="button-wrapper"><span id="sc-auth-settings-sbmt" class='admin-button green-button submit-button'>Save Changes</span></p>

		<h1 class="desc-following">Dribbble auth settings</h1>
		<p class="desc"><a target="_blank" href="http://developer.dribbble.com">Create Dribbble app</a> and paste its access token below.</p>
		<dl class="section-settings">
			<dt class="vert-aligned">Client Access Token</dt>
			<dd>
				<input class="clearcache" type="text" name="flow_flow_options[dribbble_access_token]" placeholder="Copy and paste from Dribbble" value="<?php echo @$options['dribbble_access_token']?>"/>
			</dd>
		</dl>
		<p class="button-wrapper"><span id="dribbble-auth-settings-sbmt" class='admin-button green-button submit-button'>Save Changes</span></p>
	</div>
</div>