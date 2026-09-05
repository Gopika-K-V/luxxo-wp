---
name: South Indian Heritage
colors:
  surface: '#faf9f7'
  surface-dim: '#dadad8'
  surface-bright: '#faf9f7'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f4f4f2'
  surface-container: '#eeeeec'
  surface-container-high: '#e8e8e6'
  surface-container-highest: '#e3e2e1'
  on-surface: '#1a1c1b'
  on-surface-variant: '#414846'
  inverse-surface: '#2f3130'
  inverse-on-surface: '#f1f1ef'
  outline: '#717975'
  outline-variant: '#c1c8c4'
  surface-tint: '#45655b'
  primary: '#02241d'
  on-primary: '#ffffff'
  primary-container: '#1a3a32'
  on-primary-container: '#82a499'
  inverse-primary: '#abcec2'
  secondary: '#775a19'
  on-secondary: '#ffffff'
  secondary-container: '#fed488'
  on-secondary-container: '#785a1a'
  tertiary: '#00222f'
  on-tertiary: '#ffffff'
  tertiary-container: '#00394c'
  on-tertiary-container: '#66a5c2'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#c7eade'
  primary-fixed-dim: '#abcec2'
  on-primary-fixed: '#002019'
  on-primary-fixed-variant: '#2d4d44'
  secondary-fixed: '#ffdea5'
  secondary-fixed-dim: '#e9c176'
  on-secondary-fixed: '#261900'
  on-secondary-fixed-variant: '#5d4201'
  tertiary-fixed: '#bee9ff'
  tertiary-fixed-dim: '#90cfed'
  on-tertiary-fixed: '#001f2a'
  on-tertiary-fixed-variant: '#004d65'
  background: '#faf9f7'
  on-background: '#1a1c1b'
  surface-variant: '#e3e2e1'
  sand-beige: '#F4F1EA'
  lush-green: '#2D5A27'
  deep-ocean: '#00334E'
  heritage-gold: '#D4AF37'
  whatsapp-green: '#25D366'
typography:
  display-lg:
    fontFamily: Montserrat
    fontSize: 48px
    fontWeight: '700'
    lineHeight: 56px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Montserrat
    fontSize: 32px
    fontWeight: '700'
    lineHeight: 40px
  headline-lg-mobile:
    fontFamily: Montserrat
    fontSize: 28px
    fontWeight: '700'
    lineHeight: 36px
  headline-md:
    fontFamily: Montserrat
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
  title-lg:
    fontFamily: Montserrat
    fontSize: 20px
    fontWeight: '600'
    lineHeight: 28px
  body-lg:
    fontFamily: Work Sans
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Work Sans
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  label-caps:
    fontFamily: Montserrat
    fontSize: 12px
    fontWeight: '700'
    lineHeight: 16px
    letterSpacing: 0.1em
  caption:
    fontFamily: Work Sans
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 8px
  container-max: 1280px
  gutter: 24px
  section-gap-desktop: 100px
  section-gap-mobile: 60px
  card-padding: 32px
---

## Brand & Style

This design system is crafted for a premium DMC specializing in curated, high-end travel experiences across South India. The brand personality is **authoritative yet inviting**, positioning itself as a knowledgeable local expert. It evokes a sense of **serenity, heritage, and uncompromising luxury.**

The visual style is **Corporate / Modern with Minimalist influences**. It prioritizes high-quality photography and intentional whitespace to create a "no-pressure" browsing environment. The aesthetic avoids unnecessary decoration, instead using precise typography and subtle elevation to guide the traveler through bespoke journey options. The focus is on clarity and the immersive beauty of the destination.

## Colors

The palette is deeply rooted in the natural landscape of South India. 
- **Primary (Deep Forest):** A dark, sophisticated green used for primary headings, navigation bars, and high-impact UI elements to establish authority.
- **Secondary (Sun-Drenched Sand):** A warm, metallic tan used for accent borders, icons, and small decorative elements that signify luxury.
- **Tertiary (Ocean Deep):** A muted navy-blue used sparingly for depth and interactive states.
- **Neutral:** The background relies on a pristine white (`#FFFFFF`) for main content areas and a soft sand-beige (`#F4F1EA`) for section differentiation.

High contrast is maintained throughout to ensure accessibility, with primary text always appearing in the Deep Forest or Pure Black against light backgrounds.

## Typography

The typography system balances the boldness of **Montserrat** for structural elements with the extreme legibility of **Work Sans** for long-form narrative content.

- **Headings:** Montserrat is used in semi-bold and bold weights. For the most premium sections, use `label-caps` to categorize content (e.g., "EXPERIENCE" or "CURATED").
- **Body Text:** Work Sans provides a neutral, professional tone that handles technical travel details and descriptions with ease.
- **Scale:** On mobile devices, `display-lg` should be downscaled to `headline-lg-mobile` to prevent overflow and maintain visual balance.

## Layout & Spacing

This design system utilizes a **Fixed Grid** model for desktop, centered within a 1280px container to ensure readability on wide displays. 

- **Grid:** A 12-column grid is standard for desktop, transitioning to a 4-column grid for mobile.
- **Rhythm:** An 8px base unit governs all padding and margins. 
- **Vertical Air:** Large section gaps (100px on desktop) are essential to maintain the "luxury" feel, preventing the UI from feeling cluttered.
- **Responsive Behavior:** On tablet and mobile, section margins should reduce to 24px and 16px respectively, with content reflowing into single-column stacks for cards.

## Elevation & Depth

Hierarchy is established through **Tonal Layers** and **Ambient Shadows**. 

- **Surfaces:** Use `#FFFFFF` for primary interaction cards (e.g., Tour Packages) to make them pop against the `#F4F1EA` section backgrounds.
- **Shadows:** Shadows must be subtle and "airy." Use a low-opacity, slightly tinted shadow (using the Primary color hex) to create a sense of natural depth: `0px 4px 20px rgba(26, 58, 50, 0.06)`.
- **Interactions:** On hover, cards should slightly lift (increasing shadow spread and decreasing Y-offset) to provide tactile feedback without looking "gamified."

## Shapes

The shape language is **Rounded**, reflecting the organic curves found in South Indian architecture and nature. 

- **Cards & Hero Containers:** Use a 16px (`rounded-lg`) radius to soften the edges of photography.
- **Buttons:** Use a 8px (`rounded-md`) radius for a professional, sturdy appearance. 
- **Tags/Badges:** Use a pill-shape (fully rounded) for category labels and status indicators like "Top Rated" or "10% OFF."

## Components

- **Buttons:** 
    - *Primary:* Deep Forest green background with White text. High-contrast and authoritative.
    - *Secondary/Ghost:* Heritage Gold border with Deep Forest text. Used for less urgent actions.
- **Cards:** Content-heavy cards (Tour Packages) must feature a top-aligned image with a 16:9 aspect ratio, followed by 32px of internal padding for text. Titles should be `title-lg`.
- **Chips & Badges:** Small pill-shaped elements using the `label-caps` style. Use a light tint of the Secondary color for the background with dark text.
- **Input Fields:** Minimalist design with 1px borders in a muted sand tone. Focus states should shift the border to the Primary color.
- **Lists:** Use custom bullet points (Heritage Gold icons) for "Why Choose Us" sections to reinforce brand identity.
- **Special Component (WhatsApp CTA):** A floating action button using the official WhatsApp green, but styled with the system's ambient shadow to integrate seamlessly.