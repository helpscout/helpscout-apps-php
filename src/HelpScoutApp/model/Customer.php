<?php
namespace HelpScoutApp\model;

class Customer {
	private $id;
	private $fname;
	private $lname;
	private $email;
	private $emails;

	public function __construct($data=null) {
		if ($data) {
			$this->id    = isset($data->id)    ? $data->id    : null;
			$this->fname = isset($data->fname) ? $data->fname : null;
			$this->lname = isset($data->lname) ? $data->lname : null;
			$this->email = isset($data->email) ? $data->email : null;
			$this->emails= isset($data->emails)? $data->emails: null;
		}
	}

	public function getId() {
		return $this->id;
	}

	public function getFirstName() {
		return $this->fname;
	}

	public function getLastName() {
		return $this->lname;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getEmails() {
		return $this->emails;
	}
}