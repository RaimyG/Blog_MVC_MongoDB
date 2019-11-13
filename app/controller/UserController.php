<?php

/**
 * Gère les interactions avec l'utilisateur dans connexion/inscription
 */
class UserController extends Controller
{

    /**
     * Affiche le formulaire d'inscription || Insert dans la base de données le nouvel utilisateur
     */
    public function inscription()
    {
        if (isset($_POST["pseudo"]) && isset($_POST["password"])) {
            $inscription = UserModel::inscription();
            if ($inscription) {
                header('Location: ./connexion'); //redirect vers la page de connexion
            } else {
                $this->view->erreur = "Ce nom d'utilisateur est déjà pris";
                $this->view->display("user/inscription"); // Affiche de nouveau la page d'inscription avec un message d'erreur
            }
        } else {
            $this->view->display("user/inscription");
        }
    }

    /**
     * Affiche le formulaire de connexion || Connecte l'utilisateur s'il existe
     */
    public function connexion()
    {
        if (isset($_POST["pseudo"]) && isset($_POST["password"])) {
            $connexion = UserModel::connexion();
            if ($connexion) {
                header('Location: /blog'); //redirect vers la page d'accueil
            } else {
                $this->view->erreur = "Votre pseudo et/ou mot de passe n'est pas correct";
                $this->view->display("user/connexion"); // Affiche de nouveau la page de connexion avec un message d'erreur
            }
        } else {
            $this->view->display("user/connexion");
        }
    }

    /**
     * Déconnecte l'utilisateur et le redirige vers la page d'accueil
     */
    public function deconnexion()
    {
        UserModel::deconnexion();        
        header('Location: /blog'); //redirect vers la page d'accueil
    }
}
