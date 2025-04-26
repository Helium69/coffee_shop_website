<br>
<div class="form">
    <h2 class="title"> <strong> Sign In </strong> </h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
        <input type="hidden" name="signin">

        <label class="form_label"> Username </label>
        <input type="text" name="signin_username">
        <label class="form_label"> Password </label>
        <input type="text" name="signin_password"> <br> <br>    
        <input class="nav_button" type="submit" name="submit_signin">
    </form>
</div>