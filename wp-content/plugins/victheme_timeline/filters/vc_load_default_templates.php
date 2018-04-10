<?php
/**
 * Registering Theme Default Layout templates
 *
 * @author jason.xie@victheme.com
 *
 */
class VTCore_TimeLine_Filters_VC__Load__Default__Templates
extends VTCore_Wordpress_Models_Hook {

  public function hook($templates = NULL) {

    // Lapas team member details block
    array_unshift($templates, array(
      'name' => __('* TimeLine Elements', 'medikal'),
      'custom_class' => 'vtcore-timeline',
      'content' =>
<<<CONTENT
[vc_row full_width="" parallax="" parallax_image="" css=""][vc_column width="1/1"][timeline layout="vertical" align="center" css_animation=""][timemajor]Major Events[/timemajor][timeevents day="12" month="January" year="2011" text="Example Events" icon="angle-left" direction="left"][vc_column_text css_animation=""]

I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.

[/vc_column_text][/timeevents][timeevents day="13" month="January" year="2011" text="Example Events" icon="angle-right" direction="right"][vc_column_text css_animation=""]

I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.

[/vc_column_text][/timeevents][timeevents day="16" month="January" year="2011" text="Example Events" icon="angle-left" direction="left"][vc_column_text css_animation=""]

I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.

[/vc_column_text][/timeevents][timemajor css_animation=""]Major Events[/timemajor][timeevents day="18" month="February" year="2014" icon="angle-left" direction="left" text="Example Text"][vc_column_text css_animation=""]

I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.

[/vc_column_text][/timeevents][timeevents day="28" month="February" year="2014" text="Example Text" icon="angle-right" direction="right"][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/timeevents][timeevents day="1" month="March" year="2014" text="Example Text" icon="angle-left" direction="left"][vc_column_text css_animation=""]

I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.
[/vc_column_text][/timeevents][/timeline][/vc_column][/vc_row]
CONTENT
    ));

    return $templates;
  }
}