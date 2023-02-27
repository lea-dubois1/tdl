<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <title>Signup</title>
</head>

<body>

    <?php require_once 'User.php' ?>
    <?php require_once 'header.php' ?>

    <main>

        <form action="" method="POST" class="formulaire">

            <h2>SIGNUP</h2>

            <label>Login</label>
            <input type="text" name="login" value="<?php if(isset($_POST['login'])){ echo $_POST['login'];} ?>" required><br>

            <label>Email</label>
            <input type="email" name="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];} ?>" required><br>

            <label>Firstname</label>
            <input type="text" name="firstname" value="<?php if(isset($_POST['firstname'])){ echo $_POST['firstname'];} ?>" required><br>

            <label>Lastname</label>
            <input type="text" name="lastname" value="<?php if(isset($_POST['lastname'])){ echo $_POST['lastname'];} ?>" required><br>
                    
            <label>Password</label>
            <input type="password" name="password" required><br>

            <label>Confirm password</label>
            <input type="password" name="passwordConfirm" required><br>

            <button name="submit">Singup</button>

            <?php
                if(isset($_POST['submit'])) {
                    $user = new User();
                    echo $user->Register($_POST['login'], $_POST['password'], $_POST['passwordConfirm'], $_POST['email'], $_POST['firstname'], $_POST['lastname']);
                }
            ?>

        </form>

    </main>

    <?php require_once 'footer.php' ?>

</body>

</html>