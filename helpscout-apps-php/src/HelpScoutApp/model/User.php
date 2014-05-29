<?php
namespace HelpScoutApp\model;

class User {
	const ROLE_USER  = 3;
	const ROLE_ADMIN = 2;
	const ROLE_OWNER = 1;

	private $id;
	private $fname;
	private $lame;
	private $role;

	public function __construct($data=null) {
		if ($data) {
			$this->id    = isset($data->id)    ? $data->id    : null;
			$this->fname = isset($data->fname) ? $data->fname : null;
			$this->lname = isset($data->lname) ? $data->lname : null;
			$this->role  = isset($data->role)  ? intval($data->role): null;
		}
	}

	public function getId() {
		return $this->id;
	}

	public function getFname() {
		return $this->fname;
	}

	public function getLame() {
		return $this->lame;
	}

	public function getRole() {
		return $this->role;
	}

	public function isOwnerOrAdmin() {
		return in_array($this->role, array(self::ROLE_OWNER, self::ROLE_ADMIN));
	}

	public function isOwner() {
		return $this->role == self::ROLE_OWNER;
	}
	public function isAdmin() {
		return $this->role == self::ROLE_ADMIN;
	}
}