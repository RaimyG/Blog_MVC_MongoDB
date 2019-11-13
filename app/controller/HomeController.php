<?php

/**
 * Gère les interactions de la page d'accueil
 */
class HomeController extends Controller
{

    /**
     * Affiche la page d'accueil
     */
    public function accueil()
    {
        $this->view->articles = ArticleModel::getAllArticles();
        $this->view->display("home/home");
    }
}
