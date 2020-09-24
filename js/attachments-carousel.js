const attachmentsThumbsSwiper = new Swiper('.swiper-container-thumbs', {
  spaceBetween: 10,
  slidesPerView: 6,
  freeMode: true,
  watchSlidesVisibility: true,
  watchSlidesProgress: true,
  watchOverflow: true,
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