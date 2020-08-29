<?php
include "functions.php";
// cria
/*
* Função que executa a ação desejada
*/
function flow($action) {
  switch ($action) {
    case 'do_login':
      if (!is_logged()) {
        session_unset();
        if (!is_valid_request()) {
          // se não está logado e não foi feita uma requisição de login, vai para a tela de login
          view_JSON(405, array("message" => "Requisição inválida."));
        } else {
          if (!verify_data_login()) {
            // se foi feita uma requisição inválida de login, volta para a tela de login com uma mensagem de erro
            view_JSON(400, array("message" => "Os dados informados são inválidos."));
          } else {
            // se foi feita uma requisição válida de login, faz o login e vai para a tela inicial
            login();
            if (is_logged()) {
              view_JSON(200, array());
            } else {
              view_JSON(400, array("message" => "Os dados informados são inválidos."));
            }
          }
        }
      } else {
        // se estava logado e requisitou que mantivesse, vai para a tela inicial
        redirect("home");
      }
      break;

    // quando se abre a página por uma nova guia, a ação padrão é vazia
    default:
      if (!is_logged()) {
        // se não está logado, vai para a tela de login
        session_unset();
        view("login", "login_form");
      } else if (!remind_login()) {
        // se não está logado, vai para a tela de login
        session_unset();
        view("login", "login_form");
      } else {
        // se estava logado e requisitou que mantivesse, vai para a tela inicial
        redirect("home");
      }
      break;
  }
}
?>