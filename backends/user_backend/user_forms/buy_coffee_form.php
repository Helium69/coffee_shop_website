<h2 class="title"> <strong> Submit the coffee first before ordering </strong></h2>
<div class="form_user">
    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST"> 
        <input type="hidden" name="buy_coffee">
        <input type="hidden" name="save">

        <label> Coffee </label>
        <select name="coffee">
            <?php
                $names = array_keys($coffee_list);
                foreach($names as $coffee){
                    echo"
                        <option value='$coffee'> $coffee </option> 
                    ";   
                }
            ?>

           
        </select>

        <input type="submit" name="select_coffee">

    </form>

</div>