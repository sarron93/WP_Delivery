<?php
/**
 * Building Form for creating valid arrays
 * for WP_Query Objects.
 *
 * @author jason.xie@victheme.com
 *
 */
class VTCore_Wordpress_Form_WpQuery
extends VTCore_Bootstrap_Element_BsAccordion {

  public function buildElement() {

    VTCore_Wordpress_Utility::loadAsset('wp-bootstrap');
    VTCore_Wordpress_Utility::loadAsset('wp-query');

    $this->addContext('contents.posts', array(
      'title' => __('Posts', 'victheme_core'),
      'content' => new VTCore_Wordpress_Form_Query_Posts(array(
        'name' => $this->getContext('name'),
        'value' => $this->getContext('value.posts')
      )),
    ));

    $this->addContext('contents.author', array(
      'title' => __('Authors', 'victheme_core'),
      'content' => new VTCore_Wordpress_Form_Query_Authors(array(
        'name' => $this->getContext('name'),
        'value' => $this->getContext('value.authors')
      )),
    ));

    $this->addContext('contents.orders', array(
      'title' => __('Ordering', 'victheme_core'),
      'content' => new VTCore_Wordpress_Form_Query_Orders(array(
        'name' => $this->getContext('name'),
        'value' => $this->getContext('value.orders')
      )),
    ));

    $this->addContext('contents.pagination', array(
      'title' => __('Pagination', 'victheme_core'),
      'content' => new VTCore_Wordpress_Form_Query_Pagination(array(
        'name' => $this->getContext('name'),
        'value' => $this->getContext('value.pagination')
      )),
    ));

    $this->addContext('contents.taxonomy', array(
      'title' => __('Taxonomy', 'victheme_core'),
      'content' => new VTCore_Wordpress_Form_Query_Taxonomy(array(
        'name' => $this->getContext('name'),
        'value' => $this->getContext('value.taxonomy')
      )),
    ));

    $this->addContext('contents.meta', array(
      'title' => __('Meta', 'victheme_core'),
      'content' => new VTCore_Wordpress_Form_Query_Meta(array(
        'name' => $this->getContext('name'),
        'value' => $this->getContext('value.meta')
      )),
    ));

    if (!$this->getContext('value.id')) {
      $this->addContext('value.id', uniqid('vtcore-' . $this->getContext('name') . '-'));
    }

    $this->addContext('contents.query', array(
      'title' => __('Parameters', 'victheme_core'),
      'content' => new VTCore_Bootstrap_Form_BsText(array(
        'text' => __('Unique loop ID', 'victheme_core'),
        'description' => __('This ID can be used for other element to interacts with this query', 'victheme_core'),
        'name' => $this->getContext('name') . '[id]',
        'value' => $this->getContext('value.id'),
      ))
    ));


    parent::buildElement();
  }
}