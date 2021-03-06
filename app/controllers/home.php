<?php
    require_once 'app/core/controller.php';

    class Home extends Controller{

        function index_home(){
            $this->data['page_title'] = PAGE_NAME;
            if ($_POST){
                if(empty($_POST["user_reg"]) && empty($_POST["email_reg"]) && empty($_POST["pass_reg"])){ //login

                    $this->u->user=$_POST["username"];
                    $this->u->pass=md5($_POST["password"]);
                    $loginrec=$_POST['loginrec'];

                    if(!isset($_GET["activation"])){ //si no se recibe clave para activacion hacemos login normal

                        if ($this->u->login($loginrec)){
                            //mostramos timeline
                            $this->render('timeline','timeline');
                        }else{
                            //mostramos de nuevo la pagina de inicio con error
                            $this->data["reg_error"]="";
                            $this->data["login_error"]=__("El nombre de usuario o contraseña no son válidos");
                            $this->render('home','home');
                        }
                    }else{ //si recibimos clave de activacion intentamos activar la cuenta
                        if($this->u->activate($_GET["activation"])){
                            if ($this->u->login($loginrec)){
                                //mostramos timeline
                                $this->render('timeline','timeline');
                            }else{
                                //mostramos de nuevo la pagina de inicio con error
                                $this->data["reg_error"]="";
                                $this->data["login_error"]=__("El nombre de usuario o contraseña no son válidos");
                                $this->render('home','home');
                            }
                        }else{
                            $this->data["reg_error"]="";
                            $this->data["login_error"]=__("El nombre de usuario, contraseña o clave de activación no son válidos.");
                            $this->render('home','home');
                        }
                    }
                }else{//register
                    $this->u->user = $_POST["user_reg"];
                    $this->u->pass = md5($_POST["pass_reg"]);
                    $this->u->email = $_POST["email_reg"];
                    $this->data["login_error"]="";
                    if ($this->u->register()){
                        $this->render('home','register_sucess');
                        //hemos enviado un email, necesitas activarlo
                    }else{
                        $this->data["reg_error"]=__("Ya hay un usuario registrado con este nombre o e-mail");
                        $this->render('home','home');
                    }

                }
            }else{
                $this->render('home', 'home');
                /*$this->data['prop_list'] = $this->_proposal->get_proposals();*/
            }
        }

    }
?>
