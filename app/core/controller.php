<?php
    class Controller {
        public $data = array();

        public function __construct()
        {
            $this->loadModel('user');
            $this->u = new Users_Model();
            if(isset($_SESSION["login"])){
                $this->u->user=$_SESSION["login"]["user"];
                $this->u->id=$this->u->get()["id"];
            }elseif(isset($_COOKIE["user"]) && isset($_COOKIE["pass"])){
                $this->u->user=$_COOKIE["user"];
                $this->u->pass=$_COOKIE["pass"];
                if(!$this->u->login()){
                    $this->u->logout();
                }
            }
        }

        public function loadModel($modelName){
            require_once DIR."/app/models/$modelName.php";
        }

        public function loadHelper($file){
            require DIR."/app/helpers/$file.php";
        }

        public function loadView($folder,$view){
            ob_start();                      // start capturing output
            @include DIR."/app/views/".$folder."/".$view.".php";   // execute the file
            $page = ob_get_contents();    // get the contents from the buffer
            ob_end_clean();
            return $page;
        }

        public function render($folder, $view){
            $page=$this->loadView($folder, $view);
            require 'app/templates/page.php';
        }
    }

?>
