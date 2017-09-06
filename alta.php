<?php
	require_once 'ClienteForm.php';
	
	$form = new ClienteForm();
	
	if(!empty($_POST)) {	//venimos por post?

		if($form->procesar($_POST)) {	//procesó OK?
			$form->push($_POST);
			header("Location: ok.php");	//redirect
			die();
		}
	}
	
	require "alta_vista.php";