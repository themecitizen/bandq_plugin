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
        $image = $settings["image1"];
        $info = $settings["info1"];
        $image_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'image_size', $settings );
        $image_html = '<img src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( Control_Media::get_image_alt( $image ) ) . '" />';
        ?>
        <div class="box">
            <div class="image">
            <?php
            echo $image_html;
            ?>
            </div>
            <div class="information">
                <?php echo wp_kses_post($info);?>
            </div>
        </div>
    </div>
</div>