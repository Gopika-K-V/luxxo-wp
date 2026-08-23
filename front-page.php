<?php get_header(); ?>

<!-- HERO SECTION -->

<?php include get_template_directory() . '/custom/homeBanner/homeBanner.php'; ?>

<!-- Current Offers  -->

<?php include get_template_directory() . '/custom/currentOffers/current-offers.php'; ?>

<!--Experiece Slider -->

<?php include get_template_directory() . '/custom/experienceSlider/experienceSlider.php'; ?>

<!--WHY Choose Luxxo -->
<?php include get_template_directory() . '/custom/whychoose/why-choose.php'; ?>

<!-- TOP DESTINATIONS -->
<?php include get_template_directory() . '/custom/topDestinations/topDestinations.php'; ?>


<!--TOUR PACKAGES -->
<?php include get_template_directory() . '/custom/tourPackages/tourPackages.php'; ?>

<!-- GOOGLE REVIEWS -->
<?php include get_template_directory() . '/custom/googleReviews/googleReviews.php'; ?>


<!--BOOKING STEPS -->
<section class="booking-steps">
    <h2>Booking made as easy as 1-2-3.</h2>
    <div class="steps-grid">
        <div class="step">
            <div class="step-icon">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            <h3>Pick Your Destination</h3>
            <p>Browse our curated list of South India destinations and find your perfect getaway.</p>
        </div>
        <div class="step">
            <div class="step-icon">
                <i class="fas fa-sliders-h"></i>
            </div>
            <h3>Customize Your Tour</h3>
            <p>Tailor your itinerary with activities, accommodations, and experiences that suit you.</p>
        </div>
        <div class="step">
            <div class="step-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3>Confirm & Travel</h3>
            <p>Secure your booking with easy payment options and get ready for your adventure!</p>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="why-us" id="why-us">
    <div class="container">
        <div class="section-header center">
            <span class="section-subtitle">The Luxxo Standard</span>
            <h2 class="section-title">Why Choose Us</h2>
        </div>

        <div class="features-grid">
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-map-marked-alt"></i></div>
                <h3>Tailor-Made Itineraries</h3>
                <p>Journeys crafted specifically around your unique travel preferences.</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-hotel"></i></div>
                <h3>Premium Stays</h3>
                <p>Handpicked luxury resorts, heritage villas, and 5-star houseboats.</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-headset"></i></div>
                <h3>24/7 Support</h3>
                <p>Dedicated travel concierge to assist you before, during, and after your trip.</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-compass"></i></div>
                <h3>Local Expertise</h3>
                <p>Insider knowledge providing you deeply authentic and curated experiences.</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                <h3>Trusted Service</h3>
                <p>Uncompromising quality and transparency ensuring complete peace of mind.</p>
            </div>
        </div>
    </div>
</section>


<!-- CTA Section -->
<?php
$cta_background_image = function_exists('get_field') ? get_field('cta_background_image') : '';
$cta_background_url   = 'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&q=80&w=1920';
$cta_background_alt   = '';
$cta_title            = function_exists('get_field') && get_field('cta_title') ? get_field('cta_title') : 'Let’s Craft Your Dream Kerala Journey';
$cta_description      = function_exists('get_field') && get_field('cta_description') ? get_field('cta_description') : 'Speak to our luxury travel experts today and let us start planning an unforgettable getaway.';
$cta_button_label     = function_exists('get_field') && get_field('cta_button_label') ? get_field('cta_button_label') : 'Contact Us';
$cta_button_url       = function_exists('get_field') && get_field('cta_button_url') ? get_field('cta_button_url') : '#contact';

if (is_array($cta_background_image)) {
    $cta_background_url = $cta_background_image['url'] ?? $cta_background_url;
    $cta_background_alt = $cta_background_image['alt'] ?? '';
} elseif (is_numeric($cta_background_image)) {
    $cta_background_url = wp_get_attachment_image_url((int) $cta_background_image, 'full') ?: $cta_background_url;
    $cta_background_alt = get_post_meta((int) $cta_background_image, '_wp_attachment_image_alt', true);
} elseif (is_string($cta_background_image) && $cta_background_image !== '') {
    $cta_background_url = $cta_background_image;
}
?>
<section class="cta" id="cta">
    <img
        class="cta-background-image"
        src="<?php echo esc_url($cta_background_url); ?>"
        alt="<?php echo esc_attr($cta_background_alt); ?>"
        loading="lazy"
        decoding="async">
    <div class="cta-overlay"></div>
    <div class="container cta-content">
        <h2><?php echo esc_html($cta_title); ?></h2>
        <p><?php echo esc_html($cta_description); ?></p>
        <a href="<?php echo esc_url($cta_button_url); ?>" class="btn-primary btn-large"><?php echo esc_html($cta_button_label); ?></a>
    </div>
</section>

<?php include get_template_directory() . '/custom/quickaction/quick-actions.php'; ?>

<!-- SEO Content Section -->
<?php include get_template_directory() . '/custom/seocontent/seo-content.php'; ?>
<?php get_footer(); ?>
