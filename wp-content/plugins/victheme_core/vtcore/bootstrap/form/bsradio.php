<?php
/**
 * Building form radios with bootstrap rules
 *
 * Shortcut Method : BsRadio($context)
 *
 * This class must be called from VTCore_Bootstrap_Form_BsInstance() as
 * the main form wrapper class if shortcut method is used.
 *
 * Otherwise a full invocation of the class name must be used
 * when building the object, and addChildren() method must be
 * used for registering the object into the parent form wrapper.
 *
 * Shortcut context available :
 *
 * text          : (string) The text for the Legend element
 * description   : (string) Text of decription printed after the input element
 * required      : (boolean) Flag for marking element as required
 * placeholder   : (string) The placeholder text for the input element
 * name          : (string) The name attributes for the input element
 * value         : (string) The value attributes for the input element
 * offvalue      : (string) The value should be returned when unchecked,
 *                          set to NULL to disable
 * id            : (string) The id used for the input element and object machine id
 * class         : (array) Classes used for the input element
 *
 * @author jason.xie@victheme.com
 * @method BsRadio($context)
 * @see VTCore_Html_Form interface
 */
class VTCore_Bootstrap_Form_BsRadio
extends VTCore_Bootstrap_Form_Base
implements VTCore_Form_Interface {

  protected $context = array(

    // Shortcut method
    // @see VTCore_Bootstrap_Form_Base::assignContext()
    'text' => '',
    'description' => '',
    'required' => false,
    'id' => '',
    'class' => array(),
    'value' => true,

    'label' => true,

    // Wrapper element
    'type' => 'div',
    'attributes' => array(
      'class' => array('radio'),
    ),

    // Internal use, Only override if needed
    'input_elements' => array(),
    'label_elements' => array(),
    'description_elements' => array(),
    'required_elements' => array(),
  );

  public function buildElement() {

    $this->addAttributes($this->getContext('attributes'));

    $this->addContext('label_elements.children', array(
      new VTCore_Form_Radio($this->getContext('input_elements')),
    ));

    $this->addChildren(new VTCore_Form_Label($this->getContext('label_elements')));

    if ($this->getContext('description_elements')) {
      $this->addChildren(new VTCore_Bootstrap_Form_BsDescription(($this->getContext('description_elements'))));
    }
  }
}