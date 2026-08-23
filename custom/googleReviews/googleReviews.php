<?php
/**
 * Google Reviews section.
 *
 * Update only the shortcode variable below when the review-widget shortcode
 * is available. The shortcode output is deliberately left untouched.
 *
 * @package Luxxo_Holidays
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Google Reviews widget shortcode. Keep this as the single update point for the embed.
$luxxo_google_reviews_shortcode = '[trustindex no-registration=google]';

if ( empty( $luxxo_google_reviews_shortcode ) ) {
	return;
}
?>

<section class="google-reviews" id="google-reviews" aria-labelledby="google-reviews-heading">
	<div class="container">
		<div class="google-reviews__header">
			<h2 class="google-reviews__title" id="google-reviews-heading">More Than Just Holidays <br/> We Craft Unique Travel Experiences</h2>
			<p class="google-reviews__subtitle">Checkout our guest reviews</p>
		</div>

		<div class="google-reviews__card">
			<div class="google-reviews__trust-bar" aria-label="Google Reviews">
				<span class="google-reviews__google-mark" aria-hidden="true">G</span>
				<div class="google-reviews__trust-copy">
					<span>Google Reviews</span>
					<strong>Trusted by discerning travellers</strong>
				</div>
				<div class="google-reviews__stars" aria-label="Guest stories">
					<span aria-hidden="true">✦</span>
					<strong>Guest stories</strong>
				</div>
			</div>

			<div class="google-reviews__widget">
				<?php echo do_shortcode( $luxxo_google_reviews_shortcode ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Trusted plugin shortcode markup. ?>
			</div>
		</div>
	</div>
</section>
