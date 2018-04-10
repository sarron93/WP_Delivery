<?php
/**
 * Class for building the history wrapper
 *
 * @author jason.xie@victheme.com
 * @method HsElement($context)
 */
class VTCore_History_Element_HsElement
extends VTCore_Bootstrap_Grid_BsRow {

  protected $context = array(
    'type' => 'div',
    'text' => '',
    'attributes' => array(
      'class' => array(
        'row',
        'history-elements',
      ),
    ),
    'data' => array(
      'gradientone' => '',
      'gradienttwo' => '',
      'curvex' => 0,
      'curvey' => 100,
      'startx' => 0,
      'starty' => 0,
      'endx' => 0,
      'endy' => 0,
      'linewidth' => 10,
      'linetype' => 'round',
    ),
    'raw' => true,
    'connector' => false,
  );

  private $grids;

  public function buildElement() {

    $this->grids = new VTCore_Bootstrap_Grid_Column($this->getContext('grids'));
    $this->addClass($this->getGrid()->getClass());

    // Load the default plugin assets
    // Themer can disable this by declaring support to victheme_history
    // or create the same assets name to override the default one.
    if (!get_theme_support('victheme_history')) {
      VTCore_Wordpress_Utility::loadAsset('history-front');
    }

    $this->addAttributes($this->getContext('attributes'));

    if ($this->getContext('connector')) {
      VTCore_Wordpress_Utility::loadAsset('jquery-pointconnector');
      $this->addClass('point-connector');
    }

    // Allow user to modify the object
    do_action('vtcore_history_alter_history_element_object', $this);
  }

  public function getGrid() {
    return $this->grids;
  }

}