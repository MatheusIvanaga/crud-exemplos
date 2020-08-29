<?php
class DB_Manager {
  // Methods
  function open_connection() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "exercicio_php";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }

    return $conn;
  }

  function close_connection($conn) {
    $conn->close();
  }

  function create_table($table_name, $data_properties) {
    $conn = $this->open_connection();

    $sql = "CREATE TABLE " . $table_name . " (";
    for ($x = 0; $x < count($data_properties) - 1; $x++) {
      $sql = $sql . $data_properties[$x] . " VARCHAR(255) DEFAULT NULL, ";
    }
    $sql = $sql . $data_properties[count($data_properties) - 1] . " VARCHAR(255) DEFAULT NULL)";
  
    $result = $conn->query($sql);

    $this->close_connection($conn);

    return $result;
  }
  
  function insert_data($table_name, $data_properties, $data_values) {
    $conn = $this->open_connection();

    $sql = "INSERT INTO " . $table_name . " (";
    for ($x = 0; $x < count($data_properties) - 1; $x++) {
      $sql = $sql . $data_properties[$x] . ", ";
    }
    $sql = $sql . $data_properties[count($data_properties) - 1] . ") VALUES ('";
  
    for ($x = 0; $x < count($data_values) - 1; $x++) {
      $sql = $sql . $data_values[$x] . "', '";
    }
    $sql = $sql . $data_values[count($data_values) - 1] . "')";
  
    $result = $conn->query($sql);

    $this->close_connection($conn);

    return $result;
  }
  
  function update_data($table_name, $id, $data_properties, $data_values) {
    $conn = $this->open_connection();

    $sql = "UPDATE " . $table_name . " SET ";
    for ($x = 0; $x < count($data_properties) - 1; $x++) {
      $sql = $sql . $data_properties[$x] . " = '" . $data_values[$x] . "', ";
    }
    $sql = $sql . $data_properties[count($data_properties) - 1] . " = '" . $data_values[count($data_properties) - 1] . "'";
    $sql = $sql . " WHERE ID='" . $id . "'";

    $result = $conn->query($sql);

    $this->close_connection($conn);

    return $result;
  }
  
  function delete_data($table_name, $id) {
    $conn = $this->open_connection();

    $sql = "DELETE FROM " . $table_name . " WHERE ID='" . $id . "'";
  
    $result = $conn->query($sql);

    $this->close_connection($conn);

    return $result;
  }

  function select_data($table_name, $data_properties) {
    $conn = $this->open_connection();
        
    $sql = "SELECT ";
    for ($x = 0; $x < count($data_properties) - 1; $x++) {
      $sql = $sql . $data_properties[$x] . ", ";
    }
    $sql = $sql . $data_properties[count($data_properties) - 1] . " FROM " . $table_name;
      
    $result = $conn->query($sql);
        
    $this->close_connection($conn);
      
    if ($result->num_rows > 0) {
      return $result;
    } else {
      return NULL;
    }
  }

  function select_data_by_property($table_name, $property, $value, $data_properties) {
    $conn = $this->open_connection();

    $sql = "SELECT ";
    for ($x = 0; $x < count($data_properties) - 1; $x++) {
      $sql = $sql . $data_properties[$x] . ", ";
    }
    $sql = $sql . $data_properties[count($data_properties) - 1] . " FROM " . $table_name . " WHERE " . $property . "='" . $value . "'";
    
    $result = $conn->query($sql);

    $this->close_connection($conn);
  
    if ($result->num_rows > 0) {
      return $result;
    } else {
      return NULL;
    }
  }
  
  function select_counted_data($table_name, $data_properties, $property_counted, $grouped_by) {
    $conn = $this->open_connection();

    $sql = "SELECT ";
    for ($x = 0; $x < count($data_properties); $x++) {
      $sql = $sql . $data_properties[$x] . ", ";
    }
    $sql = $sql . " COUNT(";
    if ($property_counted === "") {
      $sql = $sql . "*) AS Count" . $grouped_by;
    } else {
      for ($x = 0; $x < count($property_counted) - 1; $x++) {
        $sql = $sql. $property_counted[$x] . ") AS Count" . $grouped_by . ", ";
      }
      $sql = $sql . $property_counted[count($property_counted) - 1] . ") AS Count" . $grouped_by;
    }
    $sql = $sql . " FROM " . $table_name . " GROUP BY " . $grouped_by . " ORDER BY Count" . $grouped_by . " DESC";

    $result = $conn->query($sql);

    $this->close_connection($conn);
  
    if ($result->num_rows > 0) {
      return $result;
    } else {
      return NULL;
    }
  }
}