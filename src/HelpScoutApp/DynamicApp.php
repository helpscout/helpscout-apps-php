<?php
namespace HelpScoutApp;

use HelpScoutApp\model\Customer;
use HelpScoutApp\model\Ticket;
use HelpScoutApp\model\User;

require_once '../helpscout-apps-php/src/HelpScoutApp/ClassLoader.php';

class DynamicApp {
	const NAMESPACE_SEPARATOR = '\\';

	private $secretKey = false;
	private $input     = false;

	/** @var \HelpScoutApp\model\Customer */
	private $customer = false;

	/** @var \HelpScoutApp\model\Ticket */
	private $ticket = false;

	/** @var \HelpScoutApp\model\User */
	private $user = false;

	public function __construct($key) {
		ClassLoader::register();
		$this->secretKey = $key;
	}

	private function getHeader($header) {
		if (isset($_SERVER[$header])) {
			return $_SERVER[$header];
		}
		return false;
	}

	private function getJsonString() {
		if ($this->input === false) {
			$this->input = @file_get_contents('php://input');
		}
		return $this->input;
	}

	private function generateSignature() {
		$str = $this->getJsonString();
		if ($str) {
			return base64_encode(hash_hmac('sha1', $str, $this->secretKey, true));
		}
		return false;
	}

	private function initData() {
		if ($this->customer === false) {
			$data = $this->getHelpScoutData();
			if ($data) {
				if (isset($data['customer'])) {
					$this->customer = new Customer($data['customer']);
				}
				if (isset($data['ticket'])) {
					$this->ticket = new Ticket($data['ticket']);
				}
				if (isset($data['user'])) {
					$this->user = new User($data['user']);
				}
			}
		}
	}

	/**
	 * @return \HelpScoutApp\model\Customer
	 */
	public function getCustomer() {
		$this->initData();
		return $this->customer;
	}

	/**
	 * @return \HelpScoutApp\model\Ticket
	 */
	public function getTicket() {
		$this->initData();
		return $this->ticket;
	}

	/**
	 * @return \HelpScoutApp\model\User
	 */
	public function getUser() {
		$this->initData();
		return $this->user;
	}

	/**
	 * Returns true if the current request is a valid webhook issued from Help Scout, false otherwise.
	 * @return boolean
	 */
	public function isSignatureValid() {
		$signature = $this->generateSignature();
		if ($signature) {
			return $signature === $this->getHeader('HTTP_X_HELPSCOUT_SIGNATURE');
		}
		return false;
	}

	private function getHelpScoutData() {
		$this->getJsonString(); //ensure data has been loaded from input
		return json_decode($this->input, true);
	}

	public function getResponse($html) {
		return json_encode(array('html' => $html));
	}
}