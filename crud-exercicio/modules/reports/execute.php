<?php
include_once "modules/login/functions.php";

/*
* Função que executa a ação desejada
*/
function flow($action) {
  // se não está logado, volta à pagina de login
  if (!is_logged()) {
    redirect("login");
    return;
  }

  switch ($action) {
    // se está logado, apresenta a página de relatório
    case "questions":
      view("reports", "questions_report_page");
      break;
    
    default:
      view("reports", "reports_page");
      break;
  }
}
?>