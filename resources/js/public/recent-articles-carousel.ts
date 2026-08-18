import Swiper from 'swiper';
import { A11y, Autoplay, EffectCards, Navigation, Pagination } from 'swiper/modules';

export default (): void => {
    const carousels = document.querySelectorAll<HTMLElement>('[data-recent-articles-carousel]');

    if (!carousels.length) {
        return;
    }

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    carousels.forEach((carousel) => {
        const swiperElement = carousel.querySelector<HTMLElement>('.recent-articles-swiper');
        const slidesCount = swiperElement?.querySelectorAll('.swiper-slide').length ?? 0;

        if (!swiperElement || slidesCount < 2) {
            return;
        }

        const nextButton = carousel.querySelector<HTMLElement>('[data-carousel-next]');
        const prevButton = carousel.querySelector<HTMLElement>('[data-carousel-prev]');
        const pagination = carousel.querySelector<HTMLElement>('.swiper-pagination');

        new Swiper(swiperElement, {
            modules: [Navigation, Pagination, Autoplay, EffectCards, A11y],
            effect: 'cards',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 1,
            loop: slidesCount > 2,
            speed: 700,
            cardsEffect: {
                perSlideOffset: 10,
                perSlideRotate: 6,
                slideShadows: false,
            },
            autoplay: reducedMotion
                ? false
                : {
                    delay: 4200,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
            navigation: nextButton && prevButton
                ? {
                    nextEl: nextButton,
                    prevEl: prevButton,
                }
                : undefined,
            pagination: pagination
                ? {
                    el: pagination,
                    clickable: true,
                }
                : undefined,
            a11y: {
                enabled: true,
            },
        });
    });
};