/**
 * Simple javascript for hiding / showing
 * the label element in a bootstrap form
 * when the form group input has value.
 *
 * @author jason.xie@victheme.com
 */
(function($) {

  function VTCoreBSLabelToggle(options) {
    this.options = $.extend({
      parent: 'form-row',
      active: 'active',
      style: 'bs-toggle-form'
    }, options);

    this.$html = $('html');
    this.$html.removeClass('no-js').addClass('js');

    this.reposition();
  };

  VTCoreBSLabelToggle.prototype = {
    init: function () {
      this.parentClass = '.' + this.options.parent;
      this.activeClass = this.options.active;

      this.$el = this.$html.find(this.parentClass).addClass(this.options.style);
      return this;
    },
    fixPlaceholder: function () {
      this.label.length && !this.self.attr('placeholder') && this.self.attr('placeholder', this.label.text());
      return this;
    },
    toggleParentClass: function () {
      this.self.val().length ? this.parent.addClass(this.activeClass) : this.parent.removeClass(this.activeClass);
      return this;
    },
    registerElement: function ($el) {
      this.self = $el;
      this.parent = this.self.closest(this.parentClass);
      this.label = this.parent.children().filter('label');
      return this;
    },
    reposition: function () {
      var that = this;
      this.$el
        .children()
        .filter('input, select, textarea')
        .not(':checkbox, :radio, :submit, :reset, .bs-toggle-processed, .jvprocessed')
        .each(function () {

          that.registerElement($(this));
          that.fixPlaceholder();
          that.toggleParentClass();

          that.self
            .addClass('bs-toggle-processed jvprocessed')
            .on('keyup blur change', function () {
              that.registerElement($(this));
              that.toggleParentClass();
            });
        });

      return this;
    }
  }

  $.fn.VTCoreBSLabelToggle = function(options) {
    return this.each(function() {
      $(this).data('bstoggle', new VTCoreBSLabelToggle(options));
    });
  }

})(jQuery);
