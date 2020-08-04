(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
'use strict';

(function () {
  // header scroll
  document.addEventListener('scroll', function () {
    var scroll = window.pageYOffset || document.documentElement.scrollTop;
    var header = document.querySelector('header.header');
    if (!header.classList.contains('header-scroll')) return;
    if (scroll >= 100) {
      header.classList.add('header-white');
    } else {
      header.classList.remove('header-white');
    }
  });

  // header mobile
  var menuToggle = document.querySelector('.toggle-menu');
  if (menuToggle) {
    menuToggle.addEventListener('click', function (e) {
      e.preventDefault();
      var menu = document.querySelector('.header-menu');
      if (!menu) return;
      if (!this.classList.contains('open')) {
        this.classList.add('open');
        menu.classList.add('open');
      } else {
        this.classList.remove('open');
        menu.classList.remove('open');
      }
    });
  }

  // swiper slider
  try {
    var sliderContainer = document.querySelectorAll('.swiper-container');
    if (sliderContainer.length > 0) {
      sliderContainer.forEach(function (el) {
        var parentArrow = el.closest('.swiper-arrow__wrapper');
        var next = parentArrow ? parentArrow.querySelector('.swiper-button-next') : null;
        var prev = parentArrow ? parentArrow.querySelector('.swiper-button-prev') : null;
        var pagination = el.querySelector('.swiper-pagination');
        var items = el.dataset.items;
        var space = el.dataset.space;
        var display = el.dataset.display;

        var swiper = new Swiper(el, {
          pagination: {
            el: pagination ? pagination : null,
            clickable: true
          },
          navigation: {
            nextEl: next ? next : null,
            prevEl: prev ? prev : null
          },
          slidesPerView: items ? Number(items) : 1,
          spaceBetween: space ? Number(space) : 0,
          on: {
            init: function init(e) {
              if (display == 'none') {
                parentArrow ? parentArrow.style.display = 'none' : el.style.display = 'none';
              }
            }
          }
        });
      });
    }
  } catch (error) {
    console.warn('this page not load swiperjs');
  }

  // event toggle
  var eventToggleAll = document.querySelectorAll('.event-toggle__item');
  if (eventToggleAll.length > 0) {
    var _iteratorNormalCompletion = true;
    var _didIteratorError = false;
    var _iteratorError = undefined;

    try {
      for (var _iterator = eventToggleAll[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
        var eventToggle = _step.value;

        eventToggle.addEventListener('click', function (e) {
          e.preventDefault();

          if (this.classList.contains('active')) return;

          var target = this.dataset.target;
          var targetEl = target ? document.querySelector(target) : null;
          var activeToggle = this.parentNode.querySelector('.event-toggle__item.active');
          var activeTarget = activeToggle.dataset.target;
          var activeEl = activeTarget ? document.querySelector(activeTarget) : null;

          this.classList.add('active');
          activeToggle.classList.remove('active');
          if (activeEl) fadeOut(activeEl, function () {
            if (targetEl) fadeIn(targetEl);
          });
        });
      }
    } catch (err) {
      _didIteratorError = true;
      _iteratorError = err;
    } finally {
      try {
        if (!_iteratorNormalCompletion && _iterator.return) {
          _iterator.return();
        }
      } finally {
        if (_didIteratorError) {
          throw _iteratorError;
        }
      }
    }
  }

  var fadeSpd = 0.050;
  function fadeIn(e, display) {
    e.style.opacity = 0, e.style.display = display || "block", function fade(val) {
      val = parseFloat(e.style.opacity);
      if (!((val += fadeSpd) > 1)) e.style.opacity = val, requestAnimationFrame(fade);
    }();
  }
  function fadeOut(e, callback) {
    e.style.opacity = 1;
    (function fade() {
      if ((e.style.opacity -= fadeSpd) < 0) {
        e.style.display = "none";
        if (typeof callback == 'function') callback();
      } else {
        requestAnimationFrame(fade);
      }
    })();
  }
})();

},{}]},{},[1]);
