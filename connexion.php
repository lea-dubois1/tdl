<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <title>Login</title>
</head>

<body>

    <?php require_once 'User.php' ?>
    <?php require_once 'header.php' ?>

    <main>

        <form action="" method="POST" class="formulaire">
        
            <h2>LOGIN</h2>

            <label>Login</label>
            <input type="text" name="login" required><br>
        
            <label>Password</label>
            <input type="password" name="password" required><br>

            <button name="submit">Login</button>

            <?php

                if(isset($_POST['submit'])) {
                    $user = new User();
                    echo $user->Connect($_POST['login'], $_POST['password']);
                }

            ?>

        </form>
        
    </main>

    <?php require_once "footer.php" ?>
    
</body>
</html>
