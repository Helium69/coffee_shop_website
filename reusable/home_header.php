<header>
    <h1> Coffee Shop </h1>
    <nav>
        <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
            <input type="submit" name="home" value="Home" class="nav_button">
            <input type="submit" name="signin" value="Sign In" class="nav_button">
            <input type="submit" name="signup" value="Sign Up" class="nav_button">
            <input type="submit" name="admin" value="Admin" class="nav_button">
            <input type="submit" name="about" value="About" class="nav_button">
        </form>
    </nav>
</header>