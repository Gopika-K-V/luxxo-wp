<?php
/* Template Name: Fleet & Vehicles */

$hero_title = function_exists( 'get_field' ) ? get_field( 'fleet_hero_title' ) : '';
$hero_description = function_exists( 'get_field' ) ? get_field( 'fleet_hero_description' ) : '';
$hero_tag = function_exists( 'get_field' ) ? get_field( 'fleet_hero_tag' ) : '';
$features = function_exists( 'get_field' ) ? get_field( 'fleet_features' ) : array();
$section_tag = function_exists( 'get_field' ) ? get_field( 'fleet_section_tag' ) : '';
$section_title = function_exists( 'get_field' ) ? get_field( 'fleet_section_title' ) : '';
$section_description = function_exists( 'get_field' ) ? get_field( 'fleet_section_description' ) : '';
$vehicles = function_exists( 'get_field' ) ? get_field( 'fleet_vehicles' ) : array();
$cta_tag = function_exists( 'get_field' ) ? get_field( 'fleet_cta_tag' ) : '';
$cta_title = function_exists( 'get_field' ) ? get_field( 'fleet_cta_title' ) : '';
$cta_description = function_exists( 'get_field' ) ? get_field( 'fleet_cta_description' ) : '';
$cta_button = function_exists( 'get_field' ) ? get_field( 'fleet_cta_button_text' ) : '';
$cta_link = function_exists( 'get_field' ) ? get_field( 'fleet_cta_button_link' ) : '';
$whatsapp_url = 'https://wa.me/7994737579';

wp_enqueue_style( 'luxxo-fleet-vehicles', get_template_directory_uri() . '/assets/css/fleet-vehicles.css', array(), wp_get_theme()->get( 'Version' ) );
get_header();
?>
<main class="luxxo-fleet">
    <section class="luxxo-fleet-hero">
        <div class="luxxo-fleet-wrap">
            <?php if ( $hero_tag ) : ?><span class="luxxo-fleet-pill"><i class="fas fa-circle-check" aria-hidden="true"></i><?php echo esc_html( $hero_tag ); ?></span><?php endif; ?>
            <h1><?php echo wp_kses_post( $hero_title ?: 'Travel in Comfort Across <em>South India</em>' ); ?></h1>
            <?php if ( $hero_description ) : ?><p class="luxxo-fleet-lead"><?php echo esc_html( $hero_description ); ?></p><?php endif; ?>
            <?php if ( $features ) : ?><div class="luxxo-fleet-features">
                <?php foreach ( $features as $feature ) : ?><div class="luxxo-fleet-feature"><span class="luxxo-fleet-feature__icon"><i class="<?php echo esc_attr( $feature['icon'] ?? 'fas fa-check' ); ?>" aria-hidden="true"></i></span><div><strong><?php echo esc_html( $feature['title'] ?? '' ); ?></strong><small><?php echo esc_html( $feature['subtitle'] ?? '' ); ?></small></div></div><?php endforeach; ?>
            </div><?php endif; ?>
        </div>
    </section>

    <section class="luxxo-fleet-listing">
        <div class="luxxo-fleet-wrap">
            <div class="luxxo-fleet-heading"><div><?php if ( $section_tag ) : ?><span class="luxxo-fleet-eyebrow"><?php echo esc_html( $section_tag ); ?></span><?php endif; ?><h2><?php echo esc_html( $section_title ?: 'Our Curated Chauffeur Fleet' ); ?></h2><?php if ( $section_description ) : ?><p><?php echo esc_html( $section_description ); ?></p><?php endif; ?></div></div>
            <?php if ( $vehicles ) : ?><div class="luxxo-fleet-grid">
                <?php foreach ( $vehicles as $vehicle ) :
                    $image = $vehicle['image'] ?? 0;
                    $image_id = is_array( $image ) ? (int) ( $image['ID'] ?? $image['id'] ?? 0 ) : (int) $image;
                    $image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'large' ) : ( is_string( $image ) ? $image : '' );
                    $link = $vehicle['details_link'] ?? '';
                    $whatsapp_message = ! empty( $vehicle['whatsapp_message'] )
                        ? $vehicle['whatsapp_message']
                        : sprintf( 'Hi, I am interested in the %s. Please share availability and a customized quote.', $vehicle['title'] ?? 'vehicle' );
                    $vehicle_whatsapp_url = 'https://wa.me/7994737579?text=' . rawurlencode( $whatsapp_message );
                ?>
                    <article class="luxxo-vehicle-card<?php echo ! empty( $vehicle['featured'] ) ? ' is-featured' : ''; ?>">
                        <div class="luxxo-vehicle-card__image"><?php if ( $image_url ) : ?><img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $vehicle['title'] ?? '' ); ?>" loading="lazy"><?php endif; ?><?php if ( ! empty( $vehicle['badge'] ) ) : ?><span class="luxxo-vehicle-badge"><?php echo esc_html( $vehicle['badge'] ); ?></span><?php endif; ?><?php if ( ! empty( $vehicle['featured'] ) ) : ?><span class="luxxo-vehicle-featured"><i class="fas fa-star" aria-hidden="true"></i><?php echo esc_html( $vehicle['featured_label'] ?? 'Featured Luxury' ); ?></span><?php endif; ?><?php if ( ! empty( $vehicle['air_conditioning'] ) ) : ?><span class="luxxo-vehicle-ac"><i class="fas fa-snowflake" aria-hidden="true"></i> AC</span><?php endif; ?></div>
                        <div class="luxxo-vehicle-card__body"><div class="luxxo-vehicle-card__title"><h3><?php echo esc_html( $vehicle['title'] ?? '' ); ?></h3><?php if ( ! empty( $vehicle['featured'] ) ) : ?><i class="fas fa-certificate" aria-label="Featured"></i><?php endif; ?></div>
                            <?php if ( ! empty( $vehicle['description'] ) ) : ?><p class="luxxo-vehicle-card__description"><?php echo esc_html( $vehicle['description'] ); ?></p><?php endif; ?>
                            <div class="luxxo-vehicle-specs"><?php if ( ! empty( $vehicle['seats'] ) ) : ?><span><i class="fas fa-user-group" aria-hidden="true"></i><?php echo esc_html( $vehicle['seats'] ); ?> Seats</span><?php endif; ?><?php if ( ! empty( $vehicle['bags'] ) ) : ?><span><i class="fas fa-suitcase" aria-hidden="true"></i><?php echo esc_html( $vehicle['bags'] ); ?> Bags</span><?php endif; ?></div>
                            <div class="luxxo-vehicle-price"><small><?php echo esc_html( $vehicle['price_label'] ?? 'Starting from' ); ?></small><strong><?php echo esc_html( $vehicle['price'] ?? '' ); ?></strong><?php if ( ! empty( $vehicle['price_unit'] ) ) : ?><span>/ <?php echo esc_html( $vehicle['price_unit'] ); ?></span><?php endif; ?></div>
                            <?php if ( $link ) : ?><a class="luxxo-vehicle-button" href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $vehicle['button_text'] ?? 'View Details' ); ?><i class="fas fa-arrow-right" aria-hidden="true"></i></a><?php endif; ?>
                            <a class="luxxo-vehicle-whatsapp" href="<?php echo esc_url( $vehicle_whatsapp_url ); ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp" aria-hidden="true"></i> Enquiry through WhatsApp</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div><?php endif; ?>
        </div>
    </section>

    <section class="luxxo-fleet-cta"><div class="luxxo-fleet-wrap"><div class="luxxo-fleet-cta__panel"><div class="luxxo-fleet-cta__copy"><?php if ( $cta_tag ) : ?><span class="luxxo-fleet-pill"><i class="fas fa-route" aria-hidden="true"></i><?php echo esc_html( $cta_tag ); ?></span><?php endif; ?><h2><?php echo esc_html( $cta_title ?: 'Explore South India with Our Fleet' ); ?></h2><?php if ( $cta_description ) : ?><p><?php echo esc_html( $cta_description ); ?></p><?php endif; ?></div><div class="luxxo-fleet-cta__actions"><?php if ( $cta_link ) : ?><a class="luxxo-fleet-cta__button" href="<?php echo esc_url( $cta_link ); ?>"><?php echo esc_html( $cta_button ?: 'Enquire for a Customized Quote' ); ?> <i class="far fa-envelope" aria-hidden="true"></i></a><?php endif; ?><?php if ( $whatsapp_url ) : ?><a class="luxxo-fleet-cta__whatsapp" href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp" aria-hidden="true"></i> WhatsApp Concierge</a><?php endif; ?></div></div></div></section>
        
<!-- SEO Content Section -->
<?php include get_template_directory() . '/custom/seocontent/seo-content.php'; ?>
</main>
<?php get_footer(); ?>