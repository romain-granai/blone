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
    blockFullMedia();
    productListMedia();
    productList3d();

    function raf(time) {
        lenis.raf(time)
        requestAnimationFrame(raf)
    }

    function topbar() {};

    function nav() {
        $('[data-nav]').on('mouseenter, mousemove', (e)=>{
            var thisSubNav = $(e.target).data('nav');
            var thisSubNavEl = $('[data-parent-nav="'+ thisSubNav +'"]');
    
            $('.topbar__sub').removeClass('topbar__sub--is-active');
            $(e.target).addClass('is-active');
            thisSubNavEl.addClass('topbar__sub--is-active');
    
        });

        $('.topbar__sub').on('mouseleave', (e)=>{
            $('[data-nav]').removeClass('is-active');
            $('.topbar__sub').removeClass('topbar__sub--is-active');
        });

        $('[data-nav]').on('mouseleave', (e)=>{
            console.log(e.relatedTarget);
            if(e.relatedTarget.className == 'topbar__main' || e.relatedTarget.className == 'nav-list'){
                $('[data-nav]').removeClass('is-active');
                $('.topbar__sub').removeClass('topbar__sub--is-active');
            }
        });
    };
    
    function dropdowns() {};

    function blockFullMedia(){
        var $blockFullMedia = $('.block--full-media');

        $blockFullMedia.each(function(){
            var $this = $(this);
            var $thisMedia = $this.find('.media');
            var $thisText = $this.find('.block--full-media__text');
            var $thisTextSplit = new SplitText($thisText, {type: 'chars'});
            var hasVid = $this.find('video').length;

            let imgParallax = gsap.timeline({
                scrollTrigger: {
                    onEnter: function(){
                        if(hasVid){
                            console.log('VIDEO PLAYED')
                            $this.find('video')[0].play();
                        }
                    },
                    onLeave: function(){
                        if(hasVid){
                            console.log('VIDEO PAUSED')
                            $this.find('video')[0].pause();
                        }
                    },
                    onEnterBack: function(){
                        if(hasVid){
                            console.log('VIDEO PLAYED')
                            $this.find('video')[0].play();
                        }
                    },
                    onLeaveBack: function(){
                        if(hasVid){
                            console.log('VIDEO PAUSED')
                            $this.find('video')[0].pause();
                        }
                    },
                    // markers: true,
                    trigger: $this,
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: .01,
                }
            });
            
            let imgBlurIn = gsap.timeline({
                scrollTrigger: {
                    // markers: true,
                    trigger: $this,
                    start: 'top bottom',
                    end: 'top 60%',
                    scrub: .01,
                }
            });

            let imgBlurOut = gsap.timeline({
                scrollTrigger: {
                    // markers: true,
                    trigger: $this,
                    start: 'bottom 40%',
                    end: 'bottom top',
                    scrub: .01,
                }
            });

            let textAnimIn = gsap.timeline({
                scrollTrigger: {
                    // markers: true,
                    trigger: $thisText,
                    endTrigger: $this,
                    start: 'top bottom', // when the top of the trigger hits the top of the viewport
                    end: 'bottom bottom', // end after scrolling 500px beyond the start
                    scrub: true,
                }
            });

            imgParallax.to($thisMedia, {yPercent: 20, ease: 'none'});
            imgBlurIn.to($this, {'--blur': 0, '--brightness': 1, ease: 'none'});
            imgBlurOut.to($this, {'--blur': 40, '--brightness': .5, ease: 'none'});
            textAnimIn.from($thisTextSplit.chars, {autoAlpha: 0, xPercent: 25, yPercent: 25, stagger: .1, easing: 'none'});
        });
    };

    function productListMedia(){
        var productListImg = $('.product-list__image');
        var productListMedia = productListImg.find('.media');

        let imgParallax = gsap.timeline({
            scrollTrigger: {
                // markers: true,
                trigger: productListImg,
                start: 'top bottom',
                end: 'bottom top',
                scrub: .01,
            }
        });
        
        let imgBlurIn = gsap.timeline({
            scrollTrigger: {
                // markers: true,
                trigger: productListImg,
                start: 'top bottom',
                end: 'top 80%',
                scrub: .01,
            }
        });

        let imgBlurOut = gsap.timeline({
            scrollTrigger: {
                // markers: true,
                trigger: productListImg,
                start: 'bottom 20%',
                end: 'bottom top',
                scrub: .01,
            }
        });

        imgParallax.to(productListMedia, {yPercent: 20, ease: 'none'});
        imgBlurIn.to(productListImg, {'--blur': 0, '--brightness': 1, ease: 'none'});
        imgBlurOut.to(productListImg, {'--blur': 40, '--brightness': .5, ease: 'none'});
    };

    function productList3d(){

        $('.product-item').each(function(){
            var thisItemIsHovered = false;
            var this3DContainer = $(this).find('.product-item__3d');
            var model3d = this3DContainer.data('model');
            
            $(this).find('a').on('mouseenter, mouseover', function(){
                thisItemIsHovered = true;
            });
            
            $(this).find('a').on('mouseleave', function(){
                thisItemIsHovered = false;
            });
            
            // Create the scene
            const scene = new THREE.Scene();
        
            // Create a camera
            const camera = new THREE.PerspectiveCamera(75, document.getElementById('product-item__3d').clientWidth / document.getElementById('product-item__3d').clientWidth);
            camera.position.z = 5;
        
            // Create the renderer with alpha to enable transparency
            const renderer = new THREE.WebGLRenderer({ alpha: true });
            renderer.setSize(document.getElementById('product-item__3d').clientWidth, document.getElementById('product-item__3d').clientWidth);
        
            // Set the clear color to be fully transparent
            renderer.setClearColor(0x000000, 0); 
        
            // Add the renderer to the HTML
            this3DContainer[0].appendChild(renderer.domElement);
        
            // Add ambient light for general illumination
            const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
            scene.add(ambientLight);
        
            // Add directional light to simulate sunlight
            const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
            directionalLight.position.set(0.2, 1, 10).normalize();
            scene.add(directionalLight);
        
            // Add a point light to highlight the shininess
            const pointLight1 = new THREE.PointLight(0xffffff, 1);
            pointLight1.position.set(2, 3, 2);
            scene.add(pointLight1);
        
            const pointLight2 = new THREE.PointLight(0xffffff, 1);
            pointLight2.position.set(-2, -3, -2);
            scene.add(pointLight2);
        
            let object = null;
        
            // Load a 3D model
            const objLoader = new THREE.OBJLoader();
            objLoader.load(model3d, function (loadedObject) {
            
            // Create a shiny material
            const shinyMaterial = new THREE.MeshPhongMaterial({
                color: 0x222222,    // Color of the material
                color: 0x000000,
                shininess: 100,    // Shininess value (adjust as needed)
            });
            
            // Apply the shiny material to the model
            loadedObject.traverse(function (child) {
                if (child.isMesh) {
                    child.material = shinyMaterial;
                }
            });
        
            // Add the loaded object to the scene
            scene.add(loadedObject);
                
            object = loadedObject;
                object.scale.set(1.4, 1.4, 1.4);
        }, undefined, function (error) {
            console.error(error);
        });
        
            // Render the scene
            function animate() {
                requestAnimationFrame(animate);
        
                // Check if the object is loaded and rotate it around its own axis
                if (object && thisItemIsHovered) {
                    object.rotation.y += 0.01; // Adjust the rotation speed as needed
                            // object.rotation.x = cursorPos.y / 1000;
                            // object.rotation.z = cursorPos.x / 1500;
                }
        
                renderer.render(scene, camera);
            }
            animate();
        
            // Handle window resize
            window.addEventListener('resize', function () {
                camera.aspect = document.getElementById('product-item__3d').clientWidth / document.getElementById('product-item__3d').clientWidth;
                camera.updateProjectionMatrix();
                renderer.setSize(document.getElementById('product-item__3d').clientWidth, document.getElementById('product-item__3d').clientWidth);
            });
            
        });

        $('.product-item__media').each(function(){
            var thisModel = $(this).find('.product-item__3d');
            let scrollTriggerBottle = gsap.timeline({
                    // yes, we can add it to an entire timeline!
                    scrollTrigger: {
                            // markers: true,
                            trigger: $(this),
                            start: 'top bottom', // when the top of the trigger hits the top of the viewport
                            end: 'bottom top', // end after scrolling 500px beyond the start
                            scrub: .001, // smooth scrubbing, takes 1 second to "catch up" to the scrollbar
                    }
            });
        
            scrollTriggerBottle.from(thisModel, {yPercent: 20, ease: 'none'})
                                                 .to(thisModel, {yPercent: -20, ease: 'none'})
        });

    }

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