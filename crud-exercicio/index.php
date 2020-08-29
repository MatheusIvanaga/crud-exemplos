<?php
include "commom/functions/controller.php";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exercicio_php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// variáveis globais
$request_data = array();

// Recupera os parâmetros de módulo e ação mandados no último evento. Se é o primeiro acesso à página,
// os parâmetros mandados são vazios e a função retorna valores padrões ("login" para o módulo e "" para
// a ação).
$module = get_parameter("module", "login");
$action = get_parameter("action");

// Adiciona o módulo correspondente e faz a devida ação.
execute($module, $action);

$conn->close();
?>