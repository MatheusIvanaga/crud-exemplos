<?php
session_start();

/*
* Função que verifica se houve uma solicitação
*/
function is_valid_request() {
  return (!empty($_POST));
}

/*
* Função que elimina caracteres especiais da submissão, para evitar maus usos
*/
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

/*
* Função que retorna o preenchimento de um campo do formulário na última submissão
*/
function get_form_field($name) {
  if (is_valid_request()) {
    return $_POST[$name];
  }
  return "";
}

/*
* Função que retorna o conteúdo de um arquivo em um array
*/
function read_file($file) {
  // pega conteúdo no arquivo json
  $data = file_get_contents($file);
  $data = trim($data);
  // se está vazio
  if (empty($data)) {
    // recebe um array vazio
    $data = [];
  } else {
    // recebe um array de objetos
    $data = json_decode($data, true);
  }

  return $data;
}

/*
* Função que escreve um conteúdo atualizado em um arquivo
*/
function write_file($file, $data) {
  if ($data === NULL || count($data) === 0) {
    $data = [];
  }
  // transforma os dados em formato json
  $myJSON = json_encode($data);

  // abre, escreve e fecha o arquivo
  $myfile = fopen($file, "w") or die("Unable to open file!");
  fwrite($myfile, $myJSON);
  fclose($myfile);
}

/*
* Função que seta um parâmetro flash à sessão
*/
function set_flash_parameter($key, $value) {
  $_SESSION["flash_" . $key] = $value;
}

/*
* Função que retorna um parâmetro flash da sessão
*/
function get_flash_parameter($key) {
  if (isset($_SESSION["flash_" . $key])) {
    $value = $_SESSION["flash_" . $key];
    unset($_SESSION["flash_" . $key]);
    return $value;
  }
  return NULL;
}

/*
* Função que limpa os parâmetros flash da sessão
*/
function clear_flash_parameter() {
  foreach ($_SESSION as $key => $value) {
    if (substr($key, 0, 6) === "flash_") {
      unset($_SESSION[$key]);
    }
  }
}

function set_object_vars($object, $vars) {
  $has = get_object_vars($object);
  foreach ($has as $name => $oldValue) {
    $object->$name = isset($vars[$name]) ? $vars[$name] : NULL;
  }
}
?>