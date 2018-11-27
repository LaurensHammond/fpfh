<?php	
session_start();
if (!isset($_SESSION['admin']))
{	header('Location: login.php');
	exit();
}
if((!isset($_POST['rok'])) || (!isset($_POST['opis'])) || (!isset($_POST['link'])))
	{
		header('Location:sprawozdania_mod1.php');
		exit();
	}



	$rok = $_POST['rok'];
	$link = $_POST['link'];
	$opis = $_POST['opis'];
	
	
	require_once"baza.php";
	
	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	if($polaczenie->connect_errno!=0)
	{
		echo "Połącznie z bazą nie może być zrealizowane 111";
	}
	else	
	{
		if(($rok=='')||(($link='')&&($opis='')))
		{
			$_SESSION['blad1']='<span style="color:red;">Wymaga się podania co najmniej &nbsp;&nbsp; ROKU, a także LINKU lub Treści &nbsp;&nbsp; wpisu !!!<br/></span>';
			header('Location:sprawozdania_mod1.php');
		}
		else
		{
			$sql="SELECT * FROM sprawozdania WHERE Rok='$rok'";

			if($rezultat = $polaczenie->query($sql))
			{
				$ile_wpisow=$rezultat->num_rows;
				if($ile_wpisow==0)
				{

						$sql_2 = "INSERT INTO `funpolfilmhist`.`sprawozdania` (`Rok`, `Link`, `Opis`) VALUES ('$rok', '$link', '$opis');";}
						
						$dodaj=$polaczenie->query($sql_2);
						$_SESSION['dodano']='<span style="color:#238E23;">Wpis został dodany! </span>';
						header('Location:panel.php');
					
				}
				else
				{
					
					$_SESSION['blad2']='<span style="color:red;">Partner o takiej nazwie istnieje już w bazie.<br/></span>';
					header('Location:sprawozdania_mod1.php');
				}
		}
			$polaczenie->close();
		
		
	}
?>

