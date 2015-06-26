<?php
namespace HelpScoutApp;

use HelpScoutApp\model\Customer;
use HelpScoutApp\model\Conversation;
use HelpScoutApp\model\User;
use HelpScoutApp\model\Mailbox;

require_once 'ClassLoader.php';

class DynamicApp {
	const NAMESPACE_SEPARATOR = '\\';

	private $secretKey = false;
	private $input     = false;

	/** @var \HelpScoutApp\model\Customer */
	private $customer = false;

	/** @var \HelpScoutApp\model\Conversation */
	private $convo = false;

	/** @var \HelpScoutApp\model\User */
	private $user = false;

    /** @var \HelpScoutApp\model\Mailbox */
    private $mailbox = false;

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
				if (isset($data->customer)) {
					$this->customer = new Customer($data->customer);
				}
				if (isset($data->ticket)) {
					$this->convo = new Conversation($data->ticket);
				}
				if (isset($data->user)) {
					$this->user = new User($data->user);
				}
                if (isset($data->mailbox)) {
                    $this->mailbox = new Mailbox($data->mailbox);
                }
			}
			unset($data);
			$this->input = null;
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
	 * @return \HelpScoutApp\model\Conversation
	 */
	public function getConversation() {
		$this->initData();
		return $this->convo;
	}

	/**
	 * @return \HelpScoutApp\model\User
	 */
	public function getUser() {
		$this->initData();
		return $this->user;
	}

    /**
     * @return \HelpScoutApp\model\Mailbox
     */
    public function getMailbox() {
        $this->initData();
        return $this->mailbox;
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

	/**
	 * @return array
	 */
	private function getHelpScoutData() {
		$this->getJsonString(); //ensure data has been loaded from input
		return json_decode($this->input);
	}

	/**
	 * Pass either an array that will be flattened to a string, or a string of HTML.
	 *
	 * @param mixed $html
	 * @return string
	 */
	public function getResponse($html) {
		if (is_array($html)) {
			$html = implode('', $html);
		}
		return json_encode(array('html' => $html));
	}
}
