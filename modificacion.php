<?php
session_start();
require_once 'ClienteForm.php';
    

    $form = new ClienteForm();
    
    if (!empty($_GET)) {
        $id=$_GET['id'];
        require_once 'buscar_persona.php';
    }

    if(!empty($_POST)) {    //venimos por post?

        if($form->procesar($_POST)) {   //procesó OK?
            $form->modif($_SESSION['id']);
            header("Location: ok.php"); //redirect
            die();
        }
    }
    
    require "modificacion_vista.php";