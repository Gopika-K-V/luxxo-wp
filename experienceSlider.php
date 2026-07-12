<?php
/**
 * Experience Slider template
 * Expects ACF fields:
 * - experience_slider_title
 * - experience_slider_description
 * - experience_slider_items (repeater)
 *     - item_image
 *     - item_title
 *     - item_description
 *     - item_link
 */
?>

<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/experienceSlider.css">

<div class="experience-slider-wrapper">
    <div class="container">
        <div class="experience-header">
            <?php $title = get_field('experience_slider_title'); if($title): ?>
                <h2 class="experience-title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>

            <?php $desc = get_field('experience_slider_description'); if($desc): ?>
                <p class="experience-desc"><?php echo esc_html($desc); ?></p>
            <?php endif; ?>
        </div>

        <div class="swiper experience-swiper">
            <div class="swiper-wrapper">
                <?php if( have_rows('experience_slider_items') ):
                    while( have_rows('experience_slider_items') ): the_row();
                        $img = get_sub_field('item_image');
                        $title = get_sub_field('item_title');
                        $excerpt = get_sub_field('item_description');
                        $link = get_sub_field('item_link');

                        // handle ACF image array or url
                        $img_url = '';
                        if( is_array($img) && !empty($img['url']) ){
                            $img_url = $img['url'];
                        } elseif( is_string($img) ){
                            $img_url = $img;
                        }
                ?>

                <div class="swiper-slide">
                    <article class="experience-card">
                        <?php if($img_url): ?>
                            <div class="exp-image">
                                <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($title); ?>">
                                <div class="exp-image-overlay"></div>
                                <div class="exp-badge">Experience</div>
                            </div>
                        <?php endif; ?>

                        <div class="exp-content">
                            <div class="exp-title-row">
                                <?php if($title): ?><h3 class="exp-title"><?php echo esc_html($title); ?></h3><?php endif; ?>
                            </div>

                            <?php if($excerpt): ?><p class="exp-excerpt"><?php echo esc_html($excerpt); ?></p><?php endif; ?>

                                <?php
                                    // WhatsApp booking button (India +91 7994737579)
                                    $wa_number = '91' . '7994737579';
                                    $wa_msg = rawurlencode('Hi, I am interested in ' . ($title ?: 'this experience') . '.');
                                    $wa_url = 'https://wa.me/' . $wa_number . '?text=' . $wa_msg;
                                ?>

                                <div class="exp-footer" style="justify-content:flex-end;">
                                    <a class="exp-cta" href="<?php echo esc_url($wa_url); ?>" target="_blank" rel="noopener noreferrer">Book Now</a>
                                </div>
                        </div>
                    </article>
                </div>

                <?php
                    endwhile;
                endif;
                ?>
            </div>

        </div>
    </div>
</div>
