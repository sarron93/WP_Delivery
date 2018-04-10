/**
 * Simple script for drawing lines connecting memoryline
 * content
 *
 * @author jason.xie@victheme.com
 */
(function($) {

  /**
   * Object for detecting and storing coordinates for
   * each dots. use this on each memory line child entry.
   *
   * @param element
   *   the memory child jQuery object
   *
   * @param canvas
   *   the designated canvas object
   *
   * @constructor
   */
  var MemoryLinesDot = function(element, container) {
    this.$el = element;
    this.$container = container
  }



  /**
   * Memory line dot methods.
   * @type {{setCanvas: Function, setPosition: Function, setOffsets: Function, setDotPosition: Function, drawDots: Function}}
   */
  MemoryLinesDot.prototype = {

    setDirection: function(direction) {
      this.direction = this.$el.data('dot-direction') || direction || 'forward';
      return this;
    },

    setOffset: function() {
      this.offset = {
        x: this.$el.data('dot-offset-x') || this.$container.data('dot-offset-x') || 0,
        y: this.$el.data('dot-offset-y') || this.$container.data('dot-offset-y') || 0
      }

      return this;
    },

    setLine: function() {
      this.line = {
        color: this.$el.data('line-color') || this.$container.data('line-color') || '#f0f0f0',
        width: this.$el.data('line-width') || this.$container.data('line-width') || 10,
        type: this.$el.data('line-type') || this.$container.data('line-type') || 'round'
      }

      return this;
    },

    setDot: function() {

      this.dot = {
        radius: this.$el.data('dot-radius') || this.$container.data('dot-radius') || 8,
        color: this.$el.data('dot-color') || this.$container.data('dot-color') || '#ff6c00'
      }

      this.dot.x = this.$el.offset().left - this.$container.offset().left + this.offset.x + this.dot.radius,
      this.dot.y = this.$el.offset().top - this.$container.offset().top + this.offset.y - this.dot.radius /2

      this.checkBoundary();

      return this;
    },

    checkBoundary: function() {
      // consider as inner padding of canvas
      this.gap = 20;

      if (this.dot.x < this.dot.radius + this.gap) {
        this.dot.x = this.dot.radius + this.gap;
      }
      else if (this.dot.x > this.$container.innerWidth() + this.gap- this.dot.radius) {
        this.dot.x = this.$container.innerWidth() + this.gap - this.dot.radius;
      }

      if (this.dot.y < this.dot.radius + this.gap) {
        this.dot.y = this.dot.radius + this.gap;
      }
      else if (this.dot.y > this.$container.innerHeight() + this.gap - this.dot.radius) {
        this.dot.y = this.$container.innerHeight() - this.dot.radius + this.gap;
      }

      return this;
    },

    process: function() {
      this
        .setDirection()
        .setOffset()
        .setLine()
        .setDot();

      return this;
    }
  }


  /**
   * Object for grouping all the memory line child elements
   * and building the dots and lines
   *
   * @param element
   *   jQuery object for the main wrapper element
   *
   * @param canvas
   *   jQuery object for the canvas element
   *
   * @param children
   *   jQuery object for group of children elements
   *   use jQuery find to get all the element and pass
   *   it to the object
   *
   * @constructor
   */
  var MemoryLinesConnector = function(element, canvas, children) {
    this.$el = element;
    this.$canvas = canvas;
    this.$children = children;

    this.dots = {};

    this.line = {
      color: this.$el.data('line-color') || '#f0f0f0',
      width: this.$el.data('line-width') || 10,
      type: this.$el.data('line-type') || 'round'
    }

    this.offset = {
      x: this.$el.data('line-offset-x') || 0,
      y: this.$el.data('line-offset-y') || 2
    }

    return this;
  }


  /**
   * Collection of object methods
   * @type {{setCanvas: Function, setSource: Function, setTarget: Function, addDot: Function, getDot: Function, checkHorizontal: Function, setRadius: Function, setDirection: Function, setArc: Function, clearCanvas: Function, drawLine: Function, drawCurve: Function, drawMode: Function, drawConnector: Function, drawObject: Function}}
   */
  MemoryLinesConnector.prototype = {

    setCanvas: function() {
      this.ctx = this.$canvas.get(0).getContext('2d');
      return this;
    },

    setSource: function(dot) {
      this.source = dot;
      return this;
    },

    setTarget: function(dot) {
      this.target = dot;
      return this;
    },

    addDot: function(delta, dot) {
      this.dots[delta] = dot;
      return this;
    },

    getDot: function(delta) {
      return this.dots[delta] || false;
    },

    checkHorizontal: function() {

      // Only do horizontal mode if the target is aligned
      // horizontally with source and both width is equal
      // to canvas width
      if ((this.source.$el.outerWidth(true) == this.$canvas.innerWidth())
          && (this.target.$el.outerWidth(true) == this.$canvas.innerWidth())
          && this.source.dot.x == this.target.dot.x) {

        this.setDirection('horizontal')
      }

      // Target and source in the same y coordinates
      else if (this.source.dot.y == this.target.dot.y) {
        this.setDirection('horizontal');
      }

      if ($(window).width() < 769) {
        this.setDirection('horizontal');
      }

      return this;
    },

    setRadius: function(radius) {
      this.radius = radius || Math.abs((this.target.dot.y - this.source.dot.y) / 2);
      return this;
    },

    setDirection: function(direction) {
      this.direction = direction || this.source.direction;
      return this;
    },


    setArc: function() {

      this.setRadius();

      // This gap will act as inner canvas padding for preventing bleeding
      this.gap = 20;
      this.lineX = this.source.line.width || this.line.width;

      switch (this.direction) {

        // Arc to the right
        case 'forward' :
          this.dotX = Math.max(this.target.dot.x, this.source.dot.x) + this.radius;

          // Stop too short
          if (this.dotX < this.source.dot.x + this.source.$el.outerWidth()) {
            this.dotX = this.source.dot.x + this.source.$el.outerWidth() + this.gap;
          }

          // Stop Bleeding
          if(this.dotX > this.$canvas.outerWidth() + this.gap - this.offset.x - this.lineX) {
            this.dotX = this.$canvas.outerWidth() - this.offset.x - this.lineX + this.gap;
          }

          break;

        // Arc to left
        case 'reverse' :
          this.dotX = Math.min(this.source.dot.x, this.target.dot.x) - this.radius;

          // Stop Bleeding
          if (this.dotX < this.offset.x + this.lineX + this.gap) {
            this.dotX = this.lineX + this.offset.x + this.gap;
          }

          break;
      }

      this.arc = {
        one: {
          initial: {
            x: this.source.dot.x,
            y: this.source.dot.y
          },
          start: {
            x: this.dotX,
            y: this.source.dot.y
          },
          end: {
            x: this.dotX,
            y: this.target.dot.y - this.radius
          },
          radius: this.radius
        },
        two: {
          initial: {
            x: this.target.dot.x,
            y: this.target.dot.y
          },
          start: {
            x: this.dotX,
            y: this.target.dot.y
          },
          end: {
            x: this.dotX,
            y: this.target.dot.y - this.radius
          },
          radius: this.radius
        }
      }

      return this;
    },

    clearCanvas: function() {
      this.ctx || this.setCanvas();
      this.ctx.clearRect(0, 0, this.$canvas.width(), this.$canvas.height());
      return this;
    },

    drawDot: function(dot) {
      this.ctx || this.setCanvas();
      this.ctx.beginPath();
      this.ctx.arc(dot.x, dot.y, dot.radius, 0, 2 * Math.PI, false);
      this.ctx.fillStyle = dot.color;
      this.ctx.fill();
      return this;
    },

    drawCurve: function(arc, line) {

      this.ctx || this.setCanvas();
      this.ctx.globalCompositeOperation = 'destination-over';
      this.ctx.beginPath();
      this.ctx.moveTo(arc.initial.x, arc.initial.y);
      this.ctx.lineWidth = line.width;
      this.ctx.lineCap = line.type;
      this.ctx.miterLimit = line.width;
      this.ctx.strokeStyle = line.color;
      this.ctx.arcTo(arc.start.x, arc.start.y, arc.end.x, arc.end.y, arc.radius);
      this.ctx.stroke();
      this.ctx.globalCompositeOperation = 'source-over';

      return this;
    },

    drawLine: function(start, end, line) {
      this.ctx || this.setCanvas();
      this.ctx.globalCompositeOperation = 'destination-over';
      this.ctx.beginPath();
      this.ctx.moveTo(start.x, start.y);
      this.ctx.lineTo(end.x, end.y);
      this.ctx.lineWidth = line.width;
      this.ctx.lineCap = line.height;
      this.ctx.miterLimit = line.width;
      this.ctx.strokeStyle = line.color;
      this.ctx.stroke();
      this.ctx.globalCompositeOperation = 'source-over';

      return this;
    },


    drawConnector: function() {
      this
        .setDirection()
        .checkHorizontal();

      switch(this.direction) {

        // Use simple line for horizontal mode only for simplicity sake
        case 'horizontal' :

          // Draw simple line from source to target
          this.drawLine(this.source.dot, this.target.dot, this.source.line || this.line);

          break;

        default:
          this
            .setArc()

            // Draw the top half of the arc from the source to half of the target
            .drawCurve(this.arc.one, this.source.line || this.line)

            // Draw the bottom half of the arc from the target to half of the source
            .drawCurve(this.arc.two, this.source.line || this.line);

          break;
      }
      return this;
    },

    drawObject: function() {
      var that = this;

      this.$children.each(function(delta, element) {

        var Target = new MemoryLinesDot($(this), that.$el);
        var Source = that.getDot(delta - 1);

        // Draw single dot, the next dot is drawn on next loop
        that
          .addDot(delta, Target.process())
          .drawDot(Target.dot);

        // Draw connector when we got 2 dot points
        Source && that.setSource(Source).setTarget(Target).drawConnector();

        Target = null;
        Source = null;
        delete Target;
        delete Source;
      });

      return this;

    }

  }


  /**
   * jQuery method for calling the object
   * @param options
   * @returns {*}
   */
  $.fn.memoryLineConnect = function(options) {

    return this.each(function() {

      var MemoryLine = $(this),
          Children = MemoryLine.find('.memoryline-content'),
          Canvas = $('<canvas class="memoryline-canvas" />');

      MemoryLine.css('position', 'relative');
      Children.css({zIndex: 3});
      Canvas
        .attr('width', MemoryLine.width())
        .attr('height', MemoryLine.height())
        .css({
          position: 'absolute',
          left:  0,
          top: 0,
          zIndex: 1
        })
        .prependTo(MemoryLine);


      var MemoryLineObject = new MemoryLinesConnector(MemoryLine, Canvas, Children);
      MemoryLineObject.drawObject();

      Canvas.data('memory-line-object', MemoryLineObject);

      delete MemoryLine;
      delete MemoryLineObject;
      delete Canvas;

      MemoryLine = null;
      MemoryLineObject = null;
      Canvas = null;
    });
  };

  if ($('#page').length && $('#page').hasClass('animsition')) {
    $(window)
      .on('animsitionPageIn.memoryline', function() {

        $('.memoryline-canvas').remove();
        $('.memoryline-connector').memoryLineConnect();

        $(window)
          .on('resize.memoryline sortupdate.memoryline', function() {
            $('.memoryline-canvas').remove();
            $('.memoryline-connector').memoryLineConnect();
          });

      });
  }
  else {
    $(window)
      .on('load.memoryline resize.memoryline sortupdate.memoryline', function () {
        $('.memoryline-canvas').remove();
        $('.memoryline-connector').memoryLineConnect();
      });
  }

})(jQuery)
