<?php
global $crf_default_options;

$crf_default_options = array();

/* General */

$crf_default_options['site-layout'] = 'wide';

$crf_default_options['main-width'] = 1200;
$crf_default_options['sidebar-width'] = 25;

$crf_default_options['logo-light'] = get_template_directory_uri() . '/images/logo.png';
$crf_default_options['logo-light-retina'] = get_template_directory_uri() . '/images/logo@2x.png';
$crf_default_options['logo-dark'] = get_template_directory_uri() . '/images/logo-dark.png';
$crf_default_options['logo-dark-retina'] = get_template_directory_uri() . '/images/logo-dark@2x.png';

$crf_default_options['color-scheme'] = 'light';
$crf_default_options['primary-color'] = '#4396e6';
$crf_default_options['secondary-color'] = '#f56048';
$crf_default_options['gradient1-start-color'] = '#ed2a99';
$crf_default_options['gradient1-end-color'] = '#4396e6';
$crf_default_options['gradient2-start-color'] = '#8560a8';
$crf_default_options['gradient2-end-color'] = '#f26d7d';
$crf_default_options['text-color'] = '#818d9a';
$crf_default_options['heading-color'] = '#3a424a';
$crf_default_options['heading-light-color'] = '#22262b';
$crf_default_options['border-color'] = '#dce2ed';
$crf_default_options['heading-underline-color'] = '#ebebeb';
$crf_default_options['bg-color'] = '#ffffff';
$crf_default_options['bg-color2'] = '#f8f8f8';

// General - dark colors
$crf_default_options['text-color-dark'] = '#6c7884';
$crf_default_options['heading-color-dark'] = '#e1e1e1';
$crf_default_options['heading-light-color-dark'] = '#e1e1e1';
$crf_default_options['border-color-dark'] = '#818d9a';
$crf_default_options['heading-underline-color-dark'] = '#606060';
$crf_default_options['bg-color-dark'] = '#23252d';
$crf_default_options['bg-color2-dark'] = '#333641';

// Outer/content background
$crf_default_options['outer-bg-type'] = 'pattern';
$crf_default_options['outer-bg-pattern'] = '01';
$crf_default_options['outer-bg-image'] = '';
$crf_default_options['outer-bg-repeat'] = 'no-repeat';

$crf_default_options['content-bg-image'] = '';
$crf_default_options['content-bg-repeat'] = 'no-repeat';

$crf_default_options['error404-bg-image'] = get_template_directory_uri() . '/images/error404-bg.jpg';
$crf_default_options['error404-bg-repeat'] = 'no-repeat';

// Background - dark colors / patterns
$crf_default_options['outer-bg-pattern-dark'] = '03';

// Extra
$crf_default_options['page-comments-enable'] = 'yes';
$crf_default_options['css3-animation-on-mobile'] = 'no';

/* Header */

$crf_default_options['header-style'] = 'v1';
$crf_default_options['header-bg-color'] = $crf_default_options['bg-color'];
$crf_default_options['header-top-border'] = 'hide';
$crf_default_options['header-show-search-icon'] = 'show';
$crf_default_options['header-show-shop-icon'] = 'show';
$crf_default_options['header-v2-bg-image'] = get_template_directory_uri() . '/images/header-v2-bg.jpg';
$crf_default_options['header-v2-skin'] = 'dark';
$crf_default_options['header-enable-sticky'] = 'yes';

$crf_default_options['topbar-phone'] = '+1-202-555-0175';
$crf_default_options['topbar-email'] = 'support@theme-paradise.com';

$crf_default_options['topbar-show'] = 'show';
$crf_default_options['topbar-skin'] = 'default-bg';
$crf_default_options['topbar-height'] = '50';
$crf_default_options['topbar-text-color'] = '#afbcca';
$crf_default_options['topbar-bg-color'] = $crf_default_options['bg-color'];
$crf_default_options['topbar-icon-social-color'] = '#cbd1dc';
$crf_default_options['topbar-bottom-border'] = 'show';

$crf_default_options['main-nav-hover-style'] = 'hover1';
$crf_default_options['main-nav-height'] = '110';
$crf_default_options['header-v4-logoarea-height'] = '110';
$crf_default_options['header-v4-main-nav-height'] = '60';
$crf_default_options['main-nav-font-color'] = '#6c7884';
$crf_default_options['main-nav-font-color-dark'] = '#e1e1e1';
$crf_default_options['main-nav-hover-color'] = $crf_default_options['primary-color'];
$crf_default_options['main-nav-hover-color-dark'] = '#cccccc';
$crf_default_options['main-nav-bg-color'] = $crf_default_options['bg-color'];
$crf_default_options['main-nav-bg-color-dark'] = '#272932';

$crf_default_options['v3-logoarea-top-padding'] = '60';
$crf_default_options['v3-logoarea-bottom-padding'] = '60';
$crf_default_options['v3-logoarea-bg-color'] = $crf_default_options['bg-color'];

$crf_default_options['dropdown-item-width'] = '280';
$crf_default_options['dropdown-item-height'] = '48';
$crf_default_options['dropdown-item-padding'] = '30';
$crf_default_options['dropdown-item-color'] = '#646e79';
$crf_default_options['dropdown-item-color-dark'] = '#a0a6ac';
$crf_default_options['dropdown-item-arrow-color'] = '#818d9a';
$crf_default_options['dropdown-item-arrow-color-dark'] = '#8f959e';
$crf_default_options['dropdown-bg-color'] = '#ffffff';
$crf_default_options['dropdown-bg-color-dark'] = '#3e4753';
$crf_default_options['dropdown-bg-color-hover'] = $crf_default_options['bg-color2'];
$crf_default_options['dropdown-bg-color-hover-dark'] = '#424d59';
$crf_default_options['dropdown-separator-color'] = $crf_default_options['border-color'];
$crf_default_options['dropdown-separator-color-dark'] = '#57626d';
$crf_default_options['dropdown-hover-color'] = $crf_default_options['primary-color'];
$crf_default_options['dropdown-hover-color-dark'] = '#d5dae1';

/* Titlebar */

$crf_default_options['titlebar-blog-style'] = 'small';
$crf_default_options['titlebar-blog-bg-type'] = 'image';
$crf_default_options['titlebar-blog-bg'] = get_template_directory_uri() . '/images/blog-titlebar-bg.jpg';
$crf_default_options['titlebar-small3-hide-single-title'] = 'no';
$crf_default_options['titlebar-portfolio-style'] = 'small2';
$crf_default_options['titlebar-portfolio-bg-type'] = 'image';
$crf_default_options['titlebar-portfolio-bg'] = get_template_directory_uri() . '/images/portfolio-titlebar-bg.jpg';
$crf_default_options['titlebar-page-style'] = 'small';
$crf_default_options['titlebar-page-bg-type'] = 'bg2';
$crf_default_options['titlebar-page-bg'] = '';
$crf_default_options['titlebar-search-style'] = 'small';
$crf_default_options['titlebar-search-bg-type'] = 'image';
$crf_default_options['titlebar-search-bg'] = get_template_directory_uri() . '/images/blog-titlebar-bg.jpg';
$crf_default_options['titlebar-woocommerce-style'] = 'small';
$crf_default_options['titlebar-woocommerce-bg-type'] = 'bg2';
$crf_default_options['titlebar-woocommerce-bg'] = '';
$crf_default_options['titlebar-404-style'] = 'small2';
$crf_default_options['titlebar-404-bg-type'] = 'image';
$crf_default_options['titlebar-404-bg'] = get_template_directory_uri() . '/images/error404-titlebar-bg.jpg';

/* Footer */

$crf_default_options['footer-style'] = 'style1';
$crf_default_options['footer-bg-style3'] = get_template_directory_uri() . '/images/footer-bg.jpg';
$crf_default_options['footer-bg-image-opacity'] = '5';
$crf_default_options['footer-text-color'] = "#818d9a";
$crf_default_options['footer-bg-color'] = "#25313f";
$crf_default_options['footer-border-color'] = "#374554";
$crf_default_options['widget-area-title-color'] = "#dee9f5";
$crf_default_options['footer-copyright-bg-color'] = "#2c3b4b";

$crf_default_options['footer-bar-shortcode'] = '';

$crf_default_options['widget-area-show'] = 'show';
$crf_default_options['widget-area-columns'] = '4';
$crf_default_options['widget-area-padding-top'] = '90';
$crf_default_options['widget-area-padding-bottom'] = '100';

$crf_default_options['style1-copyright-logo'] = get_template_directory_uri() . '/images/footer-logo.png';
$crf_default_options['style1-copyright-logo-retina'] = get_template_directory_uri() . '/images/footer-logo@2x.png';
$crf_default_options['footer-copyright-text'] = 'Copyright &copy; 2015 Semona Theme by Theme-Paradise';
$crf_default_options['footer-copyright-right'] = 'menu';
$crf_default_options['footer-copyright-bar-padding-top'] = '28';
$crf_default_options['footer-copyright-bar-padding-bottom'] = '28';

/* Font */

$crf_default_options['heading-font'] = "Raleway";
$crf_default_options['heading-font-weight'] = "700";
$crf_default_options['post-heading-font-weight'] = "600";
$crf_default_options['h1-font-size'] = "36";
$crf_default_options['h2-font-size'] = "30";
$crf_default_options['h3-font-size'] = "24";
$crf_default_options['h4-font-size'] = "20";
$crf_default_options['h5-font-size'] = "18";
$crf_default_options['h6-font-size'] = "16";
$crf_default_options['text-font'] = "Raleway";
$crf_default_options['text-font2'] = "Lato";
$crf_default_options['text-font-weight'] = "400";
$crf_default_options['text-font-size'] = "14";
$crf_default_options['text-line-height'] = '1.72';

$crf_default_options['topbar-font'] = 'Lato';
$crf_default_options['topbar-font-weight'] = '400';
$crf_default_options['topbar-font-size'] = '14';
$crf_default_options['topbar-icon-size'] = '16';
$crf_default_options['nav-font'] = 'Raleway';
$crf_default_options['main-nav-font-weight'] = '700';
$crf_default_options['nav-font-size'] = '14';
$crf_default_options['dropdown-item-font-weight'] = '400';

$crf_default_options['footer-heading-font'] = 'Raleway';
$crf_default_options['footer-heading-font-size1'] = '22';
$crf_default_options['footer-heading-font-size2'] = '15';
$crf_default_options['footer-heading-font-weight'] = '600';
$crf_default_options['footer-text-font'] = 'Raleway';
$crf_default_options['footer-copyright-font'] = 'Lato';
$crf_default_options['footer-social-icon-size'] = '20';


/* Elements */

// Accordion
$crf_default_options['accordion-hdr-color'] = '#6c7884';
$crf_default_options['accordion-active-hdr-color'] = '#ffffff';

// Button
$crf_default_options['button-shape'] = 'sm-shape-rounded';
$crf_default_options['button-size'] = 'sm-size-md';
$crf_default_options['button-letter-spacing'] = '2';
$crf_default_options['button-light-color'] = ''; //$crf_default_options['primary-color'];
$crf_default_options['button-dark-color'] = ''; //$crf_default_options['primary-color'];
$crf_default_options['button-min-width'] = '';

// Section Header
$crf_default_options['section-header-title-font-size'] = '26';
$crf_default_options['section-header-letter-spacing'] = '3';
$crf_default_options['section-header-underline-thickness'] = '4';
$crf_default_options['section-header-underline-shape'] = 'sm-shape-square';
$crf_default_options['section-header-uppercase'] = 'yes';

// Tabs
$crf_default_options['tabs-hdr-color1'] = '#6c7884';
$crf_default_options['tabs-hdr-color2'] = '#ffffff';

// Vertical Tabs
$crf_default_options['vtabs-light-text-color'] = '#818d9a';
$crf_default_options['vtabs-light-active-color'] = '#f8f8f8';
$crf_default_options['vtabs-light-inactive-color'] = '#f2f2f2';
$crf_default_options['vtabs-dark-text-color'] = '#ffffff';
$crf_default_options['vtabs-dark-active-color'] = '#3d4752';
$crf_default_options['vtabs-dark-inactive-color'] = '#5d6c7d';

// Pricing Table
$crf_default_options['pt-featured-color'] = $crf_default_options['secondary-color'];

$crf_default_options['pt-theme-light-bg1'] = $crf_default_options['bg-color'];
$crf_default_options['pt-theme-light-bg2'] = $crf_default_options['bg-color2'];
$crf_default_options['pt-theme-light-heading-text'] = $crf_default_options['heading-color'];
$crf_default_options['pt-theme-light-feature-text'] = $crf_default_options['text-color'];
$crf_default_options['pt-theme-light-border'] = $crf_default_options['border-color'];

$crf_default_options['pt-theme-dark-bg1'] = $crf_default_options['bg-color2-dark'];
$crf_default_options['pt-theme-dark-bg2'] = '#3a3d49';
$crf_default_options['pt-theme-dark-heading-text'] = $crf_default_options['heading-color-dark'];
$crf_default_options['pt-theme-dark-feature-text'] = '#696f77';
$crf_default_options['pt-theme-dark-border'] = '#2b2d36';

// Feature Box
$crf_default_options['featurebox-title-font-family'] = $crf_default_options['heading-font'];
$crf_default_options['featurebox-title-font-size'] = 15;
$crf_default_options['featurebox-title-letter-spacing'] = 2;
$crf_default_options['featurebox-title-font-weight'] = "700";

// Quotes Slider
$crf_default_options['quotes-content-font-family'] = 'Crete Round';

// Timeline
$crf_default_options['timeline-spine-color'] = $crf_default_options['text-color'];
$crf_default_options['timeline-border-color'] = $crf_default_options['border-color'];
$crf_default_options['timeline-spine-hover-color'] = $crf_default_options['secondary-color'];

/* Preloader */

$crf_default_options['preloader-enable'] = 'hide';
$crf_default_options['preloader-logo'] = get_template_directory_uri() . '/images/preloader-logo.png';
$crf_default_options['preloader-logo-retina'] = get_template_directory_uri() . '/images/preloader-logo@2x.png';
$crf_default_options['preloader-bar-color'] = $crf_default_options['primary-color'];

/* Blog */

$crf_default_options['blog-layout'] = 'classic';
$crf_default_options['blog-columns'] = '3';
$crf_default_options['blog-index-title'] = esc_html__( 'Blog Index Page', 'semona' );
$crf_default_options['blog-excerpt-length'] = '55';
$crf_default_options['blog-dateformat'] = 'F j, Y';
$crf_default_options['blog-pagination'] = 'pagination';
$crf_default_options['blog-bg-color'] = '#f7f6f4';
$crf_default_options['post-format-box-color'] = '#2acbd6';
$crf_default_options['post-readmore-link-color'] = '#42484d';
$crf_default_options['post-box-shadow-color'] = '#eae9e8';

// Blog - dark colors
$crf_default_options['blog-bg-color-dark'] = $crf_default_options['bg-color2-dark'];
$crf_default_options['post-box-shadow-color-dark'] = '#17181c';

/* Portfolio */

$crf_default_options['portfolio-layout'] = 'masonry';
$crf_default_options['portfolio-masonry-columns'] = '4';
$crf_default_options['portfolio-grid-columns'] = '3';
$crf_default_options['portfolio-items-per-page'] = '12';
$crf_default_options['portfolio-pagination'] = 'loadmore';
$crf_default_options['portfolio-show-related'] = 'yes';
$crf_default_options['portfolio-related-style'] = 'grid';
$crf_default_options['portfolio-show-comments'] = 'no';
$crf_default_options['portfolio-grid2-shadow-color'] = '#e5e5e5';
$crf_default_options['portfolio-slug'] = 'portfolio-items';

// Portfolio - dark colors
$crf_default_options['portfolio-grid2-shadow-color-dark'] = '#17181c';

/* Sidebar */

$crf_default_options['sidebar-blog'] = 'crf-sidebar-1';
$crf_default_options['sidebar-blog-pos'] = 'right';
$crf_default_options['sidebar-portfolio'] = '-1';
$crf_default_options['sidebar-portfolio-pos'] = 'right';
$crf_default_options['sidebar-page'] = '-1';
$crf_default_options['sidebar-page-pos'] = 'right';
$crf_default_options['sidebar-search'] = '-1';
$crf_default_options['sidebar-search-pos'] = 'right';
$crf_default_options['sidebar-woocommerce'] = 'crf-shop-sidebar';
$crf_default_options['sidebar-woocommerce-pos'] = 'right';
$crf_default_options['sidebar-bbpress'] = '-1';
$crf_default_options['sidebar-bbpress-pos'] = 'right';

/* Social Links */

$crf_default_options['social-facebook'] = '#';
$crf_default_options['social-twitter'] = '#';
$crf_default_options['social-dribbble'] = '#';
$crf_default_options['social-googleplus'] = '#';
$crf_default_options['social-instagram'] = '#';
$crf_default_options['social-pinterest'] = '#';
$crf_default_options['social-skype'] = '#';
$crf_default_options['social-youtube'] = '#';
$crf_default_options['social-rss'] = '#';
$crf_default_options['social-tumblr'] = '#';
$crf_default_options['social-behance'] = '#';
$crf_default_options['social-vimeo'] = '#';
$crf_default_options['social-github'] = '#';
$crf_default_options['social-linkedin'] = '#';

/* Woocommerce */
$crf_default_options['woocommerce-product-columns'] = '3';
$crf_default_options['woocommerce-products-per-page'] = '9';

/* Custom code */

$crf_default_options['custom-css'] = '';
$crf_default_options['custom-js'] = '';

