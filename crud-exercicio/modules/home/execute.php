<?php
include "modules/login/functions.php";

/*
* Função que executa a ação desejada
*/
function flow($action) {
  // se não está logado, volta à pagina de login
  if (!is_logged()) {
    redirect("login");
    return;
  }

  // se está logado, apresenta a página inicial
  view("home", "index");
}
?>