<div class="osaas-team-container <?php echo esc_attr($settings['layout']); ?>" data-hide-pagination="<?php echo esc_attr($settings['hide_pagination']);?>" data-autoplay="<?php echo esc_attr($settings['carousel_autoplay']);?>">
    <div class="carousel">
        <?php
        if ($settings['list_members']) {
            foreach ($settings['list_members'] as $member) {
                $name = $member['member_name'];
                $job = $member['member_job'];
                $img_url = osaas_get_image_custom_size_url($member['image']['id'], 145, 145);
                $fb = !empty($member['member_fb']) ? $member['member_fb'] : '#';
                $twitter = !empty($member['member_twitter']) ? $member['member_twitter'] : '#';
                $behence = !empty($member['member_behence']) ? $member['member_behence'] : '#';
        ?>
                <div class="osaas-team">
                    <div class="inner-box">
                        <div class="content">
                            <div class="job d-flex justify-content-between">
                                <div class="cirlces">
                                    <div class="circle-one"></div>
                                    <div class="circle-two"></div>
                                </div>
                                <div class="job-info">
                                    <?php echo wp_kses_post($job); ?>
                                </div>
                            </div>
                            <?php
                            if ($img_url) {
                            ?>
                                <div class="avatar">
                                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($member['image']['id']); ?>" />
                                </div>
                            <?php
                            }
                            ?>
                            <div class="member-info d-flex justify-content-between align-items-end">
                                <h3><?php echo wp_kses_post($name); ?></h3>
                                <div class="social-outer-box">
                                    <div class="plus fa fa-plus"></div>
                                    <div class="social-boxed">
                                        <ul class="social-box">
                                            <li class="facebook"><a href="<?php echo esc_url($fb); ?>" class="fab fa-facebook-f"></a></li>
                                            <li class="twitter"><a href="<?php echo esc_url($twitter); ?>" class="fab fa-twitter"></a></li>
                                            <li class="behance"><a href="<?php echo esc_url($behence); ?>" class="fab fa-behance"></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>