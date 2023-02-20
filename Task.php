<?php

class Task
{
    private $conn;

    public function __construct() {

        $db_username = 'root';
        $db_password = '';
        
        // On essaie de se connecter
        try{

            $this->conn = new PDO('mysql:host=localhost;dbname=tdl;charset=utf8', $db_username, $db_password);

            // On définit le mode d'erreur de PDO sur Exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        // On capture les exceptions si une exception est lancée
        catch(PDOException $e){

            // et on affiche les informations relatives à celle-ci
            echo "Error : " . $e->getMessage();

        }

    }

    public function Add($id_utilisateur, $content, $creation_date) {
        
        $sql = "INSERT INTO `taches`(`id_utilisateur`, `content`, `isChecked`, `creationDate`) VALUES (':id_utilisateur',':content','0',':creation_date')";
            
        // Check if a line with the same login exist in our Database.
        $req = $this->conn->prepare($sql);
        $req->execute(array(':id_utilisateur' => $id_utilisateur,
                            ':content' => $content,
                            'creation_date' => $creation_date
        ));
        
        echo 'Task added in the db';

    }

    public function Delete($idTask) {

        $sql = "DELETE FROM taches WHERE id=:idTask";

        $req = $this->conn->prepare($sql);
        $req->execute(array(':idTask' => $idTask));

        echo 'Task deleted from the db';

    }

    public function Check($idTask) {

        $sql = "UPDATE taches SET isChecked=:isChecked WHERE id=:idTask";

        $req = $this->conn->prepare($sql);
        $req->execute(array(':isChecked' => 1,
                            ':idTask' => $idTask
        ));

        echo 'Task checked';
        
    }

    public function Uncheck($idTask) {
        
        $sql = "UPDATE taches SET isChecked=:isChecked WHERE id=:idTask";

        $req = $this->conn->prepare($sql);
        $req->execute(array(':isChecked' => 0,
                            ':idTask' => $idTask
        ));

        echo 'Task unchecked';

    }

    public function getAll() {

        $sql = "SELECT * FROM taches";

        $req = $this->conn->prepare($sql);
        $req->execute();
        $tab = $req->fetch(PDO::FETCH_DEFAULT);
        
        $json = json_encode($tab, JSON_PRETTY_PRINT);
        echo $json;

    }

}

// $newTask = new Task();
// $newTask->getAll();

//echo $newUser->Register('juju', 'azerty', 'azerty', 'juju@gmail.com', 'Julie', 'Dubois');
//$newUser->Connect('juliedbs', 'azerty');
//echo $newUser->Update('juliedbs', 'azerty', '', '', 'julie@gmail.com', 'Julie', 'Dubois');
//$newUser->Update('lea', 'azerty', 'azer','azer', 'unemail@gmail.com', 'Lea', 'DuboiS');
//echo $newUser->GetLogin();
//$newUser->Disconnect();
//$newUser->Delete();
//var_dump($_SESSION);

?>