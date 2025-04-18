<div class="form">
    <h2 class="title"> Admin </h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
        <label class="form_label"> Username </label>
        <input type="text" name="admin_username">

        <?php if($username_too_long == true):?>
            <label class="warning"> Username is too long </label>
        <?php elseif($username_too_short == true): ?>
            <label class="warning"> Username is too short </label>
        <?php endif; ?>



        <label class="form_label"> Password </label>
        <input type="text" name="admin_password">

        <?php if($password_too_long == true):?>
            <label class="warning"> Password is too long </label>
        <?php elseif($password_too_short == true): ?>
            <label class="warning"> Password is too short </label>
        <?php endif; ?>

        <input type="hidden" name="admin">
        <input type="submit" name="admin_submit">
    
    </form>
</div>