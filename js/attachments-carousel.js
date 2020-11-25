const attachmentsThumbsSwiper = new Swiper('.swiper-container-thumbs', {
  spaceBetween: 15,
  slidesPerView: 7,
  // Responsive breakpoints
  breakpoints: {
    // when window width is >= 320px
    320: {
      slidesPerView: 1
    },
    // when window width is >= 480px
    480: {
      slidesPerView: 2
    },
    // when window width is >= 640px
    768: {
      slidesPerView: 3
    },
    // when window width is >= 640px
    960: {
      slidesPerView: 4
    },
    // when window width is >= 640px
    1024: {
      slidesPerView: 5
    },
    // when window width is >= 640px
    1280: {
      slidesPerView: 6
    }
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});
const attachmentsMainSwiper = new Swiper('.swiper-container-main', {
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  thumbs: {
    swiper: attachmentsThumbsSwiper
  },
  watchOverflow: true
});