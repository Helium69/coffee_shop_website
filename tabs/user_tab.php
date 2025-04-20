<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> User Tab </title>
    <link rel="stylesheet" href="../style/general.css">
</head>
<body>
    <?php include("../reusable/user_header.php");  ?>

    <section>
        <?php include("../backends/user_backend/user_backend.php"); ?>
    </section>

    <?php include("../reusable/general_footer.php"); ?>
</body>
</html>