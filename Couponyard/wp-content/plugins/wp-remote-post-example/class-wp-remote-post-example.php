<?php
<?php
class WP_Remote_Post_Example {
 
    protected static $instance = null;
 
    private function __construct() {
 
        add_action( 'the_content', array( $this, 'get_post_response' ) );
 
    }
 
    public static function get_instance() {
 
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
 
        return self::$instance;
 
    }
 
    public function get_post_response( $content ) {
 
        if ( is_single() ) {
 
            $unique_id = $_SERVER['REMOTE_ADDR'];
            $site_url = site_url();
            $page_url = get_permalink();
 
            $url = plugins_url( 'wp-remote-post-example/wp-remote-receiver.php' );
 
            $response = wp_remote_post(
                $url,
                array(
                    'body' => array(
                        'unique-id'   => $unique_id,
                        'address'     => $site_url,
                        'page-viewed' => $page_url
                    )
                )
            );
 
            if ( is_wp_error( $response ) ) {
 
                $html = '<div id="post-error">';
                    $html .= __( 'There was a problem retrieving the response from the server.', 'wprp-example' );
                $html .= '</div><!-- /#post-error -->';
 
            }
            else {
 
                $html = '<div id="post-success">';
                    $html .= '<p>' . __( 'Your message posted with success! The response was as follows:', 'wprp-example' ) . '</p>';
                    $html .= '<p id="response-data">' . $response['body'] . '</p>';
                $html .= '</div><!-- /#post-error -->';
 
            }
 
            $content .= $html;
 
        }
 
        return $content;
 
    }
 
}