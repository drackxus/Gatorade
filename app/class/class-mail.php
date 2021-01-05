<?php

// Use mailgun namespace.
use Mailgun\Mailgun;

 /*
 * @Archivo: class-mail.php
 * @Descripcion: Clase para enviar mail con mailgun
 *
 */

class App_Mail {

	/**
	 * API key.
	 */
	protected $api_key;

	/**
	 * Domain.
	 */
	protected $domain;

	/**
	 * Client.
	 */
	protected $client;

	/**
	 * Mail data.
	 */
	var $data = array();

	/**
	 * Constructor.
	 */
	function __construct( $data = array() ) {

		// Set attributes.
		$this->api_key = 'c1b899665d88715c033256fc31f08e12-7caa9475-52d9fcf0';
		$this->api_base_url = 'https://api.mailgun.net/v3/mailgun.zocodigital.com';
		$this->domain = 'mailgun.zocodigital.com';

		// Set data.
		$this->data = $data;
	}

	/**
	 * Constructor wrapper.
	 */
	public static function make( $data ) {
		return new self( $data );
	}


	/**
	 * Actually send the email.
	 * @return
	 */
	function send() {

		// First, instantiate the SDK with your API credentials
		$mg = Mailgun::create($this->api_key); // For US servers
		$mg = Mailgun::create($this->api_key, $this->api_base_url); // For EU servers

		// Now, compose and send your message.
		$result = $mg->messages()->send(
			$this->domain,
			$this->data
		);

		return $result;

	}

}

?>
