(function () {
  'use strict';

  /** Header Height */
  const setupHeaderHeight = () => {
    const header = document.querySelector('header.is-style-hakoniwa-blocks-template-part-fixed, header.is-style-hakoniwa-blocks-template-part-sticky');

    if (!header) {
      return;
    }

    const hakoniwaHeaderHeight = () => {
      document.documentElement.style.setProperty('--header-height', `${header.offsetHeight}px`);
    };

    const ro = new ResizeObserver(hakoniwaHeaderHeight);
    ro.observe(header);
    hakoniwaHeaderHeight();
  };

  //import { hakoniwaSmoothScroll } from './_smooth-scroll';
  /** Init */

  function hakoniwaInit() {
    //	// Smooth Scroll
    //	hakoniwaSmoothScroll();
    // Header Height
    setupHeaderHeight();
  }

  document.addEventListener('DOMContentLoaded', hakoniwaInit);

})();
