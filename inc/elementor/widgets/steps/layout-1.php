<?php
use Elementor\Group_Control_Image_Size;
use Elementor\Control_Media;
use Elementor\Plugin;

?>
<div class="bandp-step-container <?php echo esc_attr($settings['layout']); ?>" >
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
    <div class="top-row d-flex">
        <?php
        for ($i = 1; $i <= 3; $i++) {
            $image = $settings["image{$i}"];
            $info = $settings["info{$i}"];
            $image_url = Group_Control_Image_Size::get_attachment_image_src($image['id'], 'image_size', $settings);
            $image_html = '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr(Control_Media::get_image_alt($image)) . '" />'; 
            $icon_url = TZ_TF_ELEMENTOR_URL . '/assets/img/foots_1.png';
            $icon_mb_url = TZ_TF_ELEMENTOR_URL . "/assets/img/foot_mb_{$i}.png";
            if($i ===3) {
                $icon_url = TZ_TF_ELEMENTOR_URL . '/assets/img/foots_2.png';
            }
            ?>
            
            <div class="box box-<?php echo $i; ?>">
                <div class="icon">
                    <img src="<?php echo $icon_url; ?>" alt="icon" />
                </div>
                <div class="icon-mobile">
                    <img src="<?php echo $icon_mb_url; ?>" alt="icon-mobile" />
                </div>
                <div class="image">
                <?php
                echo $image_html; ?>
                </div>
                <div class="information">
                    <?php echo wp_kses_post($info); ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="bottom-row d-flex">
        <?php
        for ($i = 4; $i <= 5; $i++) {
            $image = $settings["image{$i}"];
            $info = $settings["info{$i}"];
            $image_url = Group_Control_Image_Size::get_attachment_image_src($image['id'], 'image_size', $settings);
            $image_html = '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr(Control_Media::get_image_alt($image)) . '" />'; 
            $icon_url = TZ_TF_ELEMENTOR_URL . '/assets/img/foots_3.png';
            $icon_class = "d-none";
            $icon_mb_url = TZ_TF_ELEMENTOR_URL . "/assets/img/foot_mb_{$i}.png";
            if($i == 5) {
                $icon_class = "";
            }
            ?>
            <div class="box box-<?php echo $i; ?>">
                <div class="icon <?php echo $icon_class; ?>">
                    <img src="<?php echo $icon_url; ?>" alt="icon" />
                </div>
                <div class="icon-mobile">
                    <img src="<?php echo $icon_mb_url; ?>" alt="icon-mobile" />
                </div>
                <div class="image">
                <?php
                echo $image_html; ?>
                </div>
                <div class="information">
                    <?php echo wp_kses_post($info); ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>