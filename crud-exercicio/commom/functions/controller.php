<?php
include "functions.php";

/*
* Função que retorna algum parâmetro recebido pelo método get ou post. Se não foi recebido nenhum parâmetro,
* retorna o valor padrão, esse que pode ser vazio ou um valor passado.
*/ 
function get_parameter($parameter, $default_value = NULL) {
  if (isset($_POST[$parameter])) {
    return $_POST[$parameter]; 
  }
  if (isset($_GET[$parameter])) {
    return $_GET[$parameter];
  }
  return ($default_value == NULL) ? "" : $default_value;
}

/*
* Função que mostra o visual da página desejada
*/
function view($module_name, $view_name) {
  if ($view_name != NULL) {
    if ($module_name === "users") {
      include "modules/" . $module_name . "/views/" . $view_name . ".php";
    } else {
      include "modules/" . $module_name . "/pages/" . $view_name . ".php";
    }
  }
}

/*
* Função que inclui o arquivo que executa o módulo desejado
*/
function modules ($module_name) {
  if ($module_name != NULL) {
    if ($module_name === "users") {
      include "modules/" . $module_name . "/controller/user_controller.php";
    } else{
      include "modules/" . $module_name . "/execute.php";
    }
  }
}

/*
* Função que redireciona para a página dos respectivos módulo e ação desejados
*/
function redirect($module, $action = NULL) {
  header('Location: index.php?module=' . $module . "&action=" . $action);
}

/*
* Função que executa o módulo e a ação determinado no arquivo de executar
*/
function execute($module, $action = "main") {
  if (empty($module)) {
    echo "Módulo não encontrado.";
    return;
  }

  modules($module);

  if ($module === "users") {
    $className = ucwords($module) . "_Controller";
    $controller = new $className;
  
    $controller->flow($action);
  } else {
    flow($action);
  }
}
?>