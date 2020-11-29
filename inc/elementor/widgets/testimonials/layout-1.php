<div class="bandp-testimonial-container <?php echo esc_attr($settings['layout']); ?>" >
    <div class="carousel">
        <?php
        if ($settings['list_testimonials']) {
            foreach ($settings['list_testimonials'] as $member) {
                $name = $member['name'];
                $info = $member['testimonial'];
                $quote_left_icon = TZ_TF_ELEMENTOR_URL . '/assets/img/quote_left_icon.png';
                $quote_right_icon = TZ_TF_ELEMENTOR_URL . '/assets/img/quote_right_icon.png';
                ?>
                <div class="bandp-testimonial">
                    <div class="inner-box">
                        <div class="quote left-icon"><img src="<?php echo $quote_left_icon; ?>" alt="icon" /></div>
                        <div class="quote right-icon"><img src="<?php echo $quote_right_icon; ?>" alt="icon" /></div>

                        <div class="content">
                            <div class="job-info">
                                <?php echo wp_kses_post($info); ?>
                            </div>
                            <h3><span class="text"><?php echo wp_kses_post($name); ?></span></h3>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>