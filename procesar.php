<?php
	require_once 'ClienteForm.php';
	
	$form = new ClienteForm();
	
	if(!empty($_POST)) {	//venimos por post?

		if($form->procesar($_POST)) {	//procesó OK?
			header("Location: ok.php");	//redirect
			die();
		}
	}
	
	require "procesar_vista.php";
