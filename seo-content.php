<?php
/**
 * Home page SEO content section.
 *
 * ACF fields:
 * - seo_section_heading (Text)
 * - seo_section_subheading (Text)
 * - seo_section_content (WYSIWYG)
 * - seo_read_more_text (Text)
 * - seo_read_less_text (Text)
 *
 * @package Luxxo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Fail quietly when ACF is unavailable, while keeping the template operational.
if ( ! function_exists( 'get_field' ) ) {
	return;
}

$luxxo_seo_heading   = get_field( 'seo_section_heading' );
$luxxo_seo_subheading = get_field( 'seo_section_subheading' );
$luxxo_seo_content   = get_field( 'seo_section_content' );
$luxxo_read_more     = get_field( 'seo_read_more_text' );
$luxxo_read_less     = get_field( 'seo_read_less_text' );

// Avoid empty section markup when no meaningful content has been configured.
if ( empty( $luxxo_seo_heading ) && empty( $luxxo_seo_subheading ) && empty( $luxxo_seo_content ) ) {
	return;
}

$luxxo_read_more = $luxxo_read_more ? $luxxo_read_more : __( 'Read More', 'luxxo' );
$luxxo_read_less = $luxxo_read_less ? $luxxo_read_less : __( 'Read Less', 'luxxo' );
$luxxo_seo_id    = function_exists( 'wp_unique_id' ) ? wp_unique_id( 'luxxo-seo-content-' ) : 'luxxo-seo-content';
?>

<section class="luxxo-seo"<?php if ( ! empty( $luxxo_seo_heading ) ) : ?> aria-labelledby="<?php echo esc_attr( $luxxo_seo_id ); ?>-heading"<?php endif; ?>>
	<div class="container">
		<header class="luxxo-seo__header">
			<?php if ( ! empty( $luxxo_seo_subheading ) ) : ?>
				<p class="luxxo-seo__eyebrow"><?php echo esc_html( $luxxo_seo_subheading ); ?></p>
			<?php endif; ?>

			<?php if ( ! empty( $luxxo_seo_heading ) ) : ?>
				<h2 class="luxxo-seo__heading" id="<?php echo esc_attr( $luxxo_seo_id ); ?>-heading">
					<?php echo esc_html( $luxxo_seo_heading ); ?>
				</h2>
			<?php endif; ?>
		</header>

		<?php if ( ! empty( $luxxo_seo_content ) ) : ?>
			<div class="luxxo-seo__content-wrap" id="<?php echo esc_attr( $luxxo_seo_id ); ?>">
				<div class="luxxo-seo__content">
					<?php echo wp_kses_post( $luxxo_seo_content ); ?>
				</div>
			</div>

			<button
				type="button"
				class="luxxo-seo__toggle"
				aria-expanded="false"
				aria-controls="<?php echo esc_attr( $luxxo_seo_id ); ?>"
				data-more-text="<?php echo esc_attr( $luxxo_read_more ); ?>"
				data-less-text="<?php echo esc_attr( $luxxo_read_less ); ?>"
			>
				<span class="luxxo-seo__toggle-text"><?php echo esc_html( $luxxo_read_more ); ?></span>
				<svg class="luxxo-seo__toggle-icon" viewBox="0 0 20 20" aria-hidden="true" focusable="false">
					<path d="m5.5 7.5 4.5 4.5 4.5-4.5" />
				</svg>
			</button>
		<?php endif; ?>
	</div>
</section>

<style>
.luxxo-seo {
	--seo-accent: #d4af37;
	--seo-preview-height: 120px;
	padding: clamp(48px, 7vw, 60px) 0px;
	background: #ffffff;
	color: #171717;
}

.luxxo-seo__header {
	margin-bottom: 22px;
}

.luxxo-seo__eyebrow {
	margin: 0 0 9px;
	color: #8b701c;
	font-size: 12px;
	font-weight: 700;
	letter-spacing: .16em;
	line-height: 1.4;
	text-transform: uppercase;
}

.luxxo-seo__heading {
	margin: 0;
	color: #000000;
	font-size: 28px;
	font-weight: 600;
	letter-spacing: -.025em;
	line-height: 1.12;
}

.luxxo-seo__content-wrap {
	position: relative;
	overflow: visible;
}

.luxxo-seo.is-enhanced .luxxo-seo__content-wrap {
	max-height: var(--seo-preview-height);
	overflow: hidden;
	transition: max-height .65s cubic-bezier(.22, 1, .36, 1);
}

.luxxo-seo.is-enhanced .luxxo-seo__content-wrap::after {
	position: absolute;
	right: 0;
	bottom: 0;
	left: 0;
	height: 90px;
	background: linear-gradient(to bottom, rgba(255, 255, 255, 0), #fff 88%);
	content: "";
	pointer-events: none;
	transition: opacity .3s ease;
}

.luxxo-seo.is-expanded .luxxo-seo__content-wrap::after {
	opacity: 0;
}

.luxxo-seo__content {
	color: #4b4b4b;
	font-size: clamp(12px, 1.7vw, 14px);
	line-height: 1.8;
}

.luxxo-seo__content > :first-child { margin-top: 0; }
.luxxo-seo__content > :last-child { margin-bottom: 0; }
.luxxo-seo__content h2,
.luxxo-seo__content h3 {
	margin: 1.5em 0 .55em;
	color: #181818;
	line-height: 1.25;
}
.luxxo-seo__content a { color: #795f0f; text-underline-offset: 3px; }

.luxxo-seo__toggle {
	display: none;
	align-items: center;
	gap: 8px;
	margin-top: 22px;
	padding: 3px 0;
	border: 0;
	border-bottom: 1px solid currentColor;
	border-radius: 0;
	background: transparent;
	color: #795f0f;
	font: inherit;
	font-size: 14px;
	font-weight: 700;
	cursor: pointer;
	transition: border-color .25s ease, color .25s ease, gap .25s ease;
}

.luxxo-seo.is-enhanced.is-collapsible .luxxo-seo__toggle { display: inline-flex; }
.luxxo-seo__toggle:hover { gap: 11px; color: #171717; border-color: var(--seo-accent); }
.luxxo-seo__toggle:focus-visible { outline: 2px solid rgba(212, 175, 55, .5); outline-offset: 4px; }
.luxxo-seo__toggle-icon { width: 18px; height: 18px; fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round; stroke-width: 1.8; transition: transform .4s cubic-bezier(.22, 1, .36, 1); }
.luxxo-seo.is-expanded .luxxo-seo__toggle-icon { transform: rotate(180deg); }

@media (max-width: 767.98px) {
	.luxxo-seo { --seo-preview-height: 205px; padding: 38px 0; }
	.luxxo-seo__inner { padding: 25px 20px; border-radius: 19px; }
	.luxxo-seo__header { margin-bottom: 17px; }
	.luxxo-seo__toggle { min-height: 36px; }
}

@media (prefers-reduced-motion: reduce) {
	.luxxo-seo__content-wrap,
	.luxxo-seo__toggle,
	.luxxo-seo__toggle-icon { transition-duration: .01ms !important; }
}
</style>

<script>
(function () {
	'use strict';

	document.querySelectorAll('.luxxo-seo').forEach(function (section) {
		var contentWrap = section.querySelector('.luxxo-seo__content-wrap');
		var toggle = section.querySelector('.luxxo-seo__toggle');
		if (!contentWrap || !toggle) return;

		section.classList.add('is-enhanced');

		function previewHeight() {
			return parseFloat(window.getComputedStyle(section).getPropertyValue('--seo-preview-height')) || 230;
		}

		function refresh() {
			var canCollapse = contentWrap.scrollHeight > previewHeight() + 4;
			section.classList.toggle('is-collapsible', canCollapse);

			if (!canCollapse) {
				section.classList.remove('is-expanded');
				contentWrap.style.maxHeight = 'none';
				toggle.setAttribute('aria-expanded', 'false');
				return;
			}

			contentWrap.style.maxHeight = section.classList.contains('is-expanded')
				? contentWrap.scrollHeight + 'px'
				: previewHeight() + 'px';
		}

		toggle.addEventListener('click', function () {
			var expanded = !section.classList.contains('is-expanded');
			section.classList.toggle('is-expanded', expanded);
			toggle.setAttribute('aria-expanded', String(expanded));
			toggle.querySelector('.luxxo-seo__toggle-text').textContent = expanded
				? toggle.getAttribute('data-less-text')
				: toggle.getAttribute('data-more-text');
			contentWrap.style.maxHeight = expanded ? contentWrap.scrollHeight + 'px' : previewHeight() + 'px';

			if (!expanded && section.getBoundingClientRect().top < 0) {
				section.scrollIntoView({ behavior: 'smooth', block: 'start' });
			}
		});

		var resizeTimer;
		window.addEventListener('resize', function () {
			window.clearTimeout(resizeTimer);
			resizeTimer = window.setTimeout(refresh, 120);
		}, { passive: true });

		refresh();
	});
})();
</script>
