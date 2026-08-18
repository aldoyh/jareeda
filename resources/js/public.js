/**
 * Bootstrap
 */
import Dropdown from 'bootstrap/js/dist/dropdown';
import Collapse from 'bootstrap/js/dist/collapse';
import Alert from 'bootstrap/js/dist/alert';

/**
 * Swiper
 */
import Swiper from 'swiper';
import { A11y, Autoplay, EffectCards, EffectFade, Navigation, Pagination, Parallax } from 'swiper/modules';

Swiper.use([Navigation, Pagination, Autoplay, Parallax, EffectFade, EffectCards, A11y]);
window.Swiper = Swiper;

import enableAnchorTop from './public/anchor-top.ts';
import enableNavigation from './public/navigation.ts';
import enableRecentArticlesCarousel from './public/recent-articles-carousel.ts';
import enablePhotoSwipeLightbox from './public/photo-swipe-lightbox.ts';
import { initDarkMode } from './public/dark-mode.ts';

enablePhotoSwipeLightbox();
enableAnchorTop();
enableNavigation();
enableRecentArticlesCarousel();
initDarkMode();

import.meta.glob(['../images/**']);

/**
 * For TypiCMS’s Places module
 */
// import initMap from './public/map';
// window.initMap = initMap;
