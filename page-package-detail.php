<?php
/* Template Name: Package Detail */

get_header();

$field = function( $name, $default = '' ) {
    $value = function_exists( 'get_field' ) ? get_field( $name ) : '';
    return $value !== '' && $value !== null ? $value : $default;
};
$image_id = function( $image ) {
    return is_array( $image ) ? (int) ( $image['ID'] ?? $image['id'] ?? 0 ) : (int) $image;
};

$title       = $field( 'package_title', get_the_title() );
$description = $field( 'package_short_description' );
$hero_id     = $image_id( $field( 'package_hero_image' ) );
$experience_title = $field( 'package_experience_title', 'The Experience' );
$experience_content = $field( 'package_experience_content' );
$booking_description = $field( 'package_booking_description', 'Experience the magic of Kerala with our expert guides.' );
$whatsapp_number = preg_replace( '/\D+/', '', (string) $field( 'whatsapp_number', '917994737579' ) );
$whatsapp_message = $field( 'package_whatsapp_message', sprintf( 'Hi, I am interested in the package: %s.', $title ) );
$contact_url = home_url( '/contact-us/' );
?>

<main class="luxxo-package-detail">
    <section class="luxxo-package-hero">
        <?php if ( $hero_id ) : ?>
            <?php echo wp_get_attachment_image( $hero_id, 'full', false, array( 'class' => 'luxxo-package-hero__image', 'fetchpriority' => 'high', 'loading' => 'eager' ) ); ?>
        <?php endif; ?>
        <div class="luxxo-package-hero__overlay"></div>
        <div class="luxxo-package-container luxxo-package-hero__content">
            <h1 class="luxxo-package-reveal"><?php echo esc_html( $title ); ?></h1>
            <?php if ( $description ) : ?><p class="luxxo-package-reveal"><?php echo esc_html( $description ); ?></p><?php endif; ?>
        </div>
    </section>

    <div class="luxxo-package-container luxxo-package-meta-wrap luxxo-package-reveal">
        <section class="luxxo-package-meta" aria-label="Package details">
            <?php $meta = array( array( 'far fa-clock', 'Duration', $field( 'package_duration' ) ), array( 'fas fa-location-dot', 'Destinations', $field( 'package_destinations' ) ), array( 'far fa-star', 'Category', $field( 'package_category' ) ) ); ?>
            <?php foreach ( $meta as $item ) : if ( ! $item[2] ) continue; ?>
                <div class="luxxo-package-meta__item"><i class="<?php echo esc_attr( $item[0] ); ?>" aria-hidden="true"></i><div><span><?php echo esc_html( $item[1] ); ?></span><strong><?php echo esc_html( $item[2] ); ?></strong></div></div>
            <?php endforeach; ?>
        </section>
    </div>

    <div class="luxxo-package-container luxxo-package-layout">
        <div class="luxxo-package-main">
            <?php if ( $experience_content ) : ?><section class="luxxo-package-section luxxo-package-reveal"><h2><?php echo esc_html( $experience_title ); ?></h2><div class="luxxo-package-prose"><?php echo wp_kses_post( $experience_content ); ?></div></section><?php endif; ?>

            <?php if ( function_exists( 'have_rows' ) && have_rows( 'package_itinerary' ) ) : ?>
                <section class="luxxo-package-section luxxo-package-itinerary" aria-labelledby="itinerary-title"><h2 id="itinerary-title">Day by Day Itinerary</h2><div class="luxxo-package-timeline">
                <?php $index = 0; while ( have_rows( 'package_itinerary' ) ) : the_row(); $index++; $day = get_sub_field( 'day_number' ) ?: $index; $day_image = $image_id( get_sub_field( 'day_image' ) ); ?>
                    <article class="luxxo-package-itinerary__item <?php echo $index % 2 ? 'is-left' : 'is-right'; ?>"><div class="luxxo-package-itinerary__dot" aria-hidden="true"></div><div class="luxxo-package-itinerary__content"><p class="luxxo-package-itinerary__eyebrow"><?php echo esc_html( get_sub_field( 'optional_label' ) ?: 'Day ' . $day ); ?></p><h3>Day <?php echo esc_html( $day ); ?>: <?php echo esc_html( get_sub_field( 'day_title' ) ); ?></h3><?php if ( get_sub_field( 'optional_location' ) ) : ?><p class="luxxo-package-itinerary__location"><i class="fas fa-location-dot" aria-hidden="true"></i><?php echo esc_html( get_sub_field( 'optional_location' ) ); ?></p><?php endif; ?><p><?php echo nl2br( esc_html( get_sub_field( 'day_description' ) ) ); ?></p></div><?php if ( $day_image ) : ?><div class="luxxo-package-itinerary__image"><?php echo wp_get_attachment_image( $day_image, 'large', false, array( 'loading' => 'lazy' ) ); ?></div><?php endif; ?></article>
                <?php endwhile; ?></div></section>
            <?php endif; ?>

            <?php $included = function_exists( 'get_field' ) ? get_field( 'package_included' ) : array(); $excluded = function_exists( 'get_field' ) ? get_field( 'package_excluded' ) : array(); if ( $included || $excluded ) : ?><section class="luxxo-package-inclusions luxxo-package-reveal"><div class="luxxo-package-list-card is-included"><h2><i class="far fa-check-circle" aria-hidden="true"></i>What's Included</h2><ul><?php foreach ( (array) $included as $row ) : if ( ! empty( $row['item'] ) ) : ?><li><?php echo esc_html( $row['item'] ); ?></li><?php endif; endforeach; ?></ul></div><div class="luxxo-package-list-card is-excluded"><h2><i class="far fa-times-circle" aria-hidden="true"></i>What's Excluded</h2><ul><?php foreach ( (array) $excluded as $row ) : if ( ! empty( $row['item'] ) ) : ?><li><?php echo esc_html( $row['item'] ); ?></li><?php endif; endforeach; ?></ul></div></section><?php endif; ?>

            <?php $gallery = function_exists( 'get_field' ) ? get_field( 'package_gallery' ) : array(); if ( $gallery ) : ?><section class="luxxo-package-section luxxo-package-gallery luxxo-package-reveal"><h2>Visualise Your Journey</h2><div class="luxxo-package-gallery__slider swiper"><div class="swiper-wrapper"><?php foreach ( $gallery as $gallery_image ) : $gallery_id = $image_id( $gallery_image ); if ( $gallery_id ) : ?><figure class="swiper-slide"><?php echo wp_get_attachment_image( $gallery_id, 'large', false, array( 'loading' => 'lazy' ) ); ?></figure><?php endif; endforeach; ?></div><div class="luxxo-package-gallery__progress swiper-pagination" aria-label="Gallery progress"></div></div></section><?php endif; ?>
        </div>

        <aside class="luxxo-package-booking" aria-label="Package enquiry"><div class="luxxo-package-booking__card"><h2>Book This Journey</h2><p><?php echo esc_html( $booking_description ); ?></p><form action="<?php echo esc_url( $contact_url ); ?>" method="get"><input type="hidden" name="package" value="<?php echo esc_attr( $title ); ?>"><label>Name<input type="text" name="name" autocomplete="name" placeholder="Your full name" required></label><label>Email<input type="email" name="email" autocomplete="email" placeholder="Your email address" required></label><label>Travel Date<input type="date" name="travel_date"></label><button type="submit">Enquire Now</button></form><a class="luxxo-package-whatsapp" href="https://wa.me/<?php echo esc_attr( $whatsapp_number ); ?>?text=<?php echo rawurlencode( $whatsapp_message ); ?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp" aria-hidden="true"></i>WhatsApp Us</a></div></aside>
    </div>
</main>

<?php get_footer(); ?>
