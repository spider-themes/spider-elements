<?php
/**
 * Registration validation
 */
function dt_registration_validation( $username, $password, $email )  {
	global $reg_errors;
	$reg_errors = new WP_Error;
	if ( 4 > strlen( $username ) ) {
		$reg_errors->add( 'username_length', 'Username too short. At least 4 characters is required' );
	}
	if ( username_exists( $username ) ) {
		$reg_errors->add('user_name', 'Sorry, that username already exists!');
	}
	if ( ! validate_username( $username ) ) {
		$reg_errors->add( 'username_invalid', 'Sorry, the username you entered is not valid' );
	}
	if ( 5 > strlen( $password ) ) {
		$reg_errors->add( 'password', 'Password length must be greater than 5' );
	}
	if ( !is_email( $email ) ) {
		$reg_errors->add( 'email_invalid', 'Email is not valid' );
	}
	if ( email_exists( $email ) ) {
		$reg_errors->add( 'email', 'Email Already in use' );
	}

	if ( is_wp_error( $reg_errors ) ) {
		foreach ( $reg_errors->get_error_messages() as $error ) {
			$msg = '<div class="error">';
			$msg .= '<strong>ERROR </strong> : ';
			$msg .= $error . '<br/>';
			$msg .= '</div>';
		}
	} else {
		$msg = '<div class="no-error">';
		$msg .= '<strong>No Error</strong>:';
		$msg .= '</div>';
	}

	return $msg;
}

function dt_complete_registration( $username, $password, $email ) {
	$userdata = array(
		'user_login'    =>   $username,
		'user_email'    =>   $email,
		'user_pass'     =>   $password,
	);
	$user_id = wp_insert_user( $userdata );
}

add_action( 'wp_ajax_nopriv_dt_custom_registration_form', 'dt_custom_registration_form' );
add_action( 'wp_ajax_dt_custom_registration_form', 'dt_custom_registration_form' );
function dt_custom_registration_form() {
	global $reg_errors;
	$reg_errors = new WP_Error;

	$data = array();
	wp_parse_str($_POST['data'], $data);
	// sanitize user form input
	$username = sanitize_user($data['username']);
	$password = esc_attr($data['password']);
	$email = sanitize_email($data['email']);

	if ( ! isset( $data['submit_et_form'] ) || ! wp_verify_nonce( $data['submit_et_form'], 'et_test_submit_form' ) ) {
		exit;
	} else {
		if ( 4 > strlen($username) || username_exists($username) || !validate_username($username) || 5 > strlen($password) || !is_email($email) || email_exists($email)) {
			wp_send_json_error(array(
				'message' => dt_registration_validation($username, $password, $email),
			));
		} else {
			dt_complete_registration($username, $password, $email);
			wp_send_json_success(array(
				'message' => 'You have been registered successfully!'
			));
		}
	}
}