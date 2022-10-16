<?php


namespace Rtwpvs\Controllers;


use Rtwpvs\Helpers\Functions;
use Rtwpvs\Models\RtLicense;

class Licensing {

	// Licensing variable
	static $store_url = 'https://www.radiustheme.com';
	static $product_id = 99336;

	static function init() {
		add_action( 'admin_init', array( __CLASS__, 'license' ) );
		add_action( 'wp_ajax_rtwpvs_manage_licensing', array( __CLASS__, 'rtwpvs_manage_licensing' ) );
	}

	static function license() {
		if ( Functions::check_license() ) {
			$license_key    = trim( rtwpvs()->get_option( 'license_key' ) );
			$license_status = rtwpvs()->get_option( 'license_status' );
			$status         = ( ! empty( $license_status ) && $license_status === 'valid' ) ? true : false;
			new RtLicense( static::$store_url, RTWPVS_PRO_PLUGIN_FILE, array(
				'version' => rtwpvs()->version(),
				'license' => $license_key,
				'item_id' => self::$product_id,
				'author'  => rtwpvs()->author(),
				'url'     => home_url(),
				'beta'    => false,
				'status'  => $status
			) );
		}
	}

	static function rtwpvs_manage_licensing() {
		$error          = true;
		$type           = $value = $data = $message = null;
		$license_key    = trim( rtwpvs()->get_option( 'license_key' ) );
		$license_status = rtwpvs()->get_option( 'license_status' );
		$status         = ( ! empty( $license_status ) && $license_status === 'valid' ) ? true : false;
		if ( ! empty( $_REQUEST['type'] ) && $_REQUEST['type'] == "license_activate" ) {
			$api_params = array(
				'edd_action' => 'activate_license',
				'license'    => $license_key,
				'item_id'    => self::$product_id,
				'url'        => home_url()
			);
			$response   = wp_remote_post( self::$store_url,
				array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );
			if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
				$err     = $response->get_error_message();
				$message = ( is_wp_error( $response ) && ! empty( $err ) ) ? $err : __( 'An error occurred, please try again.', 'woo-product-variation-swatches' );
			} else {
				$license_data = json_decode( wp_remote_retrieve_body( $response ) );
				if ( false === $license_data->success ) {
					switch ( $license_data->error ) {
						case 'expired' :
							$message = sprintf(
								__( 'Your license key expired on %s.', 'woo-product-variation-swatches' ),
								date_i18n( get_option( 'date_format' ),
									strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
							);
							break;
						case 'revoked' :
							$message = __( 'Your license key has been disabled.', 'woo-product-variation-swatches' );
							break;
						case 'missing' :
							$message = __( 'Invalid license.', 'woo-product-variation-swatches' );
							break;
						case 'invalid' :
						case 'site_inactive' :
							$message = __( 'Your license is not active for this URL.', 'woo-product-variation-swatches' );
							break;
						case 'item_name_mismatch' :
							$message = __( 'This appears to be an invalid license key for Classified Listing Pro.', 'woo-product-variation-swatches' );
							break;
						case 'no_activations_left':
							$message = __( 'Your license key has reached its activation limit.', 'woo-product-variation-swatches' );
							break;
						default :
							$message = __( 'An error occurred, please try again.', 'woo-product-variation-swatches' );
							break;
					}
				}
				// Check if anything passed on a message constituting a failure
				if ( empty( $message ) ) {
					rtwpvs()->update_option( 'license_status', $license_data->license );
					$error = false;
					$type  = 'license_deactivate';
					$value = __( 'Deactivate License', "woo-product-variation-swatches" );
				}
			}
		}
		if ( ! empty( $_REQUEST['type'] ) && $_REQUEST['type'] == "license_deactivate" ) {
			$api_params = array(
				'edd_action' => 'deactivate_license',
				'license'    => $license_key,
				'item_id'    => self::$product_id,
				'url'        => home_url()
			);
			$response   = wp_remote_post( self::$store_url,
				array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

			// Make sure there are no errors
			if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
				$err     = $response->get_error_message();
				$message = ( is_wp_error( $response ) && ! empty( $err ) ) ? $err : __( 'An error occurred, please try again.', 'woo-product-variation-swatches' );
			} else {
				rtwpvs()->update_option( 'license_status', '' );
				$error = false;
				$type  = 'license_activate';
				$value = __( 'Activate License', "woo-product-variation-swatches" );
			}
		}
		$response = array(
			'error' => $error,
			'msg'   => $message,
			'type'  => $type,
			'value' => $value,
			'data'  => $data
		);
		wp_send_json( $response );
	}

}