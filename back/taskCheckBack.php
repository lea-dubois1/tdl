<?php

if (session_status() == PHP_SESSION_NONE){ session_start();}

require_once '../Task.php';

var_dump($_POST);

//$decode = json_decode($_POST[0]);

// $task = new Task;
// $task->Delete($decode['idTask']);

?>