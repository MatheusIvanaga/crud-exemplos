<?php
include_once "modules/users/services/user_service.php";

/*
* Função que escreve as perguntas salvas na tela
*/
function write_questions() {
  $users_properties = ["ID", "Author", "Text", "CreationDate", "ModifiedDate"];

  $db_manager = new DB_Manager();
  $user = new User_Service($db_manager);
  $data = $user->db_manager->select_data("questions", $users_properties);

  $all_questions = "";

  // escreve as questões
  if ($data->num_rows > 0) {
    while($row = $data->fetch_assoc()) {
      $user_row = $user->find_by_id($row["Author"]);

      $questions = "<div class=\"card\"><div class=\"card-body\"><div class=\"media\"><div class=\"media-body\">";
      $questions = $questions . "<h5 class=\"mt-0\">" . $user_row["FirstName"] . " " . $user_row["LastName"] .
      "</h5>";
      $questions = $questions . "<p>" . $row["Text"] . "<p>";
      $questions = $questions . "<p>" . $row["CreationDate"] . "<p>";
      $questions = $questions . "</div></div></div></div>";

      $all_questions = $questions . $all_questions;
    }
  }

  // mostra a tabela
  echo $all_questions;
}

// pega o usuário logado atualmente
$db_manager = new DB_Manager();
$user = new User_Service($db_manager);
$user_now = $user->find_by_id($_SESSION["id"]);

/*
* Função que verifica se a nova solicitação é válida
*/
function verify_data_question() {
  return !empty($_POST["question"]);
}

/*
* Função que adiciona a nova solicitação no arquivo
*/
function add_question_file($text) {
  $user = new User();
  $user_now = $user->user_service->find_by_id($_SESSION["id"]);

  $creation_date = date("d-m-Y");
  $users_properties = ["ID", "Author", "Text", "CreationDate", "ModifiedDate"];
  $users_values = [md5(uniqid("")), $user_now["ID"], $text, $creation_date, ""];

  $user->user_service->db_manager->insert_data("questions", $users_properties, $users_values);

  return $creation_date;
}
?>