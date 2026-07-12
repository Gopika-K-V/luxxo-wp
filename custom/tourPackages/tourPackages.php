<!-- Packages Section -->
<section class="packages" id="packages">
    <div class="container">

        <!-- Section Header (ACF Controlled) -->
        <div class="section-header">
            <div>
                <span class="section-subtitle">Curated Experiences</span>

                <?php if (get_field('package_title')) : ?>
                    <h2 class="section-title">
                        <?php echo esc_html(get_field('package_title')); ?>
                    </h2>
                <?php endif; ?>

                <?php if (get_field('package_description')) : ?>
                    <p>
                        <?php echo esc_html(get_field('package_description')); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Packages List -->
        <div class="packages-list" data-stacked-list>

            <?php if (have_rows('package_slider')) :
                while (have_rows('package_slider')) : the_row();
                
                $pkg_title = get_sub_field('package_title');
                $message = "Hi, I am interested in the package: " . $pkg_title . ". This enquiry is sent from the website.";
                $encoded_message = urlencode($message);
                ?>

                    <div class="package-card horizontal">
                        
                        <!-- Image -->
                        <div class="pkg-image">
                            <img src="<?php echo esc_url(get_sub_field('package_image')); ?>" alt="<?php the_sub_field('package_title'); ?>">
                        </div>

                        <!-- Details -->
                        <div class="pkg-details">

                            <!-- Meta (Optional: you can create ACF field for duration) -->
                            <?php if (get_sub_field('package_duration')) : ?>
                                <div class="pkg-meta">
                                    <span>
                                        <i class="far fa-clock"></i>
                                        <?php the_sub_field('package_duration'); ?>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <!-- Title -->
                            <h3><?php the_sub_field('package_title'); ?></h3>

                            <!-- Description -->
                            <p><?php the_sub_field('package_description'); ?></p>

                            <!-- Footer -->
                            <div class="pkg-footer">

                                <!-- Price (Optional ACF field) -->
                                <?php if (get_sub_field('package_price')) : ?>
                                    <span class="pkg-price">
                                        <?php the_sub_field('package_price'); ?>
                                    </span>
                                <?php endif; ?>

                                <!-- Link -->
                                <?php if (get_sub_field('package_link')) : ?>
                                    <a href="<?php the_sub_field('package_link'); ?>" class="btn-text">
                                        View Details <i class="fas fa-chevron-right"></i>
                                    </a>
                                <?php endif; ?>
                                <!-- WhatsApp Button -->
                                <a href="https://wa.me/7994737579?text=<?php echo $encoded_message; ?>" 
                                   target="_blank" 
                                   class="btn-primary">
                                   Enquire Now
                                </a>

                            </div>
                        </div>
                    </div>

            <?php endwhile;
            endif; ?>

        </div>
    </div>
</section>