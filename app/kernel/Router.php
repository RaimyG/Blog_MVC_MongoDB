<?php

/**
 * Gère les routes' 
 */
class Router
{
   public static function analyze($query)
   {
      $result = array(
         "controller" => "Error",
         "action" => "error404",
         "params" => array()
      );

      //Par défaut, On appelle la fonction inscription du UserController
      if ($query === "" || $query === "/") {
         $result["controller"] = "Home";
         $result["action"] = "accueil";
         $result["params"]["title"] = 'Accueil';
      } else {
         $parts = explode("/", $query);

         // URL : /user/inscription
         if (count($parts) == 2 && $parts[0] == "user" && $parts[1] == "inscription") {
            $result["controller"] = "User";
            $result["action"] = "inscription";
            $result["params"]["title"] = 'Inscription';
         }

         // URL : /user/connexion
         if (count($parts) == 2 && $parts[0] == "user" && $parts[1] == "connexion") {
            if (isset($_SESSION["_id"])) {
               header('Location: /blog/');
            } else {
               $result["controller"] = "User";
               $result["action"] = "connexion";
               $result["params"]["title"] = 'Connexion';
            }
         }

         // URL : /user/deconnexion
         if (count($parts) == 2 && $parts[0] == "user" && $parts[1] == "deconnexion") {
            $result["controller"] = "User";
            $result["action"] = "deconnexion";
         }

         // URL : /article/ecrire
         if (count($parts) == 2 && $parts[0] == "article" && $parts[1] == "ecrire") {
            if (!isset($_SESSION["_id"])) {
               header('Location: /blog/user/connexion');
            } else {
               $result["controller"] = "Article";
               $result["action"] = "ecrire";
               $result["params"]["title"] = 'Nouvel article';
            }
         }

         // URL : /article/id/
         if (count($parts) == 2 && $parts[0] == "article" && $parts[1] != "ecrire") {
            $result["controller"] = "Article";
            $result["action"] = "lire";
            $result["params"]["article"] = $parts[1];
            $result["params"]["title"] = 'Article';
         }

         // URL : /article/commenter/id
         if (count($parts) == 3 && $parts[0] == "article" && $parts[1] == "commenter") {
            $result["controller"] = "Article";
            $result["action"] = "commenter";
            $result["params"]["article"] = $parts[2];
         }

         // URL : /article/commenter/idArticle/idComment
         if (count($parts) == 4 && $parts[0] == "article" && $parts[1] == "repondre") {
            $result["controller"] = "Article";
            $result["action"] = "repondre";
            $result["params"]["article"] = $parts[2];
            $result["params"]["commentaire"] = $parts[3];
         }
      }
      return $result;
   }
}
