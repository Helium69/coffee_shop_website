<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
    <input type="hidden" name="coffee_review">
    <input type="hidden" name="btn_goto_write">
    <select name="selected_coffee">
        <?php 
            foreach($coffee_list as $coffee){
                echo "<option value='{$coffee['name']}'> {$coffee['name']} </option>";
            } 
        ?>
    </select>
    <input type="text" name="user_comment" placeholder="Enter comment here">
    <input type="submit" name="btn_submit_comment">
</form>