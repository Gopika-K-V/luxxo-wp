/* =========================================
   LUXXO HOLIDAYS - MAIN SCRIPT
   ========================================= */



document.addEventListener('DOMContentLoaded', () => {
    if (typeof Swiper !== 'undefined' && document.querySelector('.experience-swiper')) {
        new Swiper('.experience-swiper', {
            slidesPerView: 3,
            spaceBetween: 24,
            loop: true,
            speed: 700,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
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
                0: { slidesPerView: 1.5 },
                575: { slidesPerView: 2 },
                640: { slidesPerView: 2.5 },
                1024: { slidesPerView: 3 },
                1600: { slidesPerView: 4 },
            }
        });
    }

    /* --- 1. Sticky Header --- */
    const header = document.getElementById('header');

    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }

    /* --- 2. Hero Slider --- */
    const slides = document.querySelectorAll('.slide');
    const nextBtn = document.getElementById('next-btn');
    const prevBtn = document.getElementById('prev-btn');
    const activeSlideIndex = Array.from(slides).findIndex(slide => slide.classList.contains('active'));
    let currentSlide = activeSlideIndex >= 0 ? activeSlideIndex : 0;
    const slideIntervalTime = 3000;
    let slideInterval;

    if (slides.length && activeSlideIndex === -1) {
        slides[0].classList.add('active');
    }

    const nextSlide = () => {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    };

    const prevSlideFn = () => {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        slides[currentSlide].classList.add('active');
    };

    const startSlide = () => {
        slideInterval = setInterval(nextSlide, slideIntervalTime);
    };

    const resetInterval = () => {
        clearInterval(slideInterval);
        startSlide();
    };

    if (slides.length > 1) {
        startSlide();

        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                nextSlide();
                resetInterval();
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                prevSlideFn();
                resetInterval();
            });
        }
    }

    /* --- 3. Smooth Scrolling for Anchor Links --- */
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            
            // Allow default for placeholders or empty hashes
            if (targetId === '#') return;
            
            e.preventDefault();
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                const headerHeight = header ? header.offsetHeight : 0;
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerHeight;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    /* --- 4. Mobile Menu Toggle (Basic) --- */
    const mobileToggle = document.getElementById('mobile-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (mobileToggle && navMenu) {
        mobileToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            navMenu.style.display = navMenu.style.display === 'block' ? 'none' : 'block';
            
            // Mobile toggle styling
            if(navMenu.style.display === 'block') {
                navMenu.style.position = 'absolute';
                navMenu.style.top = '100%';
                navMenu.style.left = '0';
                navMenu.style.width = '100%';
                navMenu.style.backgroundColor = 'var(--primary-color)';
                navMenu.style.padding = '20px';
                
                const ul = navMenu.querySelector('ul');
                ul.style.flexDirection = 'column';
                ul.style.gap = '20px';
            }
        });
    }

});
