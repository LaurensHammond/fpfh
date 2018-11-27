<?php	
session_start();
if (!isset($_SESSION['admin']))
{	header('Location: login.php');
	exit();
}
if((!isset($_POST['naglowek2'])) || (!isset($_POST['dane2'])) || (!isset($_POST['waga2'])) || (!isset($_POST['kat2'])) || (!isset($_POST['id'])))
	{
		header('Location:kontakt.php');
		exit();
	}

	$id=$_POST['id'];
	$naglowek2 = $_POST['naglowek2'];
	$dane2 = $_POST['dane2'];
	$waga2 = $_POST['waga2'];
	$kat2 = $_POST['kat2'];
		
require_once"baza.php";
	
	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	if($polaczenie->connect_errno!=0)
	{
		echo "Połącznie z bazą nie może być zrealizowane 111";
	}
	else	
	{
		if($naglowek2!='')
		{
		$sql = "UPDATE `funpolfilmhist`.`kontakt` SET `Naglowek` = '$naglowek2' WHERE `kontakt`.`Id` = $id;";
		if($rezultat = $polaczenie->query($sql))
			{
						header('Location:panel.php');
					
			}
			else
			{
			
			}
		}	
		if($dane2!='')
		{
		$sql = "UPDATE `funpolfilmhist`.`kontakt` SET `Dane` = '$dane2' WHERE `kontakt`.`Id` = $id;";
		if($rezultat = $polaczenie->query($sql))
			{
						header('Location:panel.php');
					
			}

		}	
		if($waga2!='')
		{
		$sql = "UPDATE `funpolfilmhist`.`kontakt` SET `Waga` = '$waga2' WHERE `kontakt`.`Id` = $id;";
		if($rezultat = $polaczenie->query($sql))
			{
						header('Location:panel.php');
					
			}

		}	
		if($kat2!='')
		{
		$sql = "UPDATE `funpolfilmhist`.`kontakt` SET `Kat` = '$kat2' WHERE `kontakt`.`Id` = $id;";
		if($rezultat = $polaczenie->query($sql))
			{
						header('Location:panel.php');
			}
		}
		if(($kat2=='')||($dane2=='')||($naglowek2=='')||($naglowek2=='')) header('Location:kontakt.php');
		
	}
?>

