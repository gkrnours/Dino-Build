<?php
class HelperController {
    public function __construct() {
    }
    public function run() {

        $table = array (
            'feu',
            'bois',
            'air',
            'eau',
            'foudre'
        );

        $table2 = array (
            'winks',
            'sirain',
            'kabuki',
            'wanman',
            'moueffe',
            'castivore',
            'feross',
            'nuagoz',
            'planaille',
            'pteroz',
            'toufufu',
            'gorilloz',
            'pigmou',
            'rocky',
            'quetzu'
        );

        if (! empty ( $_POST ['choix'] ) && ! empty ( $_POST ['race'] ) && in_array ( $_POST ['choix'], $table ) && in_array ( $_POST ['race'], $table2 )) {
            $_SESSION ['choix'] = $_POST ['choix'];
            $_SESSION ['race'] = $_POST ['race'];

            $table = Db::getInstance ()->select_toutcompetences ( $_SESSION ['choix'],  $_SESSION ['race']);
        } else {
            $table = "";
        }
        if (! empty ( $_POST ['mieux'] )) {
            if (! empty ( $_POST ['competences'] )) {
                    sort($_POST ['competences'] ,SORT_NUMERIC);
                    $competencesdispo = Db::getInstance ()->select_competencesdispo ($_SESSION ['race'], $_SESSION ['choix'], $_POST ['competences'] );
                    $tableau = array();
                    foreach($competencesdispo as $element){
                        $tableau[] = $element->num();
                    }
                    $conseil = Db::getInstance ()->conseil ( $tableau, $_SESSION ['race'], $_SESSION ['choix'] );
                    if ($conseil != false) {
                        $competence = Db::getInstance()->meilleurUp($_SESSION ['choix'], $conseil);
                    }
            } else {
                $competencesdispo = Db::getInstance ()->select_competencesdispo ($_SESSION ['race'], $_SESSION ['choix'], NULL );
                $tableau = array();
                foreach($competencesdispo as $element){
                    $tableau[] = $element->num();
                }
                $conseil = Db::getInstance ()->conseil ( $tableau, $_SESSION ['race'], $_SESSION ['choix'] );
                if ($conseil != false) {
                    $competence = Db::getInstance ()->meilleurUp ($_SESSION ['choix'], $conseil );
                }
            }
        }

        require_once (CHEMIN_VUES . 'helper.php');
    }

    public function isValid($competences){

        $array = array();
        foreach ($competences as $test){
            if ($test->parent() == 0){
                $array[] = $test->num();
            } else {
                if (! in_array($test->parent(), $array)){
                    return false;
                } else{
                    $array[] = $test->num();
                }
            }
        }
        return true;
    }
}

?>