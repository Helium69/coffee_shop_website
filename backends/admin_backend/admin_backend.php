<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["add_coffee"])){

            include("admin_forms/add_to_menu.php");


            if(isset($_POST["add_coffee_to_menu"])){

                $name_too_short = $name_too_long = $small_warning = $medium_warning = $large_warning = false;

                if(isset($_POST["submit_coffee_menu"])){
                    $coffee_name = filter_input(INPUT_POST, "coffee_name", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                    $coffee_name = trim(strtoupper($coffee_name));
                    $price_small = filter_input(INPUT_POST, "price_small", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                    $price_medium = filter_input(INPUT_POST, "price_medium", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                    $price_large = filter_input(INPUT_POST, "price_large", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";

                    
                    if(strlen($coffee_name) < 4){
                        $name_too_short = true;
                    }
                    elseif(strlen($coffee_name) > 35){
                        $name_too_long = true;
                    }

                    if($price_small > 999.99 || $price_small < 0){
                        $small_warning = true;
                    }
                    
                    if($price_medium > 999.99 || $price_medium < 0){
                        $medium_warning = true;
                    }
                    
                    if($price_large > 999.99 || $price_large < 0){
                        $large_warning = true;
                    }

            
                    if(!$name_too_short && !$name_too_long && !$small_warning && !$medium_warning && !$large_warning){

                        $list = [];
                        $list[] = [$coffee_name, "SMALL", $price_small];
                        $list[] = [$coffee_name, "MEDIUM", $price_medium];
                        $list[] = [$coffee_name, "LARGE", $price_large];
                        

                        try{
                            include("../backends/database/database.php");

                            $query = "
                                SELECT * FROM coffee_price
                                WHERE name = '$coffee_name';
                            ";

                            $result = mysqli_query($connection, $query);

                            if(mysqli_num_rows($result) == 0){
                                $statement = mysqli_prepare($connection, "INSERT INTO coffee_price (name, size, price) VALUES(?, ?, ?)");

                                mysqli_stmt_bind_param($statement, "ssd", $name, $size, $price);

                                foreach($list as $coffee){
                                    $name = $coffee[0];
                                    $size = $coffee[1];
                                    $price = $coffee[2];
                                    mysqli_stmt_execute($statement);    
                                }

                                mysqli_stmt_close($statement);

                                mysqli_close($connection);
                            }
                            else{
                                echo "Coffee already exist's";
                            }
                        }
                        catch(Exception){
                            echo "There something went wrong with the server";
                        }
                    }
                }

                include("admin_forms/add_coffee_forms.php");
            }
            elseif(isset($_POST["add_add_ons_to_menu"])){
                
                

                $name_too_long = $name_too_short = $out_of_range = false;

                if(isset($_POST["submit_add_ons"])){

                    

                    $add_ons_name = filter_input(INPUT_POST, "add_ons_name", FILTER_SANITIZE_SPECIAL_CHARS) ?? "" ;
                    $add_ons_name = trim(strtoupper($add_ons_name));
                    $add_ons_price = filter_input(INPUT_POST, "add_ons_price", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";


                    if(strlen($add_ons_name) < 2){
                        $name_too_short = true;
                    }
                    elseif(strlen($add_ons_name) > 35){
                        $name_too_long = true;
                    }

                    if($add_ons_price > 999.99 || $add_ons_price < 0){
                        $out_of_range = true;
                    }

                    
                    if(!$name_too_short && !$name_too_long && !$out_of_range){
                        include("../backends/database/database.php");

                        $statement = mysqli_prepare($connection, "INSERT INTO add_ons_price (add_on, price) VALUES(?, ?)");

                        mysqli_stmt_bind_param($statement, "sd", $add_ons_name, $add_ons_price);

                        mysqli_stmt_execute($statement);

                        mysqli_stmt_close($statement);



                        mysqli_close($connection);
                    }
                }
                include("admin_forms/add_add_ons_form.php");
            }
        }
        elseif(isset($_POST["home"])){
            header("Location: index.php");
        }
        elseif(isset($_POST["view_properties"])){

            // view income and view history transactions
            include("admin_forms/view_option.php");

            include("../backends/database/database.php");

            if(isset($_POST["view_transactions"])){
                $income_query = "SELECT income FROM admin";
                $query = "SELECT * FROM transactions";

                $income_result = mysqli_query($connection, $income_query);
                $row = mysqli_fetch_assoc($income_result);
                $income = $row['income'];
                
                include("admin_forms/income.php");

                $result = mysqli_query($connection, $query);

                if(mysqli_num_rows($result) > 0){
                    $transaction_list = [];
                    while($row = mysqli_fetch_assoc($result)){
                        $transaction_list[] = $row;
                    }
                    include("admin_forms/view_income.php");
                }
                else{
                    echo "No result was found";
                }
            }
            elseif(isset($_POST["view_menu"])){

                $coffee_list = [];
                $addons_list = [];

                
                $query_coffee = "SELECT * FROM coffee_price";
                $query_addons = "SELECT * FROM add_ons_price";

                $coffee_result = mysqli_query($connection, $query_coffee);
                $addons_result = mysqli_query($connection, $query_addons);

                if(mysqli_num_rows($coffee_result) > 0){
                    while($row = mysqli_fetch_assoc($coffee_result)){
                        $name = $row["name"];
                        $size = $row["size"];
                        $price = $row["price"];

                        $coffee_list[$name][$size] = $price;
                    }

                    include("admin_forms/view_menu_coffee.php");
                }
                else{
                    echo "Coffee menu is empty";
                }

                if(mysqli_num_rows($addons_result) > 0){
                    while($row = mysqli_fetch_assoc($addons_result)){
                        $addon = $row["add_on"];
                        $price = $row["price"];

                        $addons_list[$addon] = $price;
                    }

                    include("admin_forms/view_menu_addons.php");
                }
                else{
                    echo "Coffee menu is empty";
                }

            }


            mysqli_close($connection);




        }
        elseif(isset($_POST["view_all"])){
            include("admin_forms/view_all_nav.php");

            if(isset($_POST["view_all_users"])){

                include("../backends/database/database.php");

                $query = "
                    SELECT * FROM users
                ";

                $result = mysqli_query($connection, $query);

                if(mysqli_num_rows($result) > 0){   
                    $userlist = [];

                    while($row = mysqli_fetch_assoc($result)){
                        $userlist[] = $row;
                    }

                    include("admin_forms/user_table.php");
                }
                else{
                    echo "There is currently no user detected";
                }

                mysqli_close($connection);

            }
            elseif(isset($_POST["delete_users"])){
                include("admin_forms/delete_form.php");

                if(isset($_POST["submit_delete_user"])){

                    $name = filter_input(INPUT_POST, "name_to_be_deleted", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                    $name = trim(strtoupper($name)); 

                    include("../backends/database/database.php");

                    $statement = mysqli_prepare($connection, "SELECT * FROM users WHERE name = ?;");
                    mysqli_stmt_bind_param($statement, "s", $name);
                    mysqli_stmt_execute($statement);

                    $result = mysqli_stmt_get_result($statement);

                    mysqli_stmt_close($statement);

                    if(mysqli_num_rows($result) > 0){
                        $delete_statement = mysqli_prepare($connection, "DELETE FROM users WHERE name = ?");
                        mysqli_stmt_bind_param($delete_statement, "s", $name);
                        mysqli_stmt_execute($delete_statement);

                        mysqli_stmt_close($delete_statement);

                        echo "User account has been successfully deleted";
                    }
                    else{
                        echo "User has not been found";
                    }
                    mysqli_close($connection);
                }
            }
            elseif(isset($_POST["ban_users"])){
                include("admin_forms/ban_form.php");

                if(isset($_POST["submit_ban_user"])){

                    $name = filter_input(INPUT_POST, "name_to_be_ban", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                    $name = trim(strtoupper($name));

                    include("../backends/database/database.php");

                    $statement = mysqli_prepare($connection, "SELECT * FROM users WHERE name = ?;");
                    mysqli_stmt_bind_param($statement, "s", $name);
                    mysqli_stmt_execute($statement);

                    $result = mysqli_stmt_get_result($statement);

                    mysqli_stmt_close($statement);

                    if(mysqli_num_rows($result) > 0){

                        $user = mysqli_fetch_assoc($result);
                        $status = 0;

                        if(!$user["banned"]){
                            $status = 1;
                        }
                        
                        $query = "UPDATE users SET banned = $status WHERE name = '$user[name]'";
                        mysqli_query($connection, $query);


                        if($status == 1){
                            echo "User has been banned";
                        }
                        else{
                            echo "Ban on the user has been lifted";
                        }
                    }
                    else{
                        echo "No user has been found";
                    }
                    mysqli_close($connection);
                }
            }
        }
    }
?>