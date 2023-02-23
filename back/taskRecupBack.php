<?php

if (session_status() == PHP_SESSION_NONE){ session_start();}

require_once '../Task.php';

$task = new Task;
$task->getAll($_SESSION['id']);

?>