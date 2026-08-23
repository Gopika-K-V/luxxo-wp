<?php
/**
 * Sticky quick actions.
 *
 * This partial is intentionally self-contained so it can be included on any
 * template without enqueueing additional assets.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$luxxo_quick_actions = array(
	array(
		'label' => 'Call Us',
		'url'   => 'tel:+917994737579',
		'icon'  => 'phone',
	),
	array(
		'label' => 'Send Email',
		'url'   => 'mailto:info@luxxoholidays.com',
		'icon'  => 'email',
	),
	array(
		'label'  => 'LinkedIn',
		'url'    => 'https://www.linkedin.com/company/indian-tour-options/',
		'icon'   => 'linkedin',
		'target' => '_blank',
	),
);

// Allows links or labels to be customized without editing this partial.
$luxxo_quick_actions = apply_filters( 'luxxo_quick_actions', $luxxo_quick_actions );

$luxxo_whatsapp_action = apply_filters(
	'luxxo_whatsapp_action',
	array(
		'label' => 'Chat with Luxxo Holidays on WhatsApp',
		'url'   => 'https://wa.me/917994737579?text=Hi%2C%20I%20would%20like%20to%20plan%20a%20trip',
	)
);
?>

<a
	class="luxxo-whatsapp-float"
	href="<?php echo esc_url( $luxxo_whatsapp_action['url'] ); ?>"
	target="_blank"
	rel="noopener noreferrer"
	aria-label="<?php echo esc_attr( $luxxo_whatsapp_action['label'] ); ?>"
>
	<span class="luxxo-whatsapp-float__pulse" aria-hidden="true"></span>
	<svg class="luxxo-whatsapp-float__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M20.5 3.5A11.8 11.8 0 0 0 1.9 17.7L.3 23.5l6-1.57A11.8 11.8 0 0 0 20.5 3.5ZM12.1 21a9.8 9.8 0 0 1-5-1.37l-.36-.21-3.54.93.95-3.45-.23-.36A9.82 9.82 0 1 1 12.1 21Zm5.4-7.36c-.3-.15-1.75-.86-2.02-.96-.27-.1-.47-.15-.67.15-.2.3-.76.96-.94 1.16-.17.2-.34.22-.64.07-.3-.15-1.25-.46-2.38-1.47a8.9 8.9 0 0 1-1.65-2.06c-.17-.3-.02-.46.13-.6.13-.13.3-.34.44-.52.15-.17.2-.3.3-.49.1-.2.05-.37-.02-.52-.08-.15-.67-1.6-.91-2.2-.24-.57-.49-.5-.67-.5h-.57c-.2 0-.52.08-.8.37-.27.3-1.03 1.01-1.03 2.47 0 1.45 1.06 2.86 1.2 3.05.15.2 2.09 3.19 5.06 4.47.7.3 1.26.49 1.7.63.7.23 1.34.2 1.85.12.56-.08 1.75-.72 2-1.41.24-.7.24-1.3.17-1.42-.07-.13-.27-.2-.57-.35Z"/></svg>
</a>

<nav class="luxxo-quick-actions" aria-label="Quick contact actions" style="--qa-count: <?php echo esc_attr( count( $luxxo_quick_actions ) ); ?>;">
	<span class="luxxo-quick-actions__indicator" aria-hidden="true"></span>
	<?php foreach ( $luxxo_quick_actions as $index => $action ) : ?>
		<a
			class="luxxo-quick-actions__link<?php echo 0 === $index ? ' is-active' : ''; ?>"
			href="<?php echo esc_url( $action['url'] ); ?>"
			<?php if ( ! empty( $action['target'] ) ) : ?>target="<?php echo esc_attr( $action['target'] ); ?>" rel="noopener noreferrer"<?php endif; ?>
			aria-label="<?php echo esc_attr( $action['label'] ); ?>"
			data-action-index="<?php echo esc_attr( $index ); ?>"
		>
			<span class="luxxo-quick-actions__label"><?php echo esc_html( $action['label'] ); ?></span>
			<span class="luxxo-quick-actions__icon" aria-hidden="true">
				<?php if ( 'phone' === $action['icon'] ) : ?>
					<svg viewBox="0 0 24 24"><path d="M6.6 10.8a15.5 15.5 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.24c1.1.37 2.28.57 3.5.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.56 21 3 13.44 3 4.1a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.23.2 2.4.57 3.51a1 1 0 0 1-.25 1.02L6.6 10.8Z"/></svg>
				<?php elseif ( 'email' === $action['icon'] ) : ?>
					<svg viewBox="0 0 24 24"><path d="M3 5h18a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Zm9 7 8.5-5H3.5L12 12Zm0 2.3L3 9v8h18V9l-9 5.3Z"/></svg>
				<?php else : ?>
					<svg viewBox="0 0 24 24"><path d="M5.3 7.8H1.7V22h3.6V7.8ZM3.5 1A2.1 2.1 0 1 0 3.5 5.2 2.1 2.1 0 0 0 3.5 1ZM22.3 13.8c0-4.27-2.28-6.25-5.32-6.25a4.6 4.6 0 0 0-4.16 2.3V7.8H9.2V22h3.63v-7.03c0-1.86.35-3.65 2.65-3.65 2.26 0 2.29 2.12 2.29 3.77V22h3.63l.9-8.2Z"/></svg>
				<?php endif; ?>
			</span>
		</a>
	<?php endforeach; ?>
</nav>

<style>
/* Scoped styles: sticky rail on desktop, bottom action bar on mobile. */
.luxxo-whatsapp-float {
	position: fixed;
	right: 22px;
	bottom: calc(22px + env(safe-area-inset-bottom));
	z-index: 980;
	display: grid;
	width: 58px;
	height: 58px;
	place-items: center;
	border-radius: 50%;
	background: #25d366;
	color: #fff;
	box-shadow: 0 8px 22px rgba(0, 0, 0, .24);
	text-decoration: none;
	transition: transform .2s ease, box-shadow .2s ease;
	isolation: isolate;
}

.luxxo-whatsapp-float:hover,
.luxxo-whatsapp-float:focus-visible {
	transform: scale(1.06);
	box-shadow: 0 10px 26px rgba(0, 0, 0, .3);
	outline: none;
}

.luxxo-whatsapp-float:focus-visible {
	box-shadow: 0 0 0 3px #fff, 0 0 0 6px #25d366;
}

.luxxo-whatsapp-float__pulse {
	position: absolute;
	inset: 0;
	border-radius: inherit;
	background: #25d366;
	z-index: -1;
	animation: luxxo-whatsapp-pulse 2.5s ease-out infinite;
}

.luxxo-whatsapp-float__icon {
	position: relative;
	width: 31px;
	height: 31px;
	fill: currentColor;
}

@keyframes luxxo-whatsapp-pulse {
	0%, 30% { opacity: .45; transform: scale(1); }
	70%, 100% { opacity: 0; transform: scale(1.45); }
}

.luxxo-quick-actions {
	--qa-accent: #d4af37;
	--qa-item-size: 50px;
	--qa-gap: 6px;
	position: fixed;
	right: 22px;
	top: 50%;
	z-index: 950;
	display: flex;
	flex-direction: column;
	gap: var(--qa-gap);
	width: var(--qa-item-size);
	padding: 8px 0;
	border-radius: 29px;
	background: #050505;
	box-shadow: 0 12px 34px rgba(0, 0, 0, .24);
	transform: translateY(-50%);
	isolation: isolate;
}

.luxxo-quick-actions__indicator {
	position: absolute;
	top: 8px;
	left: 0;
	z-index: -1;
	width: var(--qa-item-size);
	height: var(--qa-item-size);
	border-radius: 50%;
	background: transparent;
	transform: translateY(calc(var(--qa-active, 0) * (var(--qa-item-size) + var(--qa-gap))));
	transition: transform .52s cubic-bezier(.22, 1, .36, 1);
}

.luxxo-quick-actions__link {
	position: relative;
	display: flex;
	align-items: center;
	justify-content: flex-end;
	align-self: flex-end;
	width: var(--qa-item-size);
	height: var(--qa-item-size);
	border-radius: 30px;
	color: #fff;
	text-decoration: none;
	overflow: hidden;
	transition: width .42s cubic-bezier(.22, 1, .36, 1), background-color .3s ease, box-shadow .3s ease;
}

.luxxo-quick-actions__link:hover,
.luxxo-quick-actions__link:focus-visible {
	width: 175px;
	background: var(--qa-accent);
	box-shadow: -10px 8px 24px rgba(0, 0, 0, .18);
	outline: none;
}

.luxxo-quick-actions__label {
	flex: 1 0 auto;
	padding-left: 18px;
	background: var(--qa-accent);
	color: #050505;
	font-family: inherit;
	font-size: 14px;
	font-weight: 600;
	line-height: 1.1;
	white-space: nowrap;
	opacity: 0;
	transform: translateX(18px);
	transition: opacity .2s ease, transform .4s cubic-bezier(.22, 1, .36, 1);
}

.luxxo-quick-actions__link:hover .luxxo-quick-actions__label,
.luxxo-quick-actions__link:focus-visible .luxxo-quick-actions__label {
	opacity: 1;
	transform: translateX(0);
}

.luxxo-quick-actions__icon {
	display: grid;
	flex: 0 0 var(--qa-item-size);
	width: var(--qa-item-size);
	height: var(--qa-item-size);
	place-items: center;
	border-radius: 50%;
	background: transparent;
	transition: background-color .3s ease, color .3s ease;
}

.luxxo-quick-actions__link:hover .luxxo-quick-actions__icon,
.luxxo-quick-actions__link:focus-visible .luxxo-quick-actions__icon {
	background: var(--qa-accent);
	color: #050505;
}

.luxxo-quick-actions__icon svg {
	width: 25px;
	height: 25px;
	fill: currentColor;
}

@media (max-width: 767.98px) {
	.luxxo-whatsapp-float {
		right: 18px;
		bottom: calc(82px + env(safe-area-inset-bottom));
		width: 56px;
		height: 56px;
	}

	.luxxo-quick-actions {
		--qa-item-size: auto;
		--qa-gap: 0px;
		top: auto;
		right: auto;
		bottom: calc(12px + env(safe-area-inset-bottom));
		left: 50%;
		z-index: 990;
		flex-direction: row;
		width: calc(100% - 24px);
		max-width: 430px;
		padding: 6px;
		border: 1px solid rgba(255, 255, 255, .1);
		border-radius: 999px;
		box-shadow: 0 12px 35px rgba(0, 0, 0, .3), 0 3px 10px rgba(0, 0, 0, .18);
		transform: translate(-50%, calc(100% + 32px));
		opacity: 0;
		visibility: hidden;
		pointer-events: none;
		transition: transform .48s cubic-bezier(.22, 1, .36, 1), opacity .3s ease, visibility .48s;
		will-change: transform, opacity;
	}

	.luxxo-quick-actions.is-visible {
		transform: translate(-50%, 0);
		opacity: 1;
		visibility: visible;
		pointer-events: auto;
	}

	.luxxo-quick-actions__indicator {
		top: 6px;
		left: 6px;
		width: calc((100% - 12px) / var(--qa-count));
		height: 48px;
		border-radius: 999px;
		transform: translateX(calc(var(--qa-active, 0) * 100%));
	}

	.luxxo-quick-actions__link,
	.luxxo-quick-actions__link:hover,
	.luxxo-quick-actions__link:focus-visible {
		flex: 1 1 calc(100% / var(--qa-count));
		flex-direction: column;
		justify-content: center;
		width: auto;
		height: 48px;
		gap: 2px;
		border-radius: 999px;
		background: transparent;
		box-shadow: none;
	}

	.luxxo-quick-actions__icon {
		order: -1;
		flex: 0 0 27px;
		width: 27px;
		height: 27px;
		background: transparent;
		color: #fff;
	}

	.luxxo-quick-actions__icon svg {
		width: 21px;
		height: 21px;
	}

	.luxxo-quick-actions__label,
	.luxxo-quick-actions__link:hover .luxxo-quick-actions__label,
	.luxxo-quick-actions__link:focus-visible .luxxo-quick-actions__label {
		flex: none;
		padding: 0;
		font-size: 11px;
		background: transparent;
		color: #fff;
		opacity: 1;
		transform: none;
	}

	.luxxo-quick-actions__link:hover .luxxo-quick-actions__icon,
	.luxxo-quick-actions__link:focus-visible .luxxo-quick-actions__icon,
	.luxxo-quick-actions__link:active .luxxo-quick-actions__icon {
		background: var(--qa-accent);
		color: #050505;
	}
}

@media (prefers-reduced-motion: reduce) {
	.luxxo-quick-actions,
	.luxxo-whatsapp-float,
	.luxxo-quick-actions__indicator,
	.luxxo-quick-actions__link,
	.luxxo-quick-actions__label {
		transition-duration: .01ms !important;
	}

	.luxxo-whatsapp-float__pulse {
		animation: none;
	}
}
</style>

<script>
(function () {
	'use strict';

	var menu = document.querySelector('.luxxo-quick-actions');
	if (!menu) return;

	var links = menu.querySelectorAll('.luxxo-quick-actions__link');
	var ticking = false;
	var mobileQuery = window.matchMedia('(max-width: 767.98px)');

	function activate(link) {
		links.forEach(function (item) { item.classList.remove('is-active'); });
		link.classList.add('is-active');
		menu.style.setProperty('--qa-active', link.getAttribute('data-action-index'));
	}

	links.forEach(function (link) {
		link.addEventListener('mouseenter', function () { activate(link); });
		link.addEventListener('focus', function () { activate(link); });
		link.addEventListener('touchstart', function () { activate(link); }, { passive: true });
		link.addEventListener('click', function () { activate(link); });
	});

	function updateMobileBar() {
		var doc = document.documentElement;
		var currentY = Math.max(window.pageYOffset || doc.scrollTop, 0);
		var documentHeight = Math.max(document.body.scrollHeight, doc.scrollHeight, document.body.offsetHeight, doc.offsetHeight);
		var remaining = documentHeight - (currentY + window.innerHeight);
		var atBottom = remaining <= 2;
		var atTop = currentY <= 1;

		if (mobileQuery.matches && !atTop && !atBottom) {
			menu.classList.add('is-visible');
		} else {
			menu.classList.remove('is-visible');
		}

		ticking = false;
	}

	function requestMobileBarUpdate() {
		if (!ticking) {
			window.requestAnimationFrame(updateMobileBar);
			ticking = true;
		}
	}

	window.addEventListener('scroll', requestMobileBarUpdate, { passive: true });
	window.addEventListener('resize', requestMobileBarUpdate, { passive: true });

	if (mobileQuery.addEventListener) {
		mobileQuery.addEventListener('change', requestMobileBarUpdate);
	}

	updateMobileBar();
})();
</script>
