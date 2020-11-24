<?php
/**
 * Class contains shortcodes use in themes and vc
 *
 * @package wpf
 */

if( ! class_exists( 'TZ_Shortcodes' ) )
{
    class TZ_Shortcodes
    {
        /**
         * Store variables for js
         *
         * @var array
         */
        public $l10n = array();

        /**
         * Check if WooCommerce plugin is actived or not
         *
         * @var bool
         */

        /**
         * TZ_Shortcodes constructor.
         */
        function __construct()
        {

            $shortcodes = array(
                'custom_text',
                'distance',
            );

            // register shortcode
            foreach ($shortcodes as $shortcode) {
                add_shortcode($shortcode, array($this, $shortcode));
            }
            add_action('wp_footer', array($this, 'footer'));
        }

        function distance( $atts )
        {
            $atts = shortcode_atts( array(
                'extra_large_device'  =>  '',
                'large_device'  =>  '',
                'medium_device' =>  '',
                'small_device' =>  '',
                'extra_small_device' =>  '',
            ), $atts );
            $on_ex_lg = $atts['extra_large_device'] ? sprintf( 'style="height: %s"', esc_attr( $atts['extra_large_device'] ) ) : '';
            $on_lg = $atts['large_device'] ? sprintf( 'style="height: %s"', esc_attr( $atts['large_device'] ) ) : '';
            $on_md = $atts['medium_device'] ? sprintf( 'style="height: %s"', esc_attr( $atts['medium_device'] ) ) : '';
            $on_sm = $atts['small_device'] ? sprintf( 'style="height: %s"', esc_attr( $atts['small_device'] ) ) : '';
            $on_xs = $atts['extra_small_device'] ? sprintf( 'style="height: %s"', esc_attr( $atts['extra_small_device'] ) ) : '';

            ob_start();
            ?>
            <div class="wokrate-distance">
                <div class="d-none d-xl-block" <?php echo $on_ex_lg; ?>></div>
                <div class="d-none d-lg-block d-xl-none" <?php echo $on_lg; ?>></div>
                <div class="d-none d-md-block d-lg-none" <?php echo $on_md; ?>></div>
                <div class="d-none d-sm-block d-md-none" <?php echo $on_sm; ?>></div>
                <div class="d-block d-sm-none" <?php echo $on_xs; ?>></div>
            </div>
            <?php
            $output = ob_get_clean();
            return $output;
        }

        /**
         * Function display section title
         *
         * @param array $atts
         * @param string $content
         *
         * @return string
         */

        function custom_text( $atts )
        {
            $atts = shortcode_atts( array(
                'text'  =>  '',
                'link'  =>  '',
                'font_container' => '',
                'use_theme_fonts'   =>  '',
                'google_fonts'  =>  '',
                'css_animation' =>  '',
                'class_name'    =>  '',
                'css'           =>  ''
            ), $atts );

            $css_classes = array(
                'custom-heading',
                self::get_css_animation( $atts['css_animation'] ),
                vc_shortcode_custom_css_class( $atts['css'], ' ' ),
                $atts['class_name']
            );
            $font_attr_val = self::extract_font_container( $atts['font_container'] );
            $text = $atts['text'];
            if ( $atts['link'] )
            {
                $link = self::build_link( $atts['link'] );
                $link_style = '';
                if ( ! empty( $font_attr_val['values']['color'] ) )
                {
                    $link_style = sprintf( 'style="color: %s"', esc_attr( $font_attr_val['values']['color'] ) );
                }
                $text = sprintf( '<a %s %s>%s</a>',implode( ' ', $link['atts'] ), $link_style, $text );
                $font_attr_val['values']['color'] = '';
                $font_attr = self::extract_font_container_style( $font_attr_val );
            }
            else
            {
                $font_attr = self::extract_font_container_style( $font_attr_val );
            }
            if ( ! $atts['use_theme_fonts'] )
            {
                $custom_font = self::extract_google_font_data( $atts['google_fonts'] );
                $font_attr = array_merge( $font_attr, $custom_font );
            }
            $style = sprintf( 'style="%s"', esc_attr( implode( '; ', $font_attr ) ) );

            ob_start();
            ?>
            <<?php echo $font_attr_val['values']['tag']; ?> <?php echo $style; ?> class="<?php echo implode( ' ', $css_classes ); ?>" >
            <?php echo wp_kses_post( $text ); ?>
            </<?php echo $font_attr_val['values']['tag']; ?>>
            <?php
            $output = ob_get_clean();
            return $output;
        }

        /**
         * Function enqueues script
         */
        function footer()
        {
            wp_localize_script('wpf-scripts', 'TZ_ShortCode', $this->l10n);
        }

        public static function get_css_animation( $css_animation )
        {
            $output = '';

            if ( '' !== $css_animation ) {
                wp_enqueue_script( 'waypoints' );
                wp_enqueue_style( 'animate-css' );
                $output = ' wpb_animate_when_almost_visible wpb_' . $css_animation . ' ' . $css_animation;
            }

            return $output;
        }

        function build_link( $atts )
        {
            $attributes = array();

            $link = vc_build_link( $atts );

            if ( ! empty( $link['url'] ) ) {
                $attributes['href'] = $link['url'];
            }

            $label = $link['title'];

            if ( $label && ! empty( $label ) ) {
                $attributes['title'] = $label;
            }

            if ( ! empty( $link['target'] ) ) {
                $attributes['target'] = $link['target'];
            }

            if ( ! empty( $link['rel'] ) ) {
                $attributes['rel'] = $link['rel'];
            }

            $attr = array();

            foreach ( $attributes as $name => $v ) {
                $attr[] = $name . '="' . esc_attr( $v ) . '"';
            }

            return array(
                'label' => $label,
                'atts' => $attr
            );
        }

        /**
         *
         * Example:  $title_attr_val = self::extract_font_container( $atts['title_font_container'] );
                     $title_attr = self::extract_font_container_style( $title_attr_val );
         *
         * @param $font_container
         *
         * @return array $styles font style
         */

        public static function extract_font_container_style( $font_container_data )
        {
            $styles = array();

            if ( ! empty( $font_container_data ) && isset( $font_container_data['values'] ) )
            {
                foreach ( $font_container_data['values'] as $key => $value ) {
                    if ( 'tag' !== $key && strlen( $value ) ) {
                        if ( preg_match( '/description/', $key ) ) {
                            continue;
                        }
                        if ( 'font_size' === $key || 'line_height' === $key ) {
                            $value = preg_replace( '/\s+/', '', $value );
                        }
                        if ( 'font_size' === $key ) {
                            $pattern = '/^(\d*(?:\.\d+)?)\s*(px|\%|in|cm|mm|em|rem|ex|pt|pc|vw|vh|vmin|vmax)?$/';
                            // allowed metrics: http://www.w3schools.com/cssref/css_units.asp
                            $regexr = preg_match( $pattern, $value, $matches );
                            $value = isset( $matches[1] ) ? (float) $matches[1] : (float) $value;
                            $unit = isset( $matches[2] ) ? $matches[2] : 'px';
                            $value = $value . $unit;
                        }
                        if ( strlen( $value ) > 0 ) {
                            $styles[] = str_replace( '_', '-', $key ) . ': ' . $value;
                        }
                    }
                }
            }

            return$styles;
        }


        public static function extract_font_container( $font_container )
        {
            $font_container_obj = new Vc_Font_Container();
            $font_container_field_settings = isset( $font_container_field['settings'], $font_container_field['settings']['fields'] ) ? $font_container_field['settings']['fields'] : array();
            $font_container_data = $font_container_obj->_vc_font_container_parse_attributes( $font_container_field_settings, $font_container );
            return $font_container_data;
        }

        /**
         * Example: $custom_font = self::extract_google_font_data( $atts['desc_google_fonts'] );
         * @param $data
         *
         * @return array $styles font style
         */
        public static function extract_google_font_data( $data )
        {
            $google_fonts_data = self::extract_font_container( $data );
            $styles = array();
            if ( ! empty( $google_fonts_data ) && isset( $google_fonts_data['values'], $google_fonts_data['values']['font_family'], $google_fonts_data['values']['font_style'] ) )
            {
                $google_fonts_family = explode( ':', $google_fonts_data['values']['font_family'] );
                $styles[] = 'font-family:' . $google_fonts_family[0];
                $google_fonts_styles = explode( ':', $google_fonts_data['values']['font_style'] );
                $styles[] = 'font-weight:' . $google_fonts_styles[1];
                $styles[] = 'font-style:' . $google_fonts_styles[2];
            }
            return $styles;
        }
    }
}
