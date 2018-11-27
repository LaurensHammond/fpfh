<?php	
session_start();
if (!isset($_SESSION['admin']))
{	header('Location: login.php');
	exit();
}


$album=$_POST['album'];
echo $album;

require_once"baza.php";
	
	$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	if($polaczenie->connect_errno!=0)
	{
		echo "Połącznie z bazą nie może być zrealizowane 111";
	}
	else
	{
		if($album=='')
		{
		$_SESSION['blad1']='<span style="color:red;">Wymaga się podania NAZWY albumu !!!<br/></span>';
		header('Location:galeria_mod1.php');
		}
		else
		{
			$sql="SELECT * FROM galeria WHERE Album='$album'";

			if($rezultat = $polaczenie->query($sql))
			{
				$ile_wpisow=$rezultat->num_rows;
				if($ile_wpisow==0)
				{		
						$sql_2 = "INSERT INTO `funpolfilmhist`.`galeria` (`ID`, `Album`, `ile`, `Data`) VALUES (NULL, '$album', 0, CURDATE());";

						if($dodaj=$polaczenie->query($sql_2))
						{
						$katalog="./Galeria/$album";
						mkdir("$katalog");
						$_SESSION['dodano']='<span style="color:#238E23;">Album został utworzony !!! </span>';
						$_SESSION['domysl']=$album;
						header('Location:galeria_album.php');}
						else
						{
						$_SESSION['dodano']='<span style="color:red;">Nie udało się utworzyć albumu !!! </span>';
						header('Location:galeria_mod1.php');}
					
				}
				else
				{
					
					$_SESSION['blad2']='<span style="color:red;">Album o takim tytule i dacie istnieje już w bazie.<br/></span>';
					header('Location:galeria_mod1.php');
				}
			}
			$polaczenie->close();
		
		}
	}
	


?>

