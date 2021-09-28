(function (factory) {
  typeof define === 'function' && define.amd ? define('custom', factory) :
  factory();
}((function () { 'use strict';

  function _typeof(obj) {
    "@babel/helpers - typeof";

    if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") {
      _typeof = function (obj) {
        return typeof obj;
      };
    } else {
      _typeof = function (obj) {
        return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
      };
    }

    return _typeof(obj);
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
      var descriptor = props[i];
      descriptor.enumerable = descriptor.enumerable || false;
      descriptor.configurable = true;
      if ("value" in descriptor) descriptor.writable = true;
      Object.defineProperty(target, descriptor.key, descriptor);
    }
  }

  function _createClass(Constructor, protoProps, staticProps) {
    if (protoProps) _defineProperties(Constructor.prototype, protoProps);
    if (staticProps) _defineProperties(Constructor, staticProps);
    return Constructor;
  }

  !function (i) {

    "function" == typeof define && define.amd ? define(["jquery"], i) : "undefined" != typeof exports ? module.exports = i(require("jquery")) : i(jQuery);
  }(function (i) {

    var e = window.Slick || {};
    (e = function () {
      var e = 0;
      return function (t, o) {
        var s,
            n = this;
        n.defaults = {
          accessibility: !0,
          adaptiveHeight: !1,
          appendArrows: i(t),
          appendDots: i(t),
          arrows: !0,
          asNavFor: null,
          prevArrow: '<button class="slick-prev" aria-label="Previous" type="button">Previous</button>',
          nextArrow: '<button class="slick-next" aria-label="Next" type="button">Next</button>',
          autoplay: !1,
          autoplaySpeed: 3e3,
          centerMode: !1,
          centerPadding: "50px",
          cssEase: "ease",
          customPaging: function customPaging(e, t) {
            return i('<button type="button" />').text(t + 1);
          },
          dots: !1,
          dotsClass: "slick-dots",
          draggable: !0,
          easing: "linear",
          edgeFriction: .35,
          fade: !1,
          focusOnSelect: !1,
          focusOnChange: !1,
          infinite: !0,
          initialSlide: 0,
          lazyLoad: "ondemand",
          mobileFirst: !1,
          pauseOnHover: !0,
          pauseOnFocus: !0,
          pauseOnDotsHover: !1,
          respondTo: "window",
          responsive: null,
          rows: 1,
          rtl: !1,
          slide: "",
          slidesPerRow: 1,
          slidesToShow: 1,
          slidesToScroll: 1,
          speed: 500,
          swipe: !0,
          swipeToSlide: !1,
          touchMove: !0,
          touchThreshold: 5,
          useCSS: !0,
          useTransform: !0,
          variableWidth: !1,
          vertical: !1,
          verticalSwiping: !1,
          waitForAnimate: !0,
          zIndex: 1e3
        }, n.initials = {
          animating: !1,
          dragging: !1,
          autoPlayTimer: null,
          currentDirection: 0,
          currentLeft: null,
          currentSlide: 0,
          direction: 1,
          $dots: null,
          listWidth: null,
          listHeight: null,
          loadIndex: 0,
          $nextArrow: null,
          $prevArrow: null,
          scrolling: !1,
          slideCount: null,
          slideWidth: null,
          $slideTrack: null,
          $slides: null,
          sliding: !1,
          slideOffset: 0,
          swipeLeft: null,
          swiping: !1,
          $list: null,
          touchObject: {},
          transformsEnabled: !1,
          unslicked: !1
        }, i.extend(n, n.initials), n.activeBreakpoint = null, n.animType = null, n.animProp = null, n.breakpoints = [], n.breakpointSettings = [], n.cssTransitions = !1, n.focussed = !1, n.interrupted = !1, n.hidden = "hidden", n.paused = !0, n.positionProp = null, n.respondTo = null, n.rowCount = 1, n.shouldClick = !0, n.$slider = i(t), n.$slidesCache = null, n.transformType = null, n.transitionType = null, n.visibilityChange = "visibilitychange", n.windowWidth = 0, n.windowTimer = null, s = i(t).data("slick") || {}, n.options = i.extend({}, n.defaults, o, s), n.currentSlide = n.options.initialSlide, n.originalSettings = n.options, void 0 !== document.mozHidden ? (n.hidden = "mozHidden", n.visibilityChange = "mozvisibilitychange") : void 0 !== document.webkitHidden && (n.hidden = "webkitHidden", n.visibilityChange = "webkitvisibilitychange"), n.autoPlay = i.proxy(n.autoPlay, n), n.autoPlayClear = i.proxy(n.autoPlayClear, n), n.autoPlayIterator = i.proxy(n.autoPlayIterator, n), n.changeSlide = i.proxy(n.changeSlide, n), n.clickHandler = i.proxy(n.clickHandler, n), n.selectHandler = i.proxy(n.selectHandler, n), n.setPosition = i.proxy(n.setPosition, n), n.swipeHandler = i.proxy(n.swipeHandler, n), n.dragHandler = i.proxy(n.dragHandler, n), n.keyHandler = i.proxy(n.keyHandler, n), n.instanceUid = e++, n.htmlExpr = /^(?:\s*(<[\w\W]+>)[^>]*)$/, n.registerBreakpoints(), n.init(!0);
      };
    }()).prototype.activateADA = function () {
      this.$slideTrack.find(".slick-active").attr({
        "aria-hidden": "false"
      }).find("a, input, button, select").attr({
        tabindex: "0"
      });
    }, e.prototype.addSlide = e.prototype.slickAdd = function (e, t, o) {
      var s = this;
      if ("boolean" == typeof t) o = t, t = null;else if (t < 0 || t >= s.slideCount) return !1;
      s.unload(), "number" == typeof t ? 0 === t && 0 === s.$slides.length ? i(e).appendTo(s.$slideTrack) : o ? i(e).insertBefore(s.$slides.eq(t)) : i(e).insertAfter(s.$slides.eq(t)) : !0 === o ? i(e).prependTo(s.$slideTrack) : i(e).appendTo(s.$slideTrack), s.$slides = s.$slideTrack.children(this.options.slide), s.$slideTrack.children(this.options.slide).detach(), s.$slideTrack.append(s.$slides), s.$slides.each(function (e, t) {
        i(t).attr("data-slick-index", e);
      }), s.$slidesCache = s.$slides, s.reinit();
    }, e.prototype.animateHeight = function () {
      var i = this;

      if (1 === i.options.slidesToShow && !0 === i.options.adaptiveHeight && !1 === i.options.vertical) {
        var e = i.$slides.eq(i.currentSlide).outerHeight(!0);
        i.$list.animate({
          height: e
        }, i.options.speed);
      }
    }, e.prototype.animateSlide = function (e, t) {
      var o = {},
          s = this;
      s.animateHeight(), !0 === s.options.rtl && !1 === s.options.vertical && (e = -e), !1 === s.transformsEnabled ? !1 === s.options.vertical ? s.$slideTrack.animate({
        left: e
      }, s.options.speed, s.options.easing, t) : s.$slideTrack.animate({
        top: e
      }, s.options.speed, s.options.easing, t) : !1 === s.cssTransitions ? (!0 === s.options.rtl && (s.currentLeft = -s.currentLeft), i({
        animStart: s.currentLeft
      }).animate({
        animStart: e
      }, {
        duration: s.options.speed,
        easing: s.options.easing,
        step: function step(i) {
          i = Math.ceil(i), !1 === s.options.vertical ? (o[s.animType] = "translate(" + i + "px, 0px)", s.$slideTrack.css(o)) : (o[s.animType] = "translate(0px," + i + "px)", s.$slideTrack.css(o));
        },
        complete: function complete() {
          t && t.call();
        }
      })) : (s.applyTransition(), e = Math.ceil(e), !1 === s.options.vertical ? o[s.animType] = "translate3d(" + e + "px, 0px, 0px)" : o[s.animType] = "translate3d(0px," + e + "px, 0px)", s.$slideTrack.css(o), t && setTimeout(function () {
        s.disableTransition(), t.call();
      }, s.options.speed));
    }, e.prototype.getNavTarget = function () {
      var e = this,
          t = e.options.asNavFor;
      return t && null !== t && (t = i(t).not(e.$slider)), t;
    }, e.prototype.asNavFor = function (e) {
      var t = this.getNavTarget();
      null !== t && "object" == _typeof(t) && t.each(function () {
        var t = i(this).slick("getSlick");
        t.unslicked || t.slideHandler(e, !0);
      });
    }, e.prototype.applyTransition = function (i) {
      var e = this,
          t = {};
      !1 === e.options.fade ? t[e.transitionType] = e.transformType + " " + e.options.speed + "ms " + e.options.cssEase : t[e.transitionType] = "opacity " + e.options.speed + "ms " + e.options.cssEase, !1 === e.options.fade ? e.$slideTrack.css(t) : e.$slides.eq(i).css(t);
    }, e.prototype.autoPlay = function () {
      var i = this;
      i.autoPlayClear(), i.slideCount > i.options.slidesToShow && (i.autoPlayTimer = setInterval(i.autoPlayIterator, i.options.autoplaySpeed));
    }, e.prototype.autoPlayClear = function () {
      var i = this;
      i.autoPlayTimer && clearInterval(i.autoPlayTimer);
    }, e.prototype.autoPlayIterator = function () {
      var i = this,
          e = i.currentSlide + i.options.slidesToScroll;
      i.paused || i.interrupted || i.focussed || (!1 === i.options.infinite && (1 === i.direction && i.currentSlide + 1 === i.slideCount - 1 ? i.direction = 0 : 0 === i.direction && (e = i.currentSlide - i.options.slidesToScroll, i.currentSlide - 1 == 0 && (i.direction = 1))), i.slideHandler(e));
    }, e.prototype.buildArrows = function () {
      var e = this;
      !0 === e.options.arrows && (e.$prevArrow = i(e.options.prevArrow).addClass("slick-arrow"), e.$nextArrow = i(e.options.nextArrow).addClass("slick-arrow"), e.slideCount > e.options.slidesToShow ? (e.$prevArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), e.$nextArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), e.htmlExpr.test(e.options.prevArrow) && e.$prevArrow.prependTo(e.options.appendArrows), e.htmlExpr.test(e.options.nextArrow) && e.$nextArrow.appendTo(e.options.appendArrows), !0 !== e.options.infinite && e.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true")) : e.$prevArrow.add(e.$nextArrow).addClass("slick-hidden").attr({
        "aria-disabled": "true",
        tabindex: "-1"
      }));
    }, e.prototype.buildDots = function () {
      var e,
          t,
          o = this;

      if (!0 === o.options.dots) {
        for (o.$slider.addClass("slick-dotted"), t = i("<ul />").addClass(o.options.dotsClass), e = 0; e <= o.getDotCount(); e += 1) {
          t.append(i("<li />").append(o.options.customPaging.call(this, o, e)));
        }

        o.$dots = t.appendTo(o.options.appendDots), o.$dots.find("li").first().addClass("slick-active");
      }
    }, e.prototype.buildOut = function () {
      var e = this;
      e.$slides = e.$slider.children(e.options.slide + ":not(.slick-cloned)").addClass("slick-slide"), e.slideCount = e.$slides.length, e.$slides.each(function (e, t) {
        i(t).attr("data-slick-index", e).data("originalStyling", i(t).attr("style") || "");
      }), e.$slider.addClass("slick-slider"), e.$slideTrack = 0 === e.slideCount ? i('<div class="slick-track"/>').appendTo(e.$slider) : e.$slides.wrapAll('<div class="slick-track"/>').parent(), e.$list = e.$slideTrack.wrap('<div class="slick-list"/>').parent(), e.$slideTrack.css("opacity", 0), !0 !== e.options.centerMode && !0 !== e.options.swipeToSlide || (e.options.slidesToScroll = 1), i("img[data-lazy]", e.$slider).not("[src]").addClass("slick-loading"), e.setupInfinite(), e.buildArrows(), e.buildDots(), e.updateDots(), e.setSlideClasses("number" == typeof e.currentSlide ? e.currentSlide : 0), !0 === e.options.draggable && e.$list.addClass("draggable");
    }, e.prototype.buildRows = function () {
      var i,
          e,
          t,
          o,
          s,
          n,
          r,
          l = this;

      if (o = document.createDocumentFragment(), n = l.$slider.children(), l.options.rows > 1) {
        for (r = l.options.slidesPerRow * l.options.rows, s = Math.ceil(n.length / r), i = 0; i < s; i++) {
          var d = document.createElement("div");

          for (e = 0; e < l.options.rows; e++) {
            var a = document.createElement("div");

            for (t = 0; t < l.options.slidesPerRow; t++) {
              var c = i * r + (e * l.options.slidesPerRow + t);
              n.get(c) && a.appendChild(n.get(c));
            }

            d.appendChild(a);
          }

          o.appendChild(d);
        }

        l.$slider.empty().append(o), l.$slider.children().children().children().css({
          width: 100 / l.options.slidesPerRow + "%",
          display: "inline-block"
        });
      }
    }, e.prototype.checkResponsive = function (e, t) {
      var o,
          s,
          n,
          r = this,
          l = !1,
          d = r.$slider.width(),
          a = window.innerWidth || i(window).width();

      if ("window" === r.respondTo ? n = a : "slider" === r.respondTo ? n = d : "min" === r.respondTo && (n = Math.min(a, d)), r.options.responsive && r.options.responsive.length && null !== r.options.responsive) {
        s = null;

        for (o in r.breakpoints) {
          r.breakpoints.hasOwnProperty(o) && (!1 === r.originalSettings.mobileFirst ? n < r.breakpoints[o] && (s = r.breakpoints[o]) : n > r.breakpoints[o] && (s = r.breakpoints[o]));
        }

        null !== s ? null !== r.activeBreakpoint ? (s !== r.activeBreakpoint || t) && (r.activeBreakpoint = s, "unslick" === r.breakpointSettings[s] ? r.unslick(s) : (r.options = i.extend({}, r.originalSettings, r.breakpointSettings[s]), !0 === e && (r.currentSlide = r.options.initialSlide), r.refresh(e)), l = s) : (r.activeBreakpoint = s, "unslick" === r.breakpointSettings[s] ? r.unslick(s) : (r.options = i.extend({}, r.originalSettings, r.breakpointSettings[s]), !0 === e && (r.currentSlide = r.options.initialSlide), r.refresh(e)), l = s) : null !== r.activeBreakpoint && (r.activeBreakpoint = null, r.options = r.originalSettings, !0 === e && (r.currentSlide = r.options.initialSlide), r.refresh(e), l = s), e || !1 === l || r.$slider.trigger("breakpoint", [r, l]);
      }
    }, e.prototype.changeSlide = function (e, t) {
      var o,
          s,
          n,
          r = this,
          l = i(e.currentTarget);

      switch (l.is("a") && e.preventDefault(), l.is("li") || (l = l.closest("li")), n = r.slideCount % r.options.slidesToScroll != 0, o = n ? 0 : (r.slideCount - r.currentSlide) % r.options.slidesToScroll, e.data.message) {
        case "previous":
          s = 0 === o ? r.options.slidesToScroll : r.options.slidesToShow - o, r.slideCount > r.options.slidesToShow && r.slideHandler(r.currentSlide - s, !1, t);
          break;

        case "next":
          s = 0 === o ? r.options.slidesToScroll : o, r.slideCount > r.options.slidesToShow && r.slideHandler(r.currentSlide + s, !1, t);
          break;

        case "index":
          var d = 0 === e.data.index ? 0 : e.data.index || l.index() * r.options.slidesToScroll;
          r.slideHandler(r.checkNavigable(d), !1, t), l.children().trigger("focus");
          break;

        default:
          return;
      }
    }, e.prototype.checkNavigable = function (i) {
      var e, t;
      if (e = this.getNavigableIndexes(), t = 0, i > e[e.length - 1]) i = e[e.length - 1];else for (var o in e) {
        if (i < e[o]) {
          i = t;
          break;
        }

        t = e[o];
      }
      return i;
    }, e.prototype.cleanUpEvents = function () {
      var e = this;
      e.options.dots && null !== e.$dots && (i("li", e.$dots).off("click.slick", e.changeSlide).off("mouseenter.slick", i.proxy(e.interrupt, e, !0)).off("mouseleave.slick", i.proxy(e.interrupt, e, !1)), !0 === e.options.accessibility && e.$dots.off("keydown.slick", e.keyHandler)), e.$slider.off("focus.slick blur.slick"), !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow && e.$prevArrow.off("click.slick", e.changeSlide), e.$nextArrow && e.$nextArrow.off("click.slick", e.changeSlide), !0 === e.options.accessibility && (e.$prevArrow && e.$prevArrow.off("keydown.slick", e.keyHandler), e.$nextArrow && e.$nextArrow.off("keydown.slick", e.keyHandler))), e.$list.off("touchstart.slick mousedown.slick", e.swipeHandler), e.$list.off("touchmove.slick mousemove.slick", e.swipeHandler), e.$list.off("touchend.slick mouseup.slick", e.swipeHandler), e.$list.off("touchcancel.slick mouseleave.slick", e.swipeHandler), e.$list.off("click.slick", e.clickHandler), i(document).off(e.visibilityChange, e.visibility), e.cleanUpSlideEvents(), !0 === e.options.accessibility && e.$list.off("keydown.slick", e.keyHandler), !0 === e.options.focusOnSelect && i(e.$slideTrack).children().off("click.slick", e.selectHandler), i(window).off("orientationchange.slick.slick-" + e.instanceUid, e.orientationChange), i(window).off("resize.slick.slick-" + e.instanceUid, e.resize), i("[draggable!=true]", e.$slideTrack).off("dragstart", e.preventDefault), i(window).off("load.slick.slick-" + e.instanceUid, e.setPosition);
    }, e.prototype.cleanUpSlideEvents = function () {
      var e = this;
      e.$list.off("mouseenter.slick", i.proxy(e.interrupt, e, !0)), e.$list.off("mouseleave.slick", i.proxy(e.interrupt, e, !1));
    }, e.prototype.cleanUpRows = function () {
      var i,
          e = this;
      e.options.rows > 1 && ((i = e.$slides.children().children()).removeAttr("style"), e.$slider.empty().append(i));
    }, e.prototype.clickHandler = function (i) {
      !1 === this.shouldClick && (i.stopImmediatePropagation(), i.stopPropagation(), i.preventDefault());
    }, e.prototype.destroy = function (e) {
      var t = this;
      t.autoPlayClear(), t.touchObject = {}, t.cleanUpEvents(), i(".slick-cloned", t.$slider).detach(), t.$dots && t.$dots.remove(), t.$prevArrow && t.$prevArrow.length && (t.$prevArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), t.htmlExpr.test(t.options.prevArrow) && t.$prevArrow.remove()), t.$nextArrow && t.$nextArrow.length && (t.$nextArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), t.htmlExpr.test(t.options.nextArrow) && t.$nextArrow.remove()), t.$slides && (t.$slides.removeClass("slick-slide slick-active slick-center slick-visible slick-current").removeAttr("aria-hidden").removeAttr("data-slick-index").each(function () {
        i(this).attr("style", i(this).data("originalStyling"));
      }), t.$slideTrack.children(this.options.slide).detach(), t.$slideTrack.detach(), t.$list.detach(), t.$slider.append(t.$slides)), t.cleanUpRows(), t.$slider.removeClass("slick-slider"), t.$slider.removeClass("slick-initialized"), t.$slider.removeClass("slick-dotted"), t.unslicked = !0, e || t.$slider.trigger("destroy", [t]);
    }, e.prototype.disableTransition = function (i) {
      var e = this,
          t = {};
      t[e.transitionType] = "", !1 === e.options.fade ? e.$slideTrack.css(t) : e.$slides.eq(i).css(t);
    }, e.prototype.fadeSlide = function (i, e) {
      var t = this;
      !1 === t.cssTransitions ? (t.$slides.eq(i).css({
        zIndex: t.options.zIndex
      }), t.$slides.eq(i).animate({
        opacity: 1
      }, t.options.speed, t.options.easing, e)) : (t.applyTransition(i), t.$slides.eq(i).css({
        opacity: 1,
        zIndex: t.options.zIndex
      }), e && setTimeout(function () {
        t.disableTransition(i), e.call();
      }, t.options.speed));
    }, e.prototype.fadeSlideOut = function (i) {
      var e = this;
      !1 === e.cssTransitions ? e.$slides.eq(i).animate({
        opacity: 0,
        zIndex: e.options.zIndex - 2
      }, e.options.speed, e.options.easing) : (e.applyTransition(i), e.$slides.eq(i).css({
        opacity: 0,
        zIndex: e.options.zIndex - 2
      }));
    }, e.prototype.filterSlides = e.prototype.slickFilter = function (i) {
      var e = this;
      null !== i && (e.$slidesCache = e.$slides, e.unload(), e.$slideTrack.children(this.options.slide).detach(), e.$slidesCache.filter(i).appendTo(e.$slideTrack), e.reinit());
    }, e.prototype.focusHandler = function () {
      var e = this;
      e.$slider.off("focus.slick blur.slick").on("focus.slick blur.slick", "*", function (t) {
        t.stopImmediatePropagation();
        var o = i(this);
        setTimeout(function () {
          e.options.pauseOnFocus && (e.focussed = o.is(":focus"), e.autoPlay());
        }, 0);
      });
    }, e.prototype.getCurrent = e.prototype.slickCurrentSlide = function () {
      return this.currentSlide;
    }, e.prototype.getDotCount = function () {
      var i = this,
          e = 0,
          t = 0,
          o = 0;
      if (!0 === i.options.infinite) {
        if (i.slideCount <= i.options.slidesToShow) ++o;else for (; e < i.slideCount;) {
          ++o, e = t + i.options.slidesToScroll, t += i.options.slidesToScroll <= i.options.slidesToShow ? i.options.slidesToScroll : i.options.slidesToShow;
        }
      } else if (!0 === i.options.centerMode) o = i.slideCount;else if (i.options.asNavFor) for (; e < i.slideCount;) {
        ++o, e = t + i.options.slidesToScroll, t += i.options.slidesToScroll <= i.options.slidesToShow ? i.options.slidesToScroll : i.options.slidesToShow;
      } else o = 1 + Math.ceil((i.slideCount - i.options.slidesToShow) / i.options.slidesToScroll);
      return o - 1;
    }, e.prototype.getLeft = function (i) {
      var e,
          t,
          o,
          s,
          n = this,
          r = 0;
      return n.slideOffset = 0, t = n.$slides.first().outerHeight(!0), !0 === n.options.infinite ? (n.slideCount > n.options.slidesToShow && (n.slideOffset = n.slideWidth * n.options.slidesToShow * -1, s = -1, !0 === n.options.vertical && !0 === n.options.centerMode && (2 === n.options.slidesToShow ? s = -1.5 : 1 === n.options.slidesToShow && (s = -2)), r = t * n.options.slidesToShow * s), n.slideCount % n.options.slidesToScroll != 0 && i + n.options.slidesToScroll > n.slideCount && n.slideCount > n.options.slidesToShow && (i > n.slideCount ? (n.slideOffset = (n.options.slidesToShow - (i - n.slideCount)) * n.slideWidth * -1, r = (n.options.slidesToShow - (i - n.slideCount)) * t * -1) : (n.slideOffset = n.slideCount % n.options.slidesToScroll * n.slideWidth * -1, r = n.slideCount % n.options.slidesToScroll * t * -1))) : i + n.options.slidesToShow > n.slideCount && (n.slideOffset = (i + n.options.slidesToShow - n.slideCount) * n.slideWidth, r = (i + n.options.slidesToShow - n.slideCount) * t), n.slideCount <= n.options.slidesToShow && (n.slideOffset = 0, r = 0), !0 === n.options.centerMode && n.slideCount <= n.options.slidesToShow ? n.slideOffset = n.slideWidth * Math.floor(n.options.slidesToShow) / 2 - n.slideWidth * n.slideCount / 2 : !0 === n.options.centerMode && !0 === n.options.infinite ? n.slideOffset += n.slideWidth * Math.floor(n.options.slidesToShow / 2) - n.slideWidth : !0 === n.options.centerMode && (n.slideOffset = 0, n.slideOffset += n.slideWidth * Math.floor(n.options.slidesToShow / 2)), e = !1 === n.options.vertical ? i * n.slideWidth * -1 + n.slideOffset : i * t * -1 + r, !0 === n.options.variableWidth && (o = n.slideCount <= n.options.slidesToShow || !1 === n.options.infinite ? n.$slideTrack.children(".slick-slide").eq(i) : n.$slideTrack.children(".slick-slide").eq(i + n.options.slidesToShow), e = !0 === n.options.rtl ? o[0] ? -1 * (n.$slideTrack.width() - o[0].offsetLeft - o.width()) : 0 : o[0] ? -1 * o[0].offsetLeft : 0, !0 === n.options.centerMode && (o = n.slideCount <= n.options.slidesToShow || !1 === n.options.infinite ? n.$slideTrack.children(".slick-slide").eq(i) : n.$slideTrack.children(".slick-slide").eq(i + n.options.slidesToShow + 1), e = !0 === n.options.rtl ? o[0] ? -1 * (n.$slideTrack.width() - o[0].offsetLeft - o.width()) : 0 : o[0] ? -1 * o[0].offsetLeft : 0, e += (n.$list.width() - o.outerWidth()) / 2)), e;
    }, e.prototype.getOption = e.prototype.slickGetOption = function (i) {
      return this.options[i];
    }, e.prototype.getNavigableIndexes = function () {
      var i,
          e = this,
          t = 0,
          o = 0,
          s = [];

      for (!1 === e.options.infinite ? i = e.slideCount : (t = -1 * e.options.slidesToScroll, o = -1 * e.options.slidesToScroll, i = 2 * e.slideCount); t < i;) {
        s.push(t), t = o + e.options.slidesToScroll, o += e.options.slidesToScroll <= e.options.slidesToShow ? e.options.slidesToScroll : e.options.slidesToShow;
      }

      return s;
    }, e.prototype.getSlick = function () {
      return this;
    }, e.prototype.getSlideCount = function () {
      var e,
          t,
          o = this;
      return t = !0 === o.options.centerMode ? o.slideWidth * Math.floor(o.options.slidesToShow / 2) : 0, !0 === o.options.swipeToSlide ? (o.$slideTrack.find(".slick-slide").each(function (s, n) {
        if (n.offsetLeft - t + i(n).outerWidth() / 2 > -1 * o.swipeLeft) return e = n, !1;
      }), Math.abs(i(e).attr("data-slick-index") - o.currentSlide) || 1) : o.options.slidesToScroll;
    }, e.prototype.goTo = e.prototype.slickGoTo = function (i, e) {
      this.changeSlide({
        data: {
          message: "index",
          index: parseInt(i)
        }
      }, e);
    }, e.prototype.init = function (e) {
      var t = this;
      i(t.$slider).hasClass("slick-initialized") || (i(t.$slider).addClass("slick-initialized"), t.buildRows(), t.buildOut(), t.setProps(), t.startLoad(), t.loadSlider(), t.initializeEvents(), t.updateArrows(), t.updateDots(), t.checkResponsive(!0), t.focusHandler()), e && t.$slider.trigger("init", [t]), !0 === t.options.accessibility && t.initADA(), t.options.autoplay && (t.paused = !1, t.autoPlay());
    }, e.prototype.initADA = function () {
      var e = this,
          t = Math.ceil(e.slideCount / e.options.slidesToShow),
          o = e.getNavigableIndexes().filter(function (i) {
        return i >= 0 && i < e.slideCount;
      });
      e.$slides.add(e.$slideTrack.find(".slick-cloned")).attr({
        "aria-hidden": "true",
        tabindex: "-1"
      }).find("a, input, button, select").attr({
        tabindex: "-1"
      }), null !== e.$dots && (e.$slides.not(e.$slideTrack.find(".slick-cloned")).each(function (t) {
        var s = o.indexOf(t);
        i(this).attr({
          role: "tabpanel",
          id: "slick-slide" + e.instanceUid + t,
          tabindex: -1
        }), -1 !== s && i(this).attr({
          "aria-describedby": "slick-slide-control" + e.instanceUid + s
        });
      }), e.$dots.attr("role", "tablist").find("li").each(function (s) {
        var n = o[s];
        i(this).attr({
          role: "presentation"
        }), i(this).find("button").first().attr({
          role: "tab",
          id: "slick-slide-control" + e.instanceUid + s,
          "aria-controls": "slick-slide" + e.instanceUid + n,
          "aria-label": s + 1 + " of " + t,
          "aria-selected": null,
          tabindex: "-1"
        });
      }).eq(e.currentSlide).find("button").attr({
        "aria-selected": "true",
        tabindex: "0"
      }).end());

      for (var s = e.currentSlide, n = s + e.options.slidesToShow; s < n; s++) {
        e.$slides.eq(s).attr("tabindex", 0);
      }

      e.activateADA();
    }, e.prototype.initArrowEvents = function () {
      var i = this;
      !0 === i.options.arrows && i.slideCount > i.options.slidesToShow && (i.$prevArrow.off("click.slick").on("click.slick", {
        message: "previous"
      }, i.changeSlide), i.$nextArrow.off("click.slick").on("click.slick", {
        message: "next"
      }, i.changeSlide), !0 === i.options.accessibility && (i.$prevArrow.on("keydown.slick", i.keyHandler), i.$nextArrow.on("keydown.slick", i.keyHandler)));
    }, e.prototype.initDotEvents = function () {
      var e = this;
      !0 === e.options.dots && (i("li", e.$dots).on("click.slick", {
        message: "index"
      }, e.changeSlide), !0 === e.options.accessibility && e.$dots.on("keydown.slick", e.keyHandler)), !0 === e.options.dots && !0 === e.options.pauseOnDotsHover && i("li", e.$dots).on("mouseenter.slick", i.proxy(e.interrupt, e, !0)).on("mouseleave.slick", i.proxy(e.interrupt, e, !1));
    }, e.prototype.initSlideEvents = function () {
      var e = this;
      e.options.pauseOnHover && (e.$list.on("mouseenter.slick", i.proxy(e.interrupt, e, !0)), e.$list.on("mouseleave.slick", i.proxy(e.interrupt, e, !1)));
    }, e.prototype.initializeEvents = function () {
      var e = this;
      e.initArrowEvents(), e.initDotEvents(), e.initSlideEvents(), e.$list.on("touchstart.slick mousedown.slick", {
        action: "start"
      }, e.swipeHandler), e.$list.on("touchmove.slick mousemove.slick", {
        action: "move"
      }, e.swipeHandler), e.$list.on("touchend.slick mouseup.slick", {
        action: "end"
      }, e.swipeHandler), e.$list.on("touchcancel.slick mouseleave.slick", {
        action: "end"
      }, e.swipeHandler), e.$list.on("click.slick", e.clickHandler), i(document).on(e.visibilityChange, i.proxy(e.visibility, e)), !0 === e.options.accessibility && e.$list.on("keydown.slick", e.keyHandler), !0 === e.options.focusOnSelect && i(e.$slideTrack).children().on("click.slick", e.selectHandler), i(window).on("orientationchange.slick.slick-" + e.instanceUid, i.proxy(e.orientationChange, e)), i(window).on("resize.slick.slick-" + e.instanceUid, i.proxy(e.resize, e)), i("[draggable!=true]", e.$slideTrack).on("dragstart", e.preventDefault), i(window).on("load.slick.slick-" + e.instanceUid, e.setPosition), i(e.setPosition);
    }, e.prototype.initUI = function () {
      var i = this;
      !0 === i.options.arrows && i.slideCount > i.options.slidesToShow && (i.$prevArrow.show(), i.$nextArrow.show()), !0 === i.options.dots && i.slideCount > i.options.slidesToShow && i.$dots.show();
    }, e.prototype.keyHandler = function (i) {
      var e = this;
      i.target.tagName.match("TEXTAREA|INPUT|SELECT") || (37 === i.keyCode && !0 === e.options.accessibility ? e.changeSlide({
        data: {
          message: !0 === e.options.rtl ? "next" : "previous"
        }
      }) : 39 === i.keyCode && !0 === e.options.accessibility && e.changeSlide({
        data: {
          message: !0 === e.options.rtl ? "previous" : "next"
        }
      }));
    }, e.prototype.lazyLoad = function () {
      function e(e) {
        i("img[data-lazy]", e).each(function () {
          var e = i(this),
              t = i(this).attr("data-lazy"),
              o = i(this).attr("data-srcset"),
              s = i(this).attr("data-sizes") || n.$slider.attr("data-sizes"),
              r = document.createElement("img");
          r.onload = function () {
            e.animate({
              opacity: 0
            }, 100, function () {
              o && (e.attr("srcset", o), s && e.attr("sizes", s)), e.attr("src", t).animate({
                opacity: 1
              }, 200, function () {
                e.removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading");
              }), n.$slider.trigger("lazyLoaded", [n, e, t]);
            });
          }, r.onerror = function () {
            e.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"), n.$slider.trigger("lazyLoadError", [n, e, t]);
          }, r.src = t;
        });
      }

      var t,
          o,
          s,
          n = this;
      if (!0 === n.options.centerMode ? !0 === n.options.infinite ? s = (o = n.currentSlide + (n.options.slidesToShow / 2 + 1)) + n.options.slidesToShow + 2 : (o = Math.max(0, n.currentSlide - (n.options.slidesToShow / 2 + 1)), s = n.options.slidesToShow / 2 + 1 + 2 + n.currentSlide) : (o = n.options.infinite ? n.options.slidesToShow + n.currentSlide : n.currentSlide, s = Math.ceil(o + n.options.slidesToShow), !0 === n.options.fade && (o > 0 && o--, s <= n.slideCount && s++)), t = n.$slider.find(".slick-slide").slice(o, s), "anticipated" === n.options.lazyLoad) for (var r = o - 1, l = s, d = n.$slider.find(".slick-slide"), a = 0; a < n.options.slidesToScroll; a++) {
        r < 0 && (r = n.slideCount - 1), t = (t = t.add(d.eq(r))).add(d.eq(l)), r--, l++;
      }
      e(t), n.slideCount <= n.options.slidesToShow ? e(n.$slider.find(".slick-slide")) : n.currentSlide >= n.slideCount - n.options.slidesToShow ? e(n.$slider.find(".slick-cloned").slice(0, n.options.slidesToShow)) : 0 === n.currentSlide && e(n.$slider.find(".slick-cloned").slice(-1 * n.options.slidesToShow));
    }, e.prototype.loadSlider = function () {
      var i = this;
      i.setPosition(), i.$slideTrack.css({
        opacity: 1
      }), i.$slider.removeClass("slick-loading"), i.initUI(), "progressive" === i.options.lazyLoad && i.progressiveLazyLoad();
    }, e.prototype.next = e.prototype.slickNext = function () {
      this.changeSlide({
        data: {
          message: "next"
        }
      });
    }, e.prototype.orientationChange = function () {
      var i = this;
      i.checkResponsive(), i.setPosition();
    }, e.prototype.pause = e.prototype.slickPause = function () {
      var i = this;
      i.autoPlayClear(), i.paused = !0;
    }, e.prototype.play = e.prototype.slickPlay = function () {
      var i = this;
      i.autoPlay(), i.options.autoplay = !0, i.paused = !1, i.focussed = !1, i.interrupted = !1;
    }, e.prototype.postSlide = function (e) {
      var t = this;
      t.unslicked || (t.$slider.trigger("afterChange", [t, e]), t.animating = !1, t.slideCount > t.options.slidesToShow && t.setPosition(), t.swipeLeft = null, t.options.autoplay && t.autoPlay(), !0 === t.options.accessibility && (t.initADA(), t.options.focusOnChange && i(t.$slides.get(t.currentSlide)).attr("tabindex", 0).focus()));
    }, e.prototype.prev = e.prototype.slickPrev = function () {
      this.changeSlide({
        data: {
          message: "previous"
        }
      });
    }, e.prototype.preventDefault = function (i) {
      i.preventDefault();
    }, e.prototype.progressiveLazyLoad = function (e) {
      e = e || 1;
      var t,
          o,
          s,
          n,
          r,
          l = this,
          d = i("img[data-lazy]", l.$slider);
      d.length ? (t = d.first(), o = t.attr("data-lazy"), s = t.attr("data-srcset"), n = t.attr("data-sizes") || l.$slider.attr("data-sizes"), (r = document.createElement("img")).onload = function () {
        s && (t.attr("srcset", s), n && t.attr("sizes", n)), t.attr("src", o).removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading"), !0 === l.options.adaptiveHeight && l.setPosition(), l.$slider.trigger("lazyLoaded", [l, t, o]), l.progressiveLazyLoad();
      }, r.onerror = function () {
        e < 3 ? setTimeout(function () {
          l.progressiveLazyLoad(e + 1);
        }, 500) : (t.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"), l.$slider.trigger("lazyLoadError", [l, t, o]), l.progressiveLazyLoad());
      }, r.src = o) : l.$slider.trigger("allImagesLoaded", [l]);
    }, e.prototype.refresh = function (e) {
      var t,
          o,
          s = this;
      o = s.slideCount - s.options.slidesToShow, !s.options.infinite && s.currentSlide > o && (s.currentSlide = o), s.slideCount <= s.options.slidesToShow && (s.currentSlide = 0), t = s.currentSlide, s.destroy(!0), i.extend(s, s.initials, {
        currentSlide: t
      }), s.init(), e || s.changeSlide({
        data: {
          message: "index",
          index: t
        }
      }, !1);
    }, e.prototype.registerBreakpoints = function () {
      var e,
          t,
          o,
          s = this,
          n = s.options.responsive || null;

      if ("array" === i.type(n) && n.length) {
        s.respondTo = s.options.respondTo || "window";

        for (e in n) {
          if (o = s.breakpoints.length - 1, n.hasOwnProperty(e)) {
            for (t = n[e].breakpoint; o >= 0;) {
              s.breakpoints[o] && s.breakpoints[o] === t && s.breakpoints.splice(o, 1), o--;
            }

            s.breakpoints.push(t), s.breakpointSettings[t] = n[e].settings;
          }
        }

        s.breakpoints.sort(function (i, e) {
          return s.options.mobileFirst ? i - e : e - i;
        });
      }
    }, e.prototype.reinit = function () {
      var e = this;
      e.$slides = e.$slideTrack.children(e.options.slide).addClass("slick-slide"), e.slideCount = e.$slides.length, e.currentSlide >= e.slideCount && 0 !== e.currentSlide && (e.currentSlide = e.currentSlide - e.options.slidesToScroll), e.slideCount <= e.options.slidesToShow && (e.currentSlide = 0), e.registerBreakpoints(), e.setProps(), e.setupInfinite(), e.buildArrows(), e.updateArrows(), e.initArrowEvents(), e.buildDots(), e.updateDots(), e.initDotEvents(), e.cleanUpSlideEvents(), e.initSlideEvents(), e.checkResponsive(!1, !0), !0 === e.options.focusOnSelect && i(e.$slideTrack).children().on("click.slick", e.selectHandler), e.setSlideClasses("number" == typeof e.currentSlide ? e.currentSlide : 0), e.setPosition(), e.focusHandler(), e.paused = !e.options.autoplay, e.autoPlay(), e.$slider.trigger("reInit", [e]);
    }, e.prototype.resize = function () {
      var e = this;
      i(window).width() !== e.windowWidth && (clearTimeout(e.windowDelay), e.windowDelay = window.setTimeout(function () {
        e.windowWidth = i(window).width(), e.checkResponsive(), e.unslicked || e.setPosition();
      }, 50));
    }, e.prototype.removeSlide = e.prototype.slickRemove = function (i, e, t) {
      var o = this;
      if (i = "boolean" == typeof i ? !0 === (e = i) ? 0 : o.slideCount - 1 : !0 === e ? --i : i, o.slideCount < 1 || i < 0 || i > o.slideCount - 1) return !1;
      o.unload(), !0 === t ? o.$slideTrack.children().remove() : o.$slideTrack.children(this.options.slide).eq(i).remove(), o.$slides = o.$slideTrack.children(this.options.slide), o.$slideTrack.children(this.options.slide).detach(), o.$slideTrack.append(o.$slides), o.$slidesCache = o.$slides, o.reinit();
    }, e.prototype.setCSS = function (i) {
      var e,
          t,
          o = this,
          s = {};
      !0 === o.options.rtl && (i = -i), e = "left" == o.positionProp ? Math.ceil(i) + "px" : "0px", t = "top" == o.positionProp ? Math.ceil(i) + "px" : "0px", s[o.positionProp] = i, !1 === o.transformsEnabled ? o.$slideTrack.css(s) : (s = {}, !1 === o.cssTransitions ? (s[o.animType] = "translate(" + e + ", " + t + ")", o.$slideTrack.css(s)) : (s[o.animType] = "translate3d(" + e + ", " + t + ", 0px)", o.$slideTrack.css(s)));
    }, e.prototype.setDimensions = function () {
      var i = this;
      !1 === i.options.vertical ? !0 === i.options.centerMode && i.$list.css({
        padding: "0px " + i.options.centerPadding
      }) : (i.$list.height(i.$slides.first().outerHeight(!0) * i.options.slidesToShow), !0 === i.options.centerMode && i.$list.css({
        padding: i.options.centerPadding + " 0px"
      })), i.listWidth = i.$list.width(), i.listHeight = i.$list.height(), !1 === i.options.vertical && !1 === i.options.variableWidth ? (i.slideWidth = Math.ceil(i.listWidth / i.options.slidesToShow), i.$slideTrack.width(Math.ceil(i.slideWidth * i.$slideTrack.children(".slick-slide").length))) : !0 === i.options.variableWidth ? i.$slideTrack.width(5e3 * i.slideCount) : (i.slideWidth = Math.ceil(i.listWidth), i.$slideTrack.height(Math.ceil(i.$slides.first().outerHeight(!0) * i.$slideTrack.children(".slick-slide").length)));
      var e = i.$slides.first().outerWidth(!0) - i.$slides.first().width();
      !1 === i.options.variableWidth && i.$slideTrack.children(".slick-slide").width(i.slideWidth - e);
    }, e.prototype.setFade = function () {
      var e,
          t = this;
      t.$slides.each(function (o, s) {
        e = t.slideWidth * o * -1, !0 === t.options.rtl ? i(s).css({
          position: "relative",
          right: e,
          top: 0,
          zIndex: t.options.zIndex - 2,
          opacity: 0
        }) : i(s).css({
          position: "relative",
          left: e,
          top: 0,
          zIndex: t.options.zIndex - 2,
          opacity: 0
        });
      }), t.$slides.eq(t.currentSlide).css({
        zIndex: t.options.zIndex - 1,
        opacity: 1
      });
    }, e.prototype.setHeight = function () {
      var i = this;

      if (1 === i.options.slidesToShow && !0 === i.options.adaptiveHeight && !1 === i.options.vertical) {
        var e = i.$slides.eq(i.currentSlide).outerHeight(!0);
        i.$list.css("height", e);
      }
    }, e.prototype.setOption = e.prototype.slickSetOption = function () {
      var e,
          t,
          o,
          s,
          n,
          r = this,
          l = !1;
      if ("object" === i.type(arguments[0]) ? (o = arguments[0], l = arguments[1], n = "multiple") : "string" === i.type(arguments[0]) && (o = arguments[0], s = arguments[1], l = arguments[2], "responsive" === arguments[0] && "array" === i.type(arguments[1]) ? n = "responsive" : void 0 !== arguments[1] && (n = "single")), "single" === n) r.options[o] = s;else if ("multiple" === n) i.each(o, function (i, e) {
        r.options[i] = e;
      });else if ("responsive" === n) for (t in s) {
        if ("array" !== i.type(r.options.responsive)) r.options.responsive = [s[t]];else {
          for (e = r.options.responsive.length - 1; e >= 0;) {
            r.options.responsive[e].breakpoint === s[t].breakpoint && r.options.responsive.splice(e, 1), e--;
          }

          r.options.responsive.push(s[t]);
        }
      }
      l && (r.unload(), r.reinit());
    }, e.prototype.setPosition = function () {
      var i = this;
      i.setDimensions(), i.setHeight(), !1 === i.options.fade ? i.setCSS(i.getLeft(i.currentSlide)) : i.setFade(), i.$slider.trigger("setPosition", [i]);
    }, e.prototype.setProps = function () {
      var i = this,
          e = document.body.style;
      i.positionProp = !0 === i.options.vertical ? "top" : "left", "top" === i.positionProp ? i.$slider.addClass("slick-vertical") : i.$slider.removeClass("slick-vertical"), void 0 === e.WebkitTransition && void 0 === e.MozTransition && void 0 === e.msTransition || !0 === i.options.useCSS && (i.cssTransitions = !0), i.options.fade && ("number" == typeof i.options.zIndex ? i.options.zIndex < 3 && (i.options.zIndex = 3) : i.options.zIndex = i.defaults.zIndex), void 0 !== e.OTransform && (i.animType = "OTransform", i.transformType = "-o-transform", i.transitionType = "OTransition", void 0 === e.perspectiveProperty && void 0 === e.webkitPerspective && (i.animType = !1)), void 0 !== e.MozTransform && (i.animType = "MozTransform", i.transformType = "-moz-transform", i.transitionType = "MozTransition", void 0 === e.perspectiveProperty && void 0 === e.MozPerspective && (i.animType = !1)), void 0 !== e.webkitTransform && (i.animType = "webkitTransform", i.transformType = "-webkit-transform", i.transitionType = "webkitTransition", void 0 === e.perspectiveProperty && void 0 === e.webkitPerspective && (i.animType = !1)), void 0 !== e.msTransform && (i.animType = "msTransform", i.transformType = "-ms-transform", i.transitionType = "msTransition", void 0 === e.msTransform && (i.animType = !1)), void 0 !== e.transform && !1 !== i.animType && (i.animType = "transform", i.transformType = "transform", i.transitionType = "transition"), i.transformsEnabled = i.options.useTransform && null !== i.animType && !1 !== i.animType;
    }, e.prototype.setSlideClasses = function (i) {
      var e,
          t,
          o,
          s,
          n = this;

      if (t = n.$slider.find(".slick-slide").removeClass("slick-active slick-center slick-current").attr("aria-hidden", "true"), n.$slides.eq(i).addClass("slick-current"), !0 === n.options.centerMode) {
        var r = n.options.slidesToShow % 2 == 0 ? 1 : 0;
        e = Math.floor(n.options.slidesToShow / 2), !0 === n.options.infinite && (i >= e && i <= n.slideCount - 1 - e ? n.$slides.slice(i - e + r, i + e + 1).addClass("slick-active").attr("aria-hidden", "false") : (o = n.options.slidesToShow + i, t.slice(o - e + 1 + r, o + e + 2).addClass("slick-active").attr("aria-hidden", "false")), 0 === i ? t.eq(t.length - 1 - n.options.slidesToShow).addClass("slick-center") : i === n.slideCount - 1 && t.eq(n.options.slidesToShow).addClass("slick-center")), n.$slides.eq(i).addClass("slick-center");
      } else i >= 0 && i <= n.slideCount - n.options.slidesToShow ? n.$slides.slice(i, i + n.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false") : t.length <= n.options.slidesToShow ? t.addClass("slick-active").attr("aria-hidden", "false") : (s = n.slideCount % n.options.slidesToShow, o = !0 === n.options.infinite ? n.options.slidesToShow + i : i, n.options.slidesToShow == n.options.slidesToScroll && n.slideCount - i < n.options.slidesToShow ? t.slice(o - (n.options.slidesToShow - s), o + s).addClass("slick-active").attr("aria-hidden", "false") : t.slice(o, o + n.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false"));

      "ondemand" !== n.options.lazyLoad && "anticipated" !== n.options.lazyLoad || n.lazyLoad();
    }, e.prototype.setupInfinite = function () {
      var e,
          t,
          o,
          s = this;

      if (!0 === s.options.fade && (s.options.centerMode = !1), !0 === s.options.infinite && !1 === s.options.fade && (t = null, s.slideCount > s.options.slidesToShow)) {
        for (o = !0 === s.options.centerMode ? s.options.slidesToShow + 1 : s.options.slidesToShow, e = s.slideCount; e > s.slideCount - o; e -= 1) {
          t = e - 1, i(s.$slides[t]).clone(!0).attr("id", "").attr("data-slick-index", t - s.slideCount).prependTo(s.$slideTrack).addClass("slick-cloned");
        }

        for (e = 0; e < o + s.slideCount; e += 1) {
          t = e, i(s.$slides[t]).clone(!0).attr("id", "").attr("data-slick-index", t + s.slideCount).appendTo(s.$slideTrack).addClass("slick-cloned");
        }

        s.$slideTrack.find(".slick-cloned").find("[id]").each(function () {
          i(this).attr("id", "");
        });
      }
    }, e.prototype.interrupt = function (i) {
      var e = this;
      i || e.autoPlay(), e.interrupted = i;
    }, e.prototype.selectHandler = function (e) {
      var t = this,
          o = i(e.target).is(".slick-slide") ? i(e.target) : i(e.target).parents(".slick-slide"),
          s = parseInt(o.attr("data-slick-index"));
      s || (s = 0), t.slideCount <= t.options.slidesToShow ? t.slideHandler(s, !1, !0) : t.slideHandler(s);
    }, e.prototype.slideHandler = function (i, e, t) {
      var o,
          s,
          n,
          r,
          l,
          d = null,
          a = this;
      if (e = e || !1, !(!0 === a.animating && !0 === a.options.waitForAnimate || !0 === a.options.fade && a.currentSlide === i)) if (!1 === e && a.asNavFor(i), o = i, d = a.getLeft(o), r = a.getLeft(a.currentSlide), a.currentLeft = null === a.swipeLeft ? r : a.swipeLeft, !1 === a.options.infinite && !1 === a.options.centerMode && (i < 0 || i > a.getDotCount() * a.options.slidesToScroll)) !1 === a.options.fade && (o = a.currentSlide, !0 !== t ? a.animateSlide(r, function () {
        a.postSlide(o);
      }) : a.postSlide(o));else if (!1 === a.options.infinite && !0 === a.options.centerMode && (i < 0 || i > a.slideCount - a.options.slidesToScroll)) !1 === a.options.fade && (o = a.currentSlide, !0 !== t ? a.animateSlide(r, function () {
        a.postSlide(o);
      }) : a.postSlide(o));else {
        if (a.options.autoplay && clearInterval(a.autoPlayTimer), s = o < 0 ? a.slideCount % a.options.slidesToScroll != 0 ? a.slideCount - a.slideCount % a.options.slidesToScroll : a.slideCount + o : o >= a.slideCount ? a.slideCount % a.options.slidesToScroll != 0 ? 0 : o - a.slideCount : o, a.animating = !0, a.$slider.trigger("beforeChange", [a, a.currentSlide, s]), n = a.currentSlide, a.currentSlide = s, a.setSlideClasses(a.currentSlide), a.options.asNavFor && (l = (l = a.getNavTarget()).slick("getSlick")).slideCount <= l.options.slidesToShow && l.setSlideClasses(a.currentSlide), a.updateDots(), a.updateArrows(), !0 === a.options.fade) return !0 !== t ? (a.fadeSlideOut(n), a.fadeSlide(s, function () {
          a.postSlide(s);
        })) : a.postSlide(s), void a.animateHeight();
        !0 !== t ? a.animateSlide(d, function () {
          a.postSlide(s);
        }) : a.postSlide(s);
      }
    }, e.prototype.startLoad = function () {
      var i = this;
      !0 === i.options.arrows && i.slideCount > i.options.slidesToShow && (i.$prevArrow.hide(), i.$nextArrow.hide()), !0 === i.options.dots && i.slideCount > i.options.slidesToShow && i.$dots.hide(), i.$slider.addClass("slick-loading");
    }, e.prototype.swipeDirection = function () {
      var i,
          e,
          t,
          o,
          s = this;
      return i = s.touchObject.startX - s.touchObject.curX, e = s.touchObject.startY - s.touchObject.curY, t = Math.atan2(e, i), (o = Math.round(180 * t / Math.PI)) < 0 && (o = 360 - Math.abs(o)), o <= 45 && o >= 0 ? !1 === s.options.rtl ? "left" : "right" : o <= 360 && o >= 315 ? !1 === s.options.rtl ? "left" : "right" : o >= 135 && o <= 225 ? !1 === s.options.rtl ? "right" : "left" : !0 === s.options.verticalSwiping ? o >= 35 && o <= 135 ? "down" : "up" : "vertical";
    }, e.prototype.swipeEnd = function (i) {
      var e,
          t,
          o = this;
      if (o.dragging = !1, o.swiping = !1, o.scrolling) return o.scrolling = !1, !1;
      if (o.interrupted = !1, o.shouldClick = !(o.touchObject.swipeLength > 10), void 0 === o.touchObject.curX) return !1;

      if (!0 === o.touchObject.edgeHit && o.$slider.trigger("edge", [o, o.swipeDirection()]), o.touchObject.swipeLength >= o.touchObject.minSwipe) {
        switch (t = o.swipeDirection()) {
          case "left":
          case "down":
            e = o.options.swipeToSlide ? o.checkNavigable(o.currentSlide + o.getSlideCount()) : o.currentSlide + o.getSlideCount(), o.currentDirection = 0;
            break;

          case "right":
          case "up":
            e = o.options.swipeToSlide ? o.checkNavigable(o.currentSlide - o.getSlideCount()) : o.currentSlide - o.getSlideCount(), o.currentDirection = 1;
        }

        "vertical" != t && (o.slideHandler(e), o.touchObject = {}, o.$slider.trigger("swipe", [o, t]));
      } else o.touchObject.startX !== o.touchObject.curX && (o.slideHandler(o.currentSlide), o.touchObject = {});
    }, e.prototype.swipeHandler = function (i) {
      var e = this;
      if (!(!1 === e.options.swipe || "ontouchend" in document && !1 === e.options.swipe || !1 === e.options.draggable && -1 !== i.type.indexOf("mouse"))) switch (e.touchObject.fingerCount = i.originalEvent && void 0 !== i.originalEvent.touches ? i.originalEvent.touches.length : 1, e.touchObject.minSwipe = e.listWidth / e.options.touchThreshold, !0 === e.options.verticalSwiping && (e.touchObject.minSwipe = e.listHeight / e.options.touchThreshold), i.data.action) {
        case "start":
          e.swipeStart(i);
          break;

        case "move":
          e.swipeMove(i);
          break;

        case "end":
          e.swipeEnd(i);
      }
    }, e.prototype.swipeMove = function (i) {
      var e,
          t,
          o,
          s,
          n,
          r,
          l = this;
      return n = void 0 !== i.originalEvent ? i.originalEvent.touches : null, !(!l.dragging || l.scrolling || n && 1 !== n.length) && (e = l.getLeft(l.currentSlide), l.touchObject.curX = void 0 !== n ? n[0].pageX : i.clientX, l.touchObject.curY = void 0 !== n ? n[0].pageY : i.clientY, l.touchObject.swipeLength = Math.round(Math.sqrt(Math.pow(l.touchObject.curX - l.touchObject.startX, 2))), r = Math.round(Math.sqrt(Math.pow(l.touchObject.curY - l.touchObject.startY, 2))), !l.options.verticalSwiping && !l.swiping && r > 4 ? (l.scrolling = !0, !1) : (!0 === l.options.verticalSwiping && (l.touchObject.swipeLength = r), t = l.swipeDirection(), void 0 !== i.originalEvent && l.touchObject.swipeLength > 4 && (l.swiping = !0, i.preventDefault()), s = (!1 === l.options.rtl ? 1 : -1) * (l.touchObject.curX > l.touchObject.startX ? 1 : -1), !0 === l.options.verticalSwiping && (s = l.touchObject.curY > l.touchObject.startY ? 1 : -1), o = l.touchObject.swipeLength, l.touchObject.edgeHit = !1, !1 === l.options.infinite && (0 === l.currentSlide && "right" === t || l.currentSlide >= l.getDotCount() && "left" === t) && (o = l.touchObject.swipeLength * l.options.edgeFriction, l.touchObject.edgeHit = !0), !1 === l.options.vertical ? l.swipeLeft = e + o * s : l.swipeLeft = e + o * (l.$list.height() / l.listWidth) * s, !0 === l.options.verticalSwiping && (l.swipeLeft = e + o * s), !0 !== l.options.fade && !1 !== l.options.touchMove && (!0 === l.animating ? (l.swipeLeft = null, !1) : void l.setCSS(l.swipeLeft))));
    }, e.prototype.swipeStart = function (i) {
      var e,
          t = this;
      if (t.interrupted = !0, 1 !== t.touchObject.fingerCount || t.slideCount <= t.options.slidesToShow) return t.touchObject = {}, !1;
      void 0 !== i.originalEvent && void 0 !== i.originalEvent.touches && (e = i.originalEvent.touches[0]), t.touchObject.startX = t.touchObject.curX = void 0 !== e ? e.pageX : i.clientX, t.touchObject.startY = t.touchObject.curY = void 0 !== e ? e.pageY : i.clientY, t.dragging = !0;
    }, e.prototype.unfilterSlides = e.prototype.slickUnfilter = function () {
      var i = this;
      null !== i.$slidesCache && (i.unload(), i.$slideTrack.children(this.options.slide).detach(), i.$slidesCache.appendTo(i.$slideTrack), i.reinit());
    }, e.prototype.unload = function () {
      var e = this;
      i(".slick-cloned", e.$slider).remove(), e.$dots && e.$dots.remove(), e.$prevArrow && e.htmlExpr.test(e.options.prevArrow) && e.$prevArrow.remove(), e.$nextArrow && e.htmlExpr.test(e.options.nextArrow) && e.$nextArrow.remove(), e.$slides.removeClass("slick-slide slick-active slick-visible slick-current").attr("aria-hidden", "true").css("width", "");
    }, e.prototype.unslick = function (i) {
      var e = this;
      e.$slider.trigger("unslick", [e, i]), e.destroy();
    }, e.prototype.updateArrows = function () {
      var i = this;
      Math.floor(i.options.slidesToShow / 2), !0 === i.options.arrows && i.slideCount > i.options.slidesToShow && !i.options.infinite && (i.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), i.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), 0 === i.currentSlide ? (i.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true"), i.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : i.currentSlide >= i.slideCount - i.options.slidesToShow && !1 === i.options.centerMode ? (i.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), i.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : i.currentSlide >= i.slideCount - 1 && !0 === i.options.centerMode && (i.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), i.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")));
    }, e.prototype.updateDots = function () {
      var i = this;
      null !== i.$dots && (i.$dots.find("li").removeClass("slick-active").end(), i.$dots.find("li").eq(Math.floor(i.currentSlide / i.options.slidesToScroll)).addClass("slick-active"));
    }, e.prototype.visibility = function () {
      var i = this;
      i.options.autoplay && (document[i.hidden] ? i.interrupted = !0 : i.interrupted = !1);
    }, i.fn.slick = function () {
      var i,
          t,
          o = this,
          s = arguments[0],
          n = Array.prototype.slice.call(arguments, 1),
          r = o.length;

      for (i = 0; i < r; i++) {
        if ("object" == _typeof(s) || void 0 === s ? o[i].slick = new e(o[i], s) : t = o[i].slick[s].apply(o[i].slick, n), void 0 !== t) return t;
      }

      return o;
    };
  });

  function newProducts_carousel() {
    var carousel = jQuery('.new-product-1');
    var next_arrow = carousel.parent('.carousel-container').find('.slick-next-btn');
    var prev_arrow = carousel.parent('.carousel-container').find('.slick-prev-btn');
    carousel.slick({
      slidesToShow: 4,
      slidesToScroll: 4,
      arrows: true,
      prevArrow: prev_arrow,
      nextArrow: next_arrow,
      dots: false,
      speed: 900,
      rtl: true,
      infinite: false,
      responsive: [{
        breakpoint: 1023,
        settings: "unslick"
      }]
    });
  }

  function products_carousel() {
    var carousel = jQuery('.products-slider');
    carousel.each(function () {
      var next_arrow = jQuery(this).parent('.carousel-container').find('.slick-next-btn');
      var prev_arrow = jQuery(this).parent('.carousel-container').find('.slick-prev-btn');
      jQuery(this).slick({
        slidesToShow: 6,
        slidesToScroll: 6,
        arrows: true,
        prevArrow: prev_arrow,
        nextArrow: next_arrow,
        dots: false,
        speed: 900,
        rtl: true,
        infinite: false,
        responsive: [{
          breakpoint: 1023,
          settings: "unslick"
        }]
      });
    });
  }

  function offSales_carousel() {
    var carousel = jQuery('.new-product-2');
    var next_arrow = carousel.parent('.carousel-container').find('.slick-next-btn');
    var prev_arrow = carousel.parent('.carousel-container').find('.slick-prev-btn');
    carousel.slick({
      slidesToShow: 2,
      slidesToScroll: 2,
      arrows: true,
      prevArrow: prev_arrow,
      nextArrow: next_arrow,
      dots: false,
      speed: 900,
      rtl: true,
      infinite: false,
      responsive: [{
        breakpoint: 1023,
        settings: "unslick"
      }]
    });
  }

  function simple_carousel() {
    var carousel = jQuery('.category-carousel');
    carousel.each(function () {
      var next_arrow = jQuery(this).parent('.carousel-container').find('.simple-next');
      var prev_arrow = jQuery(this).parent('.carousel-container').find('.simple-prev');
      jQuery(this).slick({
        variableWidth: true,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        useTransform: false,
        prevArrow: prev_arrow,
        nextArrow: next_arrow,
        speed: 400,
        rtl: true,
        responsive: [{
          breakpoint: 1024,
          settings: "unslick"
        }]
      });
    });
  }

  function brands_carousel() {
    var carousel = jQuery('.brands-carousel');
    carousel.each(function () {
      var next_arrow = jQuery(this).parent('.carousel-container').find('.simple-next');
      var prev_arrow = jQuery(this).parent('.carousel-container').find('.simple-prev');
      jQuery(this).slick({
        variableWidth: true,
        slidesToScroll: 1,
        useTransform: false,
        arrows: true,
        dots: false,
        prevArrow: prev_arrow,
        nextArrow: next_arrow,
        speed: 400,
        rtl: true,
        responsive: [{
          breakpoint: 1024,
          settings: "unslick"
        }]
      });
    });
  }

  function single_carousel() {
    var carousel = jQuery('.flex-control-nav');
    carousel.each(function () {
      var next_arrow = jQuery(this).parent('.carousel-container').find('.single-next');
      var prev_arrow = jQuery(this).parent('.carousel-container').find('.single-prev');
      jQuery(this).slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        prevArrow: prev_arrow,
        nextArrow: next_arrow,
        speed: 400,
        rtl: true
      });
    });
  }

  function carousel(carousel) {
    if ('.carousel' !== carousel) {
      var next_arrow = jQuery(carousel).parent('.carousel-container').find('.slick-next-btn');
      var prev_arrow = jQuery(carousel).parent('.carousel-container').find('.slick-prev-btn');
      jQuery(carousel).slick({
        arrows: true,
        prevArrow: prev_arrow,
        nextArrow: next_arrow,
        autoplay: true,
        autoplaySpeed: 2000,
        fade: true,
        responsive: [{
          breakpoint: 1024,
          settings: {
            useTransform: false
          }
        }]
      });
    } else jQuery(carousel).slick({
      fade: true,
      autoplaySpeed: 3500,
      pauseOnHover: true
    });
  }

  /*
   * anime.js v3.2.1
   * (c) 2020 Julian Garnier
   * Released under the MIT license
   * animejs.com
   */
  // Defaults
  var defaultInstanceSettings = {
    update: null,
    begin: null,
    loopBegin: null,
    changeBegin: null,
    change: null,
    changeComplete: null,
    loopComplete: null,
    complete: null,
    loop: 1,
    direction: 'normal',
    autoplay: true,
    timelineOffset: 0
  };
  var defaultTweenSettings = {
    duration: 1000,
    delay: 0,
    endDelay: 0,
    easing: 'easeOutElastic(1, .5)',
    round: 0
  };
  var validTransforms = ['translateX', 'translateY', 'translateZ', 'rotate', 'rotateX', 'rotateY', 'rotateZ', 'scale', 'scaleX', 'scaleY', 'scaleZ', 'skew', 'skewX', 'skewY', 'perspective', 'matrix', 'matrix3d']; // Caching

  var cache = {
    CSS: {},
    springs: {}
  }; // Utils

  function minMax(val, min, max) {
    return Math.min(Math.max(val, min), max);
  }

  function stringContains(str, text) {
    return str.indexOf(text) > -1;
  }

  function applyArguments(func, args) {
    return func.apply(null, args);
  }

  var is = {
    arr: function arr(a) {
      return Array.isArray(a);
    },
    obj: function obj(a) {
      return stringContains(Object.prototype.toString.call(a), 'Object');
    },
    pth: function pth(a) {
      return is.obj(a) && a.hasOwnProperty('totalLength');
    },
    svg: function svg(a) {
      return a instanceof SVGElement;
    },
    inp: function inp(a) {
      return a instanceof HTMLInputElement;
    },
    dom: function dom(a) {
      return a.nodeType || is.svg(a);
    },
    str: function str(a) {
      return typeof a === 'string';
    },
    fnc: function fnc(a) {
      return typeof a === 'function';
    },
    und: function und(a) {
      return typeof a === 'undefined';
    },
    nil: function nil(a) {
      return is.und(a) || a === null;
    },
    hex: function hex(a) {
      return /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(a);
    },
    rgb: function rgb(a) {
      return /^rgb/.test(a);
    },
    hsl: function hsl(a) {
      return /^hsl/.test(a);
    },
    col: function col(a) {
      return is.hex(a) || is.rgb(a) || is.hsl(a);
    },
    key: function key(a) {
      return !defaultInstanceSettings.hasOwnProperty(a) && !defaultTweenSettings.hasOwnProperty(a) && a !== 'targets' && a !== 'keyframes';
    }
  }; // Easings

  function parseEasingParameters(string) {
    var match = /\(([^)]+)\)/.exec(string);
    return match ? match[1].split(',').map(function (p) {
      return parseFloat(p);
    }) : [];
  } // Spring solver inspired by Webkit Copyright © 2016 Apple Inc. All rights reserved. https://webkit.org/demos/spring/spring.js


  function spring(string, duration) {
    var params = parseEasingParameters(string);
    var mass = minMax(is.und(params[0]) ? 1 : params[0], .1, 100);
    var stiffness = minMax(is.und(params[1]) ? 100 : params[1], .1, 100);
    var damping = minMax(is.und(params[2]) ? 10 : params[2], .1, 100);
    var velocity = minMax(is.und(params[3]) ? 0 : params[3], .1, 100);
    var w0 = Math.sqrt(stiffness / mass);
    var zeta = damping / (2 * Math.sqrt(stiffness * mass));
    var wd = zeta < 1 ? w0 * Math.sqrt(1 - zeta * zeta) : 0;
    var a = 1;
    var b = zeta < 1 ? (zeta * w0 + -velocity) / wd : -velocity + w0;

    function solver(t) {
      var progress = duration ? duration * t / 1000 : t;

      if (zeta < 1) {
        progress = Math.exp(-progress * zeta * w0) * (a * Math.cos(wd * progress) + b * Math.sin(wd * progress));
      } else {
        progress = (a + b * progress) * Math.exp(-progress * w0);
      }

      if (t === 0 || t === 1) {
        return t;
      }

      return 1 - progress;
    }

    function getDuration() {
      var cached = cache.springs[string];

      if (cached) {
        return cached;
      }

      var frame = 1 / 6;
      var elapsed = 0;
      var rest = 0;

      while (true) {
        elapsed += frame;

        if (solver(elapsed) === 1) {
          rest++;

          if (rest >= 16) {
            break;
          }
        } else {
          rest = 0;
        }
      }

      var duration = elapsed * frame * 1000;
      cache.springs[string] = duration;
      return duration;
    }

    return duration ? solver : getDuration;
  } // Basic steps easing implementation https://developer.mozilla.org/fr/docs/Web/CSS/transition-timing-function


  function steps(steps) {
    if (steps === void 0) steps = 10;
    return function (t) {
      return Math.ceil(minMax(t, 0.000001, 1) * steps) * (1 / steps);
    };
  } // BezierEasing https://github.com/gre/bezier-easing


  var bezier = function () {
    var kSplineTableSize = 11;
    var kSampleStepSize = 1.0 / (kSplineTableSize - 1.0);

    function A(aA1, aA2) {
      return 1.0 - 3.0 * aA2 + 3.0 * aA1;
    }

    function B(aA1, aA2) {
      return 3.0 * aA2 - 6.0 * aA1;
    }

    function C(aA1) {
      return 3.0 * aA1;
    }

    function calcBezier(aT, aA1, aA2) {
      return ((A(aA1, aA2) * aT + B(aA1, aA2)) * aT + C(aA1)) * aT;
    }

    function getSlope(aT, aA1, aA2) {
      return 3.0 * A(aA1, aA2) * aT * aT + 2.0 * B(aA1, aA2) * aT + C(aA1);
    }

    function binarySubdivide(aX, aA, aB, mX1, mX2) {
      var currentX,
          currentT,
          i = 0;

      do {
        currentT = aA + (aB - aA) / 2.0;
        currentX = calcBezier(currentT, mX1, mX2) - aX;

        if (currentX > 0.0) {
          aB = currentT;
        } else {
          aA = currentT;
        }
      } while (Math.abs(currentX) > 0.0000001 && ++i < 10);

      return currentT;
    }

    function newtonRaphsonIterate(aX, aGuessT, mX1, mX2) {
      for (var i = 0; i < 4; ++i) {
        var currentSlope = getSlope(aGuessT, mX1, mX2);

        if (currentSlope === 0.0) {
          return aGuessT;
        }

        var currentX = calcBezier(aGuessT, mX1, mX2) - aX;
        aGuessT -= currentX / currentSlope;
      }

      return aGuessT;
    }

    function bezier(mX1, mY1, mX2, mY2) {
      if (!(0 <= mX1 && mX1 <= 1 && 0 <= mX2 && mX2 <= 1)) {
        return;
      }

      var sampleValues = new Float32Array(kSplineTableSize);

      if (mX1 !== mY1 || mX2 !== mY2) {
        for (var i = 0; i < kSplineTableSize; ++i) {
          sampleValues[i] = calcBezier(i * kSampleStepSize, mX1, mX2);
        }
      }

      function getTForX(aX) {
        var intervalStart = 0;
        var currentSample = 1;
        var lastSample = kSplineTableSize - 1;

        for (; currentSample !== lastSample && sampleValues[currentSample] <= aX; ++currentSample) {
          intervalStart += kSampleStepSize;
        }

        --currentSample;
        var dist = (aX - sampleValues[currentSample]) / (sampleValues[currentSample + 1] - sampleValues[currentSample]);
        var guessForT = intervalStart + dist * kSampleStepSize;
        var initialSlope = getSlope(guessForT, mX1, mX2);

        if (initialSlope >= 0.001) {
          return newtonRaphsonIterate(aX, guessForT, mX1, mX2);
        } else if (initialSlope === 0.0) {
          return guessForT;
        } else {
          return binarySubdivide(aX, intervalStart, intervalStart + kSampleStepSize, mX1, mX2);
        }
      }

      return function (x) {
        if (mX1 === mY1 && mX2 === mY2) {
          return x;
        }

        if (x === 0 || x === 1) {
          return x;
        }

        return calcBezier(getTForX(x), mY1, mY2);
      };
    }

    return bezier;
  }();

  var penner = function () {
    // Based on jQuery UI's implemenation of easing equations from Robert Penner (http://www.robertpenner.com/easing)
    var eases = {
      linear: function linear() {
        return function (t) {
          return t;
        };
      }
    };
    var functionEasings = {
      Sine: function Sine() {
        return function (t) {
          return 1 - Math.cos(t * Math.PI / 2);
        };
      },
      Circ: function Circ() {
        return function (t) {
          return 1 - Math.sqrt(1 - t * t);
        };
      },
      Back: function Back() {
        return function (t) {
          return t * t * (3 * t - 2);
        };
      },
      Bounce: function Bounce() {
        return function (t) {
          var pow2,
              b = 4;

          while (t < ((pow2 = Math.pow(2, --b)) - 1) / 11) {}

          return 1 / Math.pow(4, 3 - b) - 7.5625 * Math.pow((pow2 * 3 - 2) / 22 - t, 2);
        };
      },
      Elastic: function Elastic(amplitude, period) {
        if (amplitude === void 0) amplitude = 1;
        if (period === void 0) period = .5;
        var a = minMax(amplitude, 1, 10);
        var p = minMax(period, .1, 2);
        return function (t) {
          return t === 0 || t === 1 ? t : -a * Math.pow(2, 10 * (t - 1)) * Math.sin((t - 1 - p / (Math.PI * 2) * Math.asin(1 / a)) * (Math.PI * 2) / p);
        };
      }
    };
    var baseEasings = ['Quad', 'Cubic', 'Quart', 'Quint', 'Expo'];
    baseEasings.forEach(function (name, i) {
      functionEasings[name] = function () {
        return function (t) {
          return Math.pow(t, i + 2);
        };
      };
    });
    Object.keys(functionEasings).forEach(function (name) {
      var easeIn = functionEasings[name];
      eases['easeIn' + name] = easeIn;

      eases['easeOut' + name] = function (a, b) {
        return function (t) {
          return 1 - easeIn(a, b)(1 - t);
        };
      };

      eases['easeInOut' + name] = function (a, b) {
        return function (t) {
          return t < 0.5 ? easeIn(a, b)(t * 2) / 2 : 1 - easeIn(a, b)(t * -2 + 2) / 2;
        };
      };

      eases['easeOutIn' + name] = function (a, b) {
        return function (t) {
          return t < 0.5 ? (1 - easeIn(a, b)(1 - t * 2)) / 2 : (easeIn(a, b)(t * 2 - 1) + 1) / 2;
        };
      };
    });
    return eases;
  }();

  function parseEasings(easing, duration) {
    if (is.fnc(easing)) {
      return easing;
    }

    var name = easing.split('(')[0];
    var ease = penner[name];
    var args = parseEasingParameters(easing);

    switch (name) {
      case 'spring':
        return spring(easing, duration);

      case 'cubicBezier':
        return applyArguments(bezier, args);

      case 'steps':
        return applyArguments(steps, args);

      default:
        return applyArguments(ease, args);
    }
  } // Strings


  function selectString(str) {
    try {
      var nodes = document.querySelectorAll(str);
      return nodes;
    } catch (e) {
      return;
    }
  } // Arrays


  function filterArray(arr, callback) {
    var len = arr.length;
    var thisArg = arguments.length >= 2 ? arguments[1] : void 0;
    var result = [];

    for (var i = 0; i < len; i++) {
      if (i in arr) {
        var val = arr[i];

        if (callback.call(thisArg, val, i, arr)) {
          result.push(val);
        }
      }
    }

    return result;
  }

  function flattenArray(arr) {
    return arr.reduce(function (a, b) {
      return a.concat(is.arr(b) ? flattenArray(b) : b);
    }, []);
  }

  function toArray(o) {
    if (is.arr(o)) {
      return o;
    }

    if (is.str(o)) {
      o = selectString(o) || o;
    }

    if (o instanceof NodeList || o instanceof HTMLCollection) {
      return [].slice.call(o);
    }

    return [o];
  }

  function arrayContains(arr, val) {
    return arr.some(function (a) {
      return a === val;
    });
  } // Objects


  function cloneObject(o) {
    var clone = {};

    for (var p in o) {
      clone[p] = o[p];
    }

    return clone;
  }

  function replaceObjectProps(o1, o2) {
    var o = cloneObject(o1);

    for (var p in o1) {
      o[p] = o2.hasOwnProperty(p) ? o2[p] : o1[p];
    }

    return o;
  }

  function mergeObjects(o1, o2) {
    var o = cloneObject(o1);

    for (var p in o2) {
      o[p] = is.und(o1[p]) ? o2[p] : o1[p];
    }

    return o;
  } // Colors


  function rgbToRgba(rgbValue) {
    var rgb = /rgb\((\d+,\s*[\d]+,\s*[\d]+)\)/g.exec(rgbValue);
    return rgb ? "rgba(" + rgb[1] + ",1)" : rgbValue;
  }

  function hexToRgba(hexValue) {
    var rgx = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    var hex = hexValue.replace(rgx, function (m, r, g, b) {
      return r + r + g + g + b + b;
    });
    var rgb = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    var r = parseInt(rgb[1], 16);
    var g = parseInt(rgb[2], 16);
    var b = parseInt(rgb[3], 16);
    return "rgba(" + r + "," + g + "," + b + ",1)";
  }

  function hslToRgba(hslValue) {
    var hsl = /hsl\((\d+),\s*([\d.]+)%,\s*([\d.]+)%\)/g.exec(hslValue) || /hsla\((\d+),\s*([\d.]+)%,\s*([\d.]+)%,\s*([\d.]+)\)/g.exec(hslValue);
    var h = parseInt(hsl[1], 10) / 360;
    var s = parseInt(hsl[2], 10) / 100;
    var l = parseInt(hsl[3], 10) / 100;
    var a = hsl[4] || 1;

    function hue2rgb(p, q, t) {
      if (t < 0) {
        t += 1;
      }

      if (t > 1) {
        t -= 1;
      }

      if (t < 1 / 6) {
        return p + (q - p) * 6 * t;
      }

      if (t < 1 / 2) {
        return q;
      }

      if (t < 2 / 3) {
        return p + (q - p) * (2 / 3 - t) * 6;
      }

      return p;
    }

    var r, g, b;

    if (s == 0) {
      r = g = b = l;
    } else {
      var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
      var p = 2 * l - q;
      r = hue2rgb(p, q, h + 1 / 3);
      g = hue2rgb(p, q, h);
      b = hue2rgb(p, q, h - 1 / 3);
    }

    return "rgba(" + r * 255 + "," + g * 255 + "," + b * 255 + "," + a + ")";
  }

  function colorToRgb(val) {
    if (is.rgb(val)) {
      return rgbToRgba(val);
    }

    if (is.hex(val)) {
      return hexToRgba(val);
    }

    if (is.hsl(val)) {
      return hslToRgba(val);
    }
  } // Units


  function getUnit(val) {
    var split = /[+-]?\d*\.?\d+(?:\.\d+)?(?:[eE][+-]?\d+)?(%|px|pt|em|rem|in|cm|mm|ex|ch|pc|vw|vh|vmin|vmax|deg|rad|turn)?$/.exec(val);

    if (split) {
      return split[1];
    }
  }

  function getTransformUnit(propName) {
    if (stringContains(propName, 'translate') || propName === 'perspective') {
      return 'px';
    }

    if (stringContains(propName, 'rotate') || stringContains(propName, 'skew')) {
      return 'deg';
    }
  } // Values


  function getFunctionValue(val, animatable) {
    if (!is.fnc(val)) {
      return val;
    }

    return val(animatable.target, animatable.id, animatable.total);
  }

  function getAttribute(el, prop) {
    return el.getAttribute(prop);
  }

  function convertPxToUnit(el, value, unit) {
    var valueUnit = getUnit(value);

    if (arrayContains([unit, 'deg', 'rad', 'turn'], valueUnit)) {
      return value;
    }

    var cached = cache.CSS[value + unit];

    if (!is.und(cached)) {
      return cached;
    }

    var baseline = 100;
    var tempEl = document.createElement(el.tagName);
    var parentEl = el.parentNode && el.parentNode !== document ? el.parentNode : document.body;
    parentEl.appendChild(tempEl);
    tempEl.style.position = 'absolute';
    tempEl.style.width = baseline + unit;
    var factor = baseline / tempEl.offsetWidth;
    parentEl.removeChild(tempEl);
    var convertedUnit = factor * parseFloat(value);
    cache.CSS[value + unit] = convertedUnit;
    return convertedUnit;
  }

  function getCSSValue(el, prop, unit) {
    if (prop in el.style) {
      var uppercasePropName = prop.replace(/([a-z])([A-Z])/g, '$1-$2').toLowerCase();
      var value = el.style[prop] || getComputedStyle(el).getPropertyValue(uppercasePropName) || '0';
      return unit ? convertPxToUnit(el, value, unit) : value;
    }
  }

  function getAnimationType(el, prop) {
    if (is.dom(el) && !is.inp(el) && (!is.nil(getAttribute(el, prop)) || is.svg(el) && el[prop])) {
      return 'attribute';
    }

    if (is.dom(el) && arrayContains(validTransforms, prop)) {
      return 'transform';
    }

    if (is.dom(el) && prop !== 'transform' && getCSSValue(el, prop)) {
      return 'css';
    }

    if (el[prop] != null) {
      return 'object';
    }
  }

  function getElementTransforms(el) {
    if (!is.dom(el)) {
      return;
    }

    var str = el.style.transform || '';
    var reg = /(\w+)\(([^)]*)\)/g;
    var transforms = new Map();
    var m;

    while (m = reg.exec(str)) {
      transforms.set(m[1], m[2]);
    }

    return transforms;
  }

  function getTransformValue(el, propName, animatable, unit) {
    var defaultVal = stringContains(propName, 'scale') ? 1 : 0 + getTransformUnit(propName);
    var value = getElementTransforms(el).get(propName) || defaultVal;

    if (animatable) {
      animatable.transforms.list.set(propName, value);
      animatable.transforms['last'] = propName;
    }

    return unit ? convertPxToUnit(el, value, unit) : value;
  }

  function getOriginalTargetValue(target, propName, unit, animatable) {
    switch (getAnimationType(target, propName)) {
      case 'transform':
        return getTransformValue(target, propName, animatable, unit);

      case 'css':
        return getCSSValue(target, propName, unit);

      case 'attribute':
        return getAttribute(target, propName);

      default:
        return target[propName] || 0;
    }
  }

  function getRelativeValue(to, from) {
    var operator = /^(\*=|\+=|-=)/.exec(to);

    if (!operator) {
      return to;
    }

    var u = getUnit(to) || 0;
    var x = parseFloat(from);
    var y = parseFloat(to.replace(operator[0], ''));

    switch (operator[0][0]) {
      case '+':
        return x + y + u;

      case '-':
        return x - y + u;

      case '*':
        return x * y + u;
    }
  }

  function validateValue(val, unit) {
    if (is.col(val)) {
      return colorToRgb(val);
    }

    if (/\s/g.test(val)) {
      return val;
    }

    var originalUnit = getUnit(val);
    var unitLess = originalUnit ? val.substr(0, val.length - originalUnit.length) : val;

    if (unit) {
      return unitLess + unit;
    }

    return unitLess;
  } // getTotalLength() equivalent for circle, rect, polyline, polygon and line shapes
  // adapted from https://gist.github.com/SebLambla/3e0550c496c236709744


  function getDistance(p1, p2) {
    return Math.sqrt(Math.pow(p2.x - p1.x, 2) + Math.pow(p2.y - p1.y, 2));
  }

  function getCircleLength(el) {
    return Math.PI * 2 * getAttribute(el, 'r');
  }

  function getRectLength(el) {
    return getAttribute(el, 'width') * 2 + getAttribute(el, 'height') * 2;
  }

  function getLineLength(el) {
    return getDistance({
      x: getAttribute(el, 'x1'),
      y: getAttribute(el, 'y1')
    }, {
      x: getAttribute(el, 'x2'),
      y: getAttribute(el, 'y2')
    });
  }

  function getPolylineLength(el) {
    var points = el.points;
    var totalLength = 0;
    var previousPos;

    for (var i = 0; i < points.numberOfItems; i++) {
      var currentPos = points.getItem(i);

      if (i > 0) {
        totalLength += getDistance(previousPos, currentPos);
      }

      previousPos = currentPos;
    }

    return totalLength;
  }

  function getPolygonLength(el) {
    var points = el.points;
    return getPolylineLength(el) + getDistance(points.getItem(points.numberOfItems - 1), points.getItem(0));
  } // Path animation


  function getTotalLength(el) {
    if (el.getTotalLength) {
      return el.getTotalLength();
    }

    switch (el.tagName.toLowerCase()) {
      case 'circle':
        return getCircleLength(el);

      case 'rect':
        return getRectLength(el);

      case 'line':
        return getLineLength(el);

      case 'polyline':
        return getPolylineLength(el);

      case 'polygon':
        return getPolygonLength(el);
    }
  }

  function setDashoffset(el) {
    var pathLength = getTotalLength(el);
    el.setAttribute('stroke-dasharray', pathLength);
    return pathLength;
  } // Motion path


  function getParentSvgEl(el) {
    var parentEl = el.parentNode;

    while (is.svg(parentEl)) {
      if (!is.svg(parentEl.parentNode)) {
        break;
      }

      parentEl = parentEl.parentNode;
    }

    return parentEl;
  }

  function getParentSvg(pathEl, svgData) {
    var svg = svgData || {};
    var parentSvgEl = svg.el || getParentSvgEl(pathEl);
    var rect = parentSvgEl.getBoundingClientRect();
    var viewBoxAttr = getAttribute(parentSvgEl, 'viewBox');
    var width = rect.width;
    var height = rect.height;
    var viewBox = svg.viewBox || (viewBoxAttr ? viewBoxAttr.split(' ') : [0, 0, width, height]);
    return {
      el: parentSvgEl,
      viewBox: viewBox,
      x: viewBox[0] / 1,
      y: viewBox[1] / 1,
      w: width,
      h: height,
      vW: viewBox[2],
      vH: viewBox[3]
    };
  }

  function getPath(path, percent) {
    var pathEl = is.str(path) ? selectString(path)[0] : path;
    var p = percent || 100;
    return function (property) {
      return {
        property: property,
        el: pathEl,
        svg: getParentSvg(pathEl),
        totalLength: getTotalLength(pathEl) * (p / 100)
      };
    };
  }

  function getPathProgress(path, progress, isPathTargetInsideSVG) {
    function point(offset) {
      if (offset === void 0) offset = 0;
      var l = progress + offset >= 1 ? progress + offset : 0;
      return path.el.getPointAtLength(l);
    }

    var svg = getParentSvg(path.el, path.svg);
    var p = point();
    var p0 = point(-1);
    var p1 = point(+1);
    var scaleX = isPathTargetInsideSVG ? 1 : svg.w / svg.vW;
    var scaleY = isPathTargetInsideSVG ? 1 : svg.h / svg.vH;

    switch (path.property) {
      case 'x':
        return (p.x - svg.x) * scaleX;

      case 'y':
        return (p.y - svg.y) * scaleY;

      case 'angle':
        return Math.atan2(p1.y - p0.y, p1.x - p0.x) * 180 / Math.PI;
    }
  } // Decompose value


  function decomposeValue(val, unit) {
    // const rgx = /-?\d*\.?\d+/g; // handles basic numbers
    // const rgx = /[+-]?\d+(?:\.\d+)?(?:[eE][+-]?\d+)?/g; // handles exponents notation
    var rgx = /[+-]?\d*\.?\d+(?:\.\d+)?(?:[eE][+-]?\d+)?/g; // handles exponents notation

    var value = validateValue(is.pth(val) ? val.totalLength : val, unit) + '';
    return {
      original: value,
      numbers: value.match(rgx) ? value.match(rgx).map(Number) : [0],
      strings: is.str(val) || unit ? value.split(rgx) : []
    };
  } // Animatables


  function parseTargets(targets) {
    var targetsArray = targets ? flattenArray(is.arr(targets) ? targets.map(toArray) : toArray(targets)) : [];
    return filterArray(targetsArray, function (item, pos, self) {
      return self.indexOf(item) === pos;
    });
  }

  function getAnimatables(targets) {
    var parsed = parseTargets(targets);
    return parsed.map(function (t, i) {
      return {
        target: t,
        id: i,
        total: parsed.length,
        transforms: {
          list: getElementTransforms(t)
        }
      };
    });
  } // Properties


  function normalizePropertyTweens(prop, tweenSettings) {
    var settings = cloneObject(tweenSettings); // Override duration if easing is a spring

    if (/^spring/.test(settings.easing)) {
      settings.duration = spring(settings.easing);
    }

    if (is.arr(prop)) {
      var l = prop.length;
      var isFromTo = l === 2 && !is.obj(prop[0]);

      if (!isFromTo) {
        // Duration divided by the number of tweens
        if (!is.fnc(tweenSettings.duration)) {
          settings.duration = tweenSettings.duration / l;
        }
      } else {
        // Transform [from, to] values shorthand to a valid tween value
        prop = {
          value: prop
        };
      }
    }

    var propArray = is.arr(prop) ? prop : [prop];
    return propArray.map(function (v, i) {
      var obj = is.obj(v) && !is.pth(v) ? v : {
        value: v
      }; // Default delay value should only be applied to the first tween

      if (is.und(obj.delay)) {
        obj.delay = !i ? tweenSettings.delay : 0;
      } // Default endDelay value should only be applied to the last tween


      if (is.und(obj.endDelay)) {
        obj.endDelay = i === propArray.length - 1 ? tweenSettings.endDelay : 0;
      }

      return obj;
    }).map(function (k) {
      return mergeObjects(k, settings);
    });
  }

  function flattenKeyframes(keyframes) {
    var propertyNames = filterArray(flattenArray(keyframes.map(function (key) {
      return Object.keys(key);
    })), function (p) {
      return is.key(p);
    }).reduce(function (a, b) {
      if (a.indexOf(b) < 0) {
        a.push(b);
      }

      return a;
    }, []);
    var properties = {};

    var loop = function loop(i) {
      var propName = propertyNames[i];
      properties[propName] = keyframes.map(function (key) {
        var newKey = {};

        for (var p in key) {
          if (is.key(p)) {
            if (p == propName) {
              newKey.value = key[p];
            }
          } else {
            newKey[p] = key[p];
          }
        }

        return newKey;
      });
    };

    for (var i = 0; i < propertyNames.length; i++) {
      loop(i);
    }

    return properties;
  }

  function getProperties(tweenSettings, params) {
    var properties = [];
    var keyframes = params.keyframes;

    if (keyframes) {
      params = mergeObjects(flattenKeyframes(keyframes), params);
    }

    for (var p in params) {
      if (is.key(p)) {
        properties.push({
          name: p,
          tweens: normalizePropertyTweens(params[p], tweenSettings)
        });
      }
    }

    return properties;
  } // Tweens


  function normalizeTweenValues(tween, animatable) {
    var t = {};

    for (var p in tween) {
      var value = getFunctionValue(tween[p], animatable);

      if (is.arr(value)) {
        value = value.map(function (v) {
          return getFunctionValue(v, animatable);
        });

        if (value.length === 1) {
          value = value[0];
        }
      }

      t[p] = value;
    }

    t.duration = parseFloat(t.duration);
    t.delay = parseFloat(t.delay);
    return t;
  }

  function normalizeTweens(prop, animatable) {
    var previousTween;
    return prop.tweens.map(function (t) {
      var tween = normalizeTweenValues(t, animatable);
      var tweenValue = tween.value;
      var to = is.arr(tweenValue) ? tweenValue[1] : tweenValue;
      var toUnit = getUnit(to);
      var originalValue = getOriginalTargetValue(animatable.target, prop.name, toUnit, animatable);
      var previousValue = previousTween ? previousTween.to.original : originalValue;
      var from = is.arr(tweenValue) ? tweenValue[0] : previousValue;
      var fromUnit = getUnit(from) || getUnit(originalValue);
      var unit = toUnit || fromUnit;

      if (is.und(to)) {
        to = previousValue;
      }

      tween.from = decomposeValue(from, unit);
      tween.to = decomposeValue(getRelativeValue(to, from), unit);
      tween.start = previousTween ? previousTween.end : 0;
      tween.end = tween.start + tween.delay + tween.duration + tween.endDelay;
      tween.easing = parseEasings(tween.easing, tween.duration);
      tween.isPath = is.pth(tweenValue);
      tween.isPathTargetInsideSVG = tween.isPath && is.svg(animatable.target);
      tween.isColor = is.col(tween.from.original);

      if (tween.isColor) {
        tween.round = 1;
      }

      previousTween = tween;
      return tween;
    });
  } // Tween progress


  var setProgressValue = {
    css: function css(t, p, v) {
      return t.style[p] = v;
    },
    attribute: function attribute(t, p, v) {
      return t.setAttribute(p, v);
    },
    object: function object(t, p, v) {
      return t[p] = v;
    },
    transform: function transform(t, p, v, transforms, manual) {
      transforms.list.set(p, v);

      if (p === transforms.last || manual) {
        var str = '';
        transforms.list.forEach(function (value, prop) {
          str += prop + "(" + value + ") ";
        });
        t.style.transform = str;
      }
    }
  }; // Set Value helper

  function setTargetsValue(targets, properties) {
    var animatables = getAnimatables(targets);
    animatables.forEach(function (animatable) {
      for (var property in properties) {
        var value = getFunctionValue(properties[property], animatable);
        var target = animatable.target;
        var valueUnit = getUnit(value);
        var originalValue = getOriginalTargetValue(target, property, valueUnit, animatable);
        var unit = valueUnit || getUnit(originalValue);
        var to = getRelativeValue(validateValue(value, unit), originalValue);
        var animType = getAnimationType(target, property);
        setProgressValue[animType](target, property, to, animatable.transforms, true);
      }
    });
  } // Animations


  function createAnimation(animatable, prop) {
    var animType = getAnimationType(animatable.target, prop.name);

    if (animType) {
      var tweens = normalizeTweens(prop, animatable);
      var lastTween = tweens[tweens.length - 1];
      return {
        type: animType,
        property: prop.name,
        animatable: animatable,
        tweens: tweens,
        duration: lastTween.end,
        delay: tweens[0].delay,
        endDelay: lastTween.endDelay
      };
    }
  }

  function getAnimations(animatables, properties) {
    return filterArray(flattenArray(animatables.map(function (animatable) {
      return properties.map(function (prop) {
        return createAnimation(animatable, prop);
      });
    })), function (a) {
      return !is.und(a);
    });
  } // Create Instance


  function getInstanceTimings(animations, tweenSettings) {
    var animLength = animations.length;

    var getTlOffset = function getTlOffset(anim) {
      return anim.timelineOffset ? anim.timelineOffset : 0;
    };

    var timings = {};
    timings.duration = animLength ? Math.max.apply(Math, animations.map(function (anim) {
      return getTlOffset(anim) + anim.duration;
    })) : tweenSettings.duration;
    timings.delay = animLength ? Math.min.apply(Math, animations.map(function (anim) {
      return getTlOffset(anim) + anim.delay;
    })) : tweenSettings.delay;
    timings.endDelay = animLength ? timings.duration - Math.max.apply(Math, animations.map(function (anim) {
      return getTlOffset(anim) + anim.duration - anim.endDelay;
    })) : tweenSettings.endDelay;
    return timings;
  }

  var instanceID = 0;

  function createNewInstance(params) {
    var instanceSettings = replaceObjectProps(defaultInstanceSettings, params);
    var tweenSettings = replaceObjectProps(defaultTweenSettings, params);
    var properties = getProperties(tweenSettings, params);
    var animatables = getAnimatables(params.targets);
    var animations = getAnimations(animatables, properties);
    var timings = getInstanceTimings(animations, tweenSettings);
    var id = instanceID;
    instanceID++;
    return mergeObjects(instanceSettings, {
      id: id,
      children: [],
      animatables: animatables,
      animations: animations,
      duration: timings.duration,
      delay: timings.delay,
      endDelay: timings.endDelay
    });
  } // Core


  var activeInstances = [];

  var engine = function () {
    var raf;

    function play() {
      if (!raf && (!isDocumentHidden() || !anime.suspendWhenDocumentHidden) && activeInstances.length > 0) {
        raf = requestAnimationFrame(step);
      }
    }

    function step(t) {
      // memo on algorithm issue:
      // dangerous iteration over mutable `activeInstances`
      // (that collection may be updated from within callbacks of `tick`-ed animation instances)
      var activeInstancesLength = activeInstances.length;
      var i = 0;

      while (i < activeInstancesLength) {
        var activeInstance = activeInstances[i];

        if (!activeInstance.paused) {
          activeInstance.tick(t);
          i++;
        } else {
          activeInstances.splice(i, 1);
          activeInstancesLength--;
        }
      }

      raf = i > 0 ? requestAnimationFrame(step) : undefined;
    }

    function handleVisibilityChange() {
      if (!anime.suspendWhenDocumentHidden) {
        return;
      }

      if (isDocumentHidden()) {
        // suspend ticks
        raf = cancelAnimationFrame(raf);
      } else {
        // is back to active tab
        // first adjust animations to consider the time that ticks were suspended
        activeInstances.forEach(function (instance) {
          return instance._onDocumentVisibility();
        });
        engine();
      }
    }

    if (typeof document !== 'undefined') {
      document.addEventListener('visibilitychange', handleVisibilityChange);
    }

    return play;
  }();

  function isDocumentHidden() {
    return !!document && document.hidden;
  } // Public Instance


  function anime(params) {
    if (params === void 0) params = {};
    var startTime = 0,
        lastTime = 0,
        now = 0;
    var children,
        childrenLength = 0;
    var resolve = null;

    function makePromise(instance) {
      var promise = window.Promise && new Promise(function (_resolve) {
        return resolve = _resolve;
      });
      instance.finished = promise;
      return promise;
    }

    var instance = createNewInstance(params);
    makePromise(instance);

    function toggleInstanceDirection() {
      var direction = instance.direction;

      if (direction !== 'alternate') {
        instance.direction = direction !== 'normal' ? 'normal' : 'reverse';
      }

      instance.reversed = !instance.reversed;
      children.forEach(function (child) {
        return child.reversed = instance.reversed;
      });
    }

    function adjustTime(time) {
      return instance.reversed ? instance.duration - time : time;
    }

    function resetTime() {
      startTime = 0;
      lastTime = adjustTime(instance.currentTime) * (1 / anime.speed);
    }

    function seekChild(time, child) {
      if (child) {
        child.seek(time - child.timelineOffset);
      }
    }

    function syncInstanceChildren(time) {
      if (!instance.reversePlayback) {
        for (var i = 0; i < childrenLength; i++) {
          seekChild(time, children[i]);
        }
      } else {
        for (var i$1 = childrenLength; i$1--;) {
          seekChild(time, children[i$1]);
        }
      }
    }

    function setAnimationsProgress(insTime) {
      var i = 0;
      var animations = instance.animations;
      var animationsLength = animations.length;

      while (i < animationsLength) {
        var anim = animations[i];
        var animatable = anim.animatable;
        var tweens = anim.tweens;
        var tweenLength = tweens.length - 1;
        var tween = tweens[tweenLength]; // Only check for keyframes if there is more than one tween

        if (tweenLength) {
          tween = filterArray(tweens, function (t) {
            return insTime < t.end;
          })[0] || tween;
        }

        var elapsed = minMax(insTime - tween.start - tween.delay, 0, tween.duration) / tween.duration;
        var eased = isNaN(elapsed) ? 1 : tween.easing(elapsed);
        var strings = tween.to.strings;
        var round = tween.round;
        var numbers = [];
        var toNumbersLength = tween.to.numbers.length;
        var progress = void 0;

        for (var n = 0; n < toNumbersLength; n++) {
          var value = void 0;
          var toNumber = tween.to.numbers[n];
          var fromNumber = tween.from.numbers[n] || 0;

          if (!tween.isPath) {
            value = fromNumber + eased * (toNumber - fromNumber);
          } else {
            value = getPathProgress(tween.value, eased * toNumber, tween.isPathTargetInsideSVG);
          }

          if (round) {
            if (!(tween.isColor && n > 2)) {
              value = Math.round(value * round) / round;
            }
          }

          numbers.push(value);
        } // Manual Array.reduce for better performances


        var stringsLength = strings.length;

        if (!stringsLength) {
          progress = numbers[0];
        } else {
          progress = strings[0];

          for (var s = 0; s < stringsLength; s++) {
            strings[s];
            var b = strings[s + 1];
            var n$1 = numbers[s];

            if (!isNaN(n$1)) {
              if (!b) {
                progress += n$1 + ' ';
              } else {
                progress += n$1 + b;
              }
            }
          }
        }

        setProgressValue[anim.type](animatable.target, anim.property, progress, animatable.transforms);
        anim.currentValue = progress;
        i++;
      }
    }

    function setCallback(cb) {
      if (instance[cb] && !instance.passThrough) {
        instance[cb](instance);
      }
    }

    function countIteration() {
      if (instance.remaining && instance.remaining !== true) {
        instance.remaining--;
      }
    }

    function setInstanceProgress(engineTime) {
      var insDuration = instance.duration;
      var insDelay = instance.delay;
      var insEndDelay = insDuration - instance.endDelay;
      var insTime = adjustTime(engineTime);
      instance.progress = minMax(insTime / insDuration * 100, 0, 100);
      instance.reversePlayback = insTime < instance.currentTime;

      if (children) {
        syncInstanceChildren(insTime);
      }

      if (!instance.began && instance.currentTime > 0) {
        instance.began = true;
        setCallback('begin');
      }

      if (!instance.loopBegan && instance.currentTime > 0) {
        instance.loopBegan = true;
        setCallback('loopBegin');
      }

      if (insTime <= insDelay && instance.currentTime !== 0) {
        setAnimationsProgress(0);
      }

      if (insTime >= insEndDelay && instance.currentTime !== insDuration || !insDuration) {
        setAnimationsProgress(insDuration);
      }

      if (insTime > insDelay && insTime < insEndDelay) {
        if (!instance.changeBegan) {
          instance.changeBegan = true;
          instance.changeCompleted = false;
          setCallback('changeBegin');
        }

        setCallback('change');
        setAnimationsProgress(insTime);
      } else {
        if (instance.changeBegan) {
          instance.changeCompleted = true;
          instance.changeBegan = false;
          setCallback('changeComplete');
        }
      }

      instance.currentTime = minMax(insTime, 0, insDuration);

      if (instance.began) {
        setCallback('update');
      }

      if (engineTime >= insDuration) {
        lastTime = 0;
        countIteration();

        if (!instance.remaining) {
          instance.paused = true;

          if (!instance.completed) {
            instance.completed = true;
            setCallback('loopComplete');
            setCallback('complete');

            if (!instance.passThrough && 'Promise' in window) {
              resolve();
              makePromise(instance);
            }
          }
        } else {
          startTime = now;
          setCallback('loopComplete');
          instance.loopBegan = false;

          if (instance.direction === 'alternate') {
            toggleInstanceDirection();
          }
        }
      }
    }

    instance.reset = function () {
      var direction = instance.direction;
      instance.passThrough = false;
      instance.currentTime = 0;
      instance.progress = 0;
      instance.paused = true;
      instance.began = false;
      instance.loopBegan = false;
      instance.changeBegan = false;
      instance.completed = false;
      instance.changeCompleted = false;
      instance.reversePlayback = false;
      instance.reversed = direction === 'reverse';
      instance.remaining = instance.loop;
      children = instance.children;
      childrenLength = children.length;

      for (var i = childrenLength; i--;) {
        instance.children[i].reset();
      }

      if (instance.reversed && instance.loop !== true || direction === 'alternate' && instance.loop === 1) {
        instance.remaining++;
      }

      setAnimationsProgress(instance.reversed ? instance.duration : 0);
    }; // internal method (for engine) to adjust animation timings before restoring engine ticks (rAF)


    instance._onDocumentVisibility = resetTime; // Set Value helper

    instance.set = function (targets, properties) {
      setTargetsValue(targets, properties);
      return instance;
    };

    instance.tick = function (t) {
      now = t;

      if (!startTime) {
        startTime = now;
      }

      setInstanceProgress((now + (lastTime - startTime)) * anime.speed);
    };

    instance.seek = function (time) {
      setInstanceProgress(adjustTime(time));
    };

    instance.pause = function () {
      instance.paused = true;
      resetTime();
    };

    instance.play = function () {
      if (!instance.paused) {
        return;
      }

      if (instance.completed) {
        instance.reset();
      }

      instance.paused = false;
      activeInstances.push(instance);
      resetTime();
      engine();
    };

    instance.reverse = function () {
      toggleInstanceDirection();
      instance.completed = instance.reversed ? false : true;
      resetTime();
    };

    instance.restart = function () {
      instance.reset();
      instance.play();
    };

    instance.remove = function (targets) {
      var targetsArray = parseTargets(targets);
      removeTargetsFromInstance(targetsArray, instance);
    };

    instance.reset();

    if (instance.autoplay) {
      instance.play();
    }

    return instance;
  } // Remove targets from animation


  function removeTargetsFromAnimations(targetsArray, animations) {
    for (var a = animations.length; a--;) {
      if (arrayContains(targetsArray, animations[a].animatable.target)) {
        animations.splice(a, 1);
      }
    }
  }

  function removeTargetsFromInstance(targetsArray, instance) {
    var animations = instance.animations;
    var children = instance.children;
    removeTargetsFromAnimations(targetsArray, animations);

    for (var c = children.length; c--;) {
      var child = children[c];
      var childAnimations = child.animations;
      removeTargetsFromAnimations(targetsArray, childAnimations);

      if (!childAnimations.length && !child.children.length) {
        children.splice(c, 1);
      }
    }

    if (!animations.length && !children.length) {
      instance.pause();
    }
  }

  function removeTargetsFromActiveInstances(targets) {
    var targetsArray = parseTargets(targets);

    for (var i = activeInstances.length; i--;) {
      var instance = activeInstances[i];
      removeTargetsFromInstance(targetsArray, instance);
    }
  } // Stagger helpers


  function stagger(val, params) {
    if (params === void 0) params = {};
    var direction = params.direction || 'normal';
    var easing = params.easing ? parseEasings(params.easing) : null;
    var grid = params.grid;
    var axis = params.axis;
    var fromIndex = params.from || 0;
    var fromFirst = fromIndex === 'first';
    var fromCenter = fromIndex === 'center';
    var fromLast = fromIndex === 'last';
    var isRange = is.arr(val);
    var val1 = isRange ? parseFloat(val[0]) : parseFloat(val);
    var val2 = isRange ? parseFloat(val[1]) : 0;
    var unit = getUnit(isRange ? val[1] : val) || 0;
    var start = params.start || 0 + (isRange ? val1 : 0);
    var values = [];
    var maxValue = 0;
    return function (el, i, t) {
      if (fromFirst) {
        fromIndex = 0;
      }

      if (fromCenter) {
        fromIndex = (t - 1) / 2;
      }

      if (fromLast) {
        fromIndex = t - 1;
      }

      if (!values.length) {
        for (var index = 0; index < t; index++) {
          if (!grid) {
            values.push(Math.abs(fromIndex - index));
          } else {
            var fromX = !fromCenter ? fromIndex % grid[0] : (grid[0] - 1) / 2;
            var fromY = !fromCenter ? Math.floor(fromIndex / grid[0]) : (grid[1] - 1) / 2;
            var toX = index % grid[0];
            var toY = Math.floor(index / grid[0]);
            var distanceX = fromX - toX;
            var distanceY = fromY - toY;
            var value = Math.sqrt(distanceX * distanceX + distanceY * distanceY);

            if (axis === 'x') {
              value = -distanceX;
            }

            if (axis === 'y') {
              value = -distanceY;
            }

            values.push(value);
          }

          maxValue = Math.max.apply(Math, values);
        }

        if (easing) {
          values = values.map(function (val) {
            return easing(val / maxValue) * maxValue;
          });
        }

        if (direction === 'reverse') {
          values = values.map(function (val) {
            return axis ? val < 0 ? val * -1 : -val : Math.abs(maxValue - val);
          });
        }
      }

      var spacing = isRange ? (val2 - val1) / maxValue : val1;
      return start + spacing * (Math.round(values[i] * 100) / 100) + unit;
    };
  } // Timeline


  function timeline(params) {
    if (params === void 0) params = {};
    var tl = anime(params);
    tl.duration = 0;

    tl.add = function (instanceParams, timelineOffset) {
      var tlIndex = activeInstances.indexOf(tl);
      var children = tl.children;

      if (tlIndex > -1) {
        activeInstances.splice(tlIndex, 1);
      }

      function passThrough(ins) {
        ins.passThrough = true;
      }

      for (var i = 0; i < children.length; i++) {
        passThrough(children[i]);
      }

      var insParams = mergeObjects(instanceParams, replaceObjectProps(defaultTweenSettings, params));
      insParams.targets = insParams.targets || params.targets;
      var tlDuration = tl.duration;
      insParams.autoplay = false;
      insParams.direction = tl.direction;
      insParams.timelineOffset = is.und(timelineOffset) ? tlDuration : getRelativeValue(timelineOffset, tlDuration);
      passThrough(tl);
      tl.seek(insParams.timelineOffset);
      var ins = anime(insParams);
      passThrough(ins);
      children.push(ins);
      var timings = getInstanceTimings(children, params);
      tl.delay = timings.delay;
      tl.endDelay = timings.endDelay;
      tl.duration = timings.duration;
      tl.seek(0);
      tl.reset();

      if (tl.autoplay) {
        tl.play();
      }

      return tl;
    };

    return tl;
  }

  anime.version = '3.2.1';
  anime.speed = 1; // TODO:#review: naming, documentation

  anime.suspendWhenDocumentHidden = true;
  anime.running = activeInstances;
  anime.remove = removeTargetsFromActiveInstances;
  anime.get = getOriginalTargetValue;
  anime.set = setTargetsValue;
  anime.convertPx = convertPxToUnit;
  anime.path = getPath;
  anime.setDashoffset = setDashoffset;
  anime.stagger = stagger;
  anime.timeline = timeline;
  anime.easing = parseEasings;
  anime.penner = penner;

  anime.random = function (min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
  };

  function button_effect() {
    var buttonEls = document.querySelectorAll('.btn-effect');
    buttonEls.forEach(function (btn) {
      function animateButton(scale, duration, elasticity) {
        anime.remove(btn);
        anime({
          targets: btn,
          scale: scale,
          duration: duration,
          elasticity: elasticity
        });
      }

      function enterButton() {
        animateButton(1.025, 800, 400);
      }

      function leaveButton() {
        animateButton(1.0, 600, 300);
      }

      btn.addEventListener('mouseenter', enterButton);
      btn.addEventListener('mouseleave', leaveButton);
    });
  }

  /*! modernizr 3.2.0 (Custom Build) | MIT *
   * http://modernizr.com/download/?-cssanimations-prefixed !*/
  !function (e, n, t) {
    function r(e, n) {
      return _typeof(e) === n;
    }

    function o() {
      var e, n, t, o, i, s, a;

      for (var f in C) {
        if (C.hasOwnProperty(f)) {
          if (e = [], n = C[f], n.name && (e.push(n.name.toLowerCase()), n.options && n.options.aliases && n.options.aliases.length)) for (t = 0; t < n.options.aliases.length; t++) {
            e.push(n.options.aliases[t].toLowerCase());
          }

          for (o = r(n.fn, "function") ? n.fn() : n.fn, i = 0; i < e.length; i++) {
            s = e[i], a = s.split("."), 1 === a.length ? Modernizr[a[0]] = o : (!Modernizr[a[0]] || Modernizr[a[0]] instanceof Boolean || (Modernizr[a[0]] = new Boolean(Modernizr[a[0]])), Modernizr[a[0]][a[1]] = o), g.push((o ? "" : "no-") + a.join("-"));
          }
        }
      }
    }

    function i(e) {
      var n = w.className,
          t = Modernizr._config.classPrefix || "";

      if (x && (n = n.baseVal), Modernizr._config.enableJSClass) {
        var r = new RegExp("(^|\\s)" + t + "no-js(\\s|$)");
        n = n.replace(r, "$1" + t + "js$2");
      }

      Modernizr._config.enableClasses && (n += " " + t + e.join(" " + t), x ? w.className.baseVal = n : w.className = n);
    }

    function s(e) {
      return e.replace(/([a-z])-([a-z])/g, function (e, n, t) {
        return n + t.toUpperCase();
      }).replace(/^-/, "");
    }

    function a(e, n) {
      return !!~("" + e).indexOf(n);
    }

    function f() {
      return "function" != typeof n.createElement ? n.createElement(arguments[0]) : x ? n.createElementNS.call(n, "http://www.w3.org/2000/svg", arguments[0]) : n.createElement.apply(n, arguments);
    }

    function l(e, n) {
      return function () {
        return e.apply(n, arguments);
      };
    }

    function u(e, n, t) {
      var o;

      for (var i in e) {
        if (e[i] in n) return t === !1 ? e[i] : (o = n[e[i]], r(o, "function") ? l(o, t || n) : o);
      }

      return !1;
    }

    function p(e) {
      return e.replace(/([A-Z])/g, function (e, n) {
        return "-" + n.toLowerCase();
      }).replace(/^ms-/, "-ms-");
    }

    function d() {
      var e = n.body;
      return e || (e = f(x ? "svg" : "body"), e.fake = !0), e;
    }

    function c(e, t, r, o) {
      var i,
          s,
          a,
          l,
          u = "modernizr",
          p = f("div"),
          c = d();
      if (parseInt(r, 10)) for (; r--;) {
        a = f("div"), a.id = o ? o[r] : u + (r + 1), p.appendChild(a);
      }
      return i = f("style"), i.type = "text/css", i.id = "s" + u, (c.fake ? c : p).appendChild(i), c.appendChild(p), i.styleSheet ? i.styleSheet.cssText = e : i.appendChild(n.createTextNode(e)), p.id = u, c.fake && (c.style.background = "", c.style.overflow = "hidden", l = w.style.overflow, w.style.overflow = "hidden", w.appendChild(c)), s = t(p, e), c.fake ? (c.parentNode.removeChild(c), w.style.overflow = l, w.offsetHeight) : p.parentNode.removeChild(p), !!s;
    }

    function m(n, r) {
      var o = n.length;

      if ("CSS" in e && "supports" in e.CSS) {
        for (; o--;) {
          if (e.CSS.supports(p(n[o]), r)) return !0;
        }

        return !1;
      }

      if ("CSSSupportsRule" in e) {
        for (var i = []; o--;) {
          i.push("(" + p(n[o]) + ":" + r + ")");
        }

        return i = i.join(" or "), c("@supports (" + i + ") { #modernizr { position: absolute; } }", function (e) {
          return "absolute" == getComputedStyle(e, null).position;
        });
      }

      return t;
    }

    function v(e, n, o, i) {
      function l() {
        p && (delete z.style, delete z.modElem);
      }

      if (i = r(i, "undefined") ? !1 : i, !r(o, "undefined")) {
        var u = m(e, o);
        if (!r(u, "undefined")) return u;
      }

      for (var p, d, c, v, h, y = ["modernizr", "tspan"]; !z.style;) {
        p = !0, z.modElem = f(y.shift()), z.style = z.modElem.style;
      }

      for (c = e.length, d = 0; c > d; d++) {
        if (v = e[d], h = z.style[v], a(v, "-") && (v = s(v)), z.style[v] !== t) {
          if (i || r(o, "undefined")) return l(), "pfx" == n ? v : !0;

          try {
            z.style[v] = o;
          } catch (g) {}

          if (z.style[v] != h) return l(), "pfx" == n ? v : !0;
        }
      }

      return l(), !1;
    }

    function h(e, n, t, o, i) {
      var s = e.charAt(0).toUpperCase() + e.slice(1),
          a = (e + " " + b.join(s + " ") + s).split(" ");
      return r(n, "string") || r(n, "undefined") ? v(a, n, o, i) : (a = (e + " " + N.join(s + " ") + s).split(" "), u(a, n, t));
    }

    function y(e, n, r) {
      return h(e, t, t, n, r);
    }

    var g = [],
        C = [],
        _ = {
      _version: "3.2.0",
      _config: {
        classPrefix: "",
        enableClasses: !0,
        enableJSClass: !0,
        usePrefixes: !0
      },
      _q: [],
      on: function on(e, n) {
        var t = this;
        setTimeout(function () {
          n(t[e]);
        }, 0);
      },
      addTest: function addTest(e, n, t) {
        C.push({
          name: e,
          fn: n,
          options: t
        });
      },
      addAsyncTest: function addAsyncTest(e) {
        C.push({
          name: null,
          fn: e
        });
      }
    },
        Modernizr = function Modernizr() {};

    Modernizr.prototype = _, Modernizr = new Modernizr();
    var w = n.documentElement,
        x = "svg" === w.nodeName.toLowerCase(),
        S = "Moz O ms Webkit",
        b = _._config.usePrefixes ? S.split(" ") : [];
    _._cssomPrefixes = b;

    var E = function E(n) {
      var r,
          o = prefixes.length,
          i = e.CSSRule;
      if ("undefined" == typeof i) return t;
      if (!n) return !1;
      if (n = n.replace(/^@/, ""), r = n.replace(/-/g, "_").toUpperCase() + "_RULE", r in i) return "@" + n;

      for (var s = 0; o > s; s++) {
        var a = prefixes[s],
            f = a.toUpperCase() + "_" + r;
        if (f in i) return "@-" + a.toLowerCase() + "-" + n;
      }

      return !1;
    };

    _.atRule = E;
    var N = _._config.usePrefixes ? S.toLowerCase().split(" ") : [];
    _._domPrefixes = N;
    var P = {
      elem: f("modernizr")
    };

    Modernizr._q.push(function () {
      delete P.elem;
    });

    var z = {
      style: P.elem.style
    };
    Modernizr._q.unshift(function () {
      delete z.style;
    }), _.testAllProps = h;

    _.prefixed = function (e, n, t) {
      return 0 === e.indexOf("@") ? E(e) : (-1 != e.indexOf("-") && (e = s(e)), n ? h(e, n, t) : h(e, "pfx"));
    };

    _.testAllProps = y, Modernizr.addTest("cssanimations", y("animationName", "a", !0)), o(), i(g), delete _.addTest, delete _.addAsyncTest;

    for (var T = 0; T < Modernizr._q.length; T++) {
      Modernizr._q[T]();
    }

    e.Modernizr = Modernizr;
  }(window, document);
  /*!
   * classie v1.0.1
   * class helper functions
   * from bonzo https://github.com/ded/bonzo
   * MIT license
   *
   * classie.has( elem, 'my-class' ) -> true/false
   * classie.add( elem, 'my-new-class' )
   * classie.remove( elem, 'my-unwanted-class' )
   * classie.toggle( elem, 'my-class' )
   */

  /*jshint browser: true, strict: true, undef: true, unused: true */

  /*global define: false, module: false */

  (function (window) {

    function classReg(className) {
      return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
    } // classList support for class management
    // altho to be fair, the api sucks because it won't accept multiple classes at once


    var hasClass, addClass, removeClass;

    if ("classList" in document.documentElement) {
      hasClass = function hasClass(elem, c) {
        return elem.classList.contains(c);
      };

      addClass = function addClass(elem, c) {
        elem.classList.add(c);
      };

      removeClass = function removeClass(elem, c) {
        elem.classList.remove(c);
      };
    } else {
      hasClass = function hasClass(elem, c) {
        return classReg(c).test(elem.className);
      };

      addClass = function addClass(elem, c) {
        if (!hasClass(elem, c)) {
          elem.className = elem.className + " " + c;
        }
      };

      removeClass = function removeClass(elem, c) {
        elem.className = elem.className.replace(classReg(c), " ");
      };
    }

    function toggleClass(elem, c) {
      var fn = hasClass(elem, c) ? removeClass : addClass;
      fn(elem, c);
    }

    var classie = {
      // full names
      hasClass: hasClass,
      addClass: addClass,
      removeClass: removeClass,
      toggleClass: toggleClass,
      // short names
      has: hasClass,
      add: addClass,
      remove: removeClass,
      toggle: toggleClass
    }; // transport

    if (typeof define === "function" && define.amd) {
      // AMD
      define(classie);
    } else if ((typeof exports === "undefined" ? "undefined" : _typeof(exports)) === "object") {
      // CommonJS
      module.exports = classie;
    } else {
      // browser global
      window.classie = classie;
    }
  })(window);
  /**
   * main.js
   * http://www.codrops.com
   *
   * Licensed under the MIT license.
   * http://www.opensource.org/licenses/mit-license.php
   *
   * Copyright 2015, Codrops
   * http://www.codrops.com
   */


  (function (window) {

    var support = {
      animations: Modernizr.cssanimations
    },
        animEndEventNames = {
      WebkitAnimation: "webkitAnimationEnd",
      OAnimation: "oAnimationEnd",
      msAnimation: "MSAnimationEnd",
      animation: "animationend"
    },
        animEndEventName = animEndEventNames[Modernizr.prefixed("animation")],
        onEndAnimation = function onEndAnimation(el, callback) {
      var onEndCallbackFn = function onEndCallbackFn(ev) {
        if (support.animations) {
          if (ev.target != this) return;
          this.removeEventListener(animEndEventName, onEndCallbackFn);
        }

        if (callback && typeof callback === "function") {
          callback.call();
        }
      };

      if (support.animations) {
        el.addEventListener(animEndEventName, onEndCallbackFn);
      } else {
        onEndCallbackFn();
      }
    };

    function extend(a, b) {
      for (var key in b) {
        if (b.hasOwnProperty(key)) {
          a[key] = b[key];
        }
      }

      return a;
    }

    function MLMenu(el, options) {
      this.el = el;
      this.options = extend({}, this.options);
      extend(this.options, options); // the menus (<ul>´s)

      this.menus = [].slice.call(this.el.querySelectorAll(".menu__level")); // index of current menu
      // Each level is actually a different menu so 0 is root, 1 is sub-1, 2 sub-2, etc.

      this.current_menu = 0;
      /* Determine what current menu actually is */

      var current_menu;
      this.menus.forEach(function (menuEl, pos) {
        var items = menuEl.querySelectorAll(".menu__item");
        items.forEach(function (itemEl, iPos) {
          var currentLink = itemEl.querySelector(".menu__link--current");

          if (currentLink) {
            // This is the actual menu__level that should have current
            current_menu = pos;
          }
        });
      });

      if (current_menu) {
        this.current_menu = current_menu;
      }

      this._init();
    }

    MLMenu.prototype.options = {
      // show breadcrumbs
      breadcrumbsCtrl: false,
      // initial breadcrumb text
      initialBreadcrumb: "فهرست",
      // show back button
      backCtrl: true,
      // delay between each menu item sliding animation
      itemsDelayInterval: 60,
      // direction
      direction: "r2l",
      // callback: item that doesn´t have a submenu gets clicked
      // onItemClick([event], [inner HTML of the clicked item])
      onItemClick: function onItemClick(ev, itemName) {
        return false;
      }
    };

    MLMenu.prototype._init = function () {
      // iterate the existing menus and create an array of menus,
      // more specifically an array of objects where each one holds the info of each menu element and its menu items
      this.menusArr = [];
      this.breadCrumbs = false;
      var self = this;
      var submenus = [];
      /* Loops over root level menu items */

      this.menus.forEach(function (menuEl, pos) {
        var menu = {
          menuEl: menuEl,
          menuItems: [].slice.call(menuEl.querySelectorAll(".menu__item"))
        };
        self.menusArr.push(menu); // set current menu class

        if (pos === self.current_menu) {
          classie.add(menuEl, "menu__level--current");
        }

        menuEl.getAttribute("data-menu");
        var links = menuEl.querySelectorAll(".menu__link");
        links.forEach(function (linkEl, lPos) {
          var submenu = linkEl.getAttribute("data-submenu");

          if (submenu) {
            var pushMe = {
              menu: submenu,
              name: linkEl.innerHTML
            };

            if (submenus[pos]) {
              submenus[pos].push(pushMe);
            } else {
              submenus[pos] = [];
              submenus[pos].push(pushMe);
            }
          }
        });
      });
      /* For each MENU, find their parent MENU */

      this.menus.forEach(function (menuEl, pos) {
        var menu_x = menuEl.getAttribute("data-menu");
        submenus.forEach(function (subMenuEl, menu_root) {
          subMenuEl.forEach(function (subMenuItem, subPos) {
            if (subMenuItem.menu == menu_x) {
              self.menusArr[pos].backIdx = menu_root;
              self.menusArr[pos].name = subMenuItem.name;
            }
          });
        });
      }); // create breadcrumbs

      if (self.options.breadcrumbsCtrl) {
        this.breadcrumbsCtrl = document.createElement("nav");
        this.breadcrumbsCtrl.className = "menu__breadcrumbs";
        this.breadcrumbsCtrl.setAttribute("aria-label", "You are here");
        this.el.insertBefore(this.breadcrumbsCtrl, this.el.firstChild); // add initial breadcrumb

        this._addBreadcrumb(0); // Need to add breadcrumbs for all parents of current submenu


        if (self.menusArr[self.current_menu].backIdx != 0 && self.current_menu != 0) {
          this._crawlCrumbs(self.menusArr[self.current_menu].backIdx, self.menusArr);

          this.breadCrumbs = true;
        } // Create current submenu breadcrumb


        if (self.current_menu != 0) {
          this._addBreadcrumb(self.current_menu);

          this.breadCrumbs = true;
        }
      } // create back button


      if (this.options.backCtrl) {
        this.backCtrl = document.createElement("button");

        if (this.breadCrumbs) {
          this.backCtrl.className = "menu__back";
        } else {
          this.backCtrl.className = "menu__back menu__back--hidden";
        }

        this.backCtrl.setAttribute("aria-label", "Go back");
        this.backCtrl.innerHTML = '<span class="icon icon--arrow-left"></span>';
        this.el.insertBefore(this.backCtrl, this.el.firstChild);
      } // event binding


      this._initEvents();
    };

    MLMenu.prototype._initEvents = function () {
      var self = this;

      for (var i = 0, len = this.menusArr.length; i < len; ++i) {
        this.menusArr[i].menuItems.forEach(function (item, pos) {
          if (item.querySelector("a")) {
            item.querySelector("a").addEventListener("click", function (ev) {
              var submenu = ev.target.getAttribute("data-submenu"),
                  itemName = ev.target.innerHTML,
                  subMenuEl = self.el.querySelector('ul[data-menu="' + submenu + '"]'); // check if there's a sub menu for this item

              if (submenu && subMenuEl) {
                ev.preventDefault(); // open it

                self._openSubMenu(subMenuEl, pos, itemName);
              } else {
                // add class current
                var currentlink = self.el.querySelector(".menu__link--current");

                if (currentlink) {
                  classie.remove(self.el.querySelector(".menu__link--current"), "menu__link--current");
                }

                classie.add(ev.target, "menu__link--current"); // callback

                self.options.onItemClick(ev, itemName);
              }
            });
          }
        });
      } // back navigation


      if (this.options.backCtrl) {
        this.backCtrl.addEventListener("click", function () {
          self._back();
        });
      }
    };

    MLMenu.prototype._openSubMenu = function (subMenuEl, clickPosition, subMenuName) {
      if (this.isAnimating) {
        return false;
      }

      this.isAnimating = true; // save "parent" menu index for back navigation

      this.menusArr[this.menus.indexOf(subMenuEl)].backIdx = this.current_menu; // save "parent" menu´s name

      this.menusArr[this.menus.indexOf(subMenuEl)].name = subMenuName; // current menu slides out

      this._menuOut(clickPosition); // next menu (submenu) slides in


      this._menuIn(subMenuEl, clickPosition);
    };

    MLMenu.prototype._back = function () {
      if (this.isAnimating) {
        return false;
      }

      this.isAnimating = true; // current menu slides out

      this._menuOut(); // next menu (previous menu) slides in


      var backMenu = this.menusArr[this.menusArr[this.current_menu].backIdx].menuEl;

      this._menuIn(backMenu); // remove last breadcrumb


      if (this.options.breadcrumbsCtrl) {
        this.breadcrumbsCtrl.removeChild(this.breadcrumbsCtrl.lastElementChild);
      }
    };

    MLMenu.prototype._menuOut = function (clickPosition) {
      // the current menu
      var self = this,
          currentMenu = this.menusArr[this.current_menu].menuEl,
          isBackNavigation = typeof clickPosition == "undefined" ? true : false; // slide out current menu items - first, set the delays for the items

      this.menusArr[this.current_menu].menuItems.forEach(function (item, pos) {
        item.style.WebkitAnimationDelay = item.style.animationDelay = isBackNavigation ? parseInt(pos * self.options.itemsDelayInterval) + "ms" : parseInt(Math.abs(clickPosition - pos) * self.options.itemsDelayInterval) + "ms";
      }); // animation class

      if (this.options.direction === "r2l") {
        classie.add(currentMenu, !isBackNavigation ? "animate-outToLeft" : "animate-outToRight");
      } else {
        classie.add(currentMenu, isBackNavigation ? "animate-outToLeft" : "animate-outToRight");
      }
    };

    MLMenu.prototype._menuIn = function (nextMenuEl, clickPosition) {
      var self = this,
          // the current menu
      currentMenu = this.menusArr[this.current_menu].menuEl,
          isBackNavigation = typeof clickPosition == "undefined" ? true : false,
          // index of the nextMenuEl
      nextMenuIdx = this.menus.indexOf(nextMenuEl),
          nextMenu = this.menusArr[nextMenuIdx],
          nextMenuEl = nextMenu.menuEl,
          nextMenuItems = nextMenu.menuItems,
          nextMenuItemsTotal = nextMenuItems.length; // slide in next menu items - first, set the delays for the items

      nextMenuItems.forEach(function (item, pos) {
        item.style.WebkitAnimationDelay = item.style.animationDelay = isBackNavigation ? parseInt(pos * self.options.itemsDelayInterval) + "ms" : parseInt(Math.abs(clickPosition - pos) * self.options.itemsDelayInterval) + "ms"; // we need to reset the classes once the last item animates in
        // the "last item" is the farthest from the clicked item
        // let's calculate the index of the farthest item

        var farthestIdx = clickPosition <= nextMenuItemsTotal / 2 || isBackNavigation ? nextMenuItemsTotal - 1 : 0;

        if (pos === farthestIdx) {
          onEndAnimation(item, function () {
            // reset classes
            if (self.options.direction === "r2l") {
              classie.remove(currentMenu, !isBackNavigation ? "animate-outToLeft" : "animate-outToRight");
              classie.remove(nextMenuEl, !isBackNavigation ? "animate-inFromRight" : "animate-inFromLeft");
            } else {
              classie.remove(currentMenu, isBackNavigation ? "animate-outToLeft" : "animate-outToRight");
              classie.remove(nextMenuEl, isBackNavigation ? "animate-inFromRight" : "animate-inFromLeft");
            }

            classie.remove(currentMenu, "menu__level--current");
            classie.add(nextMenuEl, "menu__level--current"); //reset current

            self.current_menu = nextMenuIdx; // control back button and breadcrumbs navigation elements

            if (!isBackNavigation) {
              // show back button
              if (self.options.backCtrl) {
                classie.remove(self.backCtrl, "menu__back--hidden");
              } // add breadcrumb


              self._addBreadcrumb(nextMenuIdx);
            } else if (self.current_menu === 0 && self.options.backCtrl) {
              // hide back button
              classie.add(self.backCtrl, "menu__back--hidden");
            } // we can navigate again..


            self.isAnimating = false; // focus retention

            nextMenuEl.focus();
          });
        }
      }); // animation class

      if (this.options.direction === "r2l") {
        classie.add(nextMenuEl, !isBackNavigation ? "animate-inFromRight" : "animate-inFromLeft");
      } else {
        classie.add(nextMenuEl, isBackNavigation ? "animate-inFromRight" : "animate-inFromLeft");
      }
    };

    MLMenu.prototype._addBreadcrumb = function (idx) {
      if (!this.options.breadcrumbsCtrl) {
        return false;
      }

      var bc = document.createElement("a");
      bc.href = "#"; // make it focusable

      bc.innerHTML = idx ? this.menusArr[idx].name : this.options.initialBreadcrumb;
      this.breadcrumbsCtrl.appendChild(bc);
      var self = this;
      bc.addEventListener("click", function (ev) {
        ev.preventDefault(); // do nothing if this breadcrumb is the last one in the list of breadcrumbs

        if (!bc.nextSibling || self.isAnimating) {
          return false;
        }

        self.isAnimating = true; // current menu slides out

        self._menuOut(); // next menu slides in


        var nextMenu = self.menusArr[idx].menuEl;

        self._menuIn(nextMenu); // remove breadcrumbs that are ahead


        var siblingNode;

        while (siblingNode = bc.nextSibling) {
          self.breadcrumbsCtrl.removeChild(siblingNode);
        }
      });
    };

    MLMenu.prototype._crawlCrumbs = function (currentMenu, menuArray) {
      if (menuArray[currentMenu].backIdx != 0) {
        this._crawlCrumbs(menuArray[currentMenu].backIdx, menuArray);
      } // create breadcrumb


      this._addBreadcrumb(currentMenu);
    };

    window.MLMenu = MLMenu;
  })(window);

  // http://paulirish.com/2011/requestanimationframe-for-smart-animating/
  // http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating
  // requestAnimationFrame polyfill by Erik Möller. fixes from Paul Irish and Tino Zijdel
  // MIT license
  (function () {
    var lastTime = 0;
    var vendors = ['ms', 'moz', 'webkit', 'o'];

    for (var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
      window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
      window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame'] || window[vendors[x] + 'CancelRequestAnimationFrame'];
    }

    if (!window.requestAnimationFrame) window.requestAnimationFrame = function (callback, element) {
      var currTime = new Date().getTime();
      var timeToCall = Math.max(0, 16 - (currTime - lastTime));
      var id = window.setTimeout(function () {
        callback(currTime + timeToCall);
      }, timeToCall);
      lastTime = currTime + timeToCall;
      return id;
    };
    if (!window.cancelAnimationFrame) window.cancelAnimationFrame = function (id) {
      clearTimeout(id);
    };
  })();

  (function (root, factory) {
    if (typeof define === "function" && define.amd) {
      define(factory);
    } else if ((typeof exports === "undefined" ? "undefined" : _typeof(exports)) === "object") {
      module.exports = factory();
    } else {
      root.ResizeSensor = factory();
    }
  })(typeof window !== 'undefined' ? window : undefined, function () {
    // Make sure it does not throw in a SSR (Server Side Rendering) situation
    if (typeof window === "undefined") {
      return null;
    } // Only used for the dirty checking, so the event callback count is limited to max 1 call per fps per sensor.
    // In combination with the event based resize sensor this saves cpu time, because the sensor is too fast and
    // would generate too many unnecessary events.


    var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || function (fn) {
      return window.setTimeout(fn, 20);
    };
    /**
     * Iterate over each of the provided element(s).
     *
     * @param {HTMLElement|HTMLElement[]} elements
     * @param {Function}                  callback
     */


    function forEachElement(elements, callback) {
      var elementsType = Object.prototype.toString.call(elements);
      var isCollectionTyped = '[object Array]' === elementsType || '[object NodeList]' === elementsType || '[object HTMLCollection]' === elementsType || '[object Object]' === elementsType || 'undefined' !== typeof jQuery && elements instanceof jQuery //jquery
      || 'undefined' !== typeof Elements && elements instanceof Elements //mootools
      ;
      var i = 0,
          j = elements.length;

      if (isCollectionTyped) {
        for (; i < j; i++) {
          callback(elements[i]);
        }
      } else {
        callback(elements);
      }
    }
    /**
     * Class for dimension change detection.
     *
     * @param {Element|Element[]|Elements|jQuery} element
     * @param {Function} callback
     *
     * @constructor
     */


    var ResizeSensor = function ResizeSensor(element, callback) {
      /**
       *
       * @constructor
       */
      function EventQueue() {
        var q = [];

        this.add = function (ev) {
          q.push(ev);
        };

        var i, j;

        this.call = function () {
          for (i = 0, j = q.length; i < j; i++) {
            q[i].call();
          }
        };

        this.remove = function (ev) {
          var newQueue = [];

          for (i = 0, j = q.length; i < j; i++) {
            if (q[i] !== ev) newQueue.push(q[i]);
          }

          q = newQueue;
        };

        this.length = function () {
          return q.length;
        };
      }
      /**
       *
       * @param {HTMLElement} element
       * @param {Function}    resized
       */


      function attachResizeEvent(element, resized) {
        if (!element) return;

        if (element.resizedAttached) {
          element.resizedAttached.add(resized);
          return;
        }

        element.resizedAttached = new EventQueue();
        element.resizedAttached.add(resized);
        element.resizeSensor = document.createElement('div');
        element.resizeSensor.className = 'resize-sensor';
        var style = 'position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;';
        var styleChild = 'position: absolute; left: 0; top: 0; transition: 0s;';
        element.resizeSensor.style.cssText = style;
        element.resizeSensor.innerHTML = '<div class="resize-sensor-expand" style="' + style + '">' + '<div style="' + styleChild + '"></div>' + '</div>' + '<div class="resize-sensor-shrink" style="' + style + '">' + '<div style="' + styleChild + ' width: 200%; height: 200%"></div>' + '</div>';
        element.appendChild(element.resizeSensor);

        if (element.resizeSensor.offsetParent !== element) {
          element.style.position = 'relative';
        }

        var expand = element.resizeSensor.childNodes[0];
        var expandChild = expand.childNodes[0];
        var shrink = element.resizeSensor.childNodes[1];
        var dirty, rafId, newWidth, newHeight;
        var lastWidth = element.offsetWidth;
        var lastHeight = element.offsetHeight;

        var reset = function reset() {
          expandChild.style.width = '100000px';
          expandChild.style.height = '100000px';
          expand.scrollLeft = 100000;
          expand.scrollTop = 100000;
          shrink.scrollLeft = 100000;
          shrink.scrollTop = 100000;
        };

        reset();

        var onResized = function onResized() {
          rafId = 0;
          if (!dirty) return;
          lastWidth = newWidth;
          lastHeight = newHeight;

          if (element.resizedAttached) {
            element.resizedAttached.call();
          }
        };

        var onScroll = function onScroll() {
          newWidth = element.offsetWidth;
          newHeight = element.offsetHeight;
          dirty = newWidth != lastWidth || newHeight != lastHeight;

          if (dirty && !rafId) {
            rafId = requestAnimationFrame(onResized);
          }

          reset();
        };

        var addEvent = function addEvent(el, name, cb) {
          if (el.attachEvent) {
            el.attachEvent('on' + name, cb);
          } else {
            el.addEventListener(name, cb);
          }
        };

        addEvent(expand, 'scroll', onScroll);
        addEvent(shrink, 'scroll', onScroll);
      }

      forEachElement(element, function (elem) {
        attachResizeEvent(elem, callback);
      });

      this.detach = function (ev) {
        ResizeSensor.detach(element, ev);
      };
    };

    ResizeSensor.detach = function (element, ev) {
      forEachElement(element, function (elem) {
        if (!elem) return;

        if (elem.resizedAttached && typeof ev == "function") {
          elem.resizedAttached.remove(ev);
          if (elem.resizedAttached.length()) return;
        }

        if (elem.resizeSensor) {
          if (elem.contains(elem.resizeSensor)) {
            elem.removeChild(elem.resizeSensor);
          }

          delete elem.resizeSensor;
          delete elem.resizedAttached;
        }
      });
    };

    return ResizeSensor;
  });

  /**
   * Sticky Sidebar JavaScript Plugin.
   * @version 3.3.1
   * @author Ahmed Bouhuolia <a.bouhuolia@gmail.com>
   * @license The MIT License (MIT)
   */
  var StickySidebar = function () {
    // ---------------------------------
    // # Define Constants
    // ---------------------------------
    //
    var EVENT_KEY = '.stickySidebar';
    var DEFAULTS = {
      /**
       * Additional top spacing of the element when it becomes sticky.
       * @type {Numeric|Function}
       */
      topSpacing: 0,

      /**
       * Additional bottom spacing of the element when it becomes sticky.
       * @type {Numeric|Function}
       */
      bottomSpacing: 0,

      /**
       * Container sidebar selector to know what the beginning and end of sticky element.
       * @type {String|False}
       */
      containerSelector: false,

      /**
       * Inner wrapper selector.
       * @type {String}
       */
      innerWrapperSelector: '.inner-wrapper-sticky',

      /**
       * The name of CSS class to apply to elements when they have become stuck.
       * @type {String|False}
       */
      stickyClass: 'is-affixed',

      /**
       * Detect when sidebar and its container change height so re-calculate their dimensions.
       * @type {Boolean}
       */
      resizeSensor: true,

      /**
       * The sidebar returns to its normal position if its width below this value.
       * @type {Numeric}
       */
      minWidth: false
    }; // ---------------------------------
    // # Class Definition
    // ---------------------------------
    //

    /**
     * Sticky Sidebar Class.
     * @public
     */

    var StickySidebar = /*#__PURE__*/function () {
      /**
       * Sticky Sidebar Constructor.
       * @constructor
       * @param {HTMLElement|String} sidebar - The sidebar element or sidebar selector.
       * @param {Object} options - The options of sticky sidebar.
       */
      function StickySidebar(sidebar) {
        var _this = this;

        var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

        _classCallCheck(this, StickySidebar);

        this.options = StickySidebar.extend(DEFAULTS, options); // Sidebar element query if there's no one, throw error.

        this.sidebar = 'string' === typeof sidebar ? document.querySelector(sidebar) : sidebar;
        if ('undefined' === typeof this.sidebar) throw new Error("There is no specific sidebar element.");
        this.sidebarInner = false;
        this.container = this.sidebar.parentElement; // Current Affix Type of sidebar element.

        this.affixedType = 'STATIC';
        this.direction = 'down';
        this.support = {
          transform: false,
          transform3d: false
        };
        this._initialized = false;
        this._reStyle = false;
        this._breakpoint = false;
        this._resizeListeners = []; // Dimensions of sidebar, container and screen viewport.

        this.dimensions = {
          translateY: 0,
          topSpacing: 0,
          lastTopSpacing: 0,
          bottomSpacing: 0,
          lastBottomSpacing: 0,
          sidebarHeight: 0,
          sidebarWidth: 0,
          containerTop: 0,
          containerHeight: 0,
          viewportHeight: 0,
          viewportTop: 0,
          lastViewportTop: 0
        }; // Bind event handlers for referencability.

        ['handleEvent'].forEach(function (method) {
          _this[method] = _this[method].bind(_this);
        }); // Initialize sticky sidebar for first time.

        this.initialize();
      }
      /**
       * Initializes the sticky sidebar by adding inner wrapper, define its container, 
       * min-width breakpoint, calculating dimensions, adding helper classes and inline style.
       * @private
       */


      _createClass(StickySidebar, [{
        key: "initialize",
        value: function initialize() {
          var _this2 = this;

          this._setSupportFeatures(); // Get sticky sidebar inner wrapper, if not found, will create one.


          if (this.options.innerWrapperSelector) {
            this.sidebarInner = this.sidebar.querySelector(this.options.innerWrapperSelector);
            if (null === this.sidebarInner) this.sidebarInner = false;
          }

          if (!this.sidebarInner) {
            var wrapper = document.createElement('div');
            wrapper.setAttribute('class', 'inner-wrapper-sticky');
            this.sidebar.appendChild(wrapper);

            while (this.sidebar.firstChild != wrapper) {
              wrapper.appendChild(this.sidebar.firstChild);
            }

            this.sidebarInner = this.sidebar.querySelector('.inner-wrapper-sticky');
          } // Container wrapper of the sidebar.


          if (this.options.containerSelector) {
            var containers = document.querySelectorAll(this.options.containerSelector);
            containers = Array.prototype.slice.call(containers);
            containers.forEach(function (container, item) {
              if (!container.contains(_this2.sidebar)) return;
              _this2.container = container;
            });
            if (!containers.length) throw new Error("The container does not contains on the sidebar.");
          } // If top/bottom spacing is not function parse value to integer.


          if ('function' !== typeof this.options.topSpacing) this.options.topSpacing = parseInt(this.options.topSpacing) || 0;
          if ('function' !== typeof this.options.bottomSpacing) this.options.bottomSpacing = parseInt(this.options.bottomSpacing) || 0; // Breakdown sticky sidebar if screen width below `options.minWidth`.

          this._widthBreakpoint(); // Calculate dimensions of sidebar, container and viewport.


          this.calcDimensions(); // Affix sidebar in proper position.

          this.stickyPosition(); // Bind all events.

          this.bindEvents(); // Inform other properties the sticky sidebar is initialized.

          this._initialized = true;
        }
        /**
         * Bind all events of sticky sidebar plugin.
         * @protected
         */

      }, {
        key: "bindEvents",
        value: function bindEvents() {
          window.addEventListener('resize', this, {
            passive: true,
            capture: false
          });
          window.addEventListener('scroll', this, {
            passive: true,
            capture: false
          });
          this.sidebar.addEventListener('update' + EVENT_KEY, this);

          if (this.options.resizeSensor && 'undefined' !== typeof ResizeSensor) {
            new ResizeSensor(this.sidebarInner, this.handleEvent);
            new ResizeSensor(this.container, this.handleEvent);
          }
        }
        /**
         * Handles all events of the plugin.
         * @param {Object} event - Event object passed from listener.
         */

      }, {
        key: "handleEvent",
        value: function handleEvent(event) {
          this.updateSticky(event);
        }
        /**
         * Calculates dimensions of sidebar, container and screen viewpoint
         * @public
         */

      }, {
        key: "calcDimensions",
        value: function calcDimensions() {
          if (this._breakpoint) return;
          var dims = this.dimensions; // Container of sticky sidebar dimensions.

          dims.containerTop = StickySidebar.offsetRelative(this.container).top;
          dims.containerHeight = this.container.clientHeight;
          dims.containerBottom = dims.containerTop + dims.containerHeight; // Sidebar dimensions.

          dims.sidebarHeight = this.sidebarInner.offsetHeight;
          dims.sidebarWidth = this.sidebar.offsetWidth; // Screen viewport dimensions.

          dims.viewportHeight = window.innerHeight;

          this._calcDimensionsWithScroll();
        }
        /**
         * Some dimensions values need to be up-to-date when scrolling the page.
         * @private
         */

      }, {
        key: "_calcDimensionsWithScroll",
        value: function _calcDimensionsWithScroll() {
          var dims = this.dimensions;
          dims.sidebarLeft = StickySidebar.offsetRelative(this.sidebar).left;
          dims.viewportTop = document.documentElement.scrollTop || document.body.scrollTop;
          dims.viewportBottom = dims.viewportTop + dims.viewportHeight;
          dims.viewportLeft = document.documentElement.scrollLeft || document.body.scrollLeft;
          dims.topSpacing = this.options.topSpacing;
          dims.bottomSpacing = this.options.bottomSpacing;
          if ('function' === typeof dims.topSpacing) dims.topSpacing = parseInt(dims.topSpacing(this.sidebar)) || 0;
          if ('function' === typeof dims.bottomSpacing) dims.bottomSpacing = parseInt(dims.bottomSpacing(this.sidebar)) || 0;

          if ('VIEWPORT-TOP' === this.affixedType) {
            // Adjust translate Y in the case decrease top spacing value.
            if (dims.topSpacing < dims.lastTopSpacing) {
              dims.translateY += dims.lastTopSpacing - dims.topSpacing;
              this._reStyle = true;
            }
          } else if ('VIEWPORT-BOTTOM' === this.affixedType) {
            // Adjust translate Y in the case decrease bottom spacing value.
            if (dims.bottomSpacing < dims.lastBottomSpacing) {
              dims.translateY += dims.lastBottomSpacing - dims.bottomSpacing;
              this._reStyle = true;
            }
          }

          dims.lastTopSpacing = dims.topSpacing;
          dims.lastBottomSpacing = dims.bottomSpacing;
        }
        /**
         * Determine whether the sidebar is bigger than viewport.
         * @public
         * @return {Boolean}
         */

      }, {
        key: "isSidebarFitsViewport",
        value: function isSidebarFitsViewport() {
          return this.dimensions.sidebarHeight < this.dimensions.viewportHeight;
        }
        /**
         * Observe browser scrolling direction top and down.
         */

      }, {
        key: "observeScrollDir",
        value: function observeScrollDir() {
          var dims = this.dimensions;
          if (dims.lastViewportTop === dims.viewportTop) return;
          var furthest = 'down' === this.direction ? Math.min : Math.max; // If the browser is scrolling not in the same direction.

          if (dims.viewportTop === furthest(dims.viewportTop, dims.lastViewportTop)) this.direction = 'down' === this.direction ? 'up' : 'down';
        }
        /**
         * Gets affix type of sidebar according to current scrollTop and scrollLeft.
         * Holds all logical affix of the sidebar when scrolling up and down and when sidebar 
         * is bigger than viewport and vice versa.
         * @public
         * @return {String|False} - Proper affix type.
         */

      }, {
        key: "getAffixType",
        value: function getAffixType() {
          var dims = this.dimensions,
              affixType = false;

          this._calcDimensionsWithScroll();

          var sidebarBottom = dims.sidebarHeight + dims.containerTop;
          var colliderTop = dims.viewportTop + dims.topSpacing;
          var colliderBottom = dims.viewportBottom - dims.bottomSpacing; // When browser is scrolling top.

          if ('up' === this.direction) {
            if (colliderTop <= dims.containerTop) {
              dims.translateY = 0;
              affixType = 'STATIC';
            } else if (colliderTop <= dims.translateY + dims.containerTop) {
              dims.translateY = colliderTop - dims.containerTop;
              affixType = 'VIEWPORT-TOP';
            } else if (!this.isSidebarFitsViewport() && dims.containerTop <= colliderTop) {
              affixType = 'VIEWPORT-UNBOTTOM';
            } // When browser is scrolling up.

          } else {
            // When sidebar element is not bigger than screen viewport.
            if (this.isSidebarFitsViewport()) {
              if (dims.sidebarHeight + colliderTop >= dims.containerBottom) {
                dims.translateY = dims.containerBottom - sidebarBottom;
                affixType = 'CONTAINER-BOTTOM';
              } else if (colliderTop >= dims.containerTop) {
                dims.translateY = colliderTop - dims.containerTop;
                affixType = 'VIEWPORT-TOP';
              } // When sidebar element is bigger than screen viewport.

            } else {
              if (dims.containerBottom <= colliderBottom) {
                dims.translateY = dims.containerBottom - sidebarBottom;
                affixType = 'CONTAINER-BOTTOM';
              } else if (sidebarBottom + dims.translateY <= colliderBottom) {
                dims.translateY = colliderBottom - sidebarBottom;
                affixType = 'VIEWPORT-BOTTOM';
              } else if (dims.containerTop + dims.translateY <= colliderTop) {
                affixType = 'VIEWPORT-UNBOTTOM';
              }
            }
          } // Make sure the translate Y is not bigger than container height.


          dims.translateY = Math.max(0, dims.translateY);
          dims.translateY = Math.min(dims.containerHeight, dims.translateY);
          dims.lastViewportTop = dims.viewportTop;
          return affixType;
        }
        /**
         * Gets inline style of sticky sidebar wrapper and inner wrapper according 
         * to its affix type.
         * @private
         * @param {String} affixType - Affix type of sticky sidebar.
         * @return {Object}
         */

      }, {
        key: "_getStyle",
        value: function _getStyle(affixType) {
          if ('undefined' === typeof affixType) return;
          var style = {
            inner: {},
            outer: {}
          };
          var dims = this.dimensions;

          switch (affixType) {
            case 'VIEWPORT-TOP':
              style.inner = {
                position: 'fixed',
                top: dims.topSpacing,
                left: dims.sidebarLeft - dims.viewportLeft,
                width: dims.sidebarWidth
              };
              break;

            case 'VIEWPORT-BOTTOM':
              style.inner = {
                position: 'fixed',
                top: 'auto',
                left: dims.sidebarLeft,
                bottom: dims.bottomSpacing,
                width: dims.sidebarWidth
              };
              break;

            case 'CONTAINER-BOTTOM':
            case 'VIEWPORT-UNBOTTOM':
              var translate = this._getTranslate(0, dims.translateY + 'px');

              if (translate) style.inner = {
                transform: translate
              };else style.inner = {
                position: 'absolute',
                top: dims.translateY,
                width: dims.sidebarWidth
              };
              break;
          }

          switch (affixType) {
            case 'VIEWPORT-TOP':
            case 'VIEWPORT-BOTTOM':
            case 'VIEWPORT-UNBOTTOM':
            case 'CONTAINER-BOTTOM':
              style.outer = {
                height: dims.sidebarHeight,
                position: 'relative'
              };
              break;
          }

          style.outer = StickySidebar.extend({
            height: '',
            position: ''
          }, style.outer);
          style.inner = StickySidebar.extend({
            position: 'relative',
            top: '',
            left: '',
            bottom: '',
            width: '',
            transform: this._getTranslate()
          }, style.inner);
          return style;
        }
        /**
         * Cause the sidebar to be sticky according to affix type by adding inline
         * style, adding helper class and trigger events.
         * @function
         * @protected
         * @param {string} force - Update sticky sidebar position by force.
         */

      }, {
        key: "stickyPosition",
        value: function stickyPosition(force) {
          if (this._breakpoint) return;
          force = this._reStyle || force || false;
          this.options.topSpacing;
          this.options.bottomSpacing;
          var affixType = this.getAffixType();

          var style = this._getStyle(affixType);

          if ((this.affixedType != affixType || force) && affixType) {
            var affixEvent = 'affix.' + affixType.toLowerCase().replace('viewport-', '') + EVENT_KEY;
            StickySidebar.eventTrigger(this.sidebar, affixEvent);
            if ('STATIC' === affixType) StickySidebar.removeClass(this.sidebar, this.options.stickyClass);else StickySidebar.addClass(this.sidebar, this.options.stickyClass);

            for (var key in style.outer) {
              'number' === typeof style.outer[key] ? 'px' : '';

              this.sidebar.style[key] = style.outer[key];
            }

            for (var _key in style.inner) {
              var _unit2 = 'number' === typeof style.inner[_key] ? 'px' : '';

              this.sidebarInner.style[_key] = style.inner[_key] + _unit2;
            }

            var affixedEvent = 'affixed.' + affixType.toLowerCase().replace('viewport-', '') + EVENT_KEY;
            StickySidebar.eventTrigger(this.sidebar, affixedEvent);
          } else {
            if (this._initialized) this.sidebarInner.style.left = style.inner.left;
          }

          this.affixedType = affixType;
        }
        /**
         * Breakdown sticky sidebar when window width is below `options.minWidth` value.
         * @protected
         */

      }, {
        key: "_widthBreakpoint",
        value: function _widthBreakpoint() {
          if (window.innerWidth <= this.options.minWidth) {
            this._breakpoint = true;
            this.affixedType = 'STATIC';
            this.sidebar.removeAttribute('style');
            StickySidebar.removeClass(this.sidebar, this.options.stickyClass);
            this.sidebarInner.removeAttribute('style');
          } else {
            this._breakpoint = false;
          }
        }
        /**
         * Switches between functions stack for each event type, if there's no 
         * event, it will re-initialize sticky sidebar.
         * @public
         */

      }, {
        key: "updateSticky",
        value: function updateSticky() {
          var _this3 = this;

          var event = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
          if (this._running) return;
          this._running = true;

          (function (eventType) {
            requestAnimationFrame(function () {
              switch (eventType) {
                // When browser is scrolling and re-calculate just dimensions
                // within scroll. 
                case 'scroll':
                  _this3._calcDimensionsWithScroll();

                  _this3.observeScrollDir();

                  _this3.stickyPosition();

                  break;
                // When browser is resizing or there's no event, observe width
                // breakpoint and re-calculate dimensions.

                case 'resize':
                default:
                  _this3._widthBreakpoint();

                  _this3.calcDimensions();

                  _this3.stickyPosition(true);

                  break;
              }

              _this3._running = false;
            });
          })(event.type);
        }
        /**
         * Set browser support features to the public property.
         * @private
         */

      }, {
        key: "_setSupportFeatures",
        value: function _setSupportFeatures() {
          var support = this.support;
          support.transform = StickySidebar.supportTransform();
          support.transform3d = StickySidebar.supportTransform(true);
        }
        /**
         * Get translate value, if the browser supports transfrom3d, it will adopt it.
         * and the same with translate. if browser doesn't support both return false.
         * @param {Number} y - Value of Y-axis.
         * @param {Number} x - Value of X-axis.
         * @param {Number} z - Value of Z-axis.
         * @return {String|False}
         */

      }, {
        key: "_getTranslate",
        value: function _getTranslate() {
          var y = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
          var x = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
          var z = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 0;
          if (this.support.transform3d) return 'translate3d(' + y + ', ' + x + ', ' + z + ')';else if (this.support.translate) return 'translate(' + y + ', ' + x + ')';else return false;
        }
        /**
         * Destroy sticky sidebar plugin.
         * @public
         */

      }, {
        key: "destroy",
        value: function destroy() {
          window.removeEventListener('resize', this, {
            caption: false
          });
          window.removeEventListener('scroll', this, {
            caption: false
          });
          this.sidebar.classList.remove(this.options.stickyClass);
          this.sidebar.style.minHeight = '';
          this.sidebar.removeEventListener('update' + EVENT_KEY, this);
          var styleReset = {
            inner: {},
            outer: {}
          };
          styleReset.inner = {
            position: '',
            top: '',
            left: '',
            bottom: '',
            width: '',
            transform: ''
          };
          styleReset.outer = {
            height: '',
            position: ''
          };

          for (var key in styleReset.outer) {
            this.sidebar.style[key] = styleReset.outer[key];
          }

          for (var _key2 in styleReset.inner) {
            this.sidebarInner.style[_key2] = styleReset.inner[_key2];
          }

          if (this.options.resizeSensor && 'undefined' !== typeof ResizeSensor) {
            ResizeSensor.detach(this.sidebarInner, this.handleEvent);
            ResizeSensor.detach(this.container, this.handleEvent);
          }
        }
        /**
         * Determine if the browser supports CSS transform feature.
         * @function
         * @static
         * @param {Boolean} transform3d - Detect transform with translate3d.
         * @return {String}
         */

      }], [{
        key: "supportTransform",
        value: function supportTransform(transform3d) {
          var result = false,
              property = transform3d ? 'perspective' : 'transform',
              upper = property.charAt(0).toUpperCase() + property.slice(1),
              prefixes = ['Webkit', 'Moz', 'O', 'ms'],
              support = document.createElement('support'),
              style = support.style;
          (property + ' ' + prefixes.join(upper + ' ') + upper).split(' ').forEach(function (property, i) {
            if (style[property] !== undefined) {
              result = property;
              return false;
            }
          });
          return result;
        }
        /**
         * Trigger custom event.
         * @static
         * @param {DOMObject} element - Target element on the DOM.
         * @param {String} eventName - Event name.
         * @param {Object} data - 
         */

      }, {
        key: "eventTrigger",
        value: function eventTrigger(element, eventName, data) {
          try {
            var event = new CustomEvent(eventName, {
              detail: data
            });
          } catch (e) {
            var event = document.createEvent('CustomEvent');
            event.initCustomEvent(eventName, true, true, data);
          }

          element.dispatchEvent(event);
        }
        /**
         * Extend options object with defaults.
         * @function
         * @static
         */

      }, {
        key: "extend",
        value: function extend(defaults, options) {
          var results = {};

          for (var key in defaults) {
            if ('undefined' !== typeof options[key]) results[key] = options[key];else results[key] = defaults[key];
          }

          return results;
        }
        /**
         * Get current coordinates left and top of specific element.
         * @static
         */

      }, {
        key: "offsetRelative",
        value: function offsetRelative(element) {
          var result = {
            left: 0,
            top: 0
          };

          do {
            var offsetTop = element.offsetTop;
            var offsetLeft = element.offsetLeft;
            if (!isNaN(offsetTop)) result.top += offsetTop;
            if (!isNaN(offsetLeft)) result.left += offsetLeft;
            element = 'BODY' === element.tagName ? element.parentElement : element.offsetParent;
          } while (element);

          return result;
        }
        /**
         * Add specific class name to specific element.
         * @static 
         * @param {ObjectDOM} element 
         * @param {String} className 
         */

      }, {
        key: "addClass",
        value: function addClass(element, className) {
          if (!StickySidebar.hasClass(element, className)) {
            if (element.classList) element.classList.add(className);else element.className += ' ' + className;
          }
        }
        /**
         * Remove specific class name to specific element
         * @static
         * @param {ObjectDOM} element 
         * @param {String} className 
         */

      }, {
        key: "removeClass",
        value: function removeClass(element, className) {
          if (StickySidebar.hasClass(element, className)) {
            if (element.classList) element.classList.remove(className);else element.className = element.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
          }
        }
        /**
         * Determine weather the element has specific class name.
         * @static
         * @param {ObjectDOM} element 
         * @param {String} className 
         */

      }, {
        key: "hasClass",
        value: function hasClass(element, className) {
          if (element.classList) return element.classList.contains(className);else return new RegExp('(^| )' + className + '( |$)', 'gi').test(element.className);
        }
      }]);

      return StickySidebar;
    }();

    return StickySidebar;
  }();
  // -------------------------

  window.StickySidebar = StickySidebar;

  /* eslint-disable camelcase */

  jQuery(document).ready(function () {
    //initial carousels
    offSales_carousel();
    simple_carousel();
    single_carousel();
    newProducts_carousel();
    brands_carousel();
    carousel('.carousel');
    products_carousel(); // document.querySelectorAll( '.products' ).forEach( ( product ) => {
    // 	slider.carousel( product );
    // } );
    //other functions

    cart();
    accordionCollapseHandle();
    accordionProductsHandle();
    toggle_tabs();
    smooth_scroll();
    show_rest();
    archive_category_menu();
    selectingBank();
    button_effect();
    resHeader();
    toggle_filters();
    toggle_sorting();
    share_modal();
    copy_to_clipboard();
    scroll_top();
    singleProductGap();
    scrollHighlight();
    contentTable();
    inputGenerator('.prdctfltr_search .prdctfltr_checkboxes label');

    if (window.innerWidth > 1024) {
      if (document.getElementById('filters-sidebar')) {
        new StickySidebar('#filters-sidebar', {
          containerSelector: '#main-content',
          innerWrapperSelector: '.sidebar__inner',
          topSpacing: 40,
          bottomSpacing: 40,
          resizeSensor: true
        });
      }

      if (document.querySelector('.fs-big-sidebar__inner')) {
        var bigSidebarInnerHeight = document.querySelector('.fs-big-sidebar__inner').clientHeight;
        var smallSidebarInnerHeight = document.querySelector('.fs-small-sidebar__inner').clientHeight;

        if (bigSidebarInnerHeight === smallSidebarInnerHeight) {
          return null;
        } else if (bigSidebarInnerHeight > smallSidebarInnerHeight) {
          document.querySelector('.fs-checkout-container').classList.add('is_ltr_sidebar');
          new StickySidebar('#fs-small-sidebar', {
            containerSelector: '#fs-checkout-container',
            innerWrapperSelector: '.fs-small-sidebar__inner',
            topSpacing: 40,
            bottomSpacing: 40,
            resizeSensor: true
          });
        } else {
          new StickySidebar('#fs-big-sidebar', {
            containerSelector: '#fs-checkout-container',
            innerWrapperSelector: '.fs-big-sidebar__inner',
            topSpacing: 40,
            bottomSpacing: 40,
            resizeSensor: true
          });
        }
      }
    }
  });

  function cart() {
    var content_el;
    jQuery(document).on('click', function (e) {
      if (e.target.id === 'cart') {
        e.preventDefault();
        content_el = document.querySelector('.mini-cart-content');
        document.querySelector('.mini-cart-content').classList.add('active');
      }
    });
    jQuery('#cart-2').on('click', function (e) {
      e.preventDefault();
      content_el.classList.add('active');
    });
    document.addEventListener('click', function (e) {
      if (e.target.id === "cart_overlay") {
        content_el.classList.remove('active');
      }
    });
    jQuery('#cart_close').on('click', function () {
      content_el.classList.remove('active');
    });
  }

  function accordionCollapseHandle() {
    var accordion_toggler = document.querySelectorAll('.accordion-head');
    accordion_toggler.forEach(function (accordion) {
      var accordion_body = accordion.nextElementSibling;
      if (accordion.classList.contains('active')) accordion_body.style.maxHeight = accordion_body.scrollHeight + 'px';
      accordion.addEventListener('click', function () {
        this.classList.toggle('active');
        this.parentElement.classList.toggle('active');

        if (this.parentElement.classList.contains('faq')) {
          this.querySelector('.accordion-icon').classList.toggle('icon-plus');
          this.querySelector('.accordion-icon').classList.toggle('icon-minus');
        }

        accordion_body.classList.toggle('active');
        if (this.classList.contains('active')) accordion_body.style.maxHeight = accordion_body.scrollHeight + 'px';else accordion_body.style.maxHeight = 0;
      });
    });
  }

  function accordionProductsHandle() {
    var accordion_toggler = document.querySelectorAll('.pf-help-title');
    if (!accordion_toggler) return;
    accordion_toggler.forEach(function (accordion) {
      var next_sibling_class = accordion.nextElementSibling.classList;
      var parent_class = accordion.parentElement.classList;
      if (parent_class.contains('prdctfltr_rng_price') || parent_class.contains('prdctfltr_search')) return;
      var prev_accordion_body;
      var accordion_body;

      if (next_sibling_class.contains('prdctfltr_search_terms')) {
        accordion_body = accordion.nextElementSibling.nextElementSibling;
        prev_accordion_body = accordion.nextElementSibling;
      } else {
        accordion_body = accordion.nextElementSibling;
      }

      if (accordion.classList.contains('active')) {
        if (prev_accordion_body) prev_accordion_body.style.maxHeight = prev_accordion_body.scrollHeight + 'px';
        accordion_body.style.maxHeight = accordion_body.scrollHeight + 5 + 'px';
      }

      accordion.addEventListener('click', function () {
        this.classList.toggle('active');
        this.parentElement.classList.toggle('active');
        accordion_body.classList.toggle('active');

        if (this.classList.contains('active')) {
          if (prev_accordion_body) prev_accordion_body.style.maxHeight = prev_accordion_body.scrollHeight + 'px';
          accordion_body.style.maxHeight = accordion_body.scrollHeight + 5 + 'px';
        } else {
          if (prev_accordion_body) prev_accordion_body.style.maxHeight = 0;
          accordion_body.style.maxHeight = 0;
        }
      });
    });
  }

  function toggle_tabs() {
    var des_tab_items = document.querySelectorAll('.c-tabs li'); // const des_tab = document.querySelector( '.c-tabs' );

    des_tab_items.forEach(function (tab) {
      tab.addEventListener('click', function (e) {
        e.preventDefault();
        this.closest('.c-tabs').querySelectorAll('li').forEach(function (item) {
          item.classList.remove('active');
        });
        this.classList.add('active');
        this.closest('.content-wrapper').querySelectorAll('.c-tab-content').forEach(function (content) {
          content.classList.remove('active');
          if (content.dataset.id === tab.id) content.classList.add('active');
        });
      });
    });
  }

  function smooth_scroll() {
    var links = document.querySelectorAll('.c-tab-menu li a');
    links.forEach(function (link) {
      link.addEventListener('click', function (e) {
        e.preventDefault();
        links.forEach(function (item) {
          item.parentElement.classList.remove('active');
        });
        this.parentElement.classList.add('active');
        var articleId = gettingLink(this).join('');
        var offset;

        if (link.parentElement.parentElement.classList.contains('faq')) {
          if (1024 > window.innerWidth) {
            offset = findPos(document.getElementById(articleId)) - 30;
          } else {
            offset = findPos(document.getElementById(articleId)) - 20;
          }
        } else offset = findPos(document.getElementById(articleId));

        window.scroll(0, offset);
      });
    });
  }

  function scrollHighlight() {
    var contentEls = document.querySelectorAll('.c-content-wrapper .content');
    var linkEls = document.querySelectorAll('.c-tab-menu li a');
    window.addEventListener('scroll', mainH);

    function mainH() {
      contentEls.forEach(function (content) {
        var contentPos = findPos(content) - 50;

        if (content.nextElementSibling) {
          var nextElPos = findPos(content.nextElementSibling) - 50;

          if (contentPos < window.scrollY && nextElPos > window.scrollY) {
            linkEls.forEach(function (link) {
              if (link.dataset.id === content.id) {
                link.parentElement.classList.add("active");
              } else {
                link.parentElement.classList.remove("active");
              }
            });
          } else {
            content.classList.remove("active");
          }
        } else {
          if (contentPos < window.scrollY) {
            linkEls.forEach(function (link) {
              if (link.dataset.id === content.id) {
                link.parentElement.classList.add("active");
              } else {
                link.parentElement.classList.remove("active");
              }
            });
          } else {
            content.classList.remove("active");
          }
        }
      });
    }
  }

  function findPos(obj) {
    var curtop = 0;

    if (obj.offsetParent) {
      do {
        curtop += obj.offsetTop;
      } while (obj === obj.offsetParent);

      return [curtop];
    }
  }

  function gettingLink(link) {
    var hash = link.href.split('/');
    var hash_splited = hash[hash.length - 1];
    var removehashtag = hash_splited.split('');
    removehashtag.shift();
    return removehashtag;
  }

  function show_rest() {
    var btn = document.querySelector('#show-rest');
    var content = document.querySelector('.intro-content');
    var overlay = document.querySelector('.bg-intro-overlay');
    var flag = false;

    if (btn) {
      btn.addEventListener('click', function () {
        overlay.classList.toggle('hidden');

        if (!this.classList.contains('is-active')) {
          content.style.maxHeight = content.scrollHeight + 'px';
          this.classList.toggle('is-active');
        } else {
          if (content.classList.contains('c-archive-shop-info')) content.style.maxHeight = '40rem';else content.style.maxHeight = '18rem';
          this.classList.remove('is-active');
        }

        flag = !flag;

        if (flag) {
          this.innerHTML = "\u0646\u0645\u0627\u06CC\u0634 \u06A9\u0645\u062A\u0631\n                <span class=\"icon-angle-down text-xs transform scale-50 mr-0/5 leading-0/7 h-1 flex items-center transition-transform ease-linear duration-100 transform -rotate-180\"></span>";
        } else {
          this.innerHTML = "\u0646\u0645\u0627\u06CC\u0634 \u0628\u06CC\u0634\u062A\u0631\n                <span class=\"icon-angle-down text-xs transform scale-50 mr-0/5 leading-0/7 h-1 flex items-center transform\"></span>";
        }
      });
    }
  }

  function archive_category_menu() {
    var item_has_children = document.querySelectorAll('.item-has-children');
    document.querySelectorAll('#archive-category .submenu');
    item_has_children.forEach(function (item) {
      var submenu = item.nextElementSibling;
      item.addEventListener('click', function (e) {
        e.preventDefault();
        this.closest('.accordion-body').style.maxHeight = 'unset';

        if (!this.classList.contains('is-active')) {
          if (this.closest('.submenu')) this.closest('.submenu').style.maxHeight = 'unset';
          submenu.style.maxHeight = submenu.scrollHeight + 'px';
          this.classList.add('is-active');
        } else {
          submenu.style.maxHeight = '0px';
          this.classList.remove('is-active');
        }
      });
    });
  }

  function selectingBank() {
    document.addEventListener("click", function (e) {
      if (e.target.parentElement.classList.contains("wc_payment_method")) {
        clearActive();
        e.target.parentElement.classList.add("active");
      }
    });
  }

  function clearActive() {
    var banks = document.querySelectorAll(".wc_payment_method");

    if (banks) {
      banks.forEach(function (bank) {
        bank.classList.remove("active");
      });
    }
  }

  function resHeader() {
    // mobile menu toggle
    var openMenuCtrl = document.querySelector(".action--open"),
        closeMenuCtrl = document.querySelector(".action--close"),
        mobile_header = document.getElementById("mobile-header");

    if (openMenuCtrl && closeMenuCtrl) {
      var openMenu = function openMenu() {
        openMenuCtrl.classList.toggle("active");
        mobile_header.classList.toggle("active"); // classie.add( menuEl, "menu--open" );

        menuEl.classList.toggle("menu--open");
        jQuery("#ml-menu").fadeToggle(); // closeMenuCtrl.focus();
      }; // simulate grid content loading


      openMenuCtrl.addEventListener("click", openMenu);
      closeMenuCtrl.addEventListener("click", openMenu);
      var menuEl = document.getElementById("ml-menu");
          new MLMenu(menuEl, {
        // breadcrumbsCtrl : true, // show breadcrumbs
        // initialBreadcrumb : 'all', // initial breadcrumb text
        backCtrl: true // show back button
        // itemsDelayInterval : 60, // delay between each menu item sliding animation
        //onItemClick: loadDummyData, // callback: item that doesn´t have a submenu gets clicked - onItemClick([event], [inner HTML of the clicked item])

      });
      document.querySelector(".content");
    }
  }

  function toggle_filters() {
    jQuery('#toggle-filters-open').on('click', function (e) {
      jQuery('#filters-sidebar').fadeToggle();
      document.body.style.position = 'fixed';
      document.body.style.top = "-".concat(window.scrollY, "px");
    });
    jQuery('#toggle-filters-close').on('click', function (e) {
      jQuery('#filters-sidebar').fadeToggle();
      var scrollY = document.body.style.top;
      document.body.style.position = '';
      document.body.style.top = '';
      window.scrollTo(0, parseInt(scrollY || '0') * -1);
    });

    if (jQuery(window).width() < 1023) {
      jQuery(document).on('click', function (e) {
        if (e.target.classList.contains("wcpf-title-container") || e.target.classList.contains("wcpf-title") || e.target.classList.contains("wcpf-input-checkbox") || e.target.classList.contains("wcpf-input-container")) {
          console.log('hello');
          jQuery('#filters-sidebar').fadeToggle();
          var scrollY = document.body.style.top;
          document.body.style.position = '';
          document.body.style.top = '';
          window.scrollTo(0, parseInt(scrollY || '0') * -1);
        }
      });
    }
  }

  function toggle_sorting() {
    if (window.innerWidth < 1024) {
      jQuery('#sorting-btn').on('click', function (e) {
        jQuery('#sorting-container').fadeToggle();
        document.body.style.position = 'fixed';
        document.body.style.top = "-".concat(window.scrollY, "px");
      });
      jQuery('#sorting-overlay').on('click', function (e) {
        jQuery('#sorting-container').fadeToggle();
        var scrollY = document.body.style.top;
        document.body.style.position = '';
        document.body.style.top = '';
        window.scrollTo(0, parseInt(scrollY || '0') * -1);
      });
      jQuery(document).on('click', function (e) {
        if (e.target.classList.contains("ordering-item")) {
          jQuery('#sorting-container').fadeToggle();
          var scrollY = document.body.style.top;
          document.body.style.position = '';
          document.body.style.top = '';
          window.scrollTo(0, parseInt(scrollY || '0') * -1);
        }
      });
    }
  }

  function share_modal() {
    jQuery("#share-btn").on("click", function (e) {
      e.preventDefault();
      jQuery("#share-modal").toggleClass("scale-0");
      jQuery("#share-modal .share-popup").toggleClass("scale-0");
    });
    jQuery(".modal-bg").on("click", function () {
      jQuery("#share-modal").toggleClass("scale-0");
      jQuery("#share-modal .share-popup").toggleClass("scale-0");
    });
    jQuery(".close-share").on("click", function () {
      jQuery("#share-modal").toggleClass("scale-0");
      jQuery("#share-modal .share-popup").toggleClass("scale-0");
    });
  }

  function copy_to_clipboard() {
    jQuery('.share-copy').on('click', function (e) {
      e.preventDefault();
      var copyText = document.querySelector('.share-input');
      copyText.select();
      copyText.setSelectionRange(0, 99999);
      /* For mobile devices */

      /* Copy the text inside the text field */

      document.execCommand('copy');
      /* Alert the copied text */

      jQuery('.confirm-alert').removeClass('hidden');
    });
  }

  function scroll_top() {
    document.addEventListener("click", function (e) {
      document.querySelectorAll(".pagination-con a").forEach(function (item) {
        if (e.target === item) {
          if (!e.target.classList.contains("active")) {
            if (!e.target.classList.contains('disabled')) {
              window.scrollTo({
                top: findPos(document.querySelector(".products")) - 150,
                left: 0,
                behavior: 'smooth'
              });
            }
          }
        }
      });
      document.querySelectorAll(".pagination-con a span").forEach(function (item) {
        if (e.target === item) {
          if (!e.target.parentElement.classList.contains('disabled')) {
            window.scrollTo({
              top: findPos(document.querySelector(".products")) - 150,
              left: 0,
              behavior: 'smooth'
            });
          }
        }
      });
    });

    function findPos(obj) {
      var curtop = 0;

      if (obj.offsetParent) {
        do {
          curtop += obj.offsetTop;
        } while (obj === obj.offsetParent);

        return [curtop];
      }
    }
  }

  function singleProductGap() {
    var el = document.querySelector('.mt-21');

    if (el != null) {
      var codeEl = document.querySelector('.product-code');
      var listHeight = document.querySelector('.features-top').scrollHeight;

      if (document.querySelector('.fs-features-list') && window.innerWidth < 1023) {
        el.style.marginTop = listHeight + 50 + 'px';
        codeEl.style.bottom = listHeight + 40 + 'px';
      } else {
        el.style.marginTop = '7.5rem';
        codeEl.style.bottom = '5rem';
      }
    }
  } //======================================================================
  // content table
  //======================================================================


  function contentTable() {
    var contents = document.querySelectorAll('.mag-single .content-container');
    if (!contents) return;
    contents.forEach(function (content) {
      var contentBody = content.querySelector('.content-list');
      content.previousElementSibling.addEventListener('click', function () {
        content.parentElement.classList.toggle('active');

        if (content.parentElement.classList.contains('active')) {
          content.style.maxHeight = contentBody.scrollHeight + 'px';
        } else {
          content.style.maxHeight = 0;
        }
      });
    });
  } //======================================================================
  // creating input
  //======================================================================


  function inputGenerator(container) {
    var containerEl = document.querySelector(container);
    if (!containerEl) return;
    var inputElTemplate = " <input type=\"hidden\" name=\"type\" value=\"product\" /> ";
    containerEl.insertAdjacentHTML('beforeend', inputElTemplate);
  }

})));

(function (factory) {
	typeof define === 'function' && define.amd ? define('woocommerce', factory) :
	factory();
}((function () { 'use strict';

	(function ($) {
	  jQuery(document).on('click', '.input-quantity .plus', function (e) {
	    var input = jQuery(this).siblings('input.qty'),
	        val = parseInt(input.val()),
	        step = input.attr('step');
	    step = 'undefined' !== typeof step ? parseInt(step) : 1;
	    input.val(val + step).change();
	  });
	  jQuery(document).on('click', '.input-quantity .minus', function (e) {
	    var input = jQuery(this).siblings('input.qty'),
	        val = parseInt(input.val()),
	        step = input.attr('step');
	    step = 'undefined' !== typeof step ? parseInt(step) : 1;
	    if (val > 0) input.val(val - step).change();
	  });
	  jQuery('body').trigger('update_checkout');
	})(jQuery);

})));
