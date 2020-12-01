<?php
$args = array(
	'post_status'           => 'publish',
	'ignore_sticky_posts'   => 1,
	'posts_per_page'        => 3
);

if (!empty($settings['category']))
{
    $args['category_name'] = $settings['category'];
}

$args['orderby'] = $settings['orderby'];
$args['order']   = $settings['order'];

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$args['paged'] = $paged;

$posts = new WP_Query( $args );
?>
<div class="band-blog-list layout-grid">

	<div class="d-flex list-posts">
        <?php
        if ( $posts->have_posts() )
        {
            while ($posts->have_posts()) : $posts->the_post();
                if($posts->current_post == 0) {
                ?>
                <div class="left-side">
                    <div class="post-info">
                        <div class="image">
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                $image_id = get_post_thumbnail_id();
                                $image = wpf_get_image_custom_size_url( $image_id, 810, 542 );
                                if ( $image )
                                {
                                 ?>
                                 <img src="<?php echo $image; ?>" alt="feature-image" />
                                 <?php
                                }
                                ?>
                            </a>
                        </div>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
                        <div class="excerpt"><?php echo wp_trim_words( get_the_excerpt(), 50, '' ); ?></div>
                    </div>
                </div>
                <?php
                    continue;
                }
                else {
                    if($posts->current_post == 1) {
                        ?>
                            <div class="right-side">
                        <?php
                    }
                    ?>
                    <div class="post-info">
                        <div class="image">
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                $image_id = get_post_thumbnail_id();
                                $image = wpf_get_image_custom_size_url( $image_id, 310, 178 );
                                if ( $image )
                                {
                                    ?>
                                    <img src="<?php echo $image; ?>" alt="feature-image" />
                                    <?php
                                }
                                ?>
                            </a>
                        </div>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
                        <div class="excerpt"><?php echo wp_trim_words( get_the_excerpt(), 15, '' ); ?></div>
                    </div>
                    <?php
                    if($posts->current_post == ($posts->post_count-1)) {
                        ?>
                            </div>
                        <?php
                    }
                }
			endwhile;
			wp_reset_postdata();
		}
		?>
	</div>
</div>