(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var page = document.querySelector('.luxxo-package-detail');
        if (!page) return;

        document.querySelectorAll('.nav-menu a[href="#packages"]').forEach(function (link) {
            link.classList.add('luxxo-package-active');
            link.setAttribute('aria-current', 'page');
        });

        var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        var revealItems = page.querySelectorAll('.luxxo-package-reveal');
        var itinerary = page.querySelector('.luxxo-package-timeline');
        var days = page.querySelectorAll('.luxxo-package-itinerary__item');
        var gallery = page.querySelector('.luxxo-package-gallery__slider');

        if (gallery && typeof Swiper !== 'undefined') {
            new Swiper(gallery, {
                slidesPerView: 1.25,
                spaceBetween: 12,
                watchOverflow: true,
                pagination: {
                    el: gallery.querySelector('.swiper-pagination'),
                    type: 'progressbar'
                },
                breakpoints: {
                    701: { slidesPerView: 3, spaceBetween: 12 },
                    1100: { slidesPerView: 4, spaceBetween: 12 }
                }
            });
        }

        function showAll() {
            revealItems.forEach(function (item) { item.classList.add('is-visible'); });
            days.forEach(function (day) { day.classList.add('is-active'); });
            if (itinerary) itinerary.style.setProperty('--timeline-progress', '100%');
        }

        if (reduceMotion || !('IntersectionObserver' in window)) {
            showAll();
            return;
        }

        var revealObserver = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        revealItems.forEach(function (item) { revealObserver.observe(item); });

        var activeDays = 0;
        var dayObserver = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting || entry.target.classList.contains('is-active')) return;
                entry.target.classList.add('is-active');
                activeDays += 1;
                if (itinerary && days.length) itinerary.style.setProperty('--timeline-progress', (activeDays / days.length * 100) + '%');
                observer.unobserve(entry.target);
            });
        }, { threshold: 0.18, rootMargin: '0px 0px -10% 0px' });
        days.forEach(function (day) { dayObserver.observe(day); });
    });
}());
