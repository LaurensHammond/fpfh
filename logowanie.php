<?php
session_start();
if(isset($_POST['login'])&&(isset($_POST['haslo'])))
{
	if(isset($_SESSION['admin'])||($_SESSION['admin']==true))
		header('Location: panel.php');
	else
	{
		require_once"pass.php";

		if(($_POST['login']==$name)&&($_POST['haslo']==$password))
		{
			$_SESSION['admin']=true;
			unset($_SESSION['blad']);
			header('Location: panel.php');
		}
		else
		{	$_SESSION['blad']='<div style="color:red;width:500px;margin-left:auto;margin-right:auto;text-align:center;">Nieprawidłowy login lub hasło!</div>';
			header('Location: login.php');
		}
	}
}
else
	header('Location: login.php');

?>