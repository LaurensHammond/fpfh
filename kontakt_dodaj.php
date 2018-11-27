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



	$naglowek = $_POST['naglowek2'];
	$dane = $_POST['dane2'];
	$waga = $_POST['waga2'];
	$kat = $_POST['kat2'];
	


	
	require_once"baza.php";
	
	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	if($polaczenie->connect_errno!=0)
	{
		echo "Połącznie z bazą nie może być zrealizowane 111";
	}
	else	
	{
	if(($naglowek=='')||($dane==''))
		{
		$_SESSION['blad1']='<span style="color:red;">Wymaga się podania co najmniej &nbsp;&nbsp; NAGŁÓWKA &nbsp; i &nbsp; WARTOŚCI &nbsp;&nbsp; wpisu !!!<br/></span>';
		header('Location:kontakt_mod1.php');
		}
		else
		{

				$sql = "INSERT INTO `funpolfilmhist`.`kontakt` (`Naglowek`, `Dane`, `Waga`, `Kat`) VALUES ('$naglowek', '$dane', '$waga', '$kat' );";
				$dodaj=$polaczenie->query($sql);
				$_SESSION['dodano']='<span style="color:#238E23;">Wpis został dodany! </span>';
				header('Location:panel.php');
					
			
			$polaczenie->close();
		
		}
	}
?>

