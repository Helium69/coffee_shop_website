<br>
<div class="form_admin">
    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
        <input type="hidden" name="view_all">
        <label> View All User </label>
        <input type="submit" name="view_all_users" class="nav_button">
        <label> Delete User </label>
        <input type="submit" name="delete_users" class="nav_button">
        <label> Ban User </label>
        <input type="submit" name="ban_users" class="nav_button">
    </form>
</div>