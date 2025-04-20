<div class="form">
    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
        <input type="hidden" name="signin">

        <label> Username </label>
        <input type="text" name="signin_username">
        <label> Password </label>
        <input type="text" name="signin_password">
        <input type="submit" name="submit_signin">
    </form>
</div>