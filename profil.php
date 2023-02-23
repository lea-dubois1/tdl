<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>Change profile</title>
</head>

<body>
    <?php if(!$_SESSION){header('Location: connexion.php');} ?>
    <?php require_once 'header.php' ?>

    <main>


        <h2 class="title_change">CHANGE PROFILE</h2>

        <form action="" method="POST" class="formulaire">

            <input type="text" name="login" value="<?php {echo $_SESSION['login'];} ?>">
            <label>Login</label>

            <input type="email" name="email" value="<?php {echo $_SESSION['email'];} ?>">
            <label>Email</label>

            <input type="text" name="firstname" value="<?php {echo $_SESSION['firstname'];} ?>">
            <label>Firstname</label>

            <input type="text" name="lastname" value="<?php {echo $_SESSION['lastname'];} ?>">
            <label>Lastname</label>
        
            <input type="password" name="old-password" required>
            <label>Password</label>
        
            <input type="password" name="new-password">
            <label>New password</label>
                
            <input type="password" name="confirm-password">
            <label>Confirm password</label>

            <button name="submit">Edit</button>

            <?php $user = new User();
            echo $user->Update($_POST['login'], $_POST['old-password'], $_POST['new-password'], $_POST['confirm-password'], $_POST['email'], $_POST['firstname'], $_POST['lastname']) ?>

            <button name="delete">Delete account</button>
            <?php $user->Delete() ?>

        </form>

    </main>

    <?php require_once "footer.php" ?>

</body>
</html>