<?php

if (session_status() == PHP_SESSION_NONE){ session_start();}

require_once '../Task.php';

echo "post : " . $_POST;

$task = new Task;
$task->Add($_SESSION['id'], $_POST['addTask']);

?>