<header>
    <h1> Coffee Shop </h1>
    <nav>
        <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
            <input type="submit" name="home" value="Home" class="nav_button">
            <input type="submit" name="add_coffee" value="Add Coffee" class="nav_button">
            <input type="submit" name="income" value="View Income" class="nav_button">
            <input type="submit" name="view_all" value="View All Users" class="nav_button">
        </form>
    </nav>
</header>