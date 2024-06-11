<?php
require_once '../model/User.php';

class UserController
{
    public function authenticate(string $email, string $password)
    {
        $user = new User();
        $record = $user->get_user($email);

        if ($record == null) 
        {
            echo "Aucun utilisateur trouvé.";
        }
        else 
        {
            if (password_verify($password, $record['password'])) {
                echo "Identification reussie.";
                if(!isset($_SESSION)){
                    session_start();
                }
                $_SESSION['user'] = $record;
                header("location: ../index.php");
            } 
            else if ($record['password'] == $password)
            {
                echo "Identification reussie, mot de passe obsolete.";
                if(!isset($_SESSION)){
                    session_start();
                }
                $_SESSION['user'] = $record;
                header("location: ../index.php");
            }
            else
            {
                echo "Identification echouée.";
            }

            
        }
    }

    public function create($datas)
    {
        $newUser = new User();
        $datas['password'] = password_hash($datas['password'], PASSWORD_DEFAULT);
        $newUser->create_user($datas);

    }
}
