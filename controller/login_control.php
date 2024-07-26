<?php
require "model/connection.php";
session_start();
if (!empty($_POST["btn-login"])) {
    if (!empty($_POST["user"]) and !empty($_POST["password"])) {
        $user = $_POST["user"];
        $password = $_POST["password"];
        $sql = $connection->query("select * from login where user='$user' and password= '$password'");
        if($data=$sql->fetch_object()){
            $_SESSION["user"]=$data->user;
            header("location:crud.php");
        }else{
            echo("<div class='alert alert-danger m=0'>Access denied</div>");
        }
    } else {
        echo ("<div class='alert alert-danger m=0'>User and Password must be submitted</div>");
    }
}
