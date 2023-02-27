<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <script src="script.js" defer></script>
    <title>Login</title>
</head>

<body>

    <?php if (session_status() == PHP_SESSION_NONE){ session_start();} ?>
    <?php if(!$_SESSION){header('Location: connexion.php');} ?>
    <?php include 'header.php' ?>

    <main>
        <h2>To do tasks</h2>

        <form action="" method="post" id="formAddTask">
            <input type="text" name="addTask" id="content" placeholder="Name of the task" required>
            <button type="submit" name="submit" id="addTaskButton">Add</button>
        </form>
        
        <div id="toDoTasks"></div>


        <h2>Completed tasks</h2>
        <div id="completedTasks"></div>

    </main>

    <?php require_once  'footer.php' ?>

</body>
</html>
