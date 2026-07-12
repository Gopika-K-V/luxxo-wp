<section class="hero" id="home">
    <div class="slider-container" id="hero-slider">

        <?php
        $banner_asset_url = function ($field) {
            if (is_array($field)) {
                return $field['url'] ?? '';
            }

            if (is_numeric($field)) {
                return wp_get_attachment_url($field);
            }

            return $field;
        };

        if (have_rows('banner_slider')) :
            $i = 0;
            while (have_rows('banner_slider')) : the_row();

                $banner_img  = $banner_asset_url(get_sub_field('banner_img'));
                $mobile_img  = $banner_asset_url(get_sub_field('mobile_img'));
                $banner_video = $banner_asset_url(get_sub_field('banner_video'));
                $title       = get_sub_field('title');
                $subtitle    = get_sub_field('subtitle');
                $button_text = get_sub_field('button_text');
                $button_link = get_sub_field('button_link');
                $button_link = is_array($button_link) ? ($button_link['url'] ?? '') : $button_link;
                $video_poster = $banner_asset_url(get_sub_field('video_poster_image'));
        ?>

        <div class="slide 
    <?php echo ($i === 0) ? 'active' : ''; ?> 
    <?php echo ($banner_video) ? 'has-video' : ''; ?>"
    
    <?php if (!$banner_video): ?>
        style="background-image: url('<?php echo esc_url($banner_img); ?>');"
    <?php endif; ?>
>


   <?php if ($banner_video): ?>
    <video autoplay muted loop playsinline 
        <?php if ($video_poster): ?>
            poster="<?php echo esc_url($video_poster); ?>"
        <?php endif; ?>
    >
        <source src="<?php echo esc_url($banner_video); ?>" type="video/mp4">
    </video>
<?php else: ?>

        <?php if ($mobile_img): ?>
            <style>
                @media (max-width: 768px) {
                    .slide:nth-child(<?php echo $i + 1; ?>) {
                        background-image: url('<?php echo esc_url($mobile_img); ?>') !important;
                    }
                }
            </style>
        <?php endif; ?>

    <?php endif; ?>

    <!--<div class="slide-overlay"></div>-->

    <div class="slide-content">
        <?php if ($title): ?>
            <h1><?php echo esc_html($title); ?></h1>
        <?php endif; ?>

        <?php if ($subtitle): ?>
            <p><?php echo esc_html($subtitle); ?></p>
        <?php endif; ?>

        <?php if ($button_text && $button_link): ?>
            <a href="<?php echo esc_url($button_link); ?>" class="btn-primary btn-large">
                <?php echo esc_html($button_text); ?>
            </a>
        <?php endif; ?>
    </div>

</div>

        <?php
            $i++;
            endwhile;
        endif;
        ?>

    </div>

    <!-- Controls -->
    <!--<div class="slider-controls">-->
    <!--    <button class="prev-slide" id="prev-btn">-->
    <!--        <i class="fas fa-chevron-left"></i>-->
    <!--    </button>-->
    <!--    <button class="next-slide" id="next-btn">-->
    <!--        <i class="fas fa-chevron-right"></i>-->
    <!--    </button>-->
    <!--</div>-->
</section>
