<section class="top_banner">
  <div id="bannerCarousel"
    class="carousel slide carousel-fade"
    data-bs-ride="carousel"
    data-bs-pause="false"
    data-bs-interval="3000"
    data-bs-wrap="true"
    data-bs-touch="true">

    <!-- Indicators -->
    <div class="carousel-indicators carousel-indicators-custom">
      <?php
      if (have_rows('banner_slider')) :
        $i = 0;
        while (have_rows('banner_slider')) : the_row(); ?>
          <button
            type="button"
            data-bs-target="#bannerCarousel"
            data-bs-slide-to="<?php echo $i; ?>"
            class="indicator-dot <?php echo $i === 0 ? 'active' : ''; ?>"
            <?php echo $i === 0 ? 'aria-current="true"' : ''; ?>
            aria-label="Slide <?php echo $i + 1; ?>">
          </button>
      <?php
          $i++;
        endwhile;
      endif;
      ?>
    </div>

    <!-- Slides -->
    <div class="carousel-inner">
      <?php
      if (have_rows('banner_slider')) :
        $i = 0;
        while (have_rows('banner_slider')) : the_row(); ?>
          <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
            <?php
            $banner_img = get_sub_field('banner_img');
            $mobile_img = get_sub_field('mobile_img');
            ?>
            <img src="<?php the_sub_field('banner_img'); ?>" class="d-none d-md-block w-100" alt="Slide <?php echo $i + 1; ?>">
            <img src="<?php echo esc_url($mobile_img ? $mobile_img : $banner_img); ?>"
              class="d-md-none w-100"
              alt="Slide <?php echo $i + 1; ?>">
          </div>
      <?php
          $i++;
        endwhile;
      endif;
      ?>
    </div>

    <!-- Previous Button -->
    <button class="carousel-control-prev carousel-control-custom" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
      <span class="carousel-control-icon"></span>
      <span class="visually-hidden">Previous</span>
    </button>

    <!-- Next Button -->
    <button class="carousel-control-next carousel-control-custom" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
      <span class="carousel-control-icon"></span>
      <span class="visually-hidden">Next</span>
    </button>

  </div>
</section>