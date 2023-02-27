<?php

if (session_status() == PHP_SESSION_NONE){ session_start();}
require_once 'Task.php';
$task = new Task;

if(isset($_GET['add'])) {

    $task->Add($_SESSION['id'], $_POST['addTask']);

}

if(isset($_GET['recup'])) {

    $task->getAll($_SESSION['id']);

}

if(isset($_GET['check'])) {

    $task->Check($_GET['idTask']);

}

if(isset($_GET['uncheck'])) {

    $task->Uncheck($_GET['idTask']);

}

if(isset($_GET['delete'])) {

    $task->Delete($_GET['idTask']);

}

?>