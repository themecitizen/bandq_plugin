<div class="bandp-team-container <?php echo esc_attr($settings['layout']); ?>" >
    <div class="carousel">
        <?php
        if ($settings['list_members']) {
            foreach ($settings['list_members'] as $member) {
                $name = $member['member_name'];
                $info = $member['member_info'];
                $info_2 = $member['member_info_2'];
                $info_3 = $member['member_info_3'];
                $img_url = wpf_get_image_custom_size_url($member['image']['id'], 175, 230); ?>
                <div class="bandp-team">
                    <div class="inner-box">
                        <div class="content">
                            <div class="content-head">
                                <?php
                                if ($img_url) {
                                    ?>
                                    <div class="avatar">
                                        <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($member['image']['id']); ?>" />
                                        <p class="text"><span><?php echo wp_kses_post($name); ?></span></p>
                                    </div>
                                    <?php
                                } ?>
                                <div class="job-info">
                                    <p><?php echo wp_kses_post($info); ?></p>
                                    <p><?php echo wp_kses_post($info_2); ?></p>
                                </div>
                            </div>
                            <div class="content-bottom">
                                <p><?php echo wp_kses_post($info_3); ?></p>
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