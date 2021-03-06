(function() {
  // header scroll
  document.addEventListener('scroll', function() {
    const scroll = window.pageYOffset || document.documentElement.scrollTop;
    const header = document.querySelector('header.header');
    if (!header.classList.contains('header-scroll')) return;
    if (scroll >= 100) {
      header.classList.add('header-white');
    } else {
      header.classList.remove('header-white');
    }
  })

  // header mobile
  const menuToggle = document.querySelector('.toggle-menu');
  if (menuToggle) {
    menuToggle.addEventListener('click', function(e) {
      e.preventDefault();
      const menu = document.querySelector('.header-menu');
      if (!menu) return;
      if (!this.classList.contains('open')) {
        this.classList.add('open');
        menu.classList.add('open');
      } else {
        this.classList.remove('open');
        menu.classList.remove('open');
      }
    })
  }

  // dropdown toggle
  const allToggle = document.querySelectorAll('.dropdown-toggle');
  if (allToggle.length > 0) {
    for (const toggle of allToggle) {
      toggle.addEventListener('click', function(e) {
        e.preventDefault();

        const dropdownMenu = this.nextElementSibling;
        if (!dropdownMenu.classList.contains('dropdown-menu')) return;

        if (!dropdownMenu.classList.contains('open')) {
          dropdownMenu.classList.add('open');
        } else {
          dropdownMenu.classList.remove('open');
        }
      })
    }
  }

  // swiper slider
  try {
    const sliderContainer = document.querySelectorAll('.js-swiper');
    if (sliderContainer.length > 0) {
      sliderContainer.forEach(el => {
        const parentArrow = el.closest('.swiper-arrow__wrapper');
        const next = (parentArrow) ? parentArrow.querySelector('.swiper-button-next'):null;
        const prev = (parentArrow) ? parentArrow.querySelector('.swiper-button-prev'):null;
        const pagination = el.querySelector('.swiper-pagination');
        const items = el.dataset.items;
        const space = el.dataset.space;
        const display = el.dataset.display;

        let swiper = new Swiper(el, {
          pagination: {
            el: (pagination) ? pagination:null,
            clickable: true,
          },
          navigation: {
            nextEl: (next) ? next:null,
            prevEl: (prev) ? prev:null,
          },
          slidesPerView: 1,
          spaceBetween: 0,
          on: {
            init: function(e) {
              if (display=='none') {
                (parentArrow) ? parentArrow.style.display='none':el.style.display='none';
              }
            }
          },
          breakpoints: {
            576: {
              slidesPerView: (items >= 2) ? 2:1,
              spaceBetween: (space) ? 20:0,
              centeredSlides: false,
            },
            768: {
              slidesPerView: (items >= 3) ? 3:items,
              spaceBetween: (space >= 30) ? 30:space,
            },
            992: {
              slidesPerView: (items) ? Number(items):1,
              spaceBetween: (space) ? space:0,
            }
          }
        })
      });
    }

    const sliderProductThumb = document.querySelector('.product-gallery__thumbs');
    const sliderProduct = document.querySelector('.product-gallery__top');
    if (sliderProduct && sliderProductThumb) {
      const space = sliderProductThumb.dataset.space;
      let productSliderThumb = new Swiper(sliderProductThumb, {
        spaceBetween: (space) ? space:20,
        slidesPerView: 4,
        autoHeight: true,
      })
      let productSlider = new Swiper(sliderProduct, {
        autoHeight: true,
        spaceBetween: 10,
        thumbs: {
          swiper: productSliderThumb
        }
      })
    }
  } catch (error) {
    console.warn('this page not load swiperjs');
  }

  // event toggle
  const eventToggleAll = document.querySelectorAll('.event-toggle__item');
  if (eventToggleAll.length > 0) {
    for (const eventToggle of eventToggleAll) {
      eventToggle.addEventListener('click', function(e) {
        e.preventDefault();

        if (this.classList.contains('active')) return;

        const target = this.dataset.target;
        const targetEl = (target) ? document.querySelector(target):null;
        const activeToggle = this.parentNode.querySelector('.event-toggle__item.active');
        const activeTarget = activeToggle.dataset.target;
        const activeEl = (activeTarget) ? document.querySelector(activeTarget):null;

        this.classList.add('active');
        activeToggle.classList.remove('active');
        if (activeEl) fadeOut(activeEl, function() {
          if (targetEl) fadeIn(targetEl);
        });
      })
    }
  }
  const fadeSpd = 0.050;
  function fadeIn(e, display) {
    e.style.opacity = 0, e.style.display = display || "block",
    (function fade(val) {
      val = parseFloat(e.style.opacity)
      if (!((val += fadeSpd) > 1))
        e.style.opacity = val, requestAnimationFrame(fade)
    })()
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
    })()
  }

  // input number
  const allInputWrapper = document.querySelectorAll('.add-cart__count');
  if (allInputWrapper.length > 0) {
    for (const inputWrapper of allInputWrapper) {
      const plus = inputWrapper.querySelector('.plus');
      const minus = inputWrapper.querySelector('.minus');
      const input = inputWrapper.querySelector('.input');
      
      if (!input) continue;

      plus && plus.addEventListener('click', function(e) {
        e.preventDefault();
        if (input.classList.contains('disabled')) return;
        const newValue = Number(input.value) + 1
        const max = Number(input.max);

        if (max && newValue > max) return;
        input.value = newValue
      })

      minus && minus.addEventListener('click', function(e) {
        e.preventDefault();
        if (input.classList.contains('disabled')) return;
        const newValue = Number(input.value) - 1
        const min = Number(input.min);

        if (newValue < min) return;
        input.value = newValue
      })
    }
  }

  // alert close
  const btnClose = document.querySelectorAll('.alert-close')
  if (btnClose.length > 0) {
    for (const btn of btnClose) {
      btn.addEventListener('click', function(e) {
        e.preventDefault();

        const parent = this.parentNode;
        if (parent.classList.contains('alert')) parent.remove();
      })
    }
  }

  window.customHelper = {
    formatMoney: function (amount, decimalCount = 2, decimal = ".", thousands = ",") {
      try {
        decimalCount = Math.abs(decimalCount);
        decimalCount = isNaN(decimalCount) ? 2 : decimalCount;
    
        const negativeSign = amount < 0 ? "-" : "";
    
        let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
        let j = (i.length > 3) ? i.length % 3 : 0;
    
        return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
      } catch (e) {
        console.log(e)
      }
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
  
  try {
    MicroModal.init();
  } catch (error) {
    console.warn('Micromodal not loaded')
  }
})()