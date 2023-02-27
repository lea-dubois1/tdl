<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>

<?php if (session_status() == PHP_SESSION_NONE){ session_start();} ?>

<header>

    <h1>ToDo or not ToDo</h1>

    <nav>
            
        <ul id="menu">
            <a href="index.php"><li>Home</li></a>
            <?php if(!$_SESSION){echo '<a href="inscription.php"><li>Signup</li></a>';} ?>
            <?php if(!$_SESSION){echo '<a href="connexion.php"><li>Login</li></a>';} ?>
            <?php if($_SESSION){echo '<a href="todolist.php"><li>My ToDo list</li></a>';} ?>
            <?php if($_SESSION){echo '<a href="profil.php"><li>Profile</li></a>';} ?>
            <?php if($_SESSION){echo '<a value="deconnexion" name="deconnexion" href="logout.php"><li>Logout</li></a>';} ?>
        </ul>

    </nav>
</header>

</html>