<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        session_start();
        if(isset($_POST["account_info"])){
            include("user_forms/account_info_form.php");
                if(isset($_POST["add_balance"])){
                    $input_balance = filter_input(INPUT_POST, "input_balance", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";

                    if(!empty($input_balance) && $input_balance >= 0){
                        
                        if($_SESSION["user"]["debt"] < 0){
                            $_SESSION["user"]["debt"] += $input_balance;
                            if($_SESSION["user"]["debt"] >= 0){
                                $_SESSION["user"]["cashed_in"] += $_SESSION["user"]["debt"];
                                $_SESSION["user"]["debt"] = 0;
                            }

                        }
                        else{
                            $_SESSION["user"]["cashed_in"] += $input_balance;
                        }

                        include("../backends/database/database.php");

                        $query = "
                            UPDATE users
                            SET
                            cashed_in = '{$_SESSION['user']['cashed_in']}',
                            debt = '{$_SESSION['user']['debt']}',
                            total_balance = '{$_SESSION['user']['cashed_in']}'
                            WHERE name = '{$_SESSION['user']['name']}';
                        ";


                        mysqli_query($connection, $query);


                        mysqli_close($connection);
                    }
                    else{
                        echo "Invalid Input";
                    }
                }
            include("user_forms/account_info_table.php");
        }
        elseif(isset($_POST["home"])){
            session_destroy();
            header("Location: index.php");
        }
        elseif(isset($_POST["buy_coffee"])){
            include("user_forms/buy_coffee_form.php");
        }
    }

?>