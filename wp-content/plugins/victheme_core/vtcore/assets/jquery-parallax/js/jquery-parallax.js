/*!
 Plugin:  jquery-parallax
 Version  1.1
 Author:  Víctor 'vxc' Ortega
 URL: 	 http://www.vxc.es/
 GitHub:  https://github.com/vxc-/jquery-parallax

 Customized version, don't update !
 2014, Licensed under the MIT and GPL licenses.
 */

(function ($) {

  var $window = $(window);
  var $windowHeight;

  var Parallax = {

    //Object vars
    defaults: {},

    element: null,

    bgXunit: 'px',

    bgXvalue: 0,

    bgYunit: 'px',

    bgYvalue: 0,

    elementTop: 0,

    proxyTransition: function () {
    },

    __init: function (element, options) {

      var $this = this;

      $this.element = $(element);

      $this.$id = $this.element.attr('class');

      //Set options
      $this.setConfig(options);

      $this.render();
    },

    setConfig: function (options) {

      var $this = this;

      $this.defaults = $.extend({}, $.fn.parallax.DEFAULTS, options);

      $this.dispatchTransitionType();

      $this.parseBGPosition();

      var transition = $this.defaults.transitionType;

      //Tuning speed for % positioned images TODO: Rework all this
      if ((transition == 'vertical' && $this.bgYunit == '%' ) || (transition == 'horizontal' && $this.bgXunit == '%' )) {
        $this.defaults.speed = $this.defaults.speed / 4;
      }

    },

    dispatchTransitionType: function () {

      var $this = this;

      switch ($this.defaults.transitionType) {
        case 'vertical':
          $this.proxyTransition = $.proxy($this.renderVertical, $this);
          break;
        case 'horizontal':
          $this.proxyTransition = $.proxy($this.renderHorizontal, $this);
          break;
        case 'diagonal':
          $this.proxyTransition = $.proxy($this.renderDiagonal, $this);
          break;
      }

    },

    getHeight: function () {

      var element = this.element;
      var defaults = this.defaults;

      if (defaults.outerHeight) {
        return element.outerHeight(true);
      }
      else {
        return element.height();
      }

    },

    parseBGPosition: function () {

      var IEtranslations = {
        top: {x: '50%', y: '0px'},
        bottom: {x: '50%', y: '100%'}
      };

      var $this = this;

      var pattern = new RegExp(/[-+]?\d*\.?\d*/);

      var BGPosArr = $this.element.css('background-position').split(" ");

      //IExplorer possible clase
      if (BGPosArr.length == 1) {
        //Matching key in translation object
        if (BGPosArr[0] in IEtranslations) {
          var matchKey = BGPosArr[0];
          var match = IEtranslations[matchKey];
          BGPosArr[0] = match.x;
          BGPosArr[1] = match.y;
          //If it doesn't match is always 50%
        }
        else {
          BGPosArr[1] = '50%';
        }
      }

      $this.bgXunit = BGPosArr[0].replace(pattern, '');
      $this.bgYunit = BGPosArr[1].replace(pattern, '');

      $this.bgXvalue = parseFloat(BGPosArr[0].replace($this.bgXunit, ''));
      $this.bgYvalue = parseFloat(BGPosArr[1].replace($this.bgYunit, ''));


      if ($this.bgXvalue == 0) {
        $this.bgXunit = 'px';
      }

      if ($this.bgYvalue == 0) {
        $this.bgYunit = 'px';
      }

    },

    renderVertical: function (currentPos) {

      var $this = this;

      $this.element.css('background-position',
        $this.bgXvalue + $this.bgXunit + ' ' + ($this.bgYvalue + Math.round((currentPos - $this.elementTop) * $this.defaults.speed)) + $this.bgYunit);
    },

    renderHorizontal: function (currentPos) {

      var $this = this;

      $this.element.css('background-position',
        ($this.bgXvalue + Math.round((currentPos - $this.elementTop) * $this.defaults.speed)) + $this.bgXunit) + ' ' + $this.bgYvalue + $this.bgYunit;
    },

    renderDiagonal: function (currentPos) {

      var $this = this;

      var movCalc = Math.round((currentPos - $this.elementTop) * $this.defaults.speed);

      this.element.css('background-position',
        (($this.bgXvalue + movCalc ) + $this.bgXunit) + " " + (($this.bgYvalue + movCalc ) + $this.bgYunit));

    },

    render: function () {


      var $this = this;
      var currentPos = $window.scrollTop();
      $this.elementTop = $this.element.offset().top;
      var elementHeight = $this.getHeight();

      //Return if we are not within viewport
      if ($this.elementTop + elementHeight < currentPos || $this.elementTop > currentPos + $windowHeight) {
        return;
      }

      $this.proxyTransition(currentPos);

    }

  };

  //Global Scope Listener
  $windowHeight = $window.height();

  //Constructor definition
  if (typeof Object.create !== "function") {
    Object.create = function (obj) {
      function Fun() {
      };
      Fun.prototype = obj;
      return new Fun();
    };
  }

  $.fn.parallax = function (options) {
    return this.each(function () {
      var parallax = $(this).data('Parallax') || Object.create(Parallax);
      parallax.__init(this, options);
      $(this).data('Parallax', parallax);
    });

  };


  $.fn.parallax.DEFAULTS = {
    speed: 0.5,
    outerHeight: true,
    transitionType: 'vertical'
  };

  var ParallaxObjects = {
    init: function() {

      $('.parallax-vertical:not(.parallax)').parallax({
        speed: 0.8,
        transitionType: 'vertical'
      }).addClass('parallax');

      $('.parallax-horizontal:not(.parallax)').parallax({
        speed: 0.8,
        transitionType: 'horizontal'
      }).addClass('parallax');

      $('.parallax-diagonal:not(.parallax)').parallax({
        speed: 0.8,
        transitionType: 'diagonal'
      }).addClass('parallax');

      this.$el = $('.parallax');
      return this;
    },
    checkImage: function() {

      this.img = new Image();
      this.img.src = this.$current.css('background-image').replace(/"/g,"").replace(/url\(|\)$/ig, "");
      this.img;
      this.img.ratio = this.img.width / this.img.height;

      return this;
    },
    stretchImage: function() {

      this.img || this.checkImage();

      if (this.$current.hasClass('parallax-vertical')) {
        this.frame = {
          width: this.$current.width(),
          height: this.$current.height() * 1.5
        }
      }
      else if (this.$current.hasClass('paralax-horizontal')) {
        this.frame = {
          width: this.$current.width() * 1.5,
          height: this.$current.height()
        }
      }
      else if (this.$current.hasClass('parallax-diagonal')) {
        this.frame = {
          width: this.$current.width() * 1.5,
          height: this.$current.height() * 1.5
        }
      }

      if (this.frame) {
        this.newsize = {
          width: this.frame.width,
          height: this.frame.width / this.img.ratio
        };

        // Image is shorter than the viewport
        if (this.newsize.height < this.frame.height) {
          this.newsize.height = this.frame.height;
          this.newsize.width = this.newsize.height * this.img.ratio;
        }
        this.$current.css('background-size', this.newsize.width + 'px ' + this.newsize.height + 'px');
      }
      return this;
    },
    resizeImage: function() {
      var that = this;
      this.$el.each(function(key, val) {
        that.$current = $(this);
        that.checkImage().stretchImage();
      });
      return this;
    },
    reposition: function() {
      var that = this;
      this.$el.each(function(key, val) {
        $(this).data('Parallax').render();
      });
      return this;
    }
  }

  ParallaxObjects.init();

  $(window)

    .off('scroll.parallax')
    .on('scroll.parallax', function() {

      // VC needs to be refreshed this way!
      window.vc_iframe && ParallaxObjects.init();

      ParallaxObjects.reposition();
    })

    .off('resize.parallax')
    .on('resize.parallax', function() {
      ParallaxObjects.resizeImage().reposition();
      $windowHeight = $(this).height();
    })
    .on('pageready.parallax', function() {
      ParallaxObjects.init().resizeImage().reposition();
    })
    .on('load.parallax', function() {
      ParallaxObjects.init().resizeImage().reposition();
    });

  $(document)
    .on('ajaxComplete.parallax', function () {
      ParallaxObjects.init().resizeImage();
    });

})(window.jQuery);
