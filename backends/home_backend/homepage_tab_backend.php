<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        

        if(isset($_POST["signup"])){
            $name_too_long = false;
            $name_too_short = false;

            $username_too_long = false;
            $username_too_short = false;

            $password_too_short = false;
            $password_too_long = false;

            // sign up backend

            if(isset($_POST["signup_submit"])){

                // filters each user input
                $name = filter_input(INPUT_POST, "signup_name", FILTER_SANITIZE_SPECIAL_CHARS) ?? "" ;
                $name = trim(strtoupper($name));
                $username = filter_input(INPUT_POST, "signup_username", FILTER_SANITIZE_SPECIAL_CHARS) ?? "" ;
                $password = filter_input(INPUT_POST, "signup_password", FILTER_SANITIZE_SPECIAL_CHARS) ?? "" ;
                $sex = filter_input(INPUT_POST, "signup_sex", FILTER_SANITIZE_SPECIAL_CHARS) ?? "" ;
                $sex = strtoupper($sex);
    

                // there might be a better way to do this but my head already hurts (and the weathers too hot)

                //checks if the user input is out of range, returns bool value for warnings
                
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


                // checks if the user input is valid
                if((!$name_too_long && !$name_too_short) && (!$username_too_long && !$username_too_short) 
                && (!$password_too_long && !$password_too_short)){


                    $default = 0.00;
                    $banned = 0;

                    // saves to database

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


                // add the warning if the input is wrong

                if((!$username_too_long && !$username_too_short) && (!$password_too_long && !$password_too_short)){
                    include("../backends/database/database.php");

                    $pass = password_hash($password, PASSWORD_DEFAULT);

                    $query = "
                        SELECT * FROM admin;
                    ";

                    $result = mysqli_query($connection, $query);

                    if(mysqli_num_rows($result) > 0){
                        $data = mysqli_fetch_assoc($result);
                        if($data["username"] == $username && password_verify($password, $data["password"])){
                            header("Location: admin_tab.php");
                            exit();
                        }
                    };

                    mysqli_close($connection);
                }
            }
            
            /* i dont think this is the right file directory path since i 
            only used one ../ but it works
            */

            include("../backends/forms/admin_form.php");
        }
        elseif(isset($_POST["signin"])){
            include("../backends/forms/signin_form.php");

            if(isset($_POST["submit_signin"])){
                $username = filter_input(INPUT_POST, "signin_username", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $password = filter_input(INPUT_POST, "signin_password", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";

                if(!empty($username) && !empty($password)){
                    include("../backends/database/database.php");

                    $statement = mysqli_prepare($connection, "SELECT * FROM users WHERE username = ?");

                    mysqli_stmt_bind_param($statement, "s", $username);

                    mysqli_stmt_execute($statement);

                    $result = mysqli_stmt_get_result($statement);

                    if(mysqli_num_rows($result) > 0){   
                        $user = mysqli_fetch_assoc($result);
                        if(password_verify($password, $user["password"])){

                            if(!$user['banned']){
                                session_destroy();
                                session_start();

                                $_SESSION["user"] = $user;
                                
                                header("Location: user_tab.php");
                            }
                            else{
                                echo "Your account is currently banned";
                            }
                        }else{
                            echo "Password is incorrect";
                        }
                    }
                    else{
                        echo "Username/Password is incorrect";
                    }
                    mysqli_close($connection);
                }
                else{
                    echo "Invalid Input";
                }
            }
        }
        elseif(isset($_POST["about"])){
            include("about_tab.php");
        }

    }
    
?>