<?php
class HelperController {
    private $etape = 0;

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
            'wanwan',
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
            'quetzu',
            'soufflet',
            'mahamuti',
            'hippoclamp',
            'santaz',
            'smog'
        );

        if (! empty ( $_POST ['race'] ) && in_array ( $_POST ['race'], $table2 )){
            $race = $_POST ['race'];
            $_SESSION ['race'] = $_POST ['race'];
        }

        if (!empty($_SESSION['id']) && !empty($_POST['dinoUser'])){

            $dino = Donnees::getInstance()->getDinoUser($_POST['dinoUser']);

            if ($dino != null && in_array ( $dino->getRace(), $table2 )){
                $race = $dino->getRace();
                $_SESSION ['race'] = $dino->getRace();
                $_SESSION ['dino'] = $dino->getId();
            }

        }

        if (! empty ( $_POST ['element'] ) && in_array ( $_POST ['element'], $table )) {
            $element = $_POST ['element'];
            $_SESSION ['element'] = $_POST ['element'];
        }

        if (!empty($element) && !empty($race)){
            $table = Db::getInstance ()->select_toutcompetences ( $_SESSION ['element'],  $_SESSION ['race']);
            if (!empty($_SESSION ['dino'])) {
                $funcname = "get" . ucfirst($_SESSION['element']);
                $competences_Acquises = Donnees::getInstance()->getDinoUser($_SESSION ['dino'])->$funcname();
            }
        } else {
            $table = "";
        }


        if (! empty ( $_POST ['mieux'] )) {
            if (! empty ( $_POST ['competences'] )) {

                sort($_POST ['competences'] ,SORT_NUMERIC);
                $competences = Db::getInstance()->select_competences($_POST ['competences'], $_SESSION ['element']);
                $correct = $this->isValid($competences);

                if ($correct) {
                    if (!empty($_SESSION ['dino'])){
                        $dino = Donnees::getInstance()->getDinoUser($_SESSION ['dino']);
                        $funcname = "set" . ucfirst($_SESSION['element']);
                        $dino->$funcname($_POST ['competences']);
                        Donnees::getInstance()->misAJour($dino);
                        $_SESSION['dino'] = null;
                    }

                    $competencesdispo = Db::getInstance()->select_competencesdispo($_SESSION ['race'], $_SESSION ['element'], $_POST ['competences']);
                    $tableau = array();

                    foreach ($competencesdispo as $element) {
                        $tableau[] = $element->num();
                    }

                    $conseil = Db::getInstance()->conseil($tableau, $_SESSION ['race'], $_SESSION ['element']);
                    if ($conseil != false) {
                        $meilleurUp = Db::getInstance()->meilleurUp($_SESSION ['element'], $conseil);
                    }
                } else {
                    $error = true;
                    $table = Db::getInstance ()->select_toutcompetences ( $_SESSION ['element'],  $_SESSION ['race']);
                }
            } else {

                $competencesdispo = Db::getInstance ()->select_competencesdispo ($_SESSION ['race'], $_SESSION ['element'], NULL );
                $tableau = array();

                foreach($competencesdispo as $element){
                    $tableau[] = $element->num();
                }

                $conseil = Db::getInstance ()->conseil ( $tableau, $_SESSION ['race'], $_SESSION ['element'] );
                if ($conseil != false) {
                    $meilleurUp = Db::getInstance ()->meilleurUp ($_SESSION ['element'], $conseil );
                }
            }
        }

        if (!empty($competencesdispo)){
	    $this->etape = 4;
        } elseif (!empty($table)){
	    $this->etape = 3;
        } elseif (!empty($race)) {
	    $this->etape = 2;
        } else {
	    $this->etape = 1;
        }

        require_once (CHEMIN_VUES . 'helper.php');
    }

    public function footer() {
        $footer = "<img id=etape src=views/images/etapes/etape" . $this->etape;
        $footer = $footer . ".png alt=Etapes/>";
	echo $footer;
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
