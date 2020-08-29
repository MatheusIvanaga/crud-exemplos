<?php
class User {
  // Properties
  public $id;
  public $email;
  public $password;
  public $first_name;
  public $last_name;
  public $creation_date;
  public $modified_date;

  // Methods
  function set_id($id) {
    $this->id = $id;
  }
  function get_id() {
    return $this->id;
  }

  function set_email($email) {
    $this->email = $email;
  }
  function get_email() {
    return $this->email;
  }

  function set_password($password) {
    $this->password = $password;
  }
  function get_password() {
    return $this->password;
  }

  function set_first_name($first_name) {
    $this->first_name = $first_name;
  }
  function get_first_name() {
    return $this->first_name;
  }

  function set_last_name($last_name) {
    $this->last_name = $last_name;
  }
  function get_last_name() {
    return $this->last_name;
  }

  function set_creation_date($creation_date) {
    $this->creation_date = $creation_date;
  }
  function get_creation_date() {
    return $this->creation_date;
  }

  function set_modified_date($modified_date) {
    $this->modified_date = $modified_date;
  }
  function get_modified_date() {
    return $this->modified_date;
  }
}
?>