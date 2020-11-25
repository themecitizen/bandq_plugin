<div class="bandp-team-container <?php echo esc_attr($settings['layout']); ?>" >
    <div class="carousel">
        <?php
        if ($settings['list_members']) {
            foreach ($settings['list_members'] as $member) {
                $name = $member['member_name'];
                $info = $member['member_info'];
                $img_url = wpf_get_image_custom_size_url($member['image']['id'], 182, 182); ?>
                <div class="bandp-team">
                    <div class="inner-box">
                        <div class="content">
                         <?php
                            if ($img_url) {
                                ?>
                                <div class="avatar">
                                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($member['image']['id']); ?>" />
                                </div>
                            <?php
                            } ?>
                            <h3><span class="text"><?php echo wp_kses_post($name); ?></span></h3>
                            <div class="job-info">
                                <?php echo wp_kses_post($info); ?>
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