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

  // dropdown toggle
  var allToggle = document.querySelectorAll('.dropdown-toggle');
  if (allToggle.length > 0) {
    var _iteratorNormalCompletion = true;
    var _didIteratorError = false;
    var _iteratorError = undefined;

    try {
      for (var _iterator = allToggle[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
        var toggle = _step.value;

        toggle.addEventListener('click', function (e) {
          e.preventDefault();

          var dropdownMenu = this.nextElementSibling;
          if (!dropdownMenu.classList.contains('dropdown-menu')) return;

          if (!dropdownMenu.classList.contains('open')) {
            dropdownMenu.classList.add('open');
          } else {
            dropdownMenu.classList.remove('open');
          }
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

  // swiper slider
  try {
    var sliderContainer = document.querySelectorAll('.js-swiper');
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
          slidesPerView: 1,
          spaceBetween: 0,
          on: {
            init: function init(e) {
              if (display == 'none') {
                parentArrow ? parentArrow.style.display = 'none' : el.style.display = 'none';
              }
            }
          },
          breakpoints: {
            576: {
              slidesPerView: items >= 2 ? 2 : 1,
              spaceBetween: space ? 20 : 0,
              centeredSlides: false
            },
            768: {
              slidesPerView: items >= 3 ? 3 : items,
              spaceBetween: space >= 30 ? 30 : space
            },
            992: {
              slidesPerView: items ? Number(items) : 1,
              spaceBetween: space ? space : 0
            }
          }
        });
      });
    }

    var sliderProductThumb = document.querySelector('.product-gallery__thumbs');
    var sliderProduct = document.querySelector('.product-gallery__top');
    if (sliderProduct && sliderProductThumb) {
      var productSliderThumb = new Swiper(sliderProductThumb, {
        spaceBetween: 20,
        slidesPerView: 4
      });
      var productSlider = new Swiper(sliderProduct, {
        spaceBetween: 10,
        thumbs: {
          swiper: productSliderThumb
        }
      });
    }
  } catch (error) {
    console.warn('this page not load swiperjs');
  }

  // event toggle
  var eventToggleAll = document.querySelectorAll('.event-toggle__item');
  if (eventToggleAll.length > 0) {
    var _iteratorNormalCompletion2 = true;
    var _didIteratorError2 = false;
    var _iteratorError2 = undefined;

    try {
      for (var _iterator2 = eventToggleAll[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
        var eventToggle = _step2.value;

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
      _didIteratorError2 = true;
      _iteratorError2 = err;
    } finally {
      try {
        if (!_iteratorNormalCompletion2 && _iterator2.return) {
          _iterator2.return();
        }
      } finally {
        if (_didIteratorError2) {
          throw _iteratorError2;
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

  // input number
  var allInputWrapper = document.querySelectorAll('.add-cart__count');
  if (allInputWrapper.length > 0) {
    var _iteratorNormalCompletion3 = true;
    var _didIteratorError3 = false;
    var _iteratorError3 = undefined;

    try {
      var _loop = function _loop() {
        var inputWrapper = _step3.value;

        var plus = inputWrapper.querySelector('.plus');
        var minus = inputWrapper.querySelector('.minus');
        var input = inputWrapper.querySelector('.input');

        if (!input) return 'continue';

        plus && plus.addEventListener('click', function (e) {
          e.preventDefault();
          var newValue = Number(input.value) + 1;
          var max = Number(input.max);

          if (max && newValue > max) return;
          input.value = newValue;
        });

        minus && minus.addEventListener('click', function (e) {
          e.preventDefault();
          var newValue = Number(input.value) - 1;
          var min = Number(input.min);

          if (min && newValue < min) return;
          input.value = newValue;
        });
      };

      for (var _iterator3 = allInputWrapper[Symbol.iterator](), _step3; !(_iteratorNormalCompletion3 = (_step3 = _iterator3.next()).done); _iteratorNormalCompletion3 = true) {
        var _ret = _loop();

        if (_ret === 'continue') continue;
      }
    } catch (err) {
      _didIteratorError3 = true;
      _iteratorError3 = err;
    } finally {
      try {
        if (!_iteratorNormalCompletion3 && _iterator3.return) {
          _iterator3.return();
        }
      } finally {
        if (_didIteratorError3) {
          throw _iteratorError3;
        }
      }
    }
  }

  window.customHelper = {
    formatMoney: function formatMoney(amount) {
      var decimalCount = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 2;
      var decimal = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : ".";
      var thousands = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : ",";

      try {
        decimalCount = Math.abs(decimalCount);
        decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

        var negativeSign = amount < 0 ? "-" : "";

        var i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
        var j = i.length > 3 ? i.length % 3 : 0;

        return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
      } catch (e) {
        console.log(e);
      }
    }

    // instagram feed fetch
    // const igContainer = document.querySelectorAll('.ig-feed');
    // if (igContainer.length > 0) {
    //   for (const container of igContainer) {
    //     const url = container.dataset.url;
    //     let xhr = new XMLHttpRequest();
    //     xhr.open(
    //       'GET',
    //       url
    //     );
    //     xhr.onload = function() {
    //       if ( xhr.status === 200 ) {
    //         try {
    //           console.log(xhr.response);
    //           // const res = JSON.parse(xhr.response);
    //         } catch (err) {
    //           console.log(err);
    //         }
    //       }
    //     }
    //     xhr.send();
    //   }
    // }

  };MicroModal.init();
})();

},{}]},{},[1]);
