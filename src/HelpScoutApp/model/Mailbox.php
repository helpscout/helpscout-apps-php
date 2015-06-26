<?php
namespace HelpScoutApp\model;

class Mailbox {

    private $id;
    private $email;

    public function __construct($data = null) {
        if ($data) {
            $this->id    = isset($data->id)   ? $data->id   : null;
            $this->email = isset($data->email) ? $data->email : null;
        }
    }

    /**
     * @return int The ID of the Mailbox
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string|null The Mailbox email
     */
    public function getEmail() {
        return $this->email;
    }

}
