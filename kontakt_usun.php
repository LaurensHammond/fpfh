<?php	
session_start();
if (!isset($_SESSION['admin']))
{	header('Location: partnerzy.php');
	exit();
}
	if(!isset($_POST['naglowek']))
{
	header('Location:kontakt_mod2.php');
	exit();
}

	$naglowek = $_POST['naglowek'];
	$dane = $_POST['dane'];
	
	require_once"baza.php";
	
	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	if($polaczenie->connect_errno!=0)
	{
		echo "Połącznie z bazą nie może być zrealizowane";
	}
	else	
	{
	$sql = "SELECT * FROM `kontakt` WHERE Naglowek='$naglowek' AND Dane='$dane'";	
		if($rezultat1 = $polaczenie->query($sql))
		{	
		$ile=$rezultat1->num_rows;
		if($ile!=0)
		{
			$sql1 = "DELETE FROM `kontakt` WHERE Naglowek='$naglowek' AND Dane='$dane'";
			if($rezultat = $polaczenie->query($sql1))
			{
						$_SESSION['usunieto']='<span style="color:#238E23;">Poprawnie usunięto kontakt<br/></span>';
						header('Location:panel.php');
					
			}
			else
			{
			
				$_SESSION['blad3']='<span style="color:red;">Nie udało się usunąć kontaktu. Spróbuj ponownie... <br/></span>';
				header('Location:kontakt_mod2.php');

			
			}
		}
		else
		{
			$_SESSION['blad3']='<span style="color:red;"> Nagłówek i wartość kontaktu muszą się ze sobą zgadzać! <br/></span>';
			header('Location:kontakt_mod2.php');
		}
		}
	}
?>

