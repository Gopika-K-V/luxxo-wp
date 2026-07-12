<?php
?>

<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/custom/contactSection/contact-us.css">

<?php

$hero_image      = get_field( 'contact_banner_image' );
$hero_heading    = get_field( 'contact_banner_heading' );
$hero_subheading = get_field( 'contact_banner_subheading' );

$office_address = get_field( 'contact_office_address' );
$phone_1        = get_field( 'contact_phone_number_1' );
$phone_2        = get_field( 'contact_phone_number_2' );
$email_1        = get_field( 'contact_email_1' );
$email_2        = get_field( 'contact_email_2' );
$working_hours  = get_field( 'contact_working_hours' );
$map_embed      = get_field( 'contact_google_map_embed' );

$linkedin_url  = get_field( 'contact_linkedin_url' );
$facebook_url  = get_field( 'contact_facebook_url' );
$instagram_url = get_field( 'contact_instagram_url' );
$google_url    = get_field( 'contact_google_url' );
$airbnb_url    = get_field( 'contact_airbnb_url' );
$viator_url    = get_field( 'contact_viator_url' );

if ( ! function_exists( 'luxxo_contact_image_url' ) ) {
	/**
	 * Return an image URL from common ACF image return formats.
	 *
	 * @param mixed $image ACF image field value.
	 * @return string
	 */
	function luxxo_contact_image_url( $image ) {
		if ( is_array( $image ) && ! empty( $image['url'] ) ) {
			return $image['url'];
		}

		if ( is_numeric( $image ) ) {
			return wp_get_attachment_image_url( (int) $image, 'full' );
		}

		if ( is_string( $image ) ) {
			return $image;
		}

		return '';
	}
}

if ( ! function_exists( 'luxxo_contact_tel_href' ) ) {
	/**
	 * Build a tel href from editable phone text.
	 *
	 * @param string $phone Phone number.
	 * @return string
	 */
	function luxxo_contact_tel_href( $phone ) {
		return preg_replace( '/[^0-9+]/', '', (string) $phone );
	}
}

$hero_image_url = luxxo_contact_image_url( $hero_image );

$map_allowed_html = array(
	'iframe' => array(
		'src'             => true,
		'width'           => true,
		'height'          => true,
		'style'           => true,
		'allowfullscreen' => true,
		'loading'         => true,
		'referrerpolicy'  => true,
		'title'           => true,
	),
);

$contact_items = array(
	array(
		'icon'  => 'fas fa-location-dot',
		'type'  => 'address',
		'value' => $office_address,
	),
	array(
		'icon'  => 'fas fa-phone',
		'type'  => 'phone',
		'value' => $phone_1,
	),
	array(
		'icon'  => 'fas fa-mobile-screen-button',
		'type'  => 'phone',
		'value' => $phone_2,
	),
	array(
		'icon'  => 'fas fa-envelope',
		'type'  => 'email',
		'value' => $email_1,
	),
	array(
		'icon'  => 'fas fa-paper-plane',
		'type'  => 'email',
		'value' => $email_2,
	),
	array(
		'icon'  => 'fas fa-clock',
		'type'  => 'text',
		'value' => $working_hours,
	),
);

$has_contact_items = array_filter( wp_list_pluck( $contact_items, 'value' ) );

$social_links = array(
	array(
		'url'   => $linkedin_url,
		'label' => 'LinkedIn',
		'icon'  => '<i class="fab fa-linkedin-in" aria-hidden="true"></i>',
	),
	array(
		'url'   => $facebook_url,
		'label' => 'Facebook',
		'icon'  => '<i class="fab fa-facebook-f" aria-hidden="true"></i>',
	),
	array(
		'url'   => $instagram_url,
		'label' => 'Instagram',
		'icon'  => '<i class="fab fa-instagram" aria-hidden="true"></i>',
	),
	array(
		'url'   => $google_url,
		'label' => 'Google',
		'icon'  => '<i class="fab fa-google" aria-hidden="true"></i>',
	),
	array(
		'url'   => $airbnb_url,
		'label' => 'Airbnb',
		'icon'  => '<i class="fab fa-airbnb" aria-hidden="true"></i>',
	),
	array(
		'url'   => $viator_url,
		'label' => 'Viator',
		'icon'  => '<svg viewBox="0 0 48 48" role="img" aria-hidden="true" focusable="false"><path d="M7.5 12.2h9.1l7.5 19.5 7.4-19.5h9L28.4 38H19.7L7.5 12.2z"/></svg>',
	),
);

$has_social_links = array_filter( wp_list_pluck( $social_links, 'url' ) );
?>

<main class="luxxo-contact-page">
	<?php if ( $hero_image_url || $hero_heading || $hero_subheading ) : ?>
		<section
			class="luxxo-contact-hero"
			<?php if ( $hero_image_url ) : ?>
				style="background-image: url('<?php echo esc_url( $hero_image_url ); ?>');"
			<?php endif; ?>
		>
			<div class="luxxo-contact-hero__inner">
				<?php if ( $hero_subheading ) : ?>
					<p class="luxxo-contact-hero__eyebrow"><?php echo esc_html( $hero_subheading ); ?></p>
				<?php endif; ?>

				<?php if ( $hero_heading ) : ?>
					<h1 class="luxxo-contact-hero__title"><?php echo esc_html( $hero_heading ); ?></h1>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

	<section class="luxxo-contact-main">
		<div class="luxxo-contact-wrap">
            <div class="luxxo-contact-info">
                <ul class="luxxo-contact-list">
                    <?php foreach ( $contact_items as $contact_item ) : ?>
                        <?php if ( empty( $contact_item['value'] ) ) : ?>
                            <?php continue; ?>
                        <?php endif; ?>

                        <li class="luxxo-contact-item">
                            <span class="luxxo-contact-item__icon">
                                <i class="<?php echo esc_attr( $contact_item['icon'] ); ?>" aria-hidden="true"></i>
                            </span>
                            <div class="luxxo-contact-item__content">
                                <?php if ( 'phone' === $contact_item['type'] ) : ?>
                                    <a href="tel:<?php echo esc_attr( luxxo_contact_tel_href( $contact_item['value'] ) ); ?>">
                                        <?php echo esc_html( $contact_item['value'] ); ?>
                                    </a>
                                <?php elseif ( 'email' === $contact_item['type'] ) : ?>
                                    <a href="mailto:<?php echo esc_attr( sanitize_email( $contact_item['value'] ) ); ?>">
                                        <?php echo esc_html( $contact_item['value'] ); ?>
                                    </a>
                                <?php else : ?>
                                    <?php echo wp_kses_post( wpautop( $contact_item['value'] ) ); ?>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

			<?php if ( $map_embed ) : ?>
				<div class="luxxo-contact-map">
					<?php if ( false !== stripos( $map_embed, '<iframe' ) ) : ?>
						<?php echo wp_kses( $map_embed, $map_allowed_html ); ?>
					<?php else : ?>
						<iframe src="<?php echo esc_url( $map_embed ); ?>" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<?php if ( $has_social_links ) : ?>
		<section class="luxxo-contact-social">
			<div class="luxxo-contact-social__inner">
				<?php foreach ( $social_links as $social_link ) : ?>
					<?php if ( empty( $social_link['url'] ) ) : ?>
						<?php continue; ?>
					<?php endif; ?>

					<a
						class="luxxo-contact-social__link"
						href="<?php echo esc_url( $social_link['url'] ); ?>"
						target="_blank"
						rel="noopener noreferrer"
						aria-label="<?php echo esc_attr( $social_link['label'] ); ?>"
					>
						<?php echo wp_kses( $social_link['icon'], array( 'i' => array( 'class' => true, 'aria-hidden' => true ), 'svg' => array( 'viewbox' => true, 'role' => true, 'aria-hidden' => true, 'focusable' => true ), 'path' => array( 'd' => true ) ) ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>
</main>
