$(document).ready(function () {
    console.log('READY TO RUMBLE');
    const lenis = new Lenis({
        duration: 1,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), // https://www.desmos.com/calculator/brs54l4xou
        direction: 'vertical', // vertical, horizontal
        gestureDirection: 'vertical', // vertical, horizontal, both
        smooth: true,
        // mouseMultiplier: 1,
        smoothTouch: false,
        // touchMultiplier: 2,
        infinite: false,
    });
      
    requestAnimationFrame(raf)

    topbar();
    nav();
    dropdowns();

    function raf(time) {
        lenis.raf(time)
        requestAnimationFrame(raf)
    }

    function topbar() {};

    function nav() {};
    
    function dropdowns() {};


    function debounce(func, wait, immediate) {
        var timeout;
      
        return function executedFunction() {
          var context = this;
          var args = arguments;
              
          var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
          };
      
          var callNow = immediate && !timeout;
          
          clearTimeout(timeout);
      
          timeout = setTimeout(later, wait);
          
          if (callNow) func.apply(context, args);
        };
    };

});