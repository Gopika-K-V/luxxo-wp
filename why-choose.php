<?php
/**
 * Premium Why Choose Us section.
 *
 * @package Luxxo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$luxxo_why_page_id = get_queried_object_id();

$luxxo_why_field = static function ( $name, $fallback = '' ) use ( $luxxo_why_page_id ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $fallback;
	}

	// Use the queried page explicitly in case an earlier custom loop changed $post.
	$value = get_field( $name, $luxxo_why_page_id );
	return ! empty( $value ) ? $value : $fallback;
};

$luxxo_why_title       = $luxxo_why_field( 'title', 'Travel, thoughtfully designed around you.' );
$luxxo_why_description = $luxxo_why_field( 'description', 'From handpicked stays to seamless local experiences, every detail is shaped by specialists who know South India intimately.' );
$luxxo_why_image       = $luxxo_why_field( 'why_choose_image' );
$luxxo_why_image_url   = 'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&q=85&w=1400';
$luxxo_why_image_alt   = $luxxo_why_field( 'why_choose_image_alt', 'A scenic luxury travel experience in Kerala' );
$luxxo_why_image_id    = 0;

// Also accept existing ACF fields named "image" or "why_choose_section_image".
if ( empty( $luxxo_why_image ) ) {
	$luxxo_why_image = $luxxo_why_field( 'image' );
}

if ( empty( $luxxo_why_image ) ) {
	$luxxo_why_image = $luxxo_why_field( 'why_choose_section_image' );
}

if ( is_array( $luxxo_why_image ) ) {
	$luxxo_why_image_id  = ! empty( $luxxo_why_image['ID'] ) ? (int) $luxxo_why_image['ID'] : 0;
	$luxxo_why_image_url = ! empty( $luxxo_why_image['url'] ) ? $luxxo_why_image['url'] : $luxxo_why_image_url;
	$luxxo_why_image_alt = ! empty( $luxxo_why_image['alt'] ) ? $luxxo_why_image['alt'] : $luxxo_why_image_alt;
} elseif ( is_numeric( $luxxo_why_image ) ) {
	$luxxo_why_image_id    = (int) $luxxo_why_image;
	$luxxo_attachment_url = wp_get_attachment_image_url( $luxxo_why_image_id, 'large' );
	$luxxo_why_image_url  = $luxxo_attachment_url ? $luxxo_attachment_url : $luxxo_why_image_url;
	$luxxo_attachment_alt = get_post_meta( $luxxo_why_image_id, '_wp_attachment_image_alt', true );
	$luxxo_why_image_alt  = $luxxo_attachment_alt ? $luxxo_attachment_alt : $luxxo_why_image_alt;
} elseif ( is_string( $luxxo_why_image ) && $luxxo_why_image ) {
	$luxxo_why_image_url = $luxxo_why_image;
}

$luxxo_default_features = array(
	array(
		'title'       => 'Local Expertise',
		'description' => 'Discover authentic places and experiences selected by specialists with deep regional knowledge.',
		'icon'        => 'fas fa-map-location-dot',
	),
	array(
		'title'       => 'Tailor-Made Journeys',
		'description' => 'Hotels, transfers and experiences are thoughtfully arranged around your interests and pace.',
		'icon'        => 'fas fa-route',
	),
	array(
		'title'       => 'Always-On Support',
		'description' => 'Travel confidently with responsive assistance before, throughout and after your holiday.',
		'icon'        => 'fas fa-headset',
	),
);

// ACF repeater: why_choose_features. Supported subfields are title,
// description and icon (Font Awesome class, image array, image ID or URL).
$luxxo_why_features = $luxxo_why_field( 'why_choose_features', $luxxo_default_features );

if ( ! is_array( $luxxo_why_features ) || empty( $luxxo_why_features ) ) {
	$luxxo_why_features = $luxxo_default_features;
}
?>

<section data-widget="why-choose" class="why-choose-section" aria-labelledby="why-choose-heading">
	<div class="container">
		<div class="why-choose-section__layout">
			<div class="why-choose-section__visual">
				<figure class="why-choose-section__figure">
					<?php if ( $luxxo_why_image_id ) : ?>
						<?php
						$luxxo_why_image_markup = wp_get_attachment_image(
							$luxxo_why_image_id,
							'large',
							false,
							array(
								'class'    => 'why-choose-section__image',
								'alt'      => $luxxo_why_image_alt,
								'loading'  => 'lazy',
								'decoding' => 'async',
							)
						);

						if ( $luxxo_why_image_markup ) {
							echo $luxxo_why_image_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Core generates safe image markup.
						} else {
							?>
							<img class="why-choose-section__image" src="<?php echo esc_url( $luxxo_why_image_url ); ?>" alt="<?php echo esc_attr( $luxxo_why_image_alt ); ?>" loading="lazy" decoding="async">
							<?php
						}
						?>
					<?php else : ?>
						<img
							class="why-choose-section__image"
							src="<?php echo esc_url( $luxxo_why_image_url ); ?>"
							alt="<?php echo esc_attr( $luxxo_why_image_alt ); ?>"
							loading="lazy"
							decoding="async"
						>
					<?php endif; ?>
				</figure>

				<div class="why-choose-section__image-badge" aria-hidden="true">
					<i class="fas fa-compass"></i>
					<span><strong>Curated</strong> journeys</span>
				</div>

				<div class="why-choose-section__stats" aria-label="Our travel experience">
					<div class="why-choose-section__stat">
						<strong><?php echo esc_html( $luxxo_why_field( 'customers_count', '2K+' ) ); ?></strong>
						<span><?php echo esc_html( $luxxo_why_field( 'customers_text', 'Happy travellers' ) ); ?></span>
					</div>
					<div class="why-choose-section__stat">
						<strong><?php echo esc_html( $luxxo_why_field( 'years_count', '10+' ) ); ?></strong>
						<span><?php echo esc_html( $luxxo_why_field( 'years_', 'Years of expertise' ) ); ?></span>
					</div>
					<div class="why-choose-section__stat">
						<strong><?php echo esc_html( $luxxo_why_field( 'destination_count', '25' ) ); ?>+</strong>
						<span><?php echo esc_html( $luxxo_why_field( 'destination_text', 'Destinations' ) ); ?></span>
					</div>
				</div>
			</div>

			<div class="why-choose-section__content">
				<p class="why-choose-section__eyebrow">Why travel with Luxxo</p>
				<h2 class="why-choose-section__heading" id="why-choose-heading"><?php echo esc_html( $luxxo_why_title ); ?></h2>
				<p class="why-choose-section__intro"><?php echo wp_kses_post( $luxxo_why_description ); ?></p>

				<div class="why-choose-section__features">
					<?php foreach ( $luxxo_why_features as $luxxo_feature ) : ?>
						<?php
						$luxxo_feature_title = ! empty( $luxxo_feature['title'] ) ? $luxxo_feature['title'] : ( $luxxo_feature['feature_title'] ?? '' );
						$luxxo_feature_text  = ! empty( $luxxo_feature['description'] ) ? $luxxo_feature['description'] : ( $luxxo_feature['feature_description'] ?? '' );
						$luxxo_feature_icon  = ! empty( $luxxo_feature['icon'] ) ? $luxxo_feature['icon'] : ( $luxxo_feature['feature_icon'] ?? 'fas fa-compass' );

						if ( empty( $luxxo_feature_title ) && empty( $luxxo_feature_text ) ) {
							continue;
						}
						?>
						<article class="why-choose-section__card">
							<div class="why-choose-section__card-icon" aria-hidden="true">
								<?php if ( is_array( $luxxo_feature_icon ) && ! empty( $luxxo_feature_icon['url'] ) ) : ?>
									<img src="<?php echo esc_url( $luxxo_feature_icon['url'] ); ?>" alt="" loading="lazy" decoding="async">
								<?php elseif ( is_numeric( $luxxo_feature_icon ) ) : ?>
									<?php echo wp_get_attachment_image( (int) $luxxo_feature_icon, 'thumbnail', false, array( 'alt' => '', 'loading' => 'lazy' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<?php elseif ( is_string( $luxxo_feature_icon ) && filter_var( $luxxo_feature_icon, FILTER_VALIDATE_URL ) ) : ?>
									<img src="<?php echo esc_url( $luxxo_feature_icon ); ?>" alt="" loading="lazy" decoding="async">
								<?php else : ?>
									<i class="<?php echo esc_attr( $luxxo_feature_icon ); ?>"></i>
								<?php endif; ?>
							</div>
							<div>
								<?php if ( $luxxo_feature_title ) : ?><h3><?php echo esc_html( $luxxo_feature_title ); ?></h3><?php endif; ?>
								<?php if ( $luxxo_feature_text ) : ?><p><?php echo wp_kses_post( $luxxo_feature_text ); ?></p><?php endif; ?>
							</div>
						</article>
					<?php endforeach; ?>
				</div>

				<div class="why-choose-section__actions">
					<a class="why-choose-section__cta" href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>">
						<span>Plan your journey</span>
						<i class="fas fa-arrow-right" aria-hidden="true"></i>
					</a>
					<p>Personal guidance. No pressure. Just better travel.</p>
				</div>
			</div>
		</div>
	</div>
</section>
