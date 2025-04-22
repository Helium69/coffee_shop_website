<?php 
    include("../backends/database/database.php");

    $query = "SELECT * FROM coffee_price";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) > 0){
        $coffee_list = [];

        while($row = mysqli_fetch_assoc($result)){
            $coffee_list[] = $row;
        }
    }
    else{

    }

    mysqli_close($connection);
?>

<form>
    <label> Coffee </label>
    <select name="coffee">
        <?php
            foreach($coffee_list as $coffee){
                echo "
                    <option> $coffee[name] </option>
                ";
            }
        ?>
    </select>



</form>
