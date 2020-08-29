<?php
/*
* Função que verifica se o usuário está logado
*/
function is_logged() {
  return !empty($_SESSION);
}

/*
* Função que verifica se o usuário quis permanecer logado após encerrar a última sessão
*/
function remind_login() {
  return !empty($_SESSION["remember-check"]);
}

/*
* Função que realiza o login do usuário
*/
function login() {
  if (verify_user_login()) {
    $data = read_file("users.json");
    for ($x = 0; $x < count($data); $x++) {
      if (($_POST["email"]) === $data[$x]["email"] && $_POST["password"] === $data[$x]["password"]) {
        $_SESSION["id"] = $data[$x]["id"];
      }
    }

    $_SESSION["email"] = test_input($_POST["email"]);
    $_SESSION["password"] = test_input($_POST["password"]);
    if (!empty($_POST["remember-check"])) {
      $_SESSION["remember-check"] = $_POST["remember-check"];
    }
  }
}

/*
* Função que verifica se o usuário submetido existe
*/
function verify_user_login() {
  // recupera os usuários cadastrados
  $data = read_file("users.json");
  
  // verifica se o usuário tentado está cadastrado
  for ($x = 0; $x < count($data); $x++) {
    if (($_POST["email"]) === $data[$x]["email"] && $_POST["password"] === $data[$x]["password"]) {
      // retorna verdadeiro se o usuário existe
      return true;
    }
  }
  
  // retorna falso se não existe o usuário
  return false;
}

/*
* Função que verifica se a solicitação foi válida
*/
function verify_data_login() {
  return (!empty($_POST["email"]) && !empty($_POST["password"]));
}
?>