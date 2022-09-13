const swiper = new Swiper ('.swiper', {
    slidesPerView: 3,
    slidesPerGroup: 3,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    loop: true,
    spaceBetween: 30,
    },
    pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true,
    },
});