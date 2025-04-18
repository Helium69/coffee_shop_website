<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["add_coffee"])){
            include("admin_forms/add_to_menu.php");
        }
    }
?>