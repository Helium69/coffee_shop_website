<?php ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Home </title>
    <link href="../style/general.css" rel="stylesheet">
</head>


<body>
    
    <?php include("../reusable/home_header.php");?>
    
    <section>
        <!-- Homepage backend -->
        <?php include("../backends/home_backend/homepage_tab_backend.php"); ?>
    </section>

    <?php include("../reusable/general_footer.php")?>
    
</body>
</html>