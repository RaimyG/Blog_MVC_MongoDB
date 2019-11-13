<?php

/**
 * Gère les interaction avec la table 'users' de la base de données
 */
class UserModel
{

    /**
     * Insert le nouvel utilisateur dans la base de données
     * return true si l'inscription est finalisée | false dans le cas contraire
     */
    public static function inscription()
    {
        try {
            if (!self::existe()) { //Si le pseudo n'existe pas dans la bdd
                $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017"); // Connexion à MongoDB
                // Hydratation de l'objet
                $user = array(
                    'pseudo' => $_POST["pseudo"],
                    'password' => password_hash($_POST["password"], PASSWORD_DEFAULT)
                );
                // Connexion à la base de données "test"
                $bulk = new MongoDB\Driver\BulkWrite();
                $bulk->insert($user);
                // Création d'une nouvel objet de la collection "users"
                $manager->executeBulkWrite('blog.users', $bulk);
                return true;
            } else {
                return false;
            }
        } catch (\MongoDB\Driver\Exception\BulkWriteException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Connecte l'utilisateur 
     * return true si la connexion est finalisée | false dans le cas contraire
     */
    public static function connexion()
    {
        try { // Connexion à MongoDB
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            // Hydratation de l'objet
            $filter = ['pseudo' => $_POST['pseudo']];
            $read = new MongoDB\Driver\Query($filter);
            $result = $manager->executeQuery('blog.users', $read);
            foreach ($result as $user) {
                if (!empty($user)) {
                    if (password_verify($_POST['password'], $user->password)) {
                        // Set la session de l'utilisateur
                        $_SESSION['_id'] = (string) $user->_id; //id user bdd
                        $_SESSION['pseudo'] = $user->pseudo;
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        } catch (\MongoDB\Driver\Exception\BulkWriteException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Vérifie que l'utilisateur existe dans la basse de données
     * return true s'il existe | false dans le cas contraire
     */
    private static function existe()
    {
        try { // Connexion à MongoDB
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            // Hydratation de l'objet
            $filter = ['pseudo' => $_POST['pseudo']];
            $read = new MongoDB\Driver\Query($filter);
            $result = $manager->executeQuery('blog.users', $read);
            foreach ($result as $user) {
                if (!empty($user)) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (\MongoDB\Driver\Exception\BulkWriteException $e) {
            echo $e->getMessage();
        }
    }

    public function deconnexion()
    {
        session_unset();
        session_destroy();
    }
}
