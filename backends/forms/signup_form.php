<div class="form">
    <h2 class="title"> Sign Up </h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
        <label class="form_label"> Username </label>
        <input type="text" name="signup_username">

        <?php if($username_too_long == true):?>
            <label class="warning"> Username is too long </label>
        <?php elseif($username_too_short == true): ?>
            <label class="warning"> Username is too short </label>
        <?php endif; ?>



        <label class="form_label"> Password </label>
        <input type="text" name="signup_password">

        <?php if($password_too_long == true):?>
            <label class="warning"> Password is too long </label>
        <?php elseif($password_too_short == true): ?>
            <label class="warning"> Password is too short </label>
        <?php endif; ?>

        <label class="form_label"> Name </label>
        <input type="text" name="signup_name">

        <?php if($name_too_long == true):?>
            <label class="warning"> Name is too long </label>
        <?php elseif($name_too_short == true): ?>
            <label class="warning"> Name is too short </label>
        <?php endif; ?>

        <label class="form_label"> Sex </label>

        <select name="signup_sex">
            <option value="male"> Male </option>
            <option value="female"> Female </option>
        </select>
        <input type="hidden" name="signup"> 
        <input type="submit" name="signup_submit">
    
    </form>
</div>