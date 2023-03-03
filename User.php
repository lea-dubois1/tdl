<?php

session_start();

class User
{
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;
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

    public function Register($login, $password, $passwordConfirm, $email, $firstname, $lastname) {

        $error = "";
        $errorLogin = "";
        $errorPassword = "";
        $errorEmail = "";
        $errorNames = "";

        $sql = "SELECT * FROM utilisateurs WHERE login=:login";
        
        // Check if a line with the same login exist in our Database.
        $req = $this->conn->prepare($sql);
        $req->execute(array(':login' => $login));
        $row = $req->rowCount();
        
        if($row <= 0) {     // If the login do not exist in the Database, we check the passwords

            if(strlen($login) >= 4 && !preg_match("[\W]", $login) && strlen($password) >= 5 && preg_match("/@/", $email) && preg_match("/\./", $email) && strlen($firstname) >= 2 && !preg_match("[\W]", $firstname) && strlen($lastname) >= 2 && !preg_match("[\W]", $lastname)) {

                if($password == $passwordConfirm) {
                    
                    // Cripting the password
                    $hash = password_hash($password, PASSWORD_DEFAULT);

                    // Cripting the password
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    
                    // Add data to the database 
                    $sql = "INSERT INTO `utilisateurs` (`login`, `password`, `email`, `firstname`, `lastname`) VALUES (:login, :pass, :email, :firstname, :lastname)";
                    $req = $this->conn->prepare($sql);
                    $req->execute(array(':login' => $login,
                                        ':pass' => $hash,
                                        ':email' => $email,
                                        ':firstname' => $firstname,
                                        ':lastname' => $lastname));

                    echo '<strong>Success!</strong> Your account is now created and you can login <br>';

                }else{ $error = 'The passwords do not match <br>'; }

            }else{

                // Login errors
                if(strlen($login) < 4 || preg_match("[\W]", $login)) {

                    $errorLogin = "Your login must contain at least 4 caracters and no specials caracters <br>";

                }

                // Password errors
                if(strlen($password) < 5) {

                    $errorPassword = "Your password must contain at least 5 caracters <br>";

                }

                // Email errors
                if(!preg_match("/@/", $email) || !preg_match("/\./", $email)) {

                    $errorEmail = "Your email is not valid. It must contain '@' and '.' <br>";

                }

                // First and last name errors
                if(strlen($firstname) < 2 || preg_match("[\W]", $firstname) || strlen($lastname) < 2 || preg_match("[\W]", $lastname)) {

                    $errorNames = "Your first and last names must contain at least 2 caracters and no specials caracters <br>";

                }

            }
            
        }else{ $error = '<strong>Error!</strong> The login already exist. Please choose another one <br>'; }

        return $error . $errorLogin . $errorPassword . $errorEmail . $errorNames;

    }

    public function Connect($login, $password) {

        $sql = "SELECT * FROM utilisateurs WHERE login=:login";
        
        // Check if the username is already present or not in our Database.
        $req = $this->conn->prepare($sql);
        $req->execute(array(':login' => $login));
        $row = $req->rowCount();
        
        if($row == 1){    // If the login exist in the data base, continue

            $tab = $req->fetch(PDO::FETCH_ASSOC);
            $dataPass = $tab['password'];
            $id = $tab['id'];

            if(password_verify($password,$dataPass)){    // Check if the password existe in the database and decript it

                $_SESSION['id'] = $id;
                $_SESSION['login'] = $login;
                $_SESSION['password'] = $dataPass;
                $_SESSION['email'] = $tab['email'];
                $_SESSION['firstname'] = $tab['firstname'];
                $_SESSION['lastname'] = $tab['lastname'];

                echo '<strong>Success!</strong> You\'re connected<br>';

                header('Location: todolist.php');

            }else{    // If the password do not match, error
                echo '<strong>Error!</strong> Wrong password<br>';
            }
        }else{    // If the login do not exist, error
            echo '<strong>Error!</strong> The login do not exist. You don\'t have an account? <a href=\"inscription.php\">Signup</a><br>';
        }

    }

    public function Disconnect() {

        session_destroy();
        exit('Vous avez bien été deconnecté');
        header('Location: index.php');

    }

    public function Delete() {

        if($_POST['delete']) {

            if($_SESSION){

                // Set variables to use in the following request.
                $sessionId = $_SESSION['id'];

                $sql = "DELETE FROM `utilisateurs` WHERE id = :sessionId";
            
                // Check if the username is already present or not in our Database.
                $req = $this->conn->prepare($sql);
                $req->execute(array(':sessionId' => $sessionId));

                session_destroy();
                exit('You have deleted your account');


            }else{
                echo 'Please login to delete your account<br>';
            }
        }

    }

}

//$newUser = new User();
//echo $newUser->Register('juju', 'azerty', 'azerty', 'juju@gmail.com', 'Julie', 'Dubois');
//$newUser->Connect('juliedbs', 'azerty');
//echo $newUser->Update('juliedbs', 'azerty', '', '', 'julie@gmail.com', 'Julie', 'Dubois');
//$newUser->Update('lea', 'azerty', 'azer','azer', 'unemail@gmail.com', 'Lea', 'DuboiS');
//echo $newUser->GetLogin();
//$newUser->Disconnect();
//$newUser->Delete();
//var_dump($_SESSION);

?>