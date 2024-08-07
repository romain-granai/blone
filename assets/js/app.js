$(document).ready(function () {
    console.log('READY TO RUMBLE');
    var subNavIsOpen = false;
    var mobileNavIsOpen = false;
    var $burger = $('.burger');
    var $mobileNav = $('.mobile-nav');

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
        prevent: (node) => node.classList.contains('woocommerce-MyAccount-navigation'),
    });
      
    requestAnimationFrame(raf);

    barba.use(barbaPrefetch);

    // Initialize Barba
    barba.init({
        preventRunning: true,
        prevent: ({ el }) => el.classList && el.classList.contains('added_to_cart'),
        transitions: [
            {
                name: 'fade',
                leave({current, next, trigger}) {
                    console.log('GLOBAL LEAVE');

                    return new Promise(resolve => {
                         const leavingAnim = gsap.timeline({
                             onComplete(){
                                 resolve();
                             }
                         });
     
                         leavingAnim .to('.curtain', {duration: .75, autoAlpha: 1, ease: Expo.easeInOut})
                                     .set(current.container, { autoAlpha: 0, display: 'none'});
                     });
                },
                enter({current, next, trigger}) {
                    console.log('GLOBAL ENTER');

                    return new Promise(resolve => {
                         
                         const enterAnim = gsap.timeline({
                             onComplete(){
                                 resolve();
                             }
                         });
     
                         enterAnim   .fromTo(next.container, 0, {autoAlpha: 0}, {autoAlpha: 1, ease: Expo.easeInOut})
                                     .to('.curtain', {duration: .75, autoAlpha: 0, ease: Expo.easeInOut});
                     });
                },
                once(){
                    topbar();
                    nav();
                    mobileNav();
                    btn();
                    productList3d();
                    // productList3dOBJ();
                    dropdowns();
                    mediaList();
                    customAddToCart();
                    blockTextNMedia();
                    blockFullMedia();
                    blockTextWithNavigation();
                    homeSliderBottle();
                    preventSamePageReload();
                    preventBarbaOnSomeLinks();
                },
                afterEnter(){
                    console.log('GLOBAL AFTER ENTER');
                    topbar();
                    btn();
                    productList3d();
                    // productList3dOBJ();
                    dropdowns();
                    mediaList();
                    customAddToCart();
                    blockTextNMedia();
                    blockFullMedia();
                    blockTextWithNavigation();
                    homeSliderBottle();
                    preventSamePageReload();
                    preventBarbaOnSomeLinks();

                },
                beforeLeave(){
                    $('.topbar a').removeClass('is-active');
                    $('.topbar__sub').removeClass('topbar__sub--is-active');
                    $('.topbar').removeClass('topbar--is-hidden');
                },
                beforeEnter(){

                    $mobileNav.removeClass('mobile-nav--is-open');
                    mobileNavIsOpen = false;
                    lenis.start();

                    window.scrollTo(0, 0);
                    killAllScrollTrigger();
                    preventSamePageReload();

                }

            }
        ],
        views: [{
            namespace: 'shop',
            afterEnter(){
                console.log('AFTER ENTER SHOP');
                catList();
                productListMedia();
            },
        },{
            namespace: 'single-product',
            afterEnter(){
                console.log('AFTER ENTER Single Product');
                singleProductImages();
            }
        },{
            namespace: 'cart',
            afterEnter(){
                console.log('AFTER ENTER CART');
                $('a').attr('data-barba-prevent', true);
            }
        },{
            namespace: 'checkout',
            afterEnter(){
                console.log('AFTER ENTER Checkout');
                $('a').attr('data-barba-prevent', true);
            }
        },{
            namespace: 'account',
            afterEnter(){
                console.log('AFTER ENTER Account');
                $('a').attr('data-barba-prevent', true);
                $('.woocommerce-MyAccount-navigation').attr('data-lenis-prevent', true);
            }
        },
        {
            namespace: 'checkout',
            afterEnter(){
                $('a').attr('data-barba-prevent', true);
                // preventBarbaOnSomeLinks();
            }
        }]
    });

    // topbar();
    // nav();
    // mobileNav();
    // btn();
    // homeSliderBottle();
    // blockFullMedia();
    // blockTextNMedia();
    // productListMedia();
    // catList();
    // productList3d();
    // mediaList();
    // customAddToCart();
    // singleProductImages();
    // dropdowns();
    // blockTextWithNavigation();
    // preventBarbaOnSomeLinks();

    

    function raf(time) {
        lenis.raf(time)
        requestAnimationFrame(raf)
    }

    function topbar() {
        
        // console.log('TOPBAR');

        ScrollTrigger.create({
            trigger: 'body',
            start: 'top top',
            end: 'bottom bottom',
            invalidateOnRefresh: true,
            refreshPriority: -1000,
            onUpdate: (self) => {
                if(self.scroll() >= window.innerHeight / 2){
                    if (!subNavIsOpen && !mobileNavIsOpen) {
                        if (self.direction === -1) { // scrolling Up
                            $('.topbar').removeClass('topbar--is-hidden');
                        } else { // scrolling Down
                            $('.topbar').addClass('topbar--is-hidden');
                            $('[data-nav]').removeClass('is-active');
                            $('.topbar__sub').removeClass('topbar__sub--is-active');
                        }
                    }
                } else {
                    $('.topbar').removeClass('topbar--is-hidden');
                    $('[data-nav]').removeClass('is-active');
                    $('.topbar__sub').removeClass('topbar__sub--is-active');
                }
            }
        });


        var topBarHDebounce = debounce(function() {
            var topBarH = $('.topbar').innerHeight();
            gsap.set('html', {'--topBarH': topBarH + 'px'});
        }, 100);
        
        topBarHDebounce();

        $(window).on('resize', topBarHDebounce);

    };

    function nav() {
        $('[data-nav]').on('mouseenter, mousemove', (e)=>{
            var thisSubNav = $(e.target).data('nav');
            var thisSubNavEl = $('[data-parent-nav="'+ thisSubNav +'"]');
    
            $('.topbar__sub').removeClass('topbar__sub--is-active');
            $(e.target).addClass('is-active');
            thisSubNavEl.addClass('topbar__sub--is-active');
            subNavIsOpen = true;
        });

        $('.topbar__sub').on('mouseleave', (e)=>{
            $('[data-nav]').removeClass('is-active');
            $('.topbar__sub').removeClass('topbar__sub--is-active');
            subNavIsOpen = false;
        });

        $('[data-nav]').on('mouseleave', (e)=>{
            console.log(e.relatedTarget);
            if(e.relatedTarget.className == 'topbar__main' || e.relatedTarget.className == 'nav-list'){
                $('[data-nav]').removeClass('is-active');
                $('.topbar__sub').removeClass('topbar__sub--is-active');
                subNavIsOpen = false;
            }
        });
    };
    
    function mobileNav(){

        $burger.on('click', function(){
            
            $('.topbar').removeClass('topbar--is-hidden');

            if(!mobileNavIsOpen){
                $mobileNav.addClass('mobile-nav--is-open');
                lenis.stop();
                mobileNavIsOpen = true;
            } else {
                $mobileNav.removeClass('mobile-nav--is-open');
                lenis.start();
                mobileNavIsOpen = false;
            }

            var resizeDebounce = debounce(function() {
                if(window.innerWidth > 768){
                    $mobileNav.removeClass('mobile-nav--is-open');
                    lenis.start();
                    mobileNavIsOpen = false;
                };
            }, 100);
            
            $(window).on('resize', resizeDebounce);

        });


    };

    function dropdowns() {};

    function btn(){
        var $btn = $('.btn');
        
        // $btn.on('mouseenter', function(){
        //     var $this = $(this);
        //     var thisText = $this.data('text');
        //     gsap.to($(this).find('span'), {duration: .5, scrambleText:{text:thisText, chars:'0123456789'}});
        // });
        
        // var mainNavItemWidth = $('.topbar__main .nav-list a').outerWidth(true);

        // $('.topbar__main .nav-list a').each(function(){
        //     var mainNavItemWidth = $(this).outerWidth(true);
        //     $(this).css('width', mainNavItemWidth + 'px')
        // });

        // $('.nav-list a').on('mouseenter', function(){
        //     var $this = $(this);
        //     var thisText = $this.attr('title');
        //     gsap.to($this, {duration: .5, scrambleText:{text:thisText, chars:'0123456789'}});
        // });

    };

    function homeSliderBottle() {
        var modelContainer = document.getElementById('model-container');
        var modelUrl = $('.bottle-screen').data('model');
        var cursorPos = { y: 0, x: 0 };
        var perfumeNumber = ['741', '852', '963'];
        var perfumeColor = [0x00ff, 0xaa00ee, 0xff0000];
        var currentPerfumeIndex = 0;
        var rotationSpeed = 0.01;
        var isAnimating = false;
    
        if (modelContainer == null) {
            return;
        };
    
        var prevNextWave = gsap.timeline({
            paused: true,
            onComplete: () => {
                prevNextWave.restart().pause();
                isAnimating = false;
                gsap.set('.number', { clearProps: 'all' });
                gsap.set('.bottle-screen__bg', { autoAlpha: 0 });
            },
            onStart: () => {
                isAnimating = true;
                gsap.set('.bottle-screen__bg', { autoAlpha: 0.5 });
            }
        });
    
        prevNextWave.to('.bottle-screen__number', {
            autoAlpha: .5,
            scale: 1.2,
            duration: .2,
            stagger: {
                amount: .25,
                from: 'center',
                grid: 'auto',
                ease: 'power2.inOut',
            }
        })
        .to('.bottle-screen__number', {
            autoAlpha: 0,
            scale: 1,
            duration: .2,
            stagger: {
                amount: .25,
                from: 'center',
                grid: 'auto',
                ease: 'power2.inOut',
            }
        });
    
        // Create the bottleScene
        const bottleScene = new THREE.Scene();
    
        // Create a camera
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        camera.position.z = 5;
    
        // Create the renderer with alpha to enable transparency
        const renderer = new THREE.WebGLRenderer({ alpha: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setClearColor(0x000000, 0);
    
        // Add the renderer to the HTML
        modelContainer.appendChild(renderer.domElement);
    
        // Add ambient light for general illumination
        const ambientLight = new THREE.AmbientLight(perfumeColor[0], 0.5);
        bottleScene.add(ambientLight);
    
        // Add directional light to simulate sunlight
        const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
        directionalLight.position.set(0.2, 1, 10).normalize();
        bottleScene.add(directionalLight);
    
        // Add point lights to highlight shininess
        const pointLight1 = new THREE.PointLight(perfumeColor[0], 1);
        pointLight1.position.set(2, 3, 2);
        bottleScene.add(pointLight1);
    
        const pointLight2 = new THREE.PointLight(perfumeColor[0], 1);
        pointLight2.position.set(-2, -3, -2);
        bottleScene.add(pointLight2);
    
        let object = null;
        const shinyMaterial = new THREE.MeshPhongMaterial({
            color: 0x000000,
            shininess: 100,
        });
    
        // Load a GLTF model
        const gltfLoader = new THREE.GLTFLoader();
        gltfLoader.load(modelUrl, function (gltf) {
            object = gltf.scene;
            
            object.traverse(function (child) {
                if (child.isMesh) {
                    child.material = shinyMaterial;
                }
            });
    
            bottleScene.add(object);
            object.scale.set(1.5, 1.5, 1.5);
        }, undefined, function (error) {
            console.error(error);
        });
    
        // Render the bottleScene
        function animate() {
            requestAnimationFrame(animate);
    
            // Check if the object is loaded and rotate it
            if (object) {
                object.rotation.y += rotationSpeed;
                object.rotation.x = cursorPos.y / 1000;
                object.rotation.z = cursorPos.x / 1500;
            }
    
            renderer.render(bottleScene, camera);
        }
        animate();
    
        // Handle window resize
        window.addEventListener('resize', function () {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });
    
        let scrollTriggerBottle = gsap.timeline({
            scrollTrigger: {
                trigger: '.bottle-screen',
                start: 'top bottom',
                end: 'bottom top',
                scrub: true,
            }
        });
    
        scrollTriggerBottle.from('#model-container', { yPercent: 20, ease: 'none' })
                           .to('#model-container', { yPercent: -20, ease: 'none' });
    
        let stBottleBgIn = gsap.timeline({
            scrollTrigger: {
                trigger: '.bottle-screen',
                start: 'top 75%',
                end: 'top 60%',
                scrub: true,
            }
        });
    
        let stBottleBgOut = gsap.timeline({
            scrollTrigger: {
                trigger: '.bottle-screen',
                start: 'bottom 35%',
                end: 'bottom 10%',
                scrub: true,
                onEnter: (self) => {
                    $('.bottle-screen__ctas').addClass('bottle-screen__ctas--is-hidden');
                },
                onLeaveBack: (self) => {
                    $('.bottle-screen__ctas').removeClass('bottle-screen__ctas--is-hidden');
                }
            }
        });
    
        stBottleBgIn.to('.bottle-screen', { '--bg-opacity': 1, ease: 'none' });
        stBottleBgOut.to('.bottle-screen', { '--bg-opacity': 0, ease: 'none' });
    
        let stopTimeout;
    
        const cursorStopped = () => {
            console.log('Cursor has stopped moving.');
            gsap.to('.bottle-screen__bg', { autoAlpha: 0, duration: .2 });
            isAnimating = false;
        };
    
        Observer.create({
            target: '.bottle-screen',
            type: 'pointer',
            onMove: (self) => {
                const velocityX = Math.abs(self.velocityX);
                const velocityY = Math.abs(self.velocityY);
                const velocity = velocityX + velocityY;
                const yPosPercent = self.y - (window.innerHeight / 2);
                const xPosPercent = self.x - (window.innerWidth / 2);
    
                let mappedVelocity = gsap.utils.pipe(
                    gsap.utils.clamp(0, 2500),
                    gsap.utils.mapRange(0, 2500, 0, .5)
                );
    
                gsap.to(cursorPos, { y: yPosPercent, duration: 2, ease: 'power4.Out' });
                gsap.to(cursorPos, { x: xPosPercent, duration: 2, ease: 'power4.Out' });
                gsap.to('.bottle-screen__bg', { autoAlpha: mappedVelocity(velocity), duration: .2 });
    
                isAnimating = true;
    
                clearTimeout(stopTimeout);
                stopTimeout = setTimeout(cursorStopped, 200);
            }
        });
    
        $('.bottle-screen__fg').on('mousemove mouseenter', function (e) {
            var curPosX = e.pageX - $(this).offset().left;
            var curPosY = e.pageY - $(this).offset().top;
            var curPosXPercent = (curPosX / $(this).outerWidth()) * 100;
            var curPosYPercent = (curPosY / $(this).outerHeight()) * 100;
            var maxDistance = $(this).innerWidth() * Math.sqrt(2);
    
            $('.bottle-screen__number').each(function () {
                var thisHalfW = $(this)[0].clientWidth / 2;
                var thisHalfH = $(this)[0].clientHeight / 2;
                var thisLeft = $(this)[0].offsetLeft;
                var thisTop = $(this)[0].offsetTop;
                var thisXCenter = thisLeft + thisHalfW;
                var thisYCenter = thisTop + thisHalfH;
                var distance = getDistance(curPosX, curPosY, thisXCenter, thisYCenter);
                var opacity = gsap.utils.mapRange(0, maxDistance, 1, -7, distance);
                var scale = gsap.utils.mapRange(0, maxDistance, .5, 0, distance);
    
                gsap.to($(this), {
                    autoAlpha: opacity,
                    duration: .2,
                    ease: 'expo.inout',
                });
            });
        });
    
        $('.prev-next--next').on('click', function () {
            getNextOrPrev('next');
        });
    
        $('.prev-next--prev').on('click', function () {
            getNextOrPrev('prev');
        });
    
        document.onkeydown = function (e) {
            switch (e.keyCode) {
                case 37:
                    getNextOrPrev('prev');
                    break;
                case 39:
                    getNextOrPrev('next');
                    break;
            }
        };
    
        function getDistance(x1, y1, x2, y2) {
            let y = x2 - x1;
            let x = y2 - y1;
            return Math.sqrt(x * x + y * y);
        }
    
        function getNextOrPrev(nextOrPrev) {
            if (isAnimating) {
                return;
            }
    
            prevNextWave.play();
    
            if (nextOrPrev == 'next') {
                currentPerfumeIndex = (currentPerfumeIndex + 1) % products.length;
    
                gsap.to('.bottle-screen__current-number', {
                    duration: 1,
                    scrambleText: { text: products[currentPerfumeIndex].productTitle, chars: '0123456789' }
                });
                gsap.to(object.rotation, { y: '+=3.14', duration: 1 });
                $('.bottle-screen__ctas a').attr('href', products[currentPerfumeIndex].permalink);
    
                gsap.to('.bottle-screen', { '--color-1': products[currentPerfumeIndex].colors[0] });
                gsap.to('.bottle-screen', { '--color-3': products[currentPerfumeIndex].colors[2], delay: .1 });
                gsap.to('.bottle-screen', { '--color-2': products[currentPerfumeIndex].colors[1], delay: .2 });
                gsap.to('.bottle-screen', { '--color-1': products[currentPerfumeIndex].colors[0], delay: .3 });
    
                rotationSpeed = 0.01;
            } else {
                currentPerfumeIndex = (currentPerfumeIndex - 1 + products.length) % products.length;
    
                gsap.to('.bottle-screen__current-number', {
                    duration: 1,
                    scrambleText: { text: products[currentPerfumeIndex].productTitle, chars: '0123456789' }
                });
                gsap.to(object.rotation, { y: '-=3.14', duration: 1 });
                $('.bottle-screen__ctas a').attr('href', products[currentPerfumeIndex].permalink);
    
                gsap.to('.bottle-screen', { '--color-1': products[currentPerfumeIndex].colors[0] });
                gsap.to('.bottle-screen', { '--color-2': products[currentPerfumeIndex].colors[1], delay: .1 });
                gsap.to('.bottle-screen', { '--color-3': products[currentPerfumeIndex].colors[2], delay: .2 });
                gsap.to('.bottle-screen', { '--color-4': products[currentPerfumeIndex].colors[3], delay: .3 });
    
                rotationSpeed = -0.01;
            }
        };
    }
    

    function blockFullMedia(){
        var $blockFullMedia = $('.block--full-media');

        $blockFullMedia.each(function(){
            var $this = $(this);
            var $thisMedia = $this.find('.media');
            var $thisText = $this.find('.block--full-media__text');
            var hasVid = $this.find('video').length;
            var animationType = $(this).hasClass('block--full-media--wave') ? 'wave' : 'numeric';
            var isHeader = $(this).hasClass('header');

            
                if(animationType == 'wave'){
                    var $thisTextSplit = new SplitText($thisText, {type: 'chars'});

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

                    textAnimIn.from($thisTextSplit.chars, {autoAlpha: 0, 'font-weight': 100, xPercent: 25, yPercent: 25, stagger: .1, easing: 'none'});
                } else {
                    $textLine = $thisText.find('span');
                    let textScrambleIn = gsap.timeline({
                        scrollTrigger: {
                            // markers: true,
                            trigger: $thisText,
                            endTrigger: $this,
                            start: 'top bottom', // when the top of the trigger hits the top of the viewport
                            end: 'bottom bottom', // end after scrolling 500px beyond the start
                            scrub: true,
                        }
                    });

                    $textLine.each(function(){
                        textScrambleIn.to($(this), {scrambleText:{text:$(this)[0].textContent, chars:' 0123456789'}}, );
                    });
                    
                };
            


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
                    start: 'top top',
                    end: 'bottom top',
                    scrub: .01,
                }
            });
            
            if(!isHeader){
                let imgBlurIn = gsap.timeline({
                    scrollTrigger: {
                        // markers: true,
                        trigger: $this,
                        start: 'top bottom',
                        end: 'top 60%',
                        scrub: .01,
                    }
                });

                imgBlurIn.from($this, {'--blur': 40, '--brightness': .25, ease: 'none'});
            };



            let imgBlurOut = gsap.timeline({
                scrollTrigger: {
                    // markers: true,
                    trigger: $this,
                    start: 'bottom 40%',
                    end: 'bottom top',
                    scrub: .01,
                }
            });

            imgParallax.to($thisMedia, {yPercent: 20, ease: 'none'});
            
            imgBlurOut.to($this, {'--blur': 40, '--brightness': .25, ease: 'none'});

        });
    };

    function blockTextNMedia(){
        var $blockTextNMedia = $('.block--text-n-media');

        $blockTextNMedia.each(function(){
            var $this = $(this);
            var $thisMedia = $this.find('.media');
            var $thisText = $this.find('h2');
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
            textAnimIn.from($thisTextSplit.chars, {autoAlpha: 0, 'font-weight': 100, xPercent: 25, yPercent: 25, stagger: .1, easing: 'none'});
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

    function catList(){
        $('.cat-item').each(function(){
            var $this = $(this);
            var thisTitle = $(this).find('.cat-item__title');
            var thisTitleSplit = new SplitText(thisTitle, {type: 'chars'});
            
            var enterVPAnim = gsap.timeline({
            scrollTrigger: {
                onLeave: function(){$this.addClass('cat-item--ready')},
                onEnterBack: function(){$this.removeClass('cat-item--ready')},
                trigger: $(this),
                start: 'top bottom', // when the top of the trigger hits the top of the viewport
                end: 'bottom 80%', // end after scrolling 500px beyond the start
                scrub: true, // smooth scrubbing, takes 1 second to "catch up" to the scrollbar
                }
            });
            
            var leaveVPAnim = gsap.timeline({
                onStart: function(){$(this).removeClass('.cat-item--ready')},
            scrollTrigger: {
                        // markers: true,
                        onEnter: function(){$this.removeClass('cat-item--ready')},
                        onLeaveBack: function(){$this.addClass('cat-item--ready')},
                trigger: $(this),
                start: 'top 5%', // when the top of the trigger hits the top of the viewport
                end: 'top -15%', // end after scrolling 500px beyond the start
                scrub: true, // smooth scrubbing, takes 1 second to "catch up" to the scrollbar
                    }
            });
            
            enterVPAnim.from(thisTitleSplit.chars, {autoAlpha: 0, 'font-weight': 100, xPercent: 25, yPercent: 25, stagger: .1, easing: 'none'});
            leaveVPAnim.to(thisTitleSplit.chars, {autoAlpha: 0, 'font-weight': 100, yPercent: -25, stagger: .1, easing: 'none'});
        });
        
        $('.cat-list--v1').on('mouseenter, mousemove', function(e){
            var element = $(this);
            var offset = element.offset();
            var width = element.width();
            var posX = e.pageX - offset.left;
            var posXPercent = (posX / width) * 100;
            
            const imgPosMap = gsap.utils.mapRange(0, 100, 50, -50, posXPercent);
            
            gsap.to($(this), {'--posX': posX + 'px', duration: 2, ease: 'power4.out'});
            gsap.to($('.cat-item__details__media'), {'--x': imgPosMap + 'px', duration: 2, ease: 'power4.out'});
        });
        
        $('.cat-list--v1 .cat-item__link').on('mouseenter, mousemove', function(e){
            // console.log('ENTER')
            // var thisItem = $(this).parents('.cat-item');
            var element = $(e.target).parents('.cat-item');
            var thisDetail = element.find('.cat-item__details');
            var thisDetailImg = thisDetail.find('.cat-item__details__media img');
            var offset = element.offset();
            // var width = element.width();
            var height = element.height();
        
            // var posX = e.pageX - offset.left;
            var posY = e.pageY - offset.top;
        
            // var posXPercent = (posX / width) * 100;
            var posYPercent = (posY / height) * 100;
            const imgPosMap = gsap.utils.mapRange(0, 100, 25, -25, posYPercent);
            console.log()
            
            gsap.to(thisDetail, {'--posY': posY + 'px', duration: 2, ease: 'power4.out'});
            gsap.to(thisDetailImg, {'--y': imgPosMap + 'px', duration: 2, ease: 'power4.out'});
        
            
        });
    };

    function productList3d() {
        $('.product-item').each(function () {
            var thisItemIsHovered = false;
            var this3DContainer = $(this).find('.product-item__3d');
            var model3d = this3DContainer.data('model');
    
            $(this).find('a').on('mouseenter mouseover', function () {
                thisItemIsHovered = true;
            });
    
            $(this).find('a').on('mouseleave', function () {
                thisItemIsHovered = false;
            });
    
            // Create the scene
            const scene = new THREE.Scene();
    
            // Create a camera
            const camera = new THREE.PerspectiveCamera(75, this3DContainer[0].clientWidth / this3DContainer[0].clientHeight);
            camera.position.z = 5;
    
            // Create the renderer with alpha to enable transparency
            const renderer = new THREE.WebGLRenderer({ alpha: true });
            renderer.setSize(this3DContainer[0].clientWidth, this3DContainer[0].clientHeight);
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
    
            // Add point lights to highlight the shininess
            const pointLight1 = new THREE.PointLight(0xffffff, 1);
            pointLight1.position.set(2, 3, 2);
            scene.add(pointLight1);
    
            const pointLight2 = new THREE.PointLight(0xffffff, 1);
            pointLight2.position.set(-2, -3, -2);
            scene.add(pointLight2);
    
            let object = null;
    
            // Load a GLTF model
            const gltfLoader = new THREE.GLTFLoader();
            gltfLoader.load(model3d, function (gltf) {
                // Create a shiny material
                const shinyMaterial = new THREE.MeshPhongMaterial({
                    color: 0x222222,
                    shininess: 100,
                });
    
                // Apply the shiny material to the model
                gltf.scene.traverse(function (child) {
                    if (child.isMesh) {
                        child.material = shinyMaterial;
                    }
                });
    
                // Add the loaded object to the scene
                scene.add(gltf.scene);
                object = gltf.scene;
                object.scale.set(1.4, 1.4, 1.4);
            }, undefined, function (error) {
                console.error(error);
            });
    
            // Render the scene
            function animate() {
                requestAnimationFrame(animate);
    
                // Check if the object is loaded and rotate it
                if (object && thisItemIsHovered) {
                    object.rotation.y += 0.01;
                }
    
                renderer.render(scene, camera);
            }
            animate();
    
            // Handle window resize
            window.addEventListener('resize', function () {
                camera.aspect = this3DContainer[0].clientWidth / this3DContainer[0].clientHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(this3DContainer[0].clientWidth, this3DContainer[0].clientHeight);
            });
        });
    
        $('.product-item__media').each(function () {
            var thisModel = $(this).find('.product-item__3d');
            let scrollTriggerBottle = gsap.timeline({
                scrollTrigger: {
                    trigger: $(this),
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: .001,
                }
            });
    
            scrollTriggerBottle.from(thisModel, { yPercent: 20, ease: 'none' })
                .to(thisModel, { yPercent: -20, ease: 'none' });
        });
    }

    function productList3dOBJ() {
        $('.product-item').each(function () {
            var thisItemIsHovered = false;
            var this3DContainer = $(this).find('.product-item__3d');
            var model3d = this3DContainer.data('model');
    
            $(this).find('a').on('mouseenter mouseover', function () {
                thisItemIsHovered = true;
            });
    
            $(this).find('a').on('mouseleave', function () {
                thisItemIsHovered = false;
            });
    
            // Create the scene
            const scene = new THREE.Scene();
    
            // Create a camera
            const camera = new THREE.PerspectiveCamera(75, this3DContainer[0].clientWidth / this3DContainer[0].clientHeight);
            camera.position.z = 5;
    
            // Create the renderer with alpha to enable transparency
            const renderer = new THREE.WebGLRenderer({ alpha: true });
            renderer.setSize(this3DContainer[0].clientWidth, this3DContainer[0].clientHeight);
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
    
            // Add point lights to highlight the shininess
            const pointLight1 = new THREE.PointLight(0xffffff, 1);
            pointLight1.position.set(2, 3, 2);
            scene.add(pointLight1);
    
            const pointLight2 = new THREE.PointLight(0xffffff, 1);
            pointLight2.position.set(-2, -3, -2);
            scene.add(pointLight2);
    
            let object = null;
    
            // Load an OBJ model
            const objLoader = new THREE.OBJLoader();
            objLoader.load(model3d, function (obj) {
                // Create a shiny material
                const shinyMaterial = new THREE.MeshPhongMaterial({
                    color: 0x222222,
                    shininess: 100,
                });
    
                // Apply the shiny material to the model
                obj.traverse(function (child) {
                    if (child.isMesh) {
                        child.material = shinyMaterial;
                    }
                });
    
                // Add the loaded object to the scene
                scene.add(obj);
                object = obj;
                object.scale.set(1.4, 1.4, 1.4);
            }, undefined, function (error) {
                console.error(error);
            });
    
            // Render the scene
            function animate() {
                requestAnimationFrame(animate);
    
                // Check if the object is loaded and rotate it
                if (object && thisItemIsHovered) {
                    object.rotation.y += 0.01;
                }
    
                renderer.render(scene, camera);
            }
            animate();
    
            // Handle window resize
            window.addEventListener('resize', function () {
                camera.aspect = this3DContainer[0].clientWidth / this3DContainer[0].clientHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(this3DContainer[0].clientWidth, this3DContainer[0].clientHeight);
            });
        });
    
        $('.product-item__media').each(function () {
            var thisModel = $(this).find('.product-item__3d');
            let scrollTriggerBottle = gsap.timeline({
                scrollTrigger: {
                    trigger: $(this),
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: .001,
                }
            });
    
            scrollTriggerBottle.from(thisModel, { yPercent: 20, ease: 'none' })
                .to(thisModel, { yPercent: -20, ease: 'none' });
        });
    }
    
    

    function mediaList(){
        $('.media-list').each(function(e){
            var $this = $(this);
            var items = $this.find('li');
            var img = $this.find('img');

            let staggerItems = gsap.timeline({
                scrollTrigger: {
                    // markers: true,
                    trigger: $this,
                    start: 'top bottom',
                    end: 'top center',
                    scrub: .01,
                }
            });

            staggerItems.from(items, {yPercent: 25, stagger: .15, ease: 'none'}, 'sameTime')
                        .to(items, {'--blur': '0px', '--brightness': 1, stagger: .15, ease: 'none'}, 'sameTime')
                        .to(img, {yPercent: 16.66, stagger: .15, ease: 'none'}, 'sameTime');

        });
    };

    function singleProductImages(){
        $('.single-product__thumbnails__media').on('click', function(e){
            var thisIndex = $(this).data('index');
            $('.single-product__current__media').removeClass('single-product__current__media--is-active');
            $('[data-related="'+ thisIndex +'"]').addClass('single-product__current__media--is-active');
        });
    };

    function dropdowns(){
        $('.dropdown__trigger').on('click', function(){
            var isOpen = $(this).parent('.dropdown').hasClass('dropdown--is-open');

            if(isOpen){
                $(this).parent('.dropdown').removeClass('dropdown--is-open');
            } else {
                $(this).parent('.dropdown').addClass('dropdown--is-open');
            }
        });
    };

    function customAddToCart(){
        $('body').on('click', '.single_add_to_cart_button', function(e) {
            e.preventDefault();
    
            var $thisbutton = $(this),
                thisButtonText = $thisbutton.text();
                product_id = $thisbutton.val(), // Assuming the button value is the product ID
                quantity = $thisbutton.closest('form.cart').find('input.qty').val() || 1;
    
            var data = {
                action: 'custom_add_to_cart',
                product_id: product_id,
                quantity: quantity,
                nonce: custom_ajax_object.nonce
            };
            
            $thisbutton.addClass('no-touch');

            $.post(custom_ajax_object.ajax_url, data, function(response) {
                console.log('Full response:', response); // Log the full response
    
                if (response && response.fragments) {
                    // If the response contains fragments, consider it successful
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                    $thisbutton.text('Product added to cart!');
                    
                    setTimeout(function(){
                        $thisbutton.removeClass('no-touch');
                        $thisbutton.text(thisButtonText);
                    }, 2000);

                } else {
                    alert('Failed to add product to cart.');
                }
            }).fail(function(xhr, status, error) {
                console.error('AJAX error:', status, error); // Log any AJAX errors
                alert('AJAX error: ' + error);
            });
        });
    };

    function blockTextWithNavigation(){
        var $link = $('.text-with-navigation__nav a');

        $link.on('click', function(e){
            e.preventDefault();
            var thisHref = $(this).attr('href');
            var offset = $('.topbar').innerHeight();

            if(window.matchMedia("(max-width: 992px)").matches){
                offset = offset + $('.text-with-navigation__nav').innerHeight();
            };

            console.log(offset);

            lenis.scrollTo(thisHref, {
				offset: -parseFloat(offset),
				// onComplete: ()=>{
				// 	gsap.to('.slides', {autoAlpha: 1});
				// 	// console.log( scrollTriggerID );
				// }
			});

        });
    };

    function preventBarbaOnSomeLinks(){
        $('a[href*="cart"], a[href*="checkout"], a[href*="my-account"], a[href*="wp-login"], .add_to_cart_button, .wpml-ls-link, .wpml-ls-item a').each(function() {
            $(this).attr('data-barba-prevent', true);
        });
    };




    function killAllScrollTrigger() {

        let triggers = ScrollTrigger.getAll();
        triggers.forEach(trigger => {
            trigger.kill();
        });

    };

    function preventSamePageReload() {
        var links = document.querySelectorAll('a[href]');
        var cbk = function (e) {
            if (e.currentTarget.href === window.location.href) {
                e.preventDefault();
                e.stopPropagation();

                // if (!navIsClosed) {
                //     closeNavTl.play();
                // }
            }
        };

        for (var i = 0; i < links.length; i++) {
            links[i].addEventListener('click', cbk);
        }
    };

    function debounce(func, wait, immediate) {
        var timeout;
        return function () {
            var context = this, args = arguments;
            var later = function () {
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