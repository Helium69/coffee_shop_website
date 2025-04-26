<h2 class="title"> <strong> Deposit </strong></h2>
<div class="form">
    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
        <label> Deposit </label>
        <input type="hidden" name="account_info">

        <input type="number" step="any" name="input_balance" placeholder="Enter the amount of deposit">
        <input type="submit" name="add_balance" value="Add Balance">
    </form>
</div>