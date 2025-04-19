<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["add_coffee"])){
            
            include("admin_forms\add_to_menu.php");

            if(isset($_POST["add_coffee_to_menu"])){

                $name_too_short = false;
                $name_too_long = false;
                $small_warning = false;
                $medium_warning = false;
                $large_warning = false;
                
                include("admin_forms\add_coffee_forms.php");

                if(isset($_POST["submit_coffeee_menu"])){
                    $coffee_name = filter_input(INPUT_POST, "coffee_name", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                    $price_small = filter_input(INPUT_POST, "price_small", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                    $price_medium = filter_input(INPUT_POST, "price_medium", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                    $price_large = filter_input(INPUT_POST, "price_large", FILTER_SANITIZE_SPECIAL_CHARS) ?? "";

                    


                    if(strlen($coffee_name) > 4){
                        $name_too_short = true;
                    }
                    elseif(strlen($coffee_name) < 35){
                        $name_too_long = true;
                    }

                    if($price_small > 999.99){
                        $small_warning = true;
                    }
                    elseif($price_medium > 999.99){
                        $medium_warning = true;
                    }
                    elseif($price_large > 999.99){
                        $large_warning = true;
                    }



                }
            }
            elseif(isset($_POST["add_add_ons_to_menu"])){

            }

           
            
















        }
    }
?>