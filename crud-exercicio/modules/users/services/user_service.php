<?php
class User_Service {
  // Properties
  public $db_manager;

  // Construtor
  function __construct($db_manager) {
    $this->db_manager = $db_manager;
  }

  // Methods
  function save($user) {
    $users_properties = ["ID", "Email", "Password", "FirstName", "LastName", "CreationDate", "ModifiedDate"];
    $users_values = [$user->id, $user->email, $user->password, $user->first_name, $user->last_name, $user->creation_date, $user->modified_date];

    $this->db_manager->insert_data("users", $users_properties, $users_values);
  }
  
  function update($user) {
    $users_properties = ["Password", "FirstName", "LastName", "ModifiedDate"];
    $users_values = [$user->password, $user->first_name, $user->last_name, $user->modified_date];

    $this->db_manager->update_data("users", $user->id, $users_properties, $users_values);
  }

  function delete($id) {
    $this->db_manager->delete_data("users", $id);
  }

  function verify_exist($email) {
    $users_properties = ["ID"];

    $data = $this->db_manager->select_data_by_property("users", "Email", $email, $users_properties);

    if ($data->num_rows > 0) {
      return true;
    }
    
    // retorna falso se não existe o usuário
    return false;
  }

  function find_by_id($id) {
    $users_properties = ["ID", "Email", "Password", "FirstName", "LastName", "CreationDate", "ModifiedDate"];

    $data = $this->db_manager->select_data_by_property("users", "ID", $id, $users_properties);
  
    if ($data->num_rows > 0) {
      return $data->fetch_assoc();
    }
  
    // retorna null se não existe
    return NULL;
  }

  function verify_data($user) {
    return (!empty($user->email) && !empty($user->password) && !empty($user->first_name) && !empty($user->last_name));
  }
}
?>