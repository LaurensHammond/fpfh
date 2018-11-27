<?php	
session_start();
if (!isset($_SESSION['admin']))
{	header('Location: partnerzy.php');
	exit();
}
	if(!isset($_POST['nazwa']))
{
	header('Location:partnerzy_mod2.php');
	exit();
}

	$title2 = $_POST['nazwa'];
	
	require_once"baza.php";
	
	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	if($polaczenie->connect_errno!=0)
	{
		echo "Połącznie z bazą nie może być zrealizowane";
	}
	else	
	{
		$sql = "DELETE FROM `partnerzy` WHERE Nazwa='$title2'";
		if($rezultat = $polaczenie->query($sql))
			{
						$_SESSION['usunieto']='<span style="color:#238E23;">Poprawnie usunięto Partnera<br/></span>';
						header('Location:panel.php');
					
			}
			else
			{
			
				$_SESSION['blad3']='<span style="color:red;">Nie udało się usunąć Partnera. Spróbuj ponownie.<br/></span>';
				header('Location:partnerzy_mod2.php');

			
			}
	}
?>

