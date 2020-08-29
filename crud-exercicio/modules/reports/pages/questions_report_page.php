<?php
include "commom/view/template/header.php";
include "commom/functions/dBfunctions.php";
include "modules/users/functions.php";

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

// header da tabela
$header = ["Nome", "Quantidade de Questões"];;

// propriedades dos usuários
$questions_properties = ["Author"];

// propriedade a ser agrupada
$grouped_by = "Author";

// conteúdo da tabela
$data = select_counted_data($conn, "questions", $questions_properties, "", $grouped_by);

// escreve a tabela
$table = "<table class=\"table\"><tr>";
// header
for ($x = 0; $x < sizeof($header); $x++) {
  $table = $table . "<th>" . $header[$x] . "</th>";
}
$table = $table . "</tr>";
// conteúdo
if ($data->num_rows > 0) {
  while($row = $data->fetch_assoc()) {
    $user = find_user_by_id($row["Author"]);
    $table = $table . "<tr><td>" . $user["FirstName"] . " " . $user["LastName"]. "</td>";
    $table = $table . "<td>" . $row["Count" . $grouped_by] . "</td></tr>";
  }
}
$table = $table . "</table>";

// mostra a tabela
echo $table;

$conn->close();

include "commom/view/template/footer.php";
?>