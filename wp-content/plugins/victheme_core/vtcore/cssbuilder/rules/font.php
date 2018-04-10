<?php
/**
 * CSSBuilder Rules object for defining css font rules.
 *
 * Valid Context array that will be processed:
 * color
 * family
 * size
 * size-adjust
 * stretch
 * style
 * variant
 * weight
 *
 * shadow
 * height
 * spacing
 *
 * @author jason.xie@victheme.com
 *
 */
class VTCore_CSSBuilder_Rules_Font
extends VTCore_CSSBuilder_Rules_Base
implements VTCore_CSSBuilder_Rules_Interface {

  protected $type = 'font';

  public function buildRule() {

    foreach ($this->context as $key => $value) {
      $rule = 'font-' . $key;

      if ($key == 'color') {
        $rule = $key;
      }

      if ($key == 'height') {
        $rule = 'line-height';
      }

      if ($key == 'shadow') {
        $rule = 'text-shadow';
      }

      if ($key == 'spacing') {
        $rule = 'letter-spacing';
      }

      if ($key == 'family') {
        $value = str_replace('+', ' ', $value);
      }

      $this->rules[] = $rule  . ': ' . str_replace('"', '', $value);
    }
  }

}