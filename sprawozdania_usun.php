<?php	
session_start();
if (!isset($_SESSION['admin']))
{	header('Location: sprawozdania.php');
	exit();
}
	if(!isset($_POST['rok']))
{
	header('Location:sprawozdania_mod2.php');
	exit();
}

	$rok = $_POST['rok'];
	
	require_once"baza.php";
	
	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	if($polaczenie->connect_errno!=0)
	{
		echo "Połącznie z bazą nie może być zrealizowane";
	}
	else	
	{
		$sql = "DELETE FROM sprawozdania WHERE Rok='$rok'";
		if($rezultat = $polaczenie->query($sql))
			{
						$_SESSION['usunieto']='<span style="color:#238E23;">Poprawnie usunięto sprawozdanie<br/></span>';
						header('Location:panel.php');
					
			}
			else
			{
			
				$_SESSION['blad3']='<span style="color:red;">Nie udało się usunąć sprawozdania. Spróbuj ponownie.<br/></span>';
				header('Location:sprawozdania_mod2.php');

			
			}
	}
?>

