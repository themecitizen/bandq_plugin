<?php
if  ( count( $settings['images'] ) < 1 ) {
    return;
}
?>

<div class="band-slider layout-1">
    <div class="carousel">
        <?php
        foreach( $settings['images'] as $img )
        {
        ?>
            <div class="bandp-slide">
                <div class="inner-box">
                    <div class="content">
                        <div class="avatar">
                            <a href="<?php echo $img['url'] ?>"><img src="<?php echo $img['url'] ?>" alt="" /></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>