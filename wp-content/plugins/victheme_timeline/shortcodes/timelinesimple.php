<?php
/**
 * Class extending the Shortcodes base class
 * for building the timeline simple element
 *
 * how to use :
 *
 * [timelinesimple
 *   align="left|right|centered"
 *   layout="horizontal|vertical"
 *   contentargs="url encoded json format"
 * ]
 *
 * @author jason.xie@victheme.com
 *
 */
class VTCore_Timeline_Shortcodes_TimeLineSimple
extends VTCore_Wordpress_Models_Shortcodes
implements VTCore_Wordpress_Interfaces_Shortcodes {

  protected $processDottedNotation = true;

  protected function processCustomRules() {

    // Convert the bootstrap classes into vc compatible one
    $this->convertVCGrid = !get_theme_support('bootstrap');

    $object = new VTCore_Wordpress_Objects_Array($this->atts);
    $object->add('contents', json_decode(urldecode($object->get('contentargs')), true));

    $object
        ->add('attributes.class.default', 'timeline-simple');

    if (!$object->get('layout')) {
      $object->add('layout', 'vertical');
    }

    if (!$object->get('align')) {
      $object->add('align', 'center');
    }

    // Process Children
    if ($object->get('contents')) {
      foreach ($object->get('contents') as $delta => $content) {
        $children = new VTCore_Wordpress_Objects_Array($content);
        switch ($object->get('layout')) {
          case 'vertical' :
            if ($object->get('align') != 'center') {
              $object->add('contents.' . $delta . '.direction', $object->get('align'));
            }

            if ($children->get('direction') == 'top') {
              $object->add('contents.' . $delta . '.direction', 'left');
            }

            if ($children->get('direction') == 'bottom') {
              $object->add('contents.' . $delta . '.direction', 'right');
            }

            if ($children->get('timetype') == 'major'
              || $children->get('timetype') == 'ending') {
              $object->add('contents.' . $delta . '.direction', $object->get('align'));
            }

            break;

          case 'horizontal' :
            if ($children->get('direction') == 'left') {
              $object->add('contents.' . $delta . '.direction', 'top');
            }

            if ($children->get('direction') == 'right') {
              $object->add('contents.' . $delta . '.direction', 'bottom');
            }

            if ($children->get('timetype') == 'major'
              || $children->get('timetype') == 'ending') {
              $object->add('contents.' . $delta . '.direction', 'center');
            }

            break;
        }

        if (!$children->get('timetype')) {
          $object->add('contents.' . $delta . '.timetype', 'events');
        }

      }
    }

    $object
      ->add('data.layout', $object->get('layout'))
      ->add('data.align', $object->get('align'));

    $this->atts = $object->extract();

  }

  public function buildObject() {
    $this->object = new VTCore_Timeline_Element_TimeLine($this->atts);

    $object = new VTCore_Wordpress_Objects_Array($this->atts);

    if ($object->get('contents')) {
      foreach ($object->get('contents') as $delta => $content) {

        $data = new VTCore_Wordpress_Objects_Array($content);

        switch ($data->get('timetype')) {
          case 'major' :
            $shortcode = new VTCore_Timeline_Shortcodes_TimeMajor($data->extract(), $data->get('content'), 'timemajor');
            $shortcode->buildObject();
            $this->object->addChildren($shortcode->getMarkup());
            break;

          case 'events' :
            $shortcode = new VTCore_Timeline_Shortcodes_TimeEvents($data->extract(), $data->get('content'), 'timeevents');
            $shortcode->buildObject();
            $this->object->addChildren($shortcode->getMarkup());
            break;

          case 'ending' :
            $shortcode = new VTCore_Timeline_Shortcodes_TimeEnd($data->extract(), $data->get('content'), 'timeend');
            $shortcode->buildObject();
            $this->object->addChildren($shortcode->getMarkup());
            break;
        }
      }
    }
  }
}