<!doctype html>
<html>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="static/css/bootstrap.min.css">
  <link rel="stylesheet" href="static/css/styles.css">

  <title>Login!</title>
</head>

<body>
  <div class="card">
    <div class="card-body">
      <form method="post" action="index.php">
        <h1>Login</h1>
        <input type="hidden" name="module" value="login" />
        <input type="hidden" name="action" value="do_login" />
        <div id="error-message"></div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
          placeholder="Enter email" />
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" name="password" class="form-control" id="exampleInputPassword1"
          placeholder="Password" />
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" name="remember-check" />
          <label class="form-check-label" for="exampleCheck1">Remember</label>
        </div>
        <button type="button" onclick="do_login()" class="btn btn-primary btn-block">Submit</button>
      </form>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="static/js/bootstrap.min.js"></script>
  <script>
    function do_login() {
      // pegar informações do formulário
      // enviar via AJAX método POST
      // no retorno do AJAX, se for sucesso, redirecionar para home
      // se for erro, apresentar mensagem retornada pela JSON da resposta do servidor
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && (this.status == 400 || this.status == 405)) {
          var data = JSON.parse(this.responseText);
          var error_message = document.getElementById("error-message");
          error_message.classList.add("alert");
          error_message.classList.add("alert-danger");
          error_message.innerHTML = data.message;
        } else if (this.readyState == 4 && this.status == 200) {
          window.location.href = "index.php?module=home&action=";
        }
      };
      var formElement = document.querySelector("form");
      var formData = new FormData(formElement);
      xhttp.open("POST", "index.php?module=login&action=do_login", true);
      xhttp.send(formData);
    }
  </script>
</body>

</html>