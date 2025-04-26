<h2 class="title"> <strong> Delete User </strong> </h2>
<div class="form">
    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
        <input type="hidden" name="view_all">
        <input type="hidden" name="delete_users">

        <label> Enter the name of the user</label>
        <input type="text" name="name_to_be_deleted"> <br> <br> 
        <input class="nav_button" type="submit" name="submit_delete_user">  
    </form> 
</div>