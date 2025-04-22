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
            include("../backends/database/database.php");

            $query = "SELECT * FROM coffee_price";
            $query_addons = "SELECT * FROM add_ons_price";
            $result = mysqli_query($connection, $query);
            $result_addons = mysqli_query($connection, $query_addons);

            if(mysqli_num_rows($result) > 0){

                $add_ons = [];

                if(mysqli_num_rows($result_addons) > 0){
                    while($row = mysqli_fetch_assoc($result_addons)){
                        $name = $row["name"];
                        $price = $row["price"];

                        $add_ons[$name] = $price; 
                    }
                }








                $coffee_list = [];
            
                while($row = mysqli_fetch_assoc($result)){
                    $name = $row["name"];
                    $price = $row["price"];
                    $size = $row["size"];
            
                    $coffee_list[$name][$size] = $price; 
                }

                include("user_forms/buy_coffee_form.php");


                if(isset($_POST["select_coffee"])){
                    
                    if(isset($_POST["save"])){
                        $_SESSION["selected_coffee"] = $_POST["coffee"];
                    }
                    include("user_forms/final_buy_coffee_form.php");
                    if(isset($_POST["submit_order"])){
                        $size = $_POST["size"];
                        $quantity = $_POST["quantity"];

                        $total_payment = $coffee_list[$_SESSION["selected_coffee"]][$size] * $quantity;


                        if($_SESSION["user"]["debt"] >= 0){
                            $new_balance = $_SESSION["user"]["cashed_in"] - $total_payment;

                            if($new_balance >= 0){
                                $_SESSION["user"]["cashed_in"] = $new_balance;
                                $_SESSION["user"]["total_balance"] = $new_balance;
                            }
                            else{
                                $_SESSION["user"]["cashed_in"] = 0;
                                $_SESSION["user"]["debt"] = $new_balance;
                                $_SESSION["user"]["total_balance"] = $new_balance;
                            }

                        }
                        else{
                            if($_SESSION["user"]["debt"] <= -999.99){
                                echo "Too much debt";
                            }
                            else{
                                $debt = $_SESSION["user"]["debt"];
                                $new_balance = $debt += -$total_payment;

                                if($new_balance < -999.99){
                                    echo "Too much debt";
                                }
                                else{
                                    $_SESSION["user"]["debt"] = $new_balance;
                                    $_SESSION["user"]["total_balance"] = $new_balance;
                                }
                            }
                        }
                    }
                }
            }
            
            else{

            }

            


            mysqli_close($connection);
        }
    }

?>