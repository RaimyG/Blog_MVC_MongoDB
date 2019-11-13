<?php
/**
 * Gère l'affichage des vues
 */
class View {
   protected $_route;
   protected $data = array();

   public function __construct( $route ) {
      $this->_route = $route;
   }

   /**
    * Affiche une vue (un fichier)
    * $view - vue que l'on souhaite afficher
    */
   public function display($view) {
      $viewFile = ROOT . "/app/view/$view.php";         

      if( file_exists( $viewFile ) ) {
         include(ROOT . "/app/view/template/header.php");
         include($viewFile);
         include(ROOT . "/app/view/template/footer.php");
      } else {
         throw new DomainException("Vue introuvable - " . $viewFile);
      }
   }

   public function __set($key, $value) {
      $this->data[$key] = $value;
   }
   
   public function __get($key) {
      return $this->data[$key];
   }


}

