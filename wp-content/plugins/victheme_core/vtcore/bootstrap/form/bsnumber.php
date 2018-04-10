<?php
/**
 * Building form number with bootstrap rules
 *
 * Shortcut Method : BsNumber($context)
 *
 * Shortcut context available :
 *
 * text          : (string) The text for the Legend element
 * prefix        : (string) Prefix element in front of the text input element
 * suffix        : (string) Suffix element in the end of the text input element
 * description   : (string) Text of decription printed after the input element
 * required      : (boolean) Flag for marking element as required
 * placeholder   : (string) The placeholder text for the input element
 * max           : (numeric) The maximum acceptable value
 * min           : (numeric) the minimum acceptable value
 * step          : (numeric) incremental value
 * name          : (string) The name attributes for the input element
 * value         : (string) The value attributes for the input element
 * id            : (string) The id used for the input element and object machine id
 * class         : (array) Classes used for the input element
 * label         : (boolean) Flag for hiding the label element via CSS
 *
 * @author jason.xie@victheme.com
 * @method BsNumber($context)
 * @see VTCore_Html_Form interface
 */
class VTCore_Bootstrap_Form_BsNumber
extends VTCore_Bootstrap_Form_Base
implements VTCore_Form_Interface {

  protected $context = array(

    // Shortcut method
    // @see VTCore_Bootstrap_Form_Base::assignContext()
    'text' => false,
    'prefix' => false,
    'suffix' => false,
    'description' => false,
    'required' => false,
    'max' => false,
    'min' => false,
    'step' => false,
    'placeholder' => false,
    'name' => false,
    'value' => false,
    'id' => false,
    'class' => array('form-control'),

    // Bootstrap Rules
    'label' => true,

    // Wrapper element
    'type' => 'div',
    'attributes' => array(
      'class' => array('form-group'),
    ),

    // Internal use, Only override if needed
    'input_elements' => array(),
    'label_elements' => array(),
    'description_elements' => array(),
    'prefix_elements' => array(),
    'suffix_elements' => array(),
    'required_elements' => array(),

  );




  public function buildElement() {

    VTCore_Wordpress_Utility::loadAsset('bootstrap-spinner');

    $this->addAttributes($this->getContext('attributes'));

    if ($this->getContext('label_elements')) {
      $this->addChildren(new VTCore_Form_Label($this->getContext('label_elements')));
    }

    if ($this->getContext('prefix_elements')) {
      $this->addChildren(new VTCore_Bootstrap_Form_BsPrefix(($this->getContext('prefix_elements'))));
    }

    $this->addChildren(new VTCore_Form_Number($this->getContext('input_elements')));

    if ($this->getContext('suffix_elements')) {
      $this->addChildren(new VTCore_Bootstrap_Form_BsSuffix(($this->getContext('suffix_elements'))));
    }

    if ($this->getContext('description_elements')) {
      $this->addChildren(new VTCore_Bootstrap_Form_BsDescription(($this->getContext('description_elements'))));
    }
  }
}