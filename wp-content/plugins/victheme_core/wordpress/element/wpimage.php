<?php
/**
 * VTCore Extension for building Wordpress
 * image attachment.
 *
 * @author jason.xie@victheme.com
 *
 */
class VTCore_Wordpress_Element_WpImage
extends VTCore_Html_Image {

  protected $context = array(
    'type' => 'img',
    'size' => 'thumbnail',
    'attachment_id' => false,
    'attributes' => array(
      'src' => '',
      'alt' => '',
      'width' => '',
      'height' => '',
      'ismap' => false,
      'usemap' => false,
    ),
    'force' => array(
      'square' => false,
    ),
  );

  protected $src;
  protected $width;
  protected $height;
  protected $type;
  protected $attr;
  protected $resize = false;


  /**
   * Force fixed size
   */
  protected function maybeForceSize() {

    // Force image to square
    if ($this->getContext('force.square')
        && $this->width != $this->height) {

      if ($this->width > $this->height) {
        $this->width = $this->height;
      }
      else {
        $this->height = $this->width;
      }

      $this->resize = true;
    }

    if ($this->getContext('attachment_id') && $this->resize) {
      $this->addContext('resized', VTCore_Wordpress_Utility::wpResizeImage(
        VTCore_Wordpress_Utility::wpGetAttachmentOriginalImagePath($this->getContext('attachment_id')),
        $this->width,
        $this->height,
        true,
        $this->width . 'x' . $this->height));

      if ($this->getContext('resized.url')) {
        $this->src = $this->getContext('resized.url');
      }
    }

    return $this;
  }


  /**
   * Try to detect if user provides custom attachment size
   * like 100x100.
   *
   * @return $this
   */
  protected function maybeCustomSize() {
    $size = $this->getContext('size');
    if (is_string($size)) {
      $maybeCustom = explode('x', $size);
      if (isset($maybeCustom[0])
          && isset($maybeCustom[1])
          && is_numeric($maybeCustom[0])
          && is_numeric($maybeCustom[1])) {

        $this->width = $maybeCustom[0];
        $this->height = $maybeCustom[1];

        $this->resize = TRUE;
      }
    }

    return $this;
  }


  /**
   * Overriding parent method
   * @see VTCore_Html_Base::buildElement
   */
  public function buildElement() {

    $this
      ->addAttributes($this->getContext('attributes'));

    if ($this->getContext('attachment_id')) {

      list($this->src, $this->width, $this->height) = wp_get_attachment_image_src($this->getContext('attachment_id'), $this->getContext('size'));

      $this
        ->maybeCustomSize()
        ->maybeForceSize()
        ->addAttribute('src', $this->src)
        ->addAttribute('width', $this->width)
        ->addAttribute('height', $this->height);
    }

    elseif ($this->getAttribute('src')) {

      $image = @file_get_contents($this->getAttribute('src'));
      if ($image) {

        $im = imagecreatefromstring($image);
        if ($im !== FALSE) {

          $this->width = imagesx($im);
          $this->height = imagesy($im);
          imagedestroy($im);

          $this
            ->addAttribute('width', $this->width)
            ->addAttribute('height', $this->height);
        }
      }
    }


    if ($this->getAttribute('alt') == '') {
      $this->addAttribute('alt', basename($this->src));
    }
  }
}