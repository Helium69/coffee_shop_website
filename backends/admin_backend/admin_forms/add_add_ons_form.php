<div class="form">
    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">

        <label> Add-Ons Name </label>

        <?php if($name_too_short): ?>
            <label class="warning"> Add - Ons name is too long </label>
        <?php elseif($name_too_long): ?>
            <label class="warning"> Add - Ons name is too short </label>
        <?php endif; ?>

        <input type="text" name="add_ons_name">

        <label> Price </label>

        <?php if($out_of_range): ?>
            <label class="warning"> Add - Ons price is out of range </label>
        <?php endif; ?>

        <input type="number" name="add_ons_price">

        <input type="hidden" name="add_coffee">
        <input type="hidden" name="add_add_ons_to_menu">
        <input type="submit" name="submit_add_ons"> 
    </form>
</div>