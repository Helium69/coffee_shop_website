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
                                $_SESSION["user"]["total_balance"] = $_SESSION["user"]["cashed_in"];

                            }

                        }
                        else{
                            $_SESSION["user"]["cashed_in"] += $input_balance;
                            $_SESSION["user"]["total_balance"] = $_SESSION["user"]["cashed_in"];
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
        elseif(isset($_POST["coffee_review"])){

            //unfinished and messy code - finish ts cuh :(
            
            include("../backends/database/database.php");

            include("user_forms/comment_or_write.php");

            if(isset($_POST["btn_goto_view"])){
                $query = "SELECT DISTINCT name FROM coffee_price";
                $result = mysqli_query($connection, $query);

                $coffee_list = [];
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $coffee_list[] = $row;
                    }
                }
                include("user_forms/view_comment.php");

                if(isset($_POST["submit_view_coffee"])){
                    $selected_coffee = $_POST["view_selected_coffee"];

                    $query = "SELECT * FROM comments WHERE coffee = '$selected_coffee'";

                    $result = mysqli_query($connection, $query);

                    $comment_result = [];
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $comment_result[] = $row;
                        }

                        include("user_forms/comment_section.php");
                    }
                    else{
                        echo "No review for this coffee yet";
                    }

                }
            }
            elseif(isset($_POST["btn_goto_write"])){
                $query = "SELECT DISTINCT name FROM coffee_price";

                $query = mysqli_query($connection, $query);

                $coffee_list = [];

                while($row = mysqli_fetch_assoc($query)){
                    $coffee_list[] = $row;
                }

                include("user_forms/write_comment.php");

                if(isset($_POST["btn_submit_comment"])){
                    $comment = filter_input(INPUT_POST, "user_comment", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                    $coffee = $_POST["selected_coffee"];
                    $name = $_SESSION["user"]["username"];

                    if(strlen($comment) < 255){
                        if(!empty($comment) && !empty($name)){
                            $stmt = mysqli_prepare($connection, "INSERT INTO comments (username, comment, coffee) VALUES (?, ?, ?)");
                            
                            mysqli_stmt_bind_param($stmt, "sss", $name, $comment, $coffee);
    
                            if(mysqli_stmt_execute($stmt)){
                                echo "Saved Successfully";
                            }
                            else{
                                echo "Something went wrong";
                            }


                            mysqli_stmt_close($stmt);
    
                        }
                        else{
                            echo "Comment should not be empty";
                        }
                    }
                    else{
                        echo "Comment length has exceeded the maximum range";
                    }
                }
            }

            mysqli_close($connection);
            

        }
        elseif(isset($_POST["buy_coffee"])){

            include("../backends/database/database.php");

            $query = "SELECT * FROM coffee_price";
            $query_addons = "SELECT * FROM add_ons_price";
            $result = mysqli_query($connection, $query);
            $result_addons = mysqli_query($connection, $query_addons);

            if(mysqli_num_rows($result) > 0){

                $add_ons_list = [];

                if(mysqli_num_rows($result_addons) > 0){
                    while($row = mysqli_fetch_assoc($result_addons)){
                        $name = $row["add_on"];
                        $price = $row["price"];

                        $add_ons_list[$name] = $price; 
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


                        $total_addon = 0;
                        
                        if(isset($_POST["addons"])){
                            
                            
                            $list_addons[] = $_POST["addons"];
                            foreach($list_addons as $selected){
                                $total_addon += $add_ons_list[$selected];
                            }
                        }

                        $size = $_POST["size"];
                        $quantity = $_POST["quantity"] ?? 0;

                        if($quantity > 0){
                            $total_payment = ($total_addon + $coffee_list[$_SESSION["selected_coffee"]][$size]) * $quantity;

                            $admin = "SELECT income FROM admin";


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

                                $transaction_query = "
                                    INSERT INTO transactions (name, payment)
                                    VALUES ('{$_SESSION['user']['name']}', $total_payment);
                                ";

                                mysqli_query($connection, $transaction_query);

                                $result = mysqli_query($connection, $admin);
                                $income = mysqli_fetch_assoc($result);

                                $updated_balance = $income['income'];
                                
                                $updated_balance += $total_payment;

                                $update_income_query = "UPDATE admin SET income = $updated_balance";

                                echo "<h2 class='title'> <strong> Total: $total_payment </strong> </h2>";

                                mysqli_query($connection, $update_income_query);
                                
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


                                        $transaction_query = "
                                            INSERT INTO transactions (name, payment)
                                            VALUES ('{$_SESSION['user']['name']}', $total_payment);
                                        ";

                                        mysqli_query($connection, $transaction_query);

                                        $result = mysqli_query($connection, $admin);
                                        $income = mysqli_fetch_assoc($result);

                                        $updated_balance = $income['income'];
                                        
                                        $updated_balance += $total_payment;

                                        $update_income_query = "UPDATE admin SET income = $updated_balance";

                                        echo "<h2 class='title'> <strong> Total: $total_payment </strong> </h2>";

                                        mysqli_query($connection, $update_income_query);
                                    }
                                }
                            }

                            $query_save_balances = "
                                UPDATE users
                                SET
                                    cashed_in = '{$_SESSION['user']['cashed_in']}',
                                    debt = '{$_SESSION['user']['debt']}',
                                    total_balance = '{$_SESSION['user']['total_balance']}'
                                WHERE name = '{$_SESSION['user']['name']}'
                            ";

                            mysqli_query($connection, $query_save_balances);
                        }
                        else{
                            echo "<h2 class='title'> <strong> Please include a quantity </strong> </h2>";
                        }
                    }
                }
            }
            else{
                echo "No coffee is currently available for sale";
            }
            mysqli_close($connection);
        }
    }

?>