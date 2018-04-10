<?php
/**
 * Helper class for quick shortcut in building generic html element
 *
 * @author jason.xie@victheme.com
 */
class VTCore_Bootstrap_Element_BsElement
extends VTCore_Bootstrap_Element_Base {

  protected $context = array(
    'type' => '',
    'attributes' => array(),
  );

  public function buildElement() {
    $this->addAttributes($this->getContext('attributes'));
    if ($this->getContext('text')) {
      $this->setText($this->getContext('text'));
    }
  }
}