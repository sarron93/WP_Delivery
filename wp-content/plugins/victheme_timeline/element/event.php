<?php
/**
 * Building CSS only time line event
 *
 * @author jason.xie@victheme.com
 */
class VTCore_Timeline_Element_Event
extends VTCore_Html_Element {

  protected $context = array(
    'type' => 'div',
    'attributes' => array(
      'class' => array(
        'timeline-events',
      ),
    ),
    'classtype' => 'event',
    'datetime' => '',
    'day' => '',
    'month' => '',
    'year' => '',
    'date' => '',
    'icon' => '',
    'text' => '',
    'content' => '',
    'direction' => 'left',
  );

  protected $content;
  protected $time;

  public function buildElement() {

    $this->addAttributes($this->getContext('attributes'));

    $this
      ->addChildren(new VTCore_Html_Time(array(
        'attributes' => array(
          'datetime' => $this->getContext('datetime'),
          'class' => array(
            'timeline-time',
            'clearfix'
          ),
        ),
      )));

    if ($this->getContext('date')) {
      $this
        ->lastChild()
        ->addChildren(new VTCore_Html_Element(array(
          'type' => 'span',
          'text' => $this->getContext('date'),
          'attributes' => array(
            'class' => array('timeline-date'),
          ),
        )));
    }

    if ($this->getContext('day')) {
      $this
        ->lastChild()
        ->addChildren(new VTCore_Html_Element(array(
          'type' => 'span',
          'text' => $this->getContext('day'),
          'attributes' => array(
            'class' => array(
              'timeline-day'
            ),
          ),
        )));
    }

    if ($this->getContext('month')) {
      $this
        ->lastChild()
        ->addChildren(new VTCore_Html_Element(array(
          'type' => 'span',
          'text' => $this->getContext('month'),
          'attributes' => array(
            'class' => array(
              'timeline-month'
            ),
          ),
        )));
    }

    if ($this->getContext('year')) {
      $this
        ->lastChild()
        ->addChildren(new VTCore_Html_Element(array(
          'type' => 'span',
          'text' => $this->getContext('year'),
          'attributes' => array(
            'class' => array(
              'timeline-year'
            ),
          ),
        )));
    }

    if ($this->getContext('icon')) {
      $this
        ->addChildren(new VTCore_Fontawesome_faIcon(array(
          'icon' => $this->getContext('icon'),
          'shape' => 'circle',
          'attributes' => array(
            'class' => array(
              'timeline-icon'
            ),
          ),
          'data' => array(
            'timeline' => 'icon'
          ),
        )));
    }

    if ($this->getContext('text')) {
      $this
        ->addChildren(new VTCore_Html_Element(array(
          'type' => 'h2',
          'text' => $this->getContext('text'),
          'attributes' => array(
            'class' => array('timeline-title'),
          ),
        )));
    }

    $this->content = $this->addChildren(new VTCore_Html_Element(array(
        'type' => 'div',
        'attributes' => array(
          'class' => array('timeline-content'),
        ),
    )))
    ->lastChild();


    if ($this->getContext('content')) {
      $this->content
        ->addChildren(new VTCore_Html_Element(array(
          'type' => 'div',
          'text' => $this->getContext('content'),
        )));
    }

    // Reverse the content
    $this->addData('timeline-content', 'normal');
    if ($this->getContext('direction') == 'bottom') {
      $this->content
        ->setChildren(array_reverse($this->content->getChildrens(), true));
      $this->setChildren(array_reverse($this->getChildrens(), true));
      $this->addData('timeline-content', 'inversed');
    }

    // After initialization, all content
    // must be injected to inner div
    $this->setChildrenPointer('content');


  }
}