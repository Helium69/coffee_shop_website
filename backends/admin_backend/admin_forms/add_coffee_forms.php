<div class="form">
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
        <label> Name </label> 

        <?php if($name_too_long): ?>
            <label class="warning"> Coffee name is too long </label>
        <?php elseif($name_too_short): ?>
            <label class="warning"> Coffee name is too short </label>
        <?php endif; ?>

        <input type="text" name="coffee_name">
        <label> Price (Small) </label>

        <?php if($small_warning): ?>
            <label class="warning"> Coffee price is out of range </label>
        <?php endif; ?>

        <input type="number" name="price_small"> 
        <label> Price (Medium) </label>

        <?php if($small_warning): ?>
            <label class="warning"> Coffee price is out of range </label>
        <?php endif; ?>

        <input type="number" name="price_medium"> 
        <label> Price (Large) </label>

        <?php if($small_warning): ?>
            <label class="warning"> Coffee price is out of range </label>
        <?php endif; ?>

        <input type="number" name="price_large"> 

        <input type="hidden" name="add_coffee_to_menu">
        <input type="hidden" name="add_coffee">

        <input type="submit" name="submit_coffee_menu"> 
    </form>
</div>