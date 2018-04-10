<?php
/**
 * Class for processing column grid configured by user
 *
 * To use this with Bootstrap Element or Form elements
 * user must define the columns array in the object context.
 *
 * Sample of columns array :
 *
 * columns => array(
 *   mobile => 12,
 *   tablet => 12,
 *   small => 6,
 *   large => 6,
 * ),
 *
 * Example of using this class :
 *
 * $class = new VTCore_Bootstrap_Grid_Column($context);
 * $class->getClass();
 *
 * This class is not extensible and or be used as a shortcut
 * as the design is intended to be singleton
 *
 * @author jason.xie@victheme.com
 *
 */
final class VTCore_Bootstrap_Grid_Column {

  private $context = array(
    'columns' => array(
      'mobile' => '0',
      'tablet' => '0',
      'small' => '0',
      'large' => '0',
    ),
    'push' => array(
      'mobile' => '0',
      'tablet' => '0',
      'small' => '0',
      'large' => '0',
    ),
    'pull' => array(
      'mobile' => '0',
      'tablet' => '0',
      'small' => '0',
      'large' => '0',
    ),
    'offset' => array(
      'mobile' => '0',
      'tablet' => '0',
      'small' => '0',
      'large' => '0',
    ),
    'hidden' => array(
      'mobile' => false,
      'tablet' => false,
      'small' => false,
      'large' => false,
    ),
    'visible' => array(
      'mobile' => false,
      'tablet' => false,
      'small' => false,
      'large' => false,
    ),
  );

  private $cleanMode = array(
    'push',
    'pull',
    'hidden',
    'visible',
  );


  private $columnsPrefix = array(
    'mobile' => 'col-xs-',
    'tablet' => 'col-sm-',
    'small' => 'col-md-',
    'large' => 'col-lg-',
  );

  private $hiddenPrefix = array(
    'mobile' => 'hidden-xs',
    'tablet' => 'hidden-sm',
    'small' => 'hidden-md',
    'large' => 'hidden-lg',
  );

  private $visiblePrefix = array(
    'mobile' => 'visible-xs',
    'tablet' => 'visible-sm',
    'small' => 'visible-md',
    'large' => 'visible-lg',
  );

  private $pushPrefix = array(
    'mobile' => 'col-xs-push-',
    'tablet' => 'col-sm-push-',
    'small' => 'col-md-push-',
    'large' => 'col-lg-push-',
  );

  private $pullPrefix = array(
    'mobile' => 'col-xs-pull-',
    'tablet' => 'col-sm-pull-',
    'small' => 'col-md-pull-',
    'large' => 'col-lg-pull-',
  );

  private $offsetPrefix = array(
    'mobile' => 'col-xs-offset-',
    'tablet' => 'col-sm-offset-',
    'small' => 'col-md-offset-',
    'large' => 'col-lg-offset-',
  );

  private $class = '';

  public function __construct($context) {
    $this->setContext($context);
    $this->buildColumnAttributes();
  }

  public function setContext($context) {
    $this->context = VTCore_Utility::arrayMergeRecursiveDistinct($context, $this->context);
    return $this;
  }

  public function cleanContext() {
    $this->context = array();
    return $this;
  }

  private function getPrefix($type, $subType) {
    $types = $this->$type;
    return isset($types[$subType]) ? $types[$subType] : '';
  }

  public function buildColumnAttributes() {

    // Clean the class first since this method
    // is accesible multiple time now
    $this->class = '';

    // Only clean offset if no xs-offset is set.
    // This is to fix bug all size follows mobile offset
    if (isset($this->context['offset']) && empty($this->context['offset']['mobile'])) {
      $this->cleanMode[] = 'offset';
    }

    // Smarter cleaning mode
    foreach ($this->cleanMode as $cleanIndex) {

      if (!isset($this->context[$cleanIndex])) {
        continue;
      }

      $clean = array_filter($this->context[$cleanIndex]);
      if (!empty($clean)) {
        $this->context[$cleanIndex] = $clean;
      }
      else {
        unset($this->context[$cleanIndex]);
      }
    }

    foreach ($this->context as $type => $settings) {

      foreach ($settings as $mode => $setting) {

        $prefixType = $type;
        if ($type == 'columns' && empty($setting)) {
          $prefixType = 'hidden';
        }

        $this->class .= ' ' . $this->getPrefix($prefixType . 'Prefix', $mode);

        if ($prefixType != 'hidden' && $prefixType != 'visible') {
          $this->class .= $setting;
        }
      }
    }
  }

  public function getClass() {
    return trim($this->class);
  }
}