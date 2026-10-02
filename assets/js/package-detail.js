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

        var galleryTriggers = Array.prototype.slice.call(page.querySelectorAll('.luxxo-package-gallery__trigger'));
        if (galleryTriggers.length) {
            var galleryItems = galleryTriggers.map(function (trigger) {
                return { src: trigger.getAttribute('data-gallery-src'), alt: trigger.getAttribute('data-gallery-alt') || 'Gallery image' };
            });
            var lightbox = document.createElement('div');
            lightbox.className = 'luxxo-gallery-lightbox';
            lightbox.setAttribute('role', 'dialog');
            lightbox.setAttribute('aria-modal', 'true');
            lightbox.setAttribute('aria-label', 'Image gallery');
            lightbox.innerHTML = '<div class="luxxo-gallery-lightbox__stage"><button class="luxxo-gallery-lightbox__close" type="button" aria-label="Close gallery"><i class="fas fa-times" aria-hidden="true"></i></button><button class="luxxo-gallery-lightbox__arrow luxxo-gallery-lightbox__arrow--prev" type="button" aria-label="Previous image"><i class="fas fa-chevron-left" aria-hidden="true"></i></button><img class="luxxo-gallery-lightbox__image" alt=""><button class="luxxo-gallery-lightbox__arrow luxxo-gallery-lightbox__arrow--next" type="button" aria-label="Next image"><i class="fas fa-chevron-right" aria-hidden="true"></i></button></div><div class="luxxo-gallery-lightbox__thumbs" aria-label="Gallery thumbnails"></div>';
            document.body.appendChild(lightbox);

            var lightboxImage = lightbox.querySelector('.luxxo-gallery-lightbox__image');
            var thumbnails = lightbox.querySelector('.luxxo-gallery-lightbox__thumbs');
            var currentIndex = 0;
            var previousFocus = null;
            var touchStartX = 0;

            galleryItems.forEach(function (item, index) {
                var thumbnail = document.createElement('button');
                var thumbnailImage = document.createElement('img');
                thumbnail.type = 'button';
                thumbnail.className = 'luxxo-gallery-lightbox__thumb';
                thumbnail.setAttribute('aria-label', 'View image ' + (index + 1));
                thumbnailImage.src = item.src;
                thumbnailImage.alt = '';
                thumbnail.appendChild(thumbnailImage);
                thumbnail.addEventListener('click', function () { showImage(index); });
                thumbnails.appendChild(thumbnail);
            });

            function showImage(index) {
                currentIndex = (index + galleryItems.length) % galleryItems.length;
                lightbox.classList.remove('is-ready');
                window.setTimeout(function () {
                    lightboxImage.onload = function () { lightbox.classList.add('is-ready'); };
                    lightboxImage.src = galleryItems[currentIndex].src;
                    lightboxImage.alt = galleryItems[currentIndex].alt;
                    if (lightboxImage.complete) lightbox.classList.add('is-ready');
                    Array.prototype.forEach.call(thumbnails.children, function (thumbnail, thumbnailIndex) {
                        var active = thumbnailIndex === currentIndex;
                        thumbnail.classList.toggle('is-active', active);
                        thumbnail.setAttribute('aria-current', active ? 'true' : 'false');
                        if (active) thumbnail.scrollIntoView({ block: 'nearest', inline: 'center', behavior: 'smooth' });
                    });
                }, 80);
            }

            function openLightbox(index) {
                previousFocus = document.activeElement;
                lightbox.classList.add('is-open');
                document.body.classList.add('luxxo-lightbox-open');
                showImage(index);
                lightbox.querySelector('.luxxo-gallery-lightbox__close').focus();
            }

            function closeLightbox() {
                lightbox.classList.remove('is-open', 'is-ready');
                document.body.classList.remove('luxxo-lightbox-open');
                if (previousFocus) previousFocus.focus();
            }

            galleryTriggers.forEach(function (trigger, index) {
                trigger.addEventListener('click', function () { openLightbox(index); });
            });
            lightbox.querySelector('.luxxo-gallery-lightbox__close').addEventListener('click', closeLightbox);
            lightbox.querySelector('.luxxo-gallery-lightbox__arrow--prev').addEventListener('click', function () { showImage(currentIndex - 1); });
            lightbox.querySelector('.luxxo-gallery-lightbox__arrow--next').addEventListener('click', function () { showImage(currentIndex + 1); });
            lightbox.querySelector('.luxxo-gallery-lightbox__stage').addEventListener('click', function (event) { if (event.target === event.currentTarget) closeLightbox(); });
            lightbox.addEventListener('touchstart', function (event) { touchStartX = event.changedTouches[0].screenX; }, { passive: true });
            lightbox.addEventListener('touchend', function (event) { var difference = event.changedTouches[0].screenX - touchStartX; if (Math.abs(difference) > 45) showImage(currentIndex + (difference > 0 ? -1 : 1)); }, { passive: true });
            document.addEventListener('keydown', function (event) {
                if (!lightbox.classList.contains('is-open')) return;
                if (event.key === 'Escape') closeLightbox();
                if (event.key === 'ArrowLeft') showImage(currentIndex - 1);
                if (event.key === 'ArrowRight') showImage(currentIndex + 1);
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
