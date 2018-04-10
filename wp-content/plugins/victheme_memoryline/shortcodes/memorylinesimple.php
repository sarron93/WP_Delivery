<?php
/**
 * Class extending the Shortcodes base class
 * for building simple memory line. This is created
 * for a very simple memory line object for advanced
 * usage please us the normal memoryline shortcode instead.
 *
 * how to use :
 *
 * [memorylinesimple
 *   class="some class"
 *   id="someid"
 *   data___line_color="x"
 *   data___line_width="x"
 *   data___line_type="x"
 *   data___line_offset_x="x"
 *   data___line_offset_y="y"
 *   columns="1-5"
 *   contentargs="url decoded arrays of content"
 * ]
 *
 *
 * @author jason.xie@victheme.com
 *
 */
class VTCore_MemoryLine_Shortcodes_MemoryLineSimple
extends VTCore_Wordpress_Models_Shortcodes
implements VTCore_Wordpress_Interfaces_Shortcodes {

  protected $processDottedNotation = true;

  /**
   * Extending parent method.
   * @see VTCore_Wordpress_Models_Shortcodes::processCustomRules()
   */
  protected function processCustomRules() {

    // Convert the bootstrap classes into vc compatible one
    $this->convertVCGrid = !get_theme_support('bootstrap');

    $object = new VTCore_Wordpress_Objects_Array($this->atts);
    if ($object->get('data')) {
      foreach ($object->get('data') as $key => $value) {
        $newkey = str_replace('_', '-', $key);
        $object->remove('data.' . $key);
        $object->add('data.' . $newkey, $value);
      }
    }

    if (!$object->get('columns')) {
      $object->add('columns', 3);
    }

    $object
      ->add('data.line_type', 'round')
      ->add('attributes.class.default', 'memoryline-simple');

    // Build the grid logic
    $object->add('elements.grids', array(
      'columns' => array(
        'mobile' => 10,
        'tablet' => floor(10 / $object->get('columns')),
        'small' => floor(10 / $object->get('columns')),
        'large' => floor(10 / $object->get('columns')),
      ),
      'offset' => array(
        'mobile' => 2,
        'tablet' => 0,
        'small' => 0,
        'large' => 0,
      )
    ));

    if ($object->get('contentargs')) {
      $object->add('contents', json_decode(urldecode($object->get('contentargs')), true));
    }

    $this->atts = $object->extract();
    unset($object);
    $object = null;
  }


  public function buildObject() {
    $this->object = new VTCore_MemoryLine_Element_MlElement($this->atts);

    if (isset($this->atts['contents']) && is_array($this->atts['contents'])) {

      $object = new VTCore_Wordpress_Objects_Array($this->atts);

      $direction = 'forward';
      $totalPerRow = $column = $object->get('columns');

      d($object);

      foreach ($object->get('contents') as $delta => $content) {

        $data = new VTCore_Wordpress_Objects_Array($content);
        $data->add('grids', $object->get('elements.grids'));

        $newrow = false;
        // Switch direction
        if ($column == 0) {

          if ($direction == 'forward') {
            $direction = 'reverse';
          }
          else {
            $direction = 'forward';
            $data->add('grids.offset', array(
              'mobile' => 2,
              'tablet' => 2,
              'small' => 2,
              'large' => 2,
            ));
          }

          // Refresh count
          $column = $totalPerRow;
          $newrow = true;
        }

        $data
          ->add('data.dot_direction', $direction)
          ->add('newrow', $newrow)
          ->add('text_element.grids', array(
            'columns' => array(
              'mobile' => 12,
              'tablet' => 12,
              'small' => 12,
              'large' => 12,
            ),
          ))
          ->add('title_element.grids', array(
            'columns' => array(
              'mobile' => 12,
              'tablet' => 12,
              'small' => 12,
              'large' => 12,
            ),
          ));

        $shortcode = new VTCore_MemoryLine_Shortcodes_MemoryLineInner($data->extract(), $data->get('content'), 'memorylineinner');
        $shortcode->buildObject();
        $this->object
          ->addChildren($shortcode->getMarkup());

        $column--;
      }
    }
  }
}


