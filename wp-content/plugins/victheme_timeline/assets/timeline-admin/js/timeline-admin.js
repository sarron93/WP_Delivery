/**
 * 
 * Integrating to VisualComposer
 * 
 * @author jason.xie@victheme.com
 */
(function ($) {

  $(window)
    .on('vc_ready', function() {

      vc.vtcore.timeLine = {
        build: function (model) {
          _.defer(function() {
            model.horizontal = model.view.$el.find('[data-layout="horizontal"]');

            if (model.horizontal.length) {
              model.view.$content.attr('data-grid-override', true);
              model.horizontal.VTCoreHorizontalTimeline();
            }

            // Need to invoke this manually! otherwise
            // the drag placeholder will not use actual element size.
            vc.frame_window.vc_iframe.setGridSortable();
          }, this);
        }
      }

      vc.events
        .on('shortcodeView:ready:timeline', function (model) {
          vc.vtcore.registerGridContainer(model, 'vtcore-timeline');
          vc.vtcore.timeLine.build(model);
        })
        .on('shortcodeView:ready:timemajor', function (model) {
          vc.vtcore.registerGridContainer(model, 'vc_element-container');
        })
        .on('shortcodes:timemajor:destroy', function (model) {
          var parent = vc.shortcodes.get(model.get('parent_id'));
          vc.vtcore.timeLine.build(parent);
        })
        .on('shortcodeView:ready:timeend', function (model) {
          vc.vtcore.registerGridContainer(model, 'vc_element-container');
        })
        .on('shortcodes:timeend:destroy', function (model) {
          var parent = vc.shortcodes.get(model.get('parent_id'));
          vc.vtcore.timeLine.build(parent);
        })
        .on('shortcodeView:ready:timeevents', function (model) {
          vc.vtcore.registerGridContainer(model, 'vc_element-container');
        })
        .on('shortcodes:timeevents:destroy', function (model) {
          var parent = vc.shortcodes.get(model.get('parent_id'));
          vc.vtcore.timeLine.build(parent);
        });

    });

  // Make sure we are on the right window
  if ($(document).find('#vc_ui-panel-edit-element').length) {

    $(document)

      // Bind the extra dependencies inside the param group that
      // visualcomposer dont support yet, remove this when
      // VC has native support.
      .on('change.timeline_events blur.timeline_events', '[name="contentargs_timetype"]', function() {
        var value = $(this).val(),
            target = $(this).closest('.vc_param').find(
              '[data-vc-shortcode-param-name="contentargs_direction"], ' +
              '[data-vc-shortcode-param-name="contentargs_icon"], ' +
              '[data-vc-shortcode-param-name="contentargs_day"], ' +
              '[data-vc-shortcode-param-name="contentargs_month"], ' +
              '[data-vc-shortcode-param-name="contentargs_date"], ' +
              '[data-vc-shortcode-param-name="contentargs_year"], ' +
              '[data-vc-shortcode-param-name="contentargs_text"]');

        if (value == 'events') {
          target.show();
        }
        else {
          target.hide();
        }

      })

      // Dont allow vertical to have left and right and horizontal to have top and bottom
      .on('change.timeline_direction blur.timeline_direction', '.js-timeline-layout [name="layout"]', function() {
        var value = $(this).val(),
            target = $(this).closest('.vc_edit_form_elements').find('[data-vc-shortcode-param-name="contentargs_direction"]');

        target.find('option').show();
        if (value == 'vertical') {
          target.find('option.top, option.bottom').hide();
        }
        else {
          target.find('option.left, option.right').hide();
        }

      })

      // Initial loading trigger the change events
      .on('ajaxComplete', function() {
        $('#vc_ui-panel-edit-element [name="contentargs_timetype"]')
          .each(function() {
            $(this).trigger('change.timeline_events');
          });
      });
  }


})(window.jQuery);
