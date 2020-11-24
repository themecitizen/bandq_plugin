<?php
if ( ! class_exists( 'TZ_Socials_Widget' ) )
{
    /**
     * Class TZ_Socials_Widget create latest tweet widget
     */
    class TZ_Socials_Widget extends WP_Widget
    {
        protected $defaults;

        /**
         * Sets up the widgets name etc
         */
        public function __construct()
        {
            $this->defaults = array(
                'title'         => '',
                'facebook' => esc_html__( 'Facebook', 'butler' ),
                'twitter'    => esc_html__( 'Twitter', 'butler' ),
                'google'    => esc_html__( 'Google +', 'butler' ),
                'pinterest'    => esc_html__( 'Pinterest', 'butler' ),
                'skype'    => esc_html__( 'Skype', 'butler' ),
                'instagram'    => esc_html__( 'Instagram', 'butler' ),
            );

            $widget_ops = array(
                'classname' => 'wpf_list_socials_widget',
                'description' => __( 'Display list socials', 'consux' ),
            );
            parent::__construct( 'wpf_list_socials_widget', __( 'Consux Social Icons', 'consux' ), $widget_ops );
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
            echo '<ul>';
            foreach ( $this->defaults as $key => $social )
            {
                if ( $instance[$key] && 'title' != $key )
                {
                    ?>
                    <li><a href="<?php echo esc_url( $instance[$key] ); ?>"><i class="fa fa-<?php echo esc_attr( $key ); ?>" aria-hidden="true"></i></a></li>
                    <?php
                }
            }
            echo '</ul>';
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
            ?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'consux' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
            </p>
            <?php
            foreach ( $this->defaults as $key => $social )
            {
                if ( 'title' == $key )
                {
                    continue;
                }
                ?>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo esc_html( $social ); ?></label>
                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" placeholder="<?php echo esc_attr( $social ); ?>" type="text" value="<?php echo esc_url( $instance[$key] ); ?>">
                </p>
                <?php
            }
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
            foreach ( $this->defaults as $key => $social )
            {
                $new_instance[$key]         = strip_tags( $new_instance[$key] );
            }
            return $new_instance;
        }
    }
}