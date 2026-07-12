<!-- Destinations Section -->
<section class="top-destinations-wrapper">
    <div class="destinations" id="topDestinations">
        <div class="container">

            <!-- Section Header -->
            <div class="section-header center">
                <span class="section-subtitle"><?php the_field('sub_heading'); ?></span>
                <h2 class="section-title"><?php the_field('top_destinations'); ?></h2>
                <p><?php the_field('top_destinations_description'); ?></p>
            </div>

            <!-- Grid -->
            <div class="destinations-grid">

                <?php
                $destination_count = 0;

                if (have_rows('destination_grid')):
                    while (have_rows('destination_grid')) : the_row();
                        if ($destination_count >= 7) {
                            break;
                        }

                        $image = get_sub_field('destination_image');
                        $name = get_sub_field('destination_name');
                        $location = get_sub_field('destination_location');
                        $price = get_sub_field('starting_price');
                        $link = get_sub_field('destination_link'); // optional
                        $description = get_sub_field('destination_description');
                        $itinerary = get_sub_field('destination_itinerary'); // optional itinerary link
                        $destination_count++;
                ?>

                        <a href="<?php echo $link ? esc_url($link) : ''; ?>" class="destination-card" data-description="<?php echo esc_attr($description); ?>" data-itinerary="<?php echo $itinerary ? esc_url($itinerary) : ''; ?>">

                            <div class="card-image">
                                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($name); ?>">
                                <div class="card-overlay"></div>

                                <?php if ($price): ?>
                                    <div class="card-price">Starts at ₹<?php echo esc_html($price); ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="card-content">
                                <h3><?php echo esc_html($name); ?></h3>
                                <p><?php echo esc_html($location); ?></p>

                                <span class="btn-explore">
                                    Explore <i class="fas fa-arrow-right"></i>
                                </span>
                            </div>

                        </a>

                <?php endwhile;
                endif;

                $explore_more_url = 'https://wa.me/917994737579?text=' . rawurlencode('Hi, I would like to explore more destinations.');
                ?>

                <a class="destination-card destination-card--explore-more" href="<?php echo esc_url($explore_more_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Explore more destinations on WhatsApp', 'luxxo-holidays'); ?>">
                    <span class="destination-explore-more__label">
                        <?php esc_html_e('Explore More', 'luxxo-holidays'); ?>
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </span>
                </a>

            </div>
        </div>
    </div><!-- .destinations -->

    <!-- Offcanvas markup (opens when clicking Explore) -->
    <div id="td-offcanvas" class="td-offcanvas" aria-hidden="true">
        <div class="td-offcanvas-backdrop" data-target="offcanvas"></div>
        <div class="td-offcanvas-panel" role="dialog" aria-modal="true">
            <button class="td-offcanvas-close" aria-label="Close">&times;</button>
            <div class="td-offcanvas-content"></div>
        </div>
    </div>

</section><!-- .top-destinations-wrapper -->

<script>
    (function() {
        // Inline JS to open offcanvas when .btn-explore is clicked
        var wrapper = document.querySelector('.top-destinations-wrapper');
        var offcanvas = document.getElementById('td-offcanvas');
        if (!wrapper || !offcanvas) {
            return;
        }

        var content = offcanvas.querySelector('.td-offcanvas-content');
        var closeBtn = offcanvas.querySelector('.td-offcanvas-close');
        var backdrop = offcanvas.querySelector('.td-offcanvas-backdrop');

        function openOffcanvas(html) {
            content.innerHTML = html || '';
            offcanvas.classList.add('open');
            offcanvas.setAttribute('aria-hidden', 'false');
            document.documentElement.style.overflow = 'hidden';
        }

        function closeOffcanvas() {
            offcanvas.classList.remove('open');
            offcanvas.setAttribute('aria-hidden', 'true');
            document.documentElement.style.overflow = '';
        }

        // Open destination details from anywhere on a standard destination card.
        wrapper.addEventListener('click', function(e) {
            var card = e.target.closest('.destination-card:not(.destination-card--explore-more)');
            if (!card || !wrapper.contains(card)) return;
            e.preventDefault();
            var title = card && card.querySelector('h3') ? card.querySelector('h3').textContent : '';
            var img = card && card.querySelector('img') ? card.querySelector('img').src : '';
            var location = card && card.querySelector('.card-content p') ? card.querySelector('.card-content p').textContent : '';
            var price = card && card.querySelector('.card-price') ? card.querySelector('.card-price').textContent : '';
            var href = card ? card.getAttribute('href') : '#';
            var description = card ? card.getAttribute('data-description') : '';
            var itinerary = card ? card.getAttribute('data-itinerary') : '';

            // WhatsApp link (India +91). Message includes the destination name.
            var waNumber = '91' + '7994737579';
            var waMsg = encodeURIComponent('Hi, I am interested in ' + (title || '') + '.');
            var waUrl = 'https://wa.me/' + waNumber + '?text=' + waMsg;

            var itineraryBtn = '';
            if (itinerary) {
                itineraryBtn = '<a class="btn btn-secondary btn-itinerary" href="' + itinerary + '" target="_blank" rel="noopener noreferrer">View itinerary</a>';
            }

            var connectBtn = '<a class="btn btn-whatsapp" href="' + waUrl + '" target="_blank" rel="noopener noreferrer">Connect with us</a>';

            var html = '\n            <div class="offcanvas-hero"><img src="' + (img || '') + '" alt="' + (title || '') + '"/></div>\n            <div class="offcanvas-body">\n                <h2>' + (title || '') + '</h2>\n                <p class="muted">' + (location || '') + '</p>\n                <p class="price">' + (price || '') + '</p>\n                <div class="description">' + (description || '') + '</div>\n                <div class="offcanvas-actions">' + itineraryBtn + connectBtn + '</div>\n                <a class="btn btn-primary" href="' + (href || '#') + '">View details</a>\n            </div>';

            openOffcanvas(html);
        });

        closeBtn && closeBtn.addEventListener('click', closeOffcanvas);
        backdrop && backdrop.addEventListener('click', closeOffcanvas);
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeOffcanvas();
        });
    })();
</script>
