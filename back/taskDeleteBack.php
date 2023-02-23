<?php

if (session_status() == PHP_SESSION_NONE){ session_start();}

require_once '../Task.php';

$task = new Task;
$task->Delete($_POST['idTask']);

?>