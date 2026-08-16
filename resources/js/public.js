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
import { Autoplay, EffectFade, Navigation, Pagination, Parallax } from 'swiper/modules';

Swiper.use([Navigation, Pagination, Autoplay, Parallax, EffectFade]);
window.Swiper = Swiper;

import enableAnchorTop from './public/anchor-top.ts';
import enableNavigation from './public/navigation.ts';
import enablePhotoSwipeLightbox from './public/photo-swipe-lightbox.ts';
import { initDarkMode } from './public/dark-mode.ts';

enablePhotoSwipeLightbox();
enableAnchorTop();
enableNavigation();
initDarkMode();

import.meta.glob(['../images/**']);

/**
 * For TypiCMS’s Places module
 */
// import initMap from './public/map';
// window.initMap = initMap;
