<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js" defer></script>
    <title>Document</title>
</head>

<?php require_once 'User.php' ?>

<body>
    <?php require_once 'header.php' ?>

    <?php if (session_status() == PHP_SESSION_NONE){ session_start();} ?>

    <div id="form">Bonjour <?php if($_SESSION){echo ' ' . $_SESSION['login'];}else{echo 'user';}?></div>

    <?php require_once 'footer.php' ?>

</body>

</html>