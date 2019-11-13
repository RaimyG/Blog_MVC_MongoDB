<?php

/**
 * Gère les interaction avec la table 'users' de la base de données
 */
class ArticleModel
{
    public static function ecrireArticle()
    {
        try {
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017"); // Connexion à MongoDB
            // Hydratation de l'objet
            setlocale(LC_ALL, "fr_FR"); // Set la date au format FR
            $article = array(
                'date' => strftime("%a. %d %B %Y"),
                'titre' => $_POST["titre"],
                'sous_titre' => $_POST["sous_titre"],
                'message' => $_POST["message"],
                'redacteur_id' => $_SESSION["_id"],
                'redacteur' => $_SESSION["pseudo"]
            );
            // Connexion à la base de données "test"
            $bulk = new MongoDB\Driver\BulkWrite();
            $bulk->insert($article);
            // Création d'une nouvel objet de la collection "users"
            $manager->executeBulkWrite('blog.articles', $bulk);
            return true;
        } catch (\MongoDB\Driver\Exception\BulkWriteException $e) {
            echo $e->getMessage();
        }
    }

    public static function getAllArticles()
    {
        try { // Connexion à MongoDB
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            // Hydratation de l'objet
            $filter = [];
            $options = [
                /* Permet de recuperer dans l'ordre d'insertion (tri par date) */
                'sort' => [
                    '_id' => -1
                ],
            ];
            $read = new MongoDB\Driver\Query($filter, $options);
            $result = $manager->executeQuery('blog.articles', $read);
            $articles = array();
            foreach ($result as $article) {
                array_push($articles, $article);
            }
            return $articles;
        } catch (\MongoDB\Driver\Exception\BulkWriteException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Récupère l'article en BDD par son identifiant
     */
    public static function lireArticle($idArticle)
    {
        try { // Connexion à MongoDB
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            // Hydratation de l'objet
            $id = new \MongoDB\BSON\ObjectId($idArticle); // Cast car c'est _id de l'object mongodb
            $filter = ['_id' => $id];
            $read = new MongoDB\Driver\Query($filter);
            $result = $manager->executeQuery('blog.articles', $read);
            foreach ($result as $article) {
                return $article;
            }
        } catch (\MongoDB\Driver\Exception\BulkWriteException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Insert en BDD un commentaire sur un post
     */
    public static function commenterArticle($idArticle)
    {
        try {
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017"); // Connexion à MongoDB
            // Hydratation de l'objet
            setlocale(LC_ALL, "fr_FR"); // Set la date au format FR
            $commentaire = array(
                'article_id' => $idArticle,
                'date' => strftime("%a. %d %B %Y"),
                'message' => $_POST["message"],
                'redacteur_id' => $_SESSION["_id"],
                'redacteur' => $_SESSION["pseudo"]
            );
            // Connexion à la base de données "test"
            $bulk = new MongoDB\Driver\BulkWrite();
            $bulk->insert($commentaire);
            // Création d'une nouvel objet de la collection "users"
            $manager->executeBulkWrite('blog.commentaires', $bulk);
            return true;
        } catch (\MongoDB\Driver\Exception\BulkWriteException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Insert la réponse d'un commentaire en bdd
     */
    public static function repondreCommentaire($idArticle, $idCommentaire)
    {
        try {
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017"); // Connexion à MongoDB
            // Hydratation de l'objet
            setlocale(LC_ALL, "fr_FR"); // Set la date au format FR
            $commentaire = array(
                'article_id' => $idArticle,
                'parent_id' => $idCommentaire,
                'date' => strftime("%a. %d %B %Y"),
                'message' => $_POST["message"],
                'redacteur_id' => $_SESSION["_id"],
                'redacteur' => $_SESSION["pseudo"]
            );
            // Connexion à la base de données "test"
            $bulk = new MongoDB\Driver\BulkWrite();
            $bulk->insert($commentaire);
            // Création d'une nouvel objet de la collection "users"
            $manager->executeBulkWrite('blog.commentaires', $bulk);
            return true;
        } catch (\MongoDB\Driver\Exception\BulkWriteException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Récupère tous les commentaires d'un post
     */
    public static function getAllCommentaires($idArticle)
    {
        try { // Connexion à MongoDB
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            // Hydratation de l'objet
            $filter = ['article_id' => $idArticle, 'parent_id' => null];
            $read = new MongoDB\Driver\Query($filter);
            $result = $manager->executeQuery('blog.commentaires', $read);
            $commentaires = array();
            foreach ($result as $commentaire) {
                array_push($commentaires, $commentaire);
            }
            return $commentaires;
        } catch (\MongoDB\Driver\Exception\BulkWriteException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Récupères toutes les réponses liées à un commentaire (recurisivement)
     */
    public static function getAllReponses($idArticle, $idCommentaire)
    {
        try { // Connexion à MongoDB
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            // Hydratation de l'objet
            $filter = ['article_id' => $idArticle, 'parent_id' => (string) $idCommentaire];
            $read = new MongoDB\Driver\Query($filter);
            $result = $manager->executeQuery('blog.commentaires', $read);
            $reponses = array();
            $i = 0;
            foreach ($result as $reponse) {
                array_push($reponses, $reponse);
                $rep = self::getAllReponses($idArticle, $reponse->_id);
                if (!empty($rep)) {
                    $reponses[$i]->reponses = $rep;
                }
                $i++;
            }
            return $reponses;
        } catch (\MongoDB\Driver\Exception\BulkWriteException $e) {
            echo $e->getMessage();
        }
    }

}
