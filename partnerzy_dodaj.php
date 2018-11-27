<?php	
session_start();
if (!isset($_SESSION['admin']))
{	header('Location: login.php');
	exit();
}
if((!isset($_POST['nazwa'])) || (!isset($_POST['opis'])) || (!isset($_POST['photo'])))
	{
		header('Location:partnerzy_mod1.php');
		exit();
	}



	$nazwa = $_POST['nazwa'];
	$foto = $_POST['photo'];
	$opis = $_POST['opis'];
	
if($opis =='Opis...')
$opis = '';
	


	
	require_once"baza.php";
	
	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	if($polaczenie->connect_errno!=0)
	{
		echo "Połącznie z bazą nie może być zrealizowane 111";
	}
	else	
	{
	if($nazwa=='')
		{
		$_SESSION['blad1']='<span style="color:red;">Wymaga się podania co najmniej &nbsp;&nbsp; NAZWY &nbsp;&nbsp; wpisu !!!<br/></span>';
		header('Location:partnerzy_mod1.php');
		}
	else
		{
			$sql="SELECT * FROM partnerzy WHERE Nazwa='$nazwa'";

			if($rezultat = $polaczenie->query($sql))
			{
				$ile_wpisow=$rezultat->num_rows;
				if($ile_wpisow==0)
				{
							if($foto = '')
							{$sql_2 = "INSERT INTO `funpolfilmhist`.`partnerzy` (`Nazwa`, `Data`, `Opis`) VALUES ('$nazwa', CURDATE(), '$opis');";}
							else
							{$sql_2 = "INSERT INTO `funpolfilmhist`.`partnerzy` (`Nazwa`, `Data`, `Opis`, `Zdjecie`) VALUES ('$nazwa', CURDATE(), '$opis', '$foto');";}
						
						$dodaj=$polaczenie->query($sql_2);
						$_SESSION['dodano']='<span style="color:#238E23;">Wpis został dodany! </span>';
						header('Location:panel.php');
					
				}
				else
				{
					
					$_SESSION['blad2']='<span style="color:red;">Partner o takiej nazwie istnieje już w bazie.<br/></span>';
					header('Location:partnerzy_mod1.php');
				}
			}
			$polaczenie->close();
		
		}
	}
?>

