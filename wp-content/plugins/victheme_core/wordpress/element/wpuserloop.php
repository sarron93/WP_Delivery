<?php
/**
 *
 * Object for creating a loop for all the registered
 * users. The loop is created using VTCore_Wordpress_Queries_Users
 * object which extends the WP_User_Query Class.
 *
 * This class is extending the VTCore_Wordpress_Element_Loop class
 *
 * VTCore_Wordpress_Queries_Users Object
 * =====================================
 * 1. Direct VTCore_Wordpress_Queries_Users object injection via context
 *    with key query
 *
 * 2. Build a new VTCore_Wordpress_Queries_Users if it cannot use
 *    Direct or Global VTCore_Wordpress_Queries_Users object, provided
 *    user specify the VTCore_Wordpress_Queries_Users object args via
 *    queryArgs context.
 *
 * Without valid object, the class will not produce any markups
 *
 * AJAX
 * ====
 * This class is compatible with wp-ajax.js to invoke the integration
 * witht wp-ajax, it will need the :
 *
 *   $context['ajax'] = true;
 *
 * GRIDS
 * =====
 *
 * The class will provide columns object for processing
 * bootstrap object grids defined in context into a valid
 * css class for the bootstrap grids.
 *
 * The object can be accessed via $this->getContext('object.columns')->getClass()
 * when in template or directly injected to object when template is specified
 * as a valid VTCore_Html_Base object (or its children).
 *
 *
 * ISOTOPE
 * =======
 *
 * This class is capable to invoking isotope js directly if user
 * specifies the correct isotope options via context['isotope']
 *
 * Common Isotope options
 * $context['data']['isotope-options'] = array(
 *   // This must be the same as the item defined in the template
 *   'itemSelector' => '.item',
 *
 *   // the VTCoreIsotopeTermIdFilter can be used
 *   // if you link this with WpTermList and put the matching data-term-id
 *   // attributes in the template
 *   'filter' => 'VTCoreIsotopeTermIdFilter',
 *
 *   // This probably the most used options
 *   'layoutMode' => 'fitRows',
 *
 *   // See isotope.metafizzy.co/options.html for more options
 * );
 *
 * TEMPLATING
 * ==========
 *
 * This class supports :
 * 1. Pure php file as template
 * 2. VTCore_Html_Base child objects as template
 * 3. class name for valid VTCore_Html_Base as template
 *
 * user should define the template in the context :
 *
 * $context['template']['items'] = the template for items inside the loop
 * $context['template']['empty'] = the template when loop found no posts.
 *
 * @method WpLoop
 * @author jason.xie@victheme.com
 *
 */
class VTCore_Wordpress_Element_WpUserLoop
extends VTCore_Wordpress_Element_WpLoop {

  protected $context = array(
    'type' => 'div',
    'attributes' => array(
      'class' => array(
        'wp-user-loop',
        'row',
      ),
    ),

    'id' => false,

    'query' => false,
    'queryArgs' => array(),

    'ajax' => false,
    'ajaxData' => array(
      'ajax-mode' => 'selfData',
      'ajax-object' => 'loop',
      'ajax-loading-text' => 'Loading...',
      'ajax-target' => false,
      'ajax-action' => 'vtcore_ajax_framework',
      'ajax-value' => 'userloop',
      'ajax-queue' => array(
        'replace',
      ),
    ),

    'grids' => array(
      'columns' => array(
        'mobile' => 12,
        'tablet' => 6,
        'small' => 4,
        'large' => 3,
      ),
    ),

    'data' => array(
      'isotope-options' => false,
    ),
    'template' => array(
      'items' => false,
      'empty' => false,
    ),

  );


  /**
   * Overriding parent method
   *
   * This is where the main logic invocation
   * for building the loop object.
   *
   * It is advisable to extends other method
   * when trying to customize this object and
   * leave this main logic intact if possible.
   *
   * @see VTCore_Html_Base::buildElement()
   */
  public function buildElement() {

    // Attempt to autodetect which query to use
    $this->detectQueryObject();
    do_action('vtcore_wordpress_user_loop_detect_query', $this);

    // Break if no useful query object
    if (!$this->getContext('query')) {
      return $this;
    }

    // Preprocess the query object
    $this->preprocessQueryObject();
    do_action('vtcore_wordpress_user_loop_process_query', $this);


    // Finalize query object
    $this->finalizeQueryObject();
    do_action('vtcore_wordpress_user_loop_finalize_query', $this);


    // Isotope auto loading mode
    if ($this->getContext('data.isotope-options')) {
      $this->prepareIsotope();
      do_action('vtcore_wordpress_user_loop_prepare_isotope', $this);
    }

    // Ajax mode
    if ($this->getContext('ajax')) {
      $this->prepareAjax();
      do_action('vtcore_wordpress_user_loop_prepare_ajax', $this);
    }

    // Build the WP Loop
    $this->prepareBeforeLoop();
    do_action('vtcore_wordpress_user_loop_before_loop', $this);

    // Looping
    $this->doLoop();
    do_action('vtcore_wordpress_user_loop_after_loop', $this);

    return $this;
  }



  /**
   * This method will attempt to detect the correct
   * query object. The detection is in this order :
   *
   * 1. Use the context query object if found
   * 2. Try to build new query object if the queryArgs
   *    is populated with valid query args.
   *
   * Overriding parent method.
   */
  protected function detectQueryObject() {

    // If user doesn't supply valid object, we
    // will build the object for them but not
    // queried nor parsed yet, let the finalize
    // query method parse and queries the object
    if (!$this->getContext('query')
        || $this->getContext('query') instanceof VTCore_Wordpress_Queries_Users == false
        && $this->getContext('queryArgs')) {

      $this->addContext('queryArgs.noquery', true);
      $this->addContext('query', new VTCore_Wordpress_Queries_Users($this->getContext('queryArgs')));
    }

    // Set the id marker to the query object
    // This will be available on vtcore_wordpress_pre_get_user hook.
    if ($this->getContext('id')) {
      $this->getContext('query')->set('vtcore_queryid', $this->getContext('id'));
    }

    // Set the object marker for the query object
    // This will be available on vtcore_wordpress_pre_get_user hook
    $this->getContext('query')->set('vtcore_object', 'wpuserloop');

    return $this;
  }

  /**
   * Preprocess query object
   * This is useful for adding dynamic query
   * variables such as for sane pagination
   * or dynamic filter.
   *
   * If need more filtering, please extend
   * the method in an extended class.
   *
   * Always fill the $metaQuery and $taxQuery
   * for metafield and taxonomy query.
   *
   */
  protected function preprocessQueryObject() {

    $this->get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    $this->post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $this->request = VTCore_Wordpress_Utility::arrayMergeRecursiveDistinct($this->post, $this->request);

    // Processing pager
    // this has to be linked with wppager to
    // work properly and both object context id
    // must be the same
    if ($this->getContext('id')
        && isset($this->get['paged-' . $this->getContext('id')])
        && is_numeric($this->get['paged-' . $this->getContext('id')])) {

      $this->getContext('query')->query['paged'] = $this->get['paged-' . $this->getContext('id')];
    }

    return $this;
  }




  /**
   * Finalizing the query arguments
   */
  protected function finalizeQueryObject() {
    // Inject the meta and tax query
    if (count($this->metaQuery) > 1) {
      $this->getContext('query')->set('meta_query', $this->metaQuery);
    }

    // Inject the tax and tax query
    if (count($this->taxQuery) > 1) {
      $this->getContext('query')->set('tax_query', $this->taxQuery);
    }

    // Refresh the query object
    $this->getContext('query')->processObject();

    // Custom data attributes for helping
    // with fancy pagination
    $this->addData('max-pagination', $this->getContext('query')->max_num_pages);
    $this->addData('current-page', max(1, $this->getContext('query')->query_vars['paged']));

    // Mark as last page
    if ($this->getData('max-pagination') == $this->getData('current-page')) {
      $this->addContext('lastpage', true);
    }

    return $this;
  }


  /**
   * Method for creating wordpress loop and
   * performing the standard wordpress loop
   *
   * This method will also inject the template
   * and / or vtcore objects
   */
  protected function doLoop() {

    if (count($this->getContext('query')->get_results()) != 0) {

      foreach ($this->getContext('query')->get_results() as $user) {
        $this->user = $user;
        $this->buildTemplate($this->getContext('template.items'));
        unset($this->user);
      }

    }

    // Nothing found, fallback to empty message
    else {
      $this->buildTemplate($this->getContext('template.empty'));

    }

    return $this;
  }

}