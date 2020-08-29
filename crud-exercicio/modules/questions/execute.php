<?php
include "commom/functions/dBfunctions.php";
include "functions.php";

function flow($action) {
  switch ($action) {
    case 'do_new_question':
      if (!verify_data_question()) {
        view_JSON(400, array("message" => "O campo de dúvida não pode estar vazio."));
      } else {
        $date = add_question_file($_POST["question"]);
        view_JSON(200, array("creation_date" => $date));
      }
      break;
  }
}
?>