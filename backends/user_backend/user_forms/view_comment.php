<h2 class="title"> <strong> View a Review/Comment</strong></h2>
<br>
<div class="form_buy title">
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
        <input type="hidden" name="coffee_review" >
        <input type="hidden" name="btn_goto_view">
        <select name="view_selected_coffee">
            <?php
                foreach($coffee_list as $coffee){
                    echo "<option value={$coffee['name']}> {$coffee['name']} </option>"; 
                }
            ?>
        </select>

        <input class="nav_button" type="submit" name="submit_view_coffee"> 
    </form>
</div>