<?php
include "commom/view/template/header.php";

// header da tabela
$header = ["Email", "First Name", "Last Name", "Creation Date", "Modified Date", "Edit | Remove"];

// propriedades dos usuários
$users_properties = ["ID", "Email", "Password", "FirstName", "LastName", "CreationDate", "ModifiedDate"];

// Banco de dados
$db_manager = new DB_Manager();

// conteúdo da tabela
$data = $db_manager->select_data("users", $users_properties);

if (isset($request_data["message"]) && !empty($request_data["message"])) {
  echo "<div class=\"alert alert-success\">" . $request_data["message"] . "</div>";
}

// escreve a tabela
$table = "<table class=\"table\"><tr>";
// header
for ($x = 0; $x < count($header); $x++) {
  $table = $table . "<th>" . $header[$x] . "</th>";
}
$table = $table . "</tr>";
// conteúdo
if ($data->num_rows > 0) {
  while($row = $data->fetch_assoc()) {
    $table = $table . "<tr><td>" . $row["Email"] . "</td>";
    $table = $table . "<td>" . $row["FirstName"] . "</td>";
    $table = $table . "<td>" . $row["LastName"] . "</td>";
    $table = $table . "<td>" . $row["CreationDate"] . "</td>";
    $table = $table . "<td>" . $row["ModifiedDate"] . "</td>";
    $table = $table . "<td><a class=\"nav-link\" href=\"index.php?module=users&action=edit&id=" . $row["ID"] . "\">Edit</a>|";
    $table = $table . "<a class=\"nav-link\" href=\"index.php?module=users&action=delete&id=" . $row["ID"] . "\">Delete</a></td></tr>";
  }
}
$table = $table . "</table>";

// mostra a tabela
echo $table;
?>

        <a class="btn btn-primary btn-block" href="index.php?module=users&action=add">Add New User</a>

<?php
include "commom/view/template/footer.php";
?>