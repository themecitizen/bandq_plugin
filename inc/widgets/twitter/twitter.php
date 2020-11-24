<?php
if ( ! class_exists( 'TZ_Tweet_Widget' ) )
{
    /**
     * Class TZ_Tweet_Widget create latest tweet widget
     */
    class TZ_Tweet_Widget extends WP_Widget
    {
        protected $defaults;

        /**
         * Sets up the widgets name etc
         */
        public function __construct()
        {
            $this->defaults = array(
                'title'         => '',
                'twitter_hashtag' => '',
                'oauth_access_secret'    => '',
                'oauth_access_token'    => '',
                'oauth_consumer_secret'    => '',
                'oauth_consumer_key'    => '',
            );

            $widget_ops = array(
                'classname' => 'wpf_tweet_widget',
                'description' => __( 'Display latest tweets', 'theme_domain' ),
            );
            parent::__construct( 'wpf_tweet_widget', __( 'WPF Latest Tweets', 'theme_domain' ), $widget_ops );
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
            if ( ! isset( $instance['oauth_consumer_key'] ) || ! isset( $instance['oauth_consumer_secret'] ) || ! isset( $instance['oauth_access_token'] ) || ! isset( $instance['oauth_access_secret'] ) )
            {
                echo '<p>Incomplete settings for authentication</p>';
                return;
            }
            $oauth = array(
                'oauth_access_token'    =>  $instance['oauth_access_token'],
                'oauth_access_token_secret'    =>  $instance['oauth_access_secret'],
                'consumer_key'    =>  $instance['oauth_consumer_key'],
                'consumer_secret'    =>  $instance['oauth_consumer_secret'],
            );
            $url    = 'https://api.twitter.com/1.1/search/tweets.json';
            $hash_tag = isset( $instance['twitter_hashtag'] ) ? $instance['twitter_hashtag'] : '';
            $count = isset( $instance['number_tweet'] ) ? $instance['number_tweet'] : 1;
            $method = 'GET';
            $params = "?q=$hash_tag&result_type=recent&count=$count";
            $twitter = new TwitterAPIExchange($oauth);

            echo $args['before_widget'];

            if ( $title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) )
            {
                echo $args['before_title'] . $title . $args['after_title'];
            }

            $datas = $twitter->request( $url, $method, $params );
            $datas = (array)@json_decode($datas, true);
            if ( isset( $datas['errors'] ) )
            {
                echo sprintf( '<p>%s</p>', esc_html_e( $datas['errors'][0]['message'], 'theme_domain' ) );
            }
            else
            {
                foreach ( $datas['statuses'] as $data )
                {
                ?>
                    <article class="tweet-item">
                    <?php echo wpautop( $data['text'] ); ?>
                    <span class="tweet-time">
                    <?php echo $data['user']['name']; ?>
                    </span>
                    </article>
                <?php
                }
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
            ?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'theme_domain' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'oauth_consumer_key' ) ); ?>"><?php esc_html_e( 'OAuth Consumer Key: ', 'theme_domain' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'oauth_consumer_key' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'oauth_consumer_key' ) ); ?>" type="text"  value="<?php echo esc_attr( $instance['oauth_consumer_key'] ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'oauth_consumer_secret' ) ); ?>"><?php esc_html_e( 'OAuth Consumer Secret: ', 'theme_domain' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'oauth_consumer_secret' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'oauth_consumer_secret' ) ); ?>" type="text"  value="<?php echo esc_attr( $instance['oauth_consumer_secret'] ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'oauth_access_token' ) ); ?>"><?php esc_html_e( 'OAuth Access Token: ', 'theme_domain' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'oauth_access_token' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'oauth_access_token' ) ); ?>" type="text"  value="<?php echo esc_attr( $instance['oauth_access_token'] ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'oauth_access_secret' ) ); ?>"><?php esc_html_e( 'OAuth Access Secret: ', 'theme_domain' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'oauth_access_secret' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'oauth_access_secret' ) ); ?>" type="text"  value="<?php echo esc_attr( $instance['oauth_access_secret'] ); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'twitter_hashtag' ) ); ?>"><?php esc_html_e( 'Twitter account: ', 'theme_domain' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter_hashtag' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter_hashtag' ) ); ?>" type="text"  value="<?php echo esc_attr( $instance['twitter_hashtag'] ); ?>" placeholder="Ex: #twitter #wordpress">
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'number_tweet' ) ); ?>"><?php esc_html_e( 'Number of Tweets: ', 'theme_domain' ); ?></label>
                <input id="<?php echo esc_attr( $this->get_field_id( 'number_tweet' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_tweet' ) ); ?>" type="number" min="0"  value="<?php echo intval( $instance['number_tweet'] ); ?>">
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
            $new_instance['twitter_account']         = strip_tags( $new_instance['twitter_account'] );
            $new_instance['number_tweet']    = intval( $new_instance['number_tweet'] );

            return $new_instance;
        }
    }
}