<div class="form">
    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
        <input type="hidden" name="view_all">
        <input type="hidden" name="ban_users"> 

        <label> Enter the name of the user </label>
        <input type="text" name="name_to_be_ban">

        <input type="submit" name="submit_ban_user"> 
    </form>
</div>