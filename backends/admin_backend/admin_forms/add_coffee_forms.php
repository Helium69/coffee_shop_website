<div class="form">
    <h2 class="title"> <strong> Add Coffee </strong></h2>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
        <label> Name </label> 

        <?php if($name_too_long): ?>
            <label class="warning"> Coffee name is too long </label>
        <?php elseif($name_too_short): ?>
            <label class="warning"> Coffee name is too short </label>
        <?php endif; ?>
        
        <br>
        <input class="txtbox" type="text" name="coffee_name">
        <br>

        <label> Price (Small) </label>

        <?php if($small_warning): ?>
            <label class="warning"> Coffee price is out of range </label>
        <?php endif; ?>
        <br>
        <input class="txtbox" type="number" name="price_small"> 
        <br>
        <label> Price (Medium) </label>

        <?php if($medium_warning): ?>
            <label class="warning"> Coffee price is out of range </label>
        <?php endif; ?>
        <br>
        <input type="number" name="price_medium"> 
        <br>
        <label> Price (Large) </label>

        <?php if($large_warning): ?>
            <label class="warning"> Coffee price is out of range </label>
        <?php endif; ?>
        <br>
        <input type="number" name="price_large"> 
        <br> <br>

        <input type="hidden" name="add_coffee_to_menu">
        <input type="hidden" name="add_coffee">

        <input class="nav_button" type="submit" name="submit_coffee_menu"> 
    </form>
</div>