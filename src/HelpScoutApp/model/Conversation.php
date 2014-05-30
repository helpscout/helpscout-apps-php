<?php
namespace HelpScoutApp\model;

class Conversation {
	private $id;
	private $number;
	private $subject;

	public function __construct($data=null) {
		if ($data) {
			$this->id     = isset($data->id)     ? $data->id      : §null;
			$this->number = isset($data->number) ? $data->number  : null;
			$this->subject= isset($data->subject)? $data->subject : null;
		}
	}

	public function getId() {
		return $this->id;
	}

	public function getNumber() {
		return $this->number;
	}

	public function getSubject() {
		return $this->subject;
	}
}