<?php

/**
 * Current Offers section.
 *
 * ACF field group: current_offers (repeater).
 *
 * @package Luxxo_Holidays
 */

if (! function_exists('get_field')) {
	return;
}

$current_offers = get_field('current_offers');

if (empty($current_offers) || ! is_array($current_offers)) {
	return;
}

$current_offers = array_values(
	array_filter(
		$current_offers,
		static function ($offer) {
			return is_array($offer) && ! empty($offer['offer_title']);
		}
	)
);

if (empty($current_offers)) {
	return;
}

/**
 * Gets consistently usable image data from an ACF image field.
 *
 * @param mixed  $image ACF image value.
 * @param string $size  Registered image size.
 * @return array{url: string, alt: string}
 */
function luxxo_current_offers_image_data($image, $size = 'medium_large')
{
	if (is_array($image)) {
		return array(
			'url' => ! empty($image['sizes'][$size]) ? $image['sizes'][$size] : ($image['url'] ?? ''),
			'alt' => $image['alt'] ?? '',
		);
	}

	if (is_numeric($image)) {
		$image_id = (int) $image;
		return array(
			'url' => wp_get_attachment_image_url($image_id, $size) ?: '',
			'alt' => get_post_meta($image_id, '_wp_attachment_image_alt', true),
		);
	}

	return array(
		'url' => is_string($image) ? $image : '',
		'alt' => '',
	);
}

/**
 * Normalizes text or repeater-based offer tags.
 *
 * @param mixed $tags ACF offer_tags value.
 * @return string[]
 */
function luxxo_current_offers_tags($tags)
{
	if (is_string($tags)) {
		return array_filter(array_map('trim', preg_split('/[,|]/', $tags)));
	}

	if (! is_array($tags)) {
		return array();
	}

	$tag_list = array();
	foreach ($tags as $tag) {
		if (is_string($tag)) {
			$tag_list[] = $tag;
		} elseif (is_array($tag) && ! empty($tag['offer_tag'])) {
			$tag_list[] = $tag['offer_tag'];
		}
	}

	return array_filter(array_map('trim', $tag_list));
}

$is_single_offer = 1 === count($current_offers);
?>
<section class="current-offers<?php echo $is_single_offer ? ' current-offers--single' : ' current-offers--multiple'; ?>" aria-labelledby="current-offers-title">
	<div class="current-offers__container">
		<h2 id="current-offers-title" class="current-offers__screen-reader-text"><?php esc_html_e('Current offers', 'luxxo-holidays'); ?></h2>
		<div class="current-offers__list">
			<?php foreach ($current_offers as $offer) : ?>
				<?php
				$title       = $offer['offer_title'] ?? '';
				$eyebrow    = $offer['offer_eyebrow'] ?? '';
				$description = $offer['offer_description'] ?? '';
				$button      = $offer['cta_button_label'] ?? '';
				$link        = $offer['cta_button_link'] ?? '';
				$offer_link  = $offer['offer_link'] ?? '';
				$icon        = luxxo_current_offers_image_data($offer['offer_icon'] ?? '');
				$background  = luxxo_current_offers_image_data($offer['offer_background_image'] ?? '', 'large');
				$tags        = luxxo_current_offers_tags($offer['offer_tags'] ?? '');

				if (is_array($link)) {
					$link_url    = $link['url'] ?? '';
					$link_target = $link['target'] ?? '';
				} else {
					$link_url    = $link;
					$link_target = '';
				}

				$whatsapp_number = '917994737579';
				$whatsapp_message = sprintf(
					/* translators: %s: offer title. */
					__('Hi, I am interested in the %s offer.', 'luxxo-holidays'),
					$title
				);
				$whatsapp_url = 'https://wa.me/' . $whatsapp_number . '?text=' . rawurlencode($whatsapp_message);
				$cta_url      = ! empty($link_url) ? $link_url : $whatsapp_url;
				$cta_target   = ! empty($link_url) ? $link_target : '_blank';

				if (is_array($offer_link)) {
					$offer_link_url    = $offer_link['url'] ?? '';
					$offer_link_title  = $offer_link['title'] ?? '';
					$offer_link_target = $offer_link['target'] ?? '_self';
				} else {
					$offer_link_url    = is_string($offer_link) ? $offer_link : '';
					$offer_link_title  = '';
					$offer_link_target = '_self';
				}

				$is_linked_card = ! empty($offer_link_url);
				$card_tag       = $is_linked_card ? 'a' : 'article';
				$card_label     = ! empty($offer_link_title) ? $offer_link_title : sprintf(
					/* translators: %s: offer title. */
					__('View offer: %s', 'luxxo-holidays'),
					$title
				);
				?>
				<<?php echo esc_attr($card_tag); ?>
					class="current-offers__card"
					<?php if ($is_linked_card) : ?>
						href="<?php echo esc_url($offer_link_url); ?>"
						target="<?php echo esc_attr('_blank' === $offer_link_target ? '_blank' : '_self'); ?>"
						aria-label="<?php echo esc_attr($card_label); ?>"
						<?php echo '_blank' === $offer_link_target ? ' rel="noopener noreferrer"' : ''; ?>
					<?php endif; ?>
				>
					<?php if (! empty($background['url'])) : ?>
						<img class="current-offers__background" src="<?php echo esc_url($background['url']); ?>" alt="" aria-hidden="true" loading="lazy" decoding="async">
					<?php endif; ?>
					<div class="current-offers__content">
						<?php if (! empty($icon['url'])) : ?>
							<div class="current-offers__icon">
								<img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" loading="lazy" decoding="async">
							</div>
						<?php endif; ?>
						<div class="current-offers__details">
							<?php if (! empty($eyebrow)) : ?>
								<p class="current-offers__eyebrow"><?php echo esc_html($eyebrow); ?></p>
							<?php endif; ?>
							<?php if (! empty($title)) : ?>
								<h3 class="current-offers__title"><?php echo esc_html($title); ?></h3>
							<?php endif; ?>
							<?php if (! empty($description)) : ?>
								<div class="current-offers__description"><?php echo wp_kses_post(wpautop($description)); ?></div>
							<?php endif; ?>
							<div class="d-flex align-items-center justify-content-between flex-wrap">
								<?php if (! empty($tags)) : ?>
									<ul class="current-offers__tags" aria-label="<?php esc_attr_e('Offer highlights', 'luxxo-holidays'); ?>">
										<?php foreach ($tags as $tag) : ?>
											<li><?php echo esc_html($tag); ?></li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
								<?php if (! empty($button) && $is_linked_card) : ?>
									<span class="current-offers__cta" aria-hidden="true">
										<span class="current-offers__cta-label"><?php echo esc_html($button); ?></span>
										<span class="current-offers__arrow"></span>
									</span>
								<?php elseif (! empty($button)) : ?>
									<a class="current-offers__cta" href="<?php echo esc_url($cta_url); ?>" target="<?php echo esc_attr('_blank' === $cta_target ? '_blank' : '_self'); ?>"<?php echo '_blank' === $cta_target ? ' rel="noopener noreferrer"' : ''; ?> aria-label="<?php echo esc_attr($button); ?>">
										<span class="current-offers__cta-label"><?php echo esc_html($button); ?></span>
										<span class="current-offers__arrow" aria-hidden="true"></span>
									</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</<?php echo esc_attr($card_tag); ?>>
			<?php endforeach; ?>
		</div>
	</div>
</section>
