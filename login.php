<?php
include("./shared/header.php");
?>
<h4><a href="index.php">View Data</a></h4>
    <?php
    include "model/connection.php";
    include "controller/login_control.php";
    ?>
<form class="login-form" method="post">
    <h2>Login</h2>
    <div class="form-group ">

        <input type="text" class="form-input" id="name" name="user" placeholder="User" />
    </div>
    <div class="form-group">

        <input type="password" class="form-input" id="password" name="password" placeholder="Password" />
    </div>


    <button type="submit" class="btn btn-primary" name="btn-login" value="ADD">Submit</button>
</form>