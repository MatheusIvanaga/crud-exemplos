<?php
include "commom/view/template/header.php";
include "commom/db_manager.php";
include "modules/questions/functions.php";
?>

<h1>Home</h1>

<div class="container-fluid">

  <div class="row">

    <div class="col-sm-3 border-right">
      One of three columns
    </div>

    <div class="col-sm-6">

      <div class="row">

        <div class="col-12">

          <div id="question-box" class="border-bottom shadow-sm mb-10">
            
            <div id="error-message"></div>

            <h2>Qual é a sua dúvida?</h2>

            <form id="frm-qst" method="post" action="index.php" name="form-question">
              <div class="form-group">
                <textarea class="form-control" name="question"></textarea>
              </div>
              <button type="button" onclick="do_new_question()" class="btn btn-primary">Enviar</button>
            </form>

          </div>

        </div>

      </div>

      <div class="row">

        <div class="col-12" id="answers"><!--id, texto, criaç, modif, autor-->

          <?php
          write_questions();
          ?>

          <!--
          <div class="card">

            <div class="card-body">

              <div class="media">

                <img src="..." class="mr-3" alt="...">

                <div class="media-body">
                  <h5 class="mt-0">Media heading</h5>
                  <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                </div>

              </div>

            </div>

          </div>
          -->

        </div>

      </div>

    </div>

    <div class="col-sm-3 border-left">
      One of three columns
    </div>

  </div>

</div>

<script>
  function do_new_question() {
    var xhttp = new XMLHttpRequest();
    var error_message = document.getElementById("error-message");
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && (this.status == 400 || this.status == 500)) {
        var data = this.responseText;
        data = JSON.parse(data.substring(data.indexOf("{")));
        error_message.classList.add("alert");
        error_message.classList.add("alert-danger");
        error_message.innerHTML = data.message;
      } else if (this.readyState == 4 && this.status == 200) {
        error_message.classList.remove("alert");
        error_message.classList.remove("alert-danger");
        error_message.innerHTML = "";
        var data = this.responseText;
        data = JSON.parse(data.substring(data.indexOf("{")));
        write_new_question(data.creation_date);
      }
    };
    var formElement = document.getElementById("frm-qst");//document.querySelector("form");
    var formData = new FormData(formElement);
    xhttp.open("POST", "index.php?module=questions&action=do_new_question", true);
    xhttp.send(formData);
  }

  function write_new_question(data) {
    let form = document.getElementById("frm-qst");
    let ans = document.getElementById("answers");

    let card = document.createElement("div");
    ans.insertBefore(card, ans.childNodes[0]);
    card.classList.add("card");

    let card_body = document.createElement("div");
    card.appendChild(card_body);
    card_body.classList.add("card-body");

    let media = document.createElement("div");
    card_body.appendChild(media);
    media.classList.add("media");

    let media_body = document.createElement("div");
    media.appendChild(media_body);
    media_body.classList.add("media-body");

    let user = document.createElement("h5");
    user.appendChild(document.createTextNode(<?php echo json_encode($user["FirstName"] . " " .
    $user["LastName"]); ?>));
    media_body.appendChild(user);
    user.classList.add("mt-0");

    let quest = document.createElement("p");
    quest.appendChild(document.createTextNode(form.question.value));
    media_body.appendChild(quest);

    let date = document.createElement("p");
    date.appendChild(document.createTextNode(data));
    media_body.appendChild(date);

    form.question.value = "";
  }
</script>

<?php
include "commom/view/template/footer.php";
?>