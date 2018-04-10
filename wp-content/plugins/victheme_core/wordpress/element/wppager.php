<?php
/**
 * Class for building pagination object for wordpress using
 * paginate_links function.
 *
 * This object is designed to be paired together
 * with WpLoop and / or WpTermList, using this object
 * without WpLoop object will need additional bridge
 * to modify the related WP_Query object for retrieving
 * the $_GET[paged-{pager id}] value and inject them
 * manually into the WP_Query object.
 *
 * CONTEXT
 * =======
 *  This object is designed to play nice when multiple
 *  pager instance is visible in a single page.
 *
 *  Thus these contextes must be defined or no markup
 *  is produced :
 *
 *  $context['id'] = a unique id for marking a single
 *                   pager element, this will relate
 *                   to the $_GET query produced by this
 *                   object.
 *
 *  $context['query'] = the WP_Query object to be linked
 *                      with this pager.
 *
 *
 *  The other context variable is optional and mostly
 *  for determining the markup that this object should
 *  produce.
 *
 *
 * AJAX
 * ====
 *  This object support ajaxed pagination when paired with
 *  WpLoop object and / or WpTermList object.
 *
 *  To setup ajax for this object, you must set $context['ajax'] to true
 *
 *
 * MINI
 * ====
 *  To build a minified pager with previous and / or next link only
 *  you must define $context['mini'] = true.
 *
 *
 * INFINITE LOOP
 * =============
 *  To build infinite loop type of pager, assuming you got the context
 *  query and id setup correctly, you just need to add $context['infinite'] = true
 *
 * Supports multiple pager for different element if
 * each element has unique pager id.
 *
 * @method WpPager
 * @author jason.xie@victheme.com
 *
 */
class VTCore_Wordpress_Element_WpPager
extends VTCore_Bootstrap_Element_BsPager {

  protected $context = array(
    'type' => 'div',
    'attributes' => array(
      'class' => array(
        'pagination',
        'wp-pager',
      ),
    ),

    // Inject unique pager id here
    'id' => false,

    // Inject related content id for ajax here
    'ajax' => false,
    'prev_next' => true,
    'prev_text' => '&laquo',
    'next_text' => '&raquo',
    'end_size'  => '4',
    'mid_size' => '2',
    'add_fragment' => false,
    'mini' => false,

    // Infinite loop mode
    'infinite' => false,

    // Inject related WP_Query object here.
    'query' => false,

    'raw' => true,

    'ajaxloading_element' => array(
      'type' => 'div',
      'text' => 'Processing ...',
      'attributes' => array(
        'class' => array(
          'pager-ajax-notice',
          'well'
        ),
      ),
    ),
  );


  protected $get;
  protected $baseURL;
  protected $link;
  protected $big;
  protected $pager;
  protected $ajaxContext;


  /**
   * Overriding parent method
   * The main logic for building the pager markup
   */
  public function buildElement() {

    // Don't proceed any further without
    // valid query object or valid target id
    if ($this->getContext('query')
        || $this->getContext('id')) {

      $this->buildPager();

      // Break if we got no pager value and only if
      // not on ajax mode
      if (empty($this->pager)
          && !$this->getContext('ajax')) {

        $this->setType(false);
        return $this;
      }

      parent::buildElement();

      if ($this->getContext('infinite')) {
        $this->buildInfinite();
      }

      if ($this->getContext('ajax')) {
        $this->buildAjax();
      }

      if (is_array($this->pager)) {
        foreach ($this->pager as $pager) {
          $this->buildPagerItem($pager);
        }
      }
    }

    else {
      $this->setType(false);
    }

    do_action('vtcore_wordpress_pager_object_alter', $this);

    return $this;
  }




  /**
   * Method for processing pager get entries
   */
  protected function preProcessGet() {

    $this->get = (array) filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

    // Clean the get variables for fixing
    // multiple pager at once
    foreach ($this->get as $key => $value) {
      $this->get[$key] = preg_replace('/\?.*/', '', $value);
    }

    // Remove double get entry
    $this->get = array_unique($this->get);

    // Update query current page
    if (isset($this->get[$this->getContext('queryid')])) {
      $this->getContext('query')->set('paged', preg_replace('/\?.*/', '', $this->get[$this->getContext('queryid')]));
      unset($this->get[$this->getContext('queryid')]);
    }

    return $this;
  }




  /**
   * Method for processing the base url for paginate_links
   */
  protected function preProcessBaseUrl() {
    global $wp_rewrite;

    $this->big = 999999999;
    $this->link = html_entity_decode(get_pagenum_link($this->big));
    $this->link = remove_query_arg($this->getContext('queryid'), $this->link);

    // @experimental broken in ajax, need to test with multiple pager at one page
    //$this->link = trim(preg_replace('/\?.*/', '', $this->link));

    if (!$wp_rewrite->using_permalinks() || is_admin()) {
      $this->baseURL = str_replace('paged=', $this->getContext('queryid') .'=', $this->link);
    }
    else {
      // Somehow str_replace() will screw things up if we
      // replace the string in a single line due to backslash
      // this is happens only on linux system.
      $this->baseURL = str_replace('/page/', '?' . $this->getContext('queryid') . '=', $this->link);
      $this->baseURL = str_replace($this->big . '/', $this->big, $this->baseURL);
    }

    return $this;
  }




  /**
   * Intersect context for retrieving only
   * allowed value to be passed via ajax
   */
  protected function preProcessAjaxContext() {
    $this->ajaxContext = array_intersect_key($this->getContexts(), array_flip(array(
      'type',
      'attributes',
      'id',
      'ajax',
      'infinite',
      'prev_next',
      'prev_text',
      'next_text',
      'end_size',
      'add_fragment',
      'mini',
    )));

    return $this;
  }



  /**
   * Preparing object for ajax operations
   */
  protected function buildAjax() {
    VTCore_Wordpress_Utility::loadAsset('wp-ajax');
    VTCore_Wordpress_Utility::loadAsset('wp-loop');

    $this
      ->preProcessAjaxContext()
      ->addData('context', base64_encode(serialize($this->ajaxContext)))
      ->addData('ajax-type', 'pager')
      ->addData('destination', $this->getContext('id'))
      ->prependChild(new VTCore_Html_Element($this->getContext('ajaxloading_element')));

    return $this;
  }



  /**
   * Preparing object for ajax operations
   */
  protected function buildInfinite() {

    VTCore_Wordpress_Utility::loadAsset('jquery-viewport');

    $this->preProcessInfinite();

    return $this;
  }




  /**
   * Build the single pager markup
   */
  protected function buildPagerItem($pager) {

    $pager = str_replace("'", '"', $pager);

    if ($this->getContext('mini')
        && (strpos($pager, '<a class="prev ') === false && strpos($pager, '<a class="next ') === false)) {

      return $this;
    }

    $this->addContent(new VTCore_Html_Element(array(
      'raw' => true,
      'text' => html_entity_decode($pager),
    )));

    return $this;
  }





  /**
   * Force convert the context for supporting
   * pager on mini mode.
   */
  protected function preProcessMini() {

    $this
      ->addClass('pager-mini')
      ->addContext('max', 1)
      ->addContext('show_all', true)
      ->addContext('end_size', 0)
      ->addcontext('prev_next', true);

    return $this;
  }



  /**
   * Preprocess context for supporting infinite pager
   */
  protected function preProcessInfinite() {
    $this
      ->addClass('pager-infinite')
      ->addContext('prev_next', true)
      ->addContext('ajax', true);
  }



  /**
   * Building the main pager arguments using
   * paginate_links function.
   */
  protected function buildPager() {

    $this
      ->addContext('max', 0)
      ->addContext('queryid', 'paged-' . $this->getContext('id'))
      ->preProcessGet()
      ->preProcessBaseUrl();

    $this->addContext('show_all', ($this->getContext('query')->max_num_pages < 10 ) ? true : false);

    if ($this->getContext('mini')) {
      $this->preProcessMini();
    }

    // Fix missing next button
    if ($this->getContext('infinite')) {
      $this->addContext('max', 1);
    }

    $this->pager = paginate_links(array(
      'base' => str_replace($this->big, '%#%', $this->baseURL),
      'format' => '?' . $this->getContext('queryid') . '=%#%',
      'total' => $this->getContext('query')->max_num_pages,
      'current' =>  max($this->getContext('max'), $this->getContext('query')->query_vars['paged']),
      'type' => 'array',
      'add_args' => empty($this->get) ? false : $this->get,
      'show_all' => $this->getContext('show_all'),
      'prev_next' => $this->getContext('prev_next'),
      'prev_text' => $this->getContext('prev_text'),
      'next_text' => $this->getContext('next_text'),
      'end_size'  => $this->getContext('end_size'),
      'add_fragment' => $this->getContext('add_fragment'),
    ));

    return $this;
  }

}