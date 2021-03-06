<?php
/**
 * This file is used for displaying dashboard widget.
 *
 * @author   Tech Banker
 * @package  mail-bank/lib
 * @version  3.0.12
 */

	/**
	 * This file is used for displaying dashboard widget.
	 *
	 * @param  string $type passes as type.
	 */
function get_mail_configuration_data_mail_bank( $type ) {
	global $wpdb;
	$meta_value = $wpdb->get_var(
		$wpdb->prepare(
			'SELECT meta_value FROM ' . $wpdb->prefix . 'mail_bank_meta  WHERE meta_key=%s', $type
		)
	); // db call ok; no-cache ok.
	return maybe_unserialize( $meta_value );
}
$unserialized_mail_configuration_data = get_mail_configuration_data_mail_bank( 'email_configuration' );

$email_logs_data              = $wpdb->get_results(
	'SELECT email_data FROM ' . $wpdb->prefix . 'mail_bank_email_logs ORDER BY id DESC'
); // WPCS: db call ok; no-cache ok.
$mb_status_sent               = 0;
$mb_status_not_sent           = 0;
$email_logs_unserialized_data = array();
foreach ( $email_logs_data as $data ) {
	$email_logs_unserialized_data = maybe_unserialize( $data->email_data );
	if ( 'Sent' === $email_logs_unserialized_data['status'] ) {
		$mb_status_sent++;
	} else {
		$mb_status_not_sent++;
	}
}

$mb_encryption = '';
switch ( $unserialized_mail_configuration_data['enc_type'] ) {
	case 'tls':
		$mb_encryption = 'TLS Encryption';
		break;
	case 'ssl':
		$mb_encryption = 'SSL Encryption';
		break;
	default:
		$mb_encryption = 'No Encryption';
		break;
}
$mb_authentication = '';
switch ( esc_attr( $unserialized_mail_configuration_data['auth_type'] ) ) {
	case 'crammd5':
		$mb_authentication = 'Crammd5';
		break;
	case 'oauth2':
		$mb_authentication = 'Oauth2';
		break;
	case 'login':
		$mb_authentication = 'Login';
		break;
	case 'plain':
		$mb_authentication = 'Plain';
		break;
	default:
		$mb_authentication = 'No';
		break;
}
$mb_mailer_type          = esc_attr( $unserialized_mail_configuration_data['mailer_type'] ) === 'smtp' ? 'SMTP' : 'PHP Mailer';
$mb_encryption_type      = esc_attr( $unserialized_mail_configuration_data['mailer_type'] ) === 'smtp' ? ' - ' . $mb_encryption : '';
$mb_host_name            = esc_attr( $unserialized_mail_configuration_data['hostname'] );
$mb_port_number          = esc_attr( $unserialized_mail_configuration_data['port'] );
$mb_hostname_port        = esc_attr( $unserialized_mail_configuration_data['mailer_type'] ) === 'smtp' ? ' ' . $mb_host_name . ':' . $mb_port_number : '';
$password_authentication = esc_attr( $unserialized_mail_configuration_data['mailer_type'] ) === 'smtp' ? ' Password ( ' . $mb_authentication . ' ) ' : '';
$mb_authentication       = esc_attr( $unserialized_mail_configuration_data['mailer_type'] ) === 'smtp' ? ' authentication' : '';
$mb_smtp_to              = esc_attr( $unserialized_mail_configuration_data['mailer_type'] ) === 'smtp' ? ' ' . __( 'to', 'wp-mail-bank' ) : '';
$mb_smtp_using           = esc_attr( $unserialized_mail_configuration_data['mailer_type'] ) === 'smtp' ? ' ' . __( 'using', 'wp-mail-bank' ) : '';
?>
<style>
	.mb-dashicons-email:before {
		content: "\f465";
	}
	.mb-statistics-list {
		overflow: hidden;
		margin: 0;
		margin-top: -12px !important;
	}
	.mb-statistics-list li.mb-upgrade-now {
		width: 100%;
		margin-bottom: -10px;
	}
	.mb-emails-not-sent,.mb-emails-sent{
		margin-top:5px !important;
	}
	.mb-statistics-list li a:hover {
		color: #2ea2cc;
	}
	.mb-statistics-list li a {
		display: block;
		color: #aaa;
		padding: 9px 9px;
		-webkit-transition: all ease .5s;
		transition: all ease .5s;
		position: relative;
		font-size: 12px;
	}
	.mb-statistics-list li {
		width: 50%;
		float: left;
		padding: 0;
		box-sizing: border-box;
		margin: 0;
		border-top: 1px solid #ececec;
		color: #aaa;
	}
	.mb-statistics-list li.mb-emails-sent {
		border-right: 1px solid #ececec;
	}
	.mb-statistics-list li a strong {
		font-size: 18px;
		line-height: 1.2em;
		font-weight: 400;
		display: block;
		color: #21759b;
	}
	.mb-statistics-list li.mb-upgrade-now a::before {
		font-family: Dashicons;
		content: "\f132";
	}
	.mb-statistics-list li a::before {
		font-family: WooCommerce;
		speak: none;
		font-weight: 400;
		font-variant: normal;
		text-transform: none;
		line-height: 1;
		-webkit-font-smoothing: antialiased;
		margin: 0;
		text-indent: 0;
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		text-align: center;
		content: "�?";
		font-size: 2em;
		position: relative;
		width: auto;
		line-height: 1.2em;
		color: #464646;
		float: left;
		margin-right: 12px;
		margin-bottom: 12px;
	}
	.mb-statistics-list li.mb-emails-sent a::before {
		font-family: Dashicons;
		content: "\f147";
	}
	.mb-statistics-list li.mb-emails-not-sent a::before {
		font-family: Dashicons;
		content: "\f158";
	}
</style>
<p class="dashicons-before mb-dashicons-email"> <span style="color:green">Mail Bank <?php echo esc_attr( __( 'is configured', 'wp-mail-bank' ) ); ?></span></p>
<p>Mail Bank <?php echo esc_attr( __( 'will send mail through ', 'wp-mail-bank' ) ); ?><b> <?php echo esc_attr( $mb_mailer_type ) . esc_attr( $mb_encryption_type ); ?></b><?php echo esc_attr( $mb_smtp_to ); ?><b><?php echo esc_attr( $mb_hostname_port ); ?></b><?php echo esc_attr( $mb_smtp_using ); ?><b><?php echo esc_attr( $password_authentication ); ?></b><?php echo esc_attr( $mb_authentication ); ?>.</p>
<p><a href="admin.php?page=mb_email_logs"><?php echo esc_attr( __( 'Email Logs', 'wp-mail-bank' ) ); ?></a> | <a href="admin.php?page=mb_email_configuration"><?php echo esc_attr( __( 'Email Configuration', 'wp-mail-bank' ) ); ?></a></p>
<ul class="mb-statistics-list">
	<li class="mb-emails-sent">
		<a href="admin.php?page=mb_email_logs">
			<strong><?php echo esc_attr( $mb_status_sent ); ?> <?php echo esc_attr( __( 'Email Sent', 'wp-mail-bank' ) ); ?></strong>
		</a>
	</li>
	<li class="mb-emails-not-sent">
		<a href="admin.php?page=mb_email_logs">
			<strong><?php echo esc_attr( $mb_status_not_sent ); ?> <?php echo esc_attr( __( 'Email Not Sent', 'wp-mail-bank' ) ); ?></strong>
		</a>
	</li>
	<li class="mb-upgrade-now">
		<a href="http://mail-bank.tech-banker.com/">
			<strong><?php echo esc_attr( __( 'Upgrade Now to Premium Editions' ) ); ?></strong>
		</a>
	</li>
</ul>
