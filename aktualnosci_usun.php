<?php	
session_start();
if (!isset($_SESSION['admin']))
{	header('Location: aktualnosci.php');
	exit();
}
	if((!isset($_POST['dzien'])) || (!isset($_POST['title2'])))
	{
		header('Location:aktualnosci_mod2.php');
		exit();
	}



	$dzien = $_POST['dzien'];
	$title2 = $_POST['title2'];
	
	require_once"baza.php";
	
	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	if($polaczenie->connect_errno!=0)
	{
		echo "Połącznie z bazą nie może być zrealizowane 111";
	}
	else	
	{
		$sql = "DELETE FROM `aktualnosci` WHERE Tytul='$title2' AND Data='$dzien'";
		if($rezultat = $polaczenie->query($sql))
			{
						$_SESSION['usunieto']='<span style="color:#238E23;">Poprawnie usunięto post<br/></span>';
						header('Location:panel.php');
					
			}
			else
			{
			
				$_SESSION['blad3']='<span style="color:red;">Nie udało się usunąć wpisu. Spróbuj ponownie.<br/></span>';
				header('Location:aktualnosci_mod2.php');

			
			}
	}
?>

