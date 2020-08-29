<?php
include "commom/view/template/header.php";
?>

        <?php
        // se houver um erro, é apresentado
        if (isset($request_data["errors"]) && !empty($request_data["errors"])) {
        ?>
            <div class="alert alert-danger"><?php echo $request_data["errors"]; ?></div>
        <?php
            $request_data["errors"] = NULL;
        }
        ?>

        <form method="post" action="index.php">
            <h1>Sign In</h1>
            <input type="hidden" name="module" value="users"/>
            <?php
            if (empty($request_data["user"])) {
            ?>
                <input type="hidden" name="action" value="save"/>
                <input type="hidden" name="id" value="<?php echo md5(uniqid("")); ?>"/>
                <input type="hidden" name="creation_date" value="<?php echo date("Y/m/d h:i:sa"); ?>"/>
                <input type="hidden" name="modified_date" value="<?php echo date("Y/m/d h:i:sa"); ?>"/>
            <?php
            } else {
            ?>
                <input type="hidden" name="action" value="update"/>
                <input type="hidden" name="id" value="<?php echo $request_data["user"]["ID"]; ?>"/>
                <input type="hidden" name="creation_date" value="<?php $request_data["user"]["CreationDate"]; ?>"/>
                <input type="hidden" name="modified_date" value="<?php echo date("Y/m/d h:i:sa"); ?>"/>
            <?php
            }
            ?>
            <div class="form-group">
                <label for="exampleInputEmail2">Email address <span class="required">*</span></label>
                <?php
                // se está adicionando um usuário
                if (empty($request_data["user"])) {
                ?>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail2"
                    aria-describedby="emailHelp" placeholder="Enter email"
                    value="<?php echo get_form_field("email"); ?>"/>
                <?php
                // se está editando
                } else {
                ?>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail2"
                    aria-describedby="emailHelp" placeholder="Enter email"
                    value="<?php echo $request_data["user"]["Email"]; ?>"/>
                <?php
                }
                ?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword2">Password <span class="required">*</span></label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword2"
                placeholder="Password"/>
            </div>
            <div class="form-group">
                <label for="exampleInputFirstName2">First Name <span class="required">*</span></label>
                <?php
                // se está adicionando um usuário
                if (empty($request_data["user"])) {
                ?>
                    <input type="text" name="first_name" class="form-control" id="exampleInputFirstName2"
                    aria-describedby="firstNameHelp" placeholder="Enter first name"
                    value="<?php echo get_form_field("first_name"); ?>"/>
                <?php
                // se está editando
                } else {
                ?>
                    <input type="text" name="first_name" class="form-control" id="exampleInputFirstName2"
                    aria-describedby="firstNameHelp" placeholder="Enter first name"
                    value="<?php echo $request_data["user"]["FirstName"]; ?>"/>
                <?php
                }
                ?>
            </div>
            <div class="form-group">
                <label for="exampleInputLastName2">Last Name <span class="required">*</span></label>
                <?php
                // se está adicionando um usuário
                if (empty($request_data["user"])) {
                ?>
                    <input type="text" name="last_name" class="form-control" id="exampleInputLastName2"
                    aria-describedby="lastNameHelp" placeholder="Enter last name"
                    value="<?php echo get_form_field("last_name"); ?>"/>
                <?php
                // se está editando
                } else {
                ?>
                    <input type="text" name="last_name" class="form-control" id="exampleInputLastName2"
                    aria-describedby="lastNameHelp" placeholder="Enter last name"
                    value="<?php echo $request_data["user"]["LastName"]; ?>"/>
                <?php
                }
                ?>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>

<?php
include "commom/view/template/footer.php";
?>