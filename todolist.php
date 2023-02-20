<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <script src="script.js" defer></script>
    <title>Login</title>
</head>

<body>

    <?php require_once 'User.php' ?>
    <?php include 'header.php' ?>
    <?php var_dump($_SESSION) ?>

    <main>
        <form action="" method="post" id="formAddTask">
            <h2>Tâches à faire</h2>
            <input type="text" name="addTask" id="content" placeholder="Name of the task">
            <button type="submit" id="addTaskButton">Add</button>
            <div id="toDoTasks"></div>
        </form>

        <h2>Tâches terminées</h2>
        <div id="donneTasks"></div>

    </main>

    <?php require_once  'footer.php' ?>

</body>
</html>
