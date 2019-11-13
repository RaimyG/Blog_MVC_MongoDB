<?php

/**
 * Gère les interactions de la page d'accueil
 */
class ArticleController extends Controller
{

    /**
     * Affiche le formulaire pour rédiger un nouvel article || insert l'article dans la BDD
     */
    public function ecrire()
    {
        if (!empty($_POST["titre"]) && !empty($_POST["message"])) {
            $article = ArticleModel::ecrireArticle();
            if ($article) {
                $this->view->success = "Votre article a bien écrit. 😊";
                $this->view->display("article/ecrire"); // Affiche de nouveau la page d'inscription avec un message de succes
            } else {
                $this->view->erreur = "Une erreur s'est produite, veuillez réessayer plus tard.";
                $this->view->display("article/ecrire"); // Affiche de nouveau la page d'inscription avec un message d'erreur
            }
        } else {
            $this->view->display("article/ecrire");
        }
    }

    /**
     * Affiche un article
     */
    public function lire()
    {
        $idArticle = $this->route['params']['article'];
        $article = ArticleModel::lireArticle($idArticle);
        $commentaires = ArticleModel::getAllCommentaires($idArticle);
        $reponsesTemp = array();
        foreach ($commentaires as $commentaire) {
            $rep = ArticleModel::getAllReponses($idArticle, $commentaire->_id);
            array_push($reponsesTemp, $rep);
        }

        $reponses = array();

        $i = 0;
        foreach ($reponsesTemp as $reponse) {
            $reponses[$i] = self::genererReponses($reponse);
            $i++;
        }

        $this->view->article = $article;
        $this->view->commentaires = $commentaires;
        $this->view->reponses = $reponses;

        $this->view->display("article/article");
    }

    /**
     * Génère le code HTML à afficher pour les réponses aux commentaires
     */
    private function genererReponses($reponses)
    {
        $html = "";
        foreach ($reponses as $reponse) {
            $html .=
                "<div class='border pl-3 pr-3 mt-4 pb-2 mb-3'>" .
                "<p class='text-muted'>Posté par " . $reponse->redacteur . ", le " . $reponse->date . "</p>" .
                "<p>" . $reponse->message . "</p>";
            if (isset($_SESSION["_id"])) {
                $html .=
                    "<button class='btn btn-secondary btn-block mb-3' id='repondreComment'>Répondre à ce commentaire</button>" .
                    "<form action='/blog/article/repondre/" . $reponse->article_id . "/" . $reponse->_id . "' class='d-none justify-content-between mt-2' method='post'>" .
                    "<input type='text' placeholder='Réponse' name='message' class='flex-grow-1 mr-3 mb-2 pl-2'>" .
                    "<button class='mb-2 btn btn-primary mt-1'><i class='fa fa-paper-plane'></i> Envoyer</button>" .
                    "</form>";
            }

            if (!empty($reponse->reponses)) {
                $html .= self::genererReponses($reponse->reponses);
            }
            $html .= "</div>";
        }

        return $html;
    }

    /** 
     * Commente un article
     */
    public function commenter()
    {
        $idArticle = $this->route['params']['article'];
        ArticleModel::commenterArticle($idArticle);
        header("Location: /blog/article/$idArticle"); //redirect vers l'article

    }

    /**
     * Répond à un commentaire
     */
    public function repondre()
    {
        $idArticle = $this->route['params']['article'];
        $idCommentaire = $this->route['params']['commentaire'];
        ArticleModel::repondreCommentaire($idArticle, $idCommentaire);
        header("Location: /blog/article/$idArticle"); //redirect vers l'article

    }
}
