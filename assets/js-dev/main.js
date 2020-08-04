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

  // swiper slider
  try {
    const sliderContainer = document.querySelectorAll('.swiper-container');
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
          slidesPerView: (items) ? Number(items):1,
          spaceBetween: (space) ? Number(space):0,
          on: {
            init: function(e) {
              if (display=='none') {
                (parentArrow) ? parentArrow.style.display='none':el.style.display='none';
              }
            }
          }
        })
      });
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
})()