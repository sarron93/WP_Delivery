/**
 *  Javascript for handling the WpLoop object
 *
 *  This script depends on wp-ajax.js
 *
 *  @todo rewrite this into javascript class!.
 *  @author jason.xie@victheme.com
 */
(function ($) {

  /**
   * Bind the button click event.
   */
  $(document)

    .on('click.ajax-pager', '[data-ajax-type="pager"]:not(.pager-infinite) a', function (e) {

      var parent = $(this).closest('[data-ajax-type="pager"]'),
        target = $('[data-arrival="' + parent.data('destination') + '"]');


      if (target.length) {

        e.preventDefault();

        // Block grouped pager to avoid double ajax invoking
        parent.addClass('ajax-processing').find('a').data('ajax-stop', true);

        target
          .data('paged', $(this).attr('href'))
          .data('ajax-queue', ['replace'])
          .data('pagedContext', parent.data('context'))
          .trigger('doajax');

        setTimeout(function() {
          target.data('ajax-stop', true);
        }, 1);

        $('html, body').animate({
          scrollTop: target.offset().top - ($(window).height() * 0.20)
        }, 2000);

      }

      // No valid target fallback to normal element
      else {
        return true;
      }
    })

    .on('click.ajax-pager.infinite', '.pager-infinite[data-ajax-type="pager"] a.next', function (e) {

      var parent = $(this).closest('[data-ajax-type="pager"]'),
        target = $('[data-arrival="' + parent.data('destination') + '"]');


      if (target.length) {

        e.preventDefault();
        parent.addClass('ajax-processing');
        target
          .data('paged', $(this).attr('href'))
          .data('ajax-queue', ['append'])
          .data('pagedContext', parent.data('context'))
          .trigger('doajax');

        setTimeout(function() {
          target.data('ajax-stop', true);
        }, 1);
      }

      // No valid target fallback to normal element
      else {
        return true;
      }
    })

    .on('click.ajax-termlist', '[data-ajax-type="termlist"] a', function (e) {

      var parent = $(this).closest('[data-ajax-type="termlist"]'),
        target = $('[data-arrival="' + parent.data('destination') + '"]'),
        pager = $('[data-ajax-type="pager"][data-destination="' + parent.data('destination') + '"]');

      if (target.length) {

        e.preventDefault();

        // Block grouped pager to avoid double ajax invoking
        parent.find('a').data('ajax-stop', true);
        parent.addClass('ajax-processing');
        target
          .data('termAll', $(this).data('term-all') || false)
          .data('termId', $(this).data('term-id'))
          .data('taxonomy', $(this).data('taxonomy'))
          .data('termContext', parent.data('context'))
          .data('ajax-queue', ['replace'])
          .data('paged', 1)
          .data('pagedContext', pager.data('context'))
          .trigger('doajax');

        setTimeout(function() {
          target.data('ajax-stop', true);
        }, 1);

        $('html, body').animate({
          scrollTop: target.offset().top - ($(window).height() * 0.20)
        }, 2000);
      }

      // No valid target fallback to normal link element
      else {
        return true;
      }
    })

    .on('ajaxComplete', function (event, xhr, settings) {

      // Support for isotope specially for wp-loop element only.
      if (settings.marker
        && settings.marker.id
        && settings.marker.mode
        && settings.marker.mode == 'wp-loop') {

        var self = $('[data-ajax-type="loop"][data-arrival="' + settings.marker.id + '"]'),
          AjaxData = $.fn.VTCoreProcessAjaxResponse(xhr.responseText),
          objectQueue = $({});

        // Build Isotope
        if (settings.marker.isotope) {

          // Initialize isotope if hasn't been initialized yet.
          objectQueue.queue('item', function (next) {
            self.length
              && !self.data('isotope')
              && self.data('isotope-options')
              && self.isotope(self.data('isotope-options'));

            next();
          });

          AjaxData.content
            && AjaxData.content.action
            && $.each(AjaxData.content.action, function (key, data) {

            // Special mode for replacing the content but keep the stamped element
            if (data.mode == 'wploop-replace' && data.content) {

              //self.isotope('hide', self.isotope('getItemElements'));
              objectQueue.queue('item', function (next) {
                var elems = self.isotope('getItemElements');
                elems.length && $.each(elems, function () {

                  if (settings.marker.isotope) {
                    self.isotope('remove', $(this)).isotope('layout');
                  }

                  $(this).remove();
                });

                next();
              });

              // Queue all ajax results
              $(data.content.replace(/(\r\n|\n|\r)/gm, "")).each(function () {
                var item = $(this)
                objectQueue.queue('item', function (next) {
                  var img = imagesLoaded(item);
                  img
                    .on('done', function () {
                      self.append(item).isotope('appended', item).isotope('layout');
                      next();
                    })
                    .on('fail', function () {
                      self.append(item).isotope('appended', item).isotope('layout');
                      next();
                    });
                });
              });

            }

            // Special mode that wp-ajax.js doesn't handle
            else {
              if (data.mode == 'wploop-append' && data.content) {

                // Queue all ajax results
                $(data.content.replace(/(\r\n|\n|\r)/gm, "")).each(function () {
                  var item = $(this)
                  objectQueue.queue('item', function (next) {
                    var img = imagesLoaded(item);
                    img
                      .on('done', function () {
                        self.append(item).isotope('appended', item).isotope('layout');
                        next();
                      })
                      .on('fail', function () {
                        self.append(item).isotope('appended', item).isotope('layout');
                        next();
                      });
                  });
                });

              }
            }
          });
        }

        // Build Slick Carousel
        if (settings.marker.slick) {

          // Initialize carousel if hasn't been initialized yet.
          objectQueue.queue('item', function (next) {
            self.length
            && !self.hasClass('slick-initialized')
            && self.data('settings')
            && self.slick(self.data('settings'));

            next();
          });

          AjaxData.content
          && AjaxData.content.action
          && $.each(AjaxData.content.action, function (key, data) {

            // Special mode for replacing the content but keep the stamped element
            if ((data.mode == 'wploop-replace' || data.mode == 'wploop-remove')) {
              objectQueue.queue('item', function (next) {
                self.slickRemoveAll();
                next();
              });
            }

            // Queue all ajax results
            if (data.mode == 'wploop-replace' || data.mode == 'wploop-append') {
              data.content
                && $(data.content.replace(/(\r\n|\n|\r)/gm, "")).each(function () {
                  var item = $(this);
                  objectQueue.queue('item', function (next) {
                    var img = imagesLoaded(item);
                    img
                      .on('always', function () {
                        self.slickAdd(item);
                        next();
                      });
                  });
                });
            }
          });
        }

        // Queue finishing steps
        objectQueue.queue('item', function (next) {
          self
            .data('ajax-stop', false)
            .removeClass('ajax-processing')
            .trigger('wp-loop-ajax-processed');

          next();
        });

        // Process the queued item
        objectQueue.dequeue('item');
      }

    });


  $(window)
    .on('scroll', function () {
      $('.pager-infinite[data-ajax-type="pager"]:in-viewport').each(function () {
        $(this).find('a.next').trigger('click.ajax-pager.infinite');
      });
    });


})(jQuery);