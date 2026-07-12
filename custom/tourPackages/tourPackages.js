document.addEventListener('DOMContentLoaded', function () {

    if (document.querySelector('.packageSwiper')) {
        const swiper = new Swiper('.packageSwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true, 

            autoplay: {
                delay: 3000,            
                disableOnInteraction: false, 
                pauseOnMouseEnter: true 
            },

            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },

            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1200: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
            },
        });
    }

    /**
     * Enables the native CSS sticky card stack on desktop only. CSS performs
     * the animation, avoiding scroll handlers and layout work while scrolling.
     */
    const packagesList = document.querySelector('.packages .packages-list');
    const stackBreakpoint = window.matchMedia('(min-width: 1024px)');

    if (packagesList) {
        const packageCards = Array.from(
            packagesList.querySelectorAll('.package-card.horizontal')
        );

        const updatePackageStack = function () {
            const enableStack = stackBreakpoint.matches && packageCards.length > 1;

            packagesList.classList.toggle('packages-list--stacking', enableStack);

            packageCards.forEach(function (card, index) {
                if (enableStack) {
                    card.style.setProperty('--package-stack-index', index);
                    
                } else {
                    card.style.removeProperty('--package-stack-index');
                }
            });
        };

        updatePackageStack();

        if (typeof stackBreakpoint.addEventListener === 'function') {
            stackBreakpoint.addEventListener('change', updatePackageStack);
        } else {
            stackBreakpoint.addListener(updatePackageStack);
        }
    }

});
