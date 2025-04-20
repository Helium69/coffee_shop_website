<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["account_info"])){
            include("user_forms/account_info_form.php");

            include("user_forms/account_info_table.php");
        }
        elseif(isset($_POST["home"])){
            session_destroy();
            header("Location: index.php");
        }
    }

?>