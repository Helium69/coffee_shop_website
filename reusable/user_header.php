<header>
    <h1> Coffee Shop </h1>
    <nav>
        <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
            <input type="submit" name="home" value="Home" class="nav_button">
            <input type="submit" name="account_info" value="Account Info" class="nav_button"> 
            <input type="submit" name="buy_coffee" value="Buy Coffee" class="nav_button">
            <input type="submit" name="coffee_review" value="Coffee Review" class="nav_button">
        </form>
    </nav>
</header>

