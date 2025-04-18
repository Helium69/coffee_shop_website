<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $name_too_long = false;
        $name_too_short = false;

        $username_too_long = false;
        $username_too_short = false;

        $password_too_short = false;
        $password_too_long = false;

        if(isset($_POST["signup"])){
            if(isset($_POST["signup_submit"])){

                $name = filter_input(INPUT_POST, "signup_name", FILTER_SANITIZE_SPECIAL_CHARS) ?? "" ;
                $name = trim(strtoupper($name));
                $username = filter_input(INPUT_POST, "signup_username", FILTER_SANITIZE_SPECIAL_CHARS) ?? "" ;
                $password = filter_input(INPUT_POST, "signup_password", FILTER_SANITIZE_SPECIAL_CHARS) ?? "" ;
                $sex = filter_input(INPUT_POST, "signup_sex", FILTER_SANITIZE_SPECIAL_CHARS) ?? "" ;
                $sex = strtoupper($sex);
    
                
                if(strlen($name) > 60){
                    $name_too_long = true;
                }
                elseif(strlen($name) < 5){
                    $name_too_short = true;
                }

                if(strlen($username) > 15){
                    $username_too_long = true;
                }
                elseif(strlen($username) < 5){
                    $username_too_short = true;
                }

                if(strlen($password) > 15){
                    $password_too_long = true;
                }
                elseif(strlen($password) < 5){
                    $password_too_short = true;
                }

                if((!$name_too_long && !$name_too_short) && (!$username_too_long && !$username_too_short) 
                && (!$password_too_long && !$password_too_short)){


                    $default = 0.00;
                    $banned = 0;


                    try{
                        include("../backends/database/database.php");
                        $pass = password_hash($password, PASSWORD_DEFAULT);

                        $stmt = mysqli_prepare($connection, "INSERT INTO users (name, username, password, sex, cashed_in, debt, total_balance, banned) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");

                        mysqli_stmt_bind_param($stmt, "ssssdddi", $name, $username, $pass, $sex, $default, $default, $default, $banned);

                        mysqli_stmt_execute($stmt);

                        mysqli_stmt_close($stmt);

                        mysqli_close($connection);

                        echo "<div> Account has been saved  </div>";
                    }
                    catch(Exception){
                        echo "There was an error saving your account, contact the admin for more help";
                    }

                }
                
            }


            include("../backends/forms/signup_form.php");
        }
        elseif(isset($_POST["admin"])){



            $password_too_long = false;
            $password_too_short = false;
    
            $username_too_long = false;
            $username_too_short = false;

            if(isset($_POST["admin_submit"])){
                $username = filter_input(INPUT_POST, "admin_username", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $password = filter_input(INPUT_POST, "admin_password", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";

                if(strlen($username) > 15){
                    $username_too_long = true;
                }
                elseif(strlen($username) < 5){
                    $username_too_short = true;
                }

                if(strlen($password) > 15){
                    $password_too_long = true;
                }
                elseif(strlen($password) < 5){
                    $password_too_short = true;
                }



                if((!$username_too_long && !$username_too_short) && (!$password_too_long && !$password_too_short)){
                    include("../backends/database/database.php");

                    $pass = password_hash($password, PASSWORD_DEFAULT);

                    $query = "
                        SELECT * FROM admin;
                    ";

                    $result = mysqli_query($connection, $query);

                    if(mysqli_num_rows($result) > 0){
                        
                    };

                    mysqli_close($connection);
                }
            }
            
            include("../backends/forms/admin_form.php");
        }















    }
    
?>