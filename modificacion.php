<?php
session_start();
require_once 'ClienteForm.php';
    

    $form = new ClienteForm();
    
    if (!empty($_GET)) {
        $_SESSION['id']=$_GET['id'];
    }

    if (!empty($_GET)) {
        $persona = $form->persona_buscar();
    }

    if(!empty($_POST)) {    //venimos por post?

        if($form->procesar($_POST)) {   //procesó OK?
            $form->modif($_SESSION['id']);
            header("Location: ok.php"); //redirect
            die();
        }
    }
    
    require "modificacion_vista.php";