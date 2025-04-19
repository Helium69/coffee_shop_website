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
        if(isset($_POST["home"])){
            header("Location: index.php");
        }   
    }
?>