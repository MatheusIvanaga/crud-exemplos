<?php
include "modules/users/models/user.php";
include "modules/users/services/user_service.php";
include "commom/db_manager.php";
include "modules/login/functions.php";

class Users_Controller {
  public $user_service;

  // Construtor
  function __construct() {
    $db_manager = new DB_Manager();
    $this->user_service = new User_Service($db_manager);
  }

  /*
  * Função que executa a ação desejada
  */
  function flow($action) {
    global $request_data;

    // se não está logado, volta para a tela de login
    if (!is_logged()) {
      redirect("login");
      return;
    }

    $user = new User();

    switch ($action) {
      // se clicou para adicionar um usuário
      case "add":
        $request_data["user"] = array();
        view("users", "users_form");
        break;
      
      // se clicou para editar um usuário
      case "edit":
        $request_data["user"] = $this->user_service->find_by_id(get_parameter("id"));
        view("users", "users_form");
        break;

      // se submeteu um cadastro para adicionar
      case "save":
        set_object_vars($user, $_POST);
        // se não foram preechidos todos os campos ou o usuário já existe, mostra um erro e volta para o formulário
        if (!$this->user_service->verify_data($user)) {
          $request_data["errors"] = "Preencha todos os campos obrigatórios.";
          view("users", "users_form");
        } else if ($this->user_service->verify_exist($user->email)) {
          $request_data["errors"] = "O e-mail já está sendo usado por outro usuário.";
          view("users", "users_form");
        // se não, é cadastrado
        } else {
          $this->user_service->save($user);
          set_flash_parameter("message", "Usuário adicionado com sucesso.");
          redirect("users");
        }
        break;

      // se submeteu um cadastro para editar
      case "update":
        $request_data["user"] = $this->user_service->find_by_id(get_parameter("id"));
        set_object_vars($user, $_POST);
        // se não foram preechidos todos os campos ou o e-mail foi mudado, mostra um erro e volta para o formulário
        if (!$this->user_service->verify_data($user)) {
          $request_data["errors"] = "Preencha todos os campos obrigatórios.";
          view("users", "users_form");
        } else if ($request_data["user"]["Email"] !== $_POST["email"]) {
          $request_data["errors"] = "Não altere o e-mail do usuário.";
          view("users", "users_form");
        // se não, é editado
        } else {
          $this->user_service->update($user);
          set_flash_parameter("message", "Usuário editado com sucesso.");
          redirect("users");
        }
        break;
      
      // se clicou pra deletar usuário
      case "delete":
        set_object_vars($user, $_GET);
        $this->user_service->delete($user->id);
        set_flash_parameter("message", "Usuário removido com sucesso.");
        redirect("users");
        break;

      // se clicou no botão de usuários ou concluiu um cadastro, entra na tela de usuários
      default:
        // apresenta a página de usuários
        $request_data["message"] = get_flash_parameter("message");
        clear_flash_parameter();
        view("users", "users_page");
        break;
    }
  }
}
?>