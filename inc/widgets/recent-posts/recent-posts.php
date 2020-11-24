<?php
if ( ! class_exists( 'TZ_Recent_Posts' ) )
{
    /**
     * Class TZ_Recent_Posts create latest tweet widget
     */
    class TZ_Recent_Posts extends WP_Widget
    {
        protected $defaults;

        /**
         * Sets up the widgets name etc
         */
        public function __construct()
        {
            $this->defaults = array(
                'title'         => '',
                'number_posts_to_show' => '',
                'open_new_window'    => '',
                'post_category'    => '',
                'orderby'    => '',
                'order'    => '',
            );

            $widget_ops = array(
                'classname' => 'wpf_recent_posts_widget',
                'description' => __( 'Display Recent Posts', 'theme_domain' ),
            );
            parent::__construct( 'wpf_recent_posts_widget', __( 'TZ Recent Posts', 'theme_domain' ), $widget_ops );
        }

        /**
         * Outputs the content of the widget
         *
         * @param array $args
         * @param array $instance
         */
        public function widget( $args, $instance )
        {
            // outputs the content of the widget
            $instance = wp_parse_args( $instance, $this->defaults );

            echo $args['before_widget'];

            if ( $title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) )
            {
                echo $args['before_title'] . $title . $args['after_title'];
            }
            $post_args = array(
                'post_type' => 'post',
                'posts_per_page'    =>  $instance['number_posts_to_show'],
                'ignore_sticky_posts' => true,
            );
            if ( isset( $instance['post_category'] ) )
            {
                $post_args['category'] = $instance['post_category'];
            }
            if ( $instance['orderby'] )
            {
                $post_args['orderby'] = $instance['orderby'];
            }
            $post_args['order']   = $instance['order'];
            $myposts = new WP_Query( $post_args );
            if ( $myposts->have_posts() )
            {
                echo '<ul class="list-posts">';
                while ( $myposts->have_posts() )
                {
                    $myposts->the_post();
                    ?>
                    <li class="clearfix">
                        <?php
                        $has_post_thumbnail = '';
                        if ( has_post_thumbnail() )
                        {
                            $has_post_thumbnail = 'has-post-thubmnail';
                            ?>
                            <div class="thumbnail">
                                <?php
                                the_post_thumbnail( 'tz-recent-post-thumbnail-widget' );
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="entry-content <?php echo esc_attr( $has_post_thumbnail ); ?>">
                            <h4>
                                <?php
                                $target = '';
                                if ( $instance['open_new_window'] )
                                {
                                    $target = '_blank';
                                }
                                ?>
                                <a target="<?php echo esc_attr( $target ); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                            <div class="time"><i class="fal fa-clock"></i> <?php echo get_the_date( 'F j, Y ' ); ?></div>
                        </div>
                    </li>
                    <?php
                }
                wp_reset_postdata();
                echo '</ul>';
            }
            echo $args['after_widget'];
        }

        /**
         * Outputs the options form on admin
         *
         * @param array $instance The widget options
         */
        public function form( $instance )
        {
            $instance = wp_parse_args( $instance, $this->defaults );
            $categories = get_categories( array( 'hide_empty' => 0, 'hierarchical' => 1 ) );
            $number_of_cats = count( $categories );
            $number_of_rows = ( 10 > $number_of_cats ) ? $number_of_cats + 1 : 10;
            $cat_list = array();
            if ( 0 < $number_of_cats ) {

                // make a hierarchical list of categories
                while ( $categories ) {
                    // go on with the first element in the categories list:
                    // if there is no parent
                    if ( '0' == $categories[ 0 ]->parent ) {
                        // get and remove it from the categories list
                        $current_entry = array_shift( $categories );
                        // append the current entry to the new list
                        $cat_list[] = array(
                            'id'	=> absint( $current_entry->term_id ),
                            'name'	=> esc_html( $current_entry->name ),
                            'depth'	=> 0
                        );
                        // go on looping
                        continue;
                    }
                    // if there is a parent:
                    // try to find parent in new list and get its array index
                    $parent_index = tz_tf_cat_parent_index( $cat_list, $categories[ 0 ]->parent );
                    // if parent is not yet in the new list: try to find the parent later in the loop
                    if ( false === $parent_index ) {
                        // get and remove current entry from the categories list
                        $current_entry = array_shift( $categories );
                        // append it at the end of the categories list
                        $categories[] = $current_entry;
                        // go on looping
                        continue;
                    }
                    // if there is a parent and parent is in new list:
                    // set depth of current item: +1 of parent's depth
                    $depth = $cat_list[ $parent_index ][ 'depth' ] + 1;
                    // set new index as next to parent index
                    $new_index = $parent_index + 1;
                    // find the correct index where to insert the current item
                    foreach( $cat_list as $entry ) {
                        // if there are items with same or higher depth than current item
                        if ( $depth <= $entry[ 'depth' ] ) {
                            // increase new index
                            $new_index = $new_index + 1;
                            // go on looping in foreach()
                            continue;
                        }
                        // if the correct index is found:
                        // get current entry and remove it from the categories list
                        $current_entry = array_shift( $categories );
                        // insert current item into the new list at correct index
                        $end_array = array_splice( $cat_list, $new_index ); // $cat_list is changed, too
                        $cat_list[] = array(
                            'id'	=> absint( $current_entry->term_id ),
                            'name'	=> esc_html( $current_entry->name ),
                            'depth'	=> $depth
                        );
                        $cat_list = array_merge( $cat_list, $end_array );
                        // quit foreach(), go on while-looping
                        break;
                    } // foreach( cat_list )
                } // while( categories )

            }
            ?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'theme_domain' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'number_posts_to_show' ) ); ?>"><?php esc_html_e( 'Number of posts to show: ', 'theme_domain' ); ?></label>
                <input id="<?php echo esc_attr( $this->get_field_id( 'number_posts_to_show' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_posts_to_show' ) ); ?>" type="number" min="0"  value="<?php echo intval( $instance['number_posts_to_show'] ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'open_new_window' ) ); ?>"><?php esc_html_e( 'Open post links in new windows?', 'theme_domain' ); ?></label>
                <input class="checkbox" type="checkbox" value="1" <?php checked( '1', $instance[ 'open_new_window' ] ); ?> id="<?php echo esc_attr( $this->get_field_id( 'open_new_window' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'open_new_window' ) ); ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'post_category' ) ); ?>"><?php esc_html_e( 'Select Category', 'theme_domain' ); ?></label>
                <select id="<?php echo esc_attr( $this->get_field_id( 'post_category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_category' ) ); ?>">
                    <option value="0" <?php selected( 0, $instance[ 'post_category' ]  ); ?>><?php echo esc_html__( 'All', 'theme_domain' ); ?></option>
                    <?php
                    foreach ( $cat_list as $category )
                    {
                        $cat_name = $category[ 'name' ];
                        $pad = ( 0 < $category[ 'depth' ] ) ? str_repeat('&ndash;&nbsp;', $category[ 'depth' ] ) : '';
                        ?>
                        <option value="<?php echo esc_attr( $category[ 'id' ] ); ?>" <?php selected( $category[ 'id' ], $instance[ 'post_category' ]  ); ?>><?php echo $pad . $cat_name; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Order By', 'theme_domain' ); ?></label>
                <select id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>">
                    <?php
                    $orderby = [
                        'post_date' => esc_html__( 'Date', 'theme_domain' ),
                        'post_title' => esc_html__( 'Title', 'theme_domain' ),
                        'menu_order' => esc_html__( 'Menu Order', 'theme_domain' ),
                        'rand' => esc_html__( 'Random', 'theme_domain' ),
                    ];
                    foreach ( $orderby as $key => $value )
                    {
                        ?>
                        <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $instance[ 'orderby' ]  ); ?>><?php echo $value; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Order By', 'theme_domain' ); ?></label>
                <select id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>">
                    <?php
                    $order = [
                        'desc' => esc_html__( 'DESC', 'theme_domain' ),
                        'asc' => esc_html__( 'ASC', 'theme_domain' ),
                    ];
                    foreach ( $order as $key => $value )
                    {
                        ?>
                        <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $instance[ 'order' ]  ); ?>><?php echo $value; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <?php
        }

        /**
         * Processing widget options on save
         *
         * @param array $new_instance The new options
         * @param array $old_instance The previous options
         *
         * @return array
         */
        public function update( $new_instance, $old_instance ) {
            $new_instance['title']         = strip_tags( $new_instance['title'] );
            $new_instance['number_posts_to_show']         = strip_tags( $new_instance['number_posts_to_show'] );
            $new_instance['open_new_window']    = intval( $new_instance['open_new_window'] );
            $new_instance['post_category']    = intval( $new_instance['post_category'] );
            $new_instance['orderby']    = $new_instance['orderby'];
            $new_instance['order']    = $new_instance['order'];

            return $new_instance;
        }
    }
}