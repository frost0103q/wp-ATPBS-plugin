<?php
/**
 * File: class-sp-init.php
 * Class: SP_Init
 *
 * @package Starter_Plugin
 */

if ( ! class_exists( 'ATPBS_Init' ) ) {
	/**
	 * Class SP_Init
	 */
	class ATPBS_Init {
		protected $file;

		/**
		 * SP_Init constructor.
		 */
		public function __construct() {
			$this->run();
		}

		/**
		 * Main function.
		 */
		protected function run() {
			$this->required_files();
			$this->add_actions();
			$this->add_filters();
			do_action( 'atpbs_init', __CLASS__ );
		}

		public function file_error() {
			?>
			<div class="notice notice-error">
				<p>
					<strong><?php esc_attr_e( 'File not found: ', 'atpbs' ); ?></strong>
					<?php echo esc_attr( $this->file ); ?>
					<?php esc_attr_e( '!', 'atpbs' ); ?>
				</p>
			</div>
			<?php
		}

		/**
		 * Including files.
		 *
		 * @param string $file File path.
		 */
		protected function file($file ) {
			if ( file_exists( $file ) ) {
				require_once $file;
			} else {
				$this->file = $file;
				add_action( 'admin_notices', array( $this, 'file_error' ) );
			}
		}

		/**
		 * Required Files.
		 */
		protected function required_files() {
			$this->file( ATPBS_DIR_PATH . 'includes/functions.php' );
			$this->file( ATPBS_DIR_PATH . 'includes/classes/class-atpbs-controller.php' );
		}

		/**																																																							
		 * WP enqueue scripts.
		 */

		public function wp_enqueue_scripts() {
			
		}
		
		/**
		 * Admin enqueue scripts.
		 *
		 * @param string $hook Page hook.
		 */
		public function admin_enqueue_scripts( $hook ) {
			
			wp_enqueue_style( 'toastr', 'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css' );
			wp_enqueue_script( 'toastr', 'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js' );
			wp_enqueue_style( 'bootstrap4.5.3', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css' );
			wp_enqueue_script( 'bootstrap4.5.3', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js' );
			wp_enqueue_script( "atpbs-admin-select2_js", ATPBS_DIR_URL . 'assets/select2/select2.min.js', array( 'jquery' ), ATPBS_VERSION, false );
			wp_enqueue_style( "atpbs-admin-select2_css", ATPBS_DIR_URL . 'assets/select2/select2.min.css', array(),ATPBS_VERSION, 'all' );
			
			wp_enqueue_style( ATPBS_TEXT_DOMAIN . 'atpbs-admin-css', ATPBS_DIR_URL . 'assets/css/styles.css', array(),ATPBS_VERSION, 'all' );
			wp_enqueue_script( ATPBS_TEXT_DOMAIN . 'atpbs-admin-js', ATPBS_DIR_URL . 'assets/js/admin.js', array( 'jquery' ), ATPBS_VERSION, false );
			wp_localize_script( ATPBS_TEXT_DOMAIN . 'atpbs-admin-js', 'atpbs_js_obj', [
				'ajax_url'      => admin_url( 'admin-ajax.php' ),
			] );
		}
		
		public function apply_base_page_id() {
			global $wpdb;
			$prefix        		= $wpdb->prefix;
			$basepage_id		= $_POST['basepage_id'];
			$result 			= false;
			$error				= false;
			if ($basepage_id > 0){
				$result = update_option("_j_basepage_id", $basepage_id);
			}else{
				$error = true;
				$error_msg = "Base Page id is incorrect.";
			}
			return wp_send_json(array('result'=>$result,'error'=> $error,'error_msg' => $error_msg,'base_page'=> $basepage_id));
		}

		/**
		 * Add Actions.
		 */
		protected function add_actions() {
			add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

			add_action( 'wp_ajax_apply_base_page_id', array( $this, 'apply_base_page_id') );
			add_action( 'wp_ajax_nopriv_apply_base_page_id', array( $this, 'apply_base_page_id' ) );
		}

		public function edit_shortcode_tag( $output, $tag, $attr, $m ){
		    $response_output = $output;
		    $styles  = '<style>';
		   
		    $styles .= '</style>';
		    if ( 'atpbs-admin' === $tag ) {
		        wp_enqueue_script( ATPBS_TEXT_DOMAIN . '-atpbs-admin-js' );
		        $html = atpbs_get_user_details();
                $response_output = $styles . ' ' . $output . ' ' . $html;
		    }

		    return $response_output;
		}

		/**
		 * Add Filters.
		 */
		protected function add_filters() {
		    add_filter( 'do_shortcode_tag', array( $this, 'edit_shortcode_tag' ), 10, 4 );
        }
	}
}

return 'ATPBS_Init';

