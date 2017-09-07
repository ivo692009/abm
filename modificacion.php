<?php

require_once 'ClienteForm.php';
    
    $form = new ClienteForm();
    
    if (!empty($_GET)) {
        $id= $_GET['id'];
    }

    if (!empty($_GET)) {
        $form->persona($_GET['id']);
    }

    if(!empty($_POST)) {    //venimos por post?

        if($form->procesar($_POST)) {   //procesó OK?
            $form->modif($_POST);
            header("Location: ok.php"); //redirect
            die();
        }
    }
    
    require "modificacion_vista.php";